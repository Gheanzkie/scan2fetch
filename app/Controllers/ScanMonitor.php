<?php

namespace App\Controllers;

class ScanMonitor extends BaseController
{
    public function __construct()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }
    }

    public function index()
    {
        $db = \Config\Database::connect();
        $today = date('Y-m-d');

        // Stats
        $data['releasedToday'] = $db->table('fetch_logs')
            ->where('DATE(time_released)', $today)
            ->countAllResults();

        $data['declinedToday'] = $db->table('activity_logs')
            ->where('DATE(created_at)', $today)
            ->where('action', 'decline')
            ->where('module', 'scan')
            ->countAllResults();

        $data['pendingRelease'] = $db->table('students')
            ->countAllResults() - $data['releasedToday'];

        $data['totalScans'] = $db->table('activity_logs')
            ->where('DATE(created_at)', $today)
            ->where('module', 'scan')
            ->countAllResults();

        // Recent releases today
        $data['recentReleases'] = $db->table('fetch_logs')
            ->select('fetch_logs.*, students.fname as student_fname, students.lname as student_lname, students.grade_section')
            ->join('students', 'students.id = fetch_logs.student_id', 'left')
            ->where('DATE(fetch_logs.time_released)', $today)
            ->orderBy('fetch_logs.time_released', 'DESC')
            ->limit(20)
            ->get()
            ->getResultArray();

        // Scan activities today
        $data['scanActivities'] = $db->table('activity_logs')
            ->where('DATE(created_at)', $today)
            ->where('module', 'scan')
            ->orderBy('created_at', 'DESC')
            ->limit(30)
            ->get()
            ->getResultArray();

        // Students still inside (not released today)
        $releasedStudentIds = $db->table('fetch_logs')
            ->select('student_id')
            ->where('DATE(time_released)', $today)
            ->get()
            ->getResultArray();
        
        $releasedIds = array_column($releasedStudentIds, 'student_id');

        if (!empty($releasedIds)) {
            $data['studentsInside'] = $db->table('students')
                ->select('students.*, parents.fname as parent_fname, parents.lname as parent_lname')
                ->join('parents', 'parents.id = students.parent_id', 'left')
                ->whereNotIn('students.id', $releasedIds)
                ->orderBy('students.grade_section', 'ASC')
                ->get()
                ->getResultArray();
        } else {
            $data['studentsInside'] = $db->table('students')
                ->select('students.*, parents.fname as parent_fname, parents.lname as parent_lname')
                ->join('parents', 'parents.id = students.parent_id', 'left')
                ->orderBy('students.grade_section', 'ASC')
                ->get()
                ->getResultArray();
        }

        return view('scan_monitor', $data);
    }
}