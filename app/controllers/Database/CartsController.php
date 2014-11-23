<?php

class CartsController extends \BaseController {
	
	public function w_insert()
	{
		$json = Input::get('json_data');
		$decode = json_decode($json);
		
		$account_id = $decode->{'account_id'};
		$price_id = $decode->{'price_id'};
		$quantity = $decode->{'quantity'};
		
		$input = array(
					'account_id' => $account_id,
					'price_id' => $price_id,
					'quantity' => $quantity
		);
		
		return $this->insert($input);
	}		
	public function insert($input)
	{
		// $input = json_decode(Input::all());
		
		$respond = array();
		//validate
		$validator = Validator::make($data = $input, Cart::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			Cart::create($data);
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}

	public function getAll(){
		$respond = array();
		$cart = Cart::all();
		if (count($cart) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			foreach($cart as $key)
			{
				$price = Price::where('id','=',$key->price_id)->first();											
				
				$attr_name = Attribute::where('id','=',$price->attr_id)->first()->name;
				
				//add attr_name
				$key->attr_name = $attr_name;
				
				//add price
				$key->price = $price->amount;
				
				$tax_amount = Tax::where('id','=',$price->tax_id)->first()->amount;
				
				//add price_with_tax
				$key->price_with_tax = ($price->amount + ($price->amount * $tax_amount / 100));														
				
				$product = Product::where('id','=',$price->product_id)->first();
				
				//add product_no
				$key->product_no = $product->product_no;
				
				//add product_name
				$key->product_name = $product->name;
				
				//add product_description
				$key->product_description = $product->description;
				
				if($product->promotion_id == null)
				{
					//add price_with_tax_promotion ----> no promotion
					$key->price_with_tax_promotion = $key->price_with_tax;
				}
				else
				{
					$promotion = Promotion::where('id','=',$product->promotion_id)->first();
					//add price_with_tax_promotion ----> with promotion
					$key->price_with_tax_promotion = $key->price_with_tax - $promotion->amount;
				}												
				
				$main_photo = Gallery::where('product_id','=',$product->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$product->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photos
				$key->other_photos = $other_photos->photo_path;
			}
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$cart);
		}
		return Response::json($respond);
	}
	
	// return array cart : 
			// id, account_id, price_id, quantity, 
			// attr_name, price, price_with_tax, 
			// product_no, product_name, product_description, price_with_tax_promotion,
			// main_photo, other_photos
	public function getByAccountId($account_id)
	{
		$respond = array();
		$cart = Cart::where('account_id','=',$account_id)->get();
		if (count($cart) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{								
			foreach($cart as $key)
			{
				$price = Price::where('id','=',$key->price_id)->first();											
				
				$attr_name = Attribute::where('id','=',$price->attr_id)->first()->name;
				
				//add attr_name
				$key->attr_name = $attr_name;
				
				//add price
				$key->price = $price->amount;
				
				$tax_amount = Tax::where('id','=',$price->tax_id)->first()->amount;
				
				//add price_with_tax
				$key->price_with_tax = ($price->amount + ($price->amount * $tax_amount / 100));														
				
				$product = Product::where('id','=',$price->product_id)->first();
				
				//add product_no
				$key->product_no = $product->product_no;
				
				//add product_name
				$key->product_name = $product->name;
				
				//add product_description
				$key->product_description = $product->description;
				
				if($product->promotion_id == null)
				{
					//add price_with_tax_promotion ----> no promotion
					$key->price_with_tax_promotion = $key->price_with_tax;
				}
				else
				{
					$promotion = Promotion::where('id','=',$product->promotion_id)->first();
					//add price_with_tax_promotion ----> with promotion
					$key->price_with_tax_promotion = $key->price_with_tax - $promotion->amount;
				}												
				
				$main_photo = Gallery::where('product_id','=',$product->id)->where('type','=','main_photo')->first();						
				$other_photos = Gallery::where('product_id','=',$product->id)->where('type','=','other_photos')->get();
				
				//add main_photo
				$key->main_photo = $main_photo->photo_path;
				
				//add other_photos
				$key->other_photos = $other_photos->photo_path;
			}
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$cart);
		}
		return Response::json($respond);
	}
	
	public function getCartByAccountId()
	{
		$id = Input::get('acc_id');
		$respond = array();
		$cart = Cart::where('account_id', '=', $id)->get();
		if(count($cart) == 0)
		{
			$respond = array('code'=>'404','status'=>'Not Found');
		}
		else
		{
			foreach($cart as $ca)
			{
				$price = Price::where('id','=',$ca->price_id)->first();	
				$product = Product::where('id','=',$price->product_id)->first();			
				$main_photo = Gallery::where('product_id','=',$product->id)->where('type','=','main_photo')->first();
				//add photo
				if($main_photo != null)
				{
					$ca->product_photo = $main_photo->photo_path;
				}
				else
				{
					$ca->product_photo = "";
				}
				//add product_name
				$ca->product_name = $product->name;				
			}
			$respond = array('code'=>'200','status'=>'OK','messages'=>$cart);
		}			
		return Response::json($respond);
	}

	public function updatePriceId($id, $new_price_id)
	{
		$respond = array();
		$cart = Cart::find($id);
		if ($cart == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$cart->price_id = $new_price_id;
			try {
				$cart->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	public function updateQuantity($id, $new_quantity)
	{
		$respond = array();
		$cart = Cart::find($id);
		if ($cart == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$cart->quantity = $new_quantity;
			try {
				$cart->save();
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
		$cart = Cart::find($id);
		if ($cart == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$cart->delete();
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
		$cart = Cart::find($id);
		if ($cart == null)
		{
			$respond = array('code'=>'200','status' => 'OK');
		}
		else
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		return Response::json($respond);
	}	

	//---------------------------------------------------------------------WEBSERVICE BUAT FRONT---------------------------------------------------------------------
	
	public function ws_insert()
	{
		$respond = array();
		return Response::json($respond);
	}
	
	public function ws_updateClassification()
	{
		$respond = array();
		return Response::json($respond);
	}
	
	//inputnya card_id
	public function ws_updateQuantity()
	{
		$json = Input::get('json');
		$jsonContent = json_decode($json);
		
		$id = $jsonContent->{'id'};							
		$quantity = $jsonContent->{'quantity'};
		
		$respond = array();
		$cart = Cart::find($id);
		if ($cart == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$cart->quantity = $quantity;
			try {
				$cart->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	//inputnya cart_id
	public function ws_delete()
	{
		$json = Input::get('json');
		$jsonContent = json_decode($json);
		
		$id = $jsonContent->{'id'};							
		
		$cart = Cart::find($id);
		if ($cart == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$cart->delete();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
				
	}
	//-------------------------------------------------------------------END WEBSERVICE BUAT FRONT-------------------------------------------------------------------
}
