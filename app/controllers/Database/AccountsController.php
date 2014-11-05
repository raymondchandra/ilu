<?php

class AccountsController extends \BaseController {

	/**
	 * Insert a newly created account in database.
	 *
	 * @return Response
	 */
	public function insert()
	{
		$respond = array();
		//validate
		$validator = Validator::make($data = Input::all(), Account::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			Account::create($data);
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}

	/**
	 * Display all of the account.
	 *
	 * @return Response
	 */
	public function getAll(){
		$respond = array();
		$account = Account::all();
		if (count($account) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$account);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified account.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getById($id)
	{
		$respond = array();
		$account = Account::find($id);
		if (count($account) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$account);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified account by {name}.
	 *
	 * @param  
	 * @return Response
	 */
	/*
	public function getBy{name}()
	{
		$respond = array();
		$account = Account::where('','=','')->get();
		if (count($account) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$account);
		}
		return Response::json($respond);
	}
	*/

	/**
	 * Update all value of the specified account in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateFull($id)
	{
		$respond = array();
		$account = Account::find($id);
		if ($account == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//validate
			$validator = Validator::make($data = Input::all(), Account::$rules);

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			//save
			try {
				$account->update($data);
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}

	/**
	 * Update {name} value of the specified account in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*
	public function update{name}($id)
	{
		$respond = array();
		$account = Account::find($id);
		if ($account == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			//$account-> = ;
			try {
				$account->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	*/
	
	
	/**
	 * Remove the specified account from database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$respond = array();
		$account = Account::find($id);
		if ($account == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$account->delete();
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
	public function exist()
	{
		$respond = array();
		$account = Account::where('','=','')->get();
		if (count($account) >= 0)
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
	
	/**
	 * Login attempt for administrator(role = 1)
	 *
	 * @param
	 * 		$id string
	 *		$password string
	 *		$remember_me yes/no
	 * @return Response
	 */
	public function adminLogin()
	{
		$json = Input::get('json');
		$jsonContent = json_decode($json);
		$username = $jsonContent->{'username'};
		$password = $jsonContent->{'password'};
		//return $password;
		$data = array('username'=>$username, 'password'=>$password);
		if(Auth::attempt($data))
		{	
			if(Auth::user()->active == 1)
			{
				if(Auth::user()->role == 1)
				{					
					$respond = array('code'=>'200','status' => 'OK');
				}
				else
				{
					$respond = array('code'=>'401','status' => 'Unauthorized');
				}
			}
			else
			{
				Auth::logout();
				$respond = array('code'=>'401','status' => 'Unauthorized');
			}
		}
		else
		{
			$respond = array('code'=>'401','status' => 'Unauthorized');
		}
		
		return Response::json($respond);
	}
	
	/**
	 * Login attempt for user(role = 0)
	 *
	 * @param
	 * 		$id string
	 *		$password string
	 *		$remember_me yes/no
	 * @return Response
	 */
	public function userLogin($json)
	{
		//$id, $password,$remember_me
		$json = Input::get('json');
		$jsonContent = json_decode($json);
		$username = $jsonContent->{'username'};
		$password = $jsonContent->{'password'};
		$data = array('username'=>$username, 'password'=>$password);
		if(Auth::attempt($data))
		{
			if(Auth::user()->active == 1)
			{
				if(Auth::user()->role == 0)
				{					
					$respond = array('code'=>'200','status' => 'OK');
				}
				else
				{
					$respond = array('code'=>'401','status' => 'Unauthorized');
				}
			}
			else
			{
				Auth::logout();
				$respond = array('code'=>'401','status' => 'Unauthorized');
			}
		}
		
		return Response::json($respond);
	}
	
	public function postLogout()
	{
		Auth::logout();
		Session::flush();
		return Redirect::route('ilu.main.login');
	}
	
	/**
	 * Generating accessToken for user
	 *
	 * @param
	 * 		$id string
	 *		$username string
	 *		$role yes/no
	 * @return accTok string
	 */
	 public function generateAccessToken($id, $username, $role)
	 {
		$temp_str = $id.$username.$role;
		$accTok = md5($temp_str);
		
		return $accTok;
	 }
	 
	public function changeActive()
	{
		$id = Input::get('id');
		
		$account = Account::where('profile_id','=',$id)->first();
		
		if($account->active == 1)
		{
			$account->active = 0;
		}
		else
		{
			$account->active = 1;
		}
		
		try
		{
			$account->save();
			$respond = array('code'=>'200','status' => 'OK','messages'=>$account);
		}
		catch(Exception $e)
		{
			$respond = array('code'=>'400','status' => 'NOK');
		}
		
		return Response::json($respond);
	}
	 
	 /**
	 * Checking accesstoken for user
	 *
	 * @param
	 *	    $accTok string
	 * 		$id string
	 *		$username string
	 *		$role string(yes/no)
	 * @return Response
	 */
	public function checkAccTok($accTok,$id, $username, $role)
	{
		$temp_str = $id.$username.$role;
		$accToken = md5($temp_str);
		if($accToken === $accTok)
		{
			$respond = array('code'=>'200','status' => 'OK');
		}
		else
		{
			$respond = array('code'=>'500','status' => 'NOK');
		}
		return $respond;
	}
	
	public function getProfileByAccountId($accId)
	{
		$profileId = Account::where('id', '=', $accId)->first();
		if($profileId == null)
		{
			$respond = array('code'=>'500','status' => 'Not Found');
		}
		else
		{
			$profController = new ProfilesController();
			$message = Profile::find($profileId->profile_id);
			$respond = array('code'=>'200','status' => 'OK','messages'=>$message);
		}
		return Response::json($respond);
	}

}
