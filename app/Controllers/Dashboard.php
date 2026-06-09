<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\ParentsModel;
use App\Models\StaffsModel;
use App\Models\FetchLogModel;
use App\Models\AuthLetterModel;
use App\Models\SmsLogModel;
use App\Models\SubFetcherModel;

class Dashboard extends BaseController
{
    protected $studentModel;
    protected $parentsModel;
    protected $staffsModel;
    protected $fetchLogModel;
    protected $authLetterModel;
    protected $smsLogModel;
    protected $subFetcherModel;

    public function __construct()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }
        $this->studentModel    = new StudentModel();
        $this->parentsModel    = new ParentsModel();
        $this->staffsModel     = new StaffsModel();
        $this->fetchLogModel   = new FetchLogModel();
        $this->authLetterModel = new AuthLetterModel();
        $this->smsLogModel     = new SmsLogModel();
        $this->subFetcherModel = new SubFetcherModel();
    }

    public function index()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login');
        }

        $role   = session('role');
        $userId = session('user_id');
        $today  = date('Y-m-d');

        $data = ['title' => 'Dashboard'];

        // ========== ADMIN ==========
        if ($role == 'admin') {
            $data['totalStudents']  = $this->studentModel->countAll();
            $data['totalParents']   = $this->parentsModel->countAll();
            $data['totalStaff']     = $this->staffsModel->countAll();
            $data['releasedToday']  = $this->fetchLogModel->where('DATE(time_released)', $today)->countAllResults();
            $data['pendingAuth']    = $this->authLetterModel->where('status', 'pending')->countAllResults();
            $data['smsSentToday']   = $this->smsLogModel->where('DATE(sent_at)', $today)->countAllResults();
            $data['qrReleases']     = $this->fetchLogModel->where('method', 'QR')->countAllResults();
            $data['recentReleases'] = $this->fetchLogModel->orderBy('time_released', 'DESC')->limit(10)->findAll();
            $data['smsLogs'] = $this->smsLogModel->orderBy('sent_at', 'DESC')->limit(10)->findAll();
        }

        // ========== STAFF ==========
        if ($role == 'staff') {
            $data['totalStudents']     = $this->studentModel->countAll();
            $data['releasedToday']     = $this->fetchLogModel->where('staff_id', $userId)->where('DATE(time_released)', $today)->countAllResults();
            $data['smsSentToday']      = $this->smsLogModel->where('DATE(sent_at)', $today)->countAllResults();
            $data['pendingAuthLetters'] = $this->authLetterModel->where('status', 'pending')->findAll();
            $data['todayReleases'] = $this->fetchLogModel
                ->where('staff_id', $userId)
                ->where('DATE(time_released)', $today)
                ->orderBy('time_released', 'DESC')
                ->findAll();
        }

        // ========== PARENT ==========
        if ($role == 'parent') {
            // Parent profile
            $data['parentProfile'] = $this->parentsModel->find($userId);

            // Get children via student_parents table
            $db = \Config\Database::connect();
            $studentParents = $db->table('student_parents')
                ->where('parent_id', $userId)
                ->get()
                ->getResultArray();
            
            $data['myChildren'] = [];
            if (!empty($studentParents)) {
                foreach ($studentParents as $sp) {
                    $student = $this->studentModel->find($sp['student_id']);
                    if ($student) {
                        $student['relation'] = $sp['relation'];
                        $data['myChildren'][] = $student;
                    }
                }
            }

            // Fallback: check old parent_id field directly
            if (empty($data['myChildren'])) {
                $data['myChildren'] = $this->studentModel->where('parent_id', $userId)->findAll();
            }

            // Get sub-fetchers
            $data['subFetchers'] = $this->subFetcherModel->where('parent_id', $userId)->findAll();
        }

        return view('dashboard', $data);
    }
}