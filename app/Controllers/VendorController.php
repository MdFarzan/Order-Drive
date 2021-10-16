<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryManagementModel;
use App\Models\ProductManagementModel;

class VendorController extends BaseController
{
	public function placeOrder()
	{

		// getting category for menu
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

		// getting products for home page
		$product_db = new ProductManagementModel();
		
		$product_data = $product_db->paginate(12);
		
		if($product_data){
			$data['product_data'] = $product_data;
			$data['pager'] = $product_db->pager;
		}

		else{
			$data['product_data'] = false;
		}

		

		

		return View('Vendor Views/Shop', $data);
	}
	
}
