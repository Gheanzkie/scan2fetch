<?php

namespace App\Controllers;

use App\Models\ParentsModel;
use App\Models\StudentModel;
use App\Models\SubFetcherModel;
use App\Models\ActivityLogModel;

class Scan extends BaseController
{
    /**
     * Manual session picked by the admin on the scan page
     * ('morning' | 'afternoon' | null = follow server clock).
     */
    private function override(): ?string
    {
        return (new \App\Models\ScheduleModel())->sessionOverride();
    }

    public function index()
    {
        // Surface the day status so staff sees open/closed BEFORE scanning.
        $scheduleModel = new \App\Models\ScheduleModel();
        [$gateAllowed, $gateMessage] = $scheduleModel->releaseAllowed(null, $this->override());
        $hours = $scheduleModel->effectiveHours(date('Y-m-d'));
        $todayRow = $scheduleModel->forDate(date('Y-m-d'));

        $override = $this->override();

        return view('scan', [
            'gateAllowed' => $gateAllowed,
            'gateMessage' => $gateMessage,
            'gateHours'   => $hours,
            'gateStatus'  => $todayRow['status'] ?? 'normal',
            'currentSession' => $scheduleModel->resolveSession($override),
            'sessionOverride' => $override,
            'isShiftAdmin'    => session('role') === 'admin',
        ]);
    }

    /**
     * POST /scan/set-session — admin session switch.
     * Params: session = 'morning' | 'afternoon' | 'auto'
     * Stores the pick in the admin's own PHP session (scanner operator).
     */
    public function setSession()
    {
        if (strtoupper($this->request->getMethod()) !== 'POST') {
            return $this->response->setStatusCode(405)->setJSON([
                'success' => false,
                'message' => 'Method not allowed',
            ]);
        }

        if (session('role') !== 'admin') {
            return $this->response->setStatusCode(403)->setJSON([
                'success' => false,
                'message' => 'Only admin can switch the scan session.',
            ]);
        }

        // Global csrf filter is disabled in this app — verify manually.
        $token = $this->request->getPost(csrf_token());
        if (! is_string($token) || $token === '' || ! hash_equals(csrf_hash(), $token)) {
            return $this->response->setStatusCode(403)->setJSON([
                'success' => false,
                'message' => 'Invalid security token (CSRF). Refresh the page and try again.',
            ]);
        }

        $picked = strtolower(trim((string) $this->request->getPost('session')));
        if (! in_array($picked, ['morning', 'afternoon', 'auto'], true)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Invalid session. Use morning, afternoon or auto.',
            ]);
        }

        if ($picked === 'auto') {
            session()->remove('scan_session');
            $override = null;
        } else {
            session()->set(['scan_session' => $picked]);
            $override = $picked;
        }

        $scheduleModel = new \App\Models\ScheduleModel();
        $effective = $scheduleModel->resolveSession($override);

        (new ActivityLogModel())->addLog(
            session('user_id'),
            session('fname') . ' ' . session('lname'),
            session('role'),
            'update',
            'scan',
            'Session switch | ' . ($override ? strtoupper($override) . ' (manual)' : 'AUTO (server clock)') .
            ' | Effective session: ' . strtoupper($effective)
        );

        return $this->response->setJSON([
            'success'   => true,
            'override'  => $override,
            'session'   => $effective,
            'message'   => $override
                ? 'Scanning the ' . strtoupper($override) . ' session (manual switch).'
                : 'Automatic session (server clock).',
        ]);
    }

    public function verify()
    {
        // ===== DATE MANAGEMENT GATE =====
        // Block verification outside operating hours / closed days so the
        // scanner UI can flash "scanner is not available this time".
        $scheduleModel = new \App\Models\ScheduleModel();
        $override = $this->override();
        [$gateAllowed, $gateMessage] = $scheduleModel->releaseAllowed(null, $override);
        if (! $gateAllowed) {
            return $this->response->setJSON([
                'success'            => false,
                'blocked_by_schedule'=> true,
                'message'            => $gateMessage,
            ]);
        }

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
            'session' => $scheduleModel->resolveSession($override),
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

        // ===== DATE MANAGEMENT GATE =====
        // Block releases outside the configured open window / closed / holiday days.
        $scheduleModel = new \App\Models\ScheduleModel();
        $override = $this->override();
        [$gateAllowed, $gateMessage] = $scheduleModel->releaseAllowed(null, $override);
        if (! $gateAllowed) {
            return $this->response->setJSON([
                'success' => false,
                'blocked_by_schedule' => true,
                'message' => $gateMessage,
            ]);
        }

        // ===== SERVER-SIDE SESSION (independent check — never trusts the client) =====
        // Admin manual switch (PHP session 'scan_session') wins; otherwise the
        // clock decides (MORNING before 12:00, AFTERNOON from 12:00). One
        // release per student per session; the gate resets every midnight.
        $session = $scheduleModel->resolveSession($override);

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

        // Prevent duplicate release WITHIN THE SAME SESSION: 1 morning scan
        // + 1 afternoon scan per student per day. Old rows (session_type NULL)
        // released today are treated as belonging to the opposite-free legacy set
        // and no longer block — only same-session rows count.
        $alreadyReleased = $db->table('fetch_logs')
            ->where('student_id', $studentId)
            ->where('DATE(time_released)', date('Y-m-d'))
            ->where('session_type', $session)
            ->countAllResults();
        if ($alreadyReleased > 0) {
            return $this->response->setJSON([
                'success' => false,
                'already_released' => true,
                'message' => $student['fname'] . ' ' . $student['lname'] . ' is already released this ' . strtoupper($session) . ' session.'
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

        // Insert fetch log (session_type computed SERVER-side)
        $db->table('fetch_logs')->insert([
            'student_id'       => $studentId,
            'parent_id'        => $parentId,
            'fetcher_fname'    => $fetcherFname,
            'fetcher_mname'    => '',
            'fetcher_lname'    => $fetcherLname,
            'fetcher_relation' => $fetcherRelation,
            'method'           => 'QR',
            'session_type'     => $session,
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
            "QR Release | Student: {$student['fname']} {$student['lname']} (ID: {$studentId}) | {$fetcherRelation}: {$fetcherFname} {$fetcherLname} | Session: " . strtoupper($session) . ($override ? ' (manual switch)' : '') . " | SMS sent"
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

        // ===== DATE MANAGEMENT GATE =====
        $scheduleModel = new \App\Models\ScheduleModel();
        [$gateAllowed, $gateMessage] = $scheduleModel->releaseAllowed(null, $this->override());
        if (! $gateAllowed) {
            return $this->response->setJSON([
                'success' => false,
                'blocked_by_schedule' => true,
                'message' => $gateMessage,
            ]);
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