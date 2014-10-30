<?php

class PromotionsManagementController extends \BaseController
{
	public function view_admin_promotion()
	{		
		$sortBy = Input::get('sortBy','none');
		$sortType = Input::get('order','none');
		$filtered = Input::get('filtered','0');			
		$promotionController = new PromotionsController();
		
		//get list product
		$productController = new ProductsController();		
		$json = json_decode($productController->getAll()->getContent());
		if($json->code == 200)
		{
			$list_product = $json->{'messages'};
		}
		else
		{
			$list_product = array();
		}
		
		if($filtered == '0')
		{					
			if($sortBy === "none")
			{
				$promotionsJson = $promotionController->getAll();
			}
			else
			{
				$promotionsJson = $promotionController->getAllSorted($sortBy, $sortType);
			}
			
			$json = json_decode($promotionsJson->getContent());
					
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
				$promotions = Paginator::make($articles, count($paginator), $perPage);
				$filtered = 0;
			}
			else
			{
				$page = null;
				$promotions = $json;
			}
			
			return View::make('pages.admin.promosi.manage_promosi', compact('promotions','sortBy','sortType','page','filtered','list_product'));
		}
		else
		{			
			$name = Input::get('name', '');
				if($name == '')
				{
					$name = '';
				}						
			$amount = Input::get('amount', -1);
				if($amount == '')				
				{
					$amount = -1;
				}
			if($sortBy === "none")
			{
				$promotionsJson = $promotionController->getFilteredPromotion($name, $amount);								
			}			
			else
			{
				$promotionsJson = $promotionController->getFilteredPromotionSorted($name, $amount, $sortBy, $sortType);				
			}						
		
			$json = json_decode($promotionsJson->getContent());
			
			if($json->{'code'} == "200")
			{
				$paginator = $json->{'messages'};
				$promotions = $paginator;
			}
			else
			{				
				$promotions = null;
			}
			return View::make('pages.admin.promosi.manage_promosi', compact('promotions','filtered','name','amount','sortBy','sortType','list_product'));									
		}			
	}
	
	public function view_detail_promotion($id)
	{
		$promotionController = new PromotionsController();
		$json = json_decode($promotionController->getById($id)->getContent());
		return json_encode($json);
	}
	
	public function addPromotion()
	{
		$json_data = Input::get('json_data');
		$json = json_decode($json_data);
		
		$name = $json->{'name'};
		$amount = $json->{'amount'};
			$temp_start_date = $json->{'start_date'};			
		$start_date = new DateTime($temp_start_date);		
			$temp_expired = $json->{'expired'};
		$expired = new DateTime($temp_expired);
		$active = $json->{'active'};
		$products = $json->{'products'};
		
		$input = array(
				'name' => $name,
				'amount' => $amount,
				'start_date' => $start_date,
				'expired' => $expired,
				'active' => $active,
				'products' => $products
		);
								
		$promotionController = new PromotionsController();
		$json = json_decode($promotionController->insert($input)->getContent());		
		return json_encode($json);		
	}
	
	public function editFull()
	{
		$json_data = Input::get('json_data');
		$json = json_decode($json_data);
				
		$id = $json->{'id'};		
		$name = $json->{'name'};
		$amount = $json->{'amount'};
			$temp_start_date = $json->{'start_date'};
		$start_date = new DateTime($temp_start_date);
			$temp_expired = $json->{'expired'};
		$expired = new DateTime($temp_expired);
		$active = $json->{'active'};
		$products = $json->{'products'};
		
		$input = array(				
				'name' => $name,
				'amount' => $amount,
				'start_date' => $start_date,
				'expired' => $expired,
				'active' => $active,
				'products' => $products
		);
		
		$promotionController = new PromotionsController();
		$json = json_decode($promotionController->updateFull($id, $input)->getContent());
		return json_encode($json);
	}
	
	public function deletePromotion()
	{
		$respond = array();
		$json_data = Input::get('json_data');
		$json = json_decode($json_data);
				
		$id = $json->{'id'};		
		
		$promotionController = new PromotionsController();
		$json = json_decode($promotionController->delete($id)->getContent());
		return json_encode($json);
	}
	
	public function getProductById()
	{				
		$respond = array();		
		
		$json_data = Input::get('json_data');				
		$json = json_decode($json_data);			
		
		$product = Product::find($json->{'id'});			
		
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$cat_name = Category::where('id','=',$product->category_id)->first()->name;								
							
			//add category_name
			$product->category_name = $cat_name;
			
			if($product->promotion_id == null) //if(product->promotion_id == -1)
			{
				//no promotion
				$promo_amount = 0;
				$promo_expired = 0;						
			}	
			else
			{
				//promotion
				$promo_amount = Promotion::where('id','=',$product->promotion_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$product->promotion_id)->first()->expired;					
			}						

			//add promotion_amount, promotion_expired
			$product->promotion_amount = $promo_amount;
			$product->promotion_expired = $promo_expired;
			
			$prices = Price::where('product_id','=',$product->id)->get();
				
				foreach($prices as $key_prices)
				{
					$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
					$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
					//add attribute name
					$key_prices->attr_name = $attr_name;										
					//add price with tax
					$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
					//add price with tax and promotion
					$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $promo_amount);
				}
			
			//add prices by attribute
			$product->prices = $prices;
			
			$main_photo = Gallery::where('product_id','=',$product->id)->where('type','=','main_photo')->first();						
			$other_photos = Gallery::where('product_id','=',$product->id)->where('type','=','other_photos')->get();
			
			//add main_photo
			if(count($main_photo) == 0)
			{
				$product->main_photo = "";
			}
			else
			{					
				$product->main_photo = $main_photo->photo_path;
			}
							
			//add other_photo
			if(count($other_photos) == 0)
			{
				$product->other_photos = "";
			}
			else
			{
				$temp = array();
				foreach($other_photos as $ct)
				{
					$temp[] = $ct->photo_path;
				}
				$product->other_photos = $temp;				
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}		
		return json_encode($respond);		
	}
	
	
}