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


	// edit product functionality
	public function editProduct(){

		$product_db = new ProductManagementModel();
		$gallery_db = new GalleryManagementModel();
		$category_db = new CategoryManagementModel();
		
		

		if($this->request->getMethod() == 'post'){
			$id = $this->request->getVar('id');
			$product_db->where('id', $id);
			if($this->request->getFile('feature-image') != ''){
				$file = $this->request->getFile('feature-image');
				$name = md5(rand());
				$ext = $file->getClientExtension();
				$file->move(PRODUCT_FEATURE_IMG_PATH, $name.'.'.$ext);
				if($file->hasMoved())
					$img_path = PRODUCT_FEATURE_IMG_PATH.'/'.$name.'.'.$ext;
				
				
			}
			else{
				$img_path = $this->request->getVar('feature-image-old');
			}

			$data = ['category_id' => $this->request->getVar('product-category'),
					'thumbnail_src' => $img_path,
					'name' => $this->request->getVar('product-name'),
					'price' => $this->request->getVar('product-price'),
					'short_desc' => $this->request->getVar('short-description'),
					'long_desc' => $this->request->getVar('long-description')

			];

			
			
			if($product_db->where(['id' => $id])->set($data)->update()){
					setAlert(['type'=>'success', 'desc'=>'Product updated successfully.']);
					return redirect()->to(site_url('/site-management/all-products'));
			}

			else{
					setAlert(['type'=>'failed', 'desc'=>'Unable to update product!']);
					return redirect()->to(site_url('/site-management/all-products'));
			}
			
		}

		else{

			$id = $this->request->getVar('id');
			$product_db->where('id', $id);
			$product_data = $product_db->find();
			$category_data = $category_db->findAll();
			$data = [];

			if($product_data){
				$data['product_data'] = $product_data[0];
				$data['category_data'] = $category_data;
			}

			else{
				$data['product_data'] = false;
				$data['category_data'] = false;
			}

			// var_dump($data);
			// die();
			return view('Admin Views/ProductModification', $data);
		}

		
	}

	// delete product functionality
	public function deleteProduct(){
		
		if($this->request->getMethod() == 'post'){

			$product_db = new ProductManagementModel();
			

			$id = $this->request->getVar('id');
				if($product_db->where('id', $id)->delete()){
					setAlert(['type'=>'success', 'desc'=>'Product deleted successfully.']);
					return redirect()->to(site_url('/site-management/all-products'));
				}

				else{
					setAlert(['type'=>'failed', 'desc'=>'Unable to delete product!']);
					return redirect()->to(site_url('/site-management/all-products'));
				}
			
		}

		else{
			die("You can't directly access this page");
		}
		
	}
}
