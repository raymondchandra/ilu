<?php

class PromotionsController extends \BaseController {

	/**
	 * Insert a newly created promotion in database.
	 *
	 * @return Response
	 */
	public function insert()
	{
		$respond = array();
		//validate
		$validator = Validator::make($data = Input::all(), Promotion::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			Promotion::create($data);
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}

	/**
	 * Display all of the promotion.
	 *
	 * @return Response
	 */
	public function getAll(){
		$respond = array();
		$promotion = Promotion::all();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display all of the promotion.
	 *
	 * @return Response
	 */
	public function getAllAmountAsc(){
		$respond = array();
		$promotion = Promotion::all()->orderBy('amount');
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display all of the promotion.
	 *
	 * @return Response
	 */
	public function getAllAmountDesc(){
		$respond = array();
		$promotion = Promotion::all()->orderBy('amount', 'desc');
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}

	/**
	 * Display all of the promotion.
	 *
	 * @return Response
	 */
	public function getAllExpiredAsc(){
		$respond = array();
		$promotion = Promotion::all()->orderBy('expired');
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display all of the promotion.
	 *
	 * @return Response
	 */
	public function getAllExpiredDesc(){
		$respond = array();
		$promotion = Promotion::all()->orderBy('expired', 'desc');
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified promotion.
	 *
	 * @param  
	 * @return Response
	 */
	public function getById($id)
	{
		$respond = array();
		$promotion = Promotion::find($id);
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified promotion by 
	 *
	 * @param  
	 * @return Response
	 */	
	public function getByAmountLessThanEqual($limit)
	{
		$respond = array();
		$promotion = Promotion::where('amount','<=',$limit)->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified promotion by 
	 *
	 * @param  
	 * @return Response
	 */	
	public function getByAmountLessThanEqualAsc($limit)
	{
		$respond = array();
		$promotion = Promotion::where('amount','<=',$limit)
						->orderBy('amount')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}	
	
	/**
	 * Display the specified promotion by 
	 *
	 * @param  
	 * @return Response
	 */	
	public function getByAmountLessThanEqualDesc($limit)
	{
		$respond = array();
		$promotion = Promotion::where('amount','<=',$limit)
						->orderBy('amount', 'desc')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified promotion by 
	 *
	 * @param  
	 * @return Response
	 */	
	public function getByAmountMoreThanEqual($limit)
	{
		$respond = array();
		$promotion = Promotion::where('amount','>=',$limit)->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified promotion by 
	 *
	 * @param  
	 * @return Response
	 */	
	public function getByAmountMoreThanEqualAsc($limit)
	{
		$respond = array();
		$promotion = Promotion::where('amount','>=',$limit)
						->orderBy('amount')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified promotion by 
	 *
	 * @param  
	 * @return Response
	 */	
	public function getByAmountMoreThanEqualDesc($limit)
	{
		$respond = array();
		$promotion = Promotion::where('amount','>=',$limit)
						->orderBy('amount', 'desc')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified promotion by 
	 *
	 * @param  
	 * @return Response
	 */	
	public function getByAmountBetweenEqual($lower_limit, $upper_limit)
	{
		$respond = array();
		$promotion = Promotion::where('amount','>=',$lower_limit)
						->where('amount','<=',$upper_limit)->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified promotion by 
	 *
	 * @param  
	 * @return Response
	 */	
	public function getByAmountBetweenEqualAsc($lower_limit, $upper_limit)
	{
		$respond = array();
		$promotion = Promotion::where('amount','>=',$lower_limit)
						->where('amount','<=',$upper_limit)
						->orderBy('amount')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified promotion by 
	 *
	 * @param  
	 * @return Response
	 */	
	public function getByAmountBetweenEqualDesc($lower_limit, $upper_limit)
	{
		$respond = array();
		$promotion = Promotion::where('amount','>=',$lower_limit)
						->where('amount','<=',$upper_limit)
						->orderBy('amount', 'desc')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified promotion by 
	 *
	 * @param  
	 * @return Response
	 */	
	public function getByExpiredLessThanEqual($date)
	{
		$respond = array();
		$promotion = Promotion::where('expired','<=',$date)->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified promotion by 
	 *
	 * @param  
	 * @return Response
	 */	
	public function getByExpiredLessThanEqualAsc($date)
	{
		$respond = array();
		$promotion = Promotion::where('expired','<=',$date)
						->orderBy('expired')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified promotion by 
	 *
	 * @param  
	 * @return Response
	 */	
	public function getByExpiredLessThanEqualDesc($date)
	{
		$respond = array();
		$promotion = Promotion::where('expired','<=',$date)
						->orderBy('expired', 'desc')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified promotion by 
	 *
	 * @param  
	 * @return Response
	 */	
	public function getByExpiredMoreThanEqual($date)
	{
		$respond = array();
		$promotion = Promotion::where('expired','>=',$date)->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified promotion by 
	 *
	 * @param  
	 * @return Response
	 */	
	public function getByExpiredMoreThanEqualAsc($date)
	{
		$respond = array();
		$promotion = Promotion::where('expired','>=',$date)
						->orderBy('expired')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified promotion by 
	 *
	 * @param  
	 * @return Response
	 */	
	public function getByExpiredMoreThanEqualDesc($date)
	{
		$respond = array();
		$promotion = Promotion::where('expired','>=',$date)
						->orderBy('expired', 'desc')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified promotion by 
	 *
	 * @param  
	 * @return Response
	 */	
	public function getByExpiredBetweenEqual($lower_date, $upper_limit)
	{
		$respond = array();
		$promotion = Promotion::where('expired','>=',$lower_date)
						->where('expired','<=',$upper_limit)->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified promotion by 
	 *
	 * @param  
	 * @return Response
	 */	
	public function getByExpiredBetweenEqualAsc($lower_date, $upper_limit)
	{
		$respond = array();
		$promotion = Promotion::where('expired','>=',$lower_date)
						->where('expired','<=',$upper_limit)
						->orderBy('expired')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified promotion by 
	 *
	 * @param  
	 * @return Response
	 */	
	public function getByExpiredBetweenEqualDesc($lower_date, $upper_limit)
	{
		$respond = array();
		$promotion = Promotion::where('expired','>=',$lower_date)
						->where('expired','<=',$upper_limit)
						->orderBy('expired', 'desc')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified promotion by 
	 *
	 * @param  
	 * @return Response
	 */	
	public function getByActive($active)
	{
		$respond = array();
		$promotion = Promotion::where('active','=',$active)->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	/**
	 * Update all value of the specified promotion in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateFull($id)
	{
		$respond = array();
		$promotion = Promotion::find($id);
		if ($promotion == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//validate
			$validator = Validator::make($data = Input::all(), Promotion::$rules);

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			//save
			try {
				$promotion->update($data);
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}

	/**
	 * Update value of the specified promotion in database.
	 *
	 * @param 
	 * @return Response
	 */	
	public function updateAmount($id, $new_amount)
	{
		$respond = array();
		$promotion = Promotion::find($id);
		if ($promotion == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$promotion->amount = $new_amount;
			try {
				$promotion->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}	
	
	/**
	 * Update value of the specified promotion in database.
	 *
	 * @param 
	 * @return Response
	 */	
	public function updateExpired($id, $new_expired)
	{
		$respond = array();
		$promotion = Promotion::find($id);
		if ($promotion == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$promotion->expired = $new_expired;
			try {
				$promotion->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	/**
	 * Update value of the specified promotion in database.
	 *
	 * @param 
	 * @return Response
	 */	
	public function updateActive($id, $new_active)
	{
		$respond = array();
		$promotion = Promotion::find($id);
		if ($promotion == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$promotion->active = $new_active;
			try {
				$promotion->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	/**
	 * Remove the specified promotion from database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$respond = array();
		$promotion = Promotion::find($id);
		if ($promotion == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$promotion->delete();
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
		$promotion = Promotion::where('','=','')->get();
		if (count($promotion) >= 0)
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

}
