<?php

class ShipmentsController extends \BaseController {

	/**
	 * Insert a newly created shipment in database.
	 *
	 * @return Response
	 */
	public function insert()
	{
		$respond = array();
		//validate
		$validator = Validator::make($data = Input::all(), Shipment::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			Shipment::create($data);
			$idCreate  = $data->id;
			$respond = array('code'=>'201','status' => 'Created','messages'=>$idCreate);
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}

	/**
	 * Update status (pending, on progress, sent)
	 *
	 * @param  int  $id, $status
	 * @return Response
	 */
	public function updateStatus()
	{
		$id = Input::get('id');
		$status = Input::get('status');
		$respond = array();
		$transaction = Transaction::where('shipment_id','=',$id)->first();
		if ($transaction == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$transaction ->status = $status;
			try {
				$transaction->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	/**
	 * Display all of the shipment.
	 *
	 * @return Response
	 */
	public function getAll(){
		$respond = array();
		$shipment = Shipment::join('shipmentdatas', 'shipments.shipmentData_id', '=', 'shipmentdatas.id')->join('transactions', 'shipments.id', '=', 'transactions.shipment_id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->where('shipmentdatas.deleted', '=', '0')->get(array('shipments.id', 'shipments.number', 'shipmentdatas.courier', 'shipmentdatas.destination', 'shipmentdatas.price', 'transactions.status', 'profiles.full_name'));
		if (count($shipment) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$shipment);
		}
		return Response::json($respond);
	}

	/**
	 * Display all of the shipment sorting
	 * @return Response
	 */
	public function getAllSort($sortBy, $type)
	{
		$respond = array();
		$shipment = Shipment::join('shipmentdatas', 'shipments.shipmentData_id', '=', 'shipmentdatas.id')->join('transactions', 'shipments.id', '=', 'transactions.shipment_id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->where('shipmentdatas.deleted', '=', '0')->orderBy($sortBy, $type)->get(array('shipments.id', 'shipments.number', 'shipmentdatas.courier', 'shipmentdatas.destination', 'shipmentdatas.price', 'transactions.status', 'profiles.full_name'));
		
		if (count($shipment) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$shipment);
		}
		return Response::json($respond);
	}
	
	/**
	 * Filter shipment
	 *
	 * @return Response
	 */
	public function getFilteredShipment($noPengiriman, $kurir, $destinasi, $namaPenerima, $hargaPengiriman, $status)
	{
		$isFirst = false;
		
		if($noPengiriman != '-')
		{
			if($isFirst == false)
			{
				$shipment = Shipment::join('shipmentdatas', 'shipments.shipmentData_id', '=', 'shipmentdatas.id')->join('transactions', 'shipments.id', '=', 'transactions.shipment_id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->where('shipmentdatas.deleted', '=', '0')->where('number', 'LIKE', '%'.$noPengiriman.'%');
				$isFirst = true;
			}
		}	
		
		if($kurir != '-')
		{
			if($isFirst == false)
			{
				$shipment = Shipment::join('shipmentdatas', 'shipments.shipmentData_id', '=', 'shipmentdatas.id')->join('transactions', 'shipments.id', '=', 'transactions.shipment_id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->where('shipmentdatas.deleted', '=', '0')->where('courier', 'LIKE', '%'.$kurir.'%');
				$isFirst = true;
			}
			else
			{
				$shipment = $shipment->where('courier', 'LIKE', '%'.$kurir.'%');
			}
		}
		
		if($destinasi != '-')
		{
			if($isFirst == false)
			{
				$shipment = Shipment::join('shipmentdatas', 'shipments.shipmentData_id', '=', 'shipmentdatas.id')->join('transactions', 'shipments.id', '=', 'transactions.shipment_id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->where('shipmentdatas.deleted', '=', '0')->where('destination', 'LIKE', '%'.$destinasi.'%');
				$isFirst = true;
			}
			else
			{
				$shipment = $shipment->where('destination', 'LIKE', '%'.$destinasi.'%');
			}
		}
		
		if($namaPenerima != '-')
		{
			if($isFirst == false)
			{
				$shipment = Shipment::join('shipmentdatas', 'shipments.shipmentData_id', '=', 'shipmentdatas.id')->join('transactions', 'shipments.id', '=', 'transactions.shipment_id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->where('shipmentdatas.deleted', '=', '0')->where('full_name', 'LIKE', '%'.$namaPenerima.'%');
				$isFirst = true;
			}
			else
			{
				$shipment = $shipment->where('full_name', 'LIKE', '%'.$namaPenerima.'%');
			}
		}
		
		if($hargaPengiriman != '-')
		{
			if($isFirst == false)
			{
				$shipment = Shipment::join('shipmentdatas', 'shipments.shipmentData_id', '=', 'shipmentdatas.id')->join('transactions', 'shipments.id', '=', 'transactions.shipment_id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->where('shipmentdatas.deleted', '=', '0')->where('price', 'LIKE', '%'.$hargaPengiriman.'%');
				$isFirst = true;
			}
			else
			{
				$shipment = $shipment->where('price', 'LIKE', '%'.$hargaPengiriman.'%');
			}
		}
		
		if($status != '-')
		{
			if($isFirst == false)
			{
				$shipment = Shipment::join('shipmentdatas', 'shipments.shipmentData_id', '=', 'shipmentdatas.id')->join('transactions', 'shipments.id', '=', 'transactions.shipment_id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->where('shipmentdatas.deleted', '=', '0')->where('status', 'LIKE', '%'.$status.'%');
				$isFirst = true;
			}
			else
			{
				$shipment = $shipment->where('status', 'LIKE', '%'.$status.'%');
			}
		}
		
		if($isFirst == false)
		{
			$shipment = Shipment::join('shipmentdatas', 'shipments.shipmentData_id', '=', 'shipmentdatas.id')->join('transactions', 'shipments.id', '=', 'transactions.shipment_id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->where('shipmentdatas.deleted', '=', '0')->get(array('shipments.id', 'shipments.number', 'shipmentdatas.courier', 'shipmentdatas.destination', 'shipmentdatas.price', 'transactions.status', 'profiles.full_name'));
			$isFirst = true;
		}
		else
		{
			$shipment = $shipment->get(array('shipments.id', 'shipments.number', 'shipmentdatas.courier', 'shipmentdatas.destination', 'shipmentdatas.price', 'transactions.status', 'profiles.full_name'));
		}
		
		if (count($shipment) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$shipment);
		}
		return Response::json($respond);
	}
	
	/**
	 * Filter shipment sort
	 *
	 * @return Response
	 */
	public function getFilteredShipmentSort($noPengiriman, $kurir, $destinasi, $namaPenerima, $hargaPengiriman, $status,  $sortBy, $sortType)
	{
		$isFirst = false;
		
		if($noPengiriman != '-')
		{
			if($isFirst == false)
			{
				$shipment = Shipment::join('shipmentdatas', 'shipments.shipmentData_id', '=', 'shipmentdatas.id')->join('transactions', 'shipments.id', '=', 'transactions.shipment_id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->where('shipmentdatas.deleted', '=', '0')->where('number', 'LIKE', '%'.$noPengiriman.'%');
				$isFirst = true;
			}
			
			if($kurir != '-')
			{
				if($isFirst == false)
				{
					$shipment = Shipment::join('shipmentdatas', 'shipments.shipmentData_id', '=', 'shipmentdatas.id')->join('transactions', 'shipments.id', '=', 'transactions.shipment_id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->where('shipmentdatas.deleted', '=', '0')->where('courier', 'LIKE', '%'.$kurir.'%');
					$isFirst = true;
				}
				else
				{
					$shipment = $shipment->where('courier', 'LIKE', '%'.$kurir.'%');
				}
			}
			
			if($destinasi != '-')
			{
				if($isFirst == false)
				{
					$shipment = Shipment::join('shipmentdatas', 'shipments.shipmentData_id', '=', 'shipmentdatas.id')->join('transactions', 'shipments.id', '=', 'transactions.shipment_id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->where('shipmentdatas.deleted', '=', '0')->where('destination', 'LIKE', '%'.$destinasi.'%');
					$isFirst = true;
				}
				else
				{
					$shipment = $shipment->where('destination', 'LIKE', '%'.$destinasi.'%');
				}
			}
			
			if($namaPenerima != '-')
			{
				if($isFirst == false)
				{
					$shipment = Shipment::join('shipmentdatas', 'shipments.shipmentData_id', '=', 'shipmentdatas.id')->join('transactions', 'shipments.id', '=', 'transactions.shipment_id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->where('shipmentdatas.deleted', '=', '0')->where('full_name', 'LIKE', '%'.$namaPenerima.'%');
					$isFirst = true;
				}
				else
				{
					$shipment = $shipment->where('full_name', 'LIKE', '%'.$namaPenerima.'%');
				}
			}
			
			if($hargaPengiriman != '-')
			{
				if($isFirst == false)
				{
					$shipment = Shipment::join('shipmentdatas', 'shipments.shipmentData_id', '=', 'shipmentdatas.id')->join('transactions', 'shipments.id', '=', 'transactions.shipment_id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->where('shipmentdatas.deleted', '=', '0')->where('price', 'LIKE', '%'.$hargaPengiriman.'%');
					$isFirst = true;
				}
				else
				{
					$shipment = $shipment->where('price', 'LIKE', '%'.$hargaPengiriman.'%');
				}
			}
			
			if($status != '-')
			{
				if($isFirst == false)
				{
					$shipment = Shipment::join('shipmentdatas', 'shipments.shipmentData_id', '=', 'shipmentdatas.id')->join('transactions', 'shipments.id', '=', 'transactions.shipment_id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->where('shipmentdatas.deleted', '=', '0')->where('status', 'LIKE', '%'.$status.'%');
					$isFirst = true;
				}
				else
				{
					$shipment = $shipment->where('status', 'LIKE', '%'.$status.'%');
				}
			}
			
			if($isFirst == false)
			{
				$shipment = Shipment::join('shipmentdatas', 'shipments.shipmentData_id', '=', 'shipmentdatas.id')->join('transactions', 'shipments.id', '=', 'transactions.shipment_id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->where('shipmentdatas.deleted', '=', '0')->orderBy($sortBy, $sortType)->get(array('shipments.id', 'shipments.number', 'shipmentdatas.courier', 'shipmentdatas.destination', 'shipmentdatas.price', 'transactions.status', 'profiles.full_name'));
				$isFirst = true;
			}
			else
			{
				$shipment = $shipment->orderBy($sortBy, $sortType)->get(array('shipments.id', 'shipments.number', 'shipmentdatas.courier', 'shipmentdatas.destination', 'shipmentdatas.price', 'transactions.status', 'profiles.full_name'));
			}
			
			if (count($shipment) == 0)
			{
				$respond = array('code'=>'404','status' => 'Not Found');
			}
			else
			{
				$respond = array('code'=>'200','status' => 'OK','messages'=>$shipment);
			}
			return Response::json($respond);
		}
	}
	
	/**
	 * Display the specified shipment.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getById()
	{
		$id = Input::get('id');
		$respond = array();
		$shipment = Shipment::join('shipmentdatas', 'shipments.shipmentData_id', '=', 'shipmentdatas.id')->join('transactions', 'shipments.id', '=', 'transactions.shipment_id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->where('shipments.id', '=', $id)->where('shipmentdatas.deleted', '=', '0')->get(array('shipments.id', 'shipments.number', 'shipmentdatas.courier', 'shipmentdatas.destination', 'shipmentdatas.price', 'transactions.status', 'profiles.full_name'));
		if (count($shipment) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$shipment);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified shipment by {name}.
	 *
	 * @param  
	 * @return Response
	 */
	/*
	public function getBy{name}()
	{
		$respond = array();
		$shipment = Shipment::where('','=','')->get();
		if (count($shipment) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$shipment);
		}
		return Response::json($respond);
	}
	*/

	/**
	 * Update all value of the specified shipment in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateFull($id)
	{
		$respond = array();
		$shipment = Shipment::find($id);
		if ($shipment == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//validate
			$validator = Validator::make($data = Input::all(), Shipment::$rules);

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			//save
			try {
				$shipment->update($data);
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}

	/**
	 * Update {name} value of the specified shipment in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*
	public function update{name}($id)
	{
		$respond = array();
		$shipment = Shipment::find($id);
		if ($shipment == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			//$shipment-> = ;
			try {
				$shipment->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	*/
	
	
	/**
	 * Remove the specified shipment from database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$respond = array();
		$shipment = Shipment::find($id);
		if ($shipment == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$shipment->delete();
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
		$shipment = Shipment::where('','=','')->get();
		if (count($shipment) >= 0)
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
	 * Display the specified shipment.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getByResiNumber($number)
	{
		$respond = array();
		$shipment = Shipment::where('number','=',$number)->first();
		$shipments = Shipment::join('shipmentdatas', 'shipments.shipmentData_id', '=', 'shipmentdatas.id')->where('shipmentData_id', '=', $shipment->shipmentData_id);
		if (count($shipment) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$shipments);
		}
		return Response::json($respond);
	}
	
	/**
	 * Update resiNumber value of the specified shipment in database.
	 *
	 * @param  int  $number
	 * @return Response
	 */
	
	public function updateResiNumber($id,$number)
	{
		$respond = array();
		$shipment = Shipment::find($id);
		if ($shipment == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$shipment->number = $number;
			try {
				$shipment->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
}
