<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Partenaire extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'titre' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'img' => [
                'type' => 'LONGTEXT',
                'null' => false,
            ],
            'status_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'lien' => [
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('status_id', 'status', 'id'); // Correction de l'ajout de la clé étrangère
        $this->forge->createTable('partenaires');
    }

    public function down()
    {
        $this->forge->dropTable('partenaires');
    }
}
