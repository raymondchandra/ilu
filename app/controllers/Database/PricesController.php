<?php

class PricesController extends \BaseController {

	public function w_insert()
	{
		$json = Input::get('json_data');
		$decode = json_decode($json);
		
		$attr_id = $decode->{'attr_id'};
		$attr_value = $decode->{'attr_value'};
		$product_id = $decode->{'product_id'};		
		$amount = $decode->{'amount'};
		$tax_id = $decode->{'tax_id'};
		
		$input = array(
					'attr_id' => $attr_id,
					'attr_value' => $attr_value,
					'product_id' => $product_id,
					'amount' => $amount,
					'tax_id' => $tax_id);			
					
		return $this->insert($input);
	}
	public function insert($input)
	{
		// $input = json_decode(Input::all());
		
		$respond = array();
		//validate
		$validator = Validator::make($data = $input, Price::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			Price::create($data);
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}
	
	public function additionalPrices($status, $additional_attribute_id, $additional_attribute_value, $additional_price_value, $product_id)
	{
		$respond = array();
		if($status == "kosong") //ga nambah apa"
		{
			//do nothing
		}
		else
		{
			$length = count($additional_attribute_id);
			for($i=0 ; $i<$length ; $i++)
			{
				$price = new Price();
				$price->attr_id = $additional_attribute_id[$i];
				$price->attr_value = $additional_attribute_value[$i];
				$price->product_id = $product_id;
				// $price->product_id = 5; //sementara
				$price->amount = $additional_price_value[$i];
				$price->tax_id = 1; //default sementara
				try{
					$price->save();
				}catch(Exception $e){
					$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
						return Response::json($respond);	
				}
			}
			$respond = array('code'=>'201','status' => 'Created');
		}
		return Response::json($respond);
	}
	
	public function getAll(){
		$respond = array();
		$price = Price::all();
		if (count($price) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$price);
		}
		return Response::json($respond);
	}
	
	public function getById($id)
	{
		$respond = array();
		$price = Price::find($id);
		if (count($price) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$price);
		}
		return Response::json($respond);
	}
	
	public function getByAttrId($attr_id)
	{
		$respond = array();
		$price = Price::where('attr_id','=',$attr_id)->get();
		if (count($price) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$price);
		}
		return Response::json($respond);
	}	
	
	public function getByAttrValue($attr_value)
	{
		$respond = array();
		$price = Price::where('attr_value','LIKE','%'.$attr_value.'%')->get();
		if (count($price) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$price);
		}
		return Response::json($respond);
	}	
	
	public function getByProductId($product_id)
	{
		$respond = array();
		$price = Price::where('product_id','=',$product_id)->get();
		if (count($price) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$price);
		}
		return Response::json($respond);
	}	
	
	public function getByAmountLessThanEquals($amount)
	{
		$respond = array();
		$price = Price::where('amount','<=',$amount)->get();
		if (count($price) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$price);
		}
		return Response::json($respond);
	}
	
	public function getByAmountMoreThanEquals($amount)
	{
		$respond = array();
		$price = Price::where('amount','>=',$amount)->get();
		if (count($price) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$price);
		}
		return Response::json($respond);
	}
	
	public function updateFull($id)
	{
		$respond = array();
		$price = Price::find($id);
		if ($price == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$input = json_decode(Input::all());

			//validate
			$validator = Validator::make($data = $input, Price::$rules);

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			//save
			try {
				$price->update($data);
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
		$price = Price::find($id);		
		if ($price == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$price->delete();
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
		$price = Price::find($id);
		if ($price == null)
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
