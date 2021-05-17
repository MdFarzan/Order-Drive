<?php

namespace App\Controllers;

class Home extends BaseController
{
	// public function index()
	// {
	// 	return view('welcome_message');
	// }

	public function index(){
		if(!(checkSession('credentials')==false && checkSession('privileges')==false)){
            return redirect()->to('site-management/');
        }
		return view('index');
	}
}
