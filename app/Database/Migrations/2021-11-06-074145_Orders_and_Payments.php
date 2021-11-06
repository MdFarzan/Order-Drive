<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Orders extends Migration
{
	public function up()
	{
		
			//creating order table
			$this->forge->addField([
				'id' => [
					'type' => 'INT',
					'unsigned'	=>	true,
					'auto_increment' => true,
				],
	
				'vendor_id' => [
					'type' => 'INT',
					'unsigned'	=>	true,
					'null' => false,
				],

				'ref_no' => [
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => false,
				],
	
				'product_ids' => [
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => false,
				],

				'product_qtys' => [
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => false,
				],
	
				'product_prices' => [
					'type' => 'VARCHAR',
					'constraint' => '255',
					'null' => false,
				],

				'delivery_address' => [
					'type' => 'TEXT',
					'null' => false,
				],

				'order_status' => [
					'type' => 'int',
					'null' => false,
				],
	
				'order_date datetime default current_timestamp',
			]);
	
			$this->forge->addKey('id', true);
			$this->forge->createTable('OD_orders');
			
			$this->db->disableForeignKeyChecks();
	
			// table for payment
			$this->forge->addField([
				'id' => [
					'type' => 'INT',
					'unsigned' => true,
					
				],
	

				'vendor_id' => [
					'type' => 'INT',
					'unsigned' => true,
				],
	
				'payment_mode' => [
					'type' => 'VARCHAR',
					'null' => false,
					'constraint' => '225'
				],

				'payble_amt' => [
					'type' => 'float',
					'null' => false,
				],
				
			]);
			
			$this->forge->addKey('id', true);
			
			$this->forge->addForeignKey('id', 'OD_orders', 'id');
			$this->forge->createTable('OD_payments');
			$this->db->enableForeignKeyChecks();
			
		

	}

	public function down()
	{	
		$this->db->disableForeignKeyChecks();
		//deleting both tables
		$this->forge->dropTable('OD_orders');
		$this->forge->dropTable('OD_payments');
		$this->db->enableForeignKeyChecks();
	}
}
