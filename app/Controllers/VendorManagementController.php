<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\VendorCredentialModel;
use App\Models\VendorProfileModel;

class VendorManagementController extends BaseController
{
	// by default for sign in
	public function index()
	{	
		$cred_db = new VendorCredentialModel();
		$profile_db = new VendorProfileModel();
		

		if($profile_db->countAll()>0)
		$data = array('cred_data' => $cred_db->findAll(),
						'profile_data' => $profile_db->findAll()

		);

		else
		$data = false;
	

		return view('/Admin Views/AllVendors', $data);
		

	}

	// functionality for add vendor
	public function vendorCreation()
	{
		
		if($this->request->getMethod() == 'post'){

			//loading user helper
			helper('UserManagement');

        	//when method is post then
        
            // echo "<hr>";
            // var_dump($this->request->getVar());

			$passkey = $this->request->getVar('passkey');
			$passkey = password_hash($passkey, PASSWORD_DEFAULT);

            $cred = array(
			  'email'=>$this->request->getVar('email'),
			  'passkey'=>$passkey
            );

			$profile = array(
				'name'=>$this->request->getVar('full-name'),
				'contact_no'=>$this->request->getVar('mobile-no'),
				'primary_address'=>$this->request->getVar('primary-address'),
				'secondary_address'=>$this->request->getVar('secondary-address')?$this->request->getVar('secondary-address'):null
			);

			// var_dump($cred);
			// echo "<hr>";
			// var_dump($profile);
			
			create_user(new VendorCredentialModel(), new VendorProfileModel(), $cred, $profile, false);
			
			setAlert(['type'=>'success', 'desc'=>'Admin Created successfully.']);
			return redirect()->to(site_url('site-management/all-vendor/'));


        
		}

		// if request method is get
		else{

			return view('/Admin Views/VendorCreation');
		}

	}



}
