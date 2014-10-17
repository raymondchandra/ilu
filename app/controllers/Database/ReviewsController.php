<?php

class ReviewsController extends \BaseController {
		
	public function w_insert()
	{
		$json = Input::get('json_data');
		$decode = json_decode($json);
		
		$product_id = $decode->{'product_id'};
		$text = $decode->{'text'}:
		$rating = $decode->{'rating'};
		// $approved = $decode->{'approved'};
		
		$input = array(
					'product_id' => $product_id,
					'text' => $text,
					'rating' => $rating,
					'approved' => 0);
					
		return $this->insert($input);
	}
	public function insert($input)
	{
		// $input = json_decode(Input::all());
		
		$respond = array();
		//validate
		$validator = Validator::make($data = $input, Review::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			Review::create($data);
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}	
	
	// return : id, product_id, text, rating, approved,
				// product_no, product_name
	public function getAll(){
		$respond = array();
		$review = Review::all();
		if (count($review) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($review as $key)
			{
				$product = Product::find($key->product_id);
				if(count($product) == 0)
				{
					$key->product_no = "";
					$key->product_name = "";
				}
				else
				{
					$key->product_no = $product->product_no;
					$key->product_name = $product->name;
				}
			}						
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedProductNoAsc(){
		$respond = array();
		$review = Review::all();
		if (count($review) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			foreach($review as $key)
			{
				$product = Product::find($key->product_id);
				if(count($product) == 0)
				{
					$key->product_no = "";
					$key->product_name = "";
				}
				else
				{
					$key->product_no = $product->product_no;
					$key->product_name = $product->name;
				}
			}						
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}
	
	public function getById($id)
	{
		$respond = array();
		$review = Review::find($id);
		if (count($review) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}
	
	/*
	public function getByProductId($product_id)
	{
		$respond = array();
		$review = Review::where('product_id','=',$product_id)->get();
		if (count($review) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}	
	
	public function getByProductIdSortedRatingAsc($product_id)	
	{
		$respond = array();
		$review = Review::where('product_id','=',$product_id)->orderBy('rating')->get();
		if (count($review) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}	
	
	public function getByProductIdSortedRatingDesc($product_id)
	{
		$respond = array();
		$review = Review::where('product_id','=',$product_id)->orderBy('rating', 'desc')->get();
		if (count($review) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}	
	
	public function getByApproved($approved)
	{			
		$respond = array();
		$review = Review::where('approved','=',$approved)->get();
		if (count($review) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}	
	*/	
	
	public function updateApproved($id, $new_approved)
	{
		$respond = array();
		$review = Review::find($id);
		if ($review == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$review->approved = $new_approved;
			try {
				$review->save();
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
		$review = Review::find($id);
		if ($review == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$review->delete();
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
		$review = Review::find($id);
		if ($review == null)
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
