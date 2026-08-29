<?php

namespace App\Models;

use CodeIgniter\Model;

class TeachersModel extends Model
{
    protected $table = 'teachers';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'fname', 'mname', 'lname', 'phone', 'password', 'grade_section', 'picture', 'created_by', 'created_at'
    ];

    public function studentCounts(): array
    {
        $db = \Config\Database::connect();
        return $db->table('students')
            ->select('grade_section, COUNT(*) as total')
            ->groupBy('grade_section')
            ->get()
            ->getResultArray();
    }
}