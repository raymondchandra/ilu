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
	
	//reverse array
	public function reverse($arr)
	{
		$lastIdx = count($arr)-1;
		$reserve = array();
		while($lastIdx >= 0)
		{
			$reverse[] = $arr[$lastIdx];
			$lastIdx--;
		}
		return $reverse;
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
		$category = Category::orderBy('id')->get();
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
	
	public function getAllSortedIdDesc(){
		$respond = array();
		$category = Category::orderBy('id', 'desc')->get();
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
	
	public function getAllSortedNameAsc(){
		$respond = array();
		$category = Category::orderBy('name')->get();
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
	
	public function getAllSortedIdNameDesc(){
		$respond = array();
		$category = Category::orderBy('name', 'desc')->get();
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
			$category = array_values(
						array_sort(
							$category, function($value)
							{
								return $value['parent_name'];
							}
						)
					);			
			
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
			$category = array_values(
						array_sort(
							$category, function($value)
							{
								return $value['parent_name'];
							}
						)
					);	
			//reverse
			$category = $this->reverse($category);
			
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
		$category = Category::where('name', 'LIKE', '%'.$input['name'].'%');
		
		if($input['id'] != -1)
		{
			$category = $category->where('id', '=', $input['id']);
		}
		
		$category = $category->get();
		//set parent name
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
		
		$result = array();
		//search by parent_name		
		if($input['parent_name'] != "")
		{					
			foreach($category as $key)
			{
				$pos = strpos($key->parent_name, $input['parent_name']);
				if($pos !== false)
				{
					$result[] = $key;
				}
			}
		}
		else
		{
			$result = $category;
		}
		
		if(count($result) == 0)
		{
			$respond = array('code'=>'404','status'=>'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$result);
		}
		
		return Response::json($respond);		
	}
	
	public function test()
	{
		// $bank = Bank::all();
		// foreach($bank as $key)
		// {
			// $key->parent_name = "asdad";
		// }
		// $bank = array();
		// return count($bank);
				
		// $aa = "asdasd";
		// $bb = "a";
		
		// $pos = strpos($aa, $bb);
		// if($pos !== false)
		// {
			// return "success";
		// }
		// else
		// {
			// return "fail";
		// }
		
		
		// $category = Category::where('name', '=', 'xxx');
		// $category = $category->orderBy('name')->get();
		
		// return $category;
		
		$input = array(
				'name' => 'namaasdasd',
				'amount' => 'amountasda');
		$input['deleted'] = 'deleted';		
		
		return $input;
	}
	
	/*
	public function test()
	{				
		// $category = Category::orderBy('id', 'desc');
		// $category = Category::all();
		// $category = Category::all();		
		// $temp = array();
			// foreach($category as $key)
			// {
				// $temp[] = $key;
			// }
					
		// $category = $category->orderBy('parent_category')->get();
		// $category = array_sort($category, 'parent_category', SORT_DESC);
		// usort($temp, $this->cmp());	
		// array_sort($category);
		
		// $category = array_values(
						// array_sort(
							// $category, function($value)
							// {
								// return $value['name'];
							// }
						// )
					// );
		// $category = $category->orderBy('id', 'asc')->get();
		// $category = $category->where('name', 'LIKE', '%'.'nama'.'%')->orderBy('id')->get();
		
		$category = DB::table('categories')->get();
		foreach($category as $key)
		{
			$key->parent_name = "name category";
		}
		// foreach($category as $key)
		// {
			// $key->xxx = "ccccc";
		// }		
		
		// $category = $category->orderBy('xxx')->get();
		
		$category = $this->reverse($category);
		
		return $category;
	}	
	*/
	
	public function searchCategorySortedIdAsc($input)
	{
		$respond = array();				
		$category = Category::where('name', 'LIKE', '%'.$input['name'].'%');
		
		if($input['id'] != -1)
		{
			$category = $category->where('id', '=', $input['id']);
		}
		
		$category = $category->get();
		//set parent name
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
		
		$result = array();
		//search by parent_name		
		if($input['parent_name'] != "")
		{					
			foreach($category as $key)
			{
				$pos = strpos($key->parent_name, $input['parent_name']);
				if($pos !== false)
				{
					$result[] = $key;
				}
			}
		}
		else
		{
			$result = $category;
		}
		
		if(count($result) == 0)
		{
			$respond = array('code'=>'404','status'=>'Not Found');
		}
		else
		{
			//sorting
			$result = array_values(
						array_sort(
							$result, function($value)
							{
								return $value['id'];
							}
						)
					);	
			$respond = array('code'=>'200','status' => 'OK','messages'=>$result);
		}
		
		return Response::json($respond);			
	}
	
	public function searchCategorySortedIdDesc($input)
	{
		$respond = array();				
		$category = Category::where('name', 'LIKE', '%'.$input['name'].'%');
		
		if($input['id'] != -1)
		{
			$category = $category->where('id', '=', $input['id']);
		}
		
		$category = $category->get();
		//set parent name
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
		
		$result = array();
		//search by parent_name		
		if($input['parent_name'] != "")
		{					
			foreach($category as $key)
			{
				$pos = strpos($key->parent_name, $input['parent_name']);
				if($pos !== false)
				{
					$result[] = $key;
				}
			}
		}
		else
		{
			$result = $category;
		}
		
		if(count($result) == 0)
		{
			$respond = array('code'=>'404','status'=>'Not Found');
		}
		else
		{
			//sorting
			$result = array_values(
						array_sort(
							$result, function($value)
							{
								return $value['id'];
							}
						)
					);	
			//reverse
			$result = $this->reverse($result);
			$respond = array('code'=>'200','status' => 'OK','messages'=>$result);
		}
		
		return Response::json($respond);
	}
	
	public function searchCategorySortedNameAsc($input)
	{
		$respond = array();				
		$category = Category::where('name', 'LIKE', '%'.$input['name'].'%');
		
		if($input['id'] != -1)
		{
			$category = $category->where('id', '=', $input['id']);
		}
		
		$category = $category->get();
		//set parent name
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
		
		$result = array();
		//search by parent_name		
		if($input['parent_name'] != "")
		{					
			foreach($category as $key)
			{
				$pos = strpos($key->parent_name, $input['parent_name']);
				if($pos !== false)
				{
					$result[] = $key;
				}
			}
		}
		else
		{
			$result = $category;
		}
		
		if(count($result) == 0)
		{
			$respond = array('code'=>'404','status'=>'Not Found');
		}
		else
		{
			//sorting
			$result = array_values(
						array_sort(
							$result, function($value)
							{
								return $value['name'];
							}
						)
					);	
			$respond = array('code'=>'200','status' => 'OK','messages'=>$result);
		}
		
		return Response::json($respond);	
	}
	
	public function searchCategorySortedNameDesc($input)
	{
		$respond = array();				
		$category = Category::where('name', 'LIKE', '%'.$input['name'].'%');
		
		if($input['id'] != -1)
		{
			$category = $category->where('id', '=', $input['id']);
		}
		
		$category = $category->get();
		//set parent name
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
		
		$result = array();
		//search by parent_name		
		if($input['parent_name'] != "")
		{					
			foreach($category as $key)
			{
				$pos = strpos($key->parent_name, $input['parent_name']);
				if($pos !== false)
				{
					$result[] = $key;
				}
			}
		}
		else
		{
			$result = $category;
		}
		
		if(count($result) == 0)
		{
			$respond = array('code'=>'404','status'=>'Not Found');
		}
		else
		{
			//sorting
			$result = array_values(
						array_sort(
							$result, function($value)
							{
								return $value['name'];
							}
						)
					);	
			//reverse
			$result = $this->reverse($result);
			$respond = array('code'=>'200','status' => 'OK','messages'=>$result);
		}
		
		return Response::json($respond);		
	}
	
	public function searchCategorySortedParentNameAsc($input)
	{
		$respond = array();				
		$category = Category::where('name', 'LIKE', '%'.$input['name'].'%');
		
		if($input['id'] != -1)
		{
			$category = $category->where('id', '=', $input['id']);
		}
		
		$category = $category->get();
		//set parent name
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
		
		$result = array();
		//search by parent_name		
		if($input['parent_name'] != "")
		{					
			foreach($category as $key)
			{
				$pos = strpos($key->parent_name, $input['parent_name']);
				if($pos !== false)
				{
					$result[] = $key;
				}
			}
		}
		else
		{
			$result = $category;
		}
		
		if(count($result) == 0)
		{
			$respond = array('code'=>'404','status'=>'Not Found');
		}
		else
		{
			//sorting
			$result = array_values(
						array_sort(
							$result, function($value)
							{
								return $value['parent_name'];
							}
						)
					);	
			$respond = array('code'=>'200','status' => 'OK','messages'=>$result);
		}
		
		return Response::json($respond);
	}
	
	public function searchCategorySortedParentNameDesc($input)
	{
		$respond = array();				
		$category = Category::where('name', 'LIKE', '%'.$input['name'].'%');
		
		if($input['id'] != -1)
		{
			$category = $category->where('id', '=', $input['id']);
		}
		
		$category = $category->get();
		//set parent name
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
		
		$result = array();
		//search by parent_name		
		if($input['parent_name'] != "")
		{					
			foreach($category as $key)
			{
				$pos = strpos($key->parent_name, $input['parent_name']);
				if($pos !== false)
				{
					$result[] = $key;
				}
			}
		}
		else
		{
			$result = $category;
		}
		
		if(count($result) == 0)
		{
			$respond = array('code'=>'404','status'=>'Not Found');
		}
		else
		{
			//sorting
			$result = array_values(
						array_sort(
							$result, function($value)
							{
								return $value['parent_name'];
							}
						)
					);	
			//reverse
			$result = $this->reverse($result);
			$respond = array('code'=>'200','status' => 'OK','messages'=>$result);
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
