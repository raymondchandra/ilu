<?php

class SupportTicketsController extends \BaseController {

	/**
	 * Insert a newly created supportticket in database.
	 *
	 * @return Response
	 */
	public function insert()
	{
		$respond = array();
		//validate
		$validator = Validator::make($data = Input::all(), Supportticket::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			Supportticket::create($data);
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}

	/**
	 * Display all of the supportticket.
	 *
	 * @return Response
	 */
	public function getAll(){
		$respond = array();
		$supportticket = Supportticket::join('accounts', 'supporttickets.account_id', '=', 'accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->select('supporttickets.*','profiles.full_name')->orderBy('updated_at','desc')->get();
		$spr = new SupportMsgsController();
		if (count($supportticket) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
		
			foreach($supportticket as $key){
				$supportmessage = $spr->getByTicket($key->id);
				$key->msgs = $supportmessage;
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$supportticket);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified supportticket.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*public function getById($id)
	{
		$respond = array();
		$supportticket = Supportticket::find($id);
		if (count($supportticket) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$supportticket);
		}
		return Response::json($respond);
	}*/
	
	public function getById($id){
		
	}

	/**
	 * Display the specified supportticket by {name}.
	 *
	 * @param  
	 * @return Response
	 */
	/*
	public function getBy{name}()
	{
		$respond = array();
		$supportticket = Supportticket::where('','=','')->get();
		if (count($supportticket) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$supportticket);
		}
		return Response::json($respond);
	}
	*/

	/**
	 * Update all value of the specified supportticket in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	 
	 
	public function updateFull($id)
	{
		$respond = array();
		$supportticket = Supportticket::find($id);
		if ($supportticket == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//validate
			$validator = Validator::make($data = Input::all(), Supportticket::$rules);

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			//save
			try {
				$supportticket->update($data);
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}

	/**
	 * Update {name} value of the specified supportticket in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*
	public function update{name}($id)
	{
		$respond = array();
		$supportticket = Supportticket::find($id);
		if ($supportticket == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			//$supportticket-> = ;
			try {
				$supportticket->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	*/
	
	public function update_solve(){
		$json = Input::get('json_data');
		$decode = json_decode($json);
		$id = $decode->{'id'};
		$ticket_message = SupportTicket::find($id);
		if(count($ticket_message) == 1){
			$ticket_message->solved = 1;
			try{
				$ticket_message->save();
				$respond = array('code'=>'200','status' => 'OK');
			}
			catch(Exception $e){
				$respond = array('code'=>'500','status' => 'Internal Server Error');
			}
		}
		else{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		return Response::json($respond);
	}
	
	
	/**
	 * Remove the specified supportticket from database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$respond = array();
		$supportticket = Supportticket::find($id);
		if ($supportticket == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$supportticket->delete();
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
		$supportticket = Supportticket::where('','=','')->get();
		if (count($supportticket) >= 0)
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
