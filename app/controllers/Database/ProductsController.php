<?php

class ProductsController extends \BaseController {
	
	public function w_insert()
	{
		$json = Input::get('json_data');
		$decode = json_decode($json);
		
		// $product_no = $decode->{'product_no'};
		$name = $decode->{'name'};
		$description = $decode->{'description'};
		$category_id = $decode->{'category_id'};
		$promotion_id = $decode->{'promotion_id'};
		// $deleted = $decode->{'deleted'};
		
		$input = array(
					// 'product_no' => $product_no,
					'name' => $name,
					'description' => $description,
					'category_id' => $category_id,
					'promotion_id' => $promotion_id,
					'deleted' => 0);
		
		return $this->insert($input);
	}
	public function insert($input)
	{
		// $input = json_decode(Input::all());
		
		$respond = array();
		//validate
		$validator = Validator::make($data = $input, Product::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}
		
		//save
		try {
			Product::create([
						'product_no' => '',
						'name' => $input['name'],
						'description' => $input['description'],
						'category_id' => $input['category_id'],
						'promotion_id' => $input['promotion_id'],
						'deleted' => 0
					]);
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}	
	
	// return array product :
			// id, product_no, name, description, category_id, promotion_id, deleted,			
			// category_name, promotion_amount, promotion_expired, 
			// prices {attr_name, price_with_tax, price_with_tax_promotion},
			// main_photo, other_photos		
	public function getAll()
	{
		$respond = array();
		$product = Product::all();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);		
	}
		
