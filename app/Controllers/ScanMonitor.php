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

    // The students-status/sms monitor is for admin/staff only.
    private function guardStaffOnly()
    {
        if (session('role') != 'admin' && session('role') != 'staff') {
            return redirect()->to('/dashboard');
        }
        return null;
    }

    public function index()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }
        $guard = $this->guardStaffOnly();
        if ($guard) {
            return $guard;
        }

        $db = \Config\Database::connect();
        
        // Get selected date
        $selectedDate = $this->request->getGet('date') ?? date('Y-m-d');
        $isToday = ($selectedDate == date('Y-m-d'));
        
        // Get filter parameters
        $search = $this->request->getGet('search') ?? '';
        $grade = $this->request->getGet('grade') ?? '';
        $tab = $this->request->getGet('tab') ?? 'released';

        // ===== SMS MODE SETTING =====
        $settingsModel = new \App\Models\SettingsModel();
        $data['smsMode'] = $settingsModel->getSetting('sms_mode', 'manual');
        $data['autoSmsDatetime'] = $settingsModel->getSetting('auto_sms_datetime', '');
        $data['autoSmsLastRun'] = $settingsModel->getSetting('auto_sms_last_run', '');

        // Auto reminder: when mode is 'auto' and a schedule is set and the
        // scheduled date/time has been reached (and not run yet for this
        // schedule), automatically notify all pending parents.
        if ($data['smsMode'] === 'auto' && !empty($data['autoSmsDatetime'])) {
            $scheduleTs = strtotime($data['autoSmsDatetime']);
            if ($scheduleTs !== false && time() >= $scheduleTs && $data['autoSmsLastRun'] !== $data['autoSmsDatetime']) {
                $autoResult = $this->sendReminders('');
                if (!empty($autoResult['sent']) && $autoResult['sent'] > 0) {
                    $data['autoSmsNote'] = 'Scheduled reminder sent to ' . $autoResult['sent'] . ' parent(s).';
                } elseif (($autoResult['total'] ?? 0) == 0) {
                    $data['autoSmsNote'] = 'Scheduled reminder fired - no parents to notify.';
                }
                if (!$this->request->isAJAX()) {
                    $settingsModel->setSetting('auto_sms_last_run', $data['autoSmsDatetime']);
                }
            }
        }
        
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
        $guard = $this->guardStaffOnly();
        if ($guard) {
            return $guard;
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
        if (session('role') != 'admin' && session('role') != 'staff') {
            return $this->response->setJSON(['success' => false, 'message' => 'Forbidden']);
        }

        $customMessage = $this->request->getPost('custom_message') ?? '';
        $result = $this->sendReminders($customMessage);

        if ($result['total'] === 0) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No pending students to notify.'
            ]);
        }

        return $this->response->setJSON(array_merge(['success' => $result['sent'] > 0], $result));
    }

    // ===== CHECK AND FIRE AUTO-SMS (called via AJAX, no refresh needed) =====
    public function checkAndFireAutoSms()
    {
        if (!session('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        if (session('role') != 'admin' && session('role') != 'staff') {
            return $this->response->setJSON(['success' => false, 'message' => 'Forbidden']);
        }

        $settingsModel = new \App\Models\SettingsModel();
        $mode = $settingsModel->getSetting('sms_mode', 'manual');
        $schedule = $settingsModel->getSetting('auto_sms_datetime', '');
        $lastRun = $settingsModel->getSetting('auto_sms_last_run', '');

        $response = [
            'success' => true,
            'mode'    => $mode,
            'fired'   => false,
            'sent'    => 0,
            'total'   => 0,
            'next'    => $schedule,
            'lastRun' => $lastRun
        ];

        if ($mode === 'auto' && !empty($schedule)) {
            $scheduleTs = strtotime($schedule);
            if ($scheduleTs !== false && time() >= $scheduleTs && $lastRun !== $schedule) {
                $result = $this->sendReminders('');
                $settingsModel->setSetting('auto_sms_last_run', $schedule);

                $response['fired'] = true;
                $response['sent'] = $result['sent'] ?? 0;
                $response['total'] = $result['total'] ?? 0;
                $response['lastRun'] = $schedule;
            }
        }

        return $this->response->setJSON($response);
    }

    // ===== SAVE SMS MODE (auto / manual) =====
    public function saveSmsMode()
    {
        if (!session('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }
        if (session('role') != 'admin' && session('role') != 'staff') {
            return $this->response->setJSON(['success' => false, 'message' => 'Forbidden']);
        }

        $mode = $this->request->getPost('mode');
        if (!in_array($mode, ['auto', 'manual'], true)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid mode']);
        }

        $settingsModel = new \App\Models\SettingsModel();

        // Build schedule datetime from date + hour + minute + AM/PM fields.
        $scheduleDatetime = '';
        if ($mode === 'auto') {
            $sDate    = trim((string) $this->request->getPost('sched_date'));
            $sHour    = (int) $this->request->getPost('sched_hour');
            $sMinute  = (int) $this->request->getPost('sched_minute');
            $sAmpm    = strtoupper(trim((string) $this->request->getPost('sched_ampm')));

            $hour24 = $sHour;
            if ($sAmpm === 'PM' && $sHour < 12) {
                $hour24 = $sHour + 12;
            } elseif ($sAmpm === 'AM' && $sHour === 12) {
                $hour24 = 0;
            }

            if (!empty($sDate) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $sDate)) {
                $scheduleDatetime = sprintf('%s %02d:%02d:00', $sDate, $hour24, $sMinute);
                $scheduleTs = strtotime($scheduleDatetime);
                if ($scheduleTs === false) {
                    return $this->response->setJSON(['success' => false, 'message' => 'Invalid schedule']);
                }
                if ($scheduleTs <= time()) {
                    return $this->response->setJSON(['success' => false, 'message' => 'Schedule must be in the future.']);
                }
            } else {
                return $this->response->setJSON(['success' => false, 'message' => 'Please choose a date for the schedule.']);
            }
        }

        $settingsModel->setSetting('sms_mode', $mode);
        $settingsModel->setSetting('auto_sms_datetime', $scheduleDatetime);

        // If the schedule changed, allow it to fire again on its next run.
        if ($settingsModel->getSetting('auto_sms_last_run', '') !== $scheduleDatetime) {
            $settingsModel->setSetting('auto_sms_last_run', '');
        }

        $db = \Config\Database::connect();
        $logModel = new \App\Models\ActivityLogModel();
        $logModel->addLog(
            session('user_id'),
            session('fname') . ' ' . session('lname'),
            session('role'),
            'settings',
            'settings',
            "SMS mode changed to " . ($mode === 'auto' ? 'Automatic' : 'Manual') .
                ($mode === 'auto' && !empty($scheduleDatetime) ? ' (scheduled ' . $scheduleDatetime . ')' : '')
        );

        return $this->response->setJSON([
            'success'  => true,
            'mode'     => $mode,
            'schedule' => $scheduleDatetime
        ]);
    }

    /**
     * Shared logic for sending pending-parent reminders.
     *
     * @param string $customMessage Extra message appended to the default text.
     */
    protected function sendReminders(string $customMessage = ''): array
    {
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
        $pendingStudents = $pendingBuilder->get()->getResultArray();
        
        $pendingStudents = array_filter($pendingStudents, function($s) {
            return !empty($s['parent_phone']);
        });
        
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

                // ===== Also notify the teacher of this student's grade/section =====
                $teacher = $db->table('teachers')
                    ->where('grade_section', $student['grade_section'])
                    ->get()
                    ->getRowArray();
                if (!empty($teacher)) {
                    $teacherMessage = "Reminder: {$student['fname']} {$student['lname']} ({$student['grade_section']}) has not been picked up yet and is still at school. - BCC Scan2Fetch";
                    if (!empty($customMessage)) {
                        $teacherMessage .= "\n\n" . $customMessage;
                    }

                    $teacherSmsId = $db->table('sms_logs')->insert([
                        'parent_phone' => $teacher['phone'],
                        'message'      => $teacherMessage,
                        'status'       => 'sent',
                        'sent_at'      => date('Y-m-d H:i:s')
                    ]);

                    if ($teacherSmsId) {
                        $sentCount++;
                        $messages[] = [
                            'student' => $student['fname'] . ' ' . $student['lname'],
                            'parent' => $teacher['fname'] . ' ' . $teacher['lname'] . ' (Teacher)',
                            'phone' => $teacher['phone']
                        ];

                        $db->table('sms_notification_logs')->insert([
                            'student_id' => $student['id'],
                            'parent_id' => $teacher['id'],
                            'message' => $teacherMessage,
                            'status' => 'sent',
                            'sent_by' => session('user_id'),
                            'sent_at' => date('Y-m-d H:i:s')
                        ]);

                        $logModel->addLog(
                            session('user_id'),
                            session('fname') . ' ' . session('lname'),
                            session('role'),
                            'notify',
                            'scan',
                            "SMS notification sent to teacher {$teacher['fname']} {$teacher['lname']} for student {$student['fname']} {$student['lname']}"
                        );
                    } else {
                        $failedCount++;
                    }
                }
            } else {
                $failedCount++;
            }
        }
        
        return [
            'sent' => $sentCount,
            'failed' => $failedCount,
            'messages' => $messages,
            'total' => count($pendingStudents)
        ];
    }
}