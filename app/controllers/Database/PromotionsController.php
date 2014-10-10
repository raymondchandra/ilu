<?php

class PromotionsController extends \BaseController {
	
	public function insert()
	{
		$input = json_decode(Input::all());
		
		$respond = array();
		//validate
		$validator = Validator::make($data = $input, Promotion::$rules);

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
	
	public function getAll()
	{
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
	
	public function getAllSortedNameAsc()
	{
		$respond = array();
		$promotion = Promotion::all()->orderBy('name')->get();
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
	
	public function getAllSortedNameDesc()
	{
		$respond = array();
		$promotion = Promotion::all()->orderBy('name', 'desc')->get();
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
	
	public function getAllSortedAmountAsc()
	{
		$respond = array();
		$promotion = Promotion::all()->orderBy('amount')->get();
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
		
	public function getAllSortedAmountDesc(){
		$respond = array();
		$promotion = Promotion::all()->orderBy('amount', 'desc')->get();
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
	
	public function getAllSortedStartedAsc(){
		$respond = array();
		$promotion = Promotion::all()->orderBy('started')->get();
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
	
	public function getAllSortedStartedDesc(){
		$respond = array();
		$promotion = Promotion::all()->orderBy('started', 'desc')->get();
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
	
	public function getAllSortedExpiredAsc(){
		$respond = array();
		$promotion = Promotion::all()->orderBy('expired')->get();
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
		
	public function getAllSortedExpiredDesc(){
		$respond = array();
		$promotion = Promotion::all()->orderBy('expired', 'desc')->get();
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
	
	public function getByName($name)		
	{
		$respond = array();
		$promotion = Promotion::where('name', 'LIKE','%'.$name.'%')->get();
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
			$input = json_decode(Input::all());
		
			//validate
			$validator = Validator::make($data = $input, Promotion::$rules);

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
	
	public function exist($id)
	{
		$respond = array();
		$promotion = Promotion::find($id);
		if ($promotion == null)
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
