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
        if (session('role') != 'admin' && session('role') != 'staff') {
            return redirect()->to('/dashboard');
        }
        $model = new TeachersModel();
        $teachers = $model->orderBy('created_at', 'DESC')->findAll();

        $counts = [];
        foreach ($model->studentCounts() as $row) {
            $counts[$row['grade_section']] = (int) $row['total'];
        }

        $data['teachers'] = $teachers;
        $data['studentCounts'] = $counts;
        $data['gradeSections'] = $this->gradeSections();
        return view('teachers', $data);
    }

    public function view($id)
    {
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
            ->where('students.grade_section', $teacher['grade_section']);
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
        $recentHistory = [];
        if (!empty($studentIds)) {
            $dateLogs = $db->table('fetch_logs')
                ->select('student_id, time_released')
                ->where('DATE(time_released)', $selectedDate)
                ->whereIn('student_id', $studentIds)
                ->orderBy('time_released', 'ASC')
                ->get()
                ->getResultArray();
            foreach ($dateLogs as $l) {
                $releasedIds[$l['student_id']] = $l;
            }

            // Recent pickup history per student (last 30 days)
            $historyLogs = $db->table('fetch_logs')
                ->select('student_id, time_released, fetcher_fname, fetcher_lname, method')
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

        // Teachers can only view students in their grade section
        if ($student['grade_section'] !== $gradeSection) {
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

        // Recent pickup history
        $pickupHistory = $db->table('fetch_logs')
            ->select('fetch_logs.*, parents.fname AS parent_fname, parents.lname AS parent_lname')
            ->join('parents', 'parents.id = fetch_logs.parent_id', 'left')
            ->where('fetch_logs.student_id', $id)
            ->orderBy('fetch_logs.time_released', 'DESC')
            ->limit(20)
            ->get()
            ->getResultArray();

        $data['student'] = $student;
        $data['parents'] = $parents;
        $data['subFetchers'] = $subFetchers;
        $data['pickupHistory'] = $pickupHistory;
        $data['teacherId'] = session('user_id');

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

        $model->save([
            'fname' => $this->request->getPost('fname'),
            'mname' => $this->request->getPost('mname'),
            'lname' => $this->request->getPost('lname'),
            'phone' => $phone,
            'grade_section' => $this->request->getPost('grade_section'),
            'password' => null,
            'password_sent' => 0,
            'picture' => $this->saveUploadedPicture('teachers'),
            'created_by' => session('user_id'),
        ]);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'create', 'teacher', 'Created teacher: '.$this->request->getPost('fname').' '.$this->request->getPost('lname').' ('.trim($this->request->getPost('grade_section')).')');
        return redirect()->to('/teachers')->with('msg', 'Teacher added');
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
        $picture = $this->saveUploadedPicture('teachers');
        if ($picture) {
            $data['picture'] = $picture;
        }
        $model->update($id, $data);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'update', 'teacher', 'Updated teacher: '.$data['fname'].' '.$data['lname'].' (ID: '.$id.')');
        return redirect()->to('/teachers')->with('msg', 'Teacher updated');
    }

    public function delete($id)
    {
        if (session('role') != 'admin' && session('role') != 'staff') {
            return redirect()->to('/dashboard');
        }
        $model = new TeachersModel();
        $teacher = $model->find($id);
        $model->delete($id);
        $this->deleteUploadedPicture('teachers', $teacher['picture'] ?? null);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'delete', 'teacher', 'Deleted teacher: '.$teacher['fname'].' '.$teacher['lname'].' (ID: '.$id.')');
        return redirect()->to('/teachers')->with('msg', 'Teacher deleted');
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