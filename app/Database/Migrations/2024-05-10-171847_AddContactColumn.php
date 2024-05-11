<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddContactColumn extends Migration
{
    public function up()
    {
        $fields = [
            'created_at' => array(
                'type' => 'DATETIME',
                'null' => true,
            ),
            'updated_at' => array(
                'type' => 'DATETIME',
                'null' => true,
            ),
        ];

        $this->forge->addColumn('contacts', $fields);
    }

    public function down()
    {
        //
    }
}
