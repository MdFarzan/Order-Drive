<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\OrderModel;
use App\Models\PaymentModel;

class ReportsManagement extends BaseController
{
	public function index()
	{
		//
	}

	// getting sales report
	public function getSalesReport(){
		

		$order_db = new OrderModel();
			$all_orders = count($order_db->findAll());
			$cancel_orders = count($order_db->where('order_status', '0')->findAll());
			$just_placed = count($order_db->where('order_status', '1')->findAll());
			$under_processing = count($order_db->where('order_status', '2')->findAll());
			$under_shipping = count($order_db->where('order_status', '3')->findAll());
			$delivered_orders = count($order_db->where('order_status', '4')->findAll());

			
			$data['all_orders'] = $all_orders;
			$data['cancel_orders'] = $cancel_orders;
			$data['just_placed'] = $just_placed;
			$data['under_processing'] = $under_processing;
			$data['under_shipping'] = $under_shipping;
			$data['delivered_orders'] = $delivered_orders;


			return view('Admin Views/SalesReport', $data);
		

	}



	// end of this class
}
