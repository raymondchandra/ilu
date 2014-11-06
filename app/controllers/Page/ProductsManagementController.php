<?php

class ProductsManagementController extends \BaseController
{
	public function view_admin_product()
	{
		$sortBy = Input::get('sortBy','none');
		$sortType = Input::get('order','none');
		$filtered = Input::get('filtered','0');			
		$productController = new ProductsController();
				
		//list attribute 
		$temp_list_attribute = $productController->getListAttribute();
		if($temp_list_attribute == null)
		{
			$list_attribute = null;
		}
		else
		{
			$list_attribute = $temp_list_attribute;
		}				
				
		//list category			
		$temp_list_category = $productController->getListCategory();
		if($temp_list_category == null)
		{
			$list_category = null;
		}
		else
		{
			$list_category = $temp_list_category;
		}				
		
		//list promotion
		$temp_list_promotion = $productController->getListPromotion();
		if($temp_list_promotion == null)
		{
			$list_promotion = null;
		}
		else
		{
			$list_promotion = $temp_list_promotion;
		}			
		
		if($filtered == '0')
		{					
			if($sortBy === "none")
			{
				$productsJson = $productController->getAll();
			}
			else
			{
				$productsJson = $productController->getAllSorted($sortBy, $sortType);
			}
			
			$json = json_decode($productsJson->getContent());
					
			if($json->{'code'} == "200")
			{
				$paginator = $json->{'messages'};
										
				$perPage = 5;   
				$page = Input::get('page', 1);
				if ($page > count($paginator) or $page < 1)
				{
					$page = 1; 
				}
				$offset = ($page * $perPage) - $perPage;
				$articles = array_slice($paginator,$offset,$perPage);
				$products = Paginator::make($articles, count($paginator), $perPage);
				$filtered = 0;
			}
			else
			{
				$page = null;
				$products = null;
			}
			
			return View::make('pages.admin.product.manage_product', compact('products','sortBy','sortType','page','filtered','list_attribute','list_category','list_promotion'));
		}
		else
		{
			$id = Input::get('id', -1);
				if($id == '')				
				{
					$id = -1;
				}
			$product_no = Input::get('product_no', '');
				if($product_no == '')
				{
					$product_no = '';
				}						
			$name = Input::get('name', '');
				if($name == '')
				{
					$name = '';
				}
			$category_name = Input::get('category_name', '');
				if($category_name == '')
				{
					$category_name = '';
				}
			$promotion_id = Input::get('promotion_id', -1);
				if($promotion_id == '')				
				{
					$promotion_id = -1;
				}	
			if($sortBy === "none")
			{
				$productsJson = $productController->getFilteredProduct($id, $product_no, $name, $category_name, $promotion_id);								
			}			
			else
			{
				$productsJson = $productController->getFilteredProductSorted($id, $product_no, $name, $category_name, $promotion_id, $sortBy, $sortType);				
			}						
		
			$json = json_decode($productsJson->getContent());
			
			if($json->{'code'} == "200")
			{
				$paginator = $json->{'messages'};
				$products = $paginator;
			}
			else
			{				
				$products = null;
			}
			return View::make('pages.admin.product.manage_product', compact('products','filtered','id','product_no','name','category_name','promotion_id','sortBy','sortType','list_attribute','list_category','list_promotion'));									
		}	
	}
	
	public function view_detail_product($id)
	{
		$productController = new ProductsController();
		$json = json_decode($productController->getById($id)->getContent());
		return json_encode($json);
	}
	
	/*
	public function view_detail_info($id)
	{
		$productController = new ProductsController();
		$json = json_decode($productController->getById($id)->getContent());
		return json_encode($json);
	}	
	public function view_detail_gallery($id)
	{
		$productController = new ProductsController();
		$json = json_decode($productController->getById($id)->getContent());
		return json_encode($json);
	}
	*/
	
