<?php

class CategoriesController extends \BaseController {
		
	public function w_insert()
	{
		$json = Input::get('json_data');
		$decode = json_decode($json);
		
		$name = $decode->{'name'};
		$parent_category = $decode->{'parent_category'};		
		
		$input = array(
					'name' => $name,
					'parent_category' => $parent_category,
					'deleted' => 0);
					
		return $this->insert($input);
	}
	public function insert($input)
	{
		// $input = json_decode(Input::all());
		
		$respond = array();
		//validate
		$validator = Validator::make($data = $input, Category::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//handle dulicate name category
		$checkName = Category::where('name','=',$input['name'])->get();
		if(count($checkName) == 0)
		{
			//save
			try {
				Category::create([
						'name' => $input['name'],
						'parent_category' => $input['parent_category'],
						'deleted' => $input['deleted']
					]);
				$respond = array('code'=>'201','status' => 'Created');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
		}
		else
		{	
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => 'Duplicate name category');
		}
				
		return Response::json($respond);
	}	
		
	public function getAll(){
		$respond = array();
		$category = Category::all();
		if (count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);
	}	
		 
	public function getAllSortedNameAsc(){
		$respond = array();
		$category = Category::orderBy('name')->get();
		if (count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);
	}	
		
	public function getAllSortedNameDesc(){
		$respond = array();
		$category = Category::orderBy('name', 'desc')->get();
		if (count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);
	}
		
	public function getById($id)
	{
		$respond = array();
		$category = Category::find($id);
		if (count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);
	}
	
	public function getByName($name)
	{
		$respond = array();
		$category = Category::where('name', 'LIKE','%'.$name.'%')->get();
		if (count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);
	}	
	
	public function getByNameSortedNameAsc($name)
	{
		$respond = array();
		$category = Category::where('name', 'LIKE','%'.$name.'%')->orderBy('name')->get();
		if (count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);
	}
		
	public function getByNameSortedNameDesc($name)
	{
		$respond = array();
		$category = Category::where('name', 'LIKE','%'.$name.'%')->orderBy('name', 'desc')->get();
		if (count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);
	}
	
	public function getByParentCategory($parent_category)
	{
		$respond = array();		
		$category = Category::where('parent_category','=', $parent_category)->get();
		if (count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);
	}
	
	public function getByParentCategorySortedNameAsc($parent_category)
	{
		$respond = array();		
		$category = Category::where('parent_category','=', $parent_category)->orderBy('name')->get();
		if (count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);
	}
	
	public function getByParentCategorySortedNameDesc($parent_category)
	{
		$respond = array();		
		$category = Category::where('parent_category','=', $parent_category)->orderBy('name', 'desc')->get();
		if (count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);
	}			
		
	public function getByDeleted($deleted)
	{
		$respond = array();		
		$category = Category::where('deleted','=', $deleted)->get();
		if (count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);
	}
	
	public function updateFull($id)
	{
		$respond = array();
		$category = Category::find($id);
		if ($category == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$input = json_decode(Input::all());
			
			//validate
			$validator = Validator::make($data = $input, Category::$rules);

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			//save
			try {
				$category->update($data);
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
		$category = Category::find($id);
		if ($category == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$category->delete();
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
		$category = Category::find($id);	
		if ($category == null)
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
