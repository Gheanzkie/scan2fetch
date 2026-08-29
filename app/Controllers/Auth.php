<?php

namespace App\Controllers;

use App\Models\AdminModel;
use App\Models\StaffsModel;
use App\Models\ParentsModel;
use App\Models\TeachersModel;
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
                'picture'       => $admin['picture'] ?? null,
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
                'picture'       => $staff['picture'] ?? null,
                'logged_in'     => true,
                'last_activity' => time()
            ]);
            $this->logModel->addLog($staff['id'], $staff['fname'].' '.$staff['lname'], 'staff', 'login', 'auth', 'Staff logged in | Phone: '.$staff['phone']);
            return redirect()->to('/dashboard');
        }

        // Check Teacher
        $teachersModel = new TeachersModel();
        $teacher = $teachersModel->where('phone', $phone)->first();

        if ($teacher && password_verify($password, $teacher['password'])) {
            $session->regenerate();
            $session->set([
                'user_id'       => $teacher['id'],
                'fname'         => $teacher['fname'],
                'lname'         => $teacher['lname'],
                'phone'         => $teacher['phone'],
                'grade_section' => $teacher['grade_section'],
                'role'          => 'teacher',
                'picture'       => $teacher['picture'] ?? null,
                'logged_in'     => true,
                'last_activity' => time()
            ]);
            $this->logModel->addLog($teacher['id'], $teacher['fname'].' '.$teacher['lname'], 'teacher', 'login', 'auth', 'Teacher logged in | Phone: '.$teacher['phone']);
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
                'picture'       => $parent['picture'] ?? null,
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

    // ===== SELF-SERVICE PASSWORD CHANGE (admin / staff / parent) =====
    public function changePassword()
    {
        if (!session('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $role    = session('role');
        $me      = (int) session('user_id');
        $current = $this->request->getPost('current_password');
        $new     = $this->request->getPost('new_password');
        $confirm = $this->request->getPost('confirm_password');

        if ($new !== $confirm) {
            return $this->response->setJSON(['success' => false, 'message' => 'New password and confirmation do not match.']);
        }
        if (strlen($new) < 6) {
            return $this->response->setJSON(['success' => false, 'message' => 'New password must be at least 6 characters.']);
        }

        $table = ($role == 'parent') ? 'parents' : (($role == 'staff') ? 'staffs' : (($role == 'teacher') ? 'teachers' : 'admin'));

        $db = \Config\Database::connect();
        $user = $db->table($table)->where('id', $me)->get()->getRowArray();

        if (!$user || !password_verify($current, $user['password'])) {
            return $this->response->setJSON(['success' => false, 'message' => 'Current password is incorrect.']);
        }

        $db->table($table)->where('id', $me)->update(['password' => password_hash($new, PASSWORD_DEFAULT)]);

        $this->logModel->addLog(
            $me,
            session('fname') . ' ' . session('lname'),
            $role,
            'update',
            'password',
            ucfirst($role) . ' changed their password'
        );

        return $this->response->setJSON(['success' => true, 'message' => 'Password updated successfully!']);
    }

    // ===== PROFILE UPDATE (name + picture + optional password) =====
    public function updateProfile()
    {
        if (!session('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $role  = session('role');
        $me    = (int) session('user_id');
        $table = ($role == 'parent') ? 'parents' : (($role == 'staff') ? 'staffs' : (($role == 'teacher') ? 'teachers' : 'admin'));

        $fname = trim($this->request->getPost('fname'));
        $mname = trim($this->request->getPost('mname') ?? '');
        $lname = trim($this->request->getPost('lname'));
        if ($fname === '' || $lname === '') {
            return $this->response->setJSON(['success' => false, 'message' => 'First and last name are required.']);
        }

        $data = ['fname' => $fname, 'mname' => $mname, 'lname' => $lname];

        // Photo upload
        $newPicture = $this->saveUploadedPicture($table);
        if ($newPicture) {
            $db = \Config\Database::connect();
            $old = $db->table($table)->where('id', $me)->get()->getRowArray();
            if ($old && !empty($old['picture']) && $old['picture'] !== $newPicture) {
                $this->deleteUploadedPicture($table, $old['picture']);
            }
            $data['picture'] = $newPicture;
        }

        // Optional password change
        $new = $this->request->getPost('new_password');
        if (! empty($new)) {
            $confirm = $this->request->getPost('confirm_password');
            if ($new !== $confirm) {
                return $this->response->setJSON(['success' => false, 'message' => 'New password and confirmation do not match.']);
            }
            if (strlen($new) < 6) {
                return $this->response->setJSON(['success' => false, 'message' => 'New password must be at least 6 characters.']);
            }

            $db = \Config\Database::connect();
            $user = $db->table($table)->where('id', $me)->get()->getRowArray();
            if (! $user || ! password_verify($this->request->getPost('current_password'), $user['password'])) {
                return $this->response->setJSON(['success' => false, 'message' => 'Current password is incorrect.']);
            }
            $data['password'] = password_hash($new, PASSWORD_DEFAULT);
        }

        $db = \Config\Database::connect();
        $db->table($table)->where('id', $me)->update($data);

        session()->set([
            'fname'   => $fname,
            'lname'   => $lname,
            'picture' => $newPicture ?? session('picture'),
        ]);

        $this->logModel->addLog($me, $fname.' '.$lname, $role, 'update', 'profile', ucfirst($role).' updated their profile');

        return $this->response->setJSON(['success' => true, 'message' => 'Profile updated successfully!']);
    }
}