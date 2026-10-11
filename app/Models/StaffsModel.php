<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffsModel extends Model
{
    protected $table = 'staffs';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'fname', 'mname', 'lname', 'phone', 'password', 'password_sent', 'created_at'
    ];
}