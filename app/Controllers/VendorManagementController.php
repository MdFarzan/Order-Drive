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

		else{
			$data = array('cred_data' => false,
							'profile_data' => false);
		}
		
	

		return view('/Admin Views/AllVendors', $data);
		

	}

	// functionality for add vendor
	public function vendorCreation()
	{
		
		if($this->request->getMethod() == 'post'){

			//loading user helper
			helper('UserManagement');

        	//when method is post then
        
            

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

	// edit vendor functionality
	public function editVendor(){

		$cred_db = new VendorCredentialModel();
		$profile_db = new VendorProfileModel();
		$id = $this->request->getVar('id');
		// var_dump($id);
		// die();
		if($this->request->getMethod() == 'post'){


			$cred_data = array(
				'email'=>$this->request->getVar('email'),
				'active_status'=>$this->request->getVar('active-status')=='on'?true:false
			);

			$profile_data = array(
				'name'=>$this->request->getVar('full-name'),
				'contact_no'=>$this->request->getVar('mobile-no'),
				'primary_address'=>$this->request->getVar('primary-address'),
				'secondary_address'=>$this->request->getVar('secondary-address')?$this->request->getVar('secondary-address'):null
			);
			
			if(!empty(trim($this->request->getVar('passkey')))){
				$passkey = $this->request->getVar('passkey');
				$passkey = password_hash($passkey, PASSWORD_DEFAULT);
				$cred_data['passkey'] = $passkey;
			}
			
			
			//start transaction
			$cred_db->transBegin();
			$profile_db->transBegin();

			$cred_db->update($id, $cred_data);
			$profile_db->where(['vendor_id' => $id])->set($profile_data)->update();

			if($cred_db->transStatus() === FALSE || $profile_db->transStatus() === FALSE){
				$cred_db->transRollback();
				$profile_db->transRollback();
				setAlert(['type'=>'danger', 'desc'=>'Unable to update Vendor!']);
				return redirect()->to(site_url('site-management/all-vendor/'));
			}

			else{
				$cred_db->transCommit();
				$profile_db->transCommit();
				setAlert(['type'=>'success', 'desc'=>'Vendor updated successfully.']);
				return redirect()->to(site_url('site-management/all-vendor/'));
			}
			// end transaction
			

			
		}


		// when method is get
		else{
			$data =['cred_data' => $cred_db->where(['id' => $id])->find()[0],
					'profile_data' => $profile_db->where(['vendor_id' => $id])->find()[0]
			];

			return view('/Admin Views/VendorModification', $data);
		}

	}

	// delete vendor functionality 
	public function deleteVendor(){
		if($this->request->getMethod() == 'post'){

			$id = $this->request->getVar('id');
			$cred_db = new VendorCredentialModel();
			$profile_db = new VendorProfileModel();

			//start transaction
			$cred_db->transBegin();
			$profile_db->transBegin();

			$profile_db->where(['vendor_id'=> $id])->delete();
			$cred_db->where(['id'=>$id])->delete();

			if($cred_db->transStatus() === FALSE || $profile_db->transStatus() === FALSE){
				$cred_db->transRollback();
				$profile_db->transRollback();
				setAlert(['type'=>'danger', 'desc'=>'Unable to delete Vendor!']);
				return redirect()->to(site_url('site-management/all-vendor/'));
			}

			else{
				$cred_db->transCommit();
				$profile_db->transCommit();
				setAlert(['type'=>'success', 'desc'=>'Vendor deleted successfully.']);
				return redirect()->to(site_url('site-management/all-vendor/'));
			}
			// end transaction
			
		}
	}



}
