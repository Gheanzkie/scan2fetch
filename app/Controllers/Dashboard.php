<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login');
        }

        $role   = session('role');
        $userId = session('user_id');
        $today  = date('Y-m-d');

        $data = ['title' => 'Dashboard'];

        // ========== ADMIN ==========
        if ($role == 'admin') {
            $data['totalStudents']  = $this->db->table('students')->countAllResults();
            $data['totalParents']   = $this->db->table('parents')->countAllResults();
            $data['totalStaff']     = $this->db->table('staffs')->countAllResults();
            $data['releasedToday']  = $this->db->table('fetch_logs')->where('DATE(time_released)', $today)->countAllResults();
            $data['pendingAuth']    = $this->db->table('authorization_letters')->where('status', 'pending')->countAllResults();
            $data['smsSentToday']   = $this->db->table('sms_logs')->where('DATE(sent_at)', $today)->countAllResults();
            $data['qrReleases']     = $this->db->table('fetch_logs')->where('method', 'QR')->countAllResults();
            $data['recentReleases'] = $this->db->table('fetch_logs')
                ->select('fetch_logs.*, students.fname as sfname, students.lname as slname, staffs.fname as staff_fname')
                ->join('students', 'students.id = fetch_logs.student_id')
                ->join('staffs', 'staffs.id = fetch_logs.staff_id', 'left')
                ->orderBy('time_released', 'DESC')->limit(10)->get()->getResultArray();
            $data['smsLogs'] = $this->db->table('sms_logs')->orderBy('sent_at', 'DESC')->limit(10)->get()->getResultArray();
        }

        // ========== STAFF ==========
        if ($role == 'staff') {
            $data['totalStudents']     = $this->db->table('students')->countAllResults();
            $data['releasedToday']     = $this->db->table('fetch_logs')->where('staff_id', $userId)->where('DATE(time_released)', $today)->countAllResults();
            $data['smsSentToday']      = $this->db->table('sms_logs')->where('DATE(sent_at)', $today)->countAllResults();
            $data['pendingAuthLetters'] = $this->db->table('authorization_letters')
                ->select('authorization_letters.*, students.fname as sfname, students.lname as slname')
                ->join('students', 'students.id = authorization_letters.student_id')
                ->where('authorization_letters.status', 'pending')->get()->getResultArray();
            $data['todayReleases'] = $this->db->table('fetch_logs')
                ->select('fetch_logs.*, students.fname as sfname, students.lname as slname')
                ->join('students', 'students.id = fetch_logs.student_id')
                ->where('fetch_logs.staff_id', $userId)->where('DATE(fetch_logs.time_released)', $today)
                ->orderBy('time_released', 'DESC')->get()->getResultArray();
        }

        // ========== PARENT ==========
        if ($role == 'parent') {
            $data['parentProfile'] = $this->db->table('parents')->where('id', $userId)->get()->getRowArray();
            $data['myChildren']    = $this->db->table('students')->where('parent_id', $userId)->get()->getResultArray();
        }

        return view('dashboard', $data);
    }
}