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
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
        ]);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'create', 'staff', 'Created staff: '.$this->request->getPost('fname').' '.$this->request->getPost('lname'));
        return redirect()->to('/staffs')->with('msg', 'Staff added');
    }

    public function update()
    {
        $model = new StaffsModel();
        $id = $this->request->getPost('id');
        $data = ['fname' => $this->request->getPost('fname'), 'mname' => $this->request->getPost('mname'), 'lname' => $this->request->getPost('lname'), 'phone' => $this->request->getPost('phone')];
        if ($this->request->getPost('password')) $data['password'] = password_hash($this->request->getPost('password'), PASSWORD_DEFAULT);
        $model->update($id, $data);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'update', 'staff', 'Updated staff: '.$data['fname'].' '.$data['lname'].' (ID: '.$id.')');
        return redirect()->to('/staffs')->with('msg', 'Staff updated');
    }

    public function delete($id)
    {
        $model = new StaffsModel();
        $staff = $model->find($id);
        $model->delete($id);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'delete', 'staff', 'Deleted staff: '.$staff['fname'].' '.$staff['lname'].' (ID: '.$id.')');
        return redirect()->to('/staffs')->with('msg', 'Staff deleted');
    }
}