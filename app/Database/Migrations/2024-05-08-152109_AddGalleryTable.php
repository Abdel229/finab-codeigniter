<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddGalleryTable extends Migration
{
    public function up() {
        $this->forge->addColumn('galleries', [
            'gallery_information_id' => [
                'type' => 'INT',
                'unsigned' => TRUE,
                'null' => TRUE,
            ],
        ]);

        $this->forge->addForeignKey('galleries', 'gallery_information_id', 'galleriesinformation', 'id');
    }

    public function down() {
        $this->forge->dropForeignKey('galleries', 'gallery_information_id');
        $this->forge->dropColumn('galleries', 'gallery_information_id');
    }
}
