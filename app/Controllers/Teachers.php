<?php

namespace App\Controllers;

use App\Models\TeachersModel;
use App\Models\ActivityLogModel;

class Teachers extends BaseController
{
    protected $logModel;

    public function __construct()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }
        $this->logModel = new ActivityLogModel();
    }

    // Admin/staff only. A teacher (or parent) must not enter management pages.
    public function index()
    {
        helper('photo');
        if (session('role') != 'admin' && session('role') != 'staff') {
            return redirect()->to('/dashboard');
        }
        $model = new TeachersModel();
        $teachers = $model->orderBy('created_at', 'DESC')->findAll();

        // Class size = students whose adviser is this teacher OR who sit in
        // the teacher's grade/section. Counting adviser_id alone made a
        // freshly created "Grade 2 - B" teacher show 0 students, because the
        // section's students still carried the adviser_id of an older
        // teacher from a different section.
        $db = \Config\Database::connect();
        $counts = [];
        foreach ($teachers as $t) {
            $counts[$t['id']] = $db->table('students')
                ->groupStart()
                    ->where('adviser_id', $t['id'])
                    ->orWhere('grade_section', $t['grade_section'])
                ->groupEnd()
                ->countAllResults();
        }

        $data['teachers'] = $teachers;
        $data['studentCounts'] = $counts;
        $data['gradeSections'] = $this->gradeSections();
        return view('teachers', $data);
    }

    public function view($id)
    {
        helper('photo');
        // A teacher may only open their own classroom; admin/staff may view any.
        if (session('role') == 'teacher' && (int) session('user_id') !== (int) $id) {
            return redirect()->to('/dashboard')->with('error', 'You can only view your own class.');
        }
        if (session('role') == 'parent') {
            return redirect()->to('/dashboard');
        }

        $model = new TeachersModel();
        $teacher = $model->find($id);
        if (!$teacher) {
            return redirect()->to('/teachers')->with('error', 'Teacher not found');
        }

        $db = \Config\Database::connect();

        // Date filter: defaults to today
        $selectedDate = $this->request->getGet('date') ?: date('Y-m-d');
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $selectedDate)) {
            $selectedDate = date('Y-m-d');
        }

        // Search filter
        $search = trim($this->request->getGet('q') ?? '');

        $query = $db->table('students')
            ->select('students.*')
            ->groupStart()
                ->where('students.adviser_id', $id)
                // Also pull the students of this teacher's section. A student
                // can still point at an adviser from another grade (legacy
                // rows created before the adviser existed), which is why a
                // newly added "Grade 2 - B" teacher used to see an empty class.
                ->orWhere('students.grade_section', $teacher['grade_section'])
            ->groupEnd();
        if ($search !== '') {
            $query->groupStart()
                ->like('students.fname', $search)
                ->orLike('students.lname', $search)
                ->orLike('students.mname', $search)
                ->groupEnd();
        }
        $students = $query->orderBy('students.lname', 'ASC')
            ->get()
            ->getResultArray();

        $studentIds = array_column($students, 'id');

        // Selected date's release status per student
        $releasedIds = [];
        // PER-SESSION map: a student can be released TWICE in one day
        // (morning + afternoon). The old code did
        //     $releasedIds[$sid] = $l;   // ORDER BY time ASC
        // so the LAST row (afternoon) silently overwrote the morning one and
        // only one session was ever visible. Keep one entry per session.
        $releasedBySession = [];
        $recentHistory = [];
        if (!empty($studentIds)) {
            $dateLogs = $db->table('fetch_logs')
                ->select('student_id, time_released, session_type')
                ->where('DATE(time_released)', $selectedDate)
                ->whereIn('student_id', $studentIds)
                ->orderBy('time_released', 'ASC')
                ->get()
                ->getResultArray();
            foreach ($dateLogs as $l) {
                $releasedIds[$l['student_id']] = $l;
                $ses = $l['session_type'] ?: null;
                if ($ses !== null) {
                    $releasedBySession[$l['student_id']][$ses] = $l['time_released'];
                }
            }

            // Recent pickup history per student (last 30 days)
            $historyLogs = $db->table('fetch_logs')
                ->select('student_id, time_released, session_type, fetcher_fname, fetcher_mname, fetcher_lname, method')
                ->where('DATE(time_released) >=', date('Y-m-d', strtotime('-30 days')))
                ->whereIn('student_id', $studentIds)
                ->orderBy('time_released', 'DESC')
                ->get()
                ->getResultArray();
            foreach ($historyLogs as $hl) {
                $recentHistory[$hl['student_id']][] = $hl;
            }
        }

        $rows = [];
        foreach ($students as $s) {
            $parents = $db->table('student_parents')
                ->select('parents.id, parents.fname, parents.mname, parents.lname, parents.phone')
                ->join('parents', 'parents.id = student_parents.parent_id', 'inner')
                ->where('student_parents.student_id', $s['id'])
                ->get()
                ->getResultArray();

            $s['released'] = isset($releasedIds[$s['id']]);
            $s['released_time'] = $releasedIds[$s['id']]['time_released'] ?? null;
            $s['released_session'] = $releasedIds[$s['id']]['session_type'] ?? null;
            $s['released_sessions'] = $releasedBySession[$s['id']] ?? [];
            $s['recent_history'] = $recentHistory[$s['id']] ?? [];

            $rows[] = [
                'student' => $s,
                'parents' => $parents
            ];
        }

        $data['teacher'] = $teacher;
        $data['rows'] = $rows;
        $data['releasedToday'] = count($releasedIds);
        $data['pendingToday'] = count($studentIds) - count($releasedIds);
        $data['selectedDate'] = $selectedDate;
        $data['search'] = $search;
        return view('teachers_view', $data);
    }

    // ===== TEACHER SELF-SERVICE: View student details (read-only) =====
    public function studentView($id)
    {
        if (session('role') != 'teacher') {
            return redirect()->to('/dashboard');
        }

        $db = \Config\Database::connect();
        $gradeSection = session('grade_section');

        $student = $db->table('students')->where('id', $id)->get()->getRowArray();
        if (!$student) {
            return redirect()->to('/teachers-view/' . session('user_id'))->with('error', 'Student not found');
        }

        // Teachers can only view their own students. A student belongs to the
        // teacher when they are the adviser, or when the student sits in the
        // teacher's grade/section (covers legacy rows whose adviser_id still
        // points at an unrelated teacher).
        $isOwn = ((int) ($student['adviser_id'] ?? 0)) === (int) session('user_id');
        if (!$isOwn && $gradeSection !== null && $student['grade_section'] === $gradeSection) {
            $isOwn = true;
        }
        if (!$isOwn) {
            return redirect()->to('/teachers-view/' . session('user_id'))->with('error', 'You can only view students in your class.');
        }

        $parents = $db->table('student_parents')
            ->select('parents.*, student_parents.relation')
            ->join('parents', 'parents.id = student_parents.parent_id')
            ->where('student_parents.student_id', $id)
            ->get()
            ->getResultArray();

        $subFetchers = $db->table('sub_fetchers')
            ->where('student_id', $id)
            ->get()
            ->getResultArray();

        $data['student'] = $student;
        $data['parents'] = $parents;
        $data['subFetchers'] = $subFetchers;

        return view('teachers_student_view', $data);
    }

    // ===== TEACHER SELF-SERVICE: SMS they received (like the parent module) =====
    public function notifications()
    {
        if (session('role') != 'teacher') {
            return redirect()->to('/dashboard');
        }

        $db = \Config\Database::connect();
        $teacherPhone = session('phone');
        $data['smsNotifications'] = [];

        if (!empty($teacherPhone)) {
            $smsLogs = $db->table('sms_logs')
                ->select('sms_logs.*')
                ->where('parent_phone', $teacherPhone)
                ->orderBy('sent_at', 'DESC')
                ->limit(50)
                ->get()
                ->getResultArray();

            foreach ($smsLogs as &$log) {
                $message = $log['message'] ?? '';
                $log['student_fname'] = 'Unknown';
                $log['student_lname'] = '';
                $log['grade_section'] = '';

                if (preg_match('/Your child ([^\s]+) ([^\s]+)/i', $message, $matches)) {
                    $log['student_fname'] = $matches[1];
                    $log['student_lname'] = $matches[2] ?? '';
                } elseif (preg_match('/for ([^\s]+) ([^\s]+) \(([^)]+)\)/i', $message, $matches)) {
                    $log['student_fname'] = $matches[1];
                    $log['student_lname'] = $matches[2] ?? '';
                    $log['grade_section'] = $matches[3] ?? '';
                } elseif (preg_match('/child ([^\s]+) ([^\s]+)/i', $message, $matches)) {
                    $log['student_fname'] = $matches[1];
                    $log['student_lname'] = $matches[2] ?? '';
                } elseif (preg_match('/for ([^\s]+) ([^\s]+)/i', $message, $matches)) {
                    $log['student_fname'] = $matches[1];
                    $log['student_lname'] = $matches[2] ?? '';
                }
            }
            $data['smsNotifications'] = $smsLogs;
        }

        return view('teachers_notifications', $data);
    }

    // ===== DELETE OWN SMS NOTIFICATION =====
    public function deleteNotification($id)
    {
        $db = \Config\Database::connect();
        $teacherPhone = session('phone');

        if (empty($teacherPhone)) {
            return redirect()->to('/teachers-notifications')->with('error', 'No phone number linked to your account.');
        }

        $deleted = $db->table('sms_logs')
            ->where('id', $id)
            ->where('parent_phone', $teacherPhone)
            ->delete();

        if ($deleted) {
            $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'delete', 'sms_notification', 'Deleted SMS notification (ID: '.$id.')');
            return redirect()->to('/teachers-notifications')->with('msg', 'SMS notification deleted.');
        }
        return redirect()->to('/teachers-notifications')->with('error', 'Notification not found. You can only delete your own notifications.');
    }

    // ===== CLEAR ALL OWN SMS NOTIFICATIONS =====
    public function clearAllNotifications()
    {
        $db = \Config\Database::connect();
        $teacherPhone = session('phone');

        if (empty($teacherPhone)) {
            return redirect()->to('/teachers-notifications')->with('error', 'No phone number linked to your account.');
        }

        $deleted = $db->table('sms_logs')->where('parent_phone', $teacherPhone)->delete();
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'delete', 'sms_notification', 'Cleared all SMS notifications for phone '.$teacherPhone);
        return redirect()->to('/teachers-notifications')->with('msg', 'All SMS notifications cleared.');
    }

    public function save()
    {
        if (session('role') != 'admin' && session('role') != 'staff') {
            return redirect()->to('/dashboard');
        }
        $model = new TeachersModel();

        $phone = trim($this->request->getPost('phone'));
        $existing = $model->where('phone', $phone)->first();
        if ($existing) {
            return redirect()->to('/teachers')->with('error', 'A teacher with that phone number already exists');
        }

        // Teacher ID: use what the registrar typed, otherwise auto-assign T-####.
        $teacherNo = strtoupper(trim((string) $this->request->getPost('teacher_no')));
        if ($teacherNo === '') {
            $teacherNo = $model->nextTeacherNo();
        } elseif (! str_starts_with($teacherNo, 'T-')) {
            $teacherNo = preg_match('/(\d+)$/', $teacherNo, $m) ? 'T-' . $m[1] : 'T-' . $teacherNo;
        }
        if ($model->where('teacher_no', $teacherNo)->first()) {
            return redirect()->to('/teachers')->with('error', 'Teacher ID ' . $teacherNo . ' is already taken.');
        }

        $teacherId = $model->save([
            'teacher_no' => $teacherNo,
            'fname' => $this->request->getPost('fname'),
            'mname' => $this->request->getPost('mname'),
            'lname' => $this->request->getPost('lname'),
            'phone' => $phone,
            'grade_section' => $this->request->getPost('grade_section'),
            'password' => null,
            'password_sent' => 0,
            'created_by' => session('user_id'),
        ]);
        // Absorb any existing students in this grade that had no adviser.
        $claimed = $this->claimUnassignedStudents((int) $teacherId, $this->request->getPost('grade_section'));

        // Profile picture captured in the Add Teacher modal.
        helper('photo');
        $__pic = (string) $this->request->getPost('teacher_picture_data');
        if ($__pic !== '' && $teacherId) {
            photo_save_teacher_dataurl($__pic, $teacherNo);
        }
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'create', 'teacher', 'Created teacher: '.$this->request->getPost('fname').' '.$this->request->getPost('lname').' ('.trim($this->request->getPost('grade_section')).')'.$claimed);
        return redirect()->to('/teachers')->with('msg', 'Teacher added'.$claimed);
    }

    public function update()
    {
        if (session('role') != 'admin' && session('role') != 'staff') {
            return redirect()->to('/dashboard');
        }
        $model = new TeachersModel();
        $id = $this->request->getPost('id');
        $data = [
            'fname' => $this->request->getPost('fname'),
            'mname' => $this->request->getPost('mname'),
            'lname' => $this->request->getPost('lname'),
            'phone' => $this->request->getPost('phone'),
            'grade_section' => $this->request->getPost('grade_section'),
        ];
        $teacherNo = strtoupper(trim((string) $this->request->getPost('teacher_no')));
        if ($teacherNo !== '') {
            $data['teacher_no'] = $teacherNo;
        }
        $model->update($id, $data);

        // ===== Teacher profile picture (add / change / remove) =====
        helper('photo');
        $teacher = $model->find($id);
        $tNo     = (string) ($teacher['teacher_no'] ?? '');
        $pic     = (string) $this->request->getPost('teacher_picture_data');
        if ($pic !== '' && $tNo !== '') {
            photo_save_teacher_dataurl($pic, $tNo);
        } elseif ((string) $this->request->getPost('teacher_picture_remove') === '1' && $tNo !== '') {
            teacher_photo_delete($tNo);
        }
        // Re-link unassigned students if grade_section changed.
        $claimed = $this->claimUnassignedStudents((int) $id, $data['grade_section']);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'update', 'teacher', 'Updated teacher: '.$data['fname'].' '.$data['lname'].' (ID: '.$id.')'.$claimed);
        return redirect()->to('/teachers')->with('msg', 'Teacher updated'.$claimed);
    }

    /**
     * Attach the students of $gradeSection to $teacherId.
     *
     * Only "adviser_id IS NULL" was adopted before, so a section whose
     * students had been stamped with some other teacher's id (the usual
     * state of a brand-new section) never moved over. Students are now
     * re-stamped when their current adviser does not actually handle this
     * grade/section.
     *
     * Returns a short suffix for flash/log, e.g. " (+12 students linked)".
     */
    private function claimUnassignedStudents(int $teacherId, ?string $gradeSection): string
    {
        $gradeSection = trim((string) $gradeSection);
        if ($teacherId <= 0 || $gradeSection === '') {
            return '';
        }

        $db = \Config\Database::connect();

        // Teachers that legitimately own this grade/section keep their
        // students. Any other adviser id on a student of this section is
        // considered stale and is replaced.
        $validAdvisers = array_map('intval', array_column(
            $db->table('teachers')->select('id')->where('grade_section', $gradeSection)->get()->getResultArray(),
            'id'
        ));
        $validAdvisers[] = $teacherId;
        $validAdvisers = array_values(array_unique($validAdvisers));

        $builder = $db->table('students')->where('grade_section', $gradeSection);
        $builder->groupStart()->where('adviser_id IS NULL', null, false);
        if (!empty($validAdvisers)) {
            $builder->orWhereNotIn('adviser_id', $validAdvisers);
        }
        $builder->groupEnd()->update(['adviser_id' => $teacherId]);

        $n = $db->affectedRows();
        return $n > 0 ? " (+$n student(s) linked)" : '';
    }

    public function delete($id)
    {
        if (session('role') != 'admin' && session('role') != 'staff') {
            return redirect()->to('/dashboard');
        }
        $model = new TeachersModel();
        $teacher = $model->find($id);
        $model->delete($id);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'delete', 'teacher', 'Deleted teacher: '.$teacher['fname'].' '.$teacher['lname'].' (ID: '.$id.')');
        return redirect()->to('/teachers')->with('msg', 'Teacher deleted');
    }

    // ========== DELETE ALL TEACHERS (ADMIN ONLY) ==========
    public function deleteAll()
    {
        if (session('role') != 'admin') {
            return redirect()->to('/teachers')->with('error', 'Admin only.');
        }
        $model = new TeachersModel();
        $count = $model->countAllResults();
        $model->truncate();
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'delete', 'teacher', "DELETED ALL teachers ($count accounts)");
        return redirect()->to('/teachers')->with('msg', "All $count teacher(s) deleted.");
    }

    public function sendPassword($id)
    {
        if (! $this->requireAdminStaff()) return;
        $model = new TeachersModel();
        $teacher = $model->find($id);
        if (! $teacher) {
            return redirect()->to('/teachers')->with('error', 'Teacher not found');
        }
        $this->deliverPassword($model, $teacher, 'teacher');
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'update', 'teacher', 'Reset password for teacher: '.$teacher['fname'].' '.$teacher['lname'].' (ID: '.$id.')');
        return redirect()->to('/teachers')->with('msg', 'New password sent via SMS (recorded in SMS logs)');
    }

    // ===== SEND PASSWORD TO ALL TEACHERS NOT YET SENT =====
    public function sendAllPasswords()
    {
        if (! $this->requireAdminStaff()) return;
        $model = new TeachersModel();
        $pending = $model->where('password_sent', 0)->findAll();
        $sent = 0;
        foreach ($pending as $t) {
            $this->deliverPassword($model, $t, 'teacher');
            $sent++;
        }
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'update', 'teacher', "Sent passwords to $sent teacher(s) who had not received one yet.");
        return redirect()->to('/teachers')->with('msg', "Passwords sent to $sent teacher(s).");
    }

    private function gradeSections()
    {
        $db = \Config\Database::connect();
        $fromStudents = $db->table('students')->distinct()->select('grade_section')->get()->getResultArray();
        $fromTeachers = $db->table('teachers')->distinct()->select('grade_section')->get()->getResultArray();

        $sections = [];
        foreach (array_merge($fromStudents, $fromTeachers) as $row) {
            $sections[$row['grade_section']] = $row['grade_section'];
        }
        ksort($sections);
        return $sections;
    }
}