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


	// route for getting product
	public function getProduct(){
		
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

		$p_id = $this->request->getVar('id');
		
		// getting selected product data
		$product_db = new ProductManagementModel();
		
		$product_data = $product_db->where('id', $p_id);
		$p_data = $product_data->find();
		
		if($p_data){
			$data['product_data'] = $p_data[0];
			
		}

		else{
			$data['product_data'] = false;
		}
		// var_dump($data['product_data']);
		// die();

		return view('Vendor Views/SingleProduct', $data)	;
	}
	

	
	// search product functionalty
	public function findProduct(){

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

		// getting keywords to search
		$key = $this->request->getVar('find');
		
		$data['keywords'] = $key;
		// getting products for home page
		$product_db = new ProductManagementModel();

		$product_db->like('name', $key);
		$product_data = $product_db->paginate(12);
		
		
		
		if($product_data){
			$data['product_data'] = $product_data;
			$data['pager'] = $product_db->pager;
		}

		else{
			$data['product_data'] = false;
		}

		return view('Vendor Views/FindProduct', $data);
	}


	// getting cart
	public function getCart(){

		return view('Vendor Views/Cart');
	
	}


	

	// getting product for cart serving to ajax
	public function fillCart(){

		// getting localStorage sent id's
		$keys = json_decode($this->request->getVar('data'));

		
		// getting product from that id
		$product_db = new ProductManagementModel();

		$elm = '';
		$total_amt=0;
		for($i=0; $i<count($keys); $i++){

			$key = $keys[$i];

			// var_dump($key);
			// die();
			
			
			// checking is given element object
			if(is_object($key)){
					
				
				$product_db->where('id', $key->id);
				$product = $product_db->find();
				
			}

			else{
				continue;	
			}

			
			
			

			if($product){
				$product = $product[0];
				
				$total_amt += $product['price'] * $key->qty;
				$elm .= '<tr>'.
                    '<th scope="row" class="sr-no"></th>'.
                    '<td> <textarea class="cart-p-name" disabled="disabled" name="p-name[]">'.$product['name'].' </textarea></td>'.
                    '<td><img src='. $product['thumbnail_src'] .' class="cart-thumb" alt="" /></td>'.
                    '<td><input type="number" class="cart-p-qty" data-product-id="' . $key->id . '" value="' .$key->qty .'" name="qty[]" /></td>'.
                    '<td class="per-p-price">&#8377; <span class="amt">'. $product['price'] .'</span></td>'.
					'<td class="price-qty">&#8377; <span class="t-amt">'. $product['price'] * $key->qty .'</span></td>'.
					'<td><button type="button" data-product-id="' . $key->id . '" class="btn btn-danger remove-from-cart">&times;</button></td>'.
                    '</tr>';
			}


		}

		$last_row = '<tr><th colspan="5"> Payble Amount: </th><td><big><b>&#8377;</b> <span id="payble_amt">'. $total_amt .'</span></big></td><td></td></tr>';

		echo $elm. $last_row;
		
		
		

    }



}
