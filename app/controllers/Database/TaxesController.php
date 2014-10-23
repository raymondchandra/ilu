<?php

class TaxesController extends \BaseController {

	public function view_main_tax()
	{
		$tax_json = $this->getAll();
		$paginator = json_decode($tax_json->getContent())->{'messages'};
		$perPage = 5;   
		$page = Input::get('page', 1);
		if ($page > count($paginator) or $page < 1) { $page = 1; }
		$offset = ($page * $perPage) - $perPage;
		$articles = array_slice($paginator,$offset,$perPage);
		$datas = Paginator::make($articles, count($paginator), $perPage);		
		
		return View::make('pages.admin.tax.manage_tax',compact('datas'));				
	}

	// public function view_main_taxNameAsc()
	// {
	// }
	
	// public function view_main_taxNameDesc()
	// {
	// }
	
	// public function view_main_taxAmountAsc()
	// {
	// }
	
	// public function view_main_taxAmountDesc()
	// {
	// }
	
	public function view_detail_tax($id)
	{
		$json = json_decode($this->getById($id)->getContent());
		return json_encode($json);
	}
	
	// public function view_search_tax()
	// {
	// }
	
	public function view_search_tax()
	{				
		$json_data = Input::get('json_data');
		$json = json_decode($json_data);
						
		$name = $json->{'name'};
		$amount = $json->{'amount'};
		
		if($amount == ""){
			$amount = -1;
		}
		
		$input = array(				
				'name' => $name,
				'amount' => $amount
		);
		
		$tax_json = $this->searchTax($input);		
		$decode = json_decode($tax_json->getContent());
		if($decode->code==404)
		{
			//not found
			$datas = null;
		}
		else
		{		
			$temp = json_decode($tax_json->getContent())->{'messages'};					
			$result = array();
			foreach($temp as $key)						
			{
				$result[] = $key;
			}
			$datas = $result;			
		}						
		return $datas;
	}		
	
	public function addTax()
	{
		$json_data = Input::get('json_data');
		$json = json_decode($json_data);
		
		$name = $json->{'name'};
		$amount = $json->{'amount'};
		$deleted = $json->{'deleted'};			
		
		$input = array(
				'name' => $name,
				'amount' => $amount,
				'deleted' => $deleted
		);
				
		$json = json_decode($this->insert($input)->getContent());
		return json_encode($json);
	}
	
	// input : name, amount
	// public function updateFull($id, $input)
	public function editFull()
	{
		$json_data = Input::get('json_data');
		$json = json_decode($json_data);
		
		$id = $json->{'id'};
		$name = $json->{'name'};
		$amount = $json->{'amount'};	

		$input = array(
			'name' => $name,
			'amount' => $amount
		);
				
		$json = json_decode($this->updateFull($id, $input)->getContent());
		return json_encode($json);
	}

	// public function w_insert()
	// {
		// $json = Input::get('json_data');
		// $decode = json_decode($json);
				
		// $name = $decode->{'name'};		
		// $amount = $decode->{'amount'};		
		
		// $input = array(
					// 'name' => $name,
					// 'amount' => $amount,
					// 'deleted' => 0);
					
		// return $this->insert($input);
	// }
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
		return Response::json($respond);
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
		return Response::json($respond);
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
		return Response::json($respond);
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
		return Response::json($respond);
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
		return Response::json($respond);
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
				// $tax->name = $input['name'];
				// $tax->amount = $input['amount'];
				// $tax->deleted = $input['deleted'];
				// $tax->save();
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
