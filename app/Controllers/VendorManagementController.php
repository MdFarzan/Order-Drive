<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class VendorManagementController extends BaseController
{
	public function index()
	{
		
		if($this->request->getMethod() == 'post'){

		}

		// if request method is get
		else{

			return view('/Admin Views/VendorCreation');
		}

	}
}
