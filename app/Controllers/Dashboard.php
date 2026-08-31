<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\ParentsModel;
use App\Models\StaffsModel;
use App\Models\FetchLogModel;
use App\Models\SmsLogModel;
use App\Models\SubFetcherModel;

class Dashboard extends BaseController
{
    protected $studentModel;
    protected $parentsModel;
    protected $staffsModel;
    protected $fetchLogModel;
    protected $smsLogModel;
    protected $subFetcherModel;

    public function __construct()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }
        $this->studentModel    = new StudentModel();
        $this->parentsModel    = new ParentsModel();
        $this->staffsModel     = new StaffsModel();
        $this->fetchLogModel   = new FetchLogModel();
        $this->smsLogModel     = new SmsLogModel();
        $this->subFetcherModel = new SubFetcherModel();
    }

    public function index()
    {
        $role   = session('role');
        $userId = session('user_id');
        $today  = date('Y-m-d');

        $data = ['title' => 'Dashboard'];

        // Admin Dashboard
        if ($role == 'admin') {
            $data['totalStudents']  = $this->studentModel->countAll();
            $data['totalParents']   = $this->parentsModel->countAll();
            $data['totalStaff']     = $this->staffsModel->countAll();
            $data['releasedToday']  = $this->fetchLogModel->where('DATE(time_released)', $today)->countAllResults();
            // $data['pendingAuth']    = $this->authLetterModel->where('status', 'pending')->countAllResults(); // <-- Inalis
            $data['smsSentToday']   = $this->smsLogModel->where('DATE(sent_at)', $today)->countAllResults();
            $data['qrReleases']     = $this->fetchLogModel->where('method', 'QR')->countAllResults();

            $db = \Config\Database::connect();
            $data['recentReleases'] = $db->table('fetch_logs')
                ->select('fetch_logs.student_id, fetch_logs.fetcher_fname, fetch_logs.fetcher_lname, fetch_logs.fetcher_relation, fetch_logs.method, fetch_logs.time_released, students.fname AS student_fname, students.lname AS student_lname, students.grade_section, parents.fname AS parent_fname, parents.lname AS parent_lname')
                ->join('students', 'students.id = fetch_logs.student_id', 'left')
                ->join('parents', 'parents.id = fetch_logs.parent_id', 'left')
                ->orderBy('fetch_logs.time_released', 'DESC')
                ->limit(10)
                ->get()
                ->getResultArray();

            $data['smsLogs'] = $this->smsLogModel->orderBy('sent_at', 'DESC')->limit(10)->findAll();
        }

        // Staff Dashboard
        if ($role == 'staff') {
            $data['totalStudents']     = $this->studentModel->countAll();
            $data['releasedToday']     = $this->fetchLogModel->where('staff_id', $userId)->where('DATE(time_released)', $today)->countAllResults();
            $data['smsSentToday']      = $this->smsLogModel->where('DATE(sent_at)', $today)->countAllResults();
            // $data['pendingAuthLetters'] = $this->authLetterModel->where('status', 'pending')->findAll(); // <-- Inalis

            $db = \Config\Database::connect();
            $data['todayReleases'] = $db->table('fetch_logs')
                ->select('fetch_logs.student_id, fetch_logs.fetcher_fname, fetch_logs.fetcher_lname, fetch_logs.fetcher_relation, fetch_logs.method, fetch_logs.time_released, students.fname AS student_fname, students.lname AS student_lname, students.grade_section, parents.fname AS parent_fname, parents.lname AS parent_lname')
                ->join('students', 'students.id = fetch_logs.student_id', 'left')
                ->join('parents', 'parents.id = fetch_logs.parent_id', 'left')
                ->where('fetch_logs.staff_id', $userId)
                ->where('DATE(fetch_logs.time_released)', $today)
                ->orderBy('fetch_logs.time_released', 'DESC')
                ->get()
                ->getResultArray();
        }

        // Parent Dashboard
        if ($role == 'parent') {
            $data['parentProfile'] = $this->parentsModel->find($userId);

            // Date filter: empty = show all
            $selectedDate = $this->request->getGet('date') ?? '';
            if ($selectedDate && !preg_match('/^\d{4}-\d{2}-\d{2}$/', $selectedDate)) {
                $selectedDate = '';
            }
            // Search filter
            $search = trim($this->request->getGet('q') ?? '');

            $db = \Config\Database::connect();
            $studentParents = $db->table('student_parents')
                ->where('parent_id', $userId)
                ->get()
                ->getResultArray();

            // All student ids linked to this parent, either directly or through sub-fetchers.
            $studentIds = [];
            $data['myChildren'] = [];
            if (!empty($studentParents)) {
                foreach ($studentParents as $sp) {
                    $student = $this->studentModel->find($sp['student_id']);
                    if ($student) {
                        $student['relation'] = $sp['relation'];
                        $data['myChildren'][] = $student;
                    }
                    $studentIds[] = $sp['student_id'];
                }
            }

            $data['subFetchers'] = $this->subFetcherModel->where('parent_id', $userId)->findAll();
            foreach ($data['subFetchers'] as $sf) {
                $studentIds[] = $sf['student_id'];
            }
            $studentIds = array_unique(array_filter(array_map('intval', $studentIds)));

            $teachersBySection = $db->table('teachers')
                ->select('grade_section, fname, lname')
                ->get()
                ->getResultArray();
            $teacherMap = [];
            foreach ($teachersBySection as $t) {
                if (!isset($teacherMap[$t['grade_section']])) {
                    $teacherMap[$t['grade_section']] = $t['fname'] . ' ' . $t['lname'];
                }
            }
            foreach ($data['myChildren'] as &$child) {
                $child['teacher'] = $teacherMap[$child['grade_section']] ?? '';
                $child['release_today'] = null;
            }
            unset($child);

            $data['releasedToday'] = 0;
            $data['parentReleaseHistory'] = [];
            $data['selectedDate'] = $selectedDate;
            $data['search'] = $search;
            if (!empty($studentIds)) {
                $data['releasedToday'] = $this->fetchLogModel
                    ->whereIn('student_id', $studentIds)
                    ->where('DATE(time_released)', $today)
                    ->countAllResults();

                // Per-child today status
                $todayReleases = $this->fetchLogModel
                    ->select('student_id, time_released')
                    ->whereIn('student_id', $studentIds)
                    ->where('DATE(time_released)', $today)
                    ->orderBy('time_released', 'ASC')
                    ->findAll();
                $todayMap = [];
                foreach ($todayReleases as $tr) {
                    if (!isset($todayMap[$tr['student_id']])) {
                        $todayMap[$tr['student_id']] = $tr['time_released'];
                    }
                }
                foreach ($data['myChildren'] as &$child) {
                    $child['release_today'] = $todayMap[$child['id']] ?? null;
                }
                unset($child);

                // Release history with date filter
                $histQuery = $db->table('fetch_logs')
                    ->select('fetch_logs.*, students.fname AS student_fname, students.lname AS student_lname')
                    ->join('students', 'students.id = fetch_logs.student_id', 'left')
                    ->whereIn('fetch_logs.student_id', $studentIds);

                if ($selectedDate) {
                    $histQuery->where('DATE(fetch_logs.time_released)', $selectedDate);
                }

                $history = $histQuery
                    ->orderBy('fetch_logs.time_released', 'DESC')
                    ->limit(50)
                    ->get()
                    ->getResultArray();

                // Search filter
                if ($search !== '') {
                    $history = array_filter($history, function($r) use ($search) {
                        $haystack = strtolower(
                            ($r['student_fname'] ?? '') . ' ' .
                            ($r['student_lname'] ?? '') . ' ' .
                            ($r['fetcher_fname'] ?? '') . ' ' .
                            ($r['fetcher_lname'] ?? '')
                        );
                        return strpos($haystack, strtolower($search)) !== false;
                    });
                    $history = array_values($history);
                }

                $data['parentReleaseHistory'] = $history;
            }
        }

        // Teacher Dashboard
        if ($role == 'teacher') {
            $db = \Config\Database::connect();
            $gradeSection = session('grade_section');

            // Date filter: defaults to today
            $selectedDate = $this->request->getGet('date') ?: date('Y-m-d');
            if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $selectedDate)) {
                $selectedDate = date('Y-m-d');
            }

            // Search filter
            $search = trim($this->request->getGet('q') ?? '');

            $data['teacherProfile'] = $db->table('teachers')->where('id', $userId)->get()->getRowArray();

            $myStudents = [];
            $studentIds = [];
            if (!empty($gradeSection)) {
                $query = $db->table('students')
                    ->where('grade_section', $gradeSection);
                if ($search !== '') {
                    $query->groupStart()
                        ->like('fname', $search)
                        ->orLike('lname', $search)
                        ->orLike('mname', $search)
                        ->groupEnd();
                }
                $students = $query->orderBy('lname', 'ASC')
                    ->get()
                    ->getResultArray();

                foreach ($students as $st) {
                    $st['parents'] = [];
                    $st['relation'] = '';
                    $studentIds[] = (int) $st['id'];
                    $myStudents[] = $st;
                }
                $data['myStudents'] = $myStudents;
                $data['totalStudents'] = count($myStudents);
            } else {
                $data['myStudents'] = [];
                $data['totalStudents'] = 0;
            }

            $data['releasedToday'] = 0;
            $data['pendingToday'] = 0;
            $data['dateReleasedMap'] = [];
            $data['selectedDate'] = $selectedDate;
            $data['search'] = $search;
            if (!empty($studentIds)) {
                $data['releasedToday'] = $this->fetchLogModel
                    ->whereIn('student_id', $studentIds)
                    ->where('DATE(time_released)', $selectedDate)
                    ->countAllResults();

                $data['recentReleases'] = $db->table('fetch_logs')
                    ->select('fetch_logs.*, students.fname AS student_fname, students.lname AS student_lname')
                    ->join('students', 'students.id = fetch_logs.student_id', 'left')
                    ->whereIn('fetch_logs.student_id', $studentIds)
                    ->orderBy('fetch_logs.time_released', 'DESC')
                    ->limit(10)
                    ->get()
                    ->getResultArray();

                $releasedIds = array_column(
                    $this->fetchLogModel
                        ->whereIn('student_id', $studentIds)
                        ->where('DATE(time_released)', $selectedDate)
                        ->findAll(),
                    'student_id'
                );

                $releaseLogs = $this->fetchLogModel
                    ->whereIn('student_id', $studentIds)
                    ->where('DATE(time_released)', $selectedDate)
                    ->orderBy('time_released', 'ASC')
                    ->findAll();
                foreach ($releaseLogs as $rl) {
                    if (!isset($data['dateReleasedMap'][$rl['student_id']])) {
                        $data['dateReleasedMap'][$rl['student_id']] = $rl['time_released'];
                    }
                }
                $data['pendingToday'] = count(array_diff($studentIds, $releasedIds));
            } else {
                $data['recentReleases'] = [];
            }

            $data['smsCount'] = 0;
            $teacherPhone = $db->table('teachers')->where('id', $userId)->get()->getRowArray()['phone'] ?? '';
            if (!empty($teacherPhone)) {
                $data['smsCount'] = $db->table('sms_logs')->where('parent_phone', $teacherPhone)->countAllResults();
            }
        }

        return view('dashboard', $data);
    }
}