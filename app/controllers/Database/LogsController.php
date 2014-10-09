<?php

class LogsController extends \BaseController {

	/**
	 * Insert a newly created log in database.
	 *
	 * @return Response
	 */
	public function insert()
	{
		$respond = array();
		//validate
		$validator = Validator::make($data = Input::all(), Logs::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			Logs::create($data);
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}

	/**
	 * Display all of the log.
	 *
	 * @return Response
	 */
	public function getAll(){
		$respond = array();
		$log = Logs::all();
		if (count($log) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$log);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified log.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getById($id)
	{
		$respond = array();
		$log = Logs::find($id);
		if (count($log) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$log);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified log by {name}.
	 *
	 * @param  
	 * @return Response
	 */
	/*
	public function getBy{name}()
	{
		$respond = array();
		$log = Log::where('','=','')->get();
		if (count($log) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$log);
		}
		return Response::json($respond);
	}
	*/

	/**
	 * Update all value of the specified log in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateFull($id)
	{
		$respond = array();
		$log = Logs::find($id);
		if ($log == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//validate
			$validator = Validator::make($data = Input::all(), Logs::$rules);

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			//save
			try {
				$log->update($data);
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}

	/**
	 * Update {name} value of the specified log in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*
	public function update{name}($id)
	{
		$respond = array();
		$log = Logs::find($id);
		if ($log == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			//$log-> = ;
			try {
				$log->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	*/
	
	
	/**
	 * Remove the specified log from database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$respond = array();
		$log = Logs::find($id);
		if ($log == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$log->delete();
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
		$log = Log::where('','=','')->get();
		if (count($log) >= 0)
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
	 * Creating log based on user action.
	 *
	 * @param
	 * 		acc_id int
	 * 		action varchar (c/r/u/d)
	 * 		table_affected varchar
	 * 		purpose varchar
	 * 		main_param varchar
	 * @return Response
	 */
	public static function createLog($acc_id, $action, $table_affected, $purpose, $main_param)
	{
		$log = new Logs();
		$log->account_id = $acc_id;
		$log->text_log = $action." @ ".$table_affected;
		$log->description = $purpose." on ".$main_param;

		try
		{
			$log->save();
			$respond = array('code'=>'200','status' => 'OK');
		}
		catch(Exception $e)
		{
			$respond = array('code'=>'404','status' => 'Not Found','error' => $e);
		}

		return Response::json($respond);
	}
	
	
	
	public static function getLogByKey($key, $id)
	{
		$log = Logs::where('description','LIKE',$key."%")->get();
		$respond=array('code' => '200', 'status' => 'OK', 'messages' => $log);
		
		//return json_encode($respond);
		return Response::json($respond);
	}

}
