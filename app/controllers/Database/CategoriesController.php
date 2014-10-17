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
	// input : parent_category kalo kosong maka -1
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
				
		// save
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
			foreach($category as $key)
			{
				if($key->parent_category == -1) // ga ada parent_category
				{
					$key->parent_name = "";
				}
				else
				{					
					$key->parent_name = Category::find($key->parent_category)->name;
				}				
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);
	}	
	
	public function getAllSortedIdAsc(){
		$respond = array();
		$category = Category::all();
		if (count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($category as $key)
			{
				if($key->parent_category == -1) // ga ada parent_category
				{
					$key->parent_name = "";
				}
				else
				{					
					$key->parent_name = Category::find($key->parent_category)->name;
				}				
			}
			
			// sorting
			$category = $category->orderBy('id')->get();
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedIdDesc(){
		$respond = array();
		$category = Category::all();
		if (count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($category as $key)
			{
				if($key->parent_category == -1) // ga ada parent_category
				{
					$key->parent_name = "";
				}
				else
				{					
					$key->parent_name = Category::find($key->parent_category)->name;
				}				
			}
			
			// sorting
			$category = $category->orderBy('id', 'desc')->get();
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedNameAsc(){
		$respond = array();
		$category = Category::all();
		if (count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($category as $key)
			{
				if($key->parent_category == -1) // ga ada parent_category
				{
					$key->parent_name = "";
				}
				else
				{					
					$key->parent_name = Category::find($key->parent_category)->name;
				}				
			}
			
			// sorting
			$category = $category->orderBy('name')->get();
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedIdNameDesc(){
		$respond = array();
		$category = Category::all();
		if (count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($category as $key)
			{
				if($key->parent_category == -1) // ga ada parent_category
				{
					$key->parent_name = "";
				}
				else
				{					
					$key->parent_name = Category::find($key->parent_category)->name;
				}				
			}
			
			// sorting
			$category = $category->orderBy('name', 'desc')->get();
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedParentNameAsc(){
		$respond = array();
		$category = Category::all();
		if (count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($category as $key)
			{
				if($key->parent_category == -1) // ga ada parent_category
				{
					$key->parent_name = "";
				}
				else
				{					
					$key->parent_name = Category::find($key->parent_category)->name;
				}				
			}
			
			// sorting
			$category = $category->orderBy('parent_name')->get();
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedParentNameDesc(){
		$respond = array();
		$category = Category::all();
		if (count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($category as $key)
			{
				if($key->parent_category == -1) // ga ada parent_category
				{
					$key->parent_name = "";
				}
				else
				{					
					$key->parent_name = Category::find($key->parent_category)->name;
				}				
			}
			
			// sorting
			$category = $category->orderBy('parent_name', 'desc')->get();
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);
	}
	
	// asumsi : 
		// kalo field input integer ada yang kosong maka -1
		// kalo field input string ada yang kosong maka dapetnya ""
	// input : id, name, parent_name	
	//return tambahan : parent_name
	public function searchCategory($input)
	{
		$respond = array();
		$category = Categories::where('name', 'LIKE', '%'.$input['name'].'%')->get();
		
		$parent_category = Categories::where('name', 'LIKE', '%'.$input['parent_name'].'%')->get();
		if(count($parent_category) != 0)
		{
			$category = $category->join($parent_category, $category->parent_category, '=', $parent_category->id);
		}
		
		if(count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($category as $key)
			{
				if($key->parent_category == -1) // ga ada parent_category
				{
					$key->parent_name = "";
				}
				else
				{					
					$key->parent_name = Category::find($key->parent_category)->name;
				}				
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);		
	}
	
	public function searchCategorySortedIdAsc($input)
	{
		$respond = array();
		$category = Categories::where('name', 'LIKE', '%'.$input['name'].'%')->get();
		
		$parent_category = Categories::where('name', 'LIKE', '%'.$input['parent_name'].'%')->get();
		if(count($parent_category) != 0)
		{
			$category = $category->join($parent_category, $category->parent_category, '=', $parent_category->id);
		}
		
		if(count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($category as $key)
			{
				if($key->parent_category == -1) // ga ada parent_category
				{
					$key->parent_name = "";
				}
				else
				{					
					$key->parent_name = Category::find($key->parent_category)->name;
				}				
			}
			
			// sorting
			$category = $category->orderBy('id')->get();
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);		
	}
	
	public function searchCategorySortedIdDesc($input)
	{
		$respond = array();
		$category = Categories::where('name', 'LIKE', '%'.$input['name'].'%')->get();
		
		$parent_category = Categories::where('name', 'LIKE', '%'.$input['parent_name'].'%')->get();
		if(count($parent_category) != 0)
		{
			$category = $category->join($parent_category, $category->parent_category, '=', $parent_category->id);
		}
		
		if(count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($category as $key)
			{
				if($key->parent_category == -1) // ga ada parent_category
				{
					$key->parent_name = "";
				}
				else
				{					
					$key->parent_name = Category::find($key->parent_category)->name;
				}				
			}
			
			// sorting
			$category = $category->orderBy('id', 'desc')->get();
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);		
	}
	
	public function searchCategorySortedNameAsc($input)
	{
		$respond = array();
		$category = Categories::where('name', 'LIKE', '%'.$input['name'].'%')->get();
		
		$parent_category = Categories::where('name', 'LIKE', '%'.$input['parent_name'].'%')->get();
		if(count($parent_category) != 0)
		{
			$category = $category->join($parent_category, $category->parent_category, '=', $parent_category->id);
		}
		
		if(count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($category as $key)
			{
				if($key->parent_category == -1) // ga ada parent_category
				{
					$key->parent_name = "";
				}
				else
				{					
					$key->parent_name = Category::find($key->parent_category)->name;
				}				
			}
			
			// sorting
			$category = $category->orderBy('name')->get();
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);		
	}
	
	public function searchCategorySortedNameDesc($input)
	{
		$respond = array();
		$category = Categories::where('name', 'LIKE', '%'.$input['name'].'%')->get();
		
		$parent_category = Categories::where('name', 'LIKE', '%'.$input['parent_name'].'%')->get();
		if(count($parent_category) != 0)
		{
			$category = $category->join($parent_category, $category->parent_category, '=', $parent_category->id);
		}
		
		if(count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($category as $key)
			{
				if($key->parent_category == -1) // ga ada parent_category
				{
					$key->parent_name = "";
				}
				else
				{					
					$key->parent_name = Category::find($key->parent_category)->name;
				}				
			}
			
			// sorting
			$category = $category->orderBy('name', 'desc')->get();
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);		
	}
	
	public function searchCategorySortedParentNameAsc($input)
	{
		$respond = array();
		$category = Categories::where('name', 'LIKE', '%'.$input['name'].'%')->get();
		
		$parent_category = Categories::where('name', 'LIKE', '%'.$input['parent_name'].'%')->get();
		if(count($parent_category) != 0)
		{
			$category = $category->join($parent_category, $category->parent_category, '=', $parent_category->id);
		}
		
		if(count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($category as $key)
			{
				if($key->parent_category == -1) // ga ada parent_category
				{
					$key->parent_name = "";
				}
				else
				{					
					$key->parent_name = Category::find($key->parent_category)->name;
				}				
			}
			
			// sorting
			$category = $category->orderBy('parent_name')->get();
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$category);
		}
		return Response::json($respond);		
	}
	
	public function searchCategorySortedParentNameDesc($input)
	{
		$respond = array();
		$category = Categories::where('name', 'LIKE', '%'.$input['name'].'%')->get();
		
		$parent_category = Categories::where('name', 'LIKE', '%'.$input['parent_name'].'%')->get();
		if(count($parent_category) != 0)
		{
			$category = $category->join($parent_category, $category->parent_category, '=', $parent_category->id);
		}
		
		if(count($category) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($category as $key)
			{
				if($key->parent_category == -1) // ga ada parent_category
				{
					$key->parent_name = "";
				}
				else
				{					
					$key->parent_name = Category::find($key->parent_category)->name;
				}				
			}
			
			// sorting
			$category = $category->orderBy('parent_name', 'desc')->get();
			
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
		
	//update name, parent_category	
	public function updateFull($id, $new_name, $new_parent_category) 
	{
		$respond = array();
		$category = Category::find($id);
		if ($category == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$category->name = $new_name;
			$category->parent_category = $new_parent_category;
			try {
				$category->save();
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
		$category = Category::find($id);
		if($category == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$category->deleted = $new_deleted;
			try {
				$category->save();
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
