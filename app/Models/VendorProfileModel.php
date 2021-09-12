<?php

namespace App\Models;

use CodeIgniter\Model;

class VendorProfileModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'od_vendor_profile';
	// protected $primaryKey           = '';
	// protected $useAutoIncrement     = false;
	// protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDelete        = false;
	protected $protectFields        = false;
	protected $allowedFields        = ['vendor_id', 'name', 'contact_no',
										'primary_address', 'secondary_address'];

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
