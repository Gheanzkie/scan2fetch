<?php

namespace App\Controllers;

use App\Models\ParentsModel;
use App\Models\SubFetcherModel;
use App\Models\ActivityLogModel;

class Parents extends BaseController
{
    protected $parentsModel;
    protected $subFetcherModel;
    protected $logModel;

    public function __construct()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }
        $this->parentsModel    = new ParentsModel();
        $this->subFetcherModel = new SubFetcherModel();
        $this->logModel        = new ActivityLogModel();
    }

    public function index()
    {
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
        $data['parent'] = $this->parentsModel->find($id);
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

        $teachers = $db->table('teachers')->get()->getResultArray();
        $teacherMap = [];
        foreach ($teachers as $t) {
            if (!isset($teacherMap[$t['grade_section']])) {
                $teacherMap[$t['grade_section']] = $t['fname'] . ' ' . $t['lname'];
            }
        }
        $data['teacherMap'] = $teacherMap;

        $data['subFetchers'] = $this->subFetcherModel->where('parent_id', $id)->findAll();

        return view('parents_view', $data);
    }

    public function edit($id)
    {
        $data['parent'] = $this->parentsModel->find($id);
        if (!$data['parent']) {
            return redirect()->to('/parents')->with('error', 'Parent not found');
        }
        return view('parents_edit', $data);
    }

    public function save()
    {
        $picture = $this->uploadPicture('picture');
        $qrValue = $this->generateQR();
        $password = $this->generatePassword();

        $this->parentsModel->save([
            'fname' => $this->request->getPost('fname'),
            'mname' => $this->request->getPost('mname'),
            'lname' => $this->request->getPost('lname'),
            'phone' => $this->request->getPost('phone'),
            'password' => password_hash($password, PASSWORD_DEFAULT),
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

        $this->sendLocalSms(
            $this->request->getPost('phone'),
            'Your Scan2Fetch account password is: ' . $password . ' (recorded in SMS logs).'
        );

        $msg = 'Parent added';
        return redirect()->to('/parents')->with('msg', $msg);
    }

    // ===== SEND / RESET PASSWORD VIA SMS =====
    public function sendPassword($id)
    {
        $parent = $this->parentsModel->find($id);
        if (!$parent) {
            return redirect()->to('/parents')->with('error', 'Parent not found');
        }

        $password = $this->generatePassword();
        $this->parentsModel->update($id, ['password' => password_hash($password, PASSWORD_DEFAULT)]);

        $this->sendLocalSms(
            $parent['phone'],
            'Your new Scan2Fetch account password is: ' . $password . ' (recorded in SMS logs).'
        );

        $this->logModel->addLog(
            session('user_id'),
            session('fname') . ' ' . session('lname'),
            session('role'),
            'update',
            'parent',
            'Reset password and sent via SMS for parent: ' . $parent['fname'] . ' ' . $parent['lname'] . ' (ID: ' . $id . ')'
        );

        $msg = 'New password recorded in SMS logs.';
        return redirect()->to('/parents-view/' . $id)->with('msg', $msg);
    }

    public function update()
    {
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
        $this->parentsModel->update($id, $data);
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

    // ========== DELETE PARENT (With Student Deletion) ==========
    public function delete($id)
    {
        $db = \Config\Database::connect();
        $parent = $this->parentsModel->find($id);
        
        if (!$parent) {
            return redirect()->to('/parents')->with('error', 'Parent not found');
        }

        $db->transStart();

        try {
            // 1. Get all students linked to this parent
            $studentLinks = $db->table('student_parents')
                ->where('parent_id', $id)
                ->get()
                ->getResultArray();

            $studentIds = array_column($studentLinks, 'student_id');

            // 2. Delete sub-fetchers linked to this parent
            $db->table('sub_fetchers')->where('parent_id', $id)->delete();

            // 3. Delete student_parents links
            $db->table('student_parents')->where('parent_id', $id)->delete();

            // 4. Delete the parent
            $this->parentsModel->delete($id);

            // 5. Delete students with no parents left
            $deletedStudents = [];
            foreach ($studentIds as $studentId) {
                $remainingParents = $db->table('student_parents')
                    ->where('student_id', $studentId)
                    ->countAllResults();

                if ($remainingParents == 0) {
                    $student = $db->table('students')
                        ->where('id', $studentId)
                        ->get()
                        ->getRowArray();
                    
                    if ($student) {
                        $db->table('fetch_logs')->where('student_id', $studentId)->delete();
                        $db->table('students')->where('id', $studentId)->delete();
                        $deletedStudents[] = $student['fname'] . ' ' . $student['lname'];
                    }
                }
            }

            $db->transComplete();

            if ($db->transStatus() === false) {
                throw new \Exception('Transaction failed');
            }

            $message = 'Parent: ' . $parent['fname'] . ' ' . $parent['lname'] . ' deleted successfully! 🗑️';
            if (!empty($deletedStudents)) {
                $message .= ' Student(s) deleted (no other parents): ' . implode(', ', $deletedStudents);
            }

            $this->logModel->addLog(
                session('user_id'),
                session('fname') . ' ' . session('lname'),
                session('role'),
                'delete',
                'parent',
                'Deleted parent: ' . $parent['fname'] . ' ' . $parent['lname'] . ' (ID: ' . $id . ') with sub-fetchers. Students deleted: ' . implode(', ', $deletedStudents)
            );

            return redirect()->to('/parents')->with('msg', $message);

        } catch (\Exception $e) {
            $db->transRollback();
            log_message('error', 'Delete parent failed: ' . $e->getMessage());
            return redirect()->to('/parents')->with('error', 'Delete failed: ' . $e->getMessage());
        }
    }

    public function updatePicture()
    {
        $id = $this->request->getPost('id');
        $picture = $this->uploadPicture('picture');
        if ($picture) {
            $this->parentsModel->update($id, ['picture' => $picture]);
        }
        return redirect()->to('/parents-view/' . $id)->with('msg', 'Photo updated');
    }

    public function updateFromStudent()
    {
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
        $this->parentsModel->update($id, $data);
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

    // ===== RELEASE HISTORY =====
    public function releases()
    {
        $userId = session('user_id');
        $studentModel = new \App\Models\StudentModel();
        $db = \Config\Database::connect();
        
        $studentParents = $db->table('student_parents')
            ->where('parent_id', $userId)
            ->get()
            ->getResultArray();
        
        $studentIds = [];
        foreach ($studentParents as $sp) {
            $studentIds[] = $sp['student_id'];
        }
        
        $subFetchers = $this->subFetcherModel->where('parent_id', $userId)->findAll();
        foreach ($subFetchers as $sf) {
            $studentIds[] = $sf['student_id'];
        }
        
        $studentIds = array_unique($studentIds);
        
        $data['releases'] = [];
        if (!empty($studentIds)) {
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
                    $release['grade_section'] = $student['grade_section'] ?? '';
                    $release['action'] = 'release';
                }
            }
            $data['releases'] = $releases;
        }

        $data['declined'] = [];
        if (!empty($studentIds)) {
            $declined = $db->table('activity_logs')
                ->select('activity_logs.*')
                ->where('action', 'decline')
                ->where('module', 'scan')
                ->orderBy('created_at', 'DESC')
                ->limit(50)
                ->get()
                ->getResultArray();
            
            foreach ($declined as &$d) {
                $desc = $d['description'] ?? '';
                $studentName = 'Unknown';
                $studentId = null;
                
                if (preg_match('/Student:\s*([^\s]+)\s*([^\s]+)\s*\(ID:\s*(\d+)\)/', $desc, $matches)) {
                    $studentName = $matches[1] . ' ' . $matches[2];
                    $studentId = $matches[3];
                } elseif (preg_match('/Student:\s*([^\s]+)\s*([^\s]+)/', $desc, $matches)) {
                    $studentName = $matches[1] . ' ' . $matches[2];
                }
                
                if ($studentId && in_array($studentId, $studentIds)) {
                    $d['sfname'] = $studentName;
                    $d['slname'] = '';
                    $d['grade_section'] = '—';
                    $d['action'] = 'decline';
                    $d['time_released'] = $d['created_at'];
                    $d['fetcher_fname'] = $d['user_name'] ?? 'System';
                    $d['fetcher_lname'] = '';
                    $d['fetcher_relation'] = $d['role'] ?? 'Staff';
                    $data['declined'][] = $d;
                }
            }
        }

        $allLogs = array_merge($data['releases'], $data['declined']);
        usort($allLogs, function($a, $b) {
            return strtotime($b['time_released']) - strtotime($a['time_released']);
        });
        $data['logs'] = $allLogs;
        
        return view('parents_releases', $data);
    }

    // ===== SMS NOTIFICATIONS =====
    public function notifications()
    {
        $db = \Config\Database::connect();
        $parentPhone = session('phone');
        $data['smsNotifications'] = [];
        
        if (!empty($parentPhone)) {
            $smsLogs = $db->table('sms_logs')
                ->select('sms_logs.*')
                ->where('parent_phone', $parentPhone)
                ->orderBy('sent_at', 'DESC')
                ->limit(50)
                ->get()
                ->getResultArray();
            
            foreach ($smsLogs as &$log) {
                $message = $log['message'] ?? '';
                $log['student_fname'] = 'Unknown';
                $log['student_lname'] = '';
                $log['grade_section'] = '';
                
                if (preg_match('/child\s+([^\s]+)\s+([^\s]+)/i', $message, $matches)) {
                    $log['student_fname'] = $matches[1];
                    $log['student_lname'] = $matches[2] ?? '';
                } elseif (preg_match('/for\s+([^\s]+)\s+([^\s]+)/i', $message, $matches)) {
                    $log['student_fname'] = $matches[1];
                    $log['student_lname'] = $matches[2] ?? '';
                } elseif (preg_match('/Your\s+child\s+([^\s]+)\s+([^\s]+)/i', $message, $matches)) {
                    $log['student_fname'] = $matches[1];
                    $log['student_lname'] = $matches[2] ?? '';
                } elseif (preg_match('/Student:\s*([^\s]+)\s*([^\s]+)/i', $message, $matches)) {
                    $log['student_fname'] = $matches[1];
                    $log['student_lname'] = $matches[2] ?? '';
                }
            }
            $data['smsNotifications'] = $smsLogs;
        }
        
        return view('parents_notifications', $data);
    }

    // ===== LEGACY: Combined logs =====
    public function logs()
    {
        $userId = session('user_id');
        $studentModel = new \App\Models\StudentModel();
        $db = \Config\Database::connect();
        
        $studentParents = $db->table('student_parents')
            ->where('parent_id', $userId)
            ->get()
            ->getResultArray();
        
        $studentIds = [];
        foreach ($studentParents as $sp) {
            $studentIds[] = $sp['student_id'];
        }
        
        $subFetchers = $this->subFetcherModel->where('parent_id', $userId)->findAll();
        foreach ($subFetchers as $sf) {
            $studentIds[] = $sf['student_id'];
        }
        
        $studentIds = array_unique($studentIds);
        
        $data['releases'] = [];
        if (!empty($studentIds)) {
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
                    $release['grade_section'] = $student['grade_section'] ?? '';
                }
            }
            $data['releases'] = $releases;
        }

        $data['smsNotifications'] = [];
        $parentPhone = session('phone');
        
        if (!empty($parentPhone)) {
            $smsLogs = $db->table('sms_logs')
                ->select('sms_logs.*')
                ->where('parent_phone', $parentPhone)
                ->orderBy('sent_at', 'DESC')
                ->limit(50)
                ->get()
                ->getResultArray();
            
            foreach ($smsLogs as &$log) {
                $message = $log['message'] ?? '';
                $log['student_fname'] = 'Unknown';
                $log['student_lname'] = '';
                $log['grade_section'] = '';
                
                if (preg_match('/child\s+([^\s]+)\s+([^\s]+)/i', $message, $matches)) {
                    $log['student_fname'] = $matches[1];
                    $log['student_lname'] = $matches[2] ?? '';
                } elseif (preg_match('/for\s+([^\s]+)\s+([^\s]+)/i', $message, $matches)) {
                    $log['student_fname'] = $matches[1];
                    $log['student_lname'] = $matches[2] ?? '';
                } elseif (preg_match('/Your\s+child\s+([^\s]+)\s+([^\s]+)/i', $message, $matches)) {
                    $log['student_fname'] = $matches[1];
                    $log['student_lname'] = $matches[2] ?? '';
                } elseif (preg_match('/Student:\s*([^\s]+)\s*([^\s]+)/i', $message, $matches)) {
                    $log['student_fname'] = $matches[1];
                    $log['student_lname'] = $matches[2] ?? '';
                }
            }
            $data['smsNotifications'] = $smsLogs;
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

    private function generateQR()
    {
        $qrValue = $this->generateQrValue();
        include_once('phpqrcode/qrlib.php');
        
        $qrImagePath = 'uploads/qr/' . $qrValue . '_qrcode.png';
        \QRcode::png($qrValue, $qrImagePath, QR_ECLEVEL_H, 8, 2);
        
        $qrImage = imagecreatefrompng($qrImagePath);
        $qrWidth = imagesx($qrImage);
        $qrHeight = imagesy($qrImage);
        
        $textHeight = 40;
        $padding = 10;
        $totalWidth = $qrWidth;
        $totalHeight = $qrHeight + $textHeight + $padding;
        
        $combinedImage = imagecreatetruecolor($totalWidth, $totalHeight);
        $white = imagecolorallocate($combinedImage, 255, 255, 255);
        imagefill($combinedImage, 0, 0, $white);
        imagecopy($combinedImage, $qrImage, 0, 0, 0, 0, $qrWidth, $qrHeight);
        
        $black = imagecolorallocate($combinedImage, 0, 0, 0);
        $fontSize = 5;
        $text = $qrValue;
        
        $textWidth = imagefontwidth($fontSize) * strlen($text);
        $textX = ($totalWidth - $textWidth) / 2;
        $textY = $qrHeight + 12;
        imagestring($combinedImage, $fontSize, $textX, $textY, $text, $black);
        
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
