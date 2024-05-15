<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSocialLink extends Migration
{
    public function up()
    {
        $this->forge->addField(array(
            'id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => TRUE,
                'auto_increment' => TRUE,
            ),
            'name' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'link' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'status_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            )
        ));
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('social_link');
    }

    public function down()
    {
        //
    }
}
