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
        helper('photo');
        $model = new StaffsModel();
        $data['staffs'] = $model->orderBy('created_at', 'DESC')->findAll();
        return view('staffs', $data);
    }

    public function save()
    {
        $model = new StaffsModel();

        // Staff ID: use what the registrar typed, otherwise auto-assign S-####.
        $staffNo = strtoupper(trim((string) $this->request->getPost('staff_no')));
        if ($staffNo === '') {
            $staffNo = $model->nextStaffNo();
        } elseif (! str_starts_with($staffNo, 'S-')) {
            $staffNo = preg_match('/(\d+)$/', $staffNo, $m) ? 'S-' . $m[1] : 'S-' . $staffNo;
        }
        if ($model->where('staff_no', $staffNo)->first()) {
            return redirect()->to('/staffs')->with('error', 'Staff ID ' . $staffNo . ' is already taken.');
        }

        $staffId = $model->save([
            'staff_no' => $staffNo,
            'fname' => $this->request->getPost('fname'), 'mname' => $this->request->getPost('mname'),
            'lname' => $this->request->getPost('lname'), 'phone' => $this->request->getPost('phone'),
            'password' => null,
            'password_sent' => 0,
        ]);

        // Profile picture captured in the Add Staff modal.
        helper('photo');
        $__pic = (string) $this->request->getPost('staff_picture_data');
        if ($__pic !== '' && $staffId) {
            photo_save_staff_dataurl($__pic, $staffNo);
        }
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'create', 'staff', 'Created staff: '.$this->request->getPost('fname').' '.$this->request->getPost('lname').' ('.$staffNo.')');
        return redirect()->to('/staffs')->with('msg', 'Staff added (' . $staffNo . ')');
    }

    public function update()
    {
        $model = new StaffsModel();
        $id = $this->request->getPost('id');
        $__oldStaff = $model->find($id);
        $data = ['fname' => $this->request->getPost('fname'), 'mname' => $this->request->getPost('mname'), 'lname' => $this->request->getPost('lname'), 'phone' => $this->request->getPost('phone')];
        $staffNo = strtoupper(trim((string) $this->request->getPost('staff_no')));
        if ($staffNo !== '') {
            if (! str_starts_with($staffNo, 'S-')) {
                $staffNo = preg_match('/(\d+)$/', $staffNo, $__sm) ? 'S-' . $__sm[1] : 'S-' . $staffNo;
            }
            if ($model->where('staff_no', $staffNo)->where('id !=', $id)->countAllResults() > 0) {
                return redirect()->to('/staffs')->with('error', 'Staff ID ' . $staffNo . ' is already taken.');
            }
            $data['staff_no'] = $staffNo;
        }
        // Passwords are never edited here - the admin sends/resets them via SMS.
        $model->update($id, $data);

        // ===== ID changed: carry the profile picture over to the new file name =====
        helper('photo');
        if (! empty($__oldStaff['staff_no']) && isset($data['staff_no'])
            && strtoupper((string) $__oldStaff['staff_no']) !== strtoupper((string) $data['staff_no'])) {
            photo_carry_over_id('staffs', (string) $__oldStaff['staff_no'], (string) $data['staff_no'], 'S-');
        }

        // ===== Staff profile picture (add / change / remove) =====
        helper('photo');
        $staff = $model->find($id);
        $sNo   = (string) ($staff['staff_no'] ?? '');
        $pic   = (string) $this->request->getPost('staff_picture_data');
        if ($pic !== '' && $sNo !== '') {
            photo_save_staff_dataurl($pic, $sNo);
        } elseif ((string) $this->request->getPost('staff_picture_remove') === '1' && $sNo !== '') {
            staff_photo_delete($sNo);
        }
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
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'delete', 'staff', 'Deleted staff: '.$staff['fname'].' '.$staff['lname'].' (ID: '.$id.')');
        return redirect()->to('/staffs')->with('msg', 'Staff deleted');
    }

}
