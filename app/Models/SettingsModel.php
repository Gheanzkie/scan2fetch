<?php

namespace App\Models;

use CodeIgniter\Model;

class SettingsModel extends Model
{
    protected $table = 'settings';
    protected $primaryKey = 'id';
    protected $allowedFields = ['setting_key', 'setting_value', 'updated_at'];
    protected $useTimestamps = false;

    public function __construct()
    {
        parent::__construct();
        $this->ensureTable();
    }

    /**
     * Create the settings table on the fly if it does not exist yet.
     */
    protected function ensureTable()
    {
        $db = \Config\Database::connect();
        $db->query("CREATE TABLE IF NOT EXISTS `settings` (
            `id` INT NOT NULL AUTO_INCREMENT,
            `setting_key` VARCHAR(100) NOT NULL,
            `setting_value` TEXT NULL,
            `updated_at` DATETIME NULL,
            PRIMARY KEY (`id`),
            UNIQUE KEY `setting_key` (`setting_key`)
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci");
    }

    /**
     * Get a setting value with a default fallback.
     */
    public function getSetting($key, $default = null)
    {
        $row = $this->where('setting_key', $key)->first();
        return ($row && $row['setting_value'] !== null && $row['setting_value'] !== '')
            ? $row['setting_value']
            : $default;
    }

    /**
     * Insert or update a setting value.
     */
    public function setSetting($key, $value)
    {
        $existing = $this->where('setting_key', $key)->first();

        if ($existing) {
            return $this->update($existing['id'], [
                'setting_value' => $value,
                'updated_at'    => date('Y-m-d H:i:s'),
            ]);
        }

        return $this->insert([
            'setting_key'   => $key,
            'setting_value' => $value,
            'updated_at'    => date('Y-m-d H:i:s'),
        ]);
    }
}