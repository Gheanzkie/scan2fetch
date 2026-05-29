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
        $data['smsLogs']      = $this->smsLogModel->getAll(100);
        $data['totalSms']     = count($data['smsLogs']);
        $data['sentCount']    = $this->smsLogModel->getSentCount();
        $data['failedCount']  = $this->smsLogModel->getFailedCount();
        $data['todayCount']   = $this->smsLogModel->getTodayCount();
        return view('sms_logs', $data);
    }
}