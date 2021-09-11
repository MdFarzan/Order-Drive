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

			setAlert(['type'=>'success', 'desc'=>'Admin Created successfully.']);
			return redirect()->to(site_url('site-management/all-admin/'));


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

	//edit admin
	public function editAdmin(){

		$admin_db = new AdminAuthModel();
		$privileges_db = new AdminPrivilegesModel();

		if($this->request->getMethod() == 'post'){
			
			$id = $this->request->getVar('id');

			$info_data = ['name'=>$this->request->getVar('full-name'),
							'email'=>$this->request->getVar('email'),
							'active_status'=> $this->request->getVar('active-status') == 'on' ? 1: 0
						];
			
			// if password is defined then preparing it to send into db
			if(!empty(trim($this->request->getVar('new-password')))){
				$passkey = trim($this->request->getVar('new-password'));
				$info_data['passkey'] = password_hash($passkey, PASSWORD_DEFAULT);
				
			}

			$priv_data = ['product_management'=>$this->request->getVar('product-management')=='on' ? 1:0,
							'category_management'=>$this->request->getVar('category-management')=='on' ? 1:0,
							'vendor_management'=>$this->request->getVar('vendor-management')=='on' ? 1:0,
							'admins_management'=>$this->request->getVar('admin-management')=='on' ? 1:0,
							'order_management'=>$this->request->getVar('order-management')=='on' ? 1:0,
							'report_management'=>$this->request->getVar('report-management')=='on' ? 1:0
						];
				
			// echo "$id <br>";			
			// var_dump($info_data);

			// echo "<br>";
			// var_dump($priv_data);
			
			
			$admin_db->transBegin();
			$privileges_db->transBegin();
			$admin_db->update($id, $info_data);

			$privileges_db->where(['admin_id'=> $id])->set($priv_data)->update();
			// $privileges_db->update($priv_data);
			
			if ($admin_db->transStatus() === false || $privileges_db->transStatus() === false) {
				setAlert(['type'=>'failed', 'desc'=>'Unable to update admin!']);
				$admin_db->transRollback();
				$privileges_db->transRollback();
			} else {
				$admin_db->transCommit();
				$privileges_db->transCommit();
				setAlert(['type'=>'success', 'desc'=>'Updated successfully.']);
			}
			
			return redirect()->to(site_url('site-management/all-admin/'));
			
		}

		else{
			$id = $this->request->getVar('admin_id');

			//getting admin basic data
			$admin_db->where(['id'=>$id]);
			$b_data = $admin_db->find();
			// var_dump($b_data);

			//getting admin privileges data
			$privileges_db->where(['admin_id'=> $id]);
			$p_data = $privileges_db->find();
			// var_dump($p_data);
			$data = ['info'=> $b_data[0],
					'privileges'=>$p_data[0]];

			
			return view('Admin Views/AdminModification', $data);
			
		}	
		
		
	}

	// delete admin functionality
	public function deleteAdmin(){

		$admin_db = new AdminAuthModel();
		$privileges_db = new AdminPrivilegesModel();

		if($this->request->getMethod() == 'post'){
			$id = $this->request->getVar('admin_id');

			$admin_db->transBegin();
			$privileges_db->transBegin();
			

			$privileges_db->where(['admin_id'=> $id])->delete();
			$admin_db->where(['id'=>$id])->delete();
			// $privileges_db->update($priv_data);
			
			if ($admin_db->transStatus() === false || $privileges_db->transStatus() === false) {
				setAlert(['type'=>'failed', 'desc'=>'Unable to delete admin!']);
				$admin_db->transRollback();
				$privileges_db->transRollback();
			} else {
				$admin_db->transCommit();
				$privileges_db->transCommit();
				setAlert(['type'=>'success', 'desc'=>'Admin Deleted successfully.']);
				
			}
			return redirect()->to(site_url('site-management/all-admin/'));

		}


	}


	
}
