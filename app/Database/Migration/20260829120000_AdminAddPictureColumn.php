<?php

namespace App\Database\Migration;

use CodeIgniter\Database\Migration;

class AdminAddPictureColumn extends Migration
{
    public function up()
    {
        $this->forge->addColumn('admin', [
            'picture' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
                'default'    => null,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('admin', 'picture');
    }
}