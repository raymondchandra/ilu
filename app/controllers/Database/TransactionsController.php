<?php

class TransactionsController extends \BaseController {

	/**
	 * Insert a newly created transaction in database.
	 * invoice = TahunTanggalBulanID(4digit diambil dari count transaksi hari itu)
	 *paid = 
	 * @return Response
	 */
	public function createTransaction()
	{
		$respond = array();
		//validate
		$validator = Validator::make($data = Input::all(), Transaction::$rules);
		
		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			//Transaction::create($data);
			di sini loh
			$idCreate  = $data->id;
			$respond = array('code'=>'201','status' => 'Created','messages'=>$idCreate);
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}

	/**
	 * Display all of the transaction.
	 *
	 * @return Response
	 */
	public function getAll(){
		$respond = array();
		$transaction = Transaction::all();
		if (count($transaction) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($transaction as $key)
			{
				$accId = $key->account_id;
				$profId = Account::where('id','=',$accId)->first()->profile_id;
				$profName = Profile::where('id','=',$profId)->first()->full_name;
				$key->full_name = $profName;
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$transaction);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified transaction.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getById($id)
	{
		$respond = array();
		$transaction = Transaction::find($id);
		
		if (count($transaction) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$transaction);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified transaction by {name}.
	 *
	 * @param  
	 * @return Response
	 */
	/*
	public function getBy{name}()
	{
		$respond = array();
		$transaction = Transaction::where('','=','')->get();
		if (count($transaction) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$transaction);
		}
		return Response::json($respond);
	}
	*/

	/**
	 * Update all value of the specified transaction in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateFull($id)
	{
		$respond = array();
		$transaction = Transaction::find($id);
		if ($transaction == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//validate
			$validator = Validator::make($data = Input::all(), Transaction::$rules);

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			//save
			try {
				$transaction->update($data);
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}

	/**
	 * Update {name} value of the specified transaction in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	/*
	public function update{name}($id)
	{
		$respond = array();
		$transaction = Transaction::find($id);
		if ($transaction == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			//$transaction-> = ;
			try {
				$transaction->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	*/
	
	
	/**
	 * Remove the specified transaction from database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$respond = array();
		$transaction = Transaction::find($id);
		if ($transaction == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$transaction->delete();
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
		$transaction = Transaction::where('','=','')->get();
		if (count($transaction) >= 0)
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
	 * Update status (pending, on progress, sent)
	 *
	 * @param  int  $id, $status
	 * @return Response
	 */
	public function updateStatus($id, $status)
	{
		$respond = array();
		$transaction = Transaction::find($id);
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
	 * Update paid (paid, not paid)
	 *
	 * @param  int  $id, $paid 
	 * status :
	 * 0-> not paid
	 * 1-> paid
	 * @return Response
	 */
	public function updatePaid($id, $paid)
	{
		$respond = array();
		$transaction = Transaction::find($id);
		if ($transaction == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$transaction ->paid = $paid;
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
	 * Display the specified transaction by account_id
	 *
	 * @param  int  $account_id
	 * @return Response
	 */
	public function getByAccountId($account_id)
	{
		$respond = array();
		$transaction = Transaction::where('account_id','=',$account_id)->get();
		if (count($transaction) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$transaction);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified transaction by invoice
	 *
	 * @param  int  $invoice
	 * @return Response
	 */
	public function getByInvoice($invoice)
	{
		$respond = array();
		$transaction = Transaction::where('invoice','=',$invoice)->get();
		if (count($transaction) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$transaction);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified transaction by voucher id
	 *
	 * @param  int  $voucher_id
	 * @return Response
	 */
	public function getByVoucherId($voucher_id)
	{
		$respond = array();
		$transaction = Transaction::where('voucher_id','=',$voucher_id)->get();
		if (count($transaction) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$transaction);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified transaction by status
	 *
	 * @param  $status
	 * @return Response
	 */
	public function getByStatus($status)
	{
		$respond = array();
		$transaction = Transaction::where('status','=',$status)->get();
		if (count($transaction) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$transaction);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified transaction by paid
	 *
	 * @param  int  $paid
	 * @return Response
	 */
	public function getByPaid($paid)
	{
		$respond = array();
		$transaction = Transaction::where('paid','=',$paid)->get();
		if (count($transaction) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$transaction);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified transaction by shipment id
	 *
	 * @param  int  $shipment_id
	 * @return Response
	 */
	public function getByShipmentId($shipment_id)
	{
		$respond = array();
		$transaction = Transaction::where('shipment_id','=',$shipment_id)->get();
		if (count($transaction) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$transaction);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified transaction by total_price
	 *
	 * @param  int  $total_price
	 * @return Response
	 */
	public function getByTotalPrize($total_price)
	{
		$respond = array();
		$transaction = Transaction::where('total_price','=',$total_price)->get();
		if (count($transaction) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$transaction);
		}
		return Response::json($respond);
	}
	
	
}
