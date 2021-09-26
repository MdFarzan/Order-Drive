<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProductManagementModel;
use App\Models\GalleryManagementModel;
use App\Models\CategoryManagementModel;
class ProductManagement extends BaseController
{	
	// getting all products functionality

	public function index(){
	
		$product_db = new ProductManagementModel();
		$category_db = new CategoryManagementModel();
		$data = $product_db->findAll();
		$cat_data = $category_db->findAll();
		if($data){
			$data = ['product_data' => $data,
					'category_data' => $cat_data];
		}

		else{
			$data = ['product_data' => false,
					'category_data' => false];
		}

		// var_dump($data);

		return view('Admin Views/AllProducts', $data);

	}
	
	public function addProduct(){

		$product_db = new ProductManagementModel();
		$gallery_db = new GalleryManagementModel();

		if($this->request->getMethod() == 'post'){

			$file = $this->request->getFile('feature-image');
			$name = md5(rand());
			$ext = $file->getClientExtension();
			$file->move(PRODUCT_FEATURE_IMG_PATH, $name.'.'.$ext);
			if($file->hasMoved()){
				$img_path = PRODUCT_FEATURE_IMG_PATH.'/'.$name.'.'.$ext;
				
				$data = ['category_id' => $this->request->getVar('product-category'),
						'name' => $this->request->getVar('product-name'),
						'thumbnail_src' => $img_path,
						'price' => $this->request->getVar('product-price'),
						'short_desc' => $this->request->getVar('short-description'),
						'long_desc' => $this->request->getVar('long-description')
						];
				
				if($product_db->insert($data)){
					setAlert(['type'=>'success', 'desc'=>'Product added successfully.']);
					return redirect()->to(site_url('/site-management/all-products'));

				}
				
				else{
					setAlert(['type'=>'failed', 'desc'=>'Unable to add product!']);
					return redirect()->to(site_url('/site-management/add-product'));
				}

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
