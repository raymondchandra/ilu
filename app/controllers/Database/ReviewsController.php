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
	
	//reverse array
	public function reverse($arr)
	{
		$lastIdx = count($arr)-1;
		$reserve = array();
		while($lastIdx >= 0)
		{
			$reverse[] = $arr[$lastIdx];
			$lastIdx--;
		}
		return $reverse;
	}
	
	// return : id, product_id, text, rating, approved,
				// product_no, product_name-->name
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
				//add product_no, product_name
				$key->product_no = $product->product_no;
				$key->product_name = $product->name;
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
				//add product_no, product_name
				$key->product_no = $product->product_no;
				$key->product_name = $product->name;
			}	

			//sorting
			$review = array_values(
						array_sort(
							$review, function($value)
							{
								return $value['product_no'];
							}
						)
					);	
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedProductNoDesc(){
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
				//add product_no, product_name
				$key->product_no = $product->product_no;
				$key->product_name = $product->name;
			}	

			//sorting
			$review = array_values(
						array_sort(
							$review, function($value)
							{
								return $value['product_no'];
							}
						)
					);	
			//reverse
			$review = $this->reverse($review);
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedProductNameAsc(){
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
				//add product_no, product_name
				$key->product_no = $product->product_no;
				$key->product_name = $product->name;
			}	

			//sorting
			$review = array_values(
						array_sort(
							$review, function($value)
							{
								return $value['product_name'];
							}
						)
					);	
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedProductNameDesc(){
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
				//add product_no, product_name
				$key->product_no = $product->product_no;
				$key->product_name = $product->name;
			}	

			//sorting
			$review = array_values(
						array_sort(
							$review, function($value)
							{
								return $value['product_name'];
							}
						)
					);	
			//reverse
			$review = $this->reverse($review);
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedTextAsc(){
		$respond = array();
		$review = Review::orderBy('text')->get();
		if (count($review) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{			
			foreach($review as $key)
			{
				$product = Product::find($key->product_id);
				//add product_no, product_name
				$key->product_no = $product->product_no;
				$key->product_name = $product->name;
			}		
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedTextDesc(){
		$respond = array();
		$review = Review::orderBy('text', 'desc')->get();
		if (count($review) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{			
			foreach($review as $key)
			{
				$product = Product::find($key->product_id);
				//add product_no, product_name
				$key->product_no = $product->product_no;
				$key->product_name = $product->name;
			}		
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedRatingAsc(){
		$respond = array();
		$review = Review::orderBy('rating')->get();
		if (count($review) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{			
			foreach($review as $key)
			{
				$product = Product::find($key->product_id);
				//add product_no, product_name
				$key->product_no = $product->product_no;
				$key->product_name = $product->name;
			}		
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedRatingDesc(){
		$respond = array();
		$review = Review::orderBy('rating', 'desc')->get();
		if (count($review) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{			
			foreach($review as $key)
			{
				$product = Product::find($key->product_id);
				//add product_no, product_name
				$key->product_no = $product->product_no;
				$key->product_name = $product->name;
			}		
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedApprovedAsc(){
		$respond = array();
		$review = Review::orderBy('approved')->get();
		if (count($review) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{			
			foreach($review as $key)
			{
				$product = Product::find($key->product_id);
				//add product_no, product_name
				$key->product_no = $product->product_no;
				$key->product_name = $product->name;
			}		
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}
	
	public function getAllSortedApprovedDesc(){
		$respond = array();
		$review = Review::orderBy('approved', 'desc')->get();
		if (count($review) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{			
			foreach($review as $key)
			{
				$product = Product::find($key->product_id);
				//add product_no, product_name
				$key->product_no = $product->product_no;
				$key->product_name = $product->name;
			}		
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}
	
	// asumsi : 
		// kalo field input integer ada yang kosong maka -1
		// kalo field input string ada yang kosong maka dapetnya ""
	// input = product_no, product_name, text, rating, approved
	public function searchReview($input)
	{
		$respond = array();
		$review = Review::where('text', 'LIKE', '%'.$input['text'].'%');
		
		if($input['rating'] != -1)
		{
			$review = $review->where('rating', '=', $input['rating']);
		}
		
		if($input['approved'] != -1)
		{
			$review = $review->where('approved', '=', $input['approved']);
		}
		
		$review = $review->get();
				
		//add product_no, product_name	
		foreach($review as $key)
		{
			$product = Product::find($key->product_id);
			//add product_no, product_name
			$key->product_no = $product->product_no;
			$key->product_name = $product->name;
		}
	
		$result_product_no = array();
		//search by product_no		
		if($input['product_no'] != "")
		{					
			foreach($review as $key)
			{
				$pos = strpos($key->product_no, $input['product_no']);
				if($pos !== false)
				{
					$result_product_no[] = $key;
				}
			}
		}		
		else
		{
			$result_product_no = $review;
		}
		
		$result_final = array();	//search product_name
		//search by product_name		
		if($input['product_name'] != "")
		{					
			foreach($result_product_no as $key)
			{
				$pos = strpos($key->product_name, $input['product_name']);
				if($pos !== false)
				{
					$result_final[] = $key;
				}
			}
		}		
		else
		{
			$result_final = $result_product_no;
		}
				
		if (count($result_final) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$result_final);			
		}	
		
		return Response::json($respond);
	}
	
	public function searchReviewSortedProductNoAsc($input)
	{
		$respond = array();
		$review = Review::where('text', 'LIKE', '%'.$input['text'].'%');
		
		if($input['rating'] != -1)
		{
			$review = $review->where('rating', '=', $input['rating']);
		}
		
		if($input['approved'] != -1)
		{
			$review = $review->where('approved', '=', $input['approved']);
		}
		
		$review = $review->get();
				
		//add product_no, product_name	
		foreach($review as $key)
		{
			$product = Product::find($key->product_id);
			//add product_no, product_name
			$key->product_no = $product->product_no;
			$key->product_name = $product->name;
		}
	
		$result_product_no = array();
		//search by product_no		
		if($input['product_no'] != "")
		{					
			foreach($review as $key)
			{
				$pos = strpos($key->product_no, $input['product_no']);
				if($pos !== false)
				{
					$result_product_no[] = $key;
				}
			}
		}		
		else
		{
			$result_product_no = $review;
		}
		
		$result_final = array();	//search product_name
		//search by product_name		
		if($input['product_name'] != "")
		{					
			foreach($result_product_no as $key)
			{
				$pos = strpos($key->product_name, $input['product_name']);
				if($pos !== false)
				{
					$result_final[] = $key;
				}
			}
		}		
		else
		{
			$result_final = $result_product_no;
		}
				
		if (count($result_final) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{	
			//sorting
			$result_final = array_values(
						array_sort(
							$result_final, function($value)
							{
								return $value['product_no'];
							}
						)
					);	
			$respond = array('code'=>'200','status' => 'OK','messages'=>$result_final);			
		}	
		
		return Response::json($respond);
	}
	
	public function searchReviewSortedProductNoDesc($input)
	{
		$respond = array();
		$review = Review::where('text', 'LIKE', '%'.$input['text'].'%');
		
		if($input['rating'] != -1)
		{
			$review = $review->where('rating', '=', $input['rating']);
		}
		
		if($input['approved'] != -1)
		{
			$review = $review->where('approved', '=', $input['approved']);
		}
		
		$review = $review->get();
				
		//add product_no, product_name	
		foreach($review as $key)
		{
			$product = Product::find($key->product_id);
			//add product_no, product_name
			$key->product_no = $product->product_no;
			$key->product_name = $product->name;
		}
	
		$result_product_no = array();
		//search by product_no		
		if($input['product_no'] != "")
		{					
			foreach($review as $key)
			{
				$pos = strpos($key->product_no, $input['product_no']);
				if($pos !== false)
				{
					$result_product_no[] = $key;
				}
			}
		}		
		else
		{
			$result_product_no = $review;
		}
		
		$result_final = array();	//search product_name
		//search by product_name		
		if($input['product_name'] != "")
		{					
			foreach($result_product_no as $key)
			{
				$pos = strpos($key->product_name, $input['product_name']);
				if($pos !== false)
				{
					$result_final[] = $key;
				}
			}
		}		
		else
		{
			$result_final = $result_product_no;
		}
				
		if (count($result_final) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//sorting
			$result_final = array_values(
						array_sort(
							$result_final, function($value)
							{
								return $value['product_no'];
							}
						)
					);						
			//reverse
			$result_final = $this->reverse($result_final);
			
			$respond = array('code'=>'200','status' => 'OK','messages'=>$result_final);			
		}	
		
		return Response::json($respond);
	}
	
	public function searchReviewSortedProductNameAsc($input)
	{
		$respond = array();
		$review = Review::where('text', 'LIKE', '%'.$input['text'].'%');
		
		if($input['rating'] != -1)
		{
			$review = $review->where('rating', '=', $input['rating']);
		}
		
		if($input['approved'] != -1)
		{
			$review = $review->where('approved', '=', $input['approved']);
		}
		
		$review = $review->get();
				
		//add product_no, product_name	
		foreach($review as $key)
		{
			$product = Product::find($key->product_id);
			//add product_no, product_name
			$key->product_no = $product->product_no;
			$key->product_name = $product->name;
		}
	
		$result_product_no = array();
		//search by product_no		
		if($input['product_no'] != "")
		{					
			foreach($review as $key)
			{
				$pos = strpos($key->product_no, $input['product_no']);
				if($pos !== false)
				{
					$result_product_no[] = $key;
				}
			}
		}		
		else
		{
			$result_product_no = $review;
		}
		
		$result_final = array();	//search product_name
		//search by product_name		
		if($input['product_name'] != "")
		{					
			foreach($result_product_no as $key)
			{
				$pos = strpos($key->product_name, $input['product_name']);
				if($pos !== false)
				{
					$result_final[] = $key;
				}
			}
		}		
		else
		{
			$result_final = $result_product_no;
		}
				
		if (count($result_final) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{	
			//sorting
			$result_final = array_values(
						array_sort(
							$result_final, function($value)
							{
								return $value['product_name'];
							}
						)
					);	
			$respond = array('code'=>'200','status' => 'OK','messages'=>$result_final);			
		}	
		
		return Response::json($respond);
	}
	
	public function searchReviewSortedProductNameDesc($input)
	{
		$respond = array();
		$review = Review::where('text', 'LIKE', '%'.$input['text'].'%');
		
		if($input['rating'] != -1)
		{
			$review = $review->where('rating', '=', $input['rating']);
		}
		
		if($input['approved'] != -1)
		{
			$review = $review->where('approved', '=', $input['approved']);
		}
		
		$review = $review->get();
				
		//add product_no, product_name	
		foreach($review as $key)
		{
			$product = Product::find($key->product_id);
			//add product_no, product_name
			$key->product_no = $product->product_no;
			$key->product_name = $product->name;
		}
	
		$result_product_no = array();
		//search by product_no		
		if($input['product_no'] != "")
		{					
			foreach($review as $key)
			{
				$pos = strpos($key->product_no, $input['product_no']);
				if($pos !== false)
				{
					$result_product_no[] = $key;
				}
			}
		}		
		else
		{
			$result_product_no = $review;
		}
		
		$result_final = array();	//search product_name
		//search by product_name		
		if($input['product_name'] != "")
		{					
			foreach($result_product_no as $key)
			{
				$pos = strpos($key->product_name, $input['product_name']);
				if($pos !== false)
				{
					$result_final[] = $key;
				}
			}
		}		
		else
		{
			$result_final = $result_product_no;
		}
				
		if (count($result_final) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{	
			//sorting
			$result_final = array_values(
						array_sort(
							$result_final, function($value)
							{
								return $value['product_name'];
							}
						)
					);	
			//reverse
			$result_final = $this->reverse($result_final);
					
			$respond = array('code'=>'200','status' => 'OK','messages'=>$result_final);			
		}	
		
		return Response::json($respond);
	}
	
	public function searchReviewSortedTextAsc($input)
	{
		$respond = array();
		$review = Review::where('text', 'LIKE', '%'.$input['text'].'%');
		
		if($input['rating'] != -1)
		{
			$review = $review->where('rating', '=', $input['rating']);
		}
		
		if($input['approved'] != -1)
		{
			$review = $review->where('approved', '=', $input['approved']);
		}
		
		$review = $review->get();
				
		//add product_no, product_name	
		foreach($review as $key)
		{
			$product = Product::find($key->product_id);
			//add product_no, product_name
			$key->product_no = $product->product_no;
			$key->product_name = $product->name;
		}
	
		$result_product_no = array();
		//search by product_no		
		if($input['product_no'] != "")
		{					
			foreach($review as $key)
			{
				$pos = strpos($key->product_no, $input['product_no']);
				if($pos !== false)
				{
					$result_product_no[] = $key;
				}
			}
		}		
		else
		{
			$result_product_no = $review;
		}
		
		$result_final = array();	//search product_name
		//search by product_name		
		if($input['product_name'] != "")
		{					
			foreach($result_product_no as $key)
			{
				$pos = strpos($key->product_name, $input['product_name']);
				if($pos !== false)
				{
					$result_final[] = $key;
				}
			}
		}		
		else
		{
			$result_final = $result_product_no;
		}
				
		if (count($result_final) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{	
			//sorting
			$result_final = array_values(
						array_sort(
							$result_final, function($value)
							{
								return $value['text'];
							}
						)
					);	
			$respond = array('code'=>'200','status' => 'OK','messages'=>$result_final);			
		}	
		
		return Response::json($respond);
	}
	
	public function searchReviewSortedTextDesc($input)
	{
		$respond = array();
		$review = Review::where('text', 'LIKE', '%'.$input['text'].'%');
		
		if($input['rating'] != -1)
		{
			$review = $review->where('rating', '=', $input['rating']);
		}
		
		if($input['approved'] != -1)
		{
			$review = $review->where('approved', '=', $input['approved']);
		}
		
		$review = $review->get();
				
		//add product_no, product_name	
		foreach($review as $key)
		{
			$product = Product::find($key->product_id);
			//add product_no, product_name
			$key->product_no = $product->product_no;
			$key->product_name = $product->name;
		}
	
		$result_product_no = array();
		//search by product_no		
		if($input['product_no'] != "")
		{					
			foreach($review as $key)
			{
				$pos = strpos($key->product_no, $input['product_no']);
				if($pos !== false)
				{
					$result_product_no[] = $key;
				}
			}
		}		
		else
		{
			$result_product_no = $review;
		}
		
		$result_final = array();	//search product_name
		//search by product_name		
		if($input['product_name'] != "")
		{					
			foreach($result_product_no as $key)
			{
				$pos = strpos($key->product_name, $input['product_name']);
				if($pos !== false)
				{
					$result_final[] = $key;
				}
			}
		}		
		else
		{
			$result_final = $result_product_no;
		}
				
		if (count($result_final) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{	
			//sorting
			$result_final = array_values(
						array_sort(
							$result_final, function($value)
							{
								return $value['text'];
							}
						)
					);	
			//reverse
			$result_final = $this->reverse($result_final);
					
			$respond = array('code'=>'200','status' => 'OK','messages'=>$result_final);			
		}	
		
		return Response::json($respond);
	}
	
	public function searchReviewSortedRatingAsc($input)
	{
		$respond = array();
		$review = Review::where('text', 'LIKE', '%'.$input['text'].'%');
		
		if($input['rating'] != -1)
		{
			$review = $review->where('rating', '=', $input['rating']);
		}
		
		if($input['approved'] != -1)
		{
			$review = $review->where('approved', '=', $input['approved']);
		}
		
		$review = $review->get();
				
		//add product_no, product_name	
		foreach($review as $key)
		{
			$product = Product::find($key->product_id);
			//add product_no, product_name
			$key->product_no = $product->product_no;
			$key->product_name = $product->name;
		}
	
		$result_product_no = array();
		//search by product_no		
		if($input['product_no'] != "")
		{					
			foreach($review as $key)
			{
				$pos = strpos($key->product_no, $input['product_no']);
				if($pos !== false)
				{
					$result_product_no[] = $key;
				}
			}
		}		
		else
		{
			$result_product_no = $review;
		}
		
		$result_final = array();	//search product_name
		//search by product_name		
		if($input['product_name'] != "")
		{					
			foreach($result_product_no as $key)
			{
				$pos = strpos($key->product_name, $input['product_name']);
				if($pos !== false)
				{
					$result_final[] = $key;
				}
			}
		}		
		else
		{
			$result_final = $result_product_no;
		}
				
		if (count($result_final) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{	
			//sorting
			$result_final = array_values(
						array_sort(
							$result_final, function($value)
							{
								return $value['rating'];
							}
						)
					);	
			$respond = array('code'=>'200','status' => 'OK','messages'=>$result_final);			
		}	
		
		return Response::json($respond);
	}
	
	public function searchReviewSortedRatingDesc($input)
	{
		$respond = array();
		$review = Review::where('text', 'LIKE', '%'.$input['text'].'%');
		
		if($input['rating'] != -1)
		{
			$review = $review->where('rating', '=', $input['rating']);
		}
		
		if($input['approved'] != -1)
		{
			$review = $review->where('approved', '=', $input['approved']);
		}
		
		$review = $review->get();
				
		//add product_no, product_name	
		foreach($review as $key)
		{
			$product = Product::find($key->product_id);
			//add product_no, product_name
			$key->product_no = $product->product_no;
			$key->product_name = $product->name;
		}
	
		$result_product_no = array();
		//search by product_no		
		if($input['product_no'] != "")
		{					
			foreach($review as $key)
			{
				$pos = strpos($key->product_no, $input['product_no']);
				if($pos !== false)
				{
					$result_product_no[] = $key;
				}
			}
		}		
		else
		{
			$result_product_no = $review;
		}
		
		$result_final = array();	//search product_name
		//search by product_name		
		if($input['product_name'] != "")
		{					
			foreach($result_product_no as $key)
			{
				$pos = strpos($key->product_name, $input['product_name']);
				if($pos !== false)
				{
					$result_final[] = $key;
				}
			}
		}		
		else
		{
			$result_final = $result_product_no;
		}
				
		if (count($result_final) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{	
			//sorting
			$result_final = array_values(
						array_sort(
							$result_final, function($value)
							{
								return $value['rating'];
							}
						)
					);
			//reverse
			$result_final = $this->reverse($result_final);
					
			$respond = array('code'=>'200','status' => 'OK','messages'=>$result_final);			
		}	
		
		return Response::json($respond);
	}
	
	public function searchReviewSortedApprovedAsc($input)
	{
		$respond = array();
		$review = Review::where('text', 'LIKE', '%'.$input['text'].'%');
		
		if($input['rating'] != -1)
		{
			$review = $review->where('rating', '=', $input['rating']);
		}
		
		if($input['approved'] != -1)
		{
			$review = $review->where('approved', '=', $input['approved']);
		}
		
		$review = $review->get();
				
		//add product_no, product_name	
		foreach($review as $key)
		{
			$product = Product::find($key->product_id);
			//add product_no, product_name
			$key->product_no = $product->product_no;
			$key->product_name = $product->name;
		}
	
		$result_product_no = array();
		//search by product_no		
		if($input['product_no'] != "")
		{					
			foreach($review as $key)
			{
				$pos = strpos($key->product_no, $input['product_no']);
				if($pos !== false)
				{
					$result_product_no[] = $key;
				}
			}
		}		
		else
		{
			$result_product_no = $review;
		}
		
		$result_final = array();	//search product_name
		//search by product_name		
		if($input['product_name'] != "")
		{					
			foreach($result_product_no as $key)
			{
				$pos = strpos($key->product_name, $input['product_name']);
				if($pos !== false)
				{
					$result_final[] = $key;
				}
			}
		}		
		else
		{
			$result_final = $result_product_no;
		}
				
		if (count($result_final) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{	
			//sorting
			$result_final = array_values(
						array_sort(
							$result_final, function($value)
							{
								return $value['approved'];
							}
						)
					);	
			$respond = array('code'=>'200','status' => 'OK','messages'=>$result_final);			
		}	
		
		return Response::json($respond);
	}
	
	public function searchReviewSortedApprovedDesc($input)
	{
		$respond = array();
		$review = Review::where('text', 'LIKE', '%'.$input['text'].'%');
		
		if($input['rating'] != -1)
		{
			$review = $review->where('rating', '=', $input['rating']);
		}
		
		if($input['approved'] != -1)
		{
			$review = $review->where('approved', '=', $input['approved']);
		}
		
		$review = $review->get();
				
		//add product_no, product_name	
		foreach($review as $key)
		{
			$product = Product::find($key->product_id);
			//add product_no, product_name
			$key->product_no = $product->product_no;
			$key->product_name = $product->name;
		}
	
		$result_product_no = array();
		//search by product_no		
		if($input['product_no'] != "")
		{					
			foreach($review as $key)
			{
				$pos = strpos($key->product_no, $input['product_no']);
				if($pos !== false)
				{
					$result_product_no[] = $key;
				}
			}
		}		
		else
		{
			$result_product_no = $review;
		}
		
		$result_final = array();	//search product_name
		//search by product_name		
		if($input['product_name'] != "")
		{					
			foreach($result_product_no as $key)
			{
				$pos = strpos($key->product_name, $input['product_name']);
				if($pos !== false)
				{
					$result_final[] = $key;
				}
			}
		}		
		else
		{
			$result_final = $result_product_no;
		}
				
		if (count($result_final) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{	
			//sorting
			$result_final = array_values(
						array_sort(
							$result_final, function($value)
							{
								return $value['approved'];
							}
						)
					);	
			//reverse
			$result_final = $this->reverse($result_final);
					
			$respond = array('code'=>'200','status' => 'OK','messages'=>$result_final);			
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
			$product = Product::find($review->product_id);
			//add product_no, product_name
			$review->product_no = $product->product_no;
			$review->product_name = $product->name;
		
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}
	
	public function getByProductId($product_id)	//id product, BUKAN PRODUCT_NO !!
	{
		$respond = array();
		$review = Review::where('product_id', '=', $product_id)->get();
		if (count($review) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{			
			foreach($review as $key)
			{
				$product = Product::find($key->product_id);
				//add product_no, product_name
				$key->product_no = $product->product_no;
				$key->product_name = $product->name;
			}		
		
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}
	
	public function getByApproved($approved)
	{			
		$respond = array();
		$review = Review::where('approved', '=', $approved)->get();
		if (count($review) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{			
			foreach($review as $key)
			{
				$product = Product::find($key->product_id);
				//add product_no, product_name
				$key->product_no = $product->product_no;
				$key->product_name = $product->name;
			}		
		
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}	
	
	/*	
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
