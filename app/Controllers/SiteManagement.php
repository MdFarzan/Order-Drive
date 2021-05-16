<?php
namespace App\Controllers;

class SiteManagement extends BaseController{
    function index(){
        if((checkSession('credentials')==false && checkSession('privileges')==false)){
            return redirect()->to(site_url());
        }
        return view('Master Layouts/Admin Layout/starter.php');
    }
}