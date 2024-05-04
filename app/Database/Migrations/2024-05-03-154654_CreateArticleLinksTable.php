<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateArticleLinksTable extends Migration
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
            'link' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'status_id' => [
                'type' => 'INT',
                'constraint' => 5,
                'unsigned' => true,
            ],
            'article_id' => [
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
        $this->forge->addForeignKey('article_id', 'articles', 'id', 'CASCADE', 'CASCADE'); 
        $this->forge->createTable('article_links');
    }

    public function down()
    {
        $this->forge->dropTable('article_links');
    }
}
