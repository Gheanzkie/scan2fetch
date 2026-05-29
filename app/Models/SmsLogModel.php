<?php

namespace App\Models;

use CodeIgniter\Model;

class SmsLogModel extends Model
{
    protected $table = 'sms_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['parent_phone', 'message', 'status', 'sent_at'];
}