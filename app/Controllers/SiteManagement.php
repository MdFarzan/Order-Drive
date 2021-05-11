<?php
namespace App\Controllers;

class SiteManagement extends BaseController{
    function index(){
        return view('Master Layouts/Admin Layout/starter.php');
    }
}