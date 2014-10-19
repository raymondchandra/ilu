<?php

class TaxesController extends \BaseController {

	public function w_insert()
	{
		$json = Input::get('json_data');
		$decode = json_decode($json);
				
		$name = $decode->{'name'};		
		$amount = $decode->{'amount'};		
		
		$input = array(
					'name' => $name,
					'amount' => $amount,
					'deleted' => 0);
					
		return $this->insert($input);
	}
	//input : name, amount, deleted
	public function insert($input)
	{
		// $input = json_decode(Input::all());
		
		$respond = array();
		//validate
		$validator = Validator::make($data = $input, Tax::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			Tax::create([
					'name' => $input['name'],
					'amount' => $input['amount'],
					'deleted' => $input['deleted']]);
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}
	
	public function getAll(){
		$respond = array();
		$tax = Tax::all();
		if (count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedNameAsc()
	{
		$respond = array();
		$tax = Tax::orderBy('name')->get();
		if (count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedNameDesc()
	{
		$respond = array();
		$tax = Tax::orderBy('name', 'desc')->get();
		if (count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedAmountAsc()
	{
		$respond = array();
		$tax = Tax::orderBy('amount')->get();
		if (count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedAmountDesc()
	{
		$respond = array();
		$tax = Tax::orderBy('amount', 'desc')->get();
		if (count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
		return Response::json($respond);
	}
	
	// asumsi :
		// kalo field input integer ada yang kosong maka -1
		// kalo field input string ada yang kosong maka dapetnya ""
	// input : name, amount
	public function searchTax($input)
	{
		$respond = array();
		$tax = Tax::where('name', 'LIKE', '%'.$input['name'].'%')
					->where('amount', '=', $input['amount'])->get();
		
		if(count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
	}
	
	public function searchTaxSortedNameAsc($input)
	{
		$respond = array();
		$tax = Tax::where('name', 'LIKE', '%'.$input['name'].'%')
					->where('amount', '=', $input['amount'])
					->orderBy('name')->get();
		
		if(count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
	}
	
	public function searchTaxSortedNameDesc($input)
	{
		$respond = array();
		$tax = Tax::where('name', 'LIKE', '%'.$input['name'].'%')
					->where('amount', '=', $input['amount'])
					->orderBy('name', 'desc')->get();
		
		if(count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
	}
	
	public function searchTaxSortedAmountAsc($input)
	{
		$respond = array();
		$tax = Tax::where('name', 'LIKE', '%'.$input['name'].'%')
					->where('amount', '=', $input['amount'])
					->orderBy('amount')->get();
		
		if(count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
	}
	
	public function searchTaxSortedAmountDesc($input)
	{
		$respond = array();
		$tax = Tax::where('name', 'LIKE', '%'.$input['name'].'%')
					->where('amount', '=', $input['amount'])
					->orderBy('amount', 'desc')->get();
		
		if(count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
	}
	
	public function getById($id)
	{
		$respond = array();
		$tax = Tax::find($id);
		if (count($tax) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$tax);
		}
		return Response::json($respond);
	}
	
	// input : name, amount
	public function updateFull($id, $input)
	{
		$respond = array();
		$tax = Tax::find($id);
		if ($tax == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{				
			//add deleted to input
			$input['deleted'] = $tax->deleted;
			
			//validate 
			$validator = Validator::make($data = $input, Tax::$rules);
			
			if($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			
			//save
			try {
				$tax->update($data);
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	public function updateDeleted($id, $new_deleted)
	{
		$respond = array();
		$tax = Tax::find($id);
		if ($tax == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{			
			//edit value
			$tax->deleted = $new_deleted;
			//save
			try {
				$tax->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
		}
		return Response::json($respond);
	}

	public function delete($id)
	{
		$respond = array();
		$tax = Tax::find($id);
		if ($tax == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$tax->delete();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}

	public function exist($id)
	{
		$respond = array();
		$tax = Tax::find($id);
		if ($tax == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK');
		}
		return Response::json($respond);
	}	

}
