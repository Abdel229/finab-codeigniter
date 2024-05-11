<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateContactTable extends Migration
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
            'object' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'email' => array(
                'type'=>"LONGTEXT",
                'null'=>false
            ),
            'message' => array(
                'type'=>"LONGTEXT",
                'null'=>false
            ),
            'status_id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ),
            'read_statut'=>array(
                'type' => 'INT',
                'null'=>false
            )
        ));
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('contacts');
        $this->forge->addForeignKey('contacts', 'status_id', 'status', 'id');
    }

    public function down()
    {
        //
    }
}