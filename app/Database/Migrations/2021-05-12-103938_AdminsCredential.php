<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AdminsCredential extends Migration
{
	public function up()
	{
		$this->forge->addField([
			'id'          => [
					'type'           => 'INT',
					'unsigned'       => true,
					'auto_increment' => true,
			],
			'name'       => [
					'type'       => 'VARCHAR',
					'constraint' => '100',
			],
			'email' => [
					'type' => 'VARCHAR',
					'constraint' => '255',
			],
			'passkey'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
			],
			'active_status'       => [
				'type'       => 'BOOLEAN',
				'default'	 =>	true,
			],
			'remember_token'       => [
				'type'       => 'VARCHAR',
				'constraint' => '255',
				'null'		=>	true,
			],
			'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp',
	]);
	
	$this->forge->addKey('id', true);
	$this->forge->createTable('OD_admins_credential');
	$this->db->disableForeignKeyChecks();
	//admin priveleges table
		$this->forge->addField([
			'admin_id' =>[
				'type' => 'INT',
				'UNSIGNED' => TRUE,
			],
			'category_management' => [
				'type' => 'BOOLEAN',
				
			],
			'product_management' => [
				'type' => 'BOOLEAN',
				
			],
			'vendor_management' => [
				'type' => 'BOOLEAN',
				
			],
			'admins_management' => [
				'type' => 'BOOLEAN',
				
			],
			'order_management' => [
				'type' => 'BOOLEAN',
				
			],
			'report_management' => [
				'type' => 'BOOLEAN',
				
			],
		]);
		$this->db->enableForeignKeyChecks();
		$this->forge->addForeignKey('admin_id','OD_admins_credential','id');
		$this->forge->createTable('OD_admin_privileges');

	}

	public function down()
	{
		$this->forge->dropTable('OD_admins_credential');
		$this->forge->dropTable('OD_admin_privileges');
	}
}
