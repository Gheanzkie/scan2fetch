<?php

namespace App\Models;

use CodeIgniter\Model;

class FetchLogModel extends Model
{
    protected $table = 'fetch_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'student_id', 'parent_id', 'auth_letter_id',
        'fetcher_fname', 'fetcher_mname', 'fetcher_lname',
        'fetcher_relation', 'method', 'staff_id', 'time_released'
    ];
    protected $useTimestamps = false;
}