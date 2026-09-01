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
        $fetcherType = '';

        if ($parent) {
            $parentId = $parent['id'];
            $fetcherType = 'Parent';
            $fetcher = [
                'type' => 'Main Parent',
                'fname' => $parent['fname'],
                'lname' => $parent['lname'],
                'phone' => $parent['phone'],
                'picture' => $parent['picture'] ?? null,
                'id' => $parent['id'],
            ];
        } else {
            $subFetcher = $subFetcherModel->where('qr_code', $qrCode)->first();
            if ($subFetcher) {
                $parentId = $subFetcher['parent_id'];
                $parent = $parentsModel->find($parentId);
                $fetcherType = 'Sub-Fetcher';
                $fetcher = [
                    'type' => 'Sub-Fetcher',
                    'fname' => $subFetcher['fname'],
                    'lname' => $subFetcher['lname'],
                    'phone' => $subFetcher['phone'],
                    'picture' => $subFetcher['picture'] ?? null,
                    'id' => $subFetcher['id'],
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
            'fetcher_type' => $fetcherType,
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
        $subFetcherModel = new SubFetcherModel();
        $logModel = new ActivityLogModel();

        $student = $studentModel->find($studentId);
        if (!$student) {
            return $this->response->setJSON(['success' => false, 'message' => 'Student not found']);
        }

        $parent = $parentsModel->find($parentId);
        if (!$parent) {
            return $this->response->setJSON(['success' => false, 'message' => 'Parent not found']);
        }

        // Prevent duplicate release: if this student was already released today, skip.
        $alreadyReleased = $db->table('fetch_logs')
            ->where('student_id', $studentId)
            ->where('DATE(time_released)', date('Y-m-d'))
            ->countAllResults();
        if ($alreadyReleased > 0) {
            return $this->response->setJSON([
                'success' => false,
                'already_released' => true,
                'message' => $student['fname'] . ' ' . $student['lname'] . ' is already released today.'
            ]);
        }

        // Check if fetcher is sub-fetcher or parent
        $fetcherFname = $parent['fname'];
        $fetcherLname = $parent['lname'];
        $fetcherRelation = 'Parent';
        
        // Check if there's a sub-fetcher with this QR code
        $qrCode = $this->request->getPost('qr_code') ?? '';
        if (!empty($qrCode)) {
            $subFetcher = $subFetcherModel->where('qr_code', $qrCode)->first();
            if ($subFetcher) {
                $fetcherFname = $subFetcher['fname'];
                $fetcherLname = $subFetcher['lname'];
                $fetcherRelation = 'Sub-Fetcher';
            }
        }

        $userId = session('user_id');
        $userName = session('fname') . ' ' . session('lname');
        $userRole = session('role');

        // Insert fetch log
        $db->table('fetch_logs')->insert([
            'student_id'       => $studentId,
            'parent_id'        => $parentId,
            'fetcher_fname'    => $fetcherFname,
            'fetcher_mname'    => '',
            'fetcher_lname'    => $fetcherLname,
            'fetcher_relation' => $fetcherRelation,
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

        // Log with fetcher name
        $logModel->addLog(
            $userId,
            $userName,
            $userRole,
            'release',
            'scan',
            "QR Release | Student: {$student['fname']} {$student['lname']} (ID: {$studentId}) | {$fetcherRelation}: {$fetcherFname} {$fetcherLname} | SMS sent"
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
        $subFetcherModel = new SubFetcherModel();
        $logModel = new ActivityLogModel();

        $student = $studentModel->find($studentId);
        if (!$student) {
            return $this->response->setJSON(['success' => false, 'message' => 'Student not found']);
        }

        $parent = $parentsModel->find($parentId);
        if (!$parent) {
            return $this->response->setJSON(['success' => false, 'message' => 'Parent not found']);
        }

        // Check if fetcher is sub-fetcher or parent
        $fetcherFname = $parent['fname'];
        $fetcherLname = $parent['lname'];
        $fetcherRelation = 'Parent';
        
        // Check if there's a sub-fetcher with this QR code
        $qrCode = $this->request->getPost('qr_code') ?? '';
        if (!empty($qrCode)) {
            $subFetcher = $subFetcherModel->where('qr_code', $qrCode)->first();
            if ($subFetcher) {
                $fetcherFname = $subFetcher['fname'];
                $fetcherLname = $subFetcher['lname'];
                $fetcherRelation = 'Sub-Fetcher';
            }
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

        // Log with fetcher name
        $logModel->addLog(
            $userId,
            $userName,
            $userRole,
            'decline',
            'scan',
            "DECLINED | Student: {$student['fname']} {$student['lname']} (ID: {$studentId}) | {$fetcherRelation}: {$fetcherFname} {$fetcherLname} | SMS sent"
        );

        return $this->response->setJSON(['success' => true, 'message' => 'Pickup declined. SMS sent.']);
    }
}