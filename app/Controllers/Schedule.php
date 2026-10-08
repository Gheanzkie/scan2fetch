<?php

namespace App\Controllers;

use App\Models\ScheduleModel;
use App\Models\SettingsModel;
use App\Models\ActivityLogModel;

class Schedule extends BaseController
{
    protected $scheduleModel;
    protected $settingsModel;
    protected $logModel;

    public function __construct()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }
        $this->scheduleModel = new ScheduleModel();
        $this->settingsModel = new SettingsModel();
        $this->logModel      = new ActivityLogModel();
    }

    /** Admin/staff only. */
    private function guard(): bool
    {
        $role = session('role');
        if ($role !== 'admin' && $role !== 'staff') {
            redirect()->to('/dashboard')->send();
            return false;
        }
        return true;
    }

    /**
     * CSRF check for POST endpoints (global csrf filter is disabled in
     * this app, so schedule writes verify the token manually).
     * Returns a 403 JSON response when the token is missing/invalid, null otherwise.
     */
    private function csrfGuard()
    {
        if (strtoupper($this->request->getMethod()) !== 'POST') {
            return null;
        }
        $token = $this->request->getPost(csrf_token());
        if (! is_string($token) || $token === '' || ! hash_equals(csrf_hash(), $token)) {
            return $this->response
                ->setStatusCode(403)
                ->setJSON(['success' => false, 'message' => 'Invalid security token (CSRF). Refresh the page and try again.']);
        }
        return null;
    }

    // GET /schedule — calendar + settings page
    public function index()
    {
        if (! $this->guard()) {
            return null;
        }

        $month = $this->request->getGet('m'); // YYYY-MM
        if (! $month || ! preg_match('/^\d{4}-\d{2}$/', $month)) {
            $month = date('Y-m');
        }

        $today = date('Y-m-d');
        $scanOverride = $this->scheduleModel->sessionOverride();
        $data = [
            'month'        => $month,
            'monthMap'     => $this->scheduleModel->monthMap($month),
            'today'        => $today,
            'todayRow'     => $this->scheduleModel->forDate($today),
            'todayHours'   => $this->scheduleModel->effectiveHours($today),
            'defaultOpen'  => $this->settingsModel->getSetting('default_open_time', '07:00'),
            'defaultClose' => $this->settingsModel->getSetting('default_close_time', '17:00'),
            // Scan-session switch (Edit panel): current override + effective session
            'scanSession'  => $this->scheduleModel->resolveSession($scanOverride),
            'scanOverride' => $scanOverride,
        ];

        return view('schedule', $data);
    }

    // GET /schedule/day?date=YYYY-MM-DD — day history JSON (fetch logs + schedule events; no activity logs / SMS)
    public function day()
    {
        if (! $this->guard()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Forbidden']);
        }

        $date = $this->request->getGet('date');
        if (! $date || ! preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid date']);
        }

        $db = \Config\Database::connect();

        // Releases that day
        $releases = $db->table('fetch_logs')
            ->select('fetch_logs.*, students.fname AS student_fname, students.lname AS student_lname, students.grade_section, parents.fname AS parent_fname, parents.lname AS parent_lname')
            ->join('students', 'students.id = fetch_logs.student_id', 'left')
            ->join('parents', 'parents.id = fetch_logs.parent_id', 'left')
            ->where('DATE(fetch_logs.time_released)', $date)
            ->orderBy('fetch_logs.time_released', 'ASC')
            ->get()
            ->getResultArray();

        // Schedule row (open/close events, overrides, notes)
        $row = $this->scheduleModel->forDate($date);
        $hours = $this->scheduleModel->effectiveHours($date);

        // Day events timeline built from schedule row only
        $events = [];
        if ($row) {
            if ($row['opened_at']) {
                $events[] = [
                    'time' => substr($row['opened_at'], 11, 5),
                    'type' => 'open',
                    'text' => 'Day started' . ($row['opened_by'] ? ' by ' . $row['opened_by'] : ''),
                ];
            }
            if ($row['closed_at']) {
                $events[] = [
                    'time' => substr($row['closed_at'], 11, 5),
                    'type' => 'close',
                    'text' => 'Day ended (out)' . ($row['closed_by'] ? ' by ' . $row['closed_by'] : ''),
                ];
            }
            if ($row['status'] === 'holiday') {
                $events[] = ['time' => '00:00', 'type' => 'holiday', 'text' => 'Marked as no class / holiday'];
            }
            if ($row['notes']) {
                $events[] = ['time' => '--:--', 'type' => 'note', 'text' => 'Note: ' . $row['notes']];
            }
            if ($row['open_time'] || $row['close_time']) {
                $events[] = [
                    'time' => '--:--',
                    'type' => 'override',
                    'text' => 'Custom hours: ' . ($hours['open'] . '–' . $hours['close']),
                ];
            }
        }

        usort($events, fn($a, $b) => strcmp($a['time'], $b['time']));

        // Summary
        $releasedIds = array_column($releases, 'student_id');
        $pending = [];
        if ($date === date('Y-m-d')) {
            // today: students not yet released
            $all = $db->table('students')->select('id, fname, lname, grade_section')->get()->getResultArray();
            $pending = array_values(array_filter($all, fn($s) => ! in_array($s['id'], $releasedIds)));
        }

        return $this->response->setJSON([
            'success'  => true,
            'date'     => $date,
            'status'   => $row['status'] ?? 'normal',
            'hours'    => $hours,
            'row'      => $row,
            'events'   => $events,
            'releases' => $releases,
            'pending'  => $pending,
            'counts'   => [
                'releases' => count($releases),
                'pending'  => count($pending),
            ],
        ]);
    }

    // POST /schedule/open — manual start of day
    public function openDay()
    {
        if (! $this->guard()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Forbidden']);
        }
        if ($csrf = $this->csrfGuard()) {
            return $csrf;
        }

        $date     = $this->request->getPost('date') ?: date('Y-m-d');
        $openTime = $this->request->getPost('open_time'); // optional HH:MM override

        if (! preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid date']);
        }
        if ($openTime && ! preg_match('/^\d{2}:\d{2}$/', $openTime)) {
            $openTime = null;
        }

        $row = $this->scheduleModel->openDay($date, [
            'fname' => session('fname'),
            'lname' => session('lname'),
        ], $openTime);

        $this->logModel->addLog(
            session('user_id'),
            session('fname') . ' ' . session('lname'),
            session('role'),
            'update',
            'schedule',
            'Day OPENED manually | Date: ' . $date . ($openTime ? ' | Open time: ' . $openTime : '')
        );

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Day opened successfully.',
            'row'     => $row,
        ]);
    }

    // POST /schedule/close — manual out / end of day
    public function closeDay()
    {
        if (! $this->guard()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Forbidden']);
        }
        if ($csrf = $this->csrfGuard()) {
            return $csrf;
        }

        $date      = $this->request->getPost('date') ?: date('Y-m-d');
        $closeTime = $this->request->getPost('close_time');

        if (! preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid date']);
        }
        if ($closeTime && ! preg_match('/^\d{2}:\d{2}$/', $closeTime)) {
            $closeTime = null;
        }

        $row = $this->scheduleModel->closeDay($date, [
            'fname' => session('fname'),
            'lname' => session('lname'),
        ], $closeTime);

        $this->logModel->addLog(
            session('user_id'),
            session('fname') . ' ' . session('lname'),
            session('role'),
            'update',
            'schedule',
            'Day CLOSED manually (out) | Date: ' . $date . ($closeTime ? ' | Close time: ' . $closeTime : '')
        );

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Day closed successfully.',
            'row'     => $row,
        ]);
    }

    // POST /schedule/save — save a date's schedule (hours / status / notes) + default hours
    public function save()
    {
        if (! $this->guard()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Forbidden']);
        }
        if ($csrf = $this->csrfGuard()) {
            return $csrf;
        }

        // Defaults-only save: system default hours from the calendar header box
        // (no date row involved — admin changes the fallback hours only).
        if ($this->request->getPost('defaults_only')) {
            if (session('role') !== 'admin') {
                return $this->response->setJSON(['success' => false, 'message' => 'Forbidden']);
            }
            $dOpen  = $this->request->getPost('default_open');
            $dClose = $this->request->getPost('default_close');
            if ($dOpen && preg_match('/^\d{2}:\d{2}$/', $dOpen)) {
                $this->settingsModel->setSetting('default_open_time', $dOpen);
            }
            if ($dClose && preg_match('/^\d{2}:\d{2}$/', $dClose)) {
                $this->settingsModel->setSetting('default_close_time', $dClose);
            }
            $this->logModel->addLog(
                session('user_id'),
                session('fname') . ' ' . session('lname'),
                session('role'),
                'update',
                'schedule',
                'System default hours updated | Open: ' . ($dOpen ?: '-') . ' | Close: ' . ($dClose ?: '-')
            );
            return $this->response->setJSON([
                'success' => true,
                'message' => 'System default hours saved.',
                'default_open'  => $this->settingsModel->getSetting('default_open_time', '07:00'),
                'default_close' => $this->settingsModel->getSetting('default_close_time', '17:00'),
            ]);
        }

        $date   = $this->request->getPost('date');
        $status = $this->request->getPost('status') ?: 'normal';
        $open   = $this->request->getPost('open_time');
        $close  = $this->request->getPost('close_time');
        $notes  = trim($this->request->getPost('notes') ?? '');

        if (! $date || ! preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid date']);
        }
        if (! in_array($status, ['normal', 'open', 'closed', 'holiday'], true)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid status']);
        }
        if ($open && ! preg_match('/^\d{2}:\d{2}$/', $open)) {
            $open = null;
        }
        if ($close && ! preg_match('/^\d{2}:\d{2}$/', $close)) {
            $close = null;
        }

        $data = [
            'status'    => $status,
            'open_time' => $open ?: null,
            'close_time'=> $close ?: null,
            'notes'     => $notes !== '' ? $notes : null,
        ];

        // ===== STATUS STAMPS =====
        // ScheduleModel::autoSync() has to tell an admin's explicit choice
        // apart from its own clock-driven transitions. open_by being a person
        // means "a human chose this"; 'Auto (schedule)' means "the clock did".
        $existing  = $this->scheduleModel->forDate($date);
        $prev      = $existing['status'] ?? null;
        $who       = trim((session('fname') ?? '') . ' ' . (session('lname') ?? ''));
        $who       = $who !== '' ? $who : 'Admin';
        $stamp     = date('Y-m-d H:i:s');

        if ($status === 'open') {
            // Explicit "open" — pin it so the clock cannot drag it back to closed.
            if ($prev !== 'open') {
                $data['opened_at'] = $stamp;
                $data['opened_by'] = $who;
            }
            $data['closed_at'] = null;
            $data['closed_by'] = null;
        } elseif ($status === 'closed') {
            if ($prev !== 'closed') {
                $data['closed_at'] = $stamp;
                $data['closed_by'] = $who;
            }
        } elseif ($status === 'normal') {
            // Hand control back to the clock: clear the manual discriminator so
            // autoSync() resumes auto-open/auto-close on the configured hours.
            $data['opened_by'] = null;
            $data['closed_by'] = null;
        }
        // 'holiday' leaves the stamps untouched (autoSync ignores holidays anyway).

        $row = $this->scheduleModel->upsert($date, $data);

        // Default hours (admin only)
        if (session('role') === 'admin') {
            $dOpen  = $this->request->getPost('default_open');
            $dClose = $this->request->getPost('default_close');
            if ($dOpen && preg_match('/^\d{2}:\d{2}$/', $dOpen)) {
                $this->settingsModel->setSetting('default_open_time', $dOpen);
            }
            if ($dClose && preg_match('/^\d{2}:\d{2}$/', $dClose)) {
                $this->settingsModel->setSetting('default_close_time', $dClose);
            }
        }

        $this->logModel->addLog(
            session('user_id'),
            session('fname') . ' ' . session('lname'),
            session('role'),
            'update',
            'schedule',
            'Schedule saved | Date: ' . $date . ' | Status: ' . $status .
            ($open ? ' | Open: ' . $open : '') . ($close ? ' | Close: ' . $close : '') .
            ($notes ? ' | Notes: ' . $notes : '')
        );

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Schedule saved.',
            'row'     => $row,
        ]);
    }

    /**
     * POST /schedule/save-sessions — Date Management morning/afternoon
     * switch buttons. Touches ONLY the two session columns so the date's
     * hours/status/notes are never wiped by a switch toggle.
     *
     * Params: date (YYYY-MM-DD, default today),
     *         morning_status / afternoon_status = 'open' | 'closed'
     */
    public function saveSessions()
    {
        if (! $this->guard()) {
            return $this->response->setJSON(['success' => false, 'message' => 'Forbidden']);
        }
        if ($csrf = $this->csrfGuard()) {
            return $csrf;
        }

        $date = $this->request->getPost('date') ?: date('Y-m-d');
        if (! preg_match('/^\d{4}-\d{2}-\d{2}$/', $date)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Invalid date']);
        }

        $data = [];
        $logParts = [];
        foreach (['morning', 'afternoon'] as $session) {
            $value = $this->request->getPost($session . '_status');
            if ($value === null) {
                continue; // not part of this request
            }
            if (! in_array($value, ['open', 'closed'], true)) {
                return $this->response->setJSON([
                    'success' => false,
                    'message' => 'Invalid ' . $session . ' status',
                ]);
            }
            $data[$session . '_status'] = $value;
            $logParts[] = ucfirst($session) . ' ' . ($value === 'open' ? 'OPENED' : 'CLOSED');
        }

        if ($data === []) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'No session status provided',
            ]);
        }

        // Preserve any existing session value not included in this request.
        $existing = $this->scheduleModel->forDate($date);
        foreach (['morning_status', 'afternoon_status'] as $col) {
            if (! array_key_exists($col, $data) && $existing) {
                $data[$col] = $existing[$col];
            }
        }

        $row = $this->scheduleModel->upsert($date, $data);

        $this->logModel->addLog(
            session('user_id'),
            session('fname') . ' ' . session('lname'),
            session('role'),
            'update',
            'schedule',
            'Session switch | Date: ' . $date . ' | ' . implode(' | ', $logParts)
        );

        return $this->response->setJSON([
            'success' => true,
            'message' => implode(', ', $logParts) . ' for ' . $date . '.',
            'row'     => $row,
            'morning_status'   => $row['morning_status'] ?? null,
            'afternoon_status' => $row['afternoon_status'] ?? null,
        ]);
    }

    // GET /schedule/status — current open/close state (for dashboard/scan gate)
    public function status()
    {
        // Any logged-in role may read the gate status (the scanner page polls
        // this to auto-close itself when the day ends). Auth is enforced by
        // the global 'auth' filter on the route.
        $ovr = $this->scheduleModel->sessionOverride();
        [$allowed, $message] = $this->scheduleModel->releaseAllowed(null, $ovr);
        $hours = $this->scheduleModel->effectiveHours(date('Y-m-d'));

        // Session shown on the scanner: admin's manual switch wins, else clock.
        $override = $ovr;

        return $this->response->setJSON([
            'success'  => true,
            'date'     => date('Y-m-d'),
            'time'     => date('H:i'),
            'allowed'  => $allowed,
            'message'  => $message,
            'hours'    => $hours,
            'session'  => $this->scheduleModel->resolveSession($override),
            'override' => $override,
        ]);
    }
}
