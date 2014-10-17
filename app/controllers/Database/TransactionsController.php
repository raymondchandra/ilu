<?php
use Carbon\Carbon;
class TransactionsController extends \BaseController {

	/**
	 * Insert a newly created transaction in database.
	 * invoice = TahunTanggalBulanID(4digit diambil dari count transaksi *hari itu)
	 * paid
	 * 0-> not paid
	 * 1-> paid
	 * status
	 * pending, on progress, on shipment, complete
	 * @return Response
	 */
	public function createTransaction()
	{
		$respond = array();
		//validate
		$validator = Validator::make($data = json_decode(Input::all()), Transaction::$rules);
		
		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			//Transaction::create($data);
			
			//bikin no invoice
			$format1 = '%s';
			$format2 = '%1$04d';
			$tahun = date('Y');
			$bulan = date('m');
			$hari = date('d');
			$list_transaksi = Transaction::where('created_at','=',Carbon::now());
			$nomor_transaksi = count($list_peserta);
			$tahun_transaksi =  sprintf($format1,$tahun);
			$bulan_transaksi = sprintf($format1, $bulan);
			$hari_transaksi = sprintf($format1, $hari);
			$nomor_trans =  sprintf($format2,$nomor_transaksi);
			$invoice = $tahun_transaksi.$hari_transaksi.$bulan_transaksi.$nomor_trans;
			
			//open cart
			$arrCart = Input::get('cart_id');
			$accId = Cart::where('id','=',$arrCart[0])->first()->account_id;
			
			//masukin transaksi
			$trans = new Transaction();
			
			$trans->invoice = $invoice;
			$trans->account_id = $accId;
			$trans->total_price = Input::get('total_price');
			$trans->voucher_id = Input::get('voucher_id');
			$trans->status = 'pending';
			$trans->paid = '0';
			$trans->shipment_id = Input::get('shipment_id');
			$trans->save();
			$idCreate  = $trans->id;
			
			//masukin order
			foreach($arrCart as $key)
			{
				$cart = Cart::where('id','=',$key)->first();
				$priceId = $cart->price_id;
				$qty = $cart->quantity;
				
				$order = new Order();
			
				$order->price_id = $priceId;
				$order->quantity = $qty;
				$order->transaction_id = $idCreate;
				$order->save();
			}
			
			
			$respond = array('code'=>'201','status' => 'Created','messages'=>$invoice);
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
	public function getAll()
	{
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
	
	/**
	 * Display detail transaction for admin panel
	 *
	 * @param    $id transaksi
	 * @return Response
	 */
	public function getDetail($id)
	{
		$respond = array();
		$transaction = Transaction::where('id','=',$id)->get();
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
				$prof = Profile::where('id','=',$profId)->first();
				$key->profile = $prof;
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$transaction);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display all of the transaction sorting by attribute Ascending
	 * param sortby
	 * sort by:
	 * invoice
	 * account_id
	 * total_price
	 * voucher_id
	 * status
	 * paid
	 * shipment_id
	 * full_name
	 * @return Response
	 */
	public function getAllSortByAsc($sortBy)
	{
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
				$transaction->orderBy($sortBy);
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$transaction);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display all of the transaction sorting by attribute Descending
	 * param sortby
	 * sort by:
	 * invoice
	 * account_id
	 * total_price
	 * voucher_id
	 * status
	 * paid
	 * shipment_id
	 * full_name
	 * @return Response
	 */
	public function getAllSortByDesc($sortBy)
	{
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
				$transaction->orderBy($sortBy,'desc');
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$transaction);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display top ten product
	 * param 
	 * @return Response
	 */
	public function getTopTenProduct()
	{
		$respond = array();
		$transaction = Transaction::all();
		$ttp = array();
		if (count($transaction) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($transaction as $key)
			{
				$ttp = array($key->id);
			}
			foreach($ttp as $key2)
			{
				
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$transaction);
		}
		return Response::json($respond);
	}
}
