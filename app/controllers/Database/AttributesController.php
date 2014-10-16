<?php

class AttributesController extends \BaseController {

	public function w_insert()
	{
		$json = Input::get('json_data');
		$decode = json_decode($json);
		
		$name = $decode->{'name'};		
		
		$input = array(
					'name' => $name,
					'deleted' => 0);
		
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

		//handle duplicate name attribute already in models validator			
		try {
			Attribute::create([				
					'name' => $input['name'],
					'deleted' => $input['deleted']
				]);					
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
	
	public function getByNameSortedNameAsc($name)
	{
		$respond = array();		
		$attribute = Attribute::where('name', 'LIKE','%'.$name.'%')->orderBy('name')->get();
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
	
	public function getByNameSortedNameDesc($name)
	{
		$respond = array();		
		$attribute = Attribute::where('name', 'LIKE','%'.$name.'%')->orderBy('name', 'desc')->get();
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
			 
	public function updateName($id, $new_name)
	{
		$respond = array();
		$attribute = Attribute::find($id);
		if($attribute == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$attribute->name = $new_name;
			try {
				$attribute->save();
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
