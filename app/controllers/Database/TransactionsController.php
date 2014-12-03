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
			$list_transaksi = Transaction::where('updated_at','=',Carbon::now());
			$nomor_transaksi = count($list_peserta);
			$tahun_transaksi =  sprintf($format1,$tahun);
			$bulan_transaksi = sprintf($format1, $bulan);
			$hari_transaksi = sprintf($format1, $hari);
			$nomor_trans =  sprintf($format2,$nomor_transaksi);
			$invoice = $tahun_transaksi.$hari_transaksi.$bulan_transaksi.$nomor_trans;
			
			//open cart
			$arrCart = Input::get('cart_id');
			$accId = Cart::where('id','=',$arrCart[0])->first()->account_id;
			
			//masukin shipment data
			$shipment = new Shipment();
			
			$shipment->shipmentData_id = Input::get('shipment_id');
			$shipment->save();
			$idShip = $shipment->id;
			
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
				
				$pr = Price::where('id','=',$priceId)->first();
				$tx = Tax::where('id','=',$pr->tax_id)->first();
				
				$priceNow = (($pr->amount) * (100+$tx->amount))/100;
				
				$order->priceNow = $priceNow;
				$order->save();
			}
			
			//masukin transaksi
			$trans = new Transaction();
			
			$trans->invoice = $invoice;
			$trans->account_id = $accId;
			$trans->total_price = Input::get('total_price');
			$trans->voucher_id = Input::get('voucher_id');
			$trans->status = 'pending';
			$trans->paid = '0';
			$trans->shipment_id = $idShip;
			$trans->save();
			$idCreate  = $trans->id;
			
			
			
			
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
		$transaction = Transaction::join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->get(array('transactions.id', 'transactions.invoice' ,'transactions.account_id', 'transactions.total_price', 'transactions.voucher_id', 'transactions.status', 'transactions.paid', 'transactions.shipment_id', 'transactions.created_at', 'transactions.updated_at', 'profiles.full_name'));
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
	 * Display the specified transaction.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getById()
	{
		$id = Input::get('id');
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
	public function updateStatus()
	{
		$id = Input::get('id');
		$status = Input::get('status');
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
	public function updatePaid()
	{
	
		$id = Input::get('id');
		$paid = Input::get('paid');
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
	public function getByAccountId()
	{
		$account_id = Input::get('acc_id');
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
	public function getDetail()
	{
		$id = Input::get('id');
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
				if($key->voucher_id == null)
				{
					$key->voucher_id = "-";
				}
				$ship = Shipment::where('id','=',$key->shipment_id)->first();
				$profId = Account::where('id','=',$accId)->first()->profile_id;
				$prof = Profile::where('id','=',$profId)->first();
				$shipA = ShipmentData::where('id','=',$ship->shipmentData_id)->where('deleted','=','0')->get();
				foreach($shipA as $key2)
				{
					if($ship->number == '' || $ship->number == null)
					{
						$key2->shipmentNumber = "-";
					}else
					{
						$key2->shipmentNumber = $ship->number;
					}
				}
				$key->order = Order::where('transaction_id','=',$id)->get();
				foreach($key->order as $key2)
				{
					$price = Price::where('id','=',$key2->price_id)->first();
					$key2->attr_value = $price->attr_value;
					$attr = Attribute::where('id','=',$price->attr_id)->first();
					$key2->attr_name = $attr->name;
					$prod = Product::where('id','=',$price->product_id)->first();
					$key2->name_product = $prod->name;
					$cat = Category::where('id','=',$prod->category_id)->first();
					$key2->ctgr = $cat->name;
				}
				$key->profile = $prof;
				$key->shipment = $shipA;
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
	public function getAllSort($sortBy, $type)
	{
		$respond = array();
		$transaction = Transaction::join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->orderBy($sortBy,$type)->get(array('transactions.id', 'transactions.invoice' ,'transactions.account_id', 'transactions.total_price', 'transactions.voucher_id', 'transactions.status', 'transactions.paid', 'transactions.shipment_id', 'transactions.created_at', 'transactions.updated_at', 'profiles.full_name'));
		if (count($transaction) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($transaction as $key)
			{
				if($key->voucher_id == null)
				{
					$key->voucher_id = "-";
				}
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$transaction);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display top ten product
	 *
	 * @return Response
	 */
	public function getTopTenProduct(){
		$respond = array();
		$prod = Order::join('prices','orders.price_id','=','prices.id')->groupBy('prices.product_id')->select(array('prices.product_id'))->orderBy('product_id','asc')->get();
		$qtyProd = Order::join('prices','orders.price_id','=','prices.id')->select(array('prices.product_id', 'orders.quantity'))->orderBy('product_id','asc')->get();
		if (count($prod) == 0 && count($qtyProd))
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$idxLast = count($qtyProd);
			$allProd = null;
			foreach($prod as $key)
			{
				$ct = 0;
				$tempProd = -1;
				$first = true;
				$idxCt = 0;
				foreach($qtyProd as $key2)
				{
					$idxCt++;
					if($key2->product_id == $key->product_id)
					{
						$ct = $ct + $key2->quantity;
						$tempProd = $key->product_id;
						
						if($idxLast ==  $idxCt && $first == true)
						{
							$allProd[] = array('prod_id'=> $tempProd, 'total'=>$ct);
						}
						
					}else
					{
						if($first == true && $ct != 0)
						{
							$allProd[] = array('prod_id'=> $tempProd, 'total'=>$ct);
							$ct = 0;
							$first = false;
						}
					}
				}
			}
			if($allProd != null)
			{
				foreach ($allProd as $key=>$row) 
				{
					$pro[$key]  = $row['prod_id'];
					$tot[$key] = $row['total'];
				}
				array_multisort($tot, SORT_DESC, $pro, SORT_ASC, $allProd);
				$idx = 0;
				
				foreach($allProd as $key => $row)
				{
					if($idx < 10)
					{
						$product = new ProductsController();
						$productTopTen = $product->getById($row['prod_id']);// here
						$temp = json_decode($productTopTen->getContent());
						$temp2 = $temp->{'messages'};
						$topTenProduct[] = array('idProd'=>$row['prod_id'], 'product_name'=>$temp2->name, 'product'=>$temp2);
						$idx++;
					}else
					{
						break;
					}
				}
				
				$respond = array('code'=>'200','status' => 'OK','messages'=>$topTenProduct);
			}else
			{
					$respond = array('code'=>'404','status' => 'Not Found');
			}
			
			
		}
		return Response::json($respond);
	}
	
	/**
	 * Display top ten product
	 *
	 * @return Response
	 */
	public function getTopTenProductFE(){
		
		$page = Input::get('page');
		$limit = Input::get('limit');
		
		$respond = array();
		$prod = Order::join('prices','orders.price_id','=','prices.id')->groupBy('prices.product_id')->select(array('prices.product_id'))->orderBy('product_id','asc')->get();
		$qtyProd = Order::join('prices','orders.price_id','=','prices.id')->select(array('prices.product_id', 'orders.quantity'))->orderBy('product_id','asc')->get();
		if (count($prod) == 0 && count($qtyProd))
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$idxLast = count($qtyProd);
			$allProd = null;
			foreach($prod as $key)
			{
				$ct = 0;
				$tempProd = -1;
				$first = true;
				$idxCt = 0;
				foreach($qtyProd as $key2)
				{
					$idxCt++;
					if($key2->product_id == $key->product_id)
					{
						$ct = $ct + $key2->quantity;
						$tempProd = $key->product_id;
						
						if($idxLast ==  $idxCt && $first == true)
						{
							$allProd[] = array('prod_id'=> $tempProd, 'total'=>$ct);
						}
						
					}else
					{
						if($first == true && $ct != 0)
						{
							$allProd[] = array('prod_id'=> $tempProd, 'total'=>$ct);
							$ct = 0;
							$first = false;
						}
					}
				}
			}
			if($allProd != null)
			{
				foreach ($allProd as $key=>$row) 
				{
					$pro[$key]  = $row['prod_id'];
					$tot[$key] = $row['total'];
				}
				array_multisort($tot, SORT_DESC, $pro, SORT_ASC, $allProd);
				$idx = 0;
				$start = ($page-1) * $limit;
				$end = ( $page * $limit ) -1;
				if($end > 10)
				{
					$end = 10;
				}
				foreach($allProd as $key => $row)
				{
					if($idx < 10)
					{
						if($idx >= $start && $idx <= $end)
						{
							$product = new ProductsController();
							$productTopTen = $product->getById($row['prod_id']);// here
							$temp = json_decode($productTopTen->getContent());
							$temp2 = $temp->{'messages'};
							$topTenProduct[] = array('idProd'=>$row['prod_id'], 'product_name'=>$temp2->name, 'product'=>$temp2);
							
						}
						
						$idx++;
					}else
					{
						break;
					}
				}
				
				$respond = array('code'=>'200','status' => 'OK','messages'=>$topTenProduct);
			}else
			{
					$respond = array('code'=>'404','status' => 'Not Found');
			}
			
			
		}
		return Response::json($respond);
	}
	
	/**
	 * Display top ten buyer
	 *
	 * @return Response
	 */
	public function getTopTenBuyer(){
		$respond = array();
		$topTen = DB::table('transactions')->select(array('transactions.account_id', DB::raw('COUNT(transactions.account_id) as jumlah')))->groupBy('transactions.account_id')->orderBy('jumlah','desc')->take(10)->get();
		if (count($topTen) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($topTen as $key)
			{
				$account = new AccountsController();
				$accountTopTen = $account->getProfileByAccountId($key->account_id);// here
				$temp = json_decode($accountTopTen->getContent());
				$temp2 = $temp->{'messages'};
				//echo $temp2->full_name;
				$key->account_name = $temp2->full_name;
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$topTen);
		}
		return Response::json($respond);
	}
	
	/**
	 * Filter transaksi
	 *
	 * @return Response
	 */
	public function getFilteredTransaction($invoice, $accId, $fullName, $totalPrice,$status,$paid)
	{
		$isFirst = false;
		
		if($invoice != '-')
		{
			if($isFirst == false)
			{
				$transaction = Transaction::join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->where('invoice', 'LIKE', '%'.$invoice.'%');
				$isFirst = true;
			}
		}
		
		if($accId != '-')
		{
			if($isFirst == false)
			{
				$transaction = Transaction::join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->where('account_id', 'LIKE', '%'.$accId.'%');
				$isFirst = true;
			}
			else
			{
				$transaction = $transaction->where('account_id', 'LIKE', '%'.$accId.'%');
			}
		}
		
		if($fullName != '-')
		{
			if($isFirst == false)
			{
				$transaction = Transaction::join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->where('full_name', 'LIKE', '%'.$fullName.'%');
				$isFirst = true;
			}
			else
			{
				$transaction = $transaction->where('full_name', 'LIKE', '%'.$fullName.'%');
			}
		}
		
		if($totalPrice != '-')
		{
			if($isFirst == false)
			{
				$transaction = Transaction::join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->where('total_price', 'LIKE', '%'.$totalPrice.'%');
				$isFirst = true;
			}
			else
			{
				$transaction = $transaction->where('total_price', 'LIKE', '%'.$totalPrice.'%');
			}
		}
		
		if($status != '-')
		{
			if($isFirst == false)
			{
				$transaction = Transaction::join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->where('status', 'LIKE', '%'.$status.'%');
				$isFirst = true;
			}
			else
			{
				$transaction = $transaction->where('status', 'LIKE', '%'.$status.'%');
			}
		}
		
		if($paid != '-')
		{ 
			if(preg_match("/[un].*?/i", $paid, $match))
			{
				$pay = 0;
			}else if(preg_match("/[paid]/i", $paid, $match))
			{
				$pay = 1;
			}else
			{
				$pay = 2;
			}
			
			if($isFirst == false)
			{
				if($pay == 0)
				{
					$transaction = Transaction::join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->where('paid', 'LIKE', '%'.$pay.'%');
				}else if($pay == 1)
				{
					$transaction = Transaction::join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id');
				}
				$isFirst = true;
			}
			else
			{
				if($pay == 0)
				{
					$transaction = $transaction->where('paid', 'LIKE', '%'.$pay.'%');
				}else if($pay == 1)
				{
					$transaction = $transaction;
				}
			}
		}
		
		if($isFirst == false)
		{
			$transaction = Transaction::join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->get();
			$isFirst = true;
		}
		else
		{
			$transaction = $transaction->get();
		}
		
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
	 * Filter transaksi
	 *
	 * @return Response
	 */
	public function getFilteredTransactionSort($invoice, $accId, $fullName, $totalPrice,$status,$paid, $sortBy, $sortType)
	{
		$isFirst = false;
		
		if($invoice != '-')
		{
			if($isFirst == false)
			{
				$transaction = Transaction::join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->where('invoice', 'LIKE', '%'.$invoice.'%');
				$isFirst = true;
			}
		}
		
		if($accId != '-')
		{
			if($isFirst == false)
			{
				$transaction = Transaction::join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->where('account_id', 'LIKE', '%'.$accId.'%');
				$isFirst = true;
			}
			else
			{
				$transaction = $transaction->where('account_id', 'LIKE', '%'.$accId.'%');
			}
		}
		
		if($fullName != '-')
		{
			if($isFirst == false)
			{
				$transaction = Transaction::join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->where('full_name', 'LIKE', '%'.$fullName.'%');
				$isFirst = true;
			}
			else
			{
				$transaction = $transaction->where('full_name', 'LIKE', '%'.$fullName.'%');
			}
		}
		
		if($totalPrice != '-')
		{
			if($isFirst == false)
			{
				$transaction = Transaction::join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->where('total_price', 'LIKE', '%'.$totalPrice.'%');
				$isFirst = true;
			}
			else
			{
				$transaction = $transaction->where('total_price', 'LIKE', '%'.$totalPrice.'%');
			}
		}
		
		if($status != '-')
		{
			if($isFirst == false)
			{
				$transaction = Transaction::join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->where('status', 'LIKE', '%'.$status.'%');
				$isFirst = true;
			}
			else
			{
				$transaction = $transaction->where('status', 'LIKE', '%'.$status.'%');
			}
		}
		
		if($paid != '-')
		{
			if(preg_match("/[un].*?/i", $paid, $match))
			{
				$pay = 0;
			}else if(preg_match("/[paid]/i", $paid, $match))
			{
				$pay = 1;
			}else
			{
				$pay = 2;
			}
			
			if($isFirst == false)
			{
				if($pay == 0)
				{
					$transaction = Transaction::join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->where('paid', 'LIKE', '%'.$pay.'%');
				}else if($pay == 1)
				{
					$transaction = Transaction::join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id');
				}
				$isFirst = true;
			}
			else
			{
				if($pay == 0)
				{
					$transaction = $transaction->where('paid', 'LIKE', '%'.$pay.'%');
				}else if($pay == 1)
				{
					$transaction = $transaction;
				}
			}
		}
		
		if($isFirst == false)
		{
			$transaction = Transaction::join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->orderBy($sortBy, $sortType)->get();
			$isFirst = true;
		}
		else
		{
			$transaction = $transaction->orderBy($sortBy, $sortType)->get();
		}
		
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
	 * Display report day
	 *
	 * paid
	 * 0-> not paid
	 * 1-> paid
	 * @return Response
	 */
	public function getDayReportDashboard(){
		$respond = array();
		$report = Transaction::where(DB::raw('MONTH(updated_at)'), '=', date('n'))->where(DB::raw('YEAR(updated_at)'), '=', date('Y'))->where('paid','=','1')->get();
		$idx = 1;
		$tgl = date('j');
		$bln = date('F');
		$tahun = date('Y');
		$hasil = array();
		while($idx <= $tgl)
		{
			$tempHasil = 0;
			foreach($report as $key)
			{
				$dd = $key->updated_at;
				$created = Carbon::parse($dd)->format('d');
				if($created == $idx)
				{
					$tempHasil = $tempHasil + $key->total_price;
				}
			}
			$hasil[] = array('tanggal' => $idx, 'penjualan' => $tempHasil,'bulan' => $bln.'-'.$tahun,'ket' => 'day');
			$idx = $idx + 1;
		}
		$respond = array('code'=>'200','status' => 'OK','messages'=>$hasil);
		
		return Response::json($respond);
	}
	
	/**
	 * Display report day
	 *
	 * paid
	 * 0-> not paid
	 * 1-> paid
	 * @return Response
	 */
	public function getDayReport(){
		$respond = array();
		$report = Transaction::where(DB::raw('MONTH(updated_at)'), '=', date('n'))->where(DB::raw('YEAR(updated_at)'), '=', date('Y'))->where('paid','=','1')->get();
		$idx = 1;
		$tgl = date('t');
		$bln = date('F');
		$tahun = date('Y');
		$hasil = array();
		while($idx <= $tgl)
		{
			$tempHasil = 0;
			foreach($report as $key)
			{
				$dd = $key->updated_at;
				$created = Carbon::parse($dd)->format('d');
				if($created == $idx)
				{
					$tempHasil = $tempHasil + $key->total_price;
				}
			}
			$hasil[] = array('tanggal' => $idx, 'penjualan' => $tempHasil,'bulan' => $bln.'-'.$tahun,'ket' => 'day');
			$idx = $idx + 1;
		}
		$respond = array('code'=>'200','status' => 'OK','messages'=>$hasil);
		
		return Response::json($respond);
	}
	
	/**
	 * Display report week
	 *
	 * paid
	 * 0-> not paid
	 * 1-> paid
	 * @return Response
	 */
	public function getWeekReport(){
		$respond = array();
		$report = Transaction::where(DB::raw('MONTH(updated_at)'), '=', date('n'))->where(DB::raw('YEAR(updated_at)'), '=', date('Y'))->where('paid','=','1')->orderBy('updated_at','asc')->get();
		
		$idx = 1;
		$idx2 = 1;
		$tglAkhir = date('t');
		$bln = date('F');
		$blnA = date('n');
		$tahun = date('Y');
		$hasil = array();
		$first = $this->getWeeks($tahun."-".$blnA."-01", "sunday");
		$tempHasil = 0;
		while($idx <= $tglAkhir)
		{
			$temp = $this->getWeeks($tahun."-".$blnA."-".$idx, "sunday");
			if($temp == $first)
			{
				if($idx != $tglAkhir)
				{
					foreach($report as $key)
					{
						$dd = $key->updated_at;
						$created = Carbon::parse($dd)->format('d');
						if($created == $idx)
						{
							$tempHasil = $tempHasil + $key->total_price;
						}
					}
					
				}else
				{
					$hasil[] = array('tanggal_awal' => $idx2.'-'.$bln.'-'.$tahun, 'tanggal_akhir'=> ($idx ).'-'.$bln.'-'.$tahun,'penjualan' => $tempHasil,'week' =>$first, 'bulan' => $bln.'-'.$tahun,'ket' => 'week');
				}
				$idx = $idx + 1;
			}else
			{
				$hasil[] = array('tanggal_awal' => $idx2.'-'.$bln.'-'.$tahun, 'tanggal_akhir'=> ($idx - 1).'-'.$bln.'-'.$tahun,'penjualan' => $tempHasil,'week' =>$first, 'bulan' => $bln.'-'.$tahun,'ket' => 'week');
				$tempHasil = 0;
				$idx2 = $idx;
				$first = $this->getWeeks($tahun."-".$blnA."-".$idx, "sunday");
			}
		}
		$respond = array('code'=>'200','status' => 'OK','messages'=>$hasil);
	
		return Response::json($respond);
	}
	
	/**
	 * Display week
	 *
	 * @return week
	 */
	function getWeeks($date, $rollover)
    {
        $cut = substr($date, 0, 8);
        $daylen = 86400;

        $timestamp = strtotime($date);
        $first = strtotime($cut . "00");
        $elapsed = ($timestamp - $first) / $daylen;

        $i = 1;
        $weeks = 1;

        for($i; $i<=$elapsed; $i++)
        {
            $dayfind = $cut . (strlen($i) < 2 ? '0' . $i : $i);
            $daytimestamp = strtotime($dayfind);

            $day = strtolower(date("l", $daytimestamp));

            if($day == strtolower($rollover))  $weeks ++;
        }

        return $weeks;
    }
	
	/**
	 * Display report month
	 *
	 * paid
	 * 0-> not paid
	 * 1-> paid
	 * @return Response
	 */
	public function getMonthReport(){
		$respond = array();
		$report = Transaction::where(DB::raw('YEAR(updated_at)'), '=', date('Y'))->where('paid','=','1')->get();
		$idx = 1;
		$tahun = date('Y');
		$hasil = array();
		while($idx <= 12)
		{
			$tempHasil = 0;
			$tempBln = Carbon::parse($tahun."-".$idx."-01")->format('F');
			foreach($report as $key)
			{
				$dd = $key->updated_at;
				$created = Carbon::parse($dd)->format('n');
				if($created == $idx)
				{
					$tempHasil = $tempHasil + $key->total_price;
				}
			}
			$hasil[] = array('tanggal'=>$tempBln,'bulan'=>$tahun, 'penjualan' => $tempHasil,'ket' => 'month');
			$idx = $idx + 1;
		}
		$respond = array('code'=>'200','status' => 'OK','messages'=>$hasil);
		
		return Response::json($respond);
	}
	
	/**
	 * Display report year
	 * 10 year
	 * paid
	 * 0-> not paid
	 * 1-> paid
	 * @return Response
	 */
	public function getYearReport(){
		$respond = array();
		$report = Transaction::where('paid','=','1')->get();
		$tahun = date('Y') -2;
		$idx = 1;
		$tahunAkhir = 3;
		$hasil = array();
		while($idx <= $tahunAkhir)
		{
			$tempHasil = 0;
			$tempTahun = Carbon::parse($tahun."-01-01")->format('Y');
			foreach($report as $key)
			{
				$dd = $key->updated_at;
				$created = Carbon::parse($dd)->format('Y');
				if($created == $tempTahun)
				{
					$tempHasil = $tempHasil + $key->total_price;
				}
			}
			$hasil[] = array('tanggal'=>$tempTahun, 'penjualan' => $tempHasil,'ket'=>'year');
			$idx = $idx + 1;
			$tahun = $tahun +1;
		}
		$respond = array('code'=>'200','status' => 'OK','messages'=>$hasil);
		
		return Response::json($respond);
	}
	
	/**
	 * Display report range
	 * paid
	 * 0-> not paid
	 * 1-> paid
	 * @return Response
	 */
	public function getRangeReport($date1, $date2){
		$respond = array();
		$report = Transaction::where('paid','=','1')->get();
		$idx = 1;
		$hasil = array();
		$d1 = new Carbon($date1);
		$d2 = new Carbon($date2);
		
		$tgl1 = Carbon::parse($d1)->format('d');
		$bln1 = Carbon::parse($d1)->format('F');
		$thn1 = Carbon::parse($d1)->format('Y');
		
		$tgl2 = Carbon::parse($d2)->format('d');
		$bln2 = Carbon::parse($d2)->format('F');
		$thn2 = Carbon::parse($d2)->format('Y');
				
		$difference = ($d1->diff($d2)->days);
		while($idx <= ($difference+1))
		{
			$tempHasil = 0;
			if($idx != 1)
			{
				$d1->addDay(1);
			}
			foreach($report as $key)
			{
				$dd = $key->updated_at;
				$dd2 = Carbon::parse($dd)->format('Ynd');
				$dc1 = Carbon::parse($d1)->format('Ynd');
				if($dd2 == $dc1)
				{
					$tempHasil = $tempHasil + $key->total_price;
				}
				$tgl = Carbon::parse($d1)->format('d');
				$bln = Carbon::parse($d1)->format('F');
				$thn = Carbon::parse($d1)->format('Y');
			}
			$hasil[] = array('tanggal' => $tgl,'tanggal2' =>$tgl.'-'.$bln.'-'.$thn, 'penjualan' => $tempHasil,'ket' => 'range', 'bulan' =>  $tgl1.'-'.$bln1.'-'.$thn1.' sampai '.$tgl2.'-'.$bln2.'-'.$thn2 );
			$idx = $idx + 1;
		}
		$respond = array('code'=>'200','status' => 'OK','messages'=>$hasil);
		
		return Response::json($respond);
	}
	
	/**
	 * Display report
	 * 6 month
	 * paid
	 * 0-> not paid
	 * 1-> paid
	 * @return Response
	 */
	public function getHalfYearReport(){
		$respond = array();
		$report = Transaction::where('paid','=','1')->get();
		$bulan = date('n') -5;
		$tahun = date('Y');
		$idx = 1;
		$bulanAkhir = 6;
		$hasil = array();
		while($idx <= $bulanAkhir)
		{
			$tempHasil = 0;
			$tempBulan = Carbon::parse($tahun."-".$bulan."-01")->format('n');
			$tempBulanHsl = Carbon::parse($tahun."-".$bulan."-01")->format('F');
			$tempTahun = Carbon::parse($tahun."-01-01")->format('Y');
			foreach($report as $key)
			{
				$dd = $key->updated_at;
				$tahunCek = Carbon::parse($dd)->format('Y');
				$bulanCek = Carbon::parse($dd)->format('n');
				if($tahunCek == $tempTahun)
				{
					if($bulanCek == $tempBulan)
					{
						$tempHasil = $tempHasil + $key->total_price;
					}
				}
			}
			$hasil[] = array('tanggal'=>$tempBulanHsl, 'penjualan' => $tempHasil,'ket'=>'sixmonth','bulan'=>$tempBulanHsl.' '.$tempTahun);
			$idx = $idx + 1;
			$bulan = $bulan +1;
		}
		$respond = array('code'=>'200','status' => 'OK','messages'=>$hasil);
		
		return Response::json($respond);
	}
	
	public function getMostCurrentProdukOneMonth()
	{
		$bln = Input::get('bulanRepPro');
		$thn = Input::get('tahunRepPro');
		$prod = Input::get('idPro');
		
		$blnTemp = Carbon::parse($bln.'-01-'.$thn)->format('n');
		
		$respond = array();
		$report = Transaction::join('orders','transactions.id','=','orders.transaction_id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.id','=',$prod)->where(DB::raw('MONTH(transactions.updated_at)'), '=', $blnTemp)->where(DB::raw('YEAR(transactions.updated_at)'), '=', $thn)->where('transactions.paid','=','1')->get(array('transactions.id','orders.priceNow','transactions.updated_at','orders.quantity','products.id as idProduct'));
		$idx = 1;
		$tgl = date('t');
		$hasil = array();
		while($idx <= $tgl)
		{
			$tempHasil = 0;
			foreach($report as $key)
			{
				$dd = $key->updated_at;
				$created = Carbon::parse($dd)->format('d');
				if($created == $idx)
				{
					$tempHasil = $tempHasil + ($key->priceNow * $key->quantity);
				}
			}
			$hasil[] = array('tanggal' => $idx, 'penjualan' => $tempHasil,'bulan' => $bln.'-'.$thn);
			$idx = $idx + 1;
		}
		$respond = array('code'=>'200','status' => 'OK','messages'=>$hasil);
		
		return Response::json($respond);
	}
	
	public function getDetailMostCurrentProdukOneMonth()
	{
		$tgl = Input::get('tgl');
		$prodId = Input::get('id');
		$d1 = new Carbon($tgl);
		$blnTemp = Carbon::parse($d1)->format('n');
		$tglTemp = Carbon::parse($d1)->format('d');
		$thnTemp = Carbon::parse($d1)->format('Y');
		$respond = array();
		$report = Transaction::join('orders','transactions.id','=','orders.transaction_id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.id','=',$prodId)->where(DB::raw('MONTH(transactions.updated_at)'), '=', $blnTemp)->where(DB::raw('YEAR(transactions.updated_at)'), '=', $thnTemp)->where(DB::raw('DAY(transactions.updated_at)'), '=', $tglTemp)->where('transactions.paid','=','1')->get(array('transactions.invoice','orders.quantity','profiles.full_name'));
		if(count($report) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$report);
		}
		
		
		return Response::json($respond);
		
	}
	
	public function getMostCurrentProdukRange()
	{
		$date1 = Input::get('date1');
		$date2 = Input::get('date2');
		$prod = Input::get('idPro');
		
		$d1 = new Carbon($date1);
		$d2 = new Carbon($date2);
		
		$tgl1 = Carbon::parse($d1)->format('d');
		$bln1 = Carbon::parse($d1)->format('F');
		$thn1 = Carbon::parse($d1)->format('Y');
		
		$tgl2 = Carbon::parse($d2)->format('d');
		$bln2 = Carbon::parse($d2)->format('F');
		$thn2 = Carbon::parse($d2)->format('Y');
		
		$difference = ($d1->diff($d2)->days);
		
		
		
		$respond = array();
		$report = Transaction::join('orders','transactions.id','=','orders.transaction_id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('products.id','=',$prod)->where('transactions.paid','=','1')->get(array('transactions.id','orders.priceNow','transactions.updated_at','orders.quantity','products.id as idProduct'));
		
		
		$idx = 1;
		$hasil = array();
		while($idx <= ($difference+1))
		{
			$tempHasil = 0;
			if($idx != 1)
			{
				$d1->addDay(1);
			}
			foreach($report as $key)
			{
				$dd = $key->updated_at;
				$dd2 = Carbon::parse($dd)->format('Ynd');
				$dc1 = Carbon::parse($d1)->format('Ynd');
				if($dd2 == $dc1)
				{
					$tempHasil = $tempHasil +  ($key->priceNow * $key->quantity);
				}
				$tgl = Carbon::parse($d1)->format('d');
				$bln = Carbon::parse($d1)->format('F');
				$thn = Carbon::parse($d1)->format('Y');
				
			}
			$hasil[] = array('tanggal' => $tgl, 'penjualan' => $tempHasil,'bulan' => $bln.'-'.$thn);
				$idx = $idx + 1;
		}
		if($hasil != null)
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$hasil);
		}else
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		return Response::json($respond);
	}
	
	public function getPenjualanProdukOneMonth()
	{
		$bln = Input::get('bulanRepPro');
		$thn = Input::get('tahunRepPro');
		
		$blnTemp = Carbon::parse($bln.'-01-'.$thn)->format('n');
		
		$respond = array();
		$report = Transaction::join('orders','transactions.id','=','orders.transaction_id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where(DB::raw('MONTH(transactions.updated_at)'), '=', $blnTemp)->where(DB::raw('YEAR(transactions.updated_at)'), '=', $thn)->where('transactions.paid','=','1')->orderBy('products.id','asc')->get(array('transactions.id','orders.priceNow','transactions.updated_at','products.id as idProduct','orders.quantity'));
		$prod = Product::orderBy('id','asc')->get();
		
		$hasil = array();
		
			
		foreach($prod as $key)
		{
			$tempHasil = 0;
			$tempHasil2 = 0;
			foreach($report as $key2)
			{
				if($key->id == $key2->idProduct)
				{
					$qty = $key2->quantity;
					$price =  ($key2->priceNow * $key2->quantity);
					$tempHasil = $tempHasil + $price;
					$tempHasil2 = $tempHasil2 + $qty;
				}
			}
			if($tempHasil2 != 0)
			{
				$hasil[] = array('idProd' => $key->id, 'namaProd' => $key->name,'qty' => $tempHasil2,'penjualan'=>$tempHasil);
			}
		}
		
		if($hasil != null)
		{
			foreach($hasil as $key=>$row)
			{
				$qt[$key] = $row['qty'];
				$pro[$key] = $row['idProd'];
			}
			array_multisort($qt, SORT_DESC,$pro,SORT_ASC,$hasil);
			$respond = array('code'=>'200','status' => 'OK','messages'=>$hasil);
		}else
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		
		
		
		return Response::json($respond);
	}
	
	public function getPenjualanProdukRange()
	{
		$date1 = Input::get('date1');
		$date2 = Input::get('date2');
		
		$d1 = new Carbon($date1);
		$d2 = new Carbon($date2);
		
		$tgl1 = Carbon::parse($d1)->format('d');
		$bln1 = Carbon::parse($d1)->format('F');
		$thn1 = Carbon::parse($d1)->format('Y');
		
		$tgl2 = Carbon::parse($d2)->format('d');
		$bln2 = Carbon::parse($d2)->format('F');
		$thn2 = Carbon::parse($d2)->format('Y');
		
		$difference = ($d1->diff($d2)->days);
		
		
		
		$respond = array();
		$report = Transaction::join('orders','transactions.id','=','orders.transaction_id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->where('transactions.paid','=','1')->orderBy('products.id','asc')->get(array('transactions.id','orders.priceNow','transactions.updated_at','products.id as idProduct', 'orders.quantity'));
		$prod = Product::orderBy('id','asc')->get();
		
		$hasil = array();
		$idx = 1;
		
		foreach($prod as $key)
		{
			$tempHasil = 0;
			$tempHasil2 = 0;
			$idx = 1;
			$d1 = new Carbon($date1);
			while($idx <= ($difference+1))
			{
				if($idx != 1)
				{
					$d1->addDay(1);
				}
				foreach($report as $key2)
				{
					if($key->id == $key2->idProduct)
					{
						$dd = $key2->updated_at;
						$dd2 = Carbon::parse($dd)->format('Ynd');
						$dc1 = Carbon::parse($d1)->format('Ynd');
						if($dd2 == $dc1)
						{
							$qty = $key2->quantity;
							$price =  ($key2->priceNow * $key2->quantity);
							$tempHasil = $tempHasil + $price;
							$tempHasil2 = $tempHasil2 + $qty;
						}
					}
				}
				$idx = $idx + 1;
			}
			
			if($tempHasil2 != 0)
			{
				$hasil[] = array('idProd' => $key->id, 'namaProd' => $key->name,'qty' => $tempHasil2,'penjualan'=>$tempHasil);
			}
		}
		if($hasil != null)
		{
			foreach($hasil as $key=>$row)
			{
				$qt[$key] = $row['qty'];
				$pro[$key] = $row['idProd'];
			}
			array_multisort($qt, SORT_DESC,$pro,SORT_ASC,$hasil);
			$respond = array('code'=>'200','status' => 'OK','messages'=>$hasil);
		}else
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		return Response::json($respond);
	}
	
	public function getDetailPenjualanProduk()
	{
		$prod = Input::get('idProd');
		$bln = Input::get('bulanRepPro');
		$thn = Input::get('tahunRepPro');
		
		$blnTemp = Carbon::parse($bln.'-01-'.$thn)->format('n');
		$respond = array();
		$product = Product::where('products.id','=',$prod)->join('prices','prices.product_id','=','products.id')->join('orders','orders.price_id','=','prices.id')->join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('categories','products.category_id','=','categories.id')->join('attributes','prices.attr_id','=','attributes.id')->where(DB::raw('MONTH(transactions.updated_at)'), '=', $blnTemp)->where(DB::raw('YEAR(transactions.updated_at)'), '=', $thn)->where('transactions.paid','=','1')->get(array('profiles.full_name','transactions.invoice','transactions.updated_at','products.name as prodName','categories.name as catName','attributes.name as attName','prices.attr_value','orders.priceNow','orders.quantity'));
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)
			{
				$main_photo = Gallery::where('product_id','=',$prod)->where('type','=','main_photo')->first();
				if(count($main_photo) == 0)
				{
					$phot = "";
				}else
				{
					$phot = $main_photo->photo_path;
				}
				$key->path_photo = $phot;
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	public function getDetailPenjualanProdukRange()
	{
		$prod = Input::get('idProd');
		$date1 = Input::get('date1');
		$date2 = Input::get('date2');
		
		$d1 = new Carbon($date1);
		$d2 = new Carbon($date2);
		
		
		$difference = ($d1->diff($d2)->days);
		
		$respond = array();
		$product = Product::where('products.id','=',$prod)->join('prices','prices.product_id','=','products.id')->join('orders','orders.price_id','=','prices.id')->join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles', 'accounts.profile_id', '=', 'profiles.id')->join('categories','products.category_id','=','categories.id')->join('attributes','prices.attr_id','=','attributes.id')->where('transactions.paid','=','1')->get(array('profiles.full_name','transactions.invoice','transactions.updated_at','products.name as prodName','categories.name as catName','attributes.name as attName','prices.attr_value','orders.priceNow','orders.quantity'));
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($product as $key)
			{
				$main_photo = Gallery::where('product_id','=',$prod)->where('type','=','main_photo')->first();
				if(count($main_photo) == 0)
				{
					$phot = "";
				}else
				{
					$phot = $main_photo->photo_path;
				}
				$key->path_photo = $phot;
			}
			
			$idx = 1;
			$hasil = array();
			while($idx <= ($difference+1))
			{
				
				if($idx != 1)
				{
					$d1->addDay(1);
				}
				foreach($product as $key)
				{
					$dd = $key->updated_at;
					$dd2 = Carbon::parse($dd)->format('Ynd');
					$dc1 = Carbon::parse($d1)->format('Ynd');
					if($dd2 == $dc1)
					{
						$dd3 =  Carbon::parse($dd2)->format('Y-n-d');
						$hasil[] = array('full_name'=>$key->full_name,'invoice'=>$key->invoice,'updated_at'=>$dd3,'prodName'=>$key->prodName,'catName'=>$key->catName,'attName'=>$key->attName,'attr_value'=>$key->attr_value,'priceNow'=>$key->priceNow,'quantity'=>$key->quantity);
					}
				}
				$idx = $idx + 1;
			}
			if($hasil != null)
			{
				$respond = array('code'=>'200','status' => 'OK','messages'=>$hasil);
			}else
			{
				$respond = array('code'=>'404','status' => 'Not Found');
			}
		}
		return Response::json($respond);
	}
	
	public function getDetailPopUp()
	{
		$id = Input::get('id');
		$trans = Transaction::where('transactions.id','=',$id)->join('orders','orders.transaction_id','=','transactions.id')->join('prices','orders.price_id','=','prices.id')->join('products','prices.product_id','=','products.id')->join('categories','products.category_id','=','categories.id')->join('attributes','prices.attr_id','=','attributes.id')->get(array('transactions.invoice','products.id','products.name','categories.name as catName','attributes.name as attName','prices.attr_value','orders.priceNow','orders.quantity','transactions.paid','transactions.status','transactions.updated_at'));
		if(count($trans) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}else
		{
			foreach($trans as $key)
			{
				$main_photo = Gallery::where('product_id','=',$key->id)->where('type','=','main_photo')->first();
				if(count($main_photo) == 0)
				{
					$phot = "";
				}else
				{
					$phot = $main_photo->photo_path;
				}
				$key->path_photo = $phot;
			}
			$respond = array('code'=>'200','status' => 'OK','messages'=>$trans);
		}
		
		return Response::json($respond);
	}
	
	public function getStatusMonth()
	{
		$stat = Input::get('status');
		$bln = Input::get('bulanRepPro');
		$thn = Input::get('tahunRepPro');
		$blnTemp = Carbon::parse($bln.'-01-'.$thn)->format('n');

		
		$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->where(DB::raw('MONTH(transactions.updated_at)'), '=', $blnTemp)->where(DB::raw('YEAR(transactions.updated_at)'), '=', $thn)->join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->join('shipments','transactions.shipment_id','=','shipments.id')->join('shipmentdatas','shipments.shipmentData_id','=','shipmentdatas.id')->where('transactions.status','=',$stat)->distinct()->get(array('transactions.id','profiles.full_name','transactions.invoice','shipments.number','shipmentdatas.courier','shipmentdatas.destination','transactions.updated_at'));
		
		if(count($order) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$order);
		}
		
		return Response::json($respond);
	}
	
	public function getStatusRange()
	{
		$stat = Input::get('status');
		
		$date1 = Input::get('date1');
		$date2 = Input::get('date2');
		
		$d1 = new Carbon($date1);
		$d2 = new Carbon($date2);
		
		
		$difference = ($d1->diff($d2)->days);
		
		$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->join('shipments','transactions.shipment_id','=','shipments.id')->join('shipmentdatas','shipments.shipmentData_id','=','shipmentdatas.id')->where('transactions.status','=',$stat)->distinct()->get(array('transactions.id','profiles.full_name','transactions.invoice','shipments.number','shipmentdatas.courier','shipmentdatas.destination','transactions.updated_at'));
		
		$idx = 1;
		$hasil = array();
		while($idx <= ($difference+1))
		{
			
			if($idx != 1)
			{
				$d1->addDay(1);
			}
			foreach($order as $key)
			{
				$dd = $key->updated_at;
				$dd2 = Carbon::parse($dd)->format('Ynd');
				$dc1 = Carbon::parse($d1)->format('Ynd');
				if($dd2 == $dc1)
				{
					$dd3 =  Carbon::parse($dd2)->format('Y-n-d');
					$hasil[] = array('id'=>$key->id,'full_name'=>$key->full_name,'invoice'=>$key->invoice,'updated_at'=>$dd3,'number'=>$key->number,'courier'=>$key->courier,'destination'=>$key->destination);
				}
			}
			$idx = $idx + 1;
		}
		if($hasil != null)
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$hasil);
		}else
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		
		return Response::json($respond);
	}
	
	public function getAllStatusMonth()
	{
		$bln = Input::get('bulanRepPro');
		$thn = Input::get('tahunRepPro');
		$blnTemp = Carbon::parse($bln.'-01-'.$thn)->format('n');
		
		
		$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->where(DB::raw('MONTH(transactions.updated_at)'), '=', $blnTemp)->where(DB::raw('YEAR(transactions.updated_at)'), '=', $thn)->join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->join('shipments','transactions.shipment_id','=','shipments.id')->join('shipmentdatas','shipments.shipmentData_id','=','shipmentdatas.id')->distinct()->get(array('transactions.id','profiles.full_name','transactions.invoice','shipments.number','shipmentdatas.courier','shipmentdatas.destination','transactions.updated_at','transactions.status'));
		
		if(count($order) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$order);
		}
		
		return Response::json($respond);
	}
	
	public function getAllStatusRange()
	{
		
		$date1 = Input::get('date1');
		$date2 = Input::get('date2');
		
		$d1 = new Carbon($date1);
		$d2 = new Carbon($date2);
		
		
		$difference = ($d1->diff($d2)->days);
		
		$order = Order::join('transactions','orders.transaction_id','=','transactions.id')->join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->join('shipments','transactions.shipment_id','=','shipments.id')->join('shipmentdatas','shipments.shipmentData_id','=','shipmentdatas.id')->distinct()->get(array('transactions.id','profiles.full_name','transactions.invoice','shipments.number','shipmentdatas.courier','shipmentdatas.destination','transactions.updated_at','transactions.status'));
		
		$idx = 1;
		$hasil = array();
		while($idx <= ($difference+1))
		{
			
			if($idx != 1)
			{
				$d1->addDay(1);
			}
			foreach($order as $key)
			{
				$dd = $key->updated_at;
				$dd2 = Carbon::parse($dd)->format('Ynd');
				$dc1 = Carbon::parse($d1)->format('Ynd');
				if($dd2 == $dc1)
				{
					$dd3 =  Carbon::parse($dd2)->format('Y-n-d');
					$hasil[] = array('id'=>$key->id,'full_name'=>$key->full_name,'invoice'=>$key->invoice,'updated_at'=>$dd3,'number'=>$key->number,'courier'=>$key->courier,'destination'=>$key->destination,'status'=>$key->status);
				}
			}
			$idx = $idx + 1;
		}
		if($hasil != null)
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$hasil);
		}else
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		
		return Response::json($respond);
	}
	
	public function getPaidMonth()
	{
		$paid = Input::get('status');
		$bln = Input::get('bulanRepPro');
		$thn = Input::get('tahunRepPro');
		$blnTemp = Carbon::parse($bln.'-01-'.$thn)->format('n');

		
		$order = Transaction::where(DB::raw('MONTH(transactions.updated_at)'), '=', $blnTemp)->where(DB::raw('YEAR(transactions.updated_at)'), '=', $thn)->join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->where('transactions.paid','=',$paid)->get(array('transactions.id','profiles.full_name','transactions.invoice','transactions.status','transactions.total_price','transactions.paid'));
		
		if(count($order) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$order);
		}
		
		return Response::json($respond);
	}
	
	public function getPaidRange()
	{
		$stat = Input::get('status');
		
		$date1 = Input::get('date1');
		$date2 = Input::get('date2');
		
		$d1 = new Carbon($date1);
		$d2 = new Carbon($date2);
		
		
		$difference = ($d1->diff($d2)->days);
		
		$order = Transaction::join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->where('transactions.paid','=',$stat)->get(array('transactions.id','profiles.full_name','transactions.invoice','transactions.total_price','transactions.updated_at','transactions.paid'));
		
		$idx = 1;
		$hasil = array();
		while($idx <= ($difference+1))
		{
			
			if($idx != 1)
			{
				$d1->addDay(1);
			}
			foreach($order as $key)
			{
				$dd = $key->updated_at;
				$dd2 = Carbon::parse($dd)->format('Ynd');
				$dc1 = Carbon::parse($d1)->format('Ynd');
				if($dd2 == $dc1)
				{
					$dd3 =  Carbon::parse($dd2)->format('Y-n-d');
					$hasil[] = array('id'=>$key->id,'full_name'=>$key->full_name,'invoice'=>$key->invoice,'total_price'=>$key->total_price,'paid'=>$key->paid);
				}
			}
			$idx = $idx + 1;
		}
		if($hasil != null)
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$hasil);
		}else
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		
		return Response::json($respond);
	}
	
	public function getAllPaidMonth()
	{
		$bln = Input::get('bulanRepPro');
		$thn = Input::get('tahunRepPro');
		$blnTemp = Carbon::parse($bln.'-01-'.$thn)->format('n');

		
		$order = Transaction::where(DB::raw('MONTH(transactions.updated_at)'), '=', $blnTemp)->where(DB::raw('YEAR(transactions.updated_at)'), '=', $thn)->join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->get(array('transactions.id','profiles.full_name','transactions.invoice','transactions.status','transactions.total_price','transactions.paid'));
		
		if(count($order) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$order);
		}
		
		return Response::json($respond);
	}
	
	public function getAllPaidRange()
	{
		
		$date1 = Input::get('date1');
		$date2 = Input::get('date2');
		
		$d1 = new Carbon($date1);
		$d2 = new Carbon($date2);
		
		
		$difference = ($d1->diff($d2)->days);
		
		$order = Transaction::join('accounts','transactions.account_id','=','accounts.id')->join('profiles','accounts.profile_id','=','profiles.id')->get(array('transactions.id','profiles.full_name','transactions.invoice','transactions.total_price','transactions.updated_at','transactions.paid'));
		
		$idx = 1;
		$hasil = array();
		while($idx <= ($difference+1))
		{
			
			if($idx != 1)
			{
				$d1->addDay(1);
			}
			foreach($order as $key)
			{
				$dd = $key->updated_at;
				$dd2 = Carbon::parse($dd)->format('Ynd');
				$dc1 = Carbon::parse($d1)->format('Ynd');
				if($dd2 == $dc1)
				{
					$dd3 =  Carbon::parse($dd2)->format('Y-n-d');
					$hasil[] = array('id'=>$key->id,'full_name'=>$key->full_name,'invoice'=>$key->invoice,'total_price'=>$key->total_price,'paid'=>$key->paid);
				}
			}
			$idx = $idx + 1;
		}
		if($hasil != null)
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$hasil);
		}else
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		
		return Response::json($respond);
	}
	
	public function send_progress()
	{
		$ket = Input::get('ket');
		$invoice = Input::get('invoice');
		$kurir = Input::get('kurir');
		$noResi = Input::get('noresi');
		
		//$profileController = new ProfilesController();
		//$profilesJson = $profileController->getAll();
		/*
		$json = json_decode($profilesJson->getContent());
		$paginator = $json->{'messages'};
		foreach($paginator as $prof)
		{
			$data = array(
				'body'=>$body
			);
			$address = array(
				'email'=>$prof->email,
				'subject'=>'newsletter'
			);
			
			Mail::queue('emails.newsletter', $data, function($message) use($address)
			{
				$message->to($address['email'])->subject($address['subject']);
			});
			
		}
		*/
		
		$isi = "Transaksi Anda dengan nomor invoice ".$invoice." sedang dalam proses ".$ket;
		if($ket == "On-shipping")
		{
			$isi = $isi." dengan menggunakan ".$kurir." dengan nomor resi ".$noResi;
		}
		$data = array(
				'body'=>$isi
		);
		$address = array(
			'email'=>'davidsenjayagm@gmail.com',
			'subject'=>'Perubahan status transaksi no.'.$invoice
		);
		
		Mail::queue('emails.transaction_admin', $data, function($message) use($address)
		{
			$message->to($address['email'])->subject($address['subject']);
		});
		return $respond = array('code'=>'200','status' => 'OK');
	}
}
