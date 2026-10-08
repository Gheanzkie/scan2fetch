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

        $students = $this->studentModel->orderBy('created_at', 'DESC')->findAll();

        // Attach every linked parent/guardian to each student so the Student
        // Management table can show a full household instead of nothing.
        $links = $db->table('student_parents')
            ->select('student_parents.student_id, student_parents.relation,
                      parents.id AS parent_id, parents.fname, parents.lname,
                      parents.phone, parents.picture')
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
            $sPics   = $this->uploadStudentPictures();

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

                $sid = $this->studentModel->insert([
                    'fname'         => $sFname,
                    'mname'         => $sMnames[$i] ?? null,
                    'lname'         => $sLname,
                    'grade_section' => $sGrades[$i] ?? null,
                    'picture'       => $sPics[$i] ?? null,
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
                $parentPictures  = $this->uploadParentPictures();

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
                            'lname'        => $parentLnames[$i],
                            'phone'        => $phone,
                            'password'     => null,
                            'password_sent'=> 0,
                            'qr_code'      => $qrValue,
                            'picture'      => $parentPictures[$i] ?? null,
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
                        'lname'    => $existingParent ? $existingParent['lname'] : $parentLnames[$i],
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
                $fetcherPictures = $this->uploadFetcherPictures();

                foreach ($fetcherFnames as $i => $fname) {
                    if (empty($fname) || $i >= 2) continue;

                    $qrValue = $this->generateQR();
                    $fetcherId = $this->subFetcherModel->insert([
                        'parent_id'  => $firstParentId,
                        'student_id' => $studentIds[0],
                        'fname'      => $fname,
                        'mname'      => $fetcherMnames[$i] ?? null,
                        'lname'      => $fetcherLnames[$i],
                        'phone'      => $fetcherPhones[$i],
                        'picture'    => $fetcherPictures[$i] ?? null,
                        'qr_code'    => $qrValue,
                        'created_by' => session('user_id'),
                    ]);

                    if (!$fetcherId) {
                        throw new \Exception('Failed to save fetcher');
                    }

                    $registeredFetchers[] = [
                        'fname'   => $fname,
                        'lname'   => $fetcherLnames[$i],
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

        // Remove the header row (first row).
        $rows = array_values(array_slice($rows, 1));

        $imported = 0;
        $skipped = 0;
        $errors = [];
        $limit = 500;

        $db->transStart();
        try {
            foreach ($rows as $r) {
                if ($imported + $skipped >= $limit) break;

                $vals = array_values($r);

                $sfname = trim((string)($vals[0] ?? ''));
                $smname = trim((string)($vals[1] ?? ''));
                $slname = trim((string)($vals[2] ?? ''));
                $grade  = trim((string)($vals[3] ?? ''));
                $pfname = trim((string)($vals[4] ?? ''));
                $pmname = trim((string)($vals[5] ?? ''));
                $plname = trim((string)($vals[6] ?? ''));
                $pphone = trim((string)($vals[7] ?? ''));
                $rel    = trim((string)($vals[8] ?? '')) ?: 'Parent';

                if ($sfname === '' || $slname === '' || $pfname === '' || $plname === '' || $pphone === '') {
                    $skipped++;
                    continue;
                }

                $studentId = $this->studentModel->insert([
                    'fname'         => $sfname,
                    'mname'         => $smname ?: null,
                    'lname'         => $slname,
                    'grade_section' => $grade,
                    'picture'       => null,
                    'created_by'    => session('user_id'),
                ]);
                if (!$studentId) {
                    $skipped++;
                    continue;
                }

                $qrValue  = $this->generateQR();
                $parentId = $this->parentsModel->insert([
                    'fname'        => $pfname,
                    'mname'        => $pmname ?: null,
                    'lname'        => $plname,
                    'phone'        => $pphone,
                    'password'     => null,
                    'password_sent'=> 0,
                    'qr_code'      => $qrValue,
                    'picture'      => null,
                    'created_by'   => session('user_id'),
                ]);
                if (!$parentId) {
                    $skipped++;
                    continue;
                }

                $db->table('student_parents')->insert([
                    'student_id' => $studentId,
                    'parent_id'  => $parentId,
                    'relation'   => $rel,
                ]);

                $imported++;
            }

            $db->transComplete();
        } catch (\Throwable $e) {
            $db->transRollback();
            return redirect()->to('/register')->with('error', 'Import failed: ' . $e->getMessage());
        }

        if ($db->transStatus() === false) {
            return redirect()->to('/register')->with('error', 'Import transaction failed.');
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
        if ($skipped > 0) {
            $msg .= " <strong>$skipped</strong> row(s) skipped (missing required fields).";
        }
        return redirect()->to('/register')->with('msg', $msg);
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
        $pictureName = $this->uploadStudentPicture();
        if ($pictureName) $data['picture'] = $pictureName;
        $this->studentModel->update($id, $data);
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

        $pictureName = $this->uploadParentPicture();
        $qrValue = $this->generateQR();

        $parentId = $this->parentsModel->insert([
            'fname'        => $this->request->getPost('fname'),
            'mname'        => $this->request->getPost('mname'),
            'lname'        => $this->request->getPost('lname'),
            'phone'        => $this->request->getPost('phone'),
            'password'     => null,
            'password_sent'=> 0,
            'picture'      => $pictureName,
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

    private function uploadStudentPicture()
    {
        $captureData = $this->request->getPost('picture_capture');
        if ($captureData && strpos($captureData, 'data:image') === 0) {
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $captureData));
            $name = 'student_' . time() . '.png';
            file_put_contents('uploads/students/' . $name, $imageData);
            return $name;
        }
        $file = $this->request->getFile('picture');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $name = $file->getRandomName();
            $file->move('uploads/students', $name);
            return $name;
        }
        return null;
    }

    /**
     * One photo per student block (the "+ Add student" repeater posts
     * picture[] / picture_capture[] as parallel arrays). Missing or invalid
     * slots are padded with null so indexes stay aligned with fname[].
     *
     * @return array<int,?string>
     */
    private function uploadStudentPictures(): array
    {
        $count = count($this->asArray($this->request->getPost('fname')));
        $pics  = array_fill(0, max($count, 1), null);

        // Camera-capture payloads (data URLs) posted per block.
        $captures = $this->asArray($this->request->getPost('picture_capture'));
        // Uploaded files (input type=file name="picture[]").
        $files = $this->request->getFileMultiple('picture') ?: [];

        for ($i = 0; $i < $count; $i++) {
            $capture = $captures[$i] ?? null;
            if (is_string($capture) && strpos($capture, 'data:image') === 0) {
                $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $capture));
                $name = 'student_' . time() . '_' . uniqid() . '.png';
                file_put_contents('uploads/students/' . $name, $imageData);
                $pics[$i] = $name;
                continue;
            }

            $file = $files[$i] ?? null;
            if ($file && $file->isValid() && ! $file->hasMoved()) {
                $name = $file->getRandomName();
                $file->move('uploads/students', $name);
                $pics[$i] = $name;
            }
        }

        return $pics;
    }

    private function uploadParentPicture()
    {
        $captureData = $this->request->getPost('parent_picture_capture');
        if ($captureData && strpos($captureData, 'data:image') === 0) {
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $captureData));
            $name = 'parent_' . time() . '.png';
            file_put_contents('uploads/parents/' . $name, $imageData);
            return $name;
        }
        $file = $this->request->getFile('parent_picture');
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $name = $file->getRandomName();
            $file->move('uploads/parents', $name);
            return $name;
        }
        return null;
    }

    private function uploadParentPictures()
    {
        $pictures = [];
        $parentPictures = $this->request->getFileMultiple('parent_picture');
        
        if ($parentPictures) {
            foreach ($parentPictures as $file) {
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    $name = 'parent_' . time() . '_' . uniqid() . '.png';
                    $file->move('uploads/parents', $name);
                    $pictures[] = $name;
                } else {
                    $pictures[] = null;
                }
            }
        }
        
        return $pictures;
    }

    private function uploadFetcherPictures()
    {
        $pictures = [];
        $fetcherPictures = $this->request->getFileMultiple('fetcher_picture');
        
        if ($fetcherPictures) {
            foreach ($fetcherPictures as $file) {
                if ($file && $file->isValid() && !$file->hasMoved()) {
                    $name = 'fetcher_' . time() . '_' . uniqid() . '.png';
                    $file->move('uploads/parents', $name);
                    $pictures[] = $name;
                } else {
                    $pictures[] = null;
                }
            }
        }
        
        return $pictures;
    }

    private function generateQR()
    {
        $qrValue = $this->generateQrValue();
        include_once('phpqrcode/qrlib.php');
        
        $qrImagePath = 'uploads/qr/' . $qrValue . '_tmp.png';
        \QRcode::png($qrValue, $qrImagePath, QR_ECLEVEL_H, 8, 2);
        
        $qrImage = imagecreatefrompng($qrImagePath);
        $qrWidth = imagesx($qrImage);
        $qrHeight = imagesy($qrImage);
        
        $textHeight = 35;
        $totalHeight = $qrHeight + $textHeight;
        $totalWidth = $qrWidth;
        
        $combinedImage = imagecreatetruecolor($totalWidth, $totalHeight);
        $white = imagecolorallocate($combinedImage, 255, 255, 255);
        imagefill($combinedImage, 0, 0, $white);
        imagecopy($combinedImage, $qrImage, 0, 0, 0, 0, $qrWidth, $qrHeight);
        
        $black = imagecolorallocate($combinedImage, 0, 0, 0);
        $fontSize = 5;
        $text = $qrValue;
        
        $textWidth = imagefontwidth($fontSize) * strlen($text);
        $textX = max(0, ($totalWidth - $textWidth) / 2);
        $textY = $qrHeight + 8;
        
        imageline($combinedImage, 0, $qrHeight, $totalWidth, $qrHeight, $black);
        imagestring($combinedImage, $fontSize, (int)$textX, $textY, $text, $black);
        
        $finalPath = 'uploads/qr/' . $qrValue . '.png';
        imagepng($combinedImage, $finalPath);
        
        imagedestroy($qrImage);
        imagedestroy($combinedImage);
        
        if (file_exists($qrImagePath)) {
            unlink($qrImagePath);
        }
        
        return $qrValue;
    }
}