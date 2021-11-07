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
}
