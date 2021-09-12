<?php

//function for admin and vendor creation creation
if(!function_exists('create_user')){
    function create_user($db_credential, $db_privileges=null,$cred_data, $priv_data=null, $is_admin=true){
        
        //if admin is activated
        if($is_admin){

            //starting transaction
            $db_credential->transBegin();
            $db_privileges->transBegin();

            //inserting data
            $id = $db_credential->insert($cred_data);
            $priv_data['admin_id'] = $id;
            $db_privileges->insert($priv_data);

            //if transaction is not successfull
            if($db_credential->transStatus() == FALSE || $db_privileges->transStatus() == FALSE){
            $db_credential->transRollback();
            $db_privileges->transRollback();

            setAlert(['type'=>'failed', 'desc'=>'Unable to create admin!']);
			return redirect()->to(site_url('site-management/add-admin/'));

            }

            //if transaction is successfull
            else{
                $db_credential->transCommit();
                $db_privileges->transCommit();

                setAlert(['type'=>'success', 'desc'=>'Admin Created successfully.']);
			    return redirect()->to(site_url('site-management/all-admin/'));
            }

            

        }

        //if admin is not activated, so it's absolutely vendor
        else{

            $db_cred = $db_credential;
            $db_profile = $db_privileges;
            $profile_data = $priv_data;
            
            // var_dump($cred_data);
            // echo "<hr>";
            // var_dump($profile_data);
            // $id = $db_cred->insert($cred_data);
            

            //starting transaction
            $db_cred->transBegin();
            $db_profile->transBegin();
            
            //inserting data
            $id = $db_cred->insert($cred_data);
            $profile_data['vendor_id'] = $id;
            $db_profile->insert($profile_data);
            
            
            //if transaction is not successfull
            if($db_cred->transStatus() == FALSE || $db_profile->transStatus() == FALSE){
            $db_cred->transRollback();
            $db_profile->transRollback();
            
            setAlert(['type'=>'failed', 'desc'=>'Unable to create Vendor!']);
			return redirect()->to(site_url('site-management/add-vendor/'));

            }

            //if transaction is successfull
            else{
                
                $db_cred->transCommit();
                $db_profile->transCommit();
                
                setAlert(['type'=>'success', 'desc'=>'Vendor Created successfully.']);
                return redirect()->to(site_url('site-management/all-admin/'));
			    
                
            }

            

        }

    }

}