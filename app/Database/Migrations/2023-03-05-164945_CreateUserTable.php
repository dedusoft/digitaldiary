<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateUserTable extends Migration
{

    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 5,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'user_password' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'user_role' => [
                'type'  => "ENUM('admin','customer')",
                'null'  => false
            ],   
            'user_created_at' => [
                'type'      => 'DATETIME',
                'null'  => false
            ],
            'user_updated_at' => [
                'type'      => 'DATETIME',
                'null'  => false
            ],
            'user_deleted_at' => [
                'type'      => 'DATETIME',
                'null'  => false
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('users');
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
