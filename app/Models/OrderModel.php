<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'OD_orders';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	// protected $insertID             = 0;
	protected $returnType           = 'array';
	// protected $useSoftDelete        = false;
	// protected $protectFields        = true;
	protected $allowedFields        = ['id', 'vendor_id', 'product_ids', 'ref_no', 'product_qtys', 'product_prices', 
										'delivery_address', 'order_status', 'order_date'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = true;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = true;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];
}
