<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CategoryManagement extends Migration
{
	public function up()
	{
		//defining fields
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned' => true,
				'auto_increment' => true,
			],

			'p_id' => [
				'type' => 'INT',
				'unsigned' => true,
				'default' => '0',
			],

			'name' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => false,
			],


			'slug' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => 'false',
			],
		]);

		$this->forge->addKey('id', true);
		$this->forge->createTable('OD_product_categories');
	}

	public function down()
	{
		//deleting table
		$this->forge->dropTable('OD_product_categories');
	}
}
