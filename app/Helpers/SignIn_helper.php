<?php

use App\Models\AdminPrivilegesModel;
//method for sign in 
if(!function_exists('signIn')){
    function signIn($db, $u_email, $u_passkey, $remember_token , $admin = false){
        try{
            //getting data using email
            $db->where('email',$u_email);
            $credential = $db->find();
             
            //data exist
            if($credential){
                $credential = $credential[0];
                $db_passkey = $credential['passkey'];

                //verifying password | if matched   
                if(password_verify($u_passkey, $db_passkey)){
                    
                    // checking is admin suspended
                    if($credential['active_status']==0)
                        return 3;

                    //checking remember token
                    if($remember_token == true){
                        
                        helper("cookie");
                        //generating cookie value
                        $cookie = hash('gost',rand());
                        set_cookie('OD_AU',$cookie,86400*30,$_SERVER['SERVER_NAME'],'/');
                        
                        //updating remember token in database
                        $token = ['remember_token' => $cookie];
                        $db->update($credential['id'], $token);

                    }
                    
                    //starting session for admin
                    if($admin == true){
                        $db2 = new AdminPrivilegesModel;
                        $db2->where('admin_id',$credential['id']);
                        $privileges = $db2->find();

                        //if data exists
                        if($privileges){
                            $privileges = $privileges[0];
                            //setting session
                            $s_credential = [
                                'id' =>$credential['id'],
                                'name'=>$credential['name'],
                                'email'=>$credential['email'],
                                'active_status'=>$credential['active_status']
                            ];
                            $s_privileges = [
                                'category_management'=>$privileges['category_management'],
                                'product_management'=>$privileges['product_management'],
                                'vendor_management'=>$privileges['vendor_management'],
                                'admins_management'=>$privileges['admins_management'],
                                'order_management'=>$privileges['order_management'],
                                'report_management'=>$privileges['report_management']
                            ];

                            setSession(['credentials'=>$s_credential, 'privileges'=>$s_privileges]);
                            var_dump($_SESSION);
                            // die();
                        }

                    }

                    return 1;
                }

                //if not matched
                else{
                    return 0;
                }

            }
            
            // unable to matched email
            else{
                //email not matched
                return 2;
                
            }

            



        }

        catch(\Exception $exp){
            die($exp->getMessage());
        }
    }
}

