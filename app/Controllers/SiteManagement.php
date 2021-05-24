<?php
namespace App\Controllers;

class SiteManagement extends BaseController{
    function index(){
        if((checkSession('credentials')==false && checkSession('privileges')==false)){
            return redirect()->to(site_url());
        }
        return view('Admin Views/Dashboard');
    }

    //admin creation
    function adminCreation(){
        
        //when method is post then
        if($this->request->getMethod()=='post'){
            echo "<hr>";
            var_dump($this->request->getVar());
        }

        return view('Admin Views/AdminCreation');
    }

    //logout functionality
    function signout(){
        //destroying session
        session()->destroy();

        //clearing cookies
        foreach($_COOKIE as $name => $val)
            setcookie($name,$val,'/',1);
        
        //redirecting to home page
        return redirect()->to(site_url());
    }
}