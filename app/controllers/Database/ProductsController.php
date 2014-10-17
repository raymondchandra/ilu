<?php

class ProductsController extends \BaseController {
	
	public function w_insert()
	{
		$json = Input::get('json_data');
		$decode = json_decode($json);
		
		$product_no = $decode->{'product_no'};
		$name = $decode->{'name'};
		$description = $decode->{'description'};
		$category_id = $decode->{'category_id'};
		$promotion_id = $decode->{'promotion_id'};				
		// $deleted = $decode->{'deleted'};
		
		//galleries
		$main_photo = $decode->{'main_photo'};
		$other_photos = $decode->{'other_photos'};	//array
		
		$input_product = array(
					'product_no' => $product_no,
					'name' => $name,
					'description' => $description,
					'category_id' => $category_id,
					'promotion_id' => $promotion_id,
					'deleted' => 0);
		$input_gallery = array(
					'main_photo' => $main_photo,
					'other_photos' => $other_photos);
		
		return $this->insert($input_product, $input_gallery);
	}
	// asumsi : 
		// bisa tambah product langsung tanpa harus ada foto
		// kalo main_photo atau other_photos kosong maka dapetnya ""
	// input_product : product_no, name, description, category_id, promotion_id, deleted,
	// input_gallery : main_photo, other_photos(array)
	public function insert($input_product, $input_gallery)
	{
		// $input = json_decode(Input::all());
		
		$respond = array();
		//validate
		$validator = Validator::make($data = $input_product, Product::$rules); 								

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}
		
