<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGaleryInformationCategory extends Migration
{
    public function up()
    {
        $this->forge->addColumn('galleriesinformation', [
            'category_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
        ]);

        $this->forge->addForeignKey('galleriesinformation', 'category_id', 'status', 'id');
    }

    public function down()
    {
        //
    }
}
