<?php

namespace App\Controllers;

use App\Models\ParentsModel;
use App\Models\StudentModel;
use App\Models\SubFetcherModel;
use App\Models\ActivityLogModel;

class Scan extends BaseController
{
    public function index()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }
        
        return view('scan');
    }

    public function verify()
    {
        $qrCode = $this->request->getPost('qr_code');
        
        if (empty($qrCode)) {
            return $this->response->setJSON(['success' => false, 'message' => 'QR code is required']);
        }

        $parentsModel = new ParentsModel();
        $subFetcherModel = new SubFetcherModel();

        $parent = $parentsModel->where('qr_code', $qrCode)->first();
        $fetcher = null;
        $parentId = null;

        if ($parent) {
            $parentId = $parent['id'];
            $fetcher = [
                'type' => 'Main Parent',
                'fname' => $parent['fname'],
                'lname' => $parent['lname'],
                'phone' => $parent['phone'],
                'picture' => $parent['picture'] ?? null,
            ];
        } else {
            $subFetcher = $subFetcherModel->where('qr_code', $qrCode)->first();
            if ($subFetcher) {
                $parentId = $subFetcher['parent_id'];
                $parent = $parentsModel->find($parentId);
                $fetcher = [
                    'type' => 'Sub-Fetcher',
                    'fname' => $subFetcher['fname'],
                    'lname' => $subFetcher['lname'],
                    'phone' => $subFetcher['phone'],
                    'picture' => $subFetcher['picture'] ?? null,
                ];
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Invalid QR code']);
            }
        }

        if (!$parent) {
            return $this->response->setJSON(['success' => false, 'message' => 'Parent not found']);
        }

        $db = \Config\Database::connect();
        $students = $db->table('student_parents')
            ->select('student_parents.student_id, students.fname, students.lname, students.grade_section, students.picture')
            ->join('students', 'students.id = student_parents.student_id')
            ->where('student_parents.parent_id', $parentId)
            ->get()
            ->getResultArray();

        return $this->response->setJSON([
            'success' => true,
            'parent' => [
                'id' => $parent['id'],
                'fname' => $parent['fname'],
                'lname' => $parent['lname'],
                'phone' => $parent['phone'],
                'picture' => $parent['picture'] ?? null,
            ],
            'fetcher' => $fetcher,
            'students' => $students,
        ]);
    }

    public function release()
    {
        $studentId = $this->request->getPost('student_id');
        $parentId = $this->request->getPost('parent_id');

        if (empty($studentId) || empty($parentId)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Missing data']);
        }

        $db = \Config\Database::connect();
        $studentModel = new StudentModel();
        $parentsModel = new ParentsModel();
        $logModel = new ActivityLogModel();

        $student = $studentModel->find($studentId);
        if (!$student) {
            return $this->response->setJSON(['success' => false, 'message' => 'Student not found']);
        }

        $parent = $parentsModel->find($parentId);
        if (!$parent) {
            return $this->response->setJSON(['success' => false, 'message' => 'Parent not found']);
        }

        $userId = session('user_id');
        $userName = session('fname') . ' ' . session('lname');
        $userRole = session('role');

        // Insert fetch log
        $db->table('fetch_logs')->insert([
            'student_id'       => $studentId,
            'parent_id'        => $parentId,
            'fetcher_fname'    => $parent['fname'],
            'fetcher_mname'    => $parent['mname'] ?? '',
            'fetcher_lname'    => $parent['lname'],
            'fetcher_relation' => 'Parent',
            'method'           => 'QR',
            'time_released'    => date('Y-m-d H:i:s'),
        ]);

        // Insert SMS log
        $message = "Your child {$student['fname']} {$student['lname']} has been released at " . date('h:i A') . ". - BCC Scan2Fetch";
        $db->table('sms_logs')->insert([
            'parent_phone' => $parent['phone'],
            'message'      => $message,
            'status'       => 'sent',
        ]);

        // USE THE MODEL METHOD - same as CRUD operations
        $logModel->addLog(
            $userId,
            $userName,
            $userRole,
            'release',
            'scan',
            "QR Release | Student: {$student['fname']} {$student['lname']} (ID: {$studentId}) | SMS sent"
        );

        return $this->response->setJSON(['success' => true, 'message' => 'Student released successfully']);
    }

    public function decline()
    {
        $studentId = $this->request->getPost('student_id');
        $parentId = $this->request->getPost('parent_id');

        if (empty($studentId) || empty($parentId)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Missing data']);
        }

        $db = \Config\Database::connect();
        $studentModel = new StudentModel();
        $parentsModel = new ParentsModel();
        $logModel = new ActivityLogModel();

        $student = $studentModel->find($studentId);
        if (!$student) {
            return $this->response->setJSON(['success' => false, 'message' => 'Student not found']);
        }

        $parent = $parentsModel->find($parentId);
        if (!$parent) {
            return $this->response->setJSON(['success' => false, 'message' => 'Parent not found']);
        }

        $userId = session('user_id');
        $userName = session('fname') . ' ' . session('lname');
        $userRole = session('role');

        // Insert SMS log
        $message = "Pickup attempt for {$student['fname']} {$student['lname']} has been DECLINED at " . date('h:i A') . ". - BCC Scan2Fetch";
        $db->table('sms_logs')->insert([
            'parent_phone' => $parent['phone'],
            'message'      => $message,
            'status'       => 'sent',
        ]);

        // USE THE MODEL METHOD - same as CRUD operations
        $logModel->addLog(
            $userId,
            $userName,
            $userRole,
            'decline',
            'scan',
            "DECLINED | Student: {$student['fname']} {$student['lname']} (ID: {$studentId}) | SMS sent"
        );

        return $this->response->setJSON(['success' => true, 'message' => 'Pickup declined. SMS sent.']);
    }
}