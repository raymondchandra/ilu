<?php

class WishlistsController extends \BaseController {

	public function w_insert()
	{
		$json = Input::get('json_data');
		$decode = json_decode($json);
		
		$account_id = $decode->{'account_id'};
		$product_id = $decode->{'product_id'};		
		
		$input = array(
					'account_id' => $account_id,
					'product_id' => $product_id					
		);
		
		return $this->insert($input);
	}	
	public function insert($input)
	{
		// $input = json_decode(Input::all());
				
		$respond = array();
		//validate
		$validator = Validator::make($data = $input, Wishlist::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		$data['account_id'] = Auth::user()->id;
		//save
		try {
			Wishlist::create($data);
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}
	

	/**
	 * Display all of the wishlist.
	 *
	 * @return Response
	 */
	public function getAll(){
		$respond = array();
		$wishlist = Wishlist::all();
		if (count($wishlist) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$wishlist);
		}
		return Response::json($respond);
	}
	
	public function getById($id)
	{
		$respond = array();
		$wishlist = Wishlist::find($id);
		if (count($wishlist) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$wishlist);
		}
		return Response::json($respond);
	}

	/*
	public function getBy{name}()
	{
		$respond = array();
		$wishlist = Wishlist::where('','=','')->get();
		if (count($wishlist) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$wishlist);
		}
		return Response::json($respond);
	}
	*/
	
	public function updateFull($id)
	{
		$respond = array();
		$wishlist = Wishlist::find($id);
		if ($wishlist == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//validate
			$validator = Validator::make($data = Input::all(), Wishlist::$rules);

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			//save
			try {
				$wishlist->update($data);
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	/*
	public function update{name}($id)
	{
		$respond = array();
		$wishlist = Wishlist::find($id);
		if ($wishlist == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			//$wishlist-> = ;
			try {
				$wishlist->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	*/	
	
	/**
	 * Remove the specified wishlist from database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($product_id)
	{
		$respond = array();
		$wishlist = Wishlist::where('account_id','=',Auth::user()->id)->where('product_id','=',$product_id)->first();
		if ($wishlist == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$wishlist->delete();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	public function exist()
	{
		$respond = array();
		$wishlist = Wishlist::where('','=','')->get();
		if (count($wishlist) >= 0)
		{
			$respond = array('code'=>'200','status' => 'OK');
		}
		else
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		return Response::json($respond);
	}	
		
	public function getWishListByAccountId()
	{
		$id = Input::get('acc_id');
		$respond = array();
		$wishlist = Wishlist::where('account_id','=',$id)->get();
		if (count($wishlist) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($wishlist as $wish)
			{
				$wish->productName = Wishlist::find($wish->id)->product->name;
				$wish->productNumber = Wishlist::find($wish->id)->product->product_no;
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$wishlist);
		}
		return Response::json($respond);
	}
	
	//---------------------------------------------------------------------WEBSERVICE BUAT FRONT---------------------------------------------------------------------
	public function ws_insert()
	{
		$json = Input::get('json');
		$jsonContent = json_decode($json);
		
		$product_id = $jsonContent->{'product_id'};							
		
		$input = array(
			'account_id' => Auth::user()->id,
			'product_id' => $product_id
		);
		
		$respond = array();
		//validate
		$validator = Validator::make($data = $input, Wishlist::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			Wishlist::create($data);
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}
	
	public function ws_getWishlist()
	{
		$respond = array();
		$wishlist = Auth::user()->wishlist;
		if (count($wishlist) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//get id barang
			$arr_product = array();
			foreach($wishlist as $wish)
			{
				$respond = array();
				$product = Product::find($wish->product_id);		
					
				if (count($product) == 0)
				{
					//do nothing
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
					
					//add to array product
					$arr_product[] = $product;
				}
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$arr_product);
		}
		return Response::json($respond);
	}
	
	public function ws_delete()
	{
		$json = Input::get('json');
		$jsonContent = json_decode($json);
		
		$product_id = $jsonContent->{'product_id'};											
		
		$respond = array();
		$wishlist = Wishlist::where('account_id','=',Auth::user()->id)->where('product_id','=',$product_id)->first();
		if ($wishlist == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$wishlist->delete();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	//-------------------------------------------------------------------END WEBSERVICE BUAT FRONT-------------------------------------------------------------------
	
	/**
	 * Get wishlist by account_id
	 *
	 * @param  $id string
	 * @return Response
	 */
	public function getWishList()
	{

		$respond = array();
		$wishlist = Auth::user()->wishlist;
		if (count($wishlist) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//get id barang
			$respond = array('code'=>'200','status' => 'OK','messages'=>$wishlist);
		}
		return Response::json($respond);
	}
}
