<?php

class ProductsController extends \BaseController {
	
	/*
	public function view_main_product(){
		
		$product_json = $this->getAll();
		$paginator = json_decode($product_json->getContent())->{'messages'};
		$perPage = 5;   
		$page = Input::get('page', 1);
		if ($page > count($paginator) or $page < 1) { $page = 1; }
			$offset = ($page * $perPage) - $perPage;
		$articles = array_slice($paginator,$offset,$perPage);
		$datas = Paginator::make($articles, count($paginator), $perPage);
		//return $products;
		return View::make('pages.admin.product.manage_product',compact('datas'));
	}
	
	public function coba_sort(){
		$id=Input::get('id');
		$product_id=Input::get('product_id');
		$name=Input::get('name');
		$category=Input::get('category');
		$promotion=Input::get('promotion');
		$order=Input::get('sort');
		$ascdesc = Input::get('asc');
		
		$product = Product::where('product_no','LIKE', $product_id.'%')->where('name','LIKE', $name.'%')->orderBy($order,$ascdesc)->get();
		
		foreach($product as $key)
		{	
			$cat_name = Category::where('id','=',$key->category_id)->first()->name;								
			
			//add category_name
			$key->category_name = $cat_name;
			
			if($key->promotion_id == null) //if($key->promotion_id == -1)
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
		
		$product = $product->toArray();
		$perPage = 5;   
		$page = Input::get('page', 1);
		if ($page > count($product) or $page < 1) { $page = 1; }
		$offset = ($page * $perPage) - $perPage;
		$articles = array_slice($product,$offset,$perPage);
		$datas = Paginator::make($articles, count($product), $perPage);
		$datas->setBaseUrl('product');
		$datas->appends(array('sort' => $order));
		$datas->appends(array('no_product' => $product_id));
		$datas->appends(array('name_product' => $name));
		$links = $datas ->links();
		return json_encode(array( 'datas' => $datas->getCollection()->toArray(), 'links' =>(string)$links ));
	}
	
	public function view_detail_product($id){
		$json = json_decode($this->getById($id)->getContent());
		return json_encode($json);
	}
		
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
	
	//reverse array
	public function reverse($arr)
	{
		$lastIdx = count($arr)-1;
		$reserve = array();
		while($lastIdx >= 0)
		{
			$reverse[] = $arr[$lastIdx];
			$lastIdx--;
		}
		return $reverse;
	}
	*/
	
//----------------------------------------------------------------------------------------------
	
