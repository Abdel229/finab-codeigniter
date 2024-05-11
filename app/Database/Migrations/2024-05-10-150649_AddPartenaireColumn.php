<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPartenaireColumn extends Migration
{
    public function up()
    {
        $fields = [
            'lien' => [
                'type' => 'TEXT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
        ];

        $this->forge->addColumn('Partenaires', $fields);
    }

    public function down()
    {
        //
    }
}