	// asumsi : 
		// kalo field input integer ada yang kosong maka -1
		// kalo field input string ada yang kosong maka dapetnya ""
	// input : id, product_no, name, category_name, promotion_id
	public function searchProduct($input)
	{			
		$respond = array();
		$product = Product::where('product_no', 'LIKE', '%'.$input['product_no'].'%')
							->where('name', 'LIKE', '%'.$input['name'].'%')->get();						
		if($input['category_name'] != "")
		{
			$category = Category::where('name', 'LIKE', '%'.$input['category_name'].'%')->get();
			$product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
		}		
		if($input['promotion_id'] != -1)
		{
			$product = $product->where('promotion_id', '=', $input['promotion_id'])->get();
		}		
		if($input['id'] != -1)
		{
			$product = $product->where('id', '=', $input['id'])->get();
		}
		
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);	
	}	
	
	public function searchProductSortedIdAsc($input)
	{			
		$respond = array();
		$product = Product::where('product_no', 'LIKE', '%'.$input['product_no'].'%')
							->where('name', 'LIKE', '%'.$input['name'].'%')->get();						
		if($input['category_name'] != "")
		{
			$category = Category::where('name', 'LIKE', '%'.$input['category_name'].'%')->get();
			$product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
		}		
		if($input['promotion_id'] != -1)
		{
			$product = $product->where('promotion_id', '=', $input['promotion_id'])->get();
		}		
		if($input['id'] != -1)
		{
			$product = $product->where('id', '=', $input['id'])->get();
		}
		
		//sorting
		$product = $product->orderBy('id')->get();
		
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);	
	}
	
	public function searchProductSortedIdDesc($input)
	{			
		$respond = array();
		$product = Product::where('product_no', 'LIKE', '%'.$input['product_no'].'%')
							->where('name', 'LIKE', '%'.$input['name'].'%')->get();						
		if($input['category_name'] != "")
		{
			$category = Category::where('name', 'LIKE', '%'.$input['category_name'].'%')->get();
			$product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
		}		
		if($input['promotion_id'] != -1)
		{
			$product = $product->where('promotion_id', '=', $input['promotion_id'])->get();
		}		
		if($input['id'] != -1)
		{
			$product = $product->where('id', '=', $input['id'])->get();
		}
		
		//sorting
		$product = $product->orderBy('id', 'desc')->get();
		
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);	
	}
	
	public function searchProductSortedProductNoAsc($input)
	{			
		$respond = array();
		$product = Product::where('product_no', 'LIKE', '%'.$input['product_no'].'%')
							->where('name', 'LIKE', '%'.$input['name'].'%')->get();						
		if($input['category_name'] != "")
		{
			$category = Category::where('name', 'LIKE', '%'.$input['category_name'].'%')->get();
			$product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
		}		
		if($input['promotion_id'] != -1)
		{
			$product = $product->where('promotion_id', '=', $input['promotion_id'])->get();
		}		
		if($input['id'] != -1)
		{
			$product = $product->where('id', '=', $input['id'])->get();
		}
		
		//sorting
		$product = $product->orderBy('product_no')->get();
		
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);	
	}
	
	public function searchProductSortedProductNoDesc($input)
	{			
		$respond = array();
		$product = Product::where('product_no', 'LIKE', '%'.$input['product_no'].'%')
							->where('name', 'LIKE', '%'.$input['name'].'%')->get();						
		if($input['category_name'] != "")
		{
			$category = Category::where('name', 'LIKE', '%'.$input['category_name'].'%')->get();
			$product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
		}		
		if($input['promotion_id'] != -1)
		{
			$product = $product->where('promotion_id', '=', $input['promotion_id'])->get();
		}		
		if($input['id'] != -1)
		{
			$product = $product->where('id', '=', $input['id'])->get();
		}
		
		//sorting
		$product = $product->orderBy('product_no', 'desc')->get();
		
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);	
	}
	
	public function searchProductSortedNameAsc($input)
	{			
		$respond = array();
		$product = Product::where('product_no', 'LIKE', '%'.$input['product_no'].'%')
							->where('name', 'LIKE', '%'.$input['name'].'%')->get();						
		if($input['category_name'] != "")
		{
			$category = Category::where('name', 'LIKE', '%'.$input['category_name'].'%')->get();
			$product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
		}		
		if($input['promotion_id'] != -1)
		{
			$product = $product->where('promotion_id', '=', $input['promotion_id'])->get();
		}		
		if($input['id'] != -1)
		{
			$product = $product->where('id', '=', $input['id'])->get();
		}
		
		//sorting
		$product = $product->orderBy('name')->get();
		
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);	
	}
	
	public function searchProductSortedNameDesc($input)
	{			
		$respond = array();
		$product = Product::where('product_no', 'LIKE', '%'.$input['product_no'].'%')
							->where('name', 'LIKE', '%'.$input['name'].'%')->get();						
		if($input['category_name'] != "")
		{
			$category = Category::where('name', 'LIKE', '%'.$input['category_name'].'%')->get();
			$product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
		}		
		if($input['promotion_id'] != -1)
		{
			$product = $product->where('promotion_id', '=', $input['promotion_id'])->get();
		}		
		if($input['id'] != -1)
		{
			$product = $product->where('id', '=', $input['id'])->get();
		}
		
		//sorting
		$product = $product->orderBy('name', 'desc')->get();
		
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);	
	}
	
	public function searchProductSortedCategoryNameAsc($input)
	{			
		$respond = array();
		$product = Product::where('product_no', 'LIKE', '%'.$input['product_no'].'%')
							->where('name', 'LIKE', '%'.$input['name'].'%')->get();						
		if($input['category_name'] != "")
		{
			$category = Category::where('name', 'LIKE', '%'.$input['category_name'].'%')->get();
			$product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
		}		
		if($input['promotion_id'] != -1)
		{
			$product = $product->where('promotion_id', '=', $input['promotion_id'])->get();
		}		
		if($input['id'] != -1)
		{
			$product = $product->where('id', '=', $input['id'])->get();
		}	
		
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}

			// sorting
			$product = $product->orderBy('category_name')->get();
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);	
	}
	
	public function searchProductSortedCategoryNameDesc($input)
	{			
		$respond = array();
		$product = Product::where('product_no', 'LIKE', '%'.$input['product_no'].'%')
							->where('name', 'LIKE', '%'.$input['name'].'%')->get();						
		if($input['category_name'] != "")
		{
			$category = Category::where('name', 'LIKE', '%'.$input['category_name'].'%')->get();
			$product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
		}		
		if($input['promotion_id'] != -1)
		{
			$product = $product->where('promotion_id', '=', $input['promotion_id'])->get();
		}		
		if($input['id'] != -1)
		{
			$product = $product->where('id', '=', $input['id'])->get();
		}	
		
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}

			// sorting
			$product = $product->orderBy('category_name', 'desc')->get();
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);	
	}
	
	public function searchProductSortedPromotionIdAsc($input)
	{			
		$respond = array();
		$product = Product::where('product_no', 'LIKE', '%'.$input['product_no'].'%')
							->where('name', 'LIKE', '%'.$input['name'].'%')->get();						
		if($input['category_name'] != "")
		{
			$category = Category::where('name', 'LIKE', '%'.$input['category_name'].'%')->get();
			$product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
		}		
		if($input['promotion_id'] != -1)
		{
			$product = $product->where('promotion_id', '=', $input['promotion_id'])->get();
		}		
		if($input['id'] != -1)
		{
			$product = $product->where('id', '=', $input['id'])->get();
		}
		
		//sorting
		$product = $product->orderBy('promotion_id')->get();
		
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);	
	}
	
	public function searchProductSortedPromotionIdDesc($input)
	{			
		$respond = array();
		$product = Product::where('product_no', 'LIKE', '%'.$input['product_no'].'%')
							->where('name', 'LIKE', '%'.$input['name'].'%')->get();						
		if($input['category_name'] != "")
		{
			$category = Category::where('name', 'LIKE', '%'.$input['category_name'].'%')->get();
			$product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
		}		
		if($input['promotion_id'] != -1)
		{
			$product = $product->where('promotion_id', '=', $input['promotion_id'])->get();
		}		
		if($input['id'] != -1)
		{
			$product = $product->where('id', '=', $input['id'])->get();
		}
		
		//sorting
		$product = $product->orderBy('promotion_id', 'desc')->get();
		
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);	
	}
	
	/*
	public function getAllSortedProductNoAsc()
	{
		$respond = array();
		$product = Product::orderBy('product_no')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);		
	}
	
	public function getAllSortedProductNoDesc()
	{
		$respond = array();
		$product = Product::orderBy('product_no', 'desc')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);		
	}
		
	public function getAllSortedNameAsc()
	{
		$respond = array();
		$product = Product::orderBy('name')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);		
	}
	
	public function getAllSortedNameDesc()
	{
		$respond = array();
		$product = Product::orderBy('name', 'desc')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);		
	}
	
	public function getById($id)
	{
		$respond = array();
		$product = Product::find($id);	
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	public function getByProductNo($product_no)
	{
		$respond = array();	
		$product = Product::where('product_no', 'LIKE','%'.$product_no.'%')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	public function getByName($name)
	{
		$respond = array();		
		$product = Product::where('name', 'LIKE','%'.$name.'%')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
		
	public function getByNameSortedNameAsc($name)
	{
		$respond = array();		
		$product = Product::where('name', 'LIKE','%'.$name.'%')->orderBy('name')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
		
	public function getByNameSortedNameDesc($name)
	{
		$respond = array();	
		$product = Product::where('name', 'LIKE','%'.$name.'%')->orderBy('name', 'desc')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
			
	public function getByCategoryId($category_id)
	{
		$respond = array();		
		$product = Product::where('category_id', '=', $category_id)->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	public function getByCategoryIdSortedProductNoAsc($category_id)
	{
		$respond = array();		
		$product = Product::where('category_id', '=', $category_id)->orderBy('product_no')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	public function getByCategoryIdSortedProductNoDesc($category_id)
	{
		$respond = array();		
		$product = Product::where('category_id', '=', $category_id)->orderBy('product_no', 'desc')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	public function getByCategoryIdSortedNameAsc($category_id)
	{
		$respond = array();		
		$product = Product::where('category_id', '=', $category_id)->orderBy('name')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	public function getByCategoryIdSortedNameDesc($category_id)
	{
		$respond = array();		
		$product = Product::where('category_id', '=', $category_id)->orderBy('name', 'desc')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	public function getByPromotionId($promotion_id)
	{
		$respond = array();		
		$product = Product::where('promotion_id', '=', $promotion_id)->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	public function getByPromotionIdSortedProductNoAsc($promotion_id)
	{
		$respond = array();		
		$product = Product::where('promotion_id', '=', $promotion_id)->orderBy('product_no')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	public function getByPromotionIdSortedProductNoDesc($promotion_id)
	{
		$respond = array();		
		$product = Product::where('promotion_id', '=', $promotion_id)->orderBy('product_no', 'desc')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}		
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	public function getByPromotionIdSortedNameAsc($promotion_id)
	{
		$respond = array();		
		$product = Product::where('promotion_id', '=', $promotion_id)->orderBy('name')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	public function getByPromotionIdSortedNameDesc($promotion_id)
	{
		$respond = array();		
		$product = Product::where('promotion_id', '=', $promotion_id)->orderBy('name', 'desc')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}		
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	*/
	
	public function getReviewProductById($id) 
	{
		$respond = array();
		$product = Product::find($id);	
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$reviews = Review::where('product_id','=',$product->id)->get();
					
			//add reviews 
			$product->reviews = $reviews;
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	public function getTopTenNewProduct()
	{
		$respond = array();
		$product = Product::orderBy('created_at', 'desc')->get();						
		$count = 0;
		$length = count($product);
		$result = array();
		if(count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			if($length < 10)
			{			
				while($count < $length)
				{	
					$cat_name = Category::where('id','=',$product[$count]->category_id)->first()->name;								
				
					//add category_name
					$product[$count]->category_name = $cat_name;
					
					if($product[$count]->promotion_id == null)
					{
						//no promotion
						$promo_amount = 0;
						$promo_expired = 0;						
					}	
					else
					{
						//promotion
						$promo_amount = Promotion::where('id','=',$product[$count]->promotion_id)->first()->amount;
						$promo_expired = Promotion::where('id','=',$product[$count]->promotion_id)->first()->expired;					
					}						

					//add promotion_amount, promotion_expired
					$product[$count]->promotion_amount = $promo_amount;
					$product[$count]->promotion_expired = $promo_expired;
					
					$prices = Price::where('product_id','=',$product[$count]->id)->get();
						
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
					$product[$count]->prices = $prices;
					
					$main_photo = Gallery::where('product_id','=',$product[$count]->id)->where('type','=','main_photo')->first();						
					$other_photos = Gallery::where('product_id','=',$product[$count]->id)->where('type','=','other_photos')->get();
					
					//add main_photo
					$product[$count]->main_photo = $main_photo->photo_path;
					
					//add other_photo
					$product[$count]->other_photos = $other_photos->photo_path;					
					
					$result[] = $product[$count];
					$count++;
				}
			}
			else
			{
				while($count < 10)
				{
					$cat_name = Category::where('id','=',$product[$count]->category_id)->first()->name;								
				
					//add category_name
					$product[$count]->category_name = $cat_name;
					
					if($product[$count]->promotion_id == null)
					{
						//no promotion
						$promo_amount = 0;
						$promo_expired = 0;						
					}	
					else
					{
						//promotion
						$promo_amount = Promotion::where('id','=',$product[$count]->promotion_id)->first()->amount;
						$promo_expired = Promotion::where('id','=',$product[$count]->promotion_id)->first()->expired;					
					}						

					//add promotion_amount, promotion_expired
					$product[$count]->promotion_amount = $promo_amount;
					$product[$count]->promotion_expired = $promo_expired;
					
					$prices = Price::where('product_id','=',$product[$count]->id)->get();
						
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
					$product[$count]->prices = $prices;
					
					$main_photo = Gallery::where('product_id','=',$product[$count]->id)->where('type','=','main_photo')->first();						
					$other_photos = Gallery::where('product_id','=',$product[$count]->id)->where('type','=','other_photos')->get();
					
					//add main_photo
					$product[$count]->main_photo = $main_photo->photo_path;
					
					//add other_photo
					$product[$count]->other_photos = $other_photos->photo_path;
					
					$result[] = $product[$count];
					$count++;
				}
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$result);
		}
							
		return Response::json($respond);
	}
	
	public function getByDeleted($deleted)
	{
		$respond = array();		
		$product = Product::where('deleted', '=', $deleted)->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)		
			{				
				$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
				
				//add category_name
				$key->category_name = $cat_name;
				
				if($key->promotion_id == null)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = 0;						
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
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
				$key->prices = $prices;
				
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$key->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photo
				$key->other_photos = $other_photos->photo_path;
			}		
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
		
	public function updateFull($id)
	{
		$respond = array();
		$product = Product::find($id);
		if ($product == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$input = json_decode(Input::all());
			
			//validate
			$validator = Validator::make($data = $input, Product::$rules);

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			//save
			try {
				$product->update($data);
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	public function delete($id)
	{
		$respond = array();
		$product = Product::find($id);
		if ($product == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$product->delete();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	public function exist($id)
	{
		$respond = array();
		$product = Product::find($id);
		if ($product == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK');
		}
		return Response::json($respond);
	}	

}
