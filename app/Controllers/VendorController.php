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



	// controller for handling category route
	public function getCategory($cat){

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

		// getting sub-category data
		$category_db = new CategoryManagementModel();
		$category_db->where('slug', $cat);
		$cat_id = $category_db->find();
		$p_cat_name = $cat_id[0]['name'];
		$cat_id = $cat_id[0]['id'];
		
		$category_db->where('p_id', $cat_id);

		
		$data['parent_category'] = $p_cat_name;	
		
		if($category_db->where('p_id', $cat_id)->countAll()>0){
			$data['sub_category_menu'] = $category_db->where('p_id', $cat_id)->findAll();
			

		}

		else{
			$data['sub_category_menu'] = false;
		}

			$product_db = new ProductManagementModel();

			// checking if category has no sub-category
			if($data['sub_category_menu'] == false){

				// getting category products
				$product_data = $product_db->where('category_id', $cat_id)->paginate(12);
				// var_dump($product_data);
				// die($cat_id);
			}

			
			// if has sub categories
			else{
				// var_dump($data['sub_category_menu']);

				$q = "(category_id="."'".$data['sub_category_menu'][0]['id']."'";
				foreach($data['sub_category_menu'] as $c){
					$q .= " OR category_id="."'".$c['id']."'";
					
				}

				$q .= ")";

				$product_data = $product_db->where($q, NULL, FALSE)->paginate(12);
				
			}
			
			
			
		
			// $product_data = $product_db->where('id', $cat_id)->paginate(12);
			
			if($product_data){
				$data['product_data'] = $product_data;
				$data['pager'] = $product_db->pager;
			}
	
			else{
				$data['product_data'] = false;
			}

			// echo $cat_id;
		// var_dump($data['product_data']);
		// die();
		
		return view('Vendor Views/Category', $data);

	}
	
}
