<?php

class ShipmentDatasController extends \BaseController {

	/**
	 * Insert a newly created shipmentdata in database.
	 *
	 *deleted 1
	 *not deleted 0
	 * @return Response
	 */
	public function insert()
	{
		$respond = array();
		//validate
		$validator = Validator::make($data = Input::all(), Shipmentdata::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			//Shipmentdata::create($data);
			$shipment = new ShipmentData();
			$shipment->courier = Input::get('courier');
			$shipment->destination = Input::get('destination');
			$shipment->price = Input::get('price');
			$shipment->deleted = '0';
			$shipment->save();
			$idCreate  = $shipment->id;
			
			$respond = array('code'=>'201','status' => 'Created','messages'=> $idCreate);
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}

	/**
	 * Display all of the shipmentdata.
	 *
	 * @return Response
	 */
	public function getAll(){
		$respond = array();
		$shipmentdata = Shipmentdata::where('deleted','=','0')->get();
		if (count($shipmentdata) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$shipmentdata);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display all of the shipmentdata sort
	 *
	 * @return Response
	 */
	public function getAllSort($sortBy, $type)
	{
		$respond = array();
		$shipmentdata = Shipmentdata::where('deleted','=','0')->orderBy($sortBy, $type)->get();
		if (count($shipmentdata) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$shipmentdata);
		}
		return Response::json($respond);
	}

	/**
	 * Filter shipment
	 *
	 * @return Response
	 */
	public function getFilteredShipmentAgent($id, $courier, $destinasi, $price)
	{
		$isFirst = false;
		
		if($id != '-')
		{
			if($isFirst == false)
			{
				$shipmentAgt = Shipmentdata::where('deleted','=','0')->where('id','LIKE', '%'.$id.'%');
				$isFirst = true;
			}
		}
		
		if($courier != '-')
		{
			if($isFirst == false)
			{
				$shipmentAgt = Shipmentdata::where('deleted','=','0')->where('courier','LIKE', '%'.$courier.'%');
				$isFirst = true;
			}else
			{
				$shipmentAgt = $shipmentAgt->where('courier', 'LIKE', '%'.$courier.'%');
			}
		}
		
		if($destinasi != '-')
		{
			if($isFirst == false)
			{
				$shipmentAgt = Shipmentdata::where('deleted','=','0')->where('destination','LIKE', '%'.$destinasi.'%');
				$isFirst = true;
			}else
			{
				$shipmentAgt = $shipmentAgt->where('destination', 'LIKE', '%'.$destinasi.'%');
			}
		}
		
		if($price != '-')
		{
			if($isFirst == false)
			{
				$shipmentAgt = Shipmentdata::where('deleted','=','0')->where('price','LIKE', '%'.$price.'%');
				$isFirst = true;
			}else
			{
				$shipmentAgt = $shipmentAgt->where('price', 'LIKE', '%'.$price.'%');
			}
		}
		
		if($isFirst == false)
		{
			$shipmentAgt = Shipmentdata::where('deleted','=','0')->get();
			$isFirst = true;
		}else
		{
			$shipmentAgt = $shipmentAgt->get();
		}
		
		if (count($shipmentAgt) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$shipmentAgt);
		}
		return Response::json($respond);
	}
	
