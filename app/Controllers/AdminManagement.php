<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AdminAuthModel;
use App\Models\AdminPrivilegesModel;


class AdminManagement extends BaseController
{
	public function index()
	{
		
	}

	//admin creation
    function adminCreation(){
        
		//loading user helper
		helper('UserManagement');

        //when method is post then
        if($this->request->getMethod()=='post'){
            // echo "<hr>";
            // var_dump($this->request->getVar());

			$passkey = $this->request->getVar('passkey');
			$passkey = password_hash($passkey, PASSWORD_DEFAULT);

            $cred = array(
			  'name'=>$this->request->getVar('full-name'),
			  'email'=>$this->request->getVar('email'),
			  'passkey'=>$passkey
            );

			$priv = array(
				'category_management'=>$this->request->getVar('category-management')?true:false,
				'product_management'=>$this->request->getVar('product-management')?true:false,
				'vendor_management'=>$this->request->getVar('vendor-management')?true:false,
				'admins_management'=>$this->request->getVar('admin-management')?true:false,
				'order_management'=>$this->request->getVar('order-management')?true:false,
				'report_management'=>$this->request->getVar('report-management')?true:false
			);

			// var_dump($creden);
			// echo "<hr>";
			// var_dump($priv);

			create_user(new AdminAuthModel(), new AdminPrivilegesModel(), $cred, $priv, true);

        }

		
        return view('Admin Views/AdminCreation');
    }

	//getting all admins
	public function allAdmins(){

		$admin_db = new AdminAuthModel();
		
		
		if($admin_db->countAll()>0)
			$data = array('data' => $admin_db->findAll());

		else
			$data = false;
		

		return view('Admin Views/AllAdmins',$data);
	}
	
}
