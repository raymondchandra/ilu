<?php

class ProfilesController extends \BaseController {

	/**
	 * Insert a newly created profile in database.
	 *
	 * @return Response
	 */
	public function insert()
	{
		$respond = array();
		//validate
		$validator = Validator::make($data = Input::all(), Profile::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			Profile::create($data);
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}

	/**
	 * Display all of the profile.
	 *
	 * @return Response
	 */
	public function getAll(){
		$respond = array();
		$profile = Profile::all();
		if (count($profile) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$profile);
		}
		return Response::json($respond);
	}
	
	public function getSortedAll($by, $type)
	{
		$respond = array();
		$profile = Profile::orderBy($by, $type)->get();
		if (count($profile) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$profile);
		}
		return Response::json($respond);
	}
	
	public function getFilteredProfile($memberId, $fullName, $profileName, $email)
	{
		$isFirst = false;
		
		if($memberId != '-')
		{
			if($isFirst == false)
			{
				$profiles = Profile::where('member_id', 'LIKE', '%'.$memberId.'%');
				$isFirst = true;
			}
		}
		
		if($fullName != '-')
		{
			if($isFirst == false)
			{
				$profiles = Profile::where('full_name', 'LIKE', '%'.$fullName.'%');
				$isFirst = true;
			}
			else
			{
				$profiles = $profiles->where('full_name', 'LIKE', '%'.$fullName.'%');
			}
		}
		
		if($profileName != '-')
		{
			if($isFirst == false)
			{
				$profiles = Profile::where('name_in_profile', 'LIKE', '%'.$profileName.'%');
				$isFirst = true;
			}
			else
			{
				$profiles = $profiles->where('name_in_profile', 'LIKE', '%'.$profileName.'%');
			}
		}
		
		if($email != '-')
		{
			if($isFirst == false)
			{
				$profiles = Profile::where('email', 'LIKE', '%'.$email.'%');
				$isFirst = true;
			}
			else
			{
				$profiles = $profiles->where('email', 'LIKE', '%'.$email.'%');
			}
		}
		
		if($isFirst == false)
		{
			$profiles = Profile::all();
			$isFirst = true;
		}
		else
		{
			$profiles = $profiles->get();
		}
		
		if (count($profiles) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$profiles);
		}
		return Response::json($respond);
	}
	
	public function getFilteredProfileSorted($memberId, $fullName, $profileName, $email, $sortBy, $sortType)
	{
		$isFirst = false;
		
		if($memberId != '-')
		{
			if($isFirst == false)
			{
				$profiles = Profile::where('member_id', 'LIKE', '%'.$memberId.'%');
				$isFirst = true;
			}
		}
		
		if($fullName != '-')
		{
			if($isFirst == false)
			{
				$profiles = Profile::where('full_name', 'LIKE', '%'.$fullName.'%');
				$isFirst = true;
			}
			else
			{
				$profiles = $profiles->where('full_name', 'LIKE', '%'.$fullName.'%');
			}
		}
		
		if($profileName != '-')
		{
			if($isFirst == false)
			{
				$profiles = Profile::where('name_in_profile', 'LIKE', '%'.$profileName.'%');
				$isFirst = true;
			}
			else
			{
				$profiles = $profiles->where('name_in_profile', 'LIKE', '%'.$profileName.'%');
			}
		}
		
		if($email != '-')
		{
			if($isFirst == false)
			{
				$profiles = Profile::where('email', 'LIKE', '%'.$email.'%');
				$isFirst = true;
			}
			else
			{
				$profiles = $profiles->where('email', 'LIKE', '%'.$email.'%');
			}
		}
		
		if($isFirst == false)
		{
			$profiles = Profile::orderBy($sortBy, $sortType)->get();
			$isFirst = true;
		}
		else
		{
			$profiles = $profiles->orderBy($sortBy, $sortType)->get();
		}
		
		if (count($profiles) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$profiles);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified profile.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getById($id)
	{
		$respond = array();
		$profile = Profile::find($id);
		if (count($profile) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$profile);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified profile by {name}.
	 *
	 * @param  
	 * @return Response
	 */
	/*
	public function getBy{name}()
	{
		$respond = array();
		$profile = Profile::where('','=','')->get();
		if (count($profile) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$profile);
		}
		return Response::json($respond);
	}
	*/

	/**
	 * Update all value of the specified profile in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateFull($id)
	{
		$respond = array();
		$profile = Profile::find($id);
		if ($profile == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//validate
			$validator = Validator::make($data = Input::all(), Profile::$rules);

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			//save
			try {
				$profile->update($data);
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}

	/**
	 * Update {name} value of the specified profile in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*
	public function update{name}($id)
	{
		$respond = array();
		$profile = Profile::find($id);
		if ($profile == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			//$profile-> = ;
			try {
				$profile->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	*/
	
	
	/**
	 * Remove the specified profile from database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$respond = array();
		$profile = Profile::find($id);
		if ($profile == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$profile->delete();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	public function myGetById()
	{
		$id = Input::get('id');
		$respond = array();
		$profile = Profile::find($id);
		if (count($profile) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$profile);
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
	public function exist()
	{
		$respond = array();
		$profile = Profile::where('','=','')->get();
		if (count($profile) >= 0)
		{
			$respond = array('code'=>'200','status' => 'OK');
		}
		else
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		return Response::json($respond);
	}
	*/

}
