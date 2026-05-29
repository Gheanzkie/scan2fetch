<?php

namespace App\Models;

use CodeIgniter\Model;

class StudentModel extends Model
{
    protected $table = 'students';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'fname', 'mname', 'lname', 'grade_section', 'parent_id', 'picture', 'created_by', 'created_at'
    ];

    
    public function getAllWithParent()
    {
        return $this->select('students.*, parents.fname as pfname, parents.lname as plname, parents.phone as pphone')
                    ->join('parents', 'parents.id = students.parent_id', 'left')
                    ->orderBy('students.created_at', 'DESC')
                    ->findAll();
    }

    
    public function getByParentId($parentId)
    {
        return $this->where('parent_id', $parentId)->findAll();
    }
}