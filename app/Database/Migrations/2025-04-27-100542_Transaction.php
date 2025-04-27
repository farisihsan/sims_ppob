<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transaction extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'               => [
                'type' => 'INT',
                'auto_increment' => true,
            ],
            'invoice_number'   => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'user_id'          => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'service_code'     => [
                'type' => 'VARCHAR',
                'constraint' => 50,
            ],
            'service_name'     => [
                'type' => 'VARCHAR',
                'constraint' => 100,
            ],
            'transaction_type' => [
                'type' => 'VARCHAR',
                'constraint' => 20,
            ],
            'total_amount'     => [
                'type' => 'INT',
            ],
            'created_on'       => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('transactions');
    }

    public function down()
    {
        $this->forge->dropTable('transactions');
    }
}
