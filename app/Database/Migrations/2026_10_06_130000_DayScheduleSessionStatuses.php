<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

/**
 * Per-session release switches in Date Management:
 * morning_status / afternoon_status on day_schedules.
 * NULL = enabled (default), 'closed' = releases blocked for that session,
 * 'open' = explicitly enabled. Each parent/student can then be released
 * once in the morning and once in the afternoon (2 scans/day, daily reset).
 */
class DayScheduleSessionStatuses extends Migration
{
    public function up()
    {
        $fields = $this->db->getFieldNames('day_schedules');
        if (! in_array('morning_status', $fields)) {
            $this->forge->addColumn('day_schedules', [
                'morning_status' => [
                    'type'       => 'ENUM',
                    'constraint' => ['open', 'closed'],
                    'null'       => true,
                    'default'    => null,
                    'after'      => 'close_time',
                ],
            ]);
        }
        $fields = $this->db->getFieldNames('day_schedules');
        if (! in_array('afternoon_status', $fields)) {
            $this->forge->addColumn('day_schedules', [
                'afternoon_status' => [
                    'type'       => 'ENUM',
                    'constraint' => ['open', 'closed'],
                    'null'       => true,
                    'default'    => null,
                    'after'      => 'morning_status',
                ],
            ]);
        }
    }

    public function down()
    {
        $fields = $this->db->getFieldNames('day_schedules');
        foreach (['afternoon_status', 'morning_status'] as $col) {
            if (in_array($col, $fields)) {
                $this->forge->dropColumn('day_schedules', $col);
            }
        }
    }
}
