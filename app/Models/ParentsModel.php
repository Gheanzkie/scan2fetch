<?php

namespace App\Models;

use CodeIgniter\Model;

class ParentsModel extends Model
{
    protected $table = 'parents';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'fname', 'mname', 'lname', 'phone', 'password', 'qr_code', 'picture', 'created_by', 'created_at'
    ];
}