<?php

class OrdersController extends \BaseController {

	/**
	 * Insert a newly created order in database.
	 *
	 * @return Response
	 */
	public function insert()
	{
		$respond = array();
		//validate
		$validator = Validator::make($data = Input::all(), Order::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			Order::create($data);
			$idCreate  = $data->id;
			$respond = array('code'=>'201','status' => 'Created','messages'=>$idCreate);
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}

	/**
	 * Display all of the order.
	 *
	 * @return Response
	 */
	public function getAll(){
		$respond = array();
		$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->get(array('orders.id', 'orders.priceNow', 'orders.status', 'orders.quantity', 'transactions.invoice', 'transactions.total_price', 'profiles.full_name' ,'products.name','transactions.created_at'));
		if (count($order) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$order);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display all of the order sort
	 *
	 * @return Response
	 */
	public function getAllSort($sortBy, $type){
		$respond = array();
		$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->orderBy($sortBy, $type)->get(array('orders.id', 'orders.priceNow', 'orders.status', 'orders.quantity', 'transactions.invoice', 'transactions.total_price', 'profiles.full_name' ,'products.name','transactions.created_at'));
		if (count($order) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$order);
		}
		return Response::json($respond);
	}

	/**
	 * Filter order
	 *
	 * @return Response
	 */
	public function getFilteredOrder($id, $invoice, $purchasedOn, $name, $nameProd, $qty, $hargaSatuan, $hargaTotal, $status)
	{
		$isFirst = false;
		
		if($id != '-')
		{
			if($isFirst == false)
			{
				$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->where('orders.id', 'LIKE', '%'.$id.'%');
				$isFirst = true;
			}
		}	
		
		if($invoice != '-')
		{
			if($isFirst == false)
			{
				$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->where('transactions.invoice', 'LIKE', '%'.$invoice.'%');
				$isFirst = true;
			}
			else
			{
				$order = $order->where('transactions.invoice', 'LIKE', '%'.$invoice.'%');
			}
		}
		
		if($purchasedOn != '-')
		{
			if($isFirst == false)
			{
				
				$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->where('transactions.created_at', 'LIKE', '%'.$purchasedOn.'%');
				$isFirst = true;
			}
			else
			{
				$order = $order->where('transactions.created_at', 'LIKE', '%'.$purchasedOn.'%');
			}
		}
		
		if($name != '-')
		{
			if($isFirst == false)
			{
				$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->where('profiles.full_name', 'LIKE', '%'.$name.'%');
				$isFirst = true;
			}
			else
			{
				$order = $order->where('profiles.full_name', 'LIKE', '%'.$name.'%');
			}
		}
		
		if($nameProd != '-')
		{
			if($isFirst == false)
			{
				$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->where('products.name', 'LIKE', '%'.$nameProd.'%');
				$isFirst = true;
			}
			else
			{
				$order = $order->where('products.name', 'LIKE', '%'.$nameProd.'%');
			}
		}
		
		if($qty != '-')
		{
			if($isFirst == false)
			{
				$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->where('orders.quantity', 'LIKE', '%'.$qty.'%');
				$isFirst = true;
			}
			else
			{
				$order = $order->where('orders.quantity', 'LIKE', '%'.$qty.'%');
			}
		}
		
		if($hargaSatuan != '-')
		{
			if($isFirst == false)
			{
				$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->where('orders.priceNow', 'LIKE', '%'.$hargaSatuan.'%');
				$isFirst = true;
			}
			else
			{
				$order = $order->where('orders.priceNow', 'LIKE', '%'.$hargaSatuan.'%');
			}
		}
		
		if($hargaTotal != '-')
		{
			if($isFirst == false)
			{
				$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->where('transactions.total_price', 'LIKE', '%'.$hargaTotal.'%');
				$isFirst = true;
			}
			else
			{
				$order = $order->where('transactions.total_price', 'LIKE', '%'.$hargaTotal.'%');
			}
		}
		
		if($status != '-')
		{
			if($isFirst == false)
			{
				$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->where('orders.status', 'LIKE', '%'.$status.'%');
				$isFirst = true;
			}
			else
			{
				$order = $order->where('orders.status', 'LIKE', '%'.$status.'%');
			}
		}
		
		if($isFirst == false)
		{
			$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->get(array('orders.id', 'orders.priceNow', 'orders.status', 'orders.quantity', 'transactions.invoice', 'transactions.total_price', 'profiles.full_name' ,'products.name','transactions.created_at'));
			
			$isFirst = true;
		}else
		{
			$order = $order->get(array('orders.id', 'orders.priceNow', 'orders.status', 'orders.quantity', 'transactions.invoice', 'transactions.total_price', 'profiles.full_name' ,'products.name','transactions.created_at'));
		}
		
		if (count($order) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$order);
		}
		return Response::json($respond);
	}
		
