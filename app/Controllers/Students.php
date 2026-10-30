<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\ParentsModel;
use App\Models\ActivityLogModel;
use App\Models\SubFetcherModel;

class Students extends BaseController
{
    protected $studentModel;
    protected $parentsModel;
    protected $subFetcherModel;
    protected $logModel;

    public function __construct()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }
        $this->studentModel    = new StudentModel();
        $this->parentsModel    = new ParentsModel();
        $this->subFetcherModel = new SubFetcherModel();
        $this->logModel        = new ActivityLogModel();
    }

    // ========== LIST ==========
    /**
     * Live release feed for the Students list + student view.
     * Returns today's releases as {student_id: "h:i A"} — polled by the UI
     * every 3s so scan results appear WITHOUT a manual page refresh.
     */
    public function liveStatus()
    {
        if (!in_array(session('role'), ['admin', 'staff', 'teacher'], true)) {
            return $this->response->setJSON(['success' => false, 'message' => 'Forbidden']);
        }

        $logs = (new \App\Models\FetchLogModel())
            ->select('student_id, time_released')
            ->where('DATE(time_released)', date('Y-m-d'))
            ->orderBy('time_released', 'ASC')
            ->findAll();

        $map = [];
        foreach ($logs as $l) {
            if (!isset($map[$l['student_id']])) {
                $map[$l['student_id']] = date('h:i A', strtotime($l['time_released']));
            }
        }

        return $this->response->setJSON([
            'success'  => true,
            'date'     => date('Y-m-d'),
            'released' => $map,
        ]);
    }

    public function index()
    {
        helper('photo');
        // Admin/staff management list. A parent must never see the whole
        // roster + every parent contact; a teacher works from their own
        // class at /teachers-view/{id}. (Belt: AuthFilter already blocks
        // the parent role on 'students' — this guards the teacher role.)
        if (! in_array(session('role'), ['admin', 'staff'], true)) {
            // Return the redirect (not bare return): requireAdminStaff()-style
            // send() + null lets CI4 still render the view body -> 200 with a
            // Location header, which a browser may ignore.
            return redirect()->to('/dashboard')->with('error', 'Access denied.');
        }
        $db = \Config\Database::connect();

        // Adviser (teacher) name pulled in so the roster can show WHICH
        // teacher the student belongs to.
        $students = $this->studentModel
            ->select('students.*, teachers.fname AS adviser_fname, teachers.lname AS adviser_lname')
            ->join('teachers', 'teachers.id = students.adviser_id', 'left')
            ->orderBy('students.created_at', 'DESC')
            ->findAll();

        // Attach every linked parent/guardian to each student so the Student
        // Management table can show a full household instead of nothing.
        $links = $db->table('student_parents')
            ->select('student_parents.student_id, student_parents.relation,
                      parents.id AS parent_id, parents.fname, parents.lname,
                      parents.phone')
            ->join('parents', 'parents.id = student_parents.parent_id')
            ->get()
            ->getResultArray();

        $byStudent = [];
        foreach ($links as $l) {
            $byStudent[$l['student_id']][] = $l;
        }

        foreach ($students as &$s) {
            $s['parents']     = $byStudent[$s['id']] ?? [];
            $s['parent_count'] = count($s['parents']);
        }
        unset($s);

        $data['students'] = $students;

        return view('students', $data);
    }

    // ========== VIEW ==========
    public function view($id)
    {
        // Only admin and staff can access the full student view with edit/delete
        if (session('role') != 'admin' && session('role') != 'staff') {
            if (session('role') == 'teacher') {
                return redirect()->to('/teachers-student-view/' . $id);
            }
            return redirect()->to('/dashboard');
        }

        $data['student'] = $this->studentModel->find($id);
        if (!$data['student']) return redirect()->to('/students')->with('error', 'Student not found');

        // Adviser: prefer students.adviser_id, fallback to teacher of same grade/section.
        $adviser = null;
        $db = \Config\Database::connect();
        if (!empty($data['student']['adviser_id'])) {
            $adviser = $db->table('teachers')->where('id', $data['student']['adviser_id'])->get()->getRowArray();
        }
        if (empty($adviser) && !empty($data['student']['grade_section'])) {
            $adviser = $db->table('teachers')
                ->where('grade_section', $data['student']['grade_section'])
                ->get()->getRowArray();
        }
        $data['adviser'] = $adviser;

        $data['parents'] = $this->parentsModel
            ->select('parents.*, student_parents.relation, parents.id as parent_id')
            ->join('student_parents', 'student_parents.parent_id = parents.id')
            ->where('student_parents.student_id', $id)
            ->findAll();

        $data['parentCount'] = count($data['parents']);
        $data['subFetchers'] = $this->subFetcherModel->where('student_id', $id)->findAll();

        // ===== FETCH HISTORY (date / session / who / what time) =====
        // Date selection: empty = every recorded day (plus today), otherwise
        // only that day. Invalid input is ignored instead of throwing.
        $selectedDate = (string) ($this->request->getGet('date') ?? '');
        if ($selectedDate !== '' && ! preg_match('/^\d{4}-\d{2}-\d{2}$/', $selectedDate)) {
            $selectedDate = '';
        }
        $search = trim((string) ($this->request->getGet('q') ?? ''));

        $logs = $db->table('fetch_logs')
            ->where('student_id', $id)
            ->orderBy('time_released', 'ASC')
            ->limit(2000)
            ->get()
            ->getResultArray();

        // Resolve the staff account behind staff_id. It may live in staffs,
        // teachers or admin depending on who was logged in at the scanner.
        $staffIds = array_values(array_unique(array_filter(array_column($logs, 'staff_id'))));
        $staffMap  = [];
        if (!empty($staffIds)) {
            foreach (['staffs', 'teachers', 'admin'] as $table) {
                foreach ($db->table($table)->select('id, fname, lname')->whereIn('id', $staffIds)->get()->getResultArray() as $row) {
                    $staffMap[$row['id']] = trim($row['fname'] . ' ' . $row['lname']);
                }
            }
        }

        // Guardian account behind each release, so the history can show the
        // profile block of the person who actually did the pickup.
        $parentIds = array_values(array_unique(array_filter(array_column($logs, 'parent_id'))));
        $parentMap = [];
        if (!empty($parentIds)) {
            foreach ($db->table('parents')
                ->select('id, parent_no, fname, mname, lname, phone, qr_code')
                ->whereIn('id', $parentIds)->get()->getResultArray() as $p) {
                $parentMap[$p['id']] = $p;
            }
        }

        // One row per REAL fetch log — nothing is synthesised. A session or a
        // day with no record never appears, so a morning scan can no longer
        // produce a phantom "afternoon not fetched" row.
        $historyRows = [];
        // Lookup: fetcher name -> profile picture URL (sub-fetchers assigned to this student).
        helper('photo');
        $fetcherPhotoMap = [];
        foreach (($data['subFetchers'] ?? []) as $sf) {
            $nm = strtolower(trim(($sf['fname'] ?? '') . ' ' . ($sf['lname'] ?? '')));
            $nmFull = strtolower(trim(($sf['fname'] ?? '') . ' ' . ($sf['mname'] ?? '') . ' ' . ($sf['lname'] ?? '')));
            foreach ([$nm, $nmFull] as $nmKey) {
                if ($nmKey !== '') {
                    $fetcherPhotoMap[$nmKey] = subfetcher_photo_url($sf['id'] ?? 0);
                }
            }
        }
        foreach ($logs as $l) {
            $guardian = !empty($l['parent_id']) ? ($parentMap[$l['parent_id']] ?? null) : null;

            $row = [
                'ts'       => $l['time_released'],
                'date'     => substr($l['time_released'], 0, 10),
                'session'  => $l['session_type'] ?: 'unspecified',
                'time'     => date('h:i A', strtotime($l['time_released'])),
                'fetcher'  => trim(($l['fetcher_fname'] ?? '') . ' ' . ($l['fetcher_mname'] ?? '') . ' ' . ($l['fetcher_lname'] ?? '')),
                'fetcher_photo' => $this->historyFetcherPhoto($l, $fetcherPhotoMap, $guardian),
                'relation' => $l['fetcher_relation'] ?? null,
                'method'   => $l['method'] ?? null,
                'staff'    => $staffMap[$l['staff_id']] ?? null,
                'guardian' => $guardian ? trim(($guardian['fname'] ?? '') . ' ' . ($guardian['lname'] ?? '')) : null,
                'guardian_no'    => $guardian['parent_no'] ?? null,
                'guardian_phone' => $guardian['phone'] ?? null,
            ];

            if ($selectedDate !== '' && $row['date'] !== $selectedDate) {
                continue;
            }
            if ($search !== '' && ! $this->historyRowMatches($row, $search)) {
                continue;
            }
            $historyRows[] = $row;
        }

        // Newest pickup first.
        usort($historyRows, static fn ($a, $b) => strcmp($b['ts'], $a['ts']));


        $data['history']      = $logs;
        $data['historyRows']  = $historyRows;
        $data['staffMap']     = $staffMap;
        $data['selectedDate'] = $selectedDate;
        $data['search']       = $search;

        return view('students_view', $data);
    }

    /**
     * Does a single history row match the free-text search box?
     * Matches date, session, fetcher, relation, method and releasing staff.
     */
    private function historyRowMatches(array $row, string $search): bool
    {
        $haystack = strtolower(implode(' ', array_filter([
            $row['date']     ?? '',
            $row['session']  ?? '',
            $row['time']     ?? '',
            $row['fetcher']  ?? '',
            $row['relation'] ?? '',
            $row['method']   ?? '',
            $row['staff']    ?? '',
        ], static fn ($v) => $v !== null && $v !== '')));

        return strpos($haystack, strtolower($search)) !== false;
    }

    // ========== ADD FORM ==========
    public function add()
    {
        if (! in_array(session('role'), ['admin', 'staff'], true)) {
            // Return the redirect (not bare return): requireAdminStaff()-style
            // send() + null lets CI4 still render the view body -> 200 with a
            // Location header, which a browser may ignore.
            return redirect()->to('/dashboard')->with('error', 'Access denied.');
        }
        return view('register');
    }

    // ========== SAVE STUDENT + PARENTS + FETCHERS ==========
    public function save()
    {
        if (! in_array(session('role'), ['admin', 'staff'], true)) {
            // Return the redirect (not bare return): requireAdminStaff()-style
            // send() + null lets CI4 still render the view body -> 200 with a
            // Location header, which a browser may ignore.
            return redirect()->to('/dashboard')->with('error', 'Access denied.');
        }
        $db = \Config\Database::connect();
        
        $db->transStart();

        try {
            // ===== ONE FORM, MANY STUDENTS =====
            // The register form can hold several student blocks ("+ Add student").
            // Each block posts fname/mname/lname/grade_section as a parallel array.
            // Single-block forms are normalised to arrays, so both shapes work.
            $sFnames = $this->asArray($this->request->getPost('fname'));
            $sMnames = $this->asArray($this->request->getPost('mname'));
            $sLnames = $this->asArray($this->request->getPost('lname'));
            $sGrades = $this->asArray($this->request->getPost('grade_section'));
            $sNumbers = $this->asArray($this->request->getPost('student_no'));

            if ($sFnames === []) {
                throw new \Exception('No student details provided');
            }

            $studentIds = [];
            $createdNames = [];

            foreach ($sFnames as $i => $sFname) {
                if (trim((string) $sFname) === '') {
                    continue;
                }
                $sLname = trim((string) ($sLnames[$i] ?? ''));
                if ($sLname === '') {
                    throw new \Exception('Student surname is required');
                }

                // Manual Student ID — typed by the registrar, never generated.
                $sNumber = trim((string) ($sNumbers[$i] ?? ''));
                if ($sNumber === '') {
                    throw new \Exception('Student ID is required for every student.');
                }
                if ($this->studentModel->where('student_no', $sNumber)->first()) {
                    throw new \Exception("Student ID {$sNumber} is already registered.");
                }

                $sid = $this->studentModel->insertWithAdviser([
                    'student_no'    => $sNumber,
                    'fname'         => $sFname,
                    'mname'         => $sMnames[$i] ?? null,
                    'lname'         => $sLname,
                    'grade_section' => $sGrades[$i] ?? null,
                    'created_by'    => session('user_id'),
                ]);

                if (!$sid) {
                    throw new \Exception('Failed to save student');
                }

                // ===== Student profile picture (optional) =====
                // A data-URL posted from the register avatar. Stored as
                // uploads/students/{student_no}.jpg so the rest of the system
                // picks it up automatically.
                helper('photo');
                $sPic   = $this->asArray($this->request->getPost('student_picture_data'));
                $sPicRm = $this->asArray($this->request->getPost('student_picture_remove'));
                $picData = (string) ($sPic[$i] ?? '');
                if ($picData !== '') {
                    photo_save_dataurl($picData, $sNumber);
                } elseif ((string) ($sPicRm[$i] ?? '0') === '1') {
                    student_photo_delete($sNumber);
                }

                $studentIds[] = $sid;
                $createdNames[] = trim($sFname . ' ' . $sLname);
            }

            if ($studentIds === []) {
                throw new \Exception('No valid student details provided');
            }

            // First student id kept for flashdata/back-compat (success modal).
            $studentId = $studentIds[0];

            $firstParentId = null;
            $registeredParents = [];
            $passwordSmsFailed = false;

            // Save parents (max 3)
            // The form posts parent_fname[] etc. Normalise scalars to arrays so a
            // single non-bracketed field can't fatal() the whole registration.
            $parentFnames = $this->asArray($this->request->getPost('parent_fname'));
            if ($parentFnames) {
                $parentMnames    = $this->asArray($this->request->getPost('parent_mname'));
                $parentLnames    = $this->asArray($this->request->getPost('parent_lname'));
                $parentPhones    = $this->asArray($this->request->getPost('parent_phone'));
                $parentRelations = $this->asArray($this->request->getPost('parent_relation'));
                $parentNos       = $this->asArray($this->request->getPost('parent_no'));

                foreach ($parentFnames as $i => $fname) {
                    if (empty($fname) || $i >= 3) continue;

                    $phone   = $this->normalizePhone($parentPhones[$i] ?? '');
                    $relation = $parentRelations[$i] ?? 'Parent';

                    // Manual Parent/Fetcher ID — must be P-<number>.
                    $parentNo = strtoupper(trim((string) ($parentNos[$i] ?? '')));
                    if ($parentNo === '') {
                        throw new \Exception('Parent/Fetcher ID is required.');
                    }
                    if (! str_starts_with($parentNo, 'P-')) {
                        $parentNo = preg_match('/(\d+)$/', $parentNo, $m) ? 'P-' . $m[1] : 'P-' . $parentNo;
                    }

                    // ===== ONE PARENT, MANY CHILDREN =====
                    // parents.phone is UNIQUE. If the phone already belongs to a
                    // registered parent, LINK that parent instead of inserting a
                    // duplicate (which would throw 1062 and roll the whole
                    // registration back). This is how a mother with two students
                    // in the same school gets registered under one account.
                    $existingParent = $phone !== ''
                        ? $this->parentsModel->where('phone', $phone)->first()
                        : null;

                    if ($existingParent) {
                        $parentId = $existingParent['id'];
                        $qrValue  = $existingParent['qr_code'];
                        if (empty($existingParent['parent_no'])) {
                            $this->parentsModel->update($parentId, ['parent_no' => $parentNo]);
                        }
                    } else {
                        if ($this->parentsModel->where('parent_no', $parentNo)->first()) {
                            throw new \Exception("Parent ID {$parentNo} is already registered.");
                        }
                        $qrValue  = $this->generateQR();
                        $parentId = $this->parentsModel->insert([
                            'parent_no'    => $parentNo,
                            'fname'        => $fname,
                            'mname'        => $parentMnames[$i] ?? null,
                            'lname'        => $parentLnames[$i] ?? '',
                            'phone'        => $phone,
                            'password'     => null,
                            'password_sent'=> 0,
                            'qr_code'      => $qrValue,
                            'created_by'   => session('user_id'),
                        ]);

                        if (!$parentId) {
                            throw new \Exception('Failed to save parent');
                        }
                    }

                    if ($firstParentId === null) {
                        $firstParentId = $parentId;
                    }

                    // ===== Parent profile picture (optional) =====
                    // Same data-URL mechanism, stored as
                    // uploads/parents/{parent_no}.jpg.
                    helper('photo');
                    $pPic   = $this->asArray($this->request->getPost('parent_picture_data'));
                    $pPicRm = $this->asArray($this->request->getPost('parent_picture_remove'));
                    $pPicData = (string) ($pPic[$i] ?? '');
                    if ($pPicData !== '') {
                        photo_save_parent_dataurl($pPicData, $parentNo);
                    } elseif ((string) ($pPicRm[$i] ?? '0') === '1') {
                        parent_photo_delete($parentNo);
                    }

                    $registeredParents[] = [
                        'fname'    => $existingParent ? $existingParent['fname'] : $fname,
                        'lname'    => $existingParent ? $existingParent['lname'] : ($parentLnames[$i] ?? ''),
                        'qr_code'  => $qrValue,
                        'relation' => $relation,
                        'existing' => (bool) $existingParent,
                    ];

                    // Idempotent link: every student created in this form gets
                    // tied to this parent. Re-submitting must not duplicate rows.
                    foreach ($studentIds as $sid) {
                        $alreadyLinked = $db->table('student_parents')
                            ->where('student_id', $sid)
                            ->where('parent_id', $parentId)
                            ->countAllResults();

                        if (! $alreadyLinked) {
                            $linked = $db->table('student_parents')->insert([
                                'student_id' => $sid,
                                'parent_id'  => $parentId,
                                'relation'   => $relation,
                            ]);

                            if (!$linked) {
                                throw new \Exception('Failed to link parent to student');
                            }
                        }
                    }
                }
            }

            // Save fetchers to sub_fetchers table (max 2)
            // sub_fetchers.parent_id drives Scan::verify(), which then returns
            // EVERY student linked to that parent — so one fetcher QR covers
            // all siblings registered in this form.
            $registeredFetchers = [];
            $fetcherFnames = $this->asArray($this->request->getPost('fetcher_fname'));
            if ($fetcherFnames && $firstParentId) {
                $fetcherMnames = $this->asArray($this->request->getPost('fetcher_mname'));
                $fetcherLnames = $this->asArray($this->request->getPost('fetcher_lname'));
                $fetcherPhones = $this->asArray($this->request->getPost('fetcher_phone'));

                foreach ($fetcherFnames as $i => $fname) {
                    if (empty($fname) || $i >= 2) continue;

                    $qrValue = $this->generateQR();
                    $fetcherId = $this->subFetcherModel->insert([
                        'parent_id'  => $firstParentId,
                        'student_id' => $studentIds[0],
                        'fname'      => $fname,
                        'mname'      => $fetcherMnames[$i] ?? null,
                        'lname'      => $fetcherLnames[$i] ?? '',
                        'phone'      => $this->normalizePhone($fetcherPhones[$i] ?? ''),
                        'qr_code'    => $qrValue,
                        'created_by' => session('user_id'),
                    ]);

                    if (!$fetcherId) {
                        throw new \Exception('Failed to save fetcher');
                    }

                    $registeredFetchers[] = [
                        'fname'   => $fname,
                        'lname'   => $fetcherLnames[$i] ?? '',
                        'qr_code' => $qrValue,
                    ];
                }
            }

            $this->logModel->addLog(
                session('user_id'), 
                session('fname').' '.session('lname'), 
                session('role'), 
                'create', 
                'student', 
                'Created: '.implode(', ', $createdNames)
                    . ' | ' . count($studentIds) . ' student(s) linked to '
                    . count($registeredParents) . ' parent(s)'
            );

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            session()->setFlashdata('registration_success', true);
            session()->setFlashdata('student_name', implode(', ', $createdNames));
            session()->setFlashdata('student_names', $createdNames);
            session()->setFlashdata('registered_parents', $registeredParents);
            session()->setFlashdata('registered_fetchers', $registeredFetchers);
            session()->setFlashdata('student_id', $studentId);
            session()->setFlashdata('showResult', true);
            session()->setFlashdata('password_sms_failed', $passwordSmsFailed);

            return redirect()->to('/register')->with('showResult', true);

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Registration failed: ' . $e->getMessage());
            return redirect()->to('/register')->with('error', 'Registration failed: ' . $e->getMessage());
        }
    }

    // ========== IMPORT STUDENTS + PARENTS FROM XLSX ==========
    public function importExcel()
    {
        session()->setFlashdata('import_kind', 'excel');
        if (! in_array(session('role'), ['admin', 'staff'], true)) {
            // Return the redirect (not bare return): requireAdminStaff()-style
            // send() + null lets CI4 still render the view body -> 200 with a
            // Location header, which a browser may ignore.
            return redirect()->to('/dashboard')->with('error', 'Access denied.');
        }
        $db = \Config\Database::connect();
        $file = $this->request->getFile('excel_file');

        if (!$file || !$file->isValid()) {
            return redirect()->to('/register')->with('error', 'Please choose an Excel (.xlsx) file to import.');
        }
        if (strtolower($file->getClientExtension()) !== 'xlsx') {
            return redirect()->to('/register')->with('error', 'Only .xlsx files are supported.');
        }

        $tmp = WRITEPATH . 'uploads/' . $file->getRandomName();
        $file->move(dirname($tmp), basename($tmp));

        try {
            require_once ROOTPATH . 'vendor/autoload.php';
            $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($tmp);
            $sheet = $spreadsheet->getActiveSheet();
            $rows = $sheet->toArray(null, true, true, true);
        } catch (\Throwable $e) {
            @unlink($tmp);
            return redirect()->to('/register')->with('error', 'Could not read the Excel file: ' . $e->getMessage());
        }
        @unlink($tmp);

        if (empty($rows) || count($rows) < 2) {
            return redirect()->to('/register')->with('error', 'The Excel file has no data rows.');
        }

        // Drop blank rows first, then drop the HEADER row (if it looks like
        // one). The old code blindly sliced off row 1, so a sheet starting
        // with an empty row imported the header itself as a student record.
        $rows = array_values(array_filter($rows, static function ($r) {
            if (!is_array($r)) {
                return false;
            }
            foreach ($r as $v) {
                if (trim((string) $v) !== '') {
                    return true;
                }
            }
            return false;
        }));

        if ($rows !== [] && $this->looksLikeHeaderRow($rows[0])) {
            array_shift($rows);
        }

        if ($rows === []) {
            return redirect()->to('/register')->with('error', 'The Excel file has no data rows.');
        }

        $imported    = 0;
        $reused      = 0;   // rows whose parent already existed (phone linked)
        $skipped     = 0;
        $skipReasons = [];
        $limit       = 500;

        // transStrict(false): CI4 otherwise latches transStatus=false for the
        // WHOLE connection after the first failed query, which is exactly why
        // one duplicate phone used to make every later row report "transaction
        // failed" even when it had already committed.
        $db->transStrict(false);

        foreach ($rows as $rowIndex => $r) {
            if ($imported + $skipped >= $limit) {
                break;
            }

            $vals = is_array($r) ? array_values($r) : [];

            $sfname = trim((string) ($vals[0] ?? ''));
            $smname = trim((string) ($vals[1] ?? ''));
            $slname = trim((string) ($vals[2] ?? ''));
            $grade  = trim((string) ($vals[3] ?? ''));
            $pfname = trim((string) ($vals[4] ?? ''));
            $pmname = trim((string) ($vals[5] ?? ''));
            $plname = trim((string) ($vals[6] ?? ''));
            $pphone = $this->normalizePhone($vals[7] ?? '');
            $rel    = trim((string) ($vals[8] ?? '')) ?: 'Parent';
            // Manual IDs — typed by the registrar in Excel, never generated.
            $studentNo = trim((string) ($vals[9] ?? ''));
            $parentNo  = strtoupper(trim((string) ($vals[10] ?? '')));

            $excelRow = $rowIndex + 1;

            if ($sfname === '' || $slname === '' || $pfname === '' || $plname === '' || $pphone === '') {
                $skipped++;
                $skipReasons[] = "row $excelRow: missing required field(s)";
                continue;
            }

            if ($studentNo === '') {
                $skipped++;
                $skipReasons[] = "row $excelRow: missing Student ID (column J)";
                continue;
            }
            if ($parentNo === '') {
                $skipped++;
                $skipReasons[] = "row $excelRow: missing Parent/Fetcher ID (column K)";
                continue;
            }
            if (!str_starts_with($parentNo, 'P-')) {
                $skipReasons[] = "row $excelRow: Parent ID must start with P- (got $parentNo)";
                $skipped++;
                continue;
            }

            // parents.phone is UNIQUE. Resolve BEFORE writing so one
            // duplicate phone can no longer abort the whole import.
            $existingParent = $this->parentsModel->where('phone', $pphone)->first();

            // Each row gets its own transaction: one bad row skips itself
            // instead of rolling back every previously imported row.
            $db->transStart();
            try {
                $studentId = $this->studentModel->insertWithAdviser([
                    'student_no'    => $studentNo,
                    'fname'         => $sfname,
                    'mname'         => $smname ?: null,
                    'lname'         => $slname,
                    'grade_section' => $grade,
                    'created_by'    => session('user_id'),
                ]);
                if (!$studentId) {
                    throw new \Exception('could not save student');
                }

                if ($existingParent) {
                    $parentId = $existingParent['id'];
                    $reused++;
                    // Fill the manual parent ID if the existing record has none.
                    if (empty($existingParent['parent_no'])) {
                        $this->parentsModel->update($parentId, ['parent_no' => $parentNo]);
                    }
                } else {
                    $qrValue  = $this->generateQR();
                    $parentId = $this->parentsModel->insert([
                        'parent_no'     => $parentNo,
                        'fname'         => $pfname,
                        'mname'         => $pmname ?: null,
                        'lname'         => $plname,
                        'phone'         => $pphone,
                        'password'      => null,
                        'password_sent' => 0,
                        'qr_code'       => $qrValue,
                        'created_by'    => session('user_id'),
                    ]);
                    if (!$parentId) {
                        throw new \Exception('could not save parent');
                    }
                }

                // Idempotent link: re-importing the same sheet must not
                // duplicate student_parents rows either.
                $alreadyLinked = $db->table('student_parents')
                    ->where('student_id', $studentId)
                    ->where('parent_id', $parentId)
                    ->countAllResults();
                if (!$alreadyLinked) {
                    $linked = $db->table('student_parents')->insert([
                        'student_id' => $studentId,
                        'parent_id'  => $parentId,
                        'relation'   => $rel,
                    ]);
                    if (!$linked) {
                        throw new \Exception('could not link parent to student');
                    }
                }

                $db->transComplete();

                if ($db->transStatus() === false) {
                    throw new \Exception('database rejected the row');
                }

                $imported++;
            } catch (\Throwable $e) {
                // Safe at depth 0 (no-op) and closes an open row transaction
                // otherwise, so one bad row can't poison the next iteration.
                $db->transRollback();
                $skipped++;
                $skipReasons[] = "row $excelRow: " . $e->getMessage();
                log_message('error', "Excel import row $excelRow failed: " . $e->getMessage());
            }
        }

        if ($imported > 0) {
            $this->logModel->addLog(
                session('user_id'),
                session('fname') . ' ' . session('lname'),
                session('role'),
                'create',
                'import',
                "Imported $imported students + parents from Excel"
            );
        }

        $msg = "Import complete! <strong>$imported</strong> student(s) registered.";
        if ($reused > 0) {
            $msg .= " <strong>$reused</strong> parent(s) already existed (phone linked, not duplicated).";
        }
        if ($skipped > 0) {
            $msg .= " <strong>$skipped</strong> row(s) skipped: " . htmlspecialchars(implode('; ', array_slice($skipReasons, 0, 5)));
            if (count($skipReasons) > 5) {
                $msg .= ' …';
            }
        }
        return redirect()->to('/register')->with('msg', $msg);
    }

    /**
     * ZIP import — bulk photos / attachments.
     *
     * The archive is extracted into public/uploads/<zip-name>/ so the files
     * land next to the student pictures. Entry paths are sanitised, so a
     * crafted archive cannot write outside that folder.
     */
    public function importZip()
    {
        session()->setFlashdata('import_kind', 'zip');
        if (! in_array(session('role'), ['admin', 'staff'], true)) {
            return redirect()->to('/dashboard')->with('error', 'Access denied.');
        }

        $file = $this->request->getFile('zip_file');

        if (! $file) {
            return redirect()->to('/register')->with('error', 'No ZIP file was selected.');
        }
        if (! $file->isValid()) {
            return redirect()->to('/register')->with('error', 'Upload failed: ' . $file->getErrorString());
        }

        $original = (string) $file->getClientName();
        $ext      = strtolower(pathinfo($original, PATHINFO_EXTENSION));
        if ($ext !== 'zip') {
            return redirect()->to('/register')->with('error', 'Only .zip archives are accepted.');
        }

        // Folder name = the archive name without .zip, made filesystem-safe.
        $folder = pathinfo($original, PATHINFO_FILENAME);
        $folder = preg_replace('/[^A-Za-z0-9 _\-\.]/', '', $folder);
        $folder = trim(str_replace(['..', ' ', '\\', '/'], ['', '_', '', ''], $folder), '._');
        if ($folder === '') {
            $folder = 'zip_' . date('Ymd_His');
        }

        $base = public_path('uploads');

        if (! is_dir($base) && ! @mkdir($base, 0775, true) && ! is_dir($base)) {
            return redirect()->to('/register')->with('error', 'Could not create the uploads folder.');
        }

        if (! class_exists('ZipArchive')) {
            return redirect()->to('/register')->with('error', 'The PHP zip extension is not enabled on this server.');
        }

        $zip = new \ZipArchive();
        if ($zip->open($file->getTempName()) !== true) {
            return redirect()->to('/register')->with('error', 'The ZIP file could not be opened — it may be corrupted.');
        }

        // Known photo folders under uploads/. A ZIP entry like
        // "parents/P-1001.jpg" goes straight to uploads/parents/P-1001.jpg
        // with no extra folder level.
        $photoFolders = ['students', 'parents', 'teachers', 'staffs', 'subfetchers', 'qr'];

        $extracted = 0;
        $skipped   = 0;
        $placed    = [];
        $realBase  = realpath($base);

        for ($i = 0; $i < $zip->numFiles; $i++) {
            $entry = (string) $zip->getNameIndex($i);
            if ($entry === '' || $entry === false) {
                continue;
            }

            $clean = str_replace('\\', '/', $entry);

            // Skip macOS resource forks and other hidden noise.
            if (str_starts_with($clean, '__MACOSX/') || preg_match('#(^|/)\.#', $clean)) {
                $skipped++;
                continue;
            }

            // Directory entries: nothing to create — files land flat.
            if (str_ends_with($clean, '/')) {
                continue;
            }

            $segments = array_values(array_filter(explode('/', $clean), static fn ($s) => $s !== ''));
            if ($segments === []) {
                $skipped++;
                continue;
            }

            $fileName = array_pop($segments);              // base name only
            $subDir   = null;

            foreach ($segments as $seg) {                  // first known folder wins
                $lower = strtolower($seg);
                if (in_array($lower, $photoFolders, true)) {
                    $subDir = $lower;
                    break;
                }
            }
            if ($subDir === null && in_array(strtolower($folder), $photoFolders, true)) {
                $subDir = strtolower($folder);             // archive named "parents.zip"
            }

            $destDir = $subDir !== null
                ? $base . DIRECTORY_SEPARATOR . $subDir
                : $base . DIRECTORY_SEPARATOR . $folder;

            if (! is_dir($destDir) && ! @mkdir($destDir, 0775, true) && ! is_dir($destDir)) {
                $skipped++;
                continue;
            }

            $dest = $destDir . DIRECTORY_SEPARATOR . $fileName;

            // Zip-slip guard: the resolved destination must stay inside uploads/.
            $realDir = realpath($destDir);
            if ($realBase === false || $realDir === false
                || ! str_starts_with(str_replace('\\', '/', $realDir . '/'), str_replace('\\', '/', $realBase . '/'))) {
                $skipped++;
                continue;
            }

            $stream = $zip->getStream($entry);
            if ($stream === false) {
                $skipped++;
                continue;
            }

            $out = @fopen($dest, 'wb');
            if ($out === false) {
                fclose($stream);
                $skipped++;
                continue;
            }
            stream_copy_to_stream($stream, $out);
            fclose($stream);
            fclose($out);
            $extracted++;
            $placed[$subDir ?? $folder] = ($placed[$subDir ?? $folder] ?? 0) + 1;
        }

        $zip->close();
        $file->move($base, $folder . '_source.zip', true);

        $this->logModel->addLog(
            session('user_id'),
            session('fname') . ' ' . session('lname'),
            session('role'),
            'create',
            'import',
            "Imported ZIP \"$original\" -> uploads/$folder/ ($extracted file(s), $skipped skipped)"
        );

        $destText = []; foreach ($placed as $d => $n) { $destText[] = "uploads/" . $d . "/ (" . $n . ")"; }
        $msg = "ZIP import complete! <strong>$extracted</strong> file(s) extracted to "
            . '<code>' . esc(implode(', ', $destText)) . '</code>';
        if ($skipped > 0) {
            $msg .= " — <strong>$skipped</strong> entry(ies) skipped.";
        }

        return redirect()->to('/register')->with('msg', $msg);
    }

    /**
     * True when the first cell(s) of a row are column titles rather than data.
     *
     * IMPORTANT: toArray(..., $returnCellRef = true) keys each row by cell
     * reference ('A', 'B', 'C' ...), NOT by 0-based index, so the raw row
     * must be re-indexed before reading position 0.
     */
    private function looksLikeHeaderRow(array $row): bool
    {
        $values = array_values($row);
        $first  = strtolower(trim((string) ($values[0] ?? '')));
        if ($first === '') {
            return false;
        }

        return str_starts_with($first, 'student first')
            || str_starts_with($first, 'first name')
            || in_array($first, ['firstname', 'student', 'name'], true);
    }

    // ========== UPDATE STUDENT ==========
    public function update()
    {
        if (! in_array(session('role'), ['admin', 'staff'], true)) {
            // Return the redirect (not bare return): requireAdminStaff()-style
            // send() + null lets CI4 still render the view body -> 200 with a
            // Location header, which a browser may ignore.
            return redirect()->to('/dashboard')->with('error', 'Access denied.');
        }
                $id = $this->request->getPost('id');
        $newStudentNo = strtoupper(trim((string) $this->request->getPost('student_no')));
        $oldStudent   = $this->studentModel->find($id);
        $data = [
            'fname' => $this->request->getPost('fname'),
            'mname' => $this->request->getPost('mname'),
            'lname' => $this->request->getPost('lname'),
            'grade_section' => $this->request->getPost('grade_section'),
        ];
        if ($newStudentNo !== '' && (!$oldStudent || $newStudentNo !== strtoupper((string) ($oldStudent['student_no'] ?? '')))) {
            if ($this->studentModel->where('student_no', $newStudentNo)->where('id !=', $id)->countAllResults() > 0) {
                return redirect()->to('/students')->with('error', 'Student ID ' . $newStudentNo . ' is already taken.');
            }
            $data['student_no'] = $newStudentNo;
        }

        $this->studentModel->updateWithAdviser($id, $data);

        // Profile picture (edit modal): save new image or remove the old one.
        $studentNo = (string) ($this->studentModel->find($id)['student_no'] ?? '');
        $oldNo = strtoupper((string) ($oldStudent['student_no'] ?? ''));
        if ($oldNo !== '' && $studentNo !== '' && $oldNo !== strtoupper($studentNo)) {
            // Move every photo variant (jpg/jpeg/png/webp) to the new id - no leftovers.
            helper('photo');
            photo_carry_over_id('students', student_photo_id($oldNo), student_photo_id($studentNo));
        }
        if ($studentNo !== '') {
            helper('photo');
            $pic = (string) $this->request->getPost('student_picture_data');
            if ($pic !== '') {
                photo_save_dataurl($pic, $studentNo);
            } elseif ($this->request->getPost('student_picture_remove') === '1') {
                student_photo_delete($studentNo);
            }
        }
        $this->logModel->addLog(
            session('user_id'), 
            session('fname').' '.session('lname'), 
            session('role'), 
            'update', 
            'student', 
            'Updated: '.$data['fname'].' '.$data['lname'].' (ID: '.$id.')'
        );
        return redirect()->to('/students-view/' . $id)->with('msg', 'Student updated');
    }

    // ========== DELETE STUDENT (With Cascade) ==========
    public function delete($id)
    {
        if (! in_array(session('role'), ['admin', 'staff'], true)) {
            // Return the redirect (not bare return): requireAdminStaff()-style
            // send() + null lets CI4 still render the view body -> 200 with a
            // Location header, which a browser may ignore.
            return redirect()->to('/dashboard')->with('error', 'Access denied.');
        }
        $db = \Config\Database::connect();
        $student = $this->studentModel->find($id);
        
        if (!$student) {
            return redirect()->to('/students')->with('error', 'Student not found');
        }

        $db->transStart();

        try {
            // 1. Get all parents linked to this student
            $parentLinks = $db->table('student_parents')
                ->where('student_id', $id)
                ->get()
                ->getResultArray();

            $parentIds = array_column($parentLinks, 'parent_id');

            // 2. Delete sub-fetchers linked to this student
            $db->table('sub_fetchers')->where('student_id', $id)->delete();

            // 3. Delete fetch_logs linked to this student
            $db->table('fetch_logs')->where('student_id', $id)->delete();

            // 4. Delete student_parents links
            $db->table('student_parents')->where('student_id', $id)->delete();

            // 5. Delete the student
            $this->studentModel->delete($id);

            // 6. Delete parents that are no longer linked to any student
            $deletedParents = [];
            foreach ($parentIds as $parentId) {
                $remainingLinks = $db->table('student_parents')
                    ->where('parent_id', $parentId)
                    ->countAllResults();

                if ($remainingLinks == 0) {
                    $parent = $db->table('parents')
                        ->where('id', $parentId)
                        ->get()
                        ->getRowArray();
                    
                    if ($parent) {
                        $db->table('sub_fetchers')->where('parent_id', $parentId)->delete();
                        $db->table('parents')->where('id', $parentId)->delete();
                        $deletedParents[] = $parent['fname'] . ' ' . $parent['lname'];
                    }
                }
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            $message = 'Student: ' . $student['fname'] . ' ' . $student['lname'] . ' deleted successfully! 🗑️';
            if (!empty($deletedParents)) {
                $message .= ' Parents deleted (no other students): ' . implode(', ', $deletedParents);
            }

            $this->logModel->addLog(
                session('user_id'), 
                session('fname').' '.session('lname'), 
                session('role'), 
                'delete', 
                'student', 
                'Deleted: '.$student['fname'].' '.$student['lname'].' (ID: '.$id.') with parents and sub-fetchers'
            );

            return redirect()->to('/students')->with('msg', $message);

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Delete student failed: ' . $e->getMessage());
            return redirect()->to('/students')->with('error', 'Delete failed: ' . $e->getMessage());
        }
    }

    // ========== REMOVE PARENT ==========
    public function removeParent($studentId, $parentId)
    {
        if (! in_array(session('role'), ['admin', 'staff'], true)) {
            // Return the redirect (not bare return): requireAdminStaff()-style
            // send() + null lets CI4 still render the view body -> 200 with a
            // Location header, which a browser may ignore.
            return redirect()->to('/dashboard')->with('error', 'Access denied.');
        }
        $db = \Config\Database::connect();
        $db->table('student_parents')->where('student_id', $studentId)->where('parent_id', $parentId)->delete();

        $count = $db->table('student_parents')->where('parent_id', $parentId)->countAllResults();
        if ($count == 0) {
            $this->parentsModel->delete($parentId);
        }

        $this->logModel->addLog(
            session('user_id'), 
            session('fname').' '.session('lname'), 
            session('role'), 
            'update', 
            'student', 
            'Removed parent (ID: '.$parentId.') from student (ID: '.$studentId.')'
        );
        return redirect()->to('/students-view/' . $studentId)->with('msg', 'Parent removed');
    }

    // ========== ADD PARENT ==========
    public function addParent()
    {
        if (! in_array(session('role'), ['admin', 'staff'], true)) {
            // Return the redirect (not bare return): requireAdminStaff()-style
            // send() + null lets CI4 still render the view body -> 200 with a
            // Location header, which a browser may ignore.
            return redirect()->to('/dashboard')->with('error', 'Access denied.');
        }
        $studentId = $this->request->getPost('student_id');
        $db = \Config\Database::connect();
        if ($db->table('student_parents')->where('student_id', $studentId)->countAllResults() >= 3) {
            return redirect()->to('/students-view/' . $studentId)->with('error', 'Maximum 3 parents');
        }

        $qrValue = $this->generateQR();

        $parentId = $this->parentsModel->insert([
            'fname'        => $this->request->getPost('fname'),
            'mname'        => $this->request->getPost('mname'),
            'lname'        => $this->request->getPost('lname'),
            'phone'        => $this->request->getPost('phone'),
            'password'     => null,
            'password_sent'=> 0,
            'qr_code'      => $qrValue,
            'created_by'   => session('user_id'),
        ]);

        $db->table('student_parents')->insert([
            'student_id' => $studentId,
            'parent_id'  => $parentId,
            'relation'   => $this->request->getPost('relation') ?? 'Parent',
        ]);

        $this->logModel->addLog(
            session('user_id'), 
            session('fname').' '.session('lname'), 
            session('role'), 
            'create', 
            'parent', 
            'Added: '.$this->request->getPost('fname').' '.$this->request->getPost('lname')
        );

        $msg = 'Parent added';
        return redirect()->to('/students-view/' . $studentId)->with('msg', $msg);
    }

    // ========== HELPERS ==========

    /**
     * Force a posted value into an array. The register form always posts
     * bracketed fields (parent_fname[]), but a hand-built or single-field
     * request returns a plain string, which breaks the foreach() below.
     *
     * @return array<int,mixed>
     */
    private function asArray($value): array
    {
        if ($value === null || $value === '') {
            return [];
        }
        return is_array($value) ? $value : [$value];
    }

    private function generateQR()
    {
        // Value first, PNG best-effort. The old copy used CWD-relative
        // include/paths and could fatal() the whole registration or import.
        $qrValue = $this->generateQrValue();
        $this->generateQrFile($qrValue, 35);
        return $qrValue;
    }

    /**
     * Profile picture for a pickup-history row: sub-fetcher photo first,
     * otherwise the guardian's parent photo. Null when neither exists.
     */
    private function historyFetcherPhoto(array $log, array $photoMap, ?array $guardian): ?string
    {
        $plain = strtolower(trim(($log['fetcher_fname'] ?? '') . ' ' . ($log['fetcher_lname'] ?? '')));
        $full  = strtolower(trim(($log['fetcher_fname'] ?? '') . ' ' . ($log['fetcher_mname'] ?? '') . ' ' . ($log['fetcher_lname'] ?? '')));

        $photo = $photoMap[$plain] ?? $photoMap[$full] ?? '';
        if ($photo === '' && $guardian) {
            $photo = parent_photo_url((string) ($guardian['parent_no'] ?? ''));
        }

        return $photo !== '' ? $photo : null;
    }

    /**
     * Excel drops the leading 0 from 09xxx phone numbers, leaving 10 digits.
     * Normalise every phone to the 11-digit local format (09XXXXXXXXX).
     */
    private function normalizePhone($raw): string
    {
        $digits = preg_replace('/\D+/', '', (string) $raw);

        if ($digits === '') {
            return '';
        }

        // 639xxxxxxxxx -> 09xxxxxxxxx
        if (strlen($digits) === 12 && str_starts_with($digits, '63')) {
            $digits = '0' . substr($digits, 2);
        }

        // 9xxxxxxxxx (leading 0 lost in Excel) -> 09xxxxxxxxx
        if (strlen($digits) === 10 && $digits[0] === '9') {
            $digits = '0' . $digits;
        }

        return $digits;
    }

}
