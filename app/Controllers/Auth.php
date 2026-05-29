<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\StaffsModel;
use App\Models\ParentsModel;
use App\Models\ActivityLogModel;

class Auth extends BaseController
{
    protected $logModel;

    public function __construct()
    {
        $this->logModel = new ActivityLogModel();
    }

    public function auth()
    {
        $session = session();
        $phone    = trim($this->request->getPost('phone'));
        $password = trim($this->request->getPost('password'));

        // Check Admin
        $adminModel = new AdminModel();
        $admin = $adminModel->where('phone', $phone)->first();

        if ($admin && password_verify($password, $admin['password'])) {
            $session->regenerate();
            $session->set([
                'user_id'       => $admin['id'],
                'fname'         => $admin['fname'],
                'lname'         => $admin['lname'],
                'phone'         => $admin['phone'],
                'role'          => 'admin',
                'logged_in'     => true,
                'last_activity' => time()
            ]);
            $this->logModel->addLog($admin['id'], $admin['fname'].' '.$admin['lname'], 'admin', 'login', 'auth', 'Admin logged in | Phone: '.$admin['phone']);
            return redirect()->to('/dashboard');
        }

        // Check Staff
        $staffsModel = new StaffsModel();
        $staff = $staffsModel->where('phone', $phone)->first();

        if ($staff && password_verify($password, $staff['password'])) {
            $session->regenerate();
            $session->set([
                'user_id'       => $staff['id'],
                'fname'         => $staff['fname'],
                'lname'         => $staff['lname'],
                'phone'         => $staff['phone'],
                'role'          => 'staff',
                'logged_in'     => true,
                'last_activity' => time()
            ]);
            $this->logModel->addLog($staff['id'], $staff['fname'].' '.$staff['lname'], 'staff', 'login', 'auth', 'Staff logged in | Phone: '.$staff['phone']);
            return redirect()->to('/dashboard');
        }

        // Check Parent
        $parentsModel = new ParentsModel();
        $parent = $parentsModel->where('phone', $phone)->first();

        if ($parent && password_verify($password, $parent['password'])) {
            $session->regenerate();
            $session->set([
                'user_id'       => $parent['id'],
                'fname'         => $parent['fname'],
                'lname'         => $parent['lname'],
                'phone'         => $parent['phone'],
                'role'          => 'parent',
                'logged_in'     => true,
                'last_activity' => time()
            ]);
            $this->logModel->addLog($parent['id'], $parent['fname'].' '.$parent['lname'], 'parent', 'login', 'auth', 'Parent logged in | Phone: '.$parent['phone']);
            return redirect()->to('/dashboard');
        }

        return redirect()->to('/login')->with('error', 'Invalid phone or password');
    }

    public function logout()
    {
        if (session('logged_in')) {
            $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'logout', 'auth', 'User logged out');
        }
        session()->destroy();
        return redirect()->to('/login');
    }
}