	/**
	 * Filter shipment sort
	 *
	 * @return Response
	 */
	public function getFilteredShipmentAgentSort($id, $courier, $destinasi, $price, $sortBy, $sortType)
	{
		$isFirst = false;
		
		if($id != '-')
		{
			if($isFirst == false)
			{
				$shipmentAgt = Shipmentdata::where('deleted','=','0')->where('id','LIKE', '%'.$id.'%');
				$isFirst = true;
			}
		}
		
		if($courier != '-')
		{
			if($isFirst == false)
			{
				$shipmentAgt = Shipmentdata::where('deleted','=','0')->where('courier','LIKE', '%'.$courier.'%');
				$isFirst = true;
			}else
			{
				$shipmentAgt = $shipmentAgt->where('courier', 'LIKE', '%'.$courier.'%');
			}
		}
		
		if($destinasi != '-')
		{
			if($isFirst == false)
			{
				$shipmentAgt = Shipmentdata::where('deleted','=','0')->where('destination','LIKE', '%'.$destinasi.'%');
				$isFirst = true;
			}else
			{
				$shipmentAgt = $shipmentAgt->where('destination', 'LIKE', '%'.$destinasi.'%');
			}
		}
		
		if($price != '-')
		{
			if($isFirst == false)
			{
				$shipmentAgt = Shipmentdata::where('deleted','=','0')->where('price','LIKE', '%'.$price.'%');
				$isFirst = true;
			}else
			{
				$shipmentAgt = $shipmentAgt->where('price', 'LIKE', '%'.$price.'%');
			}
		}
		
		if($isFirst == false)
		{
			$shipmentAgt = Shipmentdata::where('deleted','=','0')->orderBy($sortBy, $sortType)->get();
			$isFirst = true;
		}else
		{
			$shipmentAgt = $shipmentAgt->orderBy($sortBy, $sortType)->get();
		}
		
		if (count($shipmentAgt) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$shipmentAgt);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified shipmentdata.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getById()
	{
		$id = Input::get('id');
		$respond = array();
		$shipmentdata = Shipmentdata::find($id);
		if (count($shipmentdata) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$shipmentdata);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified shipmentdata by {name}.
	 *
	 * @param  
	 * @return Response
	 */
	/*
	public function getBy{name}()
	{
		$respond = array();
		$shipmentdata = Shipmentdata::where('','=','')->get();
		if (count($shipmentdata) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$shipmentdata);
		}
		return Response::json($respond);
	}
	*/

	/**
	 * Update all value of the specified shipmentdata in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateFull($id)
	{
		$respond = array();
		$shipmentdata = Shipmentdata::find($id);
		if ($shipmentdata == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//validate
			$validator = Validator::make($data = Input::all(), Shipmentdata::$rules);

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			//save
			try {
				$shipmentdata->update($data);
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}

	/**
	 * Update {name} value of the specified shipmentdata in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*
	public function update{name}($id)
	{
		$respond = array();
		$shipmentdata = Shipmentdata::find($id);
		if ($shipmentdata == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			//$shipmentdata-> = ;
			try {
				$shipmentdata->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	*/
	
	
	/**
	 * Remove the specified shipmentdata from database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete()
	{
		$id = Input::get('id');
		$respond = array();
		$shipmentdata = Shipmentdata::find($id);
		if ($shipmentdata == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$shipmentdata->deleted = '1';
				$shipmentdata->save();
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
		$shipmentdata = Shipmentdata::where('','=','')->get();
		if (count($shipmentdata) >= 0)
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
	 * find by destination
	 *
	 * @param  $destination
	 * @return Response
	 */
	 public function getByDestination($destination)
	{
		$respond = array();
		$shipmentdata = Shipmentdata::where('destination','=',$destination)->where('deleted','=','0')->get();
		if (count($shipmentdata) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$shipmentdata);
		}
		return Response::json($respond);
	}
	
	/**
	 * find by courier
	 *
	 * @param  $courier
	 * @return Response
	 */
	 public function getByCourier($courier)
	{
		$respond = array();
		$shipmentdata = Shipmentdata::where('courier','=',$courier)->where('deleted','=','0')->get();
		if (count($shipmentdata) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$shipmentdata);
		}
		return Response::json($respond);
	}
	
	/**
	 * get all by destination and courier
	 *
	 * @param  $destination and $courier
	 * @return Response
	 */
	 public function getByDestinationAndCourier($destination, $courier)
	{
		$respond = array();
		$shipmentdata = Shipmentdata::where('destination','=',$destination)->where('courier','=',$courier)->where('deleted','=','0')->get();
		if (count($shipmentdata) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$shipmentdata);
		}
		return Response::json($respond);
	}
	
	/**
	 * Update price value of the specified shipmentdata in database.
	 *
	 * @param  $price, $id
	 * @return Response
	 */
	public function updatePrice()
	{
		$price = Input::get('price');
		$id = Input::get('id');
		$respond = array();
		$shipmentdata = Shipmentdata::where('id','=',$id)->first();
		if ($shipmentdata == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$shipmentdata->price = $price;

			try {
				$shipmentdata->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	/**
	 * Remove spesific courier from database.
	 *deleted 1
	 *not deleted 0
	 * @param  $courier
	 * @return Response
	 */
	public function deleteByCourier($courier)
	{
		$respond = array();
		$shipmentdata = Shipmentdata::where('courier','=',$courier)->get();
		if ($shipmentdata == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$shipmentdata->deleted ="1";
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	/**
	 * Remove spesific destination from database.
	 *deleted 1
	 *not deleted 0
	 * @param   $destination
	 * @return Response
	 */
	public function deleteByDestination($destination)
	{
		$respond = array();
		$shipmentdata = Shipmentdata::where('destination','=',$destination)->get();
		if ($shipmentdata == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$shipmentdata->deleted ="1";
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	/**
	 * Update price value of the specified shipmentdata in database.
	 *
	 * @param  $price, $id
	 * @return Response
	 */
	public function updateCourier($courier, $new_courier)
	{
		$respond = array();
		$shipmentdata = Shipmentdata::where('courier','=',$courier)->get();
		if ($shipmentdata == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			foreach($shipmentData as $key)
			{
				$key->courier = $courier;

				try {
					$key->save();
					$respond = array('code'=>'204','status' => 'No Content');
				} catch (Exception $e) {
					$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
					break;
				}
			}
		}
		return Response::json($respond);
	}
}
