<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Contact extends Migration
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
            'adresse' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'phone_number' => array(
                'type' => 'VARCHAR',
                'constraint' => 255,
            ),
            'email' => array(
                'type' => 'VARCHAR', // Changement du type de données en VARCHAR
                'constraint' => 255, // Réduire la contrainte de longueur
            ),
            'status_id' => array(
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            )
        ));
        $this->forge->addKey('id', TRUE);
        $this->forge->addForeignKey('status_id', 'status', 'id'); 
        $this->forge->createTable('contacts');
    }

    public function down()
    {
        $this->forge->dropTable('contacts'); 
    }
}
