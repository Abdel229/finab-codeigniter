<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGaleryInformationStatus extends Migration
{
    public function up()
    {
        $this->forge->addColumn('galleriesinformation', [
            'status_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
        ]);

        $this->forge->addForeignKey('galleriesinformation', 'status_id', 'status', 'id');
    }

    public function down()
    {
        //
    }
}
