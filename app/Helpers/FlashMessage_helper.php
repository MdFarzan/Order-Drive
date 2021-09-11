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

// KEY name is set to 'keys' for all message types

//function for set flash messages
if(!function_exists('setAlert')){
    function setAlert($msg){

        //setting message
        session()->setFlashData('keys', $msg);
        

    }
}

//function for get flash message
if(!function_exists('getAlert')){
    function getAlert(){

        //checking is message exist
        if(session()->getFlashdata('keys')){

            //getting message type to define alert
            $type = session()->getFlashdata('keys')['type'];
            $title = '';
            switch($type){

                case 'success':
                    $type = 'alert-success';
                    $title = 'Success.';
                    break;
                case 'failed':
                    $type = 'alert-danger';
                    $title = 'Failed!';
                    break;
                case 'info':
                    $type = 'alert-info';
                    $title = 'Remember!';
                    break;

                default:
                    
            }
            
            $startTag = '<div class="alert '.$type.' alert-dismissible fade show" role="alert">';
            $alertTitleTag = '<strong>'.$title.'</strong>'.' '.session()->getFlashdata('keys')['desc'];    
            $dismissBtn = '<button type="button" class="close"
                             data-dismiss="alert" area-lable="close"><span aria-hidden="true">&times;</span></button>';
                             
            $endTag = '</div>';
            
            echo $startTag .$alertTitleTag .$dismissBtn .$endTag;

        }

    }
}