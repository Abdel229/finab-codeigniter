<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArticlesTable extends Migration
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
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'img' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'description' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'date_pub' => [
                'type' => 'date',
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
        $this->forge->addForeignKey('status_id', 'status', 'id', 'CASCADE', 'CASCADE'); 
        $this->forge->addForeignKey('category_id', 'articles_category', 'id', 'CASCADE', 'CASCADE'); 
        $this->forge->createTable('articles');
    }

    public function down()
    {
        $this->forge->dropTable('articles');
    }

}
