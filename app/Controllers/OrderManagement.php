<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\PaymentModel;
use App\Models\ProductManagementModel;
use App\Models\CategoryManagementModel;


class OrderManagement extends BaseController
{
	public function index()
	{

			$order_db = new OrderModel();
			$payment_db = new PaymentModel();
	
			// getting all orders
			$order_data = $order_db->orderBy('id', 'DESC')->findAll();
			$payment_data = $payment_db->orderBy('id', 'DESC')->findAll();
			
			
			if(count($order_data) != 0 || $order_data != null){
				$data['order_data'] = $order_data;
				$data['payment_data'] = $payment_data;
			}
	
			else{
				$data['order_data'] = false;
				$data['payment_data'] = false;
			}
	
	
			return view('Admin Views/AllOrders', $data);
		
	}



	// method of getting ordered items
	public function getOrderedItems(){

		$oid = $this->request->getVar('order-id');

		// getting orders
		$order_db = new OrderModel();
		$order_data = $order_db->where('id', $oid)->find();

		// getting all categories
		$cat_db = new CategoryManagementModel();
		$cats = $cat_db->findAll();

		$data['category_data'] = $cats;

		if(count($order_data) != 0 || $order_data != null){
			$product_db = new ProductManagementModel();
			$product_ids = explode(',' ,$order_data[0]['product_ids']);
			$product_qtys = explode(',' ,$order_data[0]['product_qtys']);
			$product_prices = explode(',' ,$order_data[0]['product_prices']);

			$products = [];

			// getting product data
			for($i=0; $i<count($product_ids); $i++){
				$product = $product_db->where('id', $product_ids[$i])->find();
				$products[$i] = $product[0];
			}

			$data['product_data'] = $products;
			$data['ordered_price'] = $product_prices;
			$data['ordered_qty'] = $product_qtys;
		}

		else{
			$data = false;
		}

		// var_dump($data);
		// die();

		return view("Admin Views/OrderedItemsList",$data);


	}


	// getting new orders (just-placed)
	public function getNewOrders(){

		$order_db = new OrderModel();
		$payment_db = new PaymentModel();

		// getting all orders
		$order_data = $order_db->where('order_status', '1')->orderBy('id', 'DESC')->findAll();
		$payment_data = $payment_db->orderBy('id', 'DESC')->findAll();
		
		
		if(count($order_data) != 0 || $order_data != null){
			$data['order_data'] = $order_data;
			$data['payment_data'] = $payment_data;
		}

		else{
			$data['order_data'] = false;
			$data['payment_data'] = false;
		}


		return view('Admin Views/NewOrders', $data);

	}

	public function changeStatustoProcessing(){

		$order_db = new OrderModel();

		$oid = $this->request->getVar('order-id');
		
		if($order_db->where('id', $oid)->set(['order_status'=>'2'])->update()){

			setAlert(['type'=>'success', 'desc'=>'Status changed to Processing successfully.']);
			return redirect()->to(site_url('/site-management/new-orders/'));
			
		}

		else{
			setAlert(['type'=>'failed', 'desc'=>'Unable to update status!']);
			return redirect()->to(site_url('/site-management/new-orders/'));
		}

	}


	// getting pending orders which are not just-palaced
	public function getPendingOrders(){
		
		$order_db = new OrderModel();
		$payment_db = new PaymentModel();

		// getting all orders
		$order_data = $order_db->where("order_status != '1' AND order_status != '0' AND order_status != '4'")->orderBy('id', 'DESC')->findAll();
		$payment_data = $payment_db->orderBy('id', 'DESC')->findAll();
		
		
		if(count($order_data) != 0 || $order_data != null){
			$data['order_data'] = $order_data;
			$data['payment_data'] = $payment_data;
		}

		else{
			$data['order_data'] = false;
			$data['payment_data'] = false;
		}


		return view('Admin Views/PendingOrders', $data);

	}
	

	// changing order status to different states
	public function changeOrderStatus(){

		$oid = $this->request->getVar('order-id');
		$status = $this->request->getVar('order-status');

		$order_db = new OrderModel();

		if($status == -1){
			setAlert(['type'=>'failed', 'desc'=>'Please specify a status!']);
			return redirect()->to(site_url('/site-management/pending-orders/'));
		}

		if($order_db->where('id', $oid)->set(['order_status' => $status])->update()){

			setAlert(['type'=>'success', 'desc'=>'Status changed successfully.']);
				return redirect()->to(site_url('/site-management/pending-orders/'));
		}

		else{
				setAlert(['type'=>'failed', 'desc'=>'Unable to change status!']);
				return redirect()->to(site_url('/site-management/pending-orders/'));
		}

		
	}


	// end of this class
}
