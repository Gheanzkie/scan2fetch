<?php

namespace App\Controllers;

use App\Models\ActivityLogModel;

class Authorization extends BaseController
{
    protected $db;
    protected $logModel;

    public function __construct()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }
        $this->db = \Config\Database::connect();
        $this->logModel = new ActivityLogModel();
    }

    public function index()
    {
        $userId = session('user_id');
        $data['myChildren'] = $this->db->table('students')->where('parent_id', $userId)->get()->getResultArray();
        $data['myAuthorizations'] = $this->db->table('authorization_letters')
            ->select('authorization_letters.*, students.fname as sfname, students.lname as slname')
            ->join('students', 'students.id = authorization_letters.student_id')
            ->where('authorization_letters.parent_id', $userId)
            ->orderBy('created_at', 'DESC')->get()->getResultArray();
        return view('authorization', $data);
    }

    public function send()
    {
        $userId = session('user_id');
        $picture = $this->request->getFile('fetcher_picture');
        $pictureName = null;
        if ($picture && $picture->isValid() && !$picture->hasMoved()) {
            $pictureName = $picture->getRandomName();
            $picture->move('uploads/fetchers', $pictureName);
        }
        $this->db->table('authorization_letters')->insert([
            'student_id'      => $this->request->getPost('student_id'),
            'parent_id'       => $userId,
            'fetcher_fname'   => $this->request->getPost('fetcher_fname'),
            'fetcher_mname'   => $this->request->getPost('fetcher_mname'),
            'fetcher_lname'   => $this->request->getPost('fetcher_lname'),
            'fetcher_phone'   => $this->request->getPost('fetcher_phone'),
            'fetcher_picture' => $pictureName,
            'relation'        => $this->request->getPost('relation'),
            'status'          => 'pending',
        ]);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'create', 'authorization', 'Sent authorization | Fetcher: '.$this->request->getPost('fetcher_fname').' '.$this->request->getPost('fetcher_lname'));
        return redirect()->to('/authorization')->with('msg', 'Authorization sent');
    }

    public function all()
    {
        $data['authorizations'] = $this->db->table('authorization_letters')
            ->select('authorization_letters.*, students.fname as sfname, students.lname as slname, parents.fname as pfname, parents.lname as plname')
            ->join('students', 'students.id = authorization_letters.student_id')
            ->join('parents', 'parents.id = authorization_letters.parent_id')
            ->orderBy('authorization_letters.created_at', 'DESC')->get()->getResultArray();
        return view('authorizations', $data);
    }

    public function approve($id)
    {
        $this->db->table('authorization_letters')->where('id', $id)->update(['status' => 'approved']);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'approve', 'authorization', 'Approved authorization ID: '.$id);
        return redirect()->to('/authorizations')->with('msg', 'Authorization approved');
    }

    public function release($id)
    {
        $auth = $this->db->table('authorization_letters')->where('id', $id)->get()->getRowArray();
        $student = $this->db->table('students')->where('id', $auth['student_id'])->get()->getRowArray();
        $parent  = $this->db->table('parents')->where('id', $auth['parent_id'])->get()->getRowArray();
        $this->db->table('authorization_letters')->where('id', $id)->update(['status' => 'released']);
        $this->db->table('fetch_logs')->insert([
            'student_id' => $auth['student_id'], 'parent_id' => $auth['parent_id'], 'auth_letter_id' => $id,
            'fetcher_fname' => $auth['fetcher_fname'], 'fetcher_mname' => $auth['fetcher_mname'], 'fetcher_lname' => $auth['fetcher_lname'],
            'fetcher_relation' => $auth['relation'], 'method' => 'LETTER', 'staff_id' => session('user_id'),
        ]);
        $message = "Your child {$student['fname']} {$student['lname']} has been released at " . date('h:i A') . " to {$auth['fetcher_fname']} {$auth['fetcher_lname']} ({$auth['relation']}). - BCC Scan2Fetch";
        $this->db->table('sms_logs')->insert(['parent_phone' => $parent['phone'], 'message' => $message, 'status' => 'sent']);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'release', 'authorization', 'Released via authorization ID: '.$id.' | Student: '.$student['fname'].' '.$student['lname'].' | SMS sent');
        return redirect()->to('/authorizations')->with('msg', 'Student released! SMS sent.');
    }

    public function decline($id)
    {
        $auth = $this->db->table('authorization_letters')->where('id', $id)->get()->getRowArray();
        $student = $this->db->table('students')->where('id', $auth['student_id'])->get()->getRowArray();
        $parent  = $this->db->table('parents')->where('id', $auth['parent_id'])->get()->getRowArray();
        $this->db->table('authorization_letters')->where('id', $id)->update(['status' => 'declined']);
        $message = "Authorization for {$student['fname']} {$student['lname']} has been DECLINED at " . date('h:i A') . ". Please contact the school. - BCC Scan2Fetch";
        $this->db->table('sms_logs')->insert(['parent_phone' => $parent['phone'], 'message' => $message, 'status' => 'sent']);
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'decline', 'authorization', 'DECLINED authorization ID: '.$id.' | SMS sent');
        return redirect()->to('/authorizations')->with('msg', 'Authorization declined. SMS sent.');
    }
}