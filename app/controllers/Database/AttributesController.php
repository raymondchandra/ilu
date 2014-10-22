<?php

class AttributesController extends \BaseController {

	public function view_main_attribute()
	{
		$attribute_json = $this->getAll();
		$paginator = json_decode($attribute_json->getContent())->{'messages'};
		$perPage = 5;   
		$page = Input::get('page', 1);
		if ($page > count($paginator) or $page < 1) { $page = 1; }
		$offset = ($page * $perPage) - $perPage;
		$articles = array_slice($paginator,$offset,$perPage);
		$datas = Paginator::make($articles, count($paginator), $perPage);
		
		return View::make('pages.admin.attribute.manage_attribute',compact('datas'));
	}
	
	public function view_detail_attribute($id)
	{
		$json = json_decode($this->getById($id)->getContent());
		return json_encode($json);
	}	
	
	public function view_search_attribute()
	{				
		$json_data = Input::get('json_data');
		$json = json_decode($json_data);
				
		$id = $json->{'id'};		
		$name = $json->{'name'};
		
		if($id == ""){
			$id = -1;
		}
		
		$input = array(
				'id' => $id,
				'name' => $name
		);
		
		$attribute_json = $this->searchAttribute($input);		
		$decode = json_decode($attribute_json->getContent());
		if($decode->code==404)
		{
			//not found
			$datas = null;
		}
		else
		{		
			$temp = json_decode($attribute_json->getContent())->{'messages'};					
			$result = array();
			foreach($temp as $key)						
			{
				$result[] = $key;
			}
			$datas = $result;
			// $perPage = 5;   
			// $page = Input::get('page', 1);
			// if ($page > count($paginator) or $page < 1) { $page = 1; }
				// $offset = ($page * $perPage) - $perPage;
			// $articles = array_slice($paginator,$offset,$perPage);
			// $datas = Paginator::make($articles, count($paginator), $perPage);
		}
				
		// return View::make('pages.admin.attribute.manage_attribute',compact('datas'));			
		return $datas;
	}		
	
	public function addAttribute()
	{
		$json_data = Input::get('json_data');
		$json = json_decode($json_data);
		
		$name = $json->{'name'};
		$deleted = $json->{'deleted'};
		
		$input = array(
				'name' => $name,
				'deleted' => $deleted
		);
		
		$json = json_decode($this->insert($input)->getContent());
		return json_encode($json);
	}
		
	public function editName()
	{		
		$json_data = Input::get('json_data');		
		$json = json_decode($json_data);
		
		$id = $json->{'id'};
		$new_name = $json->{'new_name'};
		
		$json = json_decode($this->updateName($id, $new_name)->getContent());
		return json_encode($json);
	}
	
	// public function w_insert()
	// {
		// $json = Input::get('json_data');
		// $decode = json_decode($json);
		
		// $name = $decode->{'name'};		
		
		// $input = array(
					// 'name' => $name,
					// 'deleted' => 0);
		
		// return $this->insert($input);
	// }		
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