	public function addProduct()
	{	
		
		//product
		$name = Input::get('name');				
		$product_no = Input::get('product_no');
		$description = Input::get('description');
		$category_id = Input::get('category_id');		
		$promotion_id = Input::get('promotion_id');
			if($promotion_id == -1)
			{
				$promotion_id = null;
			}
		$deleted = Input::get('deleted');
		$input_product = array(
			'product_no' => $product_no,
			'name' => $name,
			'description' => $description,
			'category_id' => $category_id,
			'promotion_id' => $promotion_id,
			'deleted' => $deleted
		);
		
			
		
		//main_photo	
		$main_photo = Input::file('main_photo');	
		
		
		
		//arr_other_photos				
		$arr_name_other_photos = Input::get('other_photos_name');						
		$temp_arr_other_photos = explode("," , $arr_name_other_photos);
		foreach($temp_arr_other_photos as $key){
			$arr_other_photos[] = Input::file($key);		
		}							
		if($main_photo == null){
			$main_photo = "";			
		}	
		if($arr_other_photos == null){
			$arr_other_photos = "";
		}
		$input_photo = array(
			'main_photo' => $main_photo,
			'other_photos' => $arr_other_photos
		);	
		
				
		//attribute and price
		$arr_attr_id = Input::get('arr_attr_id');
			$temp_arr_attr_id = explode(",", $arr_attr_id);
		$arr_attr_value = Input::get('arr_attr_value');
			$temp_arr_attr_value = explode(",", $arr_attr_value);
		$arr_price = Input::get('arr_price');
			$temp_arr_price = explode(",", $arr_price);
		$input_price = array(
			'arr_attr_id' => $temp_arr_attr_id,
			'arr_attr_value' => $temp_arr_attr_value,
			'arr_price' => $temp_arr_price
		);		
		
		$productController = new ProductsController();
		// $json = json_decode($productController->insert($input_product,$input_photo,$input_price)->getContent());
		
		$json = json_decode($productController->insert($input_product,$input_photo,$input_price)->getContent());
		return json_encode($json);				
		
		// return $productController->insert(null,null,$input_price);
	}
	
	public function editProductNo()
	{
		$json_data = Input::get('json_data');		
		$json = json_decode($json_data);
		
		$id = $json->{'id'};
		$new_product_no = $json->{'new_product_no'};
		
		$productController = new ProductsController();
		$json = json_decode($productController->updateProductNo($id, $new_product_no)->getContent());
		return json_encode($json);
	}
	
	public function editName()
	{
		$json_data = Input::get('json_data');		
		$json = json_decode($json_data);
		
		$id = $json->{'id'};
		$new_name = $json->{'new_name'};
		
		$productController = new ProductsController();
		$json = json_decode($productController->updateName($id, $new_name)->getContent());
		return json_encode($json);
	}
	
	public function editDescription()
	{
		$json_data = Input::get('json_data');		
		$json = json_decode($json_data);
		
		$id = $json->{'id'};
		$new_description = $json->{'new_description'};
		
		$productController = new ProductsController();
		$json = json_decode($productController->updateDescription($id, $new_description)->getContent());
		return json_encode($json);
	}
	
	public function editCategoryId()
	{
		$json_data = Input::get('json_data');		
		$json = json_decode($json_data);
		
		$id = $json->{'id'};
		$new_category_id = $json->{'new_category_id'};
		
		$productController = new ProductsController();
		$json = json_decode($productController->updateCategoryId($id, $new_category_id)->getContent());
		return json_encode($json);
	}
	
	public function editPromotionId()
	{
		$json_data = Input::get('json_data');		
		$json = json_decode($json_data);
		
		$id = $json->{'id'};
		$new_promotion_id = $json->{'new_promotion_id'};
		
		$productController = new ProductsController();
		$json = json_decode($productController->updatePromotionId($id, $new_promotion_id)->getContent());
		return json_encode($json);
	}
	
