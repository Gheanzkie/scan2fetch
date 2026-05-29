<?php

namespace App\Models;

use CodeIgniter\Model;

class AuthLetterModel extends Model
{
    protected $table = 'authorization_letters';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'student_id', 'parent_id',
        'fetcher_fname', 'fetcher_mname', 'fetcher_lname',
        'fetcher_phone', 'fetcher_picture', 'relation', 'status'
    ];
}