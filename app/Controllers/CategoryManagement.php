<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryManagementModel;

class CategoryManagement extends BaseController
{
	public function index()
	{
		//
	}

	// add category functionality
	public function addCategory(){

		$category_db = new CategoryManagementModel();

		if($this->request->getMethod() == 'post'){
			helper('Slugify');
			$data = [
				'name' => $this->request->getVar('category-name'),
				'slug' => slugify($this->request->getVar('category-slug')),
				'p_id' => $this->request->getVar('parent-category')

			];

			if($category_db->insert($data)){
				setAlert(['type'=>'success', 'desc'=>'Category created successfully.']);
				return redirect()->to(site_url('/site-management/all-categories'));
			}

			else{
				setAlert(['type'=>'failed', 'desc'=>'Unable to create category!']);
				return redirect()->to(site_url('/site-management/add-category'));
			}
		}

		// when method is get
		else{
			if($category_db->countAll()>0){
				$data = $category_db->findAll();	
				$data = ['category_data' => $data];

			}

			else{
				$data = ['category_data' => null];
			}
			
			

			
			return view('Admin Views/CategoryCreation', $data);
		}


	}
}
