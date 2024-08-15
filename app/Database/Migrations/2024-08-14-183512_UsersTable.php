<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsersTable extends Migration
{
    public function up()
    {
        // columns
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'Constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true
            ],
            'usuario' => [
                'type' => 'VARCHAR',
                'Constraint' => '50',
                'null' => true,
            ],
            'senha' => [
                'type' => 'VARCHAR',
                'Constraint' => '200',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true
            ]
        ]);

        // primary key
        $this->forge->addPrimaryKey('id');

        // create table
        $this->forge->createTable('users');
    }

    public function down()
    {
        // delete table
        $this->forge->dropTable('users');
    }
}
