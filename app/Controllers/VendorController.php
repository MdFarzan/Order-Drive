<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryManagementModel;
use App\Models\ProductManagementModel;
use App\Models\OrderModel;
use App\Models\PaymentModel;

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
				
			}

			
			// if has sub categories
			else{
				

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
                    '<td><span class="p-name">'.$product['name'].' <input type="hidden" name="product-id[]" value="'.$product['id'].'" ></span></td>'.
                    '<td><img src='. $product['thumbnail_src'] .' class="cart-thumb" alt="" /></td>'.
                    '<td><input type="number" class="cart-p-qty" data-product-id="' . $key->id . '" value="' .$key->qty .'" name="qty[]" /></td>'.
                    '<td class="per-p-price">&#8377; <span class="amt">'. $product['price'] .'</span></td>'.
					'<td class="price-qty">&#8377; <span class="t-amt">'. $product['price'] * $key->qty .'</span></td>'.
					'<td><button type="button" data-product-id="' . $key->id . '" class="btn btn-danger remove-from-cart">&times;</button></td>'.
                    '</tr>';
			}


		}

		$last_row = '<tr><th colspan="5"> Payble Amount: </th><td><big><b><span class="rupee-symbol"><i class="fas fa-rupee-sign"></i></span></b> <span id="payble_amt">'. $total_amt .'</span></big></td><td></td></tr>';

		echo $elm. $last_row;

    }

	// final step in order placement
	public function createOrder(){
		
		$vendor_id = session()->get('vendor_profile')['vendor_id'];
		

		$product_ids = implode(",", $this->request->getVar('product-id'));
		$product_qtys = implode(",", $this->request->getVar('qty'));

		$addr = $this->request->getVar('delivery-addr');
		$payment_mode = $this->request->getVar('payment-mode');

		// if payment mode is bank then
		if($payment_mode == 'card'){
			$card_holder = $this->request->getVar('holder-name');
			$card_no = $this->request->getVar('card-no');
			$cvv = $this->request->getVar('cvv');
			$exp = $this->request->getVar('expiry-date');

			
		}

		// if payment mode is upi
		else if($payment_mode == 'upi'){
			$upi_id = $this->request->getVar('upi-id');
			
		}

		$order_db = new OrderModel();
		$payment_db = new PaymentModel();

		// getting product prices
		$product_db = new ProductManagementModel();
		$pids = $this->request->getVar('product-id');
		$pqtys = $this->request->getVar('qty');

		$payble_amt = 0;

		for($i=0; $i<count($pids); $i++){
			$data = $product_db->where('id', $pids[$i])->find();
			$data = $data[0];
			$product_prices[$i] = $data['price'];
			$payble_amt += ($data['price'] * $pqtys[$i]);
		}

		$product_prices = implode(',', $product_prices);
		$l_id =  $order_db->countAll();
		$ref_no = 'OD-'.$vendor_id.$l_id.date('dy').'-'.substr(sha1(rand(1,10)), 0, 5);;
		
		

		
		
		$order_data = ["vendor_id" => $vendor_id,
						"ref_no" => $ref_no,
						 "product_ids" => $product_ids,
						 "product_qtys" => $product_qtys,
						 "product_prices" => $product_prices,
						 "delivery_address" => $addr,
						 "order_status" => 1,
						];
		
		
		
		// starting transactions
		$order_db->transBegin();
		$payment_db->transBegin();
		
		$order_id = $order_db->insert($order_data);
		
		// checking is transaction successfull
		if($order_db->transStatus() === false){
			$order_db->transRollback();

			echo "Unable to place order! Please contact from Admin!";
		}

		else{

			$payment_data = ["id" => $order_id,
						"vendor_id" => $vendor_id,
						"payment_mode" => $payment_mode,
						"payble_amt" => $payble_amt
						];
			
			$payment_db->insert($payment_data);
			
			if($order_db->transStatus() === false || $payment_db->transStatus() === false){
				$order_db->transRollback();
				$payment_db->transRollback();
			}

			else{
				$order_db->transCommit();
				$payment_db->transCommit();

				setAlert(['type'=>'success', 'desc'=>'Order placed successfully, please check Order History for more details.']);
				
				if($payment_mode == 'card' || $payment_mode == 'upi')
					sleep(4);	

				echo '<script>localStorage.clear();'. 
						'window.location.href="'. base_url('/vendor/dashboard/').'"'.
				
				'</script>';
				
				
			}



		}
		
		

		



		
		
		
		

	}



}
