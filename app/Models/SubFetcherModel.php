<?php

namespace App\Models;

use CodeIgniter\Model;

class SubFetcherModel extends Model
{
    protected $table = 'sub_fetchers';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'parent_id', 'student_id', 'fname', 'mname', 'lname', 'phone', 'picture', 'qr_code', 'created_by', 'created_at'
    ];
    protected $useTimestamps = false;
}