	public function editPrice()	
	{
		$json_data = Input::get('json_data');		
		$json = json_decode($json_data);
		
		$id = $json->{'id'};
		$new_attr_id = $json->{'new_attr_id'};
		$new_attr_value = $json->{'new_attr_value'};
		$new_price_value = $json->{'new_price_value'};
		
		$productController = new ProductsController();
		$json = json_decode($productController->updatePrice($id, $new_attr_id, $new_attr_value, $new_price_value)->getContent());
		return json_encode($json);
	}
	
	//info product, attibute, price
	// public function editInfo()
	// {
		// return null;
	// }
	
	//edit main_photo, other_photos
	public function editGallery()
	{
		//INPUT :
		//product_id
		// edit_main_photo ('' atau files)
		// edit_main_photo_id
		// arr (edit_temp_name_other_photos+edit_temp_idx_other_photos)
		// arr edit_other_photos_name
		// edit_arr_id
		// edit_arr_files
		// edit_arr_delete
		
		
		//main_photo
		$main_photo_id = Input::get('edit_main_photo_id'); //kirim
		
		$main_photo = Input::get('edit_main_photo');		
		if($main_photo == "isi") 
		{
			$files_main_photo = Input::file('edit_files_main_photo'); //kirim
		}
		else
		{
			$files_main_photo = "";
		}
		
		
		//arr photo edit id
		$edit_arr_other_photos_id = explode(",", Input::get('edit_arr_id'));	 //kirim									
		//arr photo edit	
		$edit_arr_name_other_photos = Input::get('edit_arr_files');						
		$edit_temp_arr_other_photos = explode("," , $edit_arr_name_other_photos);
		foreach($edit_temp_arr_other_photos as $key){
			$edit_arr_other_photos[] = Input::file($key);	//kirim		
		}
				
		
		
		//arr photo delete
		$delete_arr_other_photos = explode(",", Input::get('edit_arr_delete'));	 //kirim							
		
		
				
		//arr_other_photos	tambahan			
		$arr_name_other_photos = Input::get('edit_other_photos_name');				
		$temp_arr_other_photos = explode("," , $arr_name_other_photos);
		foreach($temp_arr_other_photos as $key){
			$arr_other_photos[] = Input::file($key);		//kirim
		}					
		// return $arr_other_photos;
		
		$temp_edit_arr_id = Input::get('edit_arr_id');				
		if($temp_edit_arr_id == '')
		{
			$edit_arr_id = "";	
		}
		else
		{
			$edit_arr_id = explode(",", $temp_edit_arr_id);								
		}				
		
		$temp_edit_arr_files = Input::get('edit_arr_files');
		$edit_arr_files = explode(",", $temp_edit_arr_files);				
		
		
		
		$product_id = Input::get('product_id');		
						
		$productController = new ProductsController();		
				
						
		$json = json_decode($productController->
					updateGallery(
						$main_photo,
						$main_photo_id, 
						$files_main_photo, 
						$edit_arr_other_photos_id, 
						$edit_arr_other_photos,
						$delete_arr_other_photos,
						$arr_other_photos,
						$edit_arr_id,
						$edit_arr_files,
						$product_id
					)->getContent());				
		return json_encode($json);				
				
		
		// return "main _photo ".$main_photo." - main photo id ".$main_photo_id. " - files main photo " .$files_main_photo;
		
		// return $edit_arr_files;
		 // - edit arr id " .$edit_arr_id." - edit arr files " .$edit_arr_files;
		
		// return $productController->test(null,$main_photo_id,$files_main_photo,$product_id);
				
		/*
		return $productController->
					updateGallery(
						null,	
						null, 
						null, 
						null, 
						null,
						null,
						$arr_other_photos,
						$edit_arr_id,
						$edit_arr_files,
						$product_id
					);
		*/		
	}
	
	public function deleteProduct()
	{
		$json_data = Input::get('json_data');
		$json = json_decode($json_data);
		
		$id = $json->{'id'};		
		$new_deleted = $json->{'deleted'};
		
		$productController = new ProductsController();
		$json = json_decode($productController->updateDeleted($id,$new_deleted)->getContent());
		return json_encode($json);
	}
		
}