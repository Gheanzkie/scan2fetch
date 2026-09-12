<?php

namespace App\Controllers;

use App\Models\SmsLogModel;
use App\Models\ActivityLogModel;

class Sms extends BaseController
{
    protected $smsLogModel;
    protected $logModel;

    public function __construct()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }
        $this->smsLogModel = new SmsLogModel();
        $this->logModel = new ActivityLogModel();
    }

    // ===== GET SMS LOGS (admin/staff) =====
    public function index()
    {
        $db = \Config\Database::connect();

        $data['smsLogs'] = $db->table('sms_logs')
            ->orderBy('sent_at', 'DESC')
            ->limit(200)
            ->get()
            ->getResultArray();

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

    // ===== DELETE SINGLE SMS LOG (admin/staff only) =====
    public function deleteLog($id)
    {
        if (! $this->requireAdminStaff()) return;
        $db = \Config\Database::connect();

        $sms = $db->table('sms_logs')->where('id', $id)->get()->getRowArray();
        if (!$sms) {
            return redirect()->to('/sms-logs')->with('error', 'SMS record not found.');
        }

        $db->table('sms_logs')->where('id', $id)->delete();
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'delete', 'sms_log', 'Deleted SMS log (ID: '.$id.')');
        return redirect()->to('/sms-logs')->with('msg', 'SMS record deleted.');
    }

    // ===== CLEAR ALL SMS LOGS (admin/staff only) =====
    public function clearAll()
    {
        if (! $this->requireAdminStaff()) return;
        $db = \Config\Database::connect();

        $count = $db->table('sms_logs')->countAllResults();
        $db->table('sms_logs')->emptyTable();
        $this->logModel->addLog(session('user_id'), session('fname').' '.session('lname'), session('role'), 'delete', 'sms_log', "Cleared all SMS logs ($count records removed)");
        return redirect()->to('/sms-logs')->with('msg', "All SMS logs cleared ($count records removed).");
    }
}