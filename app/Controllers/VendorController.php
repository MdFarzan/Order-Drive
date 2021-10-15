<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryManagementModel;

class VendorController extends BaseController
{
	public function placeOrder()
	{

		$category_db = new CategoryManagementModel();

		//checking if has data
		
		if($category_db->countAll()>0){
			$category_db->where('p_id', 0);
			$data = $category_db->findAll();
			$data = ['category_menu' => $data];
		}

		else{
			$data = ['category_menu' => false];
		}

		return View('Vendor Views/Shop', $data);
	}
	
}
