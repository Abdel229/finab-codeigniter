<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class GalleriesTitleModel extends Migration
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
            'img_principales' => array(
                'type'=>"LONGTEXT",
                'null'=>false
            )
        ));
        $this->forge->addKey('id', TRUE);
        $this->forge->createTable('GalleriesInformation');
    }

    public function down()
    {
        $this->forge->dropTable('localities');
    }
}