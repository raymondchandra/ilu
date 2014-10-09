<?php

class CategoriesController extends \BaseController {

	/**
	 * Insert a newly created category in database.
	 *
	 * @return Response
	 */
	public function insert()
	{
		$respond = array();
		//validate
		$validator = Validator::make($data = Input::all(), Category::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			Category::create($data);
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}

	/**
	 * Display all of the category.
	 *
	 * @return Response
	 */
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

	/**
	 * Display all of the category.
	 *
	 * @return Response
	 */
	public function getAllNameAsc(){
		$respond = array();
		$category = Category::all()->orderBy('name')->get();
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
	
	/**
	 * Display all of the category.
	 *
	 * @return Response
	 */
	public function getAllNameDesc(){
		$respond = array();
		$category = Category::all()->orderBy('name', 'desc')->get();
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
	
	/**
	 * Display the specified category.
	 *
	 * @param  int  $id
	 * @return Response
	 */
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

	/**
	 * Display the specified category by {name}.
	 *
	 * @param  
	 * @return Response
	 */	
	 //ini buat get row by name
	// public function getBy{name}()
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

	/**
	 * Display the specified category by {name}.
	 *
	 * @param  
	 * @return Response
	 */	
	 //ini buat get row by name
	// public function getBy{name}()
	public function getByNameAsc($name)
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
	
	/**
	 * Display the specified category by {name}.
	 *
	 * @param  
	 * @return Response
	 */	
	 //ini buat get row by name
	// public function getBy{name}()
	public function getByNameDesc($name)
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
	
	/**
	 * Display the specified attribute by {deleted}.
	 *
	 * @param  
	 * @return Response
	 */
	//ini buat get row by deleted status
	// public function getBy{deleted}()
	public function getByDeleted($deleted)
	{
		$respond = array();
		// $attribute = Attribute::where('','=', '')->get();
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
	
	/**
	 * Display the specified attribute by {deleted}.
	 *
	 * @param  
	 * @return Response
	 */
	//ini buat get row by parentcategory status
	// public function getBy{parentcategory}()
	public function getByParentCategory($parent_category)
	{
		$respond = array();
		// $attribute = Attribute::where('','=', '')->get();
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
	
	/**
	 * Update all value of the specified category in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
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
			//validate
			$validator = Validator::make($data = Input::all(), Category::$rules);

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

	/**
	 * Update {deleted} value of the specified category in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */	
	 // -----> update deleted search by name
	public function updateDeleted($id, $new_deleted)
	{
		$respond = array();
		$category = Category::find($id);
		// $category = Category::where('name','=',$name)->first();
		if ($category == null)
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
	
	/**
	 * Update {name} value of the specified attribute in database.
	 *
	 * @param  
	 * @return Response
	 */	
	// -----> update name search by name
	// public function update{deleted}()
	public function updateName($id, $new_name)
	{
		$respond = array();
		$category = Category::find($id);
		// $category = category::where('name','=', $name)->first();
		if ($category == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$category->name = $new_name;
			try {
				$category->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	/**
	 * Update {name} value of the specified attribute in database.
	 *
	 * @param  
	 * @return Response
	 */	
	// -----> update name search by name
	// public function update{deleted}()
	public function updateParentCategory($id, $new_parent_category)
	{
		$respond = array();
		$category = Category::find($id);
		// $category = category::where('name','=', $name)->first();
		if ($category == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
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
	
	/**
	 * Remove the specified category from database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
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

	/**
	 * Check if row exist in database.
	 *
	 * @param  
	 * @return Response
	 */	
	 /*
	public function exist($id)
	{
		$respond = array();
		$category = Category::find($id);
		// $category = Category::where('','=','')->get();
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
	*/

}
