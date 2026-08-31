<?php

namespace App\Controllers;

use App\Models\StaffsModel;
use App\Models\ActivityLogModel;

class Staffs extends BaseController
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
        $model = new StaffsModel();
        $data['staffs'] = $model->orderBy('created_at', 'DESC')->findAll();
        return view('staffs', $data);
    }

    public function save()
    {
        $model = new StaffsModel();
        $model->save([
            'fname' => $this->request->getPost('fname'), 'mname' => $this->request->getPost('mname'),
            'lname' => $this->request->getPost('lname'), 'phone' => $this->request->getPost('phone'),
            'password' => null,
            'password_sent' => 0,
            'picture' => $this->saveUploadedPicture('staffs'),
        ]);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'create', 'staff', 'Created staff: '.$this->request->getPost('fname').' '.$this->request->getPost('lname'));
        return redirect()->to('/staffs')->with('msg', 'Staff added');
    }

    public function update()
    {
        $model = new StaffsModel();
        $id = $this->request->getPost('id');
        $data = ['fname' => $this->request->getPost('fname'), 'mname' => $this->request->getPost('mname'), 'lname' => $this->request->getPost('lname'), 'phone' => $this->request->getPost('phone')];
        $picture = $this->saveUploadedPicture('staffs');
        if ($picture) {
            $data['picture'] = $picture;
        }
        if ($this->request->getPost('password')) {
            $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        }
        $model->update($id, $data);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'update', 'staff', 'Updated staff: '.$data['fname'].' '.$data['lname'].' (ID: '.$id.')');
        return redirect()->to('/staffs')->with('msg', 'Staff updated');
    }

    // ===== SEND / RESET PASSWORD VIA SMS =====
    public function sendPassword($id)
    {
        if (! $this->requireAdminStaff()) return;
        $model = new StaffsModel();
        $staff = $model->find($id);
        if (!$staff) {
            return redirect()->to('/staffs')->with('error', 'Staff not found');
        }
        $this->deliverPassword($model, $staff, 'staff');
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'update', 'staff', 'Sent password for staff: '.$staff['fname'].' '.$staff['lname'].' (ID: '.$id.')');
        return redirect()->to('/staffs')->with('msg', 'Password sent via SMS (recorded in SMS logs)');
    }

    // ===== SEND PASSWORD TO ALL STAFF NOT YET SENT =====
    public function sendAllPasswords()
    {
        if (! $this->requireAdminStaff()) return;
        $model = new StaffsModel();
        $pending = $model->where('password_sent', 0)->findAll();
        $sent = 0;
        foreach ($pending as $s) {
            $this->deliverPassword($model, $s, 'staff');
            $sent++;
        }
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'update', 'staff', "Sent passwords to $sent staff member(s) who had not received one yet.");
        return redirect()->to('/staffs')->with('msg', "Passwords sent to $sent staff member(s).");
    }

    public function delete($id)
    {
        $model = new StaffsModel();
        $staff = $model->find($id);
        $model->delete($id);
        $this->deleteUploadedPicture('staffs', $staff['picture'] ?? null);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'delete', 'staff', 'Deleted staff: '.$staff['fname'].' '.$staff['lname'].' (ID: '.$id.')');
        return redirect()->to('/staffs')->with('msg', 'Staff deleted');
    }
}