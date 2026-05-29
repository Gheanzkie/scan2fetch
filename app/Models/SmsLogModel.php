<?php

namespace App\Models;

use CodeIgniter\Model;

class SmsLogModel extends Model
{
    protected $table = 'sms_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['parent_phone', 'message', 'status', 'sent_at'];
    protected $useTimestamps = false;

    
    public function getAll($limit = 100)
    {
        return $this->orderBy('sent_at', 'DESC')->limit($limit)->findAll();
    }

    
    public function getTodayCount()
    {
        return $this->where('DATE(sent_at)', date('Y-m-d'))->countAllResults();
    }

    
    public function getSentCount()
    {
        return $this->where('status', 'sent')->countAllResults();
    }

    
    public function getFailedCount()
    {
        return $this->where('status', 'failed')->countAllResults();
    }

    
    public function addLog($phone, $message, $status = 'sent')
    {
        return $this->insert([
            'parent_phone' => $phone,
            'message'      => $message,
            'status'       => $status,
        ]);
    }
}