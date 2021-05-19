<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminAuthModel;

class AdminAuthController extends BaseController
{
	public function index()
	{	
		//creating object of model
		$db = new AdminAuthModel();
		helper('SignIn');

		//extracting data
		$data = $this->request->getVar();
		$email = $data['user-mail'];
		$passkey = $data['user-passkey'];
		$remember_token = isset($data['remember-me'])?true:false;
		// var_dump($email, $passkey, $remember_token);

		//calling function
		// if(SignIn($db, $email, $passkey, $remember_token, true)){
		// 	return redirect()->to('/site-management');
			
		// }

		// else{
		// 	// die('wrong password');
		// 	//setting error
		// }

		$signal = SignIn($db, $email, $passkey, $remember_token, true);
		switch($signal){
			case 0:
				setFlashError('admin',['title'=>'Error!',
								'msg'=> ' Please check entered password']);
					return redirect()->to(site_url());
				break;
			
			case 1:
				return redirect()->to('/site-management/dashboard');
				break;
			
			case 2:
			
			setFlashError('admin',['title'=>'Email not found!',
						'msg'=> ' Please enter correct email']);
				return redirect()->to(site_url());
				break;
		}

		
	}
}
