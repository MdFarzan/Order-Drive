<?php

//for getting session
if(!function_exists('checkSession')){
    
    function checkSession($key){
        $sess = \Config\Services::session();
        if($sess->get($key))
            return $sess->get($key);
        
        else
            return false;
        
    }
}

//for setting session
if(!function_exists('setSession')){
    function setSession($s_data){
        $sess = \Config\Services::session();
            foreach($s_data as $key => $val){
                $sess->set($key,$val);
            }

    }

    
}
