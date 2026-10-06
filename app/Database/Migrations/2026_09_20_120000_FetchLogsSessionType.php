<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Per-session release tracking: each student can be released once in the
 * MORNING session and once in the AFTERNOON session; counts reset daily
 * (midnight) because fetch_logs are filtered by DATE(time_released).
 */
class FetchLogsSessionType extends Migration
{
    public function up()
    {
        // Skip if the column already exists (applied manually via SQL).
        $field = $this->db->getFieldNames('fetch_logs');
        if (! in_array('session_type', $field)) {
            $this->forge->addColumn('fetch_logs', [
                'session_type' => [
                    'type'       => 'ENUM',
                    'constraint' => ['morning', 'afternoon'],
                    'null'       => true,
                    'default'    => null,
                ],
            ]);
        }
    }

    public function down()
    {
        $field = $this->db->getFieldNames('fetch_logs');
        if (in_array('session_type', $field)) {
            $this->forge->dropColumn('fetch_logs', 'session_type');
        }
    }
}
