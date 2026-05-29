<?php

namespace App\Models;

use CodeIgniter\Model;

class ActivityLogModel extends Model
{
    protected $table = 'activity_logs';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'user_name', 'role', 'action', 'module', 'description', 'ip_address', 'created_at'];
    protected $useTimestamps = false;

    public function addLog($userId, $userName, $role, $action, $module, $description = '')
    {
        return $this->insert([
            'user_id' => $userId, 'user_name' => $userName, 'role' => $role,
            'action' => $action, 'module' => $module, 'description' => $description,
            'ip_address' => $_SERVER['REMOTE_ADDR'] ?? null,
        ]);
    }

    public function getLogs($filter = 'all', $module = '', $date = '', $limit = 200)
    {
        $builder = $this->orderBy('created_at', 'DESC');
        if ($filter == 'today') $builder->where('DATE(created_at)', date('Y-m-d'));
        elseif ($filter == 'week') $builder->where('created_at >=', date('Y-m-d', strtotime('-7 days')));
        elseif ($filter == 'month') $builder->where('created_at >=', date('Y-m-d', strtotime('-30 days')));
        if ($module) $builder->where('module', $module);
        if ($date) $builder->where('DATE(created_at)', $date);
        return $builder->limit($limit)->findAll();
    }
}