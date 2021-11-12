<?php
namespace App\Controllers;
use App\Models\OrderModel;

class SiteManagement extends BaseController{
    function index(){
        if((checkSession('credentials')==false && checkSession('privileges')==false)){
            return redirect()->to(site_url());
        }

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

        return view('Admin Views/Dashboard', $data);
    }

    

    //logout functionality
    function signout(){
        //destroying session
        session()->destroy();

        //clearing cookies
        foreach($_COOKIE as $name => $val)
            setcookie($name,$val,'/',1);
        
        //redirecting to home page
        return redirect()->to(site_url());
    }
}