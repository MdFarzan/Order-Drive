<?php

// to set or get flash messages
if(!function_exists('setFlashError')){

    function setFlashError($key, $msg, $admin=false){
        session()->setFlashdata($key, $msg);
    }

}

// to get or get flash messages
if(!function_exists('getFlashError')){

    function getFlashError($key){
        if(session()->getFlashdata($key))
            return session()->getFlashdata($key);
        
        
    }

}