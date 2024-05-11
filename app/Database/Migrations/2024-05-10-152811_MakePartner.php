<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Partenaire extends Migration
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
            'titre' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'img' => array(
                'type'=>"LONGTEXT",
                'null'=>false
            ),
            'status_id' => array(
                'type' => 'INT',
                'unsigned' => TRUE,
                ',
                null' => TRUE,
            ),
            'lien' => array(
                'type' => 'TEXT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ),
        ));
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('partenaires');
        $this->forge->addForeignKey('partenaires', 'status_id', 'status', 'id');
    }

    public function down()
    {
        $this->forge->dropTable('partenaires');
    }
}
