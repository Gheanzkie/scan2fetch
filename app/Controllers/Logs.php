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
        if (!session('logged_in')) {
            return redirect()->to('/login')->send();
        }

        // Activity logs are for admin/staff only.
        $role = session('role');
        if ($role != 'admin' && $role != 'staff') {
            return redirect()->to('/dashboard');
        }
        
        $filter = $this->request->getGet('filter') ?? 'all';
        $module = $this->request->getGet('module') ?? '';
        $date   = $this->request->getGet('date') ?? '';
        $search = trim($this->request->getGet('q') ?? '');

        $data['logs']   = $this->logModel->getLogs($filter, $module, $date, 200, $search);
        $data['filter'] = $filter;
        $data['module'] = $module;
        $data['date']   = $date;
        $data['search'] = $search;

        return view('logs', $data);
    }
}