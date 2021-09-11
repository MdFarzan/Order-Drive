<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class VendorManagement extends Migration
{
	public function up()
	{
		//for vendor credential
		$this->forge->addField([
			'id' => ['type' => 'INT',
					'unsigned' => true,
					'auto_increment' => true,
			],

			'email' => ['type' => 'VARCHAR',
						'constraint' => '255',
						'unique' => true,
						'null' => false,
			],

			'passkey' => ['type' => 'VARCHAR',
							'constraint' => '255',
							'null' => false,
			],

			'active_status' => ['type' => 'BOOLEAN',
								'default'=> false,
			],

			'remember_token' => ['type' => 'VARCHAR',
								'constraint' => '255',
								'null' => true,
		],

			'created_at datetime default current_timestamp',
			'updated_at datetime default current_timestamp',
		]);

		$this->forge->addKey('id', true);
		
		$this->forge->createTable('OD_vendor_credentials');

		$this->db->disableForeignKeyChecks();

		// table to vendor profile
		$this->forge->addField([
			'vendor_id' => ['type' => 'INT',
							'unsigned' => true,
			],
			
			'name' => ['type' => 'VARCHAR',
						'constraint' => '255',
						'null' => false,
			],

			'contact_no' => [
						'type' => 'VARCHAR',
						'constraint' => '255',
						'null' => false,
			],

			'primary_address' => [
						'type' => 'VARCHAR',
						'constraint' => '255',
						'null' => false,
			],

		]);

		$this->forge->addForeignKey('vendor_id', 'OD_vendor_credentials', 'id');
		$this->forge->createTable('OD_vendor_profile');
		
		$this->db->enableForeignKeyChecks();

	}

	public function down()
	{
		//to deleting tables
		$this->db->disableForeignKeyChecks();
		$this->forge->dropTable('OD_vendor_credentials');
		$this->forge->dropTable('OD_vendor_profile');
		$this->db->enableForeignKeyChecks();
	}
}
