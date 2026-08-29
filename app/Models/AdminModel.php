<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admin';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'fname', 'mname', 'lname', 'phone', 'password', 'picture', 'created_at'
    ];
}