	// asumsi : 
		// bisa tambah product langsung tanpa harus ada foto
		// kalo main_photo atau other_photos kosong maka dapetnya ""
	// input_product : product_no, name, description, category_id, promotion_id, deleted,
	// input_gallery : main_photo, other_photos(array)
	public function insert($input_product,$input_photo,$input_price)
	{				
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
			
			$main_photo = $input_photo['main_photo'];						
			if($main_photo != "")
			{												
				$file = $main_photo;
				$destinationPath = "assets/file_upload/product/";
				$fileName = $file->getClientOriginalName();
				
				$new_main_photo = new Gallery();
				$new_main_photo->product_id = $product->id;				
				$new_main_photo->type = "main_photo";
				$new_main_photo->save();
				
				$new_main_photo_id = $product->id;
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
						
			$other_photos = $input_photo['other_photos'];
			if($other_photos != "")
			{
				foreach($other_photos as $key)				
				{					
					$file = $key;
					$destinationPath = "assets/file_upload/product/";
					$fileName = $file->getClientOriginalName();
					
					$new_other_photos = new Gallery();
					$new_other_photos->product_id = $product->id;					
					// $new_other_photos->product_id = 5;	//sementara
					$new_other_photos->type = "other_photos";
					$new_other_photos->save();
					
					$new_other_photos_id = $product->id;
					// $new_other_photos_id = 5; //sementara
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
						
			$length = count($input_price['arr_attr_id']);																		
			for($i=0; $i<$length; $i++)
			{
				$price = new Price();
				$price->attr_id = $input_price['arr_attr_id'][$i];
				$price->attr_value = $input_price['arr_attr_value'][$i];
				$price->product_id = $product->id;
				// $price->product_id = 5; //sementara
				$price->amount = $input_price['arr_price'][$i];
				$price->tax_id = 1; //default sementara
				$price->save();
			}								
								
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}			
	
	public function getAllProductName()
	{
		$respond = array();
		// $product = DB::table('products')->where('deleted','=',0)->lists('id','name');
		$product = Product::where('deleted','=',0)->get(array('id','name'));
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);						
	}
	
	// return array product :
			// id, product_no, name, description, category_id, promotion_id, deleted,			
			// category_name, promotion_amount, promotion_expired, promotion_name,
			// prices {attr_name, price_with_tax, price_with_tax_promotion},
			// main_photo, main_photo_id, other_photos(arr object)
	public function getAll()
	{
		$respond = array();
		$product = DB::table('products AS prod')
						->where('prod.deleted', '=', 0)									
						->join('categories AS cat', 'prod.category_id', '=', 'cat.id')						
						//->orderBy
						->get(array(
								'prod.id',
								'prod.product_no',
								'prod.name',
								'prod.description',
								'prod.category_id',
								'cat.name AS category_name',
								'prod.promotion_id',
								'prod.created_at',
								'prod.updated_at'));
		
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)
			{
				if($key->promotion_id == null) //if($key->promotion_id == -1)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = '';
					$promo_name = '';
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
					$promo_name = Promotion::where('id','=',$key->promotion_id)->first()->name;
				}			
				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				$key->promotion_name = $promo_name;
				
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
					$key->main_photo_id = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
					$key->main_photo_id = $main_photo->id;
				}								
					
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					// $temp = array();
					// foreach($other_photos as $ct)
					// {
						// $temp[] = $ct->photo_path;
					// }
					// $product->other_photos = $temp;
					$key->other_photos = $other_photos;
				}	
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);						
	}
		
	public function getAllSorted($by, $type)
	{
		$respond = array();
		$product = DB::table('products AS prod')
						->where('prod.deleted', '=', 0)									
						->join('categories AS cat', 'prod.category_id', '=', 'cat.id')						
						->orderBy($by, $type)
						->get(array(
								'prod.id',
								'prod.product_no',
								'prod.name',
								'prod.description',
								'prod.category_id',
								'cat.name AS category_name',
								'prod.promotion_id',
								'prod.created_at',
								'prod.updated_at'));
		
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)
			{
				if($key->promotion_id == null) //if($key->promotion_id == -1)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = '';	
					$promo_name = '';					
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
					$promo_name = Promotion::where('id','=',$key->promotion_id)->first()->name;
				}			
				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				$key->promotion_name = $promo_name;
				
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
					$key->main_photo_id = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
					$key->main_photo_id = $main_photo->id;
				}								
					
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					// $temp = array();
					// foreach($other_photos as $ct)
					// {
						// $temp[] = $ct->photo_path;
					// }
					// $product->other_photos = $temp;
					$key->other_photos = $other_photos;
				}	
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}	
	
	public function getFilteredProduct($id, $product_no, $name, $category_name, $promotion_id)
	{
		$respond = array();
		$product = DB::table('products AS prod')
						->where('prod.deleted', '=', 0)	
						->where('prod.name', 'LIKE', '%'.$product_no.'%')
						->where('prod.name', 'LIKE', '%'.$name.'%');
		if($id != -1)
		{
			$product = $product->where('prod.id', '=', $id);
		}
		if($promotion_id != -1)
		{
			$product = $product->where('prod.promotion_id', '=', $promotion_id);
		}		
		$product = $product->join('categories AS cat', 'prod.category_id', '=', 'cat.id')
						->where('cat.name', 'LIKE', '%'.$category_name.'%')						
						->get(array(
								'prod.id',
								'prod.product_no',
								'prod.name',
								'prod.description',
								'prod.category_id',
								'cat.name AS category_name',
								'prod.promotion_id',
								'prod.created_at',
								'prod.updated_at'));									
		
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)
			{
				if($key->promotion_id == null) //if($key->promotion_id == -1)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = '';
					$promo_name = '';					
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
					$promo_name = Promotion::where('id','=',$key->promotion_id)->first()->name;
				}			
				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				$key->promotion_name = $promo_name;
				
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
					$key->main_photo_id = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
					$key->main_photo_id = $main_photo->id;
				}								
					
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					// $temp = array();
					// foreach($other_photos as $ct)
					// {
						// $temp[] = $ct->photo_path;
					// }
					// $product->other_photos = $temp;
					$key->other_photos = $other_photos;
				}	
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	public function getFilteredProductSorted($id, $product_no, $name, $category_name, $promotion_id, $sortBy, $sortType)
	{
		$respond = array();
		$product = DB::table('products AS prod')
						->where('prod.deleted', '=', 0)	
						->where('prod.name', 'LIKE', '%'.$product_no.'%')
						->where('prod.name', 'LIKE', '%'.$name.'%');
		if($id != -1)
		{
			$product = $product->where('prod.id', '=', $id);
		}
		if($promotion_id != -1)
		{
			$product = $product->where('prod.promotion_id', '=', $promotion_id);
		}		
		$product = $product->join('categories AS cat', 'prod.category_id', '=', 'cat.id')
						->where('cat.name', 'LIKE', '%'.$category_name.'%')						
						->orderBy($sortBy, $sortType)
						->get(array(
								'prod.id',
								'prod.product_no',
								'prod.name',
								'prod.description',
								'prod.category_id',
								'cat.name AS category_name',
								'prod.promotion_id',
								'prod.created_at',
								'prod.updated_at'));									
		
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)
			{
				if($key->promotion_id == null) //if($key->promotion_id == -1)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = '';	
					$promo_name = '';
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
					$promo_name = Promotion::where('id','=',$key->promotion_id)->first()->name;
				}			
				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				$key->promotion_name = $promo_name;
				
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
					$key->main_photo_id = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
					$key->main_photo_id = $main_photo->id;
				}								
					
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					// $temp = array();
					// foreach($other_photos as $ct)
					// {
						// $temp[] = $ct->photo_path;
					// }
					// $product->other_photos = $temp;
					$key->other_photos = $other_photos;
				}	
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
			$category = Category::find($product->category_id);
			$product->category_name = $category->name;
			
			if($product->promotion_id == null) //if($product->promotion_id == -1)
			{
				//no promotion
				$promo_amount = 0;
				$promo_expired = '';
				$promo_name = '';
			}	
			else
			{
				//promotion
				$promo_amount = Promotion::where('id','=',$product->promotion_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$product->promotion_id)->first()->expired;
				$promo_name = Promotion::where('id','=',$product->promotion_id)->first()->name;
			}			
			//add promotion_amount, promotion_expired
			$product->promotion_amount = $promo_amount;
			$product->promotion_expired = $promo_expired;
			$product->promotion_name = $promo_name;
			
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
				$product->main_photo_id = "";
			}
			else
			{					
				$product->main_photo = $main_photo->photo_path;
				$product->main_photo_id = $main_photo->id;
			}
							
			//add other_photo
			if(count($other_photos) == 0)
			{
				$product->other_photos = "";
			}
			else
			{
				// $temp = array();
				// foreach($other_photos as $ct)
				// {
					// $temp[] = $ct->photo_path;
				// }
				// $product->other_photos = $temp;
				$product->other_photos = $other_photos;
			}			
			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	/*
	public function getByProductNo($product_no)
	{
		$respond = array();
		$product = Product::where('product_no', 'LIKE', '%'.$product_no.'%')->get();	
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
				
				if($key->promotion_id == null) //if($key->promotion_id == -1)
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
		$product = Product::where('name', 'LIKE', '%'.$name.'%')->get();	
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
				
				if($key->promotion_id == null) //if($key->promotion_id == -1)
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
	
	public function getByCategoryName($category_name)
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
				
				if($key->promotion_id == null) //if($key->promotion_id == -1)
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
			
			$result = array();
			//search by category_name
			if($category_name != "")
			{
				foreach($product as $key)
				{
					$pos = strpos($key->category_name, $category_name);
					if($pos !== false)
					{
						$result[] = $key;
					}
				}
			}
			else 
			{
				$result = $product;
			}
			
			if(count($result) == 0)
			{
				$respond = array('code'=>'404','status'=>'Not Found');
			}
			else
			{
				$respond = array('code'=>'200','status' => 'OK','messages'=>$result);
			}
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	*/
	
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
				
				if($key->promotion_id == null) //if($key->promotion_id == -1)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = '';		
					$promo_name = '';
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
					$promo_name = Promotion::where('id','=',$key->promotion_id)->first()->name;
				}						

				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				$key->promotion_name = $promo_name;
				
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
					$key->main_photo_id = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
					$key->main_photo_id = $main_photo->id;
				}								
					
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					// $temp = array();
					// foreach($other_photos as $ct)
					// {
						// $temp[] = $ct->photo_path;
					// }
					// $product->other_photos = $temp;
					$key->other_photos = $other_photos;
				}		
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	
	public function getTopTenNewProduct()
	{
		$respond = array();
		$product = DB::table('products AS prod')
						->where('prod.deleted', '=', 0)									
						->join('categories AS cat', 'prod.category_id', '=', 'cat.id')												
						->orderBy('created_at', 'desc')
						->take(10)
						->get(array(
								'prod.id',
								'prod.product_no',
								'prod.name',
								'prod.description',
								'prod.category_id',
								'cat.name AS category_name',
								'prod.promotion_id',
								'prod.created_at',
								'prod.updated_at'));
		
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)
			{
				if($key->promotion_id == null) //if($key->promotion_id == -1)
				{
					//no promotion
					$promo_amount = 0;
					$promo_expired = '';	
					$promo_name = '';
				}	
				else
				{
					//promotion
					$promo_amount = Promotion::where('id','=',$key->promotion_id)->first()->amount;
					$promo_expired = Promotion::where('id','=',$key->promotion_id)->first()->expired;					
					$promo_name = Promotion::where('id','=',$key->promotion_id)->first()->name;
				}			
				//add promotion_amount, promotion_expired
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;
				$key->promotion_name = $promo_name;
				
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
					$key->main_photo_id = "";
				}
				else
				{					
					$key->main_photo = $main_photo->photo_path;
					$key->main_photo_id = $main_photo->id;
				}								
					
								
				//add other_photo
				if(count($other_photos) == 0)
				{
					$key->other_photos = "";
				}
				else
				{
					// $temp = array();
					// foreach($other_photos as $ct)
					// {
						// $temp[] = $ct->photo_path;
					// }
					// $product->other_photos = $temp;
					$key->other_photos = $other_photos;
				}	
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}											
		return Response::json($respond);
	}
	
	// public function updateInfo()
	// {
		// return null;
	// }
	
	// public function updatePhoto()
	// {
		// return null;
	// }	
	
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
			if($new_promotion_id == -1)
			{
				$product->promotion_id = null;
			}
			else
			{			
				$product->promotion_id = $new_promotion_id;
			}
			try {
				$product->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	public function updatePrice($id, $new_attr_id, $new_attr_value, $new_price_value)
	{
		$respond = array();
		$price = Price::find($id);
		if ($price == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$price->attr_id = $new_attr_id;
			$price->attr_value = $new_attr_value;
			$price->amount = $new_price_value;
			try {
				$price->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	// updateGallery(
						// $main_photo_id, 
						// $files_main_photo, 
						// $edit_arr_other_photos_id, 
						// $edit_arr_other_photos,
						// $delete_arr_other_photos,
						// $arr_other_photos
						// $edit_arr_id
						// $product_id
					// )->getContent());

	public function test($main_photo,$main_photo_id,$files_main_photo,$product_id)
	{
		return "tods";
	}	
					
	public function updateGallery(
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
		)
	{
		// return "masuk todsu";
		
		try{
									
			$lastindex = 0;
			//update other photos
			if($edit_arr_id != "")
			{			
				
				// return "edit arr id ga kosong";
				
				$count = count($edit_arr_id);						
				for($i = 0; $i<$count; $i++)
				{
					$lastindex++;
					
					$id_edit = $edit_arr_id[$i];	//id foto 			
					//add to folder
						$file = $arr_other_photos[$i]; //foto ke $i
						$destinationPath = "assets/file_upload/product/";
						$fileName = $file->getClientOriginalName();
										
						$new_other_photos = Gallery::find($id_edit);
						$new_other_photos->product_id = $product_id;					
						// $new_other_photos->product_id = 5;	//sementara
						$new_other_photos->type = "other_photos";
						$new_other_photos->save();
						
						$new_other_photos_id = $product_id;
						// $new_other_photos_id = 5; //sementara
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
				// return "fakfakfka";
				
			}
			else	//langsung add new other photo
			{
				
				// return "masuk elese";
				
				//add other photos				
				if(count($arr_other_photos) != 0)
				{									
					
					$count = count($arr_other_photos);
					for($j = $lastindex; $j < $count; $j++)
					{
						$file = $arr_other_photos[$j];
						$destinationPath = "assets/file_upload/product/";
						$fileName = $file->getClientOriginalName();
						
						$new_other_photos = new Gallery();
						$new_other_photos->product_id = $product_id;					
						// $new_other_photos->product_id = 5;	//sementara
						$new_other_photos->type = "other_photos";
						$new_other_photos->save();
						
						$new_other_photos_id = $product_id;
						// $new_other_photos_id = 5; //sementara
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
			}												
			
			
			
			//delete other photos
			foreach($delete_arr_other_photos as $key)
			{
				$gal = Gallery::find($key);
				$gal->delete();
			}
									
			
			
			//edit main photo
			if($main_photo != "")
			{												
				$file = $files_main_photo;								
				$destinationPath = "assets/file_upload/product/";
				$fileName = $file->getClientOriginalName();
				
				// $new_main_photo = new Gallery();
				$new_main_photo = Gallery::find($main_photo_id);
				$new_main_photo->product_id = $product_id;				
				$new_main_photo->type = "main_photo";
				$new_main_photo->save();
				
				$new_main_photo_id = $product_id;
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
			
											
			$respond = array('code'=>'204','status' => 'No Content');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
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
	
	public function getListAttribute()
	{
		$attribute = Attribute::all();		
		$arrAttribute = array();
			
		if(count($attribute) == 0)
		{
			return null;
		}			
		foreach($attribute as $key)		
		{
			$arrAttribute[$key->id] = $key->name;						
			// $arrAttribute[]['value'] = $key->id;
			// $arrAttribute[]['name'] = $key->name;
		}
		return $arrAttribute;
	}	
	
	public function getListCategory()
	{
		$category = Category::all();		
		$arrCategory = array();
			
		if(count($category) == 0)
		{
			return null;
		}	
		foreach($category as $key)		
		{
			$arrCategory[$key->id] = $key->name;						
		}
		return $arrCategory;
	}	
	
	public function getListPromotion()
	{
		$promotion = Promotion::all();		
		$arrPromotion = array();
		
		if(count($promotion) == 0)
		{
			return null;
		}	
		$arrPromotion['-1'] = 'no promotion';
		foreach($promotion as $key)		
		{
			$arrPromotion[$key->id] = $key->name;						
		}
		return $arrPromotion;
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
	
	/*
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
				
				if($key->promotion_id == null) //if($key->promotion_id == -1)
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
	
	public function updateFull($id, $input_product, $input_gallery)
	{
		$respond = array();
		$product = Product::find($id);
		if($product == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
		
			//validate
			$validator = Validator::make($data = $input_product, Product::$rules); 								

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
					
			//save
			try {							
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
					
					$gallery_cont = new GalleryController();
					$new_main_photo = 
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
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
		}
		return Response::json($respond);
	}
	*/		
	
	//UPDATE 	
	/*
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
	*/

}
