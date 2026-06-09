<?php

namespace App\Controllers;

use App\Models\ParentsModel;
use App\Models\SubFetcherModel;
use App\Models\ActivityLogModel;

class Parents extends BaseController
{
    protected $logModel;

    public function __construct()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }
        $this->logModel = new ActivityLogModel();
    }

    public function index()
    {
        $model = new ParentsModel();
        $db = \Config\Database::connect();
        
        $data['parents'] = $db->table('parents')
            ->select('parents.*, students.fname as student_fname, students.lname as student_lname, students.grade_section as student_grade, student_parents.relation')
            ->join('student_parents', 'student_parents.parent_id = parents.id', 'left')
            ->join('students', 'students.id = student_parents.student_id', 'left')
            ->orderBy('parents.created_at', 'DESC')
            ->get()
            ->getResultArray();
            
        return view('parents', $data);
    }

    public function view($id)
    {
        $model = new ParentsModel();
        $data['parent'] = $model->find($id);
        if (!$data['parent']) {
            return redirect()->to('/parents')->with('error', 'Parent not found');
        }

        $db = \Config\Database::connect();
        
        $data['students'] = $db->table('student_parents')
            ->select('student_parents.*, students.fname, students.mname, students.lname, students.grade_section, students.picture, students.id as student_id')
            ->join('students', 'students.id = student_parents.student_id')
            ->where('student_parents.parent_id', $id)
            ->get()
            ->getResultArray();

        $subFetcherModel = new SubFetcherModel();
        $data['subFetchers'] = $subFetcherModel->where('parent_id', $id)->findAll();

        return view('parents_view', $data);
    }

    public function add()
    {
        return view('parents_add');
    }

    public function edit($id)
    {
        $model = new ParentsModel();
        $data['parent'] = $model->find($id);
        if (!$data['parent']) {
            return redirect()->to('/parents')->with('error', 'Parent not found');
        }
        return view('parents_edit', $data);
    }

    public function save()
    {
        $model = new ParentsModel();
        $picture = $this->uploadPicture('picture');
        $qrValue = $this->generateQR();
        $model->save([
            'fname' => $this->request->getPost('fname'),
            'mname' => $this->request->getPost('mname'),
            'lname' => $this->request->getPost('lname'),
            'phone' => $this->request->getPost('phone'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'picture' => $picture,
            'qr_code' => $qrValue,
            'created_by' => session('user_id'),
        ]);
        $this->logModel->addLog(
            session('user_id'),
            session('fname') . ' ' . session('lname'),
            session('role'),
            'create',
            'parent',
            'Created parent: ' . $this->request->getPost('fname') . ' ' . $this->request->getPost('lname')
        );
        return redirect()->to('/parents')->with('msg', 'Parent added');
    }

    public function update()
    {
        $model = new ParentsModel();
        $id = $this->request->getPost('id');
        $data = [
            'fname' => $this->request->getPost('fname'),
            'mname' => $this->request->getPost('mname'),
            'lname' => $this->request->getPost('lname'),
            'phone' => $this->request->getPost('phone')
        ];
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
        $picture = $this->uploadPicture('picture');
        if ($picture) {
            $data['picture'] = $picture;
        }
        $model->update($id, $data);
        $this->logModel->addLog(
            session('user_id'),
            session('fname') . ' ' . session('lname'),
            session('role'),
            'update',
            'parent',
            'Updated parent: ' . $data['fname'] . ' ' . $data['lname'] . ' (ID: ' . $id . ')'
        );
        return redirect()->to('/parents')->with('msg', 'Parent updated');
    }

    public function delete($id)
    {
        $model = new ParentsModel();
        $parent = $model->find($id);
        $model->delete($id);
        $this->logModel->addLog(
            session('user_id'),
            session('fname') . ' ' . session('lname'),
            session('role'),
            'delete',
            'parent',
            'Deleted parent: ' . $parent['fname'] . ' ' . $parent['lname'] . ' (ID: ' . $id . ')'
        );
        return redirect()->to('/parents')->with('msg', 'Parent deleted');
    }

    public function updatePicture()
    {
        $model = new ParentsModel();
        $id = $this->request->getPost('id');
        $picture = $this->uploadPicture('picture');
        if ($picture) {
            $model->update($id, ['picture' => $picture]);
        }
        return redirect()->to('/parents-view/' . $id)->with('msg', 'Photo updated');
    }

    public function updateFromStudent()
    {
        $model = new ParentsModel();
        $id = $this->request->getPost('id');
        $studentId = $this->request->getPost('student_id');
        $data = [
            'fname' => $this->request->getPost('fname'),
            'mname' => $this->request->getPost('mname'),
            'lname' => $this->request->getPost('lname'),
            'phone' => $this->request->getPost('phone')
        ];
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
        $picture = $this->uploadPicture('picture');
        if ($picture) {
            $data['picture'] = $picture;
        }
        $model->update($id, $data);
        $this->logModel->addLog(
            session('user_id'),
            session('fname') . ' ' . session('lname'),
            session('role'),
            'update',
            'parent',
            'Updated parent: ' . $data['fname'] . ' ' . $data['lname'] . ' (ID: ' . $id . ')'
        );
        return redirect()->to('/students-view/' . $studentId)->with('msg', 'Parent updated');
    }

    public function logs()
    {
        $userId = session('user_id');
        $studentModel = new \App\Models\StudentModel();
        $subFetcherModel = new SubFetcherModel();
        
        $db = \Config\Database::connect();
        $studentParents = $db->table('student_parents')
            ->where('parent_id', $userId)
            ->get()
            ->getResultArray();
        
        $studentIds = [];
        foreach ($studentParents as $sp) {
            $studentIds[] = $sp['student_id'];
        }
        
        $oldStudents = $studentModel->where('parent_id', $userId)->findAll();
        foreach ($oldStudents as $s) {
            $studentIds[] = $s['id'];
        }
        
        $subFetchers = $subFetcherModel->where('parent_id', $userId)->findAll();
        foreach ($subFetchers as $sf) {
            $studentIds[] = $sf['student_id'];
        }
        
        $data['releases'] = [];
        if (!empty($studentIds)) {
            $studentIds = array_unique($studentIds);
            $fetchLogModel = new \App\Models\FetchLogModel();
            $releases = $fetchLogModel
                ->whereIn('student_id', $studentIds)
                ->orderBy('time_released', 'DESC')
                ->limit(50)
                ->findAll();
            
            foreach ($releases as &$release) {
                $student = $studentModel->find($release['student_id']);
                if ($student) {
                    $release['sfname'] = $student['fname'];
                    $release['smname'] = $student['mname'] ?? '';
                    $release['slname'] = $student['lname'];
                }
            }
            $data['releases'] = $releases;
        }
        
        return view('parents_logs', $data);
    }

    private function uploadPicture($fieldName)
    {
        $captureData = $this->request->getPost('picture_capture');
        if ($captureData && strpos($captureData, 'data:image') === 0) {
            $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $captureData));
            $pictureName = 'photo_' . time() . '.png';
            file_put_contents('uploads/parents/' . $pictureName, $imageData);
            return $pictureName;
        }
        $file = $this->request->getFile($fieldName);
        if ($file && $file->isValid() && !$file->hasMoved()) {
            $pictureName = $file->getRandomName();
            $file->move('uploads/parents', $pictureName);
            return $pictureName;
        }
        return null;
    }

    /**
     * Generate QR code with text label below it
     */
    private function generateQR()
    {
        $qrValue = 'QR-' . strtoupper(bin2hex(random_bytes(6)));
        include_once('phpqrcode/qrlib.php');
        
        // Generate the QR code image first
        $qrImagePath = 'uploads/qr/' . $qrValue . '_qrcode.png';
        \QRcode::png($qrValue, $qrImagePath, QR_ECLEVEL_H, 8, 2);
        
        // Create a new image with space for text below QR code
        $qrImage = imagecreatefrompng($qrImagePath);
        $qrWidth = imagesx($qrImage);
        $qrHeight = imagesy($qrImage);
        
        // Set dimensions for the combined image
        $textHeight = 40; // Space for text below QR
        $padding = 10;
        $totalWidth = $qrWidth;
        $totalHeight = $qrHeight + $textHeight + $padding;
        
        // Create new canvas
        $combinedImage = imagecreatetruecolor($totalWidth, $totalHeight);
        
        // White background
        $white = imagecolorallocate($combinedImage, 255, 255, 255);
        imagefill($combinedImage, 0, 0, $white);
        
        // Copy QR code to top
        imagecopy($combinedImage, $qrImage, 0, 0, 0, 0, $qrWidth, $qrHeight);
        
        // Add text below QR code
        $black = imagecolorallocate($combinedImage, 0, 0, 0);
        $fontSize = 5; // Built-in GD font size (1-5)
        $text = $qrValue;
        
        // Calculate text position (centered)
        $textWidth = imagefontwidth($fontSize) * strlen($text);
        $textX = ($totalWidth - $textWidth) / 2;
        $textY = $qrHeight + 12;
        
        // Draw text
        imagestring($combinedImage, $fontSize, $textX, $textY, $text, $black);
        
        // Save the combined image
        $finalPath = 'uploads/qr/' . $qrValue . '.png';
        imagepng($combinedImage, $finalPath);
        
        // Clean up
        imagedestroy($qrImage);
        imagedestroy($combinedImage);
        
        // Delete the QR-only file
        if (file_exists($qrImagePath)) {
            unlink($qrImagePath);
        }
        
        return $qrValue;
    }
}