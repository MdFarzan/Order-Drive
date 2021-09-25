<?php

namespace App\Models;

use CodeIgniter\Model;

class GalleryManagementModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'od_product_gallery';
	// protected $primaryKey           = 'id';
	// protected $useAutoIncrement     = true;
	// protected $insertID             = 0;
	protected $returnType           = 'array';
	// protected $useSoftDelete        = false;
	// protected $protectFields        = true;
	protected $allowedFields        = ['id', 'product_id', 'img_src'];

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
