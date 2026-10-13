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
    public function index()
    {
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

        $data['parents'] = $this->parentsModel
            ->select('parents.*, student_parents.relation, parents.id as parent_id')
            ->join('student_parents', 'student_parents.parent_id = parents.id')
            ->where('student_parents.student_id', $id)
            ->findAll();

        $data['parentCount'] = count($data['parents']);
        $data['subFetchers'] = $this->subFetcherModel->where('student_id', $id)->findAll();

        return view('students_view', $data);
    }

    // ========== ADD FORM ==========
    public function add()
    {
        return view('register');
    }

    // ========== EDIT FORM ==========
    public function edit($id)
    {
        $data['student'] = $this->studentModel->find($id);
        if (!$data['student']) return redirect()->to('/students')->with('error', 'Student not found');
        return view('students_edit', $data);
    }

    // ========== SAVE STUDENT + PARENTS + FETCHERS ==========
    public function save()
    {
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

                $sid = $this->studentModel->insertWithAdviser([
                    'fname'         => $sFname,
                    'mname'         => $sMnames[$i] ?? null,
                    'lname'         => $sLname,
                    'grade_section' => $sGrades[$i] ?? null,
                    'created_by'    => session('user_id'),
                ]);

                if (!$sid) {
                    throw new \Exception('Failed to save student');
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

                foreach ($parentFnames as $i => $fname) {
                    if (empty($fname) || $i >= 3) continue;

                    $phone   = trim((string) ($parentPhones[$i] ?? ''));
                    $relation = $parentRelations[$i] ?? 'Parent';

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
                    } else {
                        $qrValue  = $this->generateQR();
                        $parentId = $this->parentsModel->insert([
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
                        'phone'      => $fetcherPhones[$i] ?? '',
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
            $pphone = trim((string) ($vals[7] ?? ''));
            $rel    = trim((string) ($vals[8] ?? '')) ?: 'Parent';

            $excelRow = $rowIndex + 1;

            if ($sfname === '' || $slname === '' || $pfname === '' || $plname === '' || $pphone === '') {
                $skipped++;
                $skipReasons[] = "row $excelRow: missing required field(s)";
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
                } else {
                    $qrValue  = $this->generateQR();
                    $parentId = $this->parentsModel->insert([
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
        $id = $this->request->getPost('id');
        $data = [
            'fname' => $this->request->getPost('fname'),
            'mname' => $this->request->getPost('mname'),
            'lname' => $this->request->getPost('lname'),
            'grade_section' => $this->request->getPost('grade_section'),
        ];
        $this->studentModel->updateWithAdviser($id, $data);
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

    // ========== DELETE ALL STUDENTS (ADMIN ONLY) ==========
    public function deleteAll()
    {
        if (session('role') != 'admin') {
            return redirect()->to('/students')->with('error', 'Admin only.');
        }

        $db = \Config\Database::connect();
        $db->transStart();

        try {
            $count = $this->studentModel->countAllResults();

            // DELETE, never TRUNCATE: MySQL refuses to TRUNCATE a table that
            // is referenced by a foreign key (fk_fetchlogs_student etc.),
            // which made this method roll back every time.
            // Children first, then students, then parents; wipeTable() runs a
            // bare DELETE FROM so the ON DELETE CASCADE / SET NULL clauses
            // handle the rest (TRUNCATE is refused by MySQL on FK'd tables).
            $this->wipeTable('fetch_logs');
            $this->wipeTable('sub_fetchers');
            $this->wipeTable('student_parents');

            $parentCount = $this->parentsModel->countAllResults();

            $this->wipeTable('students');
            $this->wipeTable('parents');

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            $this->logModel->addLog(
                session('user_id'), session('fname').' '.session('lname'), session('role'),
                'delete', 'student',
                "DELETED ALL students ($count), parents ($parentCount), sub-fetchers and logs"
            );

            return redirect()->to('/students')->with('msg', "All $count student(s) deleted. $parentCount orphaned parent(s) also removed.");
        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Delete all students failed: ' . $e->getMessage());
            return redirect()->to('/students')->with('error', 'Delete all failed: ' . $e->getMessage());
        }
    }

    // ========== REMOVE PARENT ==========
    public function removeParent($studentId, $parentId)
    {
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
}