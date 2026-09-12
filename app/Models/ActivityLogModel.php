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
            'user_id'     => $userId,
            'user_name'   => $userName,
            'role'        => $role,
            'action'      => $action,
            'module'      => $module,
            'description' => $description,
            'ip_address'  => $_SERVER['REMOTE_ADDR'] ?? null,
        ]);
    }

    public function getLogs($filter = 'all', $module = '', $date = '', $limit = 200, $search = '')
    {
        $builder = $this->orderBy('created_at', 'DESC');

        // Time-based filters
        if ($filter === 'today') {
            $builder->where('DATE(created_at)', date('Y-m-d'));
        } elseif ($filter === 'yesterday') {
            $builder->where('DATE(created_at)', date('Y-m-d', strtotime('-1 day')));
        } elseif ($filter === 'week') {
            $builder->where('created_at >=', date('Y-m-d', strtotime('-7 days')));
        } elseif ($filter === 'month') {
            $builder->where('created_at >=', date('Y-m-d', strtotime('-30 days')));
        } elseif ($filter !== 'all' && !empty($filter)) {
            // Specific action filter
            $builder->where('action', $filter);
        }

        // Module filter
        if (!empty($module)) {
            $builder->where('module', $module);
        }

        // Date filter (overrides time-based if set)
        if (!empty($date)) {
            $builder->where('DATE(created_at)', $date);
        }

        // Search filter
        if (!empty($search)) {
            $builder->groupStart()
                ->like('user_name', $search)
                ->orLike('description', $search)
                ->orLike('action', $search)
                ->orLike('module', $search)
                ->groupEnd();
        }

        return $builder->limit($limit)->findAll();
    }
}