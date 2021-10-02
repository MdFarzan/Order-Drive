<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VendorCredentialModel;
use App\Models\VendorProfileModel;

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

					// setting session 
					setSession(['credentials'=>$cred_data, 'profile'=>$profile_data]);
					
					var_dump($_SESSION['profile']);
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
}
