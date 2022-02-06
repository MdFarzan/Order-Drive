<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryManagementModel;

class CategoryManagement extends BaseController
{
	//category displaying functionality
	public function index(){
		$category_db = new CategoryManagementModel();

		//checking if has data
		
		if($category_db->countAll()>0){
			$category_db->where('p_id', 0);
			$data = $category_db->findAll();
			$data = ['category_data' => $data];
		}

		else{
			$data = ['category_data' => false];
		}
		
		

		return view('Admin Views/AllCategories', $data);
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

	// edit category functionality
	public function editCategory(){
		helper('Slugify');
		$id = $this->request->getVar('id');
		$category_db = new CategoryManagementModel();

		if($this->request->getMethod() == 'post'){

			$updated_data = [
				'name' => $this->request->getVar('category-name'),
				'p_id' => $this->request->getVar('parent-category'),
				'slug' => slugify($this->request->getVar('category-slug'))
				];
			
			if($category_db->where(['id' => $id])->set($updated_data)->update()){
				setAlert(['type'=>'success', 'desc'=>'Category updated successfully.']);
				return redirect()->to(site_url('/site-management/all-categories'));
			}	

			else{
				setAlert(['type'=>'failed', 'desc'=>'Unable to update category!']);
				return redirect()->to(site_url('/site-management/all-categories'));
			}
		}

		else{

			$category_data = $category_db->where(['id' => $id])->find();
			$parent_category_data = $category_db->where('id !=', $id)->findAll();
			//getting child categories of selected category
			$child_categories = $category_db->where('p_id', $id)->findAll();

			$data = [];

			// checking selected category if 0
			if($category_data != NULL){
				$data['category'] = $category_data[0];
			}
			else{
				$data['category'] = false;
			}

			// checking parent category if 0
			if($parent_category_data != NULL){
				$data['parent_category'] = $parent_category_data;
			}
			else{
				$data['parent_category'] = false;
			}

			// checking if selected category has parent category
			if($child_categories != NULL)
				$data['child_categories'] = $child_categories;
			
			else{
				$data['child_categories'] = false;
			}
				
																																																																																																																																																																																																																																																							
			return view('Admin Views/CategoryModification', $data);
		}

	}

	// delete category functionality
	public function deleteCategory(){
		if($this->request->getMethod() == 'post'){
			
			$category_db = new CategoryManagementModel();
			$id = $this->request->getVar('id');
			$category_db->where('id', $id);
			$category_db->delete();
			$category_db->where('p_id', $id);
			$category_db->delete();
			setAlert(['type'=>'success', 'desc'=>'Category deleted successfully.']);
			return redirect()->to(site_url('/site-management/all-categories'));
		}
	}

}
