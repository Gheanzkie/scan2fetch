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
            ->select('parents.*, student_parents.relation, students.grade_section as student_grade, students.fname as student_fname, students.lname as student_lname')
            ->join('student_parents', 'student_parents.parent_id = parents.id', 'left')
            ->join('students', 'students.id = student_parents.student_id', 'left')
            ->orderBy('parents.created_at', 'DESC')->get()->getResultArray();
        return view('parents', $data);
    }

    public function view($id)
    {
        $data['parent'] = $this->parentsModel->find($id);
        if (!$data['parent']) return redirect()->to('/parents')->with('error', 'Parent not found');

        $db = \Config\Database::connect();
        $data['students'] = $db->table('student_parents')
            ->select('student_parents.*, students.fname, students.mname, students.lname, students.grade_section, students.picture')
            ->join('students', 'students.id = student_parents.student_id')
            ->where('student_parents.parent_id', $id)->get()->getResultArray();

        $data['subFetchers'] = $this->subFetcherModel->where('parent_id', $id)->findAll();

        return view('parents_view', $data);
    }

    public function add() { return view('parents_add'); }

    public function edit($id)
    {
        $data['parent'] = $this->parentsModel->find($id);
        if (!$data['parent']) return redirect()->to('/parents')->with('error', 'Parent not found');
        return view('parents_edit', $data);
    }

    public function save()
    {
        $picture = $this->uploadPicture('picture');
        $qrValue = $this->generateQR();
        $this->parentsModel->insert([
            'fname' => $this->request->getPost('fname'), 'mname' => $this->request->getPost('mname'),
            'lname' => $this->request->getPost('lname'), 'phone' => $this->request->getPost('phone'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'picture' => $picture, 'qr_code' => $qrValue, 'created_by' => session('user_id'),
        ]);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'create', 'parent', 'Created: '.$this->request->getPost('fname').' '.$this->request->getPost('lname'));
        return redirect()->to('/parents')->with('msg', 'Parent added');
    }

    public function update()
    {
        $id = $this->request->getPost('id');
        $data = ['fname' => $this->request->getPost('fname'), 'mname' => $this->request->getPost('mname'), 'lname' => $this->request->getPost('lname'), 'phone' => $this->request->getPost('phone')];
        if ($this->request->getPost('password')) $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $picture = $this->uploadPicture('picture');
        if ($picture) $data['picture'] = $picture;
        $this->parentsModel->update($id, $data);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'update', 'parent', 'Updated: '.$data['fname'].' '.$data['lname'].' (ID: '.$id.')');
        return redirect()->to('/parents')->with('msg', 'Parent updated');
    }

    public function delete($id)
    {
        $parent = $this->parentsModel->find($id);
        $this->parentsModel->delete($id);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'delete', 'parent', 'Deleted: '.$parent['fname'].' '.$parent['lname'].' (ID: '.$id.')');
        return redirect()->to('/parents')->with('msg', 'Parent deleted');
    }

    public function updatePicture()
    {
        $id = $this->request->getPost('id');
        $picture = $this->uploadPicture('picture');
        if ($picture) $this->parentsModel->update($id, ['picture' => $picture]);
        return redirect()->to('/parents-view/' . $id)->with('msg', 'Photo updated');
    }

    public function updateFromStudent()
    {
        $id = $this->request->getPost('id');
        $studentId = $this->request->getPost('student_id');
        $data = ['fname' => $this->request->getPost('fname'), 'mname' => $this->request->getPost('mname'), 'lname' => $this->request->getPost('lname'), 'phone' => $this->request->getPost('phone')];
        if ($this->request->getPost('password')) $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $picture = $this->uploadPicture('picture');
        if ($picture) $data['picture'] = $picture;
        $this->parentsModel->update($id, $data);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'update', 'parent', 'Updated: '.$data['fname'].' '.$data['lname'].' (ID: '.$id.')');
        return redirect()->to('/students-view/' . $studentId)->with('msg', 'Parent updated');
    }

        public function logs()
        {
            $userId = session('user_id');
            $db = \Config\Database::connect();
            
            // Get students linked to this parent (from student_parents)
            $studentIds = $db->table('student_parents')->select('student_id')->where('parent_id', $userId)->get()->getResultArray();
            $ids = array_column($studentIds, 'student_id');
            
            // Also check old parent_id
            $oldStudents = $db->table('students')->select('id')->where('parent_id', $userId)->get()->getResultArray();
            foreach ($oldStudents as $s) { $ids[] = $s['id']; }
            
            // Also get students linked to sub-fetchers of this parent
            $subFetcherStudents = $db->table('sub_fetchers')->select('student_id')->where('parent_id', $userId)->get()->getResultArray();
            foreach ($subFetcherStudents as $s) { $ids[] = $s['student_id']; }
            
            $data['releases'] = [];
            if (!empty($ids)) {
                $data['releases'] = $db->table('fetch_logs')
                    ->select('fetch_logs.*, students.fname as sfname, students.lname as slname')
                    ->join('students', 'students.id = fetch_logs.student_id')
                    ->whereIn('fetch_logs.student_id', array_unique($ids))
                    ->orderBy('fetch_logs.time_released', 'DESC')
                    ->limit(50)
                    ->get()
                    ->getResultArray();
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
        $qrValue = 'QR-' . strtoupper(bin2hex(random_bytes(6)));
        include_once('phpqrcode/qrlib.php');
        \QRcode::png($qrValue, 'uploads/qr/' . $qrValue . '.png', QR_ECLEVEL_H, 8, 2);
        return $qrValue;
    }
}