<?php

class TaxesController extends \BaseController {

	/**
	 * Insert a newly created tax in database.
	 *
	 * @return Response
	 */
	public function insert()
	{
		$respond = array();
		//validate
		$validator = Validator::make($data = Input::all(), Tax::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			Tax::create($data);
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}

	/**
	 * Display all of the tax.
	 *
	 * @return Response
	 */
	public function getAll(){
		$respond = array();
		$tax = Tax::all();
		if (count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display all of the tax.
	 *
	 * @return Response
	 */
	public function getAllAmountAsc(){
		$respond = array();
		$tax = Tax::all()->orderBy('amount')->get();
		if (count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
		return Response::json($respond);
	}

	/**
	 * Display all of the tax.
	 *
	 * @return Response
	 */
	public function getAllAmountDesc(){
		$respond = array();
		$tax = Tax::all()->orderBy('amount', 'desc')->get();
		if (count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified tax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getById($id)
	{
		$respond = array();
		$tax = Tax::find($id);
		if (count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified tax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getByAmountLessThanEqual($limit)
	{
		$respond = array();
		// $tax = Tax::find($id);
		$tax = Tax::where('amount', '<=', $limit)->get();
		if (count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified tax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getByAmountLessThanEqualAsc($limit)
	{
		$respond = array();
		// $tax = Tax::find($id);
		$tax = Tax::where('amount', '<=', $limit)->orderBy('amount')->get();
		if (count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified tax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getByAmountLessThanEqualDesc($limit)
	{
		$respond = array();
		// $tax = Tax::find($id);
		$tax = Tax::where('amount', '<=', $limit)->orderBy('amount', 'desc')->get();
		if (count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified tax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getByAmountMoreThanEqual($limit)
	{
		$respond = array();
		// $tax = Tax::find($id);
		$tax = Tax::where('amount', '>=', $limit)->get();
		if (count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified tax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getByAmountMoreThanEqualAsc($limit)
	{
		$respond = array();
		// $tax = Tax::find($id);
		$tax = Tax::where('amount', '>=', $limit)->orderBy('amount')->get();
		if (count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified tax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getByAmountMoreThanEqualDesc($limit)
	{
		$respond = array();
		// $tax = Tax::find($id);
		$tax = Tax::where('amount', '>=', $limit)->orderBy('amount', 'desc')->get();
		if (count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified tax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getByAmountBetweenEqual($lower_limit, $upper_limit)
	{
		$respond = array();
		// $tax = Tax::find($id);
		$tax = Tax::where('amount', '>=', $lower_limit)
					->where('amount', '<=', $upper_limit)->get();
		if (count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified tax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getByAmountBetweenEqualAsc($lower_limit, $upper_limit)
	{
		$respond = array();
		// $tax = Tax::find($id);
		$tax = Tax::where('amount', '>=', $lower_limit)
					->where('amount', '<=', $upper_limit)
					->orderBy('amount')->get();
		if (count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified tax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getByAmountBetweenEqualDesc($lower_limit, $upper_limit)
	{
		$respond = array();
		// $tax = Tax::find($id);
		$tax = Tax::where('amount', '>=', $lower_limit)
					->where('amount', '<=', $upper_limit)
					->orderBy('amount', 'desc')->get();
		if (count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified tax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getByDeleted($deleted)
	{
		$respond = array();
		// $tax = Tax::find($id);
		$tax = Tax::where('deleted', '=', $deleted)->get();
		if (count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
		return Response::json($respond);
	}
	
	/**
	 * Update all value of the specified tax in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateFull($id)
	{
		$respond = array();
		$tax = Tax::find($id);
		if ($tax == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//validate
			$validator = Validator::make($data = Input::all(), Tax::$rules);

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			//save
			try {
				$tax->update($data);
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}

	/**
	 * Update value of the specified tax in database.
	 *
	 * @param  
	 * @return Response
	 */	
	public function updateDeleted($id, $new_deleted)
	{
		$respond = array();
		$tax = Tax::find($id);		
		if ($tax == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$tax->deleted = $new_deleted;
			try {
				$tax->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}		
	
	/**
	 * Update value of the specified tax in database.
	 *
	 * @param  
	 * @return Response
	 */	
	public function updateAmount($id, $new_amount)
	{
		$respond = array();
		$tax = Tax::find($id);		
		if ($tax == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$tax->amount = $new_amount;
			try {
				$tax->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	/**
	 * Remove the specified tax from database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$respond = array();
		$tax = Tax::find($id);
		if ($tax == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$tax->delete();
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
		$tax = Tax::where('','=','')->get();
		if (count($tax) >= 0)
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
