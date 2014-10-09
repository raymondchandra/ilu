<?php

class AttributesController extends \BaseController {

	/**
	 * Insert a newly created attribute in database.
	 *
	 * @return Response
	 */
	public function insert()
	{
		$respond = array();
		//validate
		$validator = Validator::make($data = Input::all(), Attribute::$rules);					

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

	/**
	 * Display all of the attribute.
	 *
	 * @return Response
	 */
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
	
	/**
	 * Display all of the attribute.
	 *
	 * @return Response
	 */
	public function getAllNameAsc(){
		$respond = array();
		$attribute = Attribute::all()->orderBy('name')->get();
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
	
	/**
	 * Display all of the attribute.
	 *
	 * @return Response
	 */
	public function getAllNameDesc(){
		$respond = array();
		$attribute = Attribute::all()->orderBy('name', 'desc')->get();
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

	/**
	 * Display the specified attribute.
	 *
	 * @param  int  $id
	 * @return Response
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
	

	/**
	 * Display the specified attribute by {name}.
	 *
	 * @param  
	 * @return Response
	 */
	//ini buat get row by name
	// public function getBy{name}()
	public function getByName($name)
	{
		$respond = array();
		// $attribute = Attribute::where('','=', '')->get();
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
	
	/**
	 * Display the specified attribute by {name}.
	 *
	 * @param  
	 * @return Response
	 */
	//ini buat get row by name
	// public function getBy{name}()
	public function getByNameAsc($name)
	{
		$respond = array();
		// $attribute = Attribute::where('','=', '')->get();
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
	
	/**
	 * Display the specified attribute by {name}.
	 *
	 * @param  
	 * @return Response
	 */
	//ini buat get row by name
	// public function getBy{name}()
	public function getByNameDesc($name)
	{
		$respond = array();
		// $attribute = Attribute::where('','=', '')->get();
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
	
	/**
	 * Update all value of the specified attribute in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */	 	 
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
			//validate
			$validator = Validator::make($data = Input::all(), Attribute::$rules);

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
	

	/**
	 * Update {deleted} value of the specified attribute in database.
	 *
	 * @param  
	 * @return Response
	 */	
	// -----> update deleted search by name
	// public function update{name}()
	public function updateDeleted($id, $new_deleted)
	{
		$respond = array();
		$attribute = Attribute::find($id);		
		if ($attribute == null)
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
		$attribute = Attribute::find($id);
		// $attribute = Attribute::where('name','=', $name)->first();
		if ($attribute == null)
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
	
	/**
	 * Remove the specified attribute from database.
	 *
	 * @param  int  $id
	 * @return Response
	 */	
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
		$attribute = Attribute::find($id);
		// $attribute = Attribute::where('id','=',$id)->first();
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
	*/

}
