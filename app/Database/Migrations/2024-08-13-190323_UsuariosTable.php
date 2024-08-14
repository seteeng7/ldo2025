<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UsuariosTable extends Migration
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
            'nome' => [
                'type' => 'VARCHAR',
                'Constraint' => '100',
                'null' => false,
            ],
            'cpf' => [
                'type' => 'VARCHAR',
                'Constraint' => '14',
                'null' => false,
            ],
            'bairro' => [
                'type' => 'VARCHAR',
                'Constraint' => '100',
                'null' => false,
            ],
            'telefone' => [
                'type' => 'VARCHAR',
                'Constraint' => '20',
                'null' => false,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'Constraint' => '100',
                'null' => false,
            ],
            'opcao' => [
                'type' => 'VARCHAR',
                'Constraint' => '50',
                'null' => false,
            ],
            'sugestao' => [
                'type' => 'VARCHAR',
                'Constraint' => '500',
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
        $this->forge->createTable('usuarios');
    }

    public function down()
    {
        // delete table
        $this->forge->dropTable('usuarios');
    }
}
