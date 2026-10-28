<?php

namespace App\Models;

use CodeIgniter\Model;

class StaffsModel extends Model
{
    protected $table = 'staffs';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'staff_no', 'fname', 'mname', 'lname', 'phone', 'password', 'password_sent', 'created_at'
    ];

    /**
     * Next free staff ID in the S-#### format (S-1001, S-1002, ...).
     */
    public function nextStaffNo(): string
    {
        $db = \Config\Database::connect();
        $rows = $db->table('staffs')->select('staff_no')->like('staff_no', 'S-', 'after')->get()->getResultArray();
        $max = 1000;
        foreach ($rows as $r) {
            $n = (int) preg_replace('/\D+/', '', (string) $r['staff_no']);
            if ($n > $max) {
                $max = $n;
            }
        }
        return 'S-' . ($max + 1);
    }
}