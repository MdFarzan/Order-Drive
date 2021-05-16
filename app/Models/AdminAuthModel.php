<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminAuthModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'od_admins_credential';
	protected $primaryKey           = 'id';
	protected $useAutoIncrement     = true;
	//protected $insertID             = 1;
	protected $returnType           = 'array';
	//protected $useSoftDelete        = false;
	//protected $protectFields        = true;
	protected $allowedFields        = ['id', 'name', 'email', 'passkey',
										'active_status', 'remember_token'];

	// Dates
	protected $useTimestamps        = true;
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
