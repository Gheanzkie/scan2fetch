<?php

namespace App\Models;

use CodeIgniter\Model;

class SmsLogModel extends Model
{
    protected $table = 'sms_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['parent_phone', 'message', 'status', 'sent_at'];
    protected $useTimestamps = false;

    public function getAll($limit = 200)
    {
        return $this->orderBy('sent_at', 'DESC')
                    ->limit($limit)
                    ->findAll();
    }

    public function getSentCount()
    {
        return $this->where('status', 'sent')->countAllResults();
    }

    public function getPendingCount()
    {
        return $this->where('status', 'pending')->countAllResults();
    }

    public function getFailedCount()
    {
        return $this->where('status', 'failed')->countAllResults();
    }

    public function getTodayCount()
    {
        $today = date('Y-m-d');
        return $this->where('DATE(sent_at)', $today)->countAllResults();
    }

    public function getSmsWithParents($id)
    {
        $db = \Config\Database::connect();
        
        $sms = $this->find($id);
        if (!$sms) {
            return null;
        }

        // Get all similar SMS (same message pattern)
        $smsDate = date('Y-m-d', strtotime($sms['sent_at']));
        $messagePattern = substr($sms['message'], 0, 50);
        
        $similarSms = $db->table('sms_logs')
            ->where('DATE(sent_at)', $smsDate)
            ->like('message', $messagePattern)
            ->orderBy('sent_at', 'DESC')
            ->get()
            ->getResultArray();

        return [
            'sms' => $sms,
            'similar' => $similarSms
        ];
    }
}