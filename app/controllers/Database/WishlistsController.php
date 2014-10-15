<?php

class WishlistsController extends \BaseController {

	/**
	 * Insert a newly created wishlist in database.
	 *
	 * @return Response
	 */
	public function insert()
	{
		$input = json_decode(Input::all());
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

	/**
	 * Display the specified wishlist.
	 *
	 * @param  int  $id
	 * @return Response
	 */
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

	/**
	 * Display the specified wishlist by {name}.
	 *
	 * @param  
	 * @return Response
	 */
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

	/**
	 * Update all value of the specified wishlist in database.
	 *
	 * @param  int  $id
	 * @return Response
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

	/**
	 * Update {name} value of the specified wishlist in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
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
	*/
	
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
