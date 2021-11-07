<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VendorCredentialModel;
use App\Models\VendorProfileModel;
use App\Models\OrderModel;

class VendorauthController extends BaseController
{	
	// function for sign in vendor
	public function index(){

		if($this->request->getMethod() == 'post'){

			$v_mail = $this->request->getVar('user-mail');
			$v_passkey = $this->request->getVar('user-passkey');
			$remember = $this->request->getVar('remember-me');

			$cred_db = new VendorCredentialModel();
			$profile_db = new VendorProfileModel();

			$cred_db->where('email', $v_mail);
			$cred_data = $cred_db->find();
			
			// if email matched
			if($cred_data != null){
				$cred_data = $cred_data[0];
				$db_passkey = $cred_data['passkey'];
				$id = $cred_data['id'];

				// verifying password
				if(password_verify($v_passkey, $db_passkey)){

					// checking is suspended
					if($cred_data['active_status'] == !true){
						setFlashError('vendor',['title'=>'Suspended',
							'msg'=> ' Please contact from Super Admin.']);
						return redirect()->to(site_url());
					}


					$profile_db->where('vendor_id', $id);
					$profile_data = $profile_db->find();
					$profile_data = $profile_data[0];

					// setting session 
					setSession(['vendor_credentials'=>$cred_data, 'vendor_profile'=>$profile_data]);
					
					
					return redirect()->to('vendor/dashboard');
					
					
				}

				// when passkey doesn't match
				else{

					setFlashError('vendor',['title'=>'Error!',
								'msg'=> ' Please check entered password']);
					return redirect()->to(site_url());

				}
					



			}

			// if email not matched
			else{

				setFlashError('vendor',['title'=>'Email not found!',
						'msg'=> ' Please enter correct email!']);
				return redirect()->to(site_url());

			}


		}

		// when method is get
		else{
			die("Please try again!");
		}

	}


	public function getVendorView(){

		if(checkSession('vendor_credentials')){
			
			$vendor_id = session()->get('vendor_credentials')['id'];
			

			$order_db = new OrderModel();
			$all_orders = count($order_db->where('vendor_id', $vendor_id)->findAll());
			$cancel_orders = count($order_db->where('order_status', '0')->where('vendor_id', $vendor_id)->findAll());
			$just_placed = count($order_db->where('order_status', '1')->where('vendor_id', $vendor_id)->findAll());
			$under_processing = count($order_db->where('order_status', '2')->where('vendor_id', $vendor_id)->findAll());
			$under_shipping = count($order_db->where('order_status', '3')->where('vendor_id', $vendor_id)->findAll());
			$delivered_orders = count($order_db->where('order_status', '4')->where('vendor_id', $vendor_id)->findAll());

			
			$data['all_orders'] = $all_orders;
			$data['cancel_orders'] = $cancel_orders;
			$data['just_placed'] = $just_placed;
			$data['under_processing'] = $under_processing;
			$data['under_shipping'] = $under_shipping;
			$data['delivered_orders'] = $delivered_orders;
			
			
			// die();
			
			return view('Vendor Views/Dashboard', $data);
			
		  }
		
		  else{
			
			return redirect()->to(site_url());
		  }

		
	}


}
