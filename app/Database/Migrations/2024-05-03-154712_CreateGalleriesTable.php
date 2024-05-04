<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateGalleriesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'img' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'category_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'status_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('category_id', 'galleries_category', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('status_id', 'status', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('galleries');
    }

    public function down()
    {
        $this->forge->dropTable('galleries');
    }
}
