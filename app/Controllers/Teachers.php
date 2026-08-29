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
        $students = $db->table('students')
            ->select('students.*')
            ->where('students.grade_section', $teacher['grade_section'])
            ->orderBy('students.lname', 'ASC')
            ->get()
            ->getResultArray();

        // Today's release status per student -> "who went home / who is still at school".
        $releasedIds = [];
        if (!empty($students)) {
            $todayLogs = $db->table('fetch_logs')
                ->select('student_id, time_released')
                ->where('DATE(time_released)', date('Y-m-d'))
                ->whereIn('student_id', array_column($students, 'id'))
                ->orderBy('time_released', 'ASC')
                ->get()
                ->getResultArray();
            foreach ($todayLogs as $l) {
                $releasedIds[$l['student_id']] = $l;
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

            $rows[] = [
                'student' => $s,
                'parents' => $parents
            ];
        }

        $data['teacher'] = $teacher;
        $data['rows'] = $rows;
        $data['releasedToday'] = count($releasedIds);
        $data['pendingToday'] = count($students) - count($releasedIds);
        return view('teachers_view', $data);
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
        $password = $this->generatePassword();

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
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'picture' => $this->saveUploadedPicture('teachers'),
            'created_by' => session('user_id'),
        ]);
        $this->sendLocalSms(
            $phone,
            'Your Scan2Fetch teacher account password is: ' . $password . ' (recorded in SMS logs).'
        );
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
        if (session('role') != 'admin' && session('role') != 'staff') {
            return redirect()->to('/dashboard');
        }
        $model = new TeachersModel();
        $teacher = $model->find($id);
        if (!$teacher) {
            return redirect()->to('/teachers')->with('error', 'Teacher not found');
        }
        $password = $this->generatePassword();
        $model->update($id, ['password' => password_hash($password, PASSWORD_DEFAULT)]);
        $this->sendLocalSms(
            $teacher['phone'],
            'Your new Scan2Fetch teacher account password is: ' . $password . ' (recorded in SMS logs).'
        );
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'update', 'teacher', 'Reset password for teacher: '.$teacher['fname'].' '.$teacher['lname'].' (ID: '.$id.')');
        return redirect()->to('/teachers')->with('msg', 'New password sent via SMS (recorded in SMS logs)');
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