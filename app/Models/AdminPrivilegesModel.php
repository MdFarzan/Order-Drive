<?php 

namespace App\Models;
use CodeIgniter\Model;

class AdminPrivilegesModel extends Model{

    protected $DBGroup              = 'default';
	protected $table                = 'od_admin_privileges';
	// protected $primaryKey           = 'admin_id';
	//protected $useAutoIncrement     = true;
	//protected $insertID             = 1;
	protected $returnType           = 'array';
	//protected $useSoftDelete        = false;
	//protected $protectFields        = true;
	protected $allowedFields        = ['admin_id', 'category_management', 'product_management', 'vendor_management',
                                        'admins_management', 'order_management', 'report_management'];

	// Dates
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'created_at';
	protected $updatedField         = 'updated_at';
	//protected $deletedField         = 'deleted_at';

	// Validation
	protected $validationRules      = [];
	protected $validationMessages   = [];
	protected $skipValidation       = true;
	protected $cleanValidationRules = true;

	// Callbacks
	protected $allowCallbacks       = false;
	protected $beforeInsert         = [];
	protected $afterInsert          = [];
	protected $beforeUpdate         = [];
	protected $afterUpdate          = [];
	protected $beforeFind           = [];
	protected $afterFind            = [];
	protected $beforeDelete         = [];
	protected $afterDelete          = [];

}