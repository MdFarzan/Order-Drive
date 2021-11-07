<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\PaymentModel;

class OrderDetailController extends BaseController
{	
	// getting all order in decending order
	public function index()
	{

		// getting all orders of currently logged in vendor
		$vendor_id = session()->get('vendor_credentials')['id'];

		$order_db = new OrderModel();
		$payment_db = new PaymentModel();

		// getting all orders
		$order_data = $order_db->where('vendor_id', $vendor_id)->findAll();
		$payment_data = $payment_db->where('vendor_id', $vendor_id)->orderBy('id', 'DESC')->findAll();
		
		
		if(count($order_data) != 0 || $order_data != null){
			$data['order_data'] = $order_data;
			$data['payment_data'] = $payment_data;
		}

		else{
			$data['order_data'] = false;
			$data['payment_data'] = false;
		}


		return view('Vendor Views/AllOrders', $data);


		
	}







	// end of this class
}
