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
        $db = \Config\Database::connect();
        
        // ===== GET SMS LOGS ONLY (No grouping) =====
        $data['smsLogs'] = $db->table('sms_logs')
            ->orderBy('sent_at', 'DESC')
            ->limit(200)
            ->get()
            ->getResultArray();
        
        // Get stats
        $data['totalSms'] = $db->table('sms_logs')->countAllResults();
        
        return view('sms_logs', $data);
    }

    // ===== GET SMS DETAILS =====
    public function getSmsDetails($id)
    {
        if (!session('logged_in')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $db = \Config\Database::connect();
        
        $sms = $db->table('sms_logs')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        if (!$sms) {
            return $this->response->setJSON(['success' => false, 'message' => 'SMS not found']);
        }

        return $this->response->setJSON([
            'success' => true,
            'sms' => $sms
        ]);
    }
}