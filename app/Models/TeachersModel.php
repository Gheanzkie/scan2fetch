<?php

namespace App\Models;

use CodeIgniter\Model;

class TeachersModel extends Model
{
    protected $table = 'teachers';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'fname', 'mname', 'lname', 'phone', 'password', 'password_sent', 'grade_section', 'picture', 'created_by', 'created_at'
    ];

    public function studentCounts(): array
    {
        $db = \Config\Database::connect();
        // Count by ADVISER (students.adviser_id), not by grade_section — a
        // teacher's class list is defined by adviser_id so one teacher can
        // hold students from every grade level.
        return $db->table('students')
            ->select('adviser_id, COUNT(*) as total')
            ->where('adviser_id IS NOT NULL', null, false)
            ->groupBy('adviser_id')
            ->get()
            ->getResultArray();
    }
}