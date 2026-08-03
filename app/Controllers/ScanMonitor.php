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
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }

        $db = \Config\Database::connect();
        
        // Get selected date
        $selectedDate = $this->request->getGet('date') ?? date('Y-m-d');
        $isToday = ($selectedDate == date('Y-m-d'));
        
        // Get filter parameters
        $search = $this->request->getGet('search') ?? '';
        $grade = $this->request->getGet('grade') ?? '';
        $tab = $this->request->getGet('tab') ?? 'released';
        
        // ===== STATS =====
        // Released count
        $data['releasedToday'] = $db->table('fetch_logs')
            ->where('DATE(time_released)', $selectedDate)
            ->countAllResults();

        // Declined count
        $data['declinedToday'] = $db->table('activity_logs')
            ->where('DATE(created_at)', $selectedDate)
            ->where('action', 'decline')
            ->where('module', 'scan')
            ->countAllResults();

        // ===== PENDING COUNT (FIXED - No Negative) =====
        $totalStudents = $db->table('students')->countAllResults();
        
        // Get released student IDs
        $releasedStudentIds = $db->table('fetch_logs')
            ->select('student_id')
            ->where('DATE(time_released)', $selectedDate)
            ->get()
            ->getResultArray();
        
        $releasedIds = array_column($releasedStudentIds, 'student_id');
        
        // Count pending students (not released)
        if (!empty($releasedIds)) {
            $data['pendingCount'] = $db->table('students')
                ->whereNotIn('id', $releasedIds)
                ->countAllResults();
        } else {
            $data['pendingCount'] = $totalStudents;
        }

        // ===== PENDING STUDENTS =====
        $releasedIds = $db->table('fetch_logs')
            ->select('student_id')
            ->where('DATE(time_released)', $selectedDate)
            ->get()
            ->getResultArray();
        
        $releasedIdArray = array_column($releasedIds, 'student_id');

        $pendingBuilder = $db->table('students');
        $pendingBuilder->select('students.*, GROUP_CONCAT(DISTINCT CONCAT(parents.fname, " ", parents.lname) SEPARATOR ", ") as parent_names, GROUP_CONCAT(DISTINCT parents.phone SEPARATOR ", ") as parent_phones');
        $pendingBuilder->join('student_parents', 'student_parents.student_id = students.id', 'left');
        $pendingBuilder->join('parents', 'parents.id = student_parents.parent_id', 'left');
        
        if (!empty($releasedIdArray)) {
            $pendingBuilder->whereNotIn('students.id', $releasedIdArray);
        }
        
        if (!empty($search)) {
            $pendingBuilder->groupStart()
                ->like('students.fname', $search)
                ->orLike('students.lname', $search)
                ->orLike('students.grade_section', $search)
                ->groupEnd();
        }
        
        if (!empty($grade)) {
            $pendingBuilder->where('students.grade_section', $grade);
        }
        
        $pendingBuilder->groupBy('students.id');
        $pendingBuilder->orderBy('students.grade_section', 'ASC');
        $data['pendingStudents'] = $pendingBuilder->get()->getResultArray();

        // ===== RELEASED STUDENTS =====
        $releasedBuilder = $db->table('fetch_logs');
        $releasedBuilder->select('fetch_logs.*, students.fname as student_fname, students.lname as student_lname, students.grade_section');
        $releasedBuilder->join('students', 'students.id = fetch_logs.student_id', 'left');
        $releasedBuilder->where('DATE(fetch_logs.time_released)', $selectedDate);
        
        if (!empty($search)) {
            $releasedBuilder->groupStart()
                ->like('students.fname', $search)
                ->orLike('students.lname', $search)
                ->orLike('students.grade_section', $search)
                ->orLike('fetch_logs.fetcher_fname', $search)
                ->orLike('fetch_logs.fetcher_lname', $search)
                ->groupEnd();
        }
        
        if (!empty($grade)) {
            $releasedBuilder->where('students.grade_section', $grade);
        }
        
        $releasedBuilder->orderBy('fetch_logs.time_released', 'DESC');
        $data['releasedStudents'] = $releasedBuilder->get()->getResultArray();

        // ===== DECLINED STUDENTS =====
        $declinedBuilder = $db->table('activity_logs');
        $declinedBuilder->select('activity_logs.*');
        $declinedBuilder->where('DATE(activity_logs.created_at)', $selectedDate);
        $declinedBuilder->where('action', 'decline');
        $declinedBuilder->where('module', 'scan');
        
        if (!empty($search)) {
            $declinedBuilder->like('description', $search);
        }
        
        $declinedBuilder->orderBy('activity_logs.created_at', 'DESC');
        $declinedResults = $declinedBuilder->get()->getResultArray();

        $data['declinedStudents'] = [];
        foreach ($declinedResults as $d) {
            $desc = $d['description'] ?? '';
            $studentName = 'Unknown';
            $studentId = null;
            $fetcherName = $d['user_name'] ?? 'Unknown';
            
            if (preg_match('/Student:\s*([^\s]+)\s*([^\s]+)\s*\(ID:\s*(\d+)\)/', $desc, $matches)) {
                $studentName = $matches[1] . ' ' . $matches[2];
                $studentId = $matches[3];
            } elseif (preg_match('/Student:\s*([^\s]+)\s*([^\s]+)/', $desc, $matches)) {
                $studentName = $matches[1] . ' ' . $matches[2];
            }
            
            if (preg_match('/(?:Sub-Fetcher|Parent|Fetcher):\s*([^\s]+)\s*([^\s]+)/', $desc, $fetcherMatches)) {
                $fetcherName = $fetcherMatches[1] . ' ' . $fetcherMatches[2];
            }
            
            $gradeSection = '—';
            if ($studentId) {
                $student = $db->table('students')
                    ->select('grade_section')
                    ->where('id', $studentId)
                    ->get()
                    ->getRowArray();
                if ($student) {
                    $gradeSection = $student['grade_section'];
                }
            }
            
            $d['student_name'] = $studentName;
            $d['grade_section'] = $gradeSection;
            $d['fetcher_display'] = $fetcherName;
            $data['declinedStudents'][] = $d;
        }

        // ===== GET ALL GRADES FOR FILTER =====
        $data['grades'] = $db->table('students')
            ->select('grade_section')
            ->distinct()
            ->orderBy('grade_section', 'ASC')
            ->get()
            ->getResultArray();

        // ===== ACTIVITY LOGS (Merged) =====
        $releases = $db->table('fetch_logs')
            ->select('fetch_logs.*, students.fname as student_fname, students.lname as student_lname, students.grade_section')
            ->join('students', 'students.id = fetch_logs.student_id', 'left')
            ->where('DATE(fetch_logs.time_released)', $selectedDate)
            ->orderBy('fetch_logs.time_released', 'DESC')
            ->limit(100)
            ->get()
            ->getResultArray();

        foreach ($releases as &$r) {
            $r['action'] = 'release';
            $r['created_at'] = $r['time_released'];
            $r['fetcher_display'] = trim(($r['fetcher_fname'] ?? '') . ' ' . ($r['fetcher_lname'] ?? ''));
            if (empty($r['fetcher_display'])) {
                $r['fetcher_display'] = 'Unknown';
            }
        }

        $declines = $db->table('activity_logs')
            ->select('activity_logs.*')
            ->where('DATE(activity_logs.created_at)', $selectedDate)
            ->where('action', 'decline')
            ->where('module', 'scan')
            ->orderBy('activity_logs.created_at', 'DESC')
            ->limit(100)
            ->get()
            ->getResultArray();

        foreach ($declines as &$d) {
            $desc = $d['description'] ?? '';
            $studentName = 'Unknown';
            $studentId = null;
            $fetcherName = $d['user_name'] ?? 'Unknown';
            
            if (preg_match('/Student:\s*([^\s]+)\s*([^\s]+)\s*\(ID:\s*(\d+)\)/', $desc, $matches)) {
                $studentName = $matches[1] . ' ' . $matches[2];
                $studentId = $matches[3];
            } elseif (preg_match('/Student:\s*([^\s]+)\s*([^\s]+)/', $desc, $matches)) {
                $studentName = $matches[1] . ' ' . $matches[2];
            }
            
            if (preg_match('/(?:Sub-Fetcher|Parent|Fetcher):\s*([^\s]+)\s*([^\s]+)/', $desc, $fetcherMatches)) {
                $fetcherName = $fetcherMatches[1] . ' ' . $fetcherMatches[2];
            }
            
            $gradeSection = '—';
            if ($studentId) {
                $student = $db->table('students')
                    ->select('grade_section')
                    ->where('id', $studentId)
                    ->get()
                    ->getRowArray();
                if ($student) {
                    $gradeSection = $student['grade_section'];
                }
            }
            
            $d['student_fname'] = $studentName;
            $d['student_lname'] = '';
            $d['grade_section'] = $gradeSection;
            $d['fetcher_display'] = $fetcherName;
            $d['action'] = 'decline';
        }

        $data['scanLogs'] = array_merge($releases, $declines);
        usort($data['scanLogs'], function($a, $b) {
            return strtotime($b['created_at']) - strtotime($a['created_at']);
        });
        
        $data['scanLogs'] = array_slice($data['scanLogs'], 0, 100);

        // ===== VIEW DATA =====
        $data['selectedDate'] = $selectedDate;
        $data['isToday'] = $isToday;
        $data['activeTab'] = $tab;
        $data['search'] = $search;
        $data['selectedGrade'] = $grade;

        return view('scan_monitor', $data);
    }

    // ===== GET PENDING STUDENTS LIST =====
    public function getPendingList()
    {
        if (!session('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $db = \Config\Database::connect();
        $today = date('Y-m-d');
        
        $releasedIds = $db->table('fetch_logs')
            ->select('student_id')
            ->where('DATE(time_released)', $today)
            ->get()
            ->getResultArray();
        
        $releasedIdArray = array_column($releasedIds, 'student_id');
        
        $pendingBuilder = $db->table('students');
        $pendingBuilder->select('students.*, parents.id as parent_id, parents.fname as parent_fname, parents.lname as parent_lname, parents.phone as parent_phone');
        $pendingBuilder->join('student_parents', 'student_parents.student_id = students.id', 'left');
        $pendingBuilder->join('parents', 'parents.id = student_parents.parent_id', 'left');
        
        if (!empty($releasedIdArray)) {
            $pendingBuilder->whereNotIn('students.id', $releasedIdArray);
        }
        
        $pendingBuilder->groupBy('students.id');
        $pendingBuilder->orderBy('students.grade_section', 'ASC');
        $students = $pendingBuilder->get()->getResultArray();
        
        $students = array_filter($students, function($s) {
            return !empty($s['parent_phone']);
        });
        
        return $this->response->setJSON([
            'success' => true,
            'students' => array_values($students)
        ]);
    }

    // ===== SEND SMS NOTIFICATIONS =====
    public function sendPendingNotifications()
    {
        if (!session('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $db = \Config\Database::connect();
        $today = date('Y-m-d');
        $customMessage = $this->request->getPost('custom_message') ?? '';
        
        $releasedIds = $db->table('fetch_logs')
            ->select('student_id')
            ->where('DATE(time_released)', $today)
            ->get()
            ->getResultArray();
        
        $releasedIdArray = array_column($releasedIds, 'student_id');
        
        $pendingBuilder = $db->table('students');
        $pendingBuilder->select('students.*, parents.id as parent_id, parents.fname as parent_fname, parents.lname as parent_lname, parents.phone as parent_phone');
        $pendingBuilder->join('student_parents', 'student_parents.student_id = students.id', 'left');
        $pendingBuilder->join('parents', 'parents.id = student_parents.parent_id', 'left');
        
        if (!empty($releasedIdArray)) {
            $pendingBuilder->whereNotIn('students.id', $releasedIdArray);
        }
        
        $pendingBuilder->groupBy('students.id');
        $pendingStudents = $pendingBuilder->get()->getResultArray();
        
        $pendingStudents = array_filter($pendingStudents, function($s) {
            return !empty($s['parent_phone']);
        });
        
        if (empty($pendingStudents)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No pending students to notify.'
            ]);
        }
        
        $sentCount = 0;
        $failedCount = 0;
        $messages = [];
        $logModel = new \App\Models\ActivityLogModel();
        
        foreach ($pendingStudents as $student) {
            $message = "Reminder: Your child {$student['fname']} {$student['lname']} has not been picked up yet. Please fetch your child from school. - BCC Scan2Fetch";
            
            if (!empty($customMessage)) {
                $message .= "\n\n" . $customMessage;
            }
            
            $smsData = [
                'parent_phone' => $student['parent_phone'],
                'message'      => $message,
                'status'       => 'sent',
                'sent_at'      => date('Y-m-d H:i:s')
            ];
            
            $smsId = $db->table('sms_logs')->insert($smsData);
            
            if ($smsId) {
                $sentCount++;
                $messages[] = [
                    'student' => $student['fname'] . ' ' . $student['lname'],
                    'parent' => $student['parent_fname'] . ' ' . $student['parent_lname'],
                    'phone' => $student['parent_phone']
                ];
                
                $db->table('sms_notification_logs')->insert([
                    'student_id' => $student['id'],
                    'parent_id' => $student['parent_id'],
                    'message' => $message,
                    'status' => 'sent',
                    'sent_by' => session('user_id'),
                    'sent_at' => date('Y-m-d H:i:s')
                ]);
                
                $db->table('students')
                    ->where('id', $student['id'])
                    ->update(['last_sms_notification' => date('Y-m-d H:i:s')]);
                    
                $logModel->addLog(
                    session('user_id'),
                    session('fname') . ' ' . session('lname'),
                    session('role'),
                    'notify',
                    'scan',
                    "SMS notification sent to {$student['parent_fname']} {$student['parent_lname']} for student {$student['fname']} {$student['lname']}"
                );
            } else {
                $failedCount++;
            }
        }
        
        return $this->response->setJSON([
            'success' => true,
            'sent' => $sentCount,
            'failed' => $failedCount,
            'messages' => $messages,
            'total' => count($pendingStudents)
        ]);
    }
}