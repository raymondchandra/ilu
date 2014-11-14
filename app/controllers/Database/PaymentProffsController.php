<?php

class PaymentProffsController extends \BaseController {

	public function w_insert()
	{
		$json = Input::get('json_data');
		$decode = json_decode($json);
		
		$invoice = $decode->{'invoice'};
		$nama_pembayar = $decode->{'nama_pembayar'};
		$id_bank = $decode->{'id_bank'};
		$bank_asal = $decode->{'bank_asal'};
		$norek_asal = $decode->{'norek_asal'};
		$nominal = $decode->{'nominal'}; //amount
		
		$input = array(
					'invoice' => $invoice,
					'nama_pembayar' => $nama_pembayar,
					'id_bank' => $id_bank,
					'bank_asal' => $bank_asal,
					'norek_asal' => $norek_asal,
					'nominal' => $nominal
		);
		
		return $this->insert($input);
	}
	public function insert($input)
	{
		$respond = array();
		//validate
		$validator = Validator::make($data = $input, PaymentProff::$rules);
		
		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			PaymentProff::create($data);
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}
	
	public function getAll()
	{
		$respond = array();
		$paymentproff = DB::table('paymentproff AS paypro')
						->join('banks AS ban', 'paypro.id_bank', '=', 'ban.id')
						-orderBy('created_at', 'desc')
						->get();
		if(count($paymentproff) == 0)
		{
			$respond = array('code'=>'404','status'=>'Not Found');
		}
		else
		{			
			$respond = array('code'=>'200','status'=>'OK','messages'=>$paymentproff);
		}
		return Response::json($respond);
	}
	
}