<?php

namespace App\Controllers;

use App\Models\ParentsModel;
use App\Models\StaffsModel;
use App\Models\StudentModel;

class Admin extends BaseController
{
    // =============================================
    // PARENTS
    // =============================================
    public function parents()
    {
        $model = new ParentsModel();
        $data['parents'] = $model->orderBy('created_at', 'DESC')->findAll();
        return view('parents', $data);
    }

    public function saveParent()
    {
        $model = new ParentsModel();
        
        // Picture upload
        $picture = $this->request->getFile('picture');
        $pictureName = null;
        if ($picture && $picture->isValid() && !$picture->hasMoved()) {
            $pictureName = $picture->getRandomName();
            $picture->move('uploads/parents', $pictureName);
        }
        
        // Generate QR Code
        $qrValue = 'QR-' . strtoupper(bin2hex(random_bytes(6)));
        include_once(FCPATH . 'phpqrcode/qrlib.php');
        $qrPath = FCPATH . 'uploads/qr/' . $qrValue . '.png';
        \QRcode::png($qrValue, $qrPath, QR_ECLEVEL_H, 8, 2);
        
        $model->save([
            'fname'      => $this->request->getPost('fname'),
            'mname'      => $this->request->getPost('mname'),
            'lname'      => $this->request->getPost('lname'),
            'phone'      => $this->request->getPost('phone'),
            'password'   => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'picture'    => $pictureName,
            'qr_code'    => $qrValue,
            'created_by' => session('user_id'),
        ]);
        
        return redirect()->to('/parents')->with('msg', 'Parent added');
    }

    public function updateParent()
    {
        $model = new ParentsModel();
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
        
        $model->update($id, $data);
        return redirect()->to('/parents')->with('msg', 'Parent updated');
    }

    public function deleteParent($id)
    {
        $model = new ParentsModel();
        $model->delete($id);
        return redirect()->to('/parents')->with('msg', 'Parent deleted');
    }

    // =============================================
    // STAFFS
    // =============================================
    public function staffs()
    {
        $model = new StaffsModel();
        $data['staffs'] = $model->orderBy('created_at', 'DESC')->findAll();
        return view('staffs', $data);
    }

    public function saveStaff()
    {
        $model = new StaffsModel();
        $model->save([
            'fname'    => $this->request->getPost('fname'),
            'mname'    => $this->request->getPost('mname'),
            'lname'    => $this->request->getPost('lname'),
            'phone'    => $this->request->getPost('phone'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);
        return redirect()->to('/staffs')->with('msg', 'Staff added');
    }

    public function updateStaff()
    {
        $model = new StaffsModel();
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
        
        $model->update($id, $data);
        return redirect()->to('/staffs')->with('msg', 'Staff updated');
    }

    public function deleteStaff($id)
    {
        $model = new StaffsModel();
        $model->delete($id);
        return redirect()->to('/staffs')->with('msg', 'Staff deleted');
    }

    // =============================================
    // STUDENTS
    // =============================================
    public function students()
    {
        $db = \Config\Database::connect();
        $data['students'] = $db->table('students')
            ->select('students.*, parents.fname as parent_fname, parents.lname as parent_lname')
            ->join('parents', 'parents.id = students.parent_id', 'left')
            ->orderBy('students.created_at', 'DESC')
            ->get()
            ->getResultArray();
        $data['parents'] = $db->table('parents')->get()->getResultArray();
        return view('students', $data);
    }

    public function saveStudent()
    {
        $model = new StudentModel();
        
        $picture = $this->request->getFile('picture');
        $pictureName = null;
        if ($picture && $picture->isValid() && !$picture->hasMoved()) {
            $pictureName = $picture->getRandomName();
            $picture->move('uploads/students', $pictureName);
        }
        
        $model->save([
            'fname'         => $this->request->getPost('fname'),
            'mname'         => $this->request->getPost('mname'),
            'lname'         => $this->request->getPost('lname'),
            'grade_section' => $this->request->getPost('grade_section'),
            'parent_id'     => $this->request->getPost('parent_id'),
            'picture'       => $pictureName,
            'created_by'    => session('user_id'),
        ]);
        
        return redirect()->to('/students')->with('msg', 'Student added');
    }

    public function updateStudent()
    {
        $model = new StudentModel();
        $id = $this->request->getPost('id');
        
        $data = [
            'fname'         => $this->request->getPost('fname'),
            'mname'         => $this->request->getPost('mname'),
            'lname'         => $this->request->getPost('lname'),
            'grade_section' => $this->request->getPost('grade_section'),
            'parent_id'     => $this->request->getPost('parent_id'),
        ];
        
        $picture = $this->request->getFile('picture');
        if ($picture && $picture->isValid() && !$picture->hasMoved()) {
            $pictureName = $picture->getRandomName();
            $picture->move('uploads/students', $pictureName);
            $data['picture'] = $pictureName;
        }
        
        $model->update($id, $data);
        return redirect()->to('/students')->with('msg', 'Student updated');
    }

    public function deleteStudent($id)
    {
        $model = new StudentModel();
        $model->delete($id);
        return redirect()->to('/students')->with('msg', 'Student deleted');
    }

    // =============================================
    // LOGS
    // =============================================
    public function logs()
    {
        $db = \Config\Database::connect();
        $data['logs'] = $db->table('fetch_logs')
            ->select('fetch_logs.*, students.fname as sfname, students.lname as slname')
            ->join('students', 'students.id = fetch_logs.student_id')
            ->orderBy('time_released', 'DESC')
            ->get()
            ->getResultArray();
        return view('logs', $data);
    }
}