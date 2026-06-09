<?php

namespace App\Controllers;

use App\Models\ActivityLogModel;

class Logs extends BaseController
{
    protected $logModel;

    public function __construct()
    {
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }
        $this->logModel = new ActivityLogModel();
    }

    public function index()
    {
        $filter = $this->request->getGet('filter') ?? 'today'; // Default: today
        $module = $this->request->getGet('module') ?? '';
        $date   = $this->request->getGet('date') ?? date('Y-m-d'); // Default: today's date

        $data['logs']   = $this->logModel->getLogs($filter, $module, $date);
        $data['filter'] = $filter;
        $data['module'] = $module;
        $data['date']   = $date;

        return view('logs', $data);
    }
}