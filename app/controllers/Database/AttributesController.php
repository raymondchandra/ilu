<?php

class AttributesController extends \BaseController {
		
	// input : name, deleted	
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
		
	//RETURN : id, name, deleted, created_at, updated_at	
	public function getAll(){
		$respond = array();
		$attribute = Attribute::where('deleted', '=', 0)->get();
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
	
	//RETURN : id, name, deleted, created_at, updated_at	
	//SORTED : id, name
	public function getAllSorted($by, $type)
	{
		$respond = array();
		$attribute = Attribute::where('deleted', '=', 0)->orderBy($by, $type)->get();
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
	
	//RETURN : id, name, deleted, created_at, updated_at	
	//SEARCH : id, name
	public function getFilteredAttribute($id, $name)
	{		
		$respond = array();		
		$attribute = Attribute::where('name', 'LIKE', '%'.$name.'%');				
		
		if($id != -1)
		{
			$attribute = $attribute->where('id', '=', $id);
		}
		
		$attribute = $attribute->where('deleted', '=', 0)->get();
		if(count($attribute) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$attribute);
		}
		return Response::json($respond);	
	}		
	
	//RETURN : id, name, deleted, created_at, updated_at	
	//SEARCH : id, name
	//SORTED : id, name
	public function getFilteredAttributeSorted($id, $name, $sortBy, $sortType)
	{
		$respond = array();		
		$attribute = Attribute::where('name', 'LIKE', '%'.$name.'%');				
		
		if($id != -1)
		{
			$attribute = $attribute->where('id', '=', $id);
		}
		
		$attribute = $attribute->where('deleted', '=', 0)->orderBy($sortBy, $sortType)->get();						
		
		if(count($attribute) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$attribute);
		}
		return Response::json($respond);	
	}

	/*
	public function getAllSortedIdAsc(){
		$respond = array();
		$attribute = Attribute::orderBy('id')->get();
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

	public function getAllSortedIdDesc(){
		$respond = array();
		$attribute = Attribute::orderBy('id', 'desc')->get();
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
	
	public function getAllSortedNameAsc(){
		$respond = array();
		$attribute = Attribute::orderBy('name')->get();
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
	
	public function getAllSortedNameDesc(){
		$respond = array();
		$attribute = Attribute::orderBy('name', 'desc')->get();
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
	*/
	
	/*
	// asumsi :
		// kalo field input integer ada yang kosong maka -1
		// kalo field input string ada yang kosong maka dapetnya ""
	// input : id, name
	public function searchAttribute($input)
	{
		$respond = array();		
		$attribute = Attribute::where('name', 'LIKE', '%'.$input['name'].'%');				
		
		if($input['id'] != -1)
		{
			$attribute = $attribute->where('id', '=', $input['id']);
		}
		
		$attribute = $attribute->get();
		if(count($attribute) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$attribute);
		}
		return Response::json($respond);
	}
	
	public function searchAttributeSortedIdAsc($input)
	{
		$respond = array();		
		$attribute = Attribute::where('name', 'LIKE', '%'.$input['name'].'%');				
		
		if($input['id'] != -1)
		{
			$attribute = $attribute->where('id', '=', $input['id']);
		}
		
		$arr_attribute = $attribute->get();		
		if(count($arr_attribute) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//sorting
			$attribute = $attribute->orderBy('id')->get();
			$respond = array('code'=>'200','status' => 'OK','messages'=>$attribute);
		}
		return Response::json($respond);
	}
	
	public function searchAttributeSortedIdDesc($input)
	{
		$respond = array();		
		$attribute = Attribute::where('name', 'LIKE', '%'.$input['name'].'%');				
		
		if($input['id'] != -1)
		{
			$attribute = $attribute->where('id', '=', $input['id']);
		}
		
		$arr_attribute = $attribute->get();		
		if(count($arr_attribute) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//sorting
			$attribute = $attribute->orderBy('id', 'desc')->get();
			$respond = array('code'=>'200','status' => 'OK','messages'=>$attribute);
		}
		return Response::json($respond);
	}
	
	public function searchAttributeSortedNameAsc($input)
	{
		$respond = array();		
		$attribute = Attribute::where('name', 'LIKE', '%'.$input['name'].'%');				
		
		if($input['id'] != -1)
		{
			$attribute = $attribute->where('id', '=', $input['id']);
		}
		
		$arr_attribute = $attribute->get();		
		if(count($arr_attribute) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//sorting
			$attribute = $attribute->orderBy('name')->get();
			$respond = array('code'=>'200','status' => 'OK','messages'=>$attribute);
		}
		return Response::json($respond);
	}
	
	public function searchAttributeSortedNameDesc($input)
	{
		$respond = array();		
		$attribute = Attribute::where('name', 'LIKE', '%'.$input['name'].'%');				
		
		if($input['id'] != -1)
		{
			$attribute = $attribute->where('id', '=', $input['id']);
		}
		
		$arr_attribute = $attribute->get();		
		if(count($arr_attribute) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//sorting
			$attribute = $attribute->orderBy('name', 'desc')->get();
			$respond = array('code'=>'200','status' => 'OK','messages'=>$attribute);
		}
		return Response::json($respond);
	}
	*/
	
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
			$validator = Validator::make(
				array('name' => $new_name),
				array('name' => 'required|unique:attributes,name')
			);
			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			
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
	
	public function updateDeleted($id, $new_deleted)
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
			$attribute->deleted = $new_deleted;
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
