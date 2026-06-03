<?php

namespace App\Controllers;

use App\Models\ActivityLogModel;

class Scan extends BaseController
{
    protected $db;
    protected $logModel;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->logModel = new ActivityLogModel();
        if (!session('logged_in') || !in_array(session('role'), ['admin', 'staff'])) {
            return redirect()->to('/dashboard');
        }
    }

    public function index()
    {
        return view('scan');
    }

    public function verify()
    {
        $qrCode = trim($this->request->getPost('qr_code'));

        // Check parents table
        $parent = $this->db->table('parents')->where('qr_code', $qrCode)->get()->getRowArray();
        $fetcher = null;

        // Check sub_fetchers table
        if (!$parent) {
            $subFetcher = $this->db->table('sub_fetchers')->where('qr_code', $qrCode)->get()->getRowArray();
            if ($subFetcher) {
                $parent = $this->db->table('parents')->where('id', $subFetcher['parent_id'])->get()->getRowArray();
                $fetcher = [
                    'fname' => $subFetcher['fname'],
                    'lname' => $subFetcher['lname'],
                    'phone' => $subFetcher['phone'],
                    'type'  => 'Sub-Fetcher'
                ];
            }
        }

        if (!$parent) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid QR Code']);
        }

        if (!$fetcher) {
            $fetcher = [
                'fname' => $parent['fname'],
                'lname' => $parent['lname'],
                'phone' => $parent['phone'],
                'type'  => 'Main Parent'
            ];
        }

        // Get students
        $students = $this->db->table('student_parents')
            ->select('students.*, student_parents.relation')
            ->join('students', 'students.id = student_parents.student_id')
            ->where('student_parents.parent_id', $parent['id'])
            ->get()->getResultArray();

        return $this->response->setJSON([
            'success'  => true,
            'parent'   => [
                'id'      => $parent['id'],
                'fname'   => $parent['fname'],
                'lname'   => $parent['lname'],
                'phone'   => $parent['phone'],
                'picture' => $parent['picture']
            ],
            'fetcher'  => $fetcher,
            'students' => $students
        ]);
    }

    public function release()
    {
        $studentId = $this->request->getPost('student_id');
        $parentId  = $this->request->getPost('parent_id');
        $staffId   = session('user_id');

        $parent  = $this->db->table('parents')->where('id', $parentId)->get()->getRowArray();
        $student = $this->db->table('students')->where('id', $studentId)->get()->getRowArray();

        if (!$parent || !$student) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data not found']);
        }

        $this->db->table('fetch_logs')->insert([
            'student_id'       => $studentId,
            'parent_id'        => $parentId,
            'fetcher_fname'    => $parent['fname'],
            'fetcher_mname'    => $parent['mname'],
            'fetcher_lname'    => $parent['lname'],
            'fetcher_relation' => 'Parent',
            'method'           => 'QR',
            'staff_id'         => $staffId,
        ]);

        $message = "Your child {$student['fname']} {$student['lname']} has been released at " . date('h:i A') . ". - BCC Scan2Fetch";
        $this->db->table('sms_logs')->insert(['parent_phone' => $parent['phone'], 'message' => $message, 'status' => 'sent']);

        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'release', 'scan', 'QR Release | Student: '.$student['fname'].' '.$student['lname'].' (ID: '.$studentId.') | SMS sent');

        return $this->response->setJSON(['success' => true, 'message' => 'Student released! SMS sent.']);
    }

    public function decline()
    {
        $studentId = $this->request->getPost('student_id');
        $parentId  = $this->request->getPost('parent_id');

        $parent  = $this->db->table('parents')->where('id', $parentId)->get()->getRowArray();
        $student = $this->db->table('students')->where('id', $studentId)->get()->getRowArray();

        if (!$parent || !$student) {
            return $this->response->setJSON(['success' => false, 'message' => 'Data not found']);
        }

        $message = "Pickup attempt for {$student['fname']} {$student['lname']} has been DECLINED at " . date('h:i A') . ". - BCC Scan2Fetch";
        $this->db->table('sms_logs')->insert(['parent_phone' => $parent['phone'], 'message' => $message, 'status' => 'sent']);

        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'decline', 'scan', 'DECLINED | Student: '.$student['fname'].' '.$student['lname'].' (ID: '.$studentId.') | SMS sent');

        return $this->response->setJSON(['success' => true, 'message' => 'Declined. SMS sent.']);
    }
}