<?php

class PromotionsController extends \BaseController {
	
	/*
	public function w_insert()
	{
		$json = Input::get('json_data');
		$decode = json_decode($json);
		
		$name = $decode->{'name'};
		$amount = $decode->{'amount'};
		// $operator = $decode->{'operator'};
		$started = $decode->{'started'};
		$expired = $decode->{'expired'};
		// $active = $decode->{'active'};
		
		//products
		$input_products = $decode->{'products'}; //products = array of id product
		
		//asumsi active nya pasti 0 dulu ---> belum active
		$input_promotion = array(
					'name' => $name,
					'amount' => $amount,				
					'started' => $started,
					'expired' => $expired,
					'active' => 0);
		
		return $this->insert($input_promotion, $input_products);
	}
	*/
	
	// asumsi : 
		// bisa tambah product langsung tanpa harus ada foto
		// kalo main_photo atau other_photos kosong maka dapetnya ""
	// input : name, amount, started, expired, active, products(array)
	public function insert($input)
	{	
		$input_promotion = array(
				'name' => $input['name'],
				'amount' => $input['amount'],
				'start_date' => $input['start_date'],
				'expired' => $input['expired'],
				'active' => $input['active']
		);
		$input_products = $input['products'];	
		
		$respond = array();
		//validate
		$validator = Validator::make($data = $input_promotion, Promotion::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			$promotion = new Promotion();
			$promotion->name = $input_promotion['name'];
			$promotion->amount = $input_promotion['amount'];
			$promotion->start_date = $input_promotion['start_date'];
			$promotion->expired = $input_promotion['expired'];
			$promotion->active = $input_promotion['active'];
			$promotion->save();
			
			$products = $input_products; //array of id products
			$product_cont = new ProductsController();
			foreach($products as $key)				
			{				
				$product_cont->updatePromotionId($key, $promotion->id);
			}
				
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		// return $respond['code'];
		return Response::json($respond);
	}	
	
	/*
	public function getAllProducts()
	{
		$respond = array();
		$product_cont = new ProductsController();
		$json_products = $product_cont->getAll();
							
		$decode = json_decode($json_products->getContent());
		
		$code = $decode->{'code'};
		if($code == 404) //not found
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else //found
		{
			$product = $decode->{'messages'};
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		
		return Response::json($respond);						
	}
	*/
	
	// return array promotion :
		// id, name, amount, start_date, expired, active
		// product yang termasuk ke dalam promosi 
	public function getAll()
	{
		$respond = array();
		$promotion = Promotion::all();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{							
			foreach($promotion as $key)
			{
				$product_cont = new ProductsController();
				$json_products = $product_cont->getByPromotionId($key->id);
				$decode = json_decode($json_products->getContent());
				$code = $decode->{'code'};
				if($code == 404) //not found
				{
					$key->products = "";
				}
				else
				{					
					$key->products = $decode->{'messages'};
				}
			}				
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	// return array promotion :
		// id, name, amount, start_date, expired, active
		// product yang termasuk ke dalam promosi 
	//SORTED : name, amount
	public function getAllSorted($by, $type)
	{
		$respond = array();
		$promotion = Promotion::orderBy($by, $type)->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{							
			foreach($promotion as $key)
			{
				$product_cont = new ProductsController();
				$json_products = $product_cont->getByPromotionId($key->id);
				$decode = json_decode($json_products->getContent());
				$code = $decode->{'code'};
				if($code == 404) //not found
				{
					$key->products = "";
				}
				else
				{					
					$key->products = $decode->{'messages'};
				}
			}				
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	// return array promotion :
		// id, name, amount, start_date, expired, active
		// product yang termasuk ke dalam promosi 
	//SEARCH : name, amount
	public function getFilteredPromotion($name, $amount)
	{
		$respond = array();
		$promotion = Promotion::where('name', 'LIKE', '%'.$name.'%');
		if($amount != -1)
		{
			$promotion = $promotion->where('amount', '=', $amount);
		}
		$promotion = $promotion->get();				
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{							
			foreach($promotion as $key)
			{
				$product_cont = new ProductsController();
				$json_products = $product_cont->getByPromotionId($key->id);
				$decode = json_decode($json_products->getContent());
				$code = $decode->{'code'};
				if($code == 404) //not found
				{
					$key->products = "";
				}
				else
				{					
					$key->products = $decode->{'messages'};
				}
			}				
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	// return array promotion :
		// id, name, amount, start_date, expired, active
		// product yang termasuk ke dalam promosi 
	//SEARCH : name, amount
	//SORTED : name, amount
	public function getFilteredPromotionSorted($name, $amount, $sortBy, $sortType)
	{
		$respond = array();
		$promotion = Promotion::where('name', 'LIKE', '%'.$name.'%');
		if($amount != -1)
		{
			$promotion = $promotion->where('amount', '=', $amount);
		}
		$promotion = $promotion->orderBy($sortBy, $sortType)->get();				
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{							
			foreach($promotion as $key)
			{
				$product_cont = new ProductsController();
				$json_products = $product_cont->getByPromotionId($key->id);
				$decode = json_decode($json_products->getContent());
				$code = $decode->{'code'};
				if($code == 404) //not found
				{
					$key->products = "";
				}
				else
				{					
					$key->products = $decode->{'messages'};
				}
			}				
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	/*	
	public function getAllSortedNameAsc()
	{
		$respond = array();
		$promotion = Promotion::orderBy('name')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{							
			foreach($promotion as $key)
			{
				$product_cont = new ProductsController();
				$json_products = $product_cont->getByPromotionId($key->id);
				$decode = json_decode($json_products->getContent());
				$code = $decode->{'code'};
				if($code == 404) //not found
				{
					$key->products = "";
				}
				else
				{					
					$key->products = $decode->{'messages'};
				}
			}				
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedNameDesc()
	{
		$respond = array();
		$promotion = Promotion::orderBy('name', 'desc')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{							
			foreach($promotion as $key)
			{
				$product_cont = new ProductsController();
				$json_products = $product_cont->getByPromotionId($key->id);
				$decode = json_decode($json_products->getContent());
				$code = $decode->{'code'};
				if($code == 404) //not found
				{
					$key->products = "";
				}
				else
				{					
					$key->products = $decode->{'messages'};
				}
			}				
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedAmountAsc()
	{
		$respond = array();
		$promotion = Promotion::orderBy('amount')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{							
			foreach($promotion as $key)
			{
				$product_cont = new ProductsController();
				$json_products = $product_cont->getByPromotionId($key->id);
				$decode = json_decode($json_products->getContent());
				$code = $decode->{'code'};
				if($code == 404) //not found
				{
					$key->products = "";
				}
				else
				{					
					$key->products = $decode->{'messages'};
				}
			}				
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
		
	public function getAllSortedAmountDesc(){
		$respond = array();
		$promotion = Promotion::orderBy('amount', 'desc')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{							
			foreach($promotion as $key)
			{
				$product_cont = new ProductsController();
				$json_products = $product_cont->getByPromotionId($key->id);
				$decode = json_decode($json_products->getContent());
				$code = $decode->{'code'};
				if($code == 404) //not found
				{
					$key->products = "";
				}
				else
				{					
					$key->products = $decode->{'messages'};
				}
			}				
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	// asumsi : 
		// kalo field input integer atau float ada yang kosong maka -1
		// kalo field input string ada yang kosong maka dapetnya ""
	// input : name, amount
	public function searchPromotion($input)
	{
		$respond = array();
		$promotion = Promotion::where('name', 'LIKE', '%'.$input['name'].'%');		
		
		if($input['amount'] != -1)
		{
			$promotion = $promotion->where('amount', '=', $input['amount']);
		}
		
		$promotion = $promotion->get();
		
		if(count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($promotion as $key)
			{
				$product_cont = new ProductsController();
				$json_products = $product_cont->getByPromotionId($key->id);
				$decode = json_decode($json_products->getContent());
				$code = $decode->{'code'};
				if($code == 404) //not found
				{
					$key->products = "";
				}
				else
				{					
					$key->products = $decode->{'messages'};
				}
			}				
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		
		return Response::json($respond);
	}
	
	public function searchPromotionSortedNameAsc($input)
	{
		$respond = array();
		$promotion = Promotion::where('name', 'LIKE', '%'.$input['name'].'%');		
		
		if($input['amount'] != -1)
		{
			$promotion = $promotion->where('amount', '=', $input['amount']);
		}
		
		//sorting
		$promotion = $promotion->orderBy('name')->get();
		
		if(count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($promotion as $key)
			{
				$product_cont = new ProductsController();
				$json_products = $product_cont->getByPromotionId($key->id);
				$decode = json_decode($json_products->getContent());
				$code = $decode->{'code'};
				if($code == 404) //not found
				{
					$key->products = "";
				}
				else
				{					
					$key->products = $decode->{'messages'};
				}
			}										
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		
		return Response::json($respond);
	}
	
	public function searchPromotionSortedNameDesc($input)
	{
		$respond = array();
		$promotion = Promotion::where('name', 'LIKE', '%'.$input['name'].'%');		
		
		if($input['amount'] != -1)
		{
			$promotion = $promotion->where('amount', '=', $input['amount']);
		}
		
		//sorting
		$promotion = $promotion->orderBy('name', 'desc')->get();
		
		if(count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($promotion as $key)
			{
				$product_cont = new ProductsController();
				$json_products = $product_cont->getByPromotionId($key->id);
				$decode = json_decode($json_products->getContent());
				$code = $decode->{'code'};
				if($code == 404) //not found
				{
					$key->products = "";
				}
				else
				{					
					$key->products = $decode->{'messages'};
				}
			}										
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		
		return Response::json($respond);
	}
	
	public function searchPromotionSortedAmountAsc($input)
	{
		$respond = array();
		$promotion = Promotion::where('name', 'LIKE', '%'.$input['name'].'%');		
		
		if($input['amount'] != -1)
		{
			$promotion = $promotion->where('amount', '=', $input['amount']);
		}
		
		//sorting
		$promotion = $promotion->orderBy('amount')->get();
		
		if(count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($promotion as $key)
			{
				$product_cont = new ProductsController();
				$json_products = $product_cont->getByPromotionId($key->id);
				$decode = json_decode($json_products->getContent());
				$code = $decode->{'code'};
				if($code == 404) //not found
				{
					$key->products = "";
				}
				else
				{					
					$key->products = $decode->{'messages'};
				}
			}										
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		
		return Response::json($respond);
	}
	
	public function searchPromotionSortedAmountDesc($input)
	{
		$respond = array();
		$promotion = Promotion::where('name', 'LIKE', '%'.$input['name'].'%');		
		
		if($input['amount'] != -1)
		{
			$promotion = $promotion->where('amount', '=', $input['amount']);
		}
		
		//sorting
		$promotion = $promotion->orderBy('amount', 'desc')->get();
		
		if(count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($promotion as $key)
			{
				$product_cont = new ProductsController();
				$json_products = $product_cont->getByPromotionId($key->id);
				$decode = json_decode($json_products->getContent());
				$code = $decode->{'code'};
				if($code == 404) //not found
				{
					$key->products = "";
				}
				else
				{					
					$key->products = $decode->{'messages'};
				}
			}										
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		
		return Response::json($respond);
	}
	
	
	/*
	public function getAllSortedStartedAsc(){
		$respond = array();
		$promotion = Promotion::orderBy('started')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedStartedDesc(){
		$respond = array();
		$promotion = Promotion::orderBy('started', 'desc')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedExpiredAsc(){
		$respond = array();
		$promotion = Promotion::orderBy('expired')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
		
	public function getAllSortedExpiredDesc(){
		$respond = array();
		$promotion = Promotion::orderBy('expired', 'desc')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	*/
	
	public function getById($id)
	{
		$respond = array();
		$promotion = Promotion::find($id);
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{		
			$product_cont = new ProductsController();
			$json_products = $product_cont->getByPromotionId($promotion->id);
			$decode = json_decode($json_products->getContent());
			$code = $decode->{'code'};
			if($code == 404) //not found
			{
				$promotion->products = "";
			}
			else
			{					
				$promotion->products = $decode->{'messages'};
			}
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	public function getProductFromNewestPromotion()
	{
		$respond = array();
		
		$promotion = Promotion::orderBy('created_at', 'desc')->take(1)->get();				
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{					
			$product_cont = new ProductsController();
			$json_products = $product_cont->getByPromotionId($promotion[0]->id);									
			$decode = json_decode($json_products->getContent());
			$code = $decode->{'code'};
			if($code == 404) //not found
			{
				$promotion[0]->products = "";
			}
			else
			{					
				$promotion[0]->products = $decode->{'messages'};				
			}
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion[0]);
		}
		return Response::json($respond);
	}
	
	/*
	public function getByName($name)		
	{
		$respond = array();
		$promotion = Promotion::where('name', 'LIKE','%'.$name.'%')->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	*/
	
	public function getByActive($active)
	{
		$respond = array();
		$promotion = Promotion::where('active','=',$active)->get();
		if (count($promotion) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($promotion as $key)
			{
				$product_cont = new ProductsController();
				$json_products = $product_cont->getByPromotionId($key->id);
				$decode = json_decode($json_products->getContent());
				$code = $decode->{'code'};
				if($code == 404) //not found
				{
					$key->products = "";
				}
				else
				{					
					$key->products = $decode->{'messages'};
				}
			}	
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$promotion);
		}
		return Response::json($respond);
	}
	
	
	public function updateFull($id, $input)
	{			
		$promotion = Promotion::find($id);
		if ($promotion == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{			
			$input_promotion = array(
				'name' => $input['name'],
				'amount' => $input['amount'],
				'start_date' => $input['start_date'],
				'expired' => $input['expired'],
				'active' => $input['active']
			);
			$input_products = $input['products'];				
		
			//validate
			$validator = Validator::make($data = $input_promotion, Promotion::$rules);

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			
			//edit value
			$promotion->name = $input_promotion['name'];
			$promotion->amount = $input_promotion['amount'];
			$promotion->start_date = $input_promotion['start_date'];
			$promotion->expired = $input_promotion['expired'];
			$promotion->active = $input_promotion['active'];		

			//save
			try {
				$promotion->save();				
				
				//edit products yang berpromosi
				$products = $input_products;
				$product_cont = new ProductsController();
				foreach($products as $key)
				{
					$product_cont->updatePromotionId($key, $promotion->id);
				}
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}	
	
	public function updateActive($id, $new_active)
	{
		$respond = array();
		$promotion = Promotion::find($id);
		if($promotion == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$promotion->active = $new_active;
			try {
				$promotion->save();
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
		$promotion = Promotion::find($id);
		if ($promotion == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//kosongin dulu product yg ngereference ke id promosi ini			
			try {
				$product = Product::where('promotion_id', '=', $id)->get();
				foreach($product as $key)			
				{
					$key->promotion_id = null;
					$key->save();
				}
				$promotion->delete();
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
		$promotion = Promotion::find($id);
		if ($promotion == null)
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
