<?php

namespace App\Controllers;

use App\Models\StudentModel;
use App\Models\ActivityLogModel;

class Students extends BaseController
{
    protected $studentModel;
    protected $logModel;

    public function __construct()
    {
        $this->studentModel = new StudentModel();
        $this->logModel     = new ActivityLogModel();
    }

    public function index()
    {
        $data['students'] = $this->studentModel->getAllWithParent();
        return view('students', $data);
    }
}