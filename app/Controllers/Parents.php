<?php

namespace App\Controllers;

use App\Models\ParentsModel;
use App\Models\StudentModel;
use App\Models\FetchLogModel;
use App\Models\ActivityLogModel;

class Parents extends BaseController
{
    protected $parentsModel;
    protected $studentModel;
    protected $fetchLogModel;
    protected $logModel;

    public function __construct()
    {
        $this->parentsModel  = new ParentsModel();
        $this->studentModel  = new StudentModel();
        $this->fetchLogModel = new FetchLogModel();
        $this->logModel      = new ActivityLogModel();
    }

    // ========== LIST ==========
    public function index()
    {
        $data['parents'] = $this->parentsModel->orderBy('created_at', 'DESC')->findAll();
        return view('parents', $data);
    }

    // ========== VIEW ==========
    public function view($id)
    {
        $data['parent'] = $this->parentsModel->find($id);
        if (!$data['parent']) {
            return redirect()->to('/parents')->with('error', 'Parent not found');
        }
        $data['students'] = $this->studentModel->where('parent_id', $id)->findAll();
        return view('parents_view', $data);
    }

    // ========== ADD FORM ==========
    public function add()
    {
        return view('parents_add');
    }

    // ========== EDIT FORM ==========
    public function edit($id)
    {
        $data['parent'] = $this->parentsModel->find($id);
        if (!$data['parent']) {
            return redirect()->to('/parents')->with('error', 'Parent not found');
        }
        $data['students'] = $this->studentModel->where('parent_id', $id)->findAll();
        return view('parents_edit', $data);
    }

    // ========== SAVE ==========
    public function save()
    {
        $picture = $this->request->getFile('picture');
        $pictureName = null;
        if ($picture && $picture->isValid() && !$picture->hasMoved()) {
            $pictureName = $picture->getRandomName();
            $picture->move('uploads/parents', $pictureName);
        }
        
        $qrValue = 'QR-' . strtoupper(bin2hex(random_bytes(6)));
        include_once('phpqrcode/qrlib.php');
        \QRcode::png($qrValue, 'uploads/qr/' . $qrValue . '.png', QR_ECLEVEL_H, 8, 2);
        
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
        
        $fnames = $this->request->getPost('student_fname');
        if ($fnames) {
            $mnames = $this->request->getPost('student_mname');
            $lnames = $this->request->getPost('student_lname');
            $grades = $this->request->getPost('grade_section');
            $pictures = $this->request->getFiles('student_picture');
            
            foreach ($fnames as $i => $fname) {
                $studentPictureName = null;
                if (isset($pictures['student_picture'][$i]) && $pictures['student_picture'][$i]->isValid()) {
                    $studentPictureName = $pictures['student_picture'][$i]->getRandomName();
                    $pictures['student_picture'][$i]->move('uploads/students', $studentPictureName);
                }
                
                $this->studentModel->save([
                    'fname'         => $fname,
                    'mname'         => $mnames[$i] ?? null,
                    'lname'         => $lnames[$i],
                    'grade_section' => $grades[$i],
                    'parent_id'     => $parentId,
                    'picture'       => $studentPictureName,
                    'created_by'    => session('user_id'),
                ]);
            }
        }
        
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'register', 'parent', 'Registered parent: '.$this->request->getPost('fname').' '.$this->request->getPost('lname').' | Phone: '.$this->request->getPost('phone'));
        return redirect()->to('/parents')->with('msg', 'Parent & Students registered');
    }

    // ========== UPDATE ==========
    public function update()
    {
        $id = $this->request->getPost('id');
        $data = [
            'fname' => $this->request->getPost('fname'),
            'mname' => $this->request->getPost('mname'),
            'lname' => $this->request->getPost('lname'),
            'phone' => $this->request->getPost('phone'),
        ];
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
        $picture = $this->request->getFile('picture');
        if ($picture && $picture->isValid() && !$picture->hasMoved()) {
            $pictureName = $picture->getRandomName();
            $picture->move('uploads/parents', $pictureName);
            $data['picture'] = $pictureName;
        }
        $this->parentsModel->update($id, $data);
        
        $studentIds = $this->request->getPost('student_id');
        $fnames = $this->request->getPost('student_fname');
        if ($fnames) {
            $mnames = $this->request->getPost('student_mname');
            $lnames = $this->request->getPost('student_lname');
            $grades = $this->request->getPost('grade_section');
            foreach ($fnames as $i => $fname) {
                $studentData = ['fname' => $fname, 'mname' => $mnames[$i] ?? null, 'lname' => $lnames[$i], 'grade_section' => $grades[$i]];
                if (!empty($studentIds[$i])) {
                    $this->studentModel->update($studentIds[$i], $studentData);
                }
            }
        }
        
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'update', 'parent', 'Updated parent: '.$data['fname'].' '.$data['lname'].' (ID: '.$id.')');
        return redirect()->to('/parents-view/' . $id)->with('msg', 'Parent updated');
    }

    // Update parent picture only
        public function updatePicture()
        {
            $id = $this->request->getPost('id');
            $pictureName = null;

            // Camera capture
            $captureData = $this->request->getPost('picture_capture');
            if ($captureData && strpos($captureData, 'data:image') === 0) {
                $imageData = base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $captureData));
                $pictureName = 'parent_' . time() . '.png';
                file_put_contents('uploads/parents/' . $pictureName, $imageData);
            } else {
                // File upload
                $picture = $this->request->getFile('picture');
                if ($picture && $picture->isValid() && !$picture->hasMoved()) {
                    $pictureName = $picture->getRandomName();
                    $picture->move('uploads/parents', $pictureName);
                }
            }

            if ($pictureName) {
                $this->parentsModel->update($id, ['picture' => $pictureName]);
            }

            return redirect()->to('/parents-view/' . $id)->with('msg', 'Photo updated');
            }

            // ========== DELETE ==========
        public function delete($id)
        {
            $parent = $this->parentsModel->find($id);
            $this->parentsModel->delete($id);
            $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'delete', 'parent', 'Deleted parent: '.$parent['fname'].' '.$parent['lname'].' (ID: '.$id.')');
            return redirect()->to('/parents')->with('msg', 'Parent deleted');
            }

    // ========== PARENT RELEASE LOGS ==========
    public function logs()
    {
        $userId = session('user_id');
        
        $data['releases'] = $this->fetchLogModel
            ->select('fetch_logs.*, students.fname as sfname, students.lname as slname')
            ->join('students', 'students.id = fetch_logs.student_id')
            ->where('students.parent_id', $userId)
            ->orderBy('fetch_logs.time_released', 'DESC')
            ->limit(50)
            ->findAll();
        
        return view('parents_logs', $data);
    }
}