	/**
	 * Filter order sort
	 *
	 * @return Response
	 */
	public function getFilteredOrderSort($id, $invoice, $purchasedOn, $name, $nameProd, $qty, $hargaSatuan, $hargaTotal, $status, $sortBy, $sortType)
	{
		$isFirst = false;
		
		if($id != '-')
		{
			if($isFirst == false)
			{
				$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->where('orders.id', 'LIKE', '%'.$id.'%');
				$isFirst = true;
			}
		}	
		
		if($invoice != '-')
		{
			if($isFirst == false)
			{
				$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->where('transactions.invoice', 'LIKE', '%'.$invoice.'%');
				$isFirst = true;
			}
			else
			{
				$order = $order->where('transactions.invoice', 'LIKE', '%'.$invoice.'%');
			}
		}
		
		if($purchasedOn != '-')
		{
			if($isFirst == false)
			{
				$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->where('transactions.created_at', 'LIKE', '%'.$purchasedOn.'%');
				$isFirst = true;
			}
			else
			{
				$order = $order->where('transactions.created_at', 'LIKE', '%'.$purchasedOn.'%');
			}
		}
		
		if($name != '-')
		{
			if($isFirst == false)
			{
				$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->where('profiles.full_name', 'LIKE', '%'.$name.'%');
				$isFirst = true;
			}
			else
			{
				$order = $order->where('profiles.full_name', 'LIKE', '%'.$name.'%');
			}
		}
		
		if($nameProd != '-')
		{
			if($isFirst == false)
			{
				$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->where('products.name', 'LIKE', '%'.$nameProd.'%');
				$isFirst = true;
			}
			else
			{
				$order = $order->where('products.name', 'LIKE', '%'.$nameProd.'%');
			}
		}
		
		if($qty != '-')
		{
			if($isFirst == false)
			{
				$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->where('orders.quantity', 'LIKE', '%'.$qty.'%');
				$isFirst = true;
			}
			else
			{
				$order = $order->where('orders.quantity', 'LIKE', '%'.$qty.'%');
			}
		}
		
		if($hargaSatuan != '-')
		{
			if($isFirst == false)
			{
				$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->where('orders.priceNow', 'LIKE', '%'.$hargaSatuan.'%');
				$isFirst = true;
			}
			else
			{
				$order = $order->where('orders.priceNow', 'LIKE', '%'.$hargaSatuan.'%');
			}
		}
		
		if($hargaTotal != '-')
		{
			if($isFirst == false)
			{
				$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->where('transactions.total_price', 'LIKE', '%'.$hargaTotal.'%');
				$isFirst = true;
			}
			else
			{
				$order = $order->where('transactions.total_price', 'LIKE', '%'.$hargaTotal.'%');
			}
		}
		
		if($status != '-')
		{
			if($isFirst == false)
			{
				$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->where('orders.status', 'LIKE', '%'.$status.'%');
				$isFirst = true;
			}
			else
			{
				$order = $order->where('orders.status', 'LIKE', '%'.$status.'%');
			}
		}
		
		if($isFirst == false)
		{
			$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.deleted','=','0')->orderBy($sortBy, $type)->get(array('orders.id', 'orders.priceNow', 'orders.status', 'orders.quantity', 'transactions.invoice', 'transactions.total_price', 'profiles.full_name' ,'products.name','transactions.created_at'));
			$isFirst = true;
		}else
		{
			$order = $order->orderBy($sortBy, $type)->get(array('orders.id', 'orders.priceNow', 'orders.status', 'orders.quantity', 'transactions.invoice', 'transactions.total_price', 'profiles.full_name' ,'products.name','transactions.created_at'));
		}
		
		if (count($order) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$order);
		}
		return Response::json($respond);
	}
		
	/**
	 * Display the specified order.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getById($id)
	{
		$respond = array();
		$order = Order::find($id);
		if (count($order) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$order);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified order by {name}.
	 *
	 * @param  
	 * @return Response
	 */
	/*
	public function getBy{name}()
	{
		$respond = array();
		$order = Order::where('','=','')->get();
		if (count($order) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$order);
		}
		return Response::json($respond);
	}
	*/

	/**
	 * Update all value of the specified order in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateFull($id)
	{
		$respond = array();
		$order = Order::find($id);
		if ($order == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//validate
			$validator = Validator::make($data = Input::all(), Order::$rules);

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			//save
			try {
				$order->update($data);
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	/**
	 * Update status (pending, on progress, sent)
	 *
	 * @param  int  $id, $status
	 * @return Response
	 */
	public function updateStatus()
	{
		$id = Input::get('id');
		$status = Input::get('status');
		$respond = array();
		$order = Order::find($id);
		if ($order == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$order ->status = $status;
			try {
				$order->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}

	/**
	 * Update {name} value of the specified order in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*
	public function update{name}($id)
	{
		$respond = array();
		$order = Order::find($id);
		if ($order == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			//$order-> = ;
			try {
				$order->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	*/
	
	
	/**
	 * Remove the specified order from database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$respond = array();
		$order = Order::find($id);
		if ($order == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$order->delete();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}

	/**
	 * Check if row exist in database.
	 *
	 * @param  
	 * @return Response
	 */
	/*
	public function exist()
	{
		$respond = array();
		$order = Order::where('','=','')->get();
		if (count($order) >= 0)
		{
			$respond = array('code'=>'200','status' => 'OK');
		}
		else
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		return Response::json($respond);
	}
	*/
	
	/**
	 * Display detail order for admin panel
	 *
	 * @param    
	 * @return Response
	 */
	public function getDetail()
	{
		$id = Input::get('id');
		$respond = array();
		$order = Order::where('id','=',$id)->get();
		if (count($order) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($order as $key)
			{
				$price = Price::where('id','=',$key->price_id)->first();
				$key->attr_value = $price->attr_value;
				$attr = Attribute::where('id','=',$price->attr_id)->first();
				$key->attr_name = $attr->name;
				$prod = Product::where('id','=',$price->product_id)->first();
				$key->name_product = $prod->name;
				$cat = Category::where('id','=',$prod->category_id)->first();
				$key->ctgr = $cat->name;
				$main_photo = Gallery::where('product_id','=',$prod->id)->where('type','=','main_photo')->first();
				if(count($main_photo) == 0)
				{
					$phot = "";
				}else
				{
					$phot = $main_photo->photo_path;
				}
				$key->phot = $phot;
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$order);
		}
		return Response::json($respond);
	}
	
	
}
