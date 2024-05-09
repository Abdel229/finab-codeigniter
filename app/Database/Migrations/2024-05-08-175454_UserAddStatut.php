<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UserAddStatut extends Migration
{
    public function up()
    {
        $this->forge->addColumn('user', [
            'status_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
        ]);

        $this->forge->addForeignKey('user', 'status_id', 'status', 'id');
    }

    public function down()
    {
        //
    }
}
