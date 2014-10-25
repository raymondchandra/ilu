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
		$order = Order::all();
		if (count($order) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($order as $key)
			{
				$key->transaction = Order::find($key->id)->transaction;
				$key->acc_name = Account::find($key->transaction->account_id)->profile->full_name;				
				$key->productName = Order::find($key->id)->price->product->name;
			}
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
	 * Display top ten product
	 *
	 * @return Response
	 */
	public function getTopTenProduct(){
		$respond = array();
		$topTen = Order::join('prices','orders.price_id','=','prices.id')->select(array('prices.product_id', DB::raw('COUNT(prices.product_id*orders.quantity) as jumlah')))->groupBy('prices.product_id')->orderBy('jumlah','desc')->take(10)->get();
		if (count($topTen) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($topTen as $key)
			{
				$product = new ProductsController();
				$productTopTen = $product->getById($key->product_id);// here
				$key->product = $productTopTen;
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$topTen);
		}
		return Response::json($respond);
	}
	
	
}
