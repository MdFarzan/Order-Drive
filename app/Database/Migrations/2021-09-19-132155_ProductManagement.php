<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ProductManagement extends Migration
{
	public function up()
	{
		//creating product table
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned'	=>	true,
			],

			'category_id' => [
				'type' => 'INT',
				'unsigned' => true,
			],

			'thumbnail_src' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => false,
			],

			'name' => [
				'type' => 'VARCHAR',
				'constraint' => '255',
				'null' => false,
			],

			'price' => [
				'type' => 'FLOAT',
				'null' => false,
			],

			'short_desc' => [
				'type' => 'TEXT',
				'null' => true,
			],

			'long_desc' => [
				'type' => 'TEXT',
				'null' => true,
			],
		]);

		$this->forge->addKey('id', true);
		$this->forge->createTable('OD_products');
		
		$this->db->disableForeignKeyChecks();

		// table for product gallery
		$this->forge->addField([
			'id' => [
				'type' => 'INT',
				'unsigned' => true,
			],

			'product_id' => [
				'type' => 'INT',
				'unsigned' => true,
			],

			'img_src' => [
				'type' => 'text',
				'null' => true,
			],
		]);
		
		$this->forge->addKey('id', true);
		
		$this->forge->addForeignKey('product_id', 'OD_products', 'id');
		$this->forge->createTable('OD_product_gallery');
		$this->db->enableForeignKeyChecks();
		
	}

	public function down()
	{
		// clearing tables
		$this->db->disableForeignKeyChecks();
		$this->forge->dropTable('OD_product_gallery');
		$this->forge->dropTable('OD_products');
		$this->forge->enableForeignKeyChecks();

	}
}
