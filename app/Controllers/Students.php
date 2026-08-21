<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\ParentsModel;
use App\Models\SubFetcherModel;
use App\Models\ActivityLogModel;

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
        $data['students'] = $this->studentModel->orderBy('created_at', 'DESC')->findAll();
        return view('students', $data);
    }

    // ========== VIEW ==========
    public function view($id)
    {
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
            $pictureName = $this->uploadStudentPicture();

            $studentId = $this->studentModel->insert([
                'fname'         => $this->request->getPost('fname'),
                'mname'         => $this->request->getPost('mname'),
                'lname'         => $this->request->getPost('lname'),
                'grade_section' => $this->request->getPost('grade_section'),
                'picture'       => $pictureName,
                'created_by'    => session('user_id'),
            ]);

            if (!$studentId) {
                throw new \Exception('Failed to save student');
            }

            $firstParentId = null;
            $registeredParents = [];

            // Save parents (max 3)
            $parentFnames = $this->request->getPost('parent_fname');
            if ($parentFnames) {
                $parentMnames    = $this->request->getPost('parent_mname');
                $parentLnames    = $this->request->getPost('parent_lname');
                $parentPhones    = $this->request->getPost('parent_phone');
                $parentRelations = $this->request->getPost('parent_relation');
                $parentPasswords = $this->request->getPost('parent_password');
                $parentPictures  = $this->uploadParentPictures();

                foreach ($parentFnames as $i => $fname) {
                    if (empty($fname) || $i >= 3) continue;

                    $qrValue = $this->generateQR();
                    $parentId = $this->parentsModel->insert([
                        'fname'      => $fname,
                        'mname'      => $parentMnames[$i] ?? null,
                        'lname'      => $parentLnames[$i],
                        'phone'      => $parentPhones[$i],
                        'password'   => password_hash($parentPasswords[$i] ?? 'parent123', PASSWORD_DEFAULT),
                        'qr_code'    => $qrValue,
                        'picture'    => $parentPictures[$i] ?? null,
                        'created_by' => session('user_id'),
                    ]);

                    if (!$parentId) {
                        throw new \Exception('Failed to save parent');
                    }

                    if ($firstParentId === null) {
                        $firstParentId = $parentId;
                    }

                    $registeredParents[] = [
                        'fname'    => $fname,
                        'lname'    => $parentLnames[$i],
                        'qr_code'  => $qrValue,
                        'relation' => $parentRelations[$i] ?? 'Parent',
                    ];

                    $linked = $this->parentsModel->db->table('student_parents')->insert([
                        'student_id' => $studentId,
                        'parent_id'  => $parentId,
                        'relation'   => $parentRelations[$i] ?? 'Parent',
                    ]);

                    if (!$linked) {
                        throw new \Exception('Failed to link parent to student');
                    }
                }
            }

            // Save fetchers to sub_fetchers table (max 2)
            $registeredFetchers = [];
            $fetcherFnames = $this->request->getPost('fetcher_fname');
            if ($fetcherFnames && $firstParentId) {
                $fetcherMnames = $this->request->getPost('fetcher_mname');
                $fetcherLnames = $this->request->getPost('fetcher_lname');
                $fetcherPhones = $this->request->getPost('fetcher_phone');
                $fetcherPictures = $this->uploadFetcherPictures();

                foreach ($fetcherFnames as $i => $fname) {
                    if (empty($fname) || $i >= 2) continue;

                    $qrValue = $this->generateQR();
                    $fetcherId = $this->subFetcherModel->insert([
                        'parent_id'  => $firstParentId,
                        'student_id' => $studentId,
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
                'Created: '.$this->request->getPost('fname').' '.$this->request->getPost('lname')
            );

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            session()->setFlashdata('registration_success', true);
            session()->setFlashdata('student_name', $this->request->getPost('fname') . ' ' . $this->request->getPost('lname'));
            session()->setFlashdata('registered_parents', $registeredParents);
            session()->setFlashdata('registered_fetchers', $registeredFetchers);
            session()->setFlashdata('student_id', $studentId);
            session()->setFlashdata('showResult', true);

            return redirect()->to('/register')->with('showResult', true);

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Registration failed: ' . $e->getMessage());
            return redirect()->to('/register')->with('error', 'Registration failed: ' . $e->getMessage());
        }
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
            'fname'      => $this->request->getPost('fname'),
            'mname'      => $this->request->getPost('mname'),
            'lname'      => $this->request->getPost('lname'),
            'phone'      => $this->request->getPost('phone'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'picture'    => $pictureName,
            'qr_code'    => $qrValue,
            'created_by' => session('user_id'),
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
        return redirect()->to('/students-view/' . $studentId)->with('msg', 'Parent added');
    }

    // ========== HELPERS ==========
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
        $qrValue = 'QR-' . strtoupper(bin2hex(random_bytes(6)));
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