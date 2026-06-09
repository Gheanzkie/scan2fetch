<?php

namespace App\Controllers;

use App\Models\SmsLogModel;

class Sms extends BaseController
{
    protected $smsLogModel;

    public function __construct()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }
        $this->smsLogModel = new SmsLogModel();
    }

    public function index()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }
        
        $data['smsLogs']      = $this->smsLogModel->getAll(200);
        $data['totalSms']     = $this->smsLogModel->countAll();
        $data['sentCount']    = $this->smsLogModel->getSentCount();
        $data['pendingCount'] = $this->smsLogModel->getPendingCount();
        $data['failedCount']  = $this->smsLogModel->getFailedCount();
        $data['todayCount']   = $this->smsLogModel->getTodayCount();
        
        return view('sms_logs', $data);
    }
}