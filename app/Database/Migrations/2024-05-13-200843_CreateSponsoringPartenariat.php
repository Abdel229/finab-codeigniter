<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSponsoringPartenariat extends Migration
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
            'title' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'subtitle' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'principal_img' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'reasons' => array(
                'type' => 'TEXT',
                'constraint' => 11,
                'null' => false,
            ),
            'mini_text' => array(
                'type' => 'TEXT',
                'constraint' => 255,
            ),
            'images' => array(
                'type' => 'TEXT',
                'constraint' => 11,
                'null' => true,
            ),
            'videos_links' => array(
                'type' => 'TEXT',
                'constraint' => 11,
                'null' => true,
            ),
        ));
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('sponsoring_partnership');
    }

    public function down()
    {
        //
    }
}
