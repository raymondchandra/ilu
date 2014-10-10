<?php

class ProductsController extends \BaseController {
	
	public function insert()
	{
		$input = json_decode(Input::all());
		
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
			Product::create($data);
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}	
	
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
				$cat_id = $key->category_id;
				$cat_name = Category::where('id','=',$cat_id)->first()->name;
				$promo_id = $key->promotion_id;
				$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
				//add category name, promotion amount, promotion expired
				$key->category_name = $cat_name;
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;							
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
					foreach($prices as $key_prices)
					{
						$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
						$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
						//add attribute name
						$key_prices->attr_name = $attr_name;										
						$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
						
						$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $key->promotion_amount);
					}
				
				//add prices by attribute
				$key->prices = $prices;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);		
	}
		
	public function getAllSortedProductNoAsc()
	{
		$respond = array();
		$product = Product::all()->orderBy('product_no')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($product as $key)		
			{
				$cat_id = $key->category_id;
				$cat_name = Category::where('id','=',$cat_id)->first()->name;
				$promo_id = $key->promotion_id;
				$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
				//add category name, promotion amount, promotion expired
				$key->category_name = $cat_name;
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;							
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
					foreach($prices as $key_prices)
					{
						$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
						$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
						//add attribute name
						$key_prices->attr_name = $attr_name;										
						$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
						
						$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $key->promotion_amount);
					}
				
				//add prices by attribute
				$key->prices = $prices;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);		
	}
	
	public function getAllSortedProductNoDesc()
	{
		$respond = array();
		$product = Product::all()->orderBy('product_no', 'desc')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($product as $key)		
			{
				$cat_id = $key->category_id;
				$cat_name = Category::where('id','=',$cat_id)->first()->name;
				$promo_id = $key->promotion_id;
				$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
				//add category name, promotion amount, promotion expired
				$key->category_name = $cat_name;
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;							
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
					foreach($prices as $key_prices)
					{
						$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
						$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
						//add attribute name
						$key_prices->attr_name = $attr_name;										
						$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
						
						$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $key->promotion_amount);
					}
				
				//add prices by attribute
				$key->prices = $prices;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);		
	}
		
	public function getAllSortedNameAsc()
	{
		$respond = array();
		$product = Product::all()->orderBy('name')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($product as $key)		
			{
				$cat_id = $key->category_id;
				$cat_name = Category::where('id','=',$cat_id)->first()->name;
				$promo_id = $key->promotion_id;
				$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
				//add category name, promotion amount, promotion expired
				$key->category_name = $cat_name;
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;							
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
					foreach($prices as $key_prices)
					{
						$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
						$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
						//add attribute name
						$key_prices->attr_name = $attr_name;										
						$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
						
						$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $key->promotion_amount);
					}
				
				//add prices by attribute
				$key->prices = $prices;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);		
	}
	
	public function getAllSortedNameDesc()
	{
		$respond = array();
		$product = Product::all()->orderBy('name', 'desc')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($product as $key)		
			{
				$cat_id = $key->category_id;
				$cat_name = Category::where('id','=',$cat_id)->first()->name;
				$promo_id = $key->promotion_id;
				$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
				//add category name, promotion amount, promotion expired
				$key->category_name = $cat_name;
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;							
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
					foreach($prices as $key_prices)
					{
						$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
						$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
						//add attribute name
						$key_prices->attr_name = $attr_name;										
						$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
						
						$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $key->promotion_amount);
					}
				
				//add prices by attribute
				$key->prices = $prices;
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
			$cat_id = $product->category_id;
			$cat_name = Category::where('id','=',$cat_id)->first()->name;
			$promo_id = $product->promotion_id;
			$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
			$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
			//add category name, promotion amount, promotion expired
			$product->category_name = $cat_name;
			$product->promotion_amount = $promo_amount;
			$product->promotion_expired = $promo_expired;							
			
			$prices = Price::where('product_id','=',$product->id)->get();				
				foreach($prices as $key_prices)
				{
					$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
					$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
					// add attribute name
					$key_prices->attr_name = $attr_name;										
					$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
					
					$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $product->promotion_amount);
				}
			
			//add prices by attribute
			$product->prices = $prices;
			
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
				$cat_id = $key->category_id;
				$cat_name = Category::where('id','=',$cat_id)->first()->name;
				$promo_id = $key->promotion_id;
				$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
				//add category name, promotion amount, promotion expired
				$key->category_name = $cat_name;
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;							
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
					foreach($prices as $key_prices)
					{
						$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
						$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
						//add attribute name
						$key_prices->attr_name = $attr_name;										
						$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
						
						$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $key->promotion_amount);
					}
				
				//add prices by attribute
				$key->prices = $prices;
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
				$cat_id = $key->category_id;
				$cat_name = Category::where('id','=',$cat_id)->first()->name;
				$promo_id = $key->promotion_id;
				$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
				//add category name, promotion amount, promotion expired
				$key->category_name = $cat_name;
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;							
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
					foreach($prices as $key_prices)
					{
						$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
						$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
						//add attribute name
						$key_prices->attr_name = $attr_name;										
						$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
						
						$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $key->promotion_amount);
					}
				
				//add prices by attribute
				$key->prices = $prices;
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
				$cat_id = $key->category_id;
				$cat_name = Category::where('id','=',$cat_id)->first()->name;
				$promo_id = $key->promotion_id;
				$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
				//add category name, promotion amount, promotion expired
				$key->category_name = $cat_name;
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;							
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
					foreach($prices as $key_prices)
					{
						$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
						$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
						//add attribute name
						$key_prices->attr_name = $attr_name;										
						$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
						
						$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $key->promotion_amount);
					}
				
				//add prices by attribute
				$key->prices = $prices;
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
				$cat_id = $key->category_id;
				$cat_name = Category::where('id','=',$cat_id)->first()->name;
				$promo_id = $key->promotion_id;
				$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
				//add category name, promotion amount, promotion expired
				$key->category_name = $cat_name;
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;							
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
					foreach($prices as $key_prices)
					{
						$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
						$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
						//add attribute name
						$key_prices->attr_name = $attr_name;										
						$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
						
						$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $key->promotion_amount);
					}
				
				//add prices by attribute
				$key->prices = $prices;
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
				$cat_id = $key->category_id;
				$cat_name = Category::where('id','=',$cat_id)->first()->name;
				$promo_id = $key->promotion_id;
				$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
				//add category name, promotion amount, promotion expired
				$key->category_name = $cat_name;
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;							
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
					foreach($prices as $key_prices)
					{
						$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
						$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
						//add attribute name
						$key_prices->attr_name = $attr_name;										
						$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
						
						$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $key->promotion_amount);
					}
				
				//add prices by attribute
				$key->prices = $prices;
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
				$cat_id = $key->category_id;
				$cat_name = Category::where('id','=',$cat_id)->first()->name;
				$promo_id = $key->promotion_id;
				$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
				//add category name, promotion amount, promotion expired
				$key->category_name = $cat_name;
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;							
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
					foreach($prices as $key_prices)
					{
						$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
						$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
						//add attribute name
						$key_prices->attr_name = $attr_name;										
						$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
						
						$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $key->promotion_amount);
					}
				
				//add prices by attribute
				$key->prices = $prices;
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
				$cat_id = $key->category_id;
				$cat_name = Category::where('id','=',$cat_id)->first()->name;
				$promo_id = $key->promotion_id;
				$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
				//add category name, promotion amount, promotion expired
				$key->category_name = $cat_name;
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;							
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
					foreach($prices as $key_prices)
					{
						$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
						$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
						//add attribute name
						$key_prices->attr_name = $attr_name;										
						$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
						
						$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $key->promotion_amount);
					}
				
				//add prices by attribute
				$key->prices = $prices;
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
				$cat_id = $key->category_id;
				$cat_name = Category::where('id','=',$cat_id)->first()->name;
				$promo_id = $key->promotion_id;
				$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
				//add category name, promotion amount, promotion expired
				$key->category_name = $cat_name;
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;							
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
					foreach($prices as $key_prices)
					{
						$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
						$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
						//add attribute name
						$key_prices->attr_name = $attr_name;										
						$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
						
						$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $key->promotion_amount);
					}
				
				//add prices by attribute
				$key->prices = $prices;
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
				$cat_id = $key->category_id;
				$cat_name = Category::where('id','=',$cat_id)->first()->name;
				$promo_id = $key->promotion_id;
				$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
				//add category name, promotion amount, promotion expired
				$key->category_name = $cat_name;
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;							
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
					foreach($prices as $key_prices)
					{
						$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
						$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
						//add attribute name
						$key_prices->attr_name = $attr_name;										
						$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
						
						$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $key->promotion_amount);
					}
				
				//add prices by attribute
				$key->prices = $prices;
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
				$cat_id = $key->category_id;
				$cat_name = Category::where('id','=',$cat_id)->first()->name;
				$promo_id = $key->promotion_id;
				$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
				//add category name, promotion amount, promotion expired
				$key->category_name = $cat_name;
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;							
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
					foreach($prices as $key_prices)
					{
						$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
						$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
						//add attribute name
						$key_prices->attr_name = $attr_name;										
						$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
						
						$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $key->promotion_amount);
					}
				
				//add prices by attribute
				$key->prices = $prices;
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
				$cat_id = $key->category_id;
				$cat_name = Category::where('id','=',$cat_id)->first()->name;
				$promo_id = $key->promotion_id;
				$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
				//add category name, promotion amount, promotion expired
				$key->category_name = $cat_name;
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;							
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
					foreach($prices as $key_prices)
					{
						$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
						$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
						//add attribute name
						$key_prices->attr_name = $attr_name;										
						$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
						
						$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $key->promotion_amount);
					}
				
				//add prices by attribute
				$key->prices = $prices;
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
				$cat_id = $key->category_id;
				$cat_name = Category::where('id','=',$cat_id)->first()->name;
				$promo_id = $key->promotion_id;
				$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
				//add category name, promotion amount, promotion expired
				$key->category_name = $cat_name;
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;							
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
					foreach($prices as $key_prices)
					{
						$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
						$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
						//add attribute name
						$key_prices->attr_name = $attr_name;										
						$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
						
						$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $key->promotion_amount);
					}
				
				//add prices by attribute
				$key->prices = $prices;
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
				$cat_id = $key->category_id;
				$cat_name = Category::where('id','=',$cat_id)->first()->name;
				$promo_id = $key->promotion_id;
				$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
				//add category name, promotion amount, promotion expired
				$key->category_name = $cat_name;
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;							
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
					foreach($prices as $key_prices)
					{
						$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
						$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
						//add attribute name
						$key_prices->attr_name = $attr_name;										
						$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
						
						$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $key->promotion_amount);
					}
				
				//add prices by attribute
				$key->prices = $prices;
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
				$cat_id = $key->category_id;
				$cat_name = Category::where('id','=',$cat_id)->first()->name;
				$promo_id = $key->promotion_id;
				$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
				//add category name, promotion amount, promotion expired
				$key->category_name = $cat_name;
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;							
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
					foreach($prices as $key_prices)
					{
						$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
						$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
						//add attribute name
						$key_prices->attr_name = $attr_name;										
						$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
						
						$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $key->promotion_amount);
					}
				
				//add prices by attribute
				$key->prices = $prices;
			}			
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
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
				$cat_id = $key->category_id;
				$cat_name = Category::where('id','=',$cat_id)->first()->name;
				$promo_id = $key->promotion_id;
				$promo_amount = Promotion::where('id','=',$promo_id)->first()->amount;
				$promo_expired = Promotion::where('id','=',$promo_id)->first()->expired;				
				//add category name, promotion amount, promotion expired
				$key->category_name = $cat_name;
				$key->promotion_amount = $promo_amount;
				$key->promotion_expired = $promo_expired;							
				
				$prices = Price::where('product_id','=',$key->id)->get();
					
					foreach($prices as $key_prices)
					{
						$attr_name = Attribute::where('id','=',$key_prices->attr_id)->first()->name;						
						$tax_amount = Tax::where('id','=',$key_prices->tax_id)->first()->amount;
						//add attribute name
						$key_prices->attr_name = $attr_name;										
						$key_prices->price_with_tax = ($key_prices->amount + ($key_prices->amount * $tax_amount / 100));
						
						$key_prices->price_with_tax_promotion = ($key_prices->price_with_tax - $key->promotion_amount);
					}
				
				//add prices by attribute
				$key->prices = $prices;
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
