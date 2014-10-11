<?php

class AttributesController extends \BaseController {

	public function w_insert()
	{
		$json = Input::get('json_data');
		$decode = json_decode($json);
		
		$name = $decode->{'name'};
		$deleted = $decode->{'deleted'};
		
		// $name = null;
		// $deleted = 0;
		
		$input = array(
					'name' => $name,
					'deleted' => $deleted);
		
		return $this->insert($input);
	}	
	public function insert($input)
	{
		// $input = json_decode(Input::all());
		
		$respond = array();
		//validate
		$validator = Validator::make($data = $input, Attribute::$rules);					

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			Attribute::create($data);
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}	
	
	
	public function getAll(){
		$respond = array();
		$attribute = Attribute::all();
		if (count($attribute) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$attribute);
		}
		return Response::json($respond);
	}	
	
	public function getById($id)
	{
		$respond = array();
		$attribute = Attribute::find($id);
		if (count($attribute) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$attribute);
		}
		return Response::json($respond);
	}
	
	public function getByName($name)
	{
		$respond = array();		
		$attribute = Attribute::where('name', 'LIKE','%'.$name.'%')->get();
		if (count($attribute) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$attribute);
		}
		return Response::json($respond);
	}			
	
	public function getByDeleted($deleted)
	{
		$respond = array();		
		$attribute = Attribute::where('deleted','=', $deleted)->get();
		if (count($attribute) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$attribute);
		}
		return Response::json($respond);
	}
			 
	public function updateFull($id)
	{
		$respond = array();
		$attribute = Attribute::find($id);
		if ($attribute == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$input = json_decode(Input::all());
			
			//validate
			$validator = Validator::make($data = $input, Attribute::$rules);

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			//save
			try {
				$attribute->update($data);
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
		$attribute = Attribute::find($id);
		if ($attribute == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$attribute->delete();
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
		$attribute = Attribute::find($id);		
		if ($attribute == null)
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
