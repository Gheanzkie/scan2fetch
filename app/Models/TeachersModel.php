<?php

namespace App\Models;

use CodeIgniter\Model;

class TeachersModel extends Model
{
    protected $table = 'teachers';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'teacher_no', 'fname', 'mname', 'lname', 'phone', 'password', 'password_sent', 'grade_section', 'created_by', 'created_at'
    ];

    /**
     * Next free teacher ID in the T-#### format (T-1001, T-1002, ...).
     */
    public function nextTeacherNo(): string
    {
        $db = \Config\Database::connect();
        $rows = $db->table('teachers')->select('teacher_no')->like('teacher_no', 'T-', 'after')->get()->getResultArray();
        $max = 1000;
        foreach ($rows as $r) {
            $n = (int) preg_replace('/\D+/', '', (string) $r['teacher_no']);
            if ($n > $max) {
                $max = $n;
            }
        }
        return 'T-' . ($max + 1);
    }

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