		//save
		try {			
			$product = new Product();
			$product->product_no = $input_product['product_no'];
			$product->name = $input_product['name'];
			$product->description = $input_product['description'];
			$product->category_id = $input_product['category_id'];
			$product->promotion_id = $input_product['promotion_id'];
			$product->deleted = $input_product['deleted'];
			$product->save();						
			
			$main_photo = $input_gallery['main_photo']; //file
			$other_photos = $input_gallery['other_photos']; //array of file
			if($main_photo != "")
			{
				$file = Input::file($main_photo);				
				$destinationPath = "assets/file_upload/gallery/";
				$fileName = $file->getClientOriginalName();
				
				$new_main_photo = new Gallery();
				$new_main_photo->product_id = $product->id;				
				$new_main_photo->type = "main_photo";
				$new_main_photo->save();
				
				$new_main_photo_id = $new_main_photo->id;
				$destinationPath .= $new_main_photo_id;
				$destinationPath .= "/";
				if(!file_exists($destinationPath))
				{
					File::makeDirectory($destinationPath, $mode = 0777, true, true);
					$uploadSuccess = $file->move($destinationPath, $fileName);
					$new_main_photo->photo_path = $destinationPath.$fileName;
					$new_main_photo->save();
				}
				else
				{
					$uploadSuccess = $file->move($destinationPath, $fileName);
					$new_main_photo->photo_path = $destinationPath.$fileName;
					$new_main_photo->save();
				}
			}
			if($other_photos != "")
			{
				foreach($other_photos as $key)				
				{
					$file = Input::file($key);
					$destinationPath = "assets/file_upload/gallery/";
					$fileName = $file->getClientOriginalName();
					
					$new_other_photos = new Gallery();
					$new_other_photos->product_id = $product->id;					
					$new_other_photos->type = "other_photos";
					$new_other_photos->save();
					
					$new_other_photos_id = $new_other_photos->id;
					$destinationPath .= $new_other_photos_id;
					$destinationPath .= "/";
					if(!file_exists($destinationPath))
					{
						File::makeDirectory($destinationPath, $mode = 0777, true, true);
						$uploadSuccess = $file->move($destinationPath, $fileName);
						$new_other_photos->photo_path = $destinationPath.$fileName;
						$new_other_photos->save();
					}
					else
					{
						$uploadSuccess = $file->move($destinationPath, $fileName);
						$new_other_photos->photo_path = $destinationPath.$fileName;
						$new_other_photos->save();
					}
				}
			}			
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);		
	}
	
	public function getAllSortedIdAsc()
	{
		$respond = array();
		$product = Product::orderBy('id')->get();
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);		
	}
	
	public function getAllSortedIdDesc()
	{
		$respond = array();
		$product = Product::orderBy('id', 'desc')->get();
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);		
	}
	
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);		
	}
	
	public function getAllSortedCategoryNameAsc()
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
			}	

			//sorting
			$product = $product->orderBy('category_name')->get();
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);		
	}
	
	public function getAllSortedCategoryNameDesc()
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
			}	

			//sorting
			$product = $product->orderBy('category_name', 'desc')->get();
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);		
	}
	
	public function getAllSortedPromotionIdAsc()
	{
		$respond = array();
		$product = Product::orderBy('promotion_id')->get();
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);		
	}
	
	public function getAllSortedPromotionIdDesc()
	{
		$respond = array();
		$product = Product::orderBy('promotion_id', 'desc')->get();
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
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
			// $product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
			$product = $product->join($category, $product->category_id, '=', $category->id)->get();
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
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
			// $product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
			$product = $product->join($category, $product->category_id, '=', $category->id)->get();
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
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
			// $product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
			$product = $product->join($category, $product->category_id, '=', $category->id)->get();
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
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
			// $product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
			$product = $product->join($category, $product->category_id, '=', $category->id)->get();
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
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
			// $product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
			$product = $product->join($category, $product->category_id, '=', $category->id)->get();
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
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
			// $product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
			$product = $product->join($category, $product->category_id, '=', $category->id)->get();
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
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
			// $product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
			$product = $product->join($category, $product->category_id, '=', $category->id)->get();
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
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
			// $product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
			$product = $product->join($category, $product->category_id, '=', $category->id)->get();
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
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
			// $product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
			$product = $product->join($category, $product->category_id, '=', $category->id)->get();
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
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
			// $product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
			$product = $product->join($category, $product->category_id, '=', $category->id)->get();
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
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
			// $product = $product->join('categories', 'products.category_id', '=', 'categories.id')->get();
			$product = $product->join($category, $product->category_id, '=', $category->id)->get();
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
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
	
	/*
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
	*/
	
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
			}
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	//used for on keypressed typing product name
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
			}			
			
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
					if(count($main_photo) == 0)
					{
						$product[$count]->main_photo = "";
					}
					else
					{					
						$product[$count]->main_photo = $main_photo->photo_path;
					}
									
					//add other_photo
					if(count($other_photos) == 0)
					{
						$product[$count]->other_photos = "";
					}
					else
					{
						$product[$count]->other_photos = $other_photos->photo_path;
					}				
					
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
					if(count($main_photo) == 0)
					{
						$product[$count]->main_photo = "";
					}
					else
					{					
						$product[$count]->main_photo = $main_photo->photo_path;
					}
									
					//add other_photo
					if(count($other_photos) == 0)
					{
						$product[$count]->other_photos = "";
					}
					else
					{
						$product[$count]->other_photos = $other_photos->photo_path;
					}
					
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
				if(count($main_photo) == 0)
				{
					$key->main_photo = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
				}
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					$key->other_photos = $other_photos->photo_path;
				}
			}		
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
		
	public function updateProductNo($id, $new_product_no)
	{
		$respond = array();
		$product = Product::find($id);
		if ($product == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$product->product_no = $new_product_no;
			try {
				$product->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	public function updateName($id, $new_name)
	{
		$respond = array();
		$product = Product::find($id);
		if ($product == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$product->name = $new_name;
			try {
				$product->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	public function updateDescription($id, $new_description)
	{
		$respond = array();
		$product = Product::find($id);
		if ($product == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$product->description = $new_description;
			try {
				$product->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	public function updateCategoryId($id, $new_category_id)
	{
		$respond = array();
		$product = Product::find($id);
		if ($product == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$product->category_id = $new_category_id;
			try {
				$product->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	public function updatePromotionId($id, $new_promotion_id)
	{
		$respond = array();
		$product = Product::find($id);
		if ($product == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$product->promotion_id = $new_promotion_id;
			try {
				$product->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	public function updateDeleted($id, $new_deleted)
	{
		$respond = array();
		$product = Product::find($id);
		if ($product == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$product->deleted = $new_deleted;
			try {
				$product->save();
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
