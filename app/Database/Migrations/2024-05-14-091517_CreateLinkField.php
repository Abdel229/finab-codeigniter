<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateLinkField extends Migration
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
                'type' => 'TEXT',
                'constraint' => 255,
            ),
            'status' => array(
                'type' => 'INT',
                'constraint' => 11,
                'null' => true,
            ),
        ));
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('contact_links');
    }

    public function down()
    {
        //
    }
}
