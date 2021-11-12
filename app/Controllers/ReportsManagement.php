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


	// getting revenue report

	public function getRevenueReport(){

		$order_db = new OrderModel();
		$payment_db = new PaymentModel();

		$data = [];
		// getting today's sale amount
		$order_data = $order_db->where('order_date', date('Y-m-d'))->findAll();

		if(count($order_data) != 0 || $order_data != Null){
			
			$total = 0;
				foreach($order_data as $order){
					$row = $payment_db->where('id', $order['id'])->find();
					$total += $row[0]['payble_amt'];
				}

				$data['today_revenue'] = $total;

		}

		else{
			$data['today_revenue'] = 0;
		}



		// getting last 7 days sale excluding today
		$s_date = date('Y-m-d', strtotime('-7 Days'));
		$e_date = date('Y-m-d', strtotime('Yesterday'));

		$order_data = $order_db->where("order_date BETWEEN '$s_date' AND '$e_date'")->findAll();

		if(count($order_data) != 0 || $order_data != Null){
			
			$total = 0;
				foreach($order_data as $order){
					$row = $payment_db->where('id', $order['id'])->find();
					$total += $row[0]['payble_amt'];
				}

				$data['l_seven_day'] = $total;

		}

		else{
			$data['l_seven_day'] = 0;
		}


		// getting last month sale
		$s_date = date('Y-m-d', strtotime('first day of this month'));
		$e_date = date('Y-m-d', strtotime('last day of this month'));

		$order_data = $order_db->where("order_date BETWEEN '$s_date' AND '$e_date'")->findAll();

		if(count($order_data) != 0 || $order_data != Null){
			
			$total = 0;
				foreach($order_data as $order){
					$row = $payment_db->where('id', $order['id'])->find();
					$total += $row[0]['payble_amt'];
				}

				$data['l_month'] = $total;

		}

		else{
			$data['l_month'] = 0;
		}

		
		// getting this year sale
		$s_date =  date('Y').'-01-01';
		$e_date = date('Y').'-12-31';

		$order_data = $order_db->where("order_date BETWEEN '$s_date' AND '$e_date'")->findAll();

		if(count($order_data) != 0 || $order_data != Null){
			
			$total = 0;
				foreach($order_data as $order){
					$row = $payment_db->where('id', $order['id'])->find();
					$total += $row[0]['payble_amt'];
				}

				$data['current_year_revenue'] = $total;

		}

		else{
			$data['current_year_revenue'] = 0;
		}


		// getting last year sale

		$s_date =  date('Y', strtotime('last year')).'-01-01';
		$e_date = date('Y', strtotime('last year')).'-12-31';

		$order_data = $order_db->where("order_date BETWEEN '$s_date' AND '$e_date'")->findAll();

		if(count($order_data) != 0 || $order_data != Null){
			
			$total = 0;
				foreach($order_data as $order){
					$row = $payment_db->where('id', $order['id'])->find();
					$total += $row[0]['payble_amt'];
				}

				$data['last_year_revenue'] = $total;

		}

		else{
			$data['last_year_revenue'] = 0;
		}



		return view('Admin Views/RevenueReport', $data);

	}

	// end of this class
}
