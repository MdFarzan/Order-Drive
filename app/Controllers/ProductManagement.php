<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductManagementModel;
use App\Models\GalleryManagementModel;
use App\Models\CategoryManagementModel;
class ProductManagement extends BaseController
{
	public function index()
	{
		//
	}
	
	public function addProduct(){

		$product_db = new ProductManagementModel();
		$gallery_db = new GalleryManagementModel();

		if($this->request->getMethod() == 'post'){

			var_dump($this->request->getVar());
			echo "<hr>";
			var_dump($this->request->getFile('feature-image')->store());
			echo "<hr>";
			$gallery_imgs = $this->request->getFileMultiple('gallery-images');
			// var_dump($gallery_imgs);

			// foreach($gallery_imgs as $gal)
			// 	var_dump($gal->path);


			foreach($gallery_imgs as $file){   
 
				
				var_dump($file->move(PRODUCT_GALLERY_IMGS_PATH));
              
 
			 }

			 
			

		}

		else{

			$category_db = new CategoryManagementModel();
			$category_data = $category_db->findAll();
			
			if($category_data != NULL){
				$data['category_data'] = $category_data;
			}
			else{
				$data['category_data'] = false;
			}

			return view('Admin Views/ProductCreation', $data);
		}
	}
}
