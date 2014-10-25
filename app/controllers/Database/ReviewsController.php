<?php

class ReviewsController extends \BaseController {
	
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
			Review::create([
					'product_id' => $input['product_id'],
					'text' => $input['text'],
					'rating' => $input['rating'],
					'approved' => $input['approved']
				]);				
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}
	
	//RETURN : id, product_id, text, rating, approved, created_at, updated_at, product_no, product_name
	public function getAll(){
		$respond = array();
		$review = DB::table('reviews AS rev')
					->leftJoin('products AS pro', 'rev.product_id', '=', 'pro.id')
					->get(array('rev.id','rev.product_id','rev.text','rev.rating',
							'rev.approved','rev.created_at','rev.updated_at',
							'pro.product_no AS product_no','pro.name AS product_name'));
		if(count($review) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}
	
	//RETURN : id, product_id, text, rating, approved, created_at, updated_at, product_no, product_name
	//SORTED : product_no, product_name, text, rating, approved 
	public function getAllSorted($by, $type)
	{
		$respond = array();
		$review = DB::table('reviews AS rev')
					->leftJoin('products AS pro', 'rev.product_id', '=', 'pro.id')
					->orderBy($by, $type)
					->get(array('rev.id','rev.product_id','rev.text','rev.rating',
							'rev.approved','rev.created_at','rev.updated_at',
							'pro.product_no AS product_no','pro.name AS product_name'));
		if(count($review) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}
	
	//RETURN : id, product_id, text, rating, approved, created_at, updated_at, product_no, product_name
	//SEARCH : product_no, product_name, text, rating, approved 
	public function getFilteredReview($product_no, $product_name, $text, $rating, $approved)
	{
		$respond = array();
		$review = DB::table('reviews AS rev')
					->where('text', 'LIKE', '%'.$text.'%');										
		if($rating != -1)
		{
			$review = $review->where('rating', '=', $rating);
		}
		if($approved != -1)
		{
			$review = $review->where('approved', '=', $approved);
		}
		$review = $review->leftJoin('products AS pro', 'rev.product_id', '=', 'pro.id')					
					->where('pro.product_no', 'LIKE', '%'.$product_no.'%')
					->where('pro.name', 'LIKE', '%'.$product_name.'%')													
					->get(array('rev.id','rev.product_id','rev.text','rev.rating',
							'rev.approved','rev.created_at','rev.updated_at',
							'pro.product_no AS product_no','pro.name AS product_name'));
		if(count($review) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}
	
	//RETURN : id, product_id, text, rating, approved, created_at, updated_at, product_no, product_name
	//SEARCH : product_no, product_name, text, rating, approved 
	//SORTED : product_no, product_name, text, rating, approved 
	public function getFilteredReviewSorted($product_no, $product_name, $text, $rating, $approved, $sortBy, $sortType)
	{
		$respond = array();
		$review = DB::table('reviews AS rev')
					->where('text', 'LIKE', '%'.$text.'%');										
		if($rating != -1)
		{
			$review = $review->where('rating', '=', $rating);
		}
		if($approved != -1)
		{
			$review = $review->where('approved', '=', $approved);
		}
		$review = $review->leftJoin('products AS pro', 'rev.product_id', '=', 'pro.id')					
					->where('pro.product_no', 'LIKE', '%'.$product_no.'%')
					->where('pro.name', 'LIKE', '%'.$product_name.'%')	
					->orderBy($sortBy, $sortType)
					->get(array('rev.id','rev.product_id','rev.text','rev.rating',
							'rev.approved','rev.created_at','rev.updated_at',
							'pro.product_no AS product_no','pro.name AS product_name'));
		if(count($review) == 0)
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
	public function view_main_review()
	{
		$review_json = $this->getAll();		
		$paginator = json_decode($review_json->getContent())->{'messages'};		
		$perPage = 5;   
		$page = Input::get('page', 1);
		if ($page > count($paginator) or $page < 1) { $page = 1; }
			$offset = ($page * $perPage) - $perPage;
		$articles = array_slice($paginator,$offset,$perPage);
		$datas = Paginator::make($articles, count($paginator), $perPage);		
					
		// return View::make('pages.admin.review.manage_review', compact('datas'));		
		return View::make('pages.admin.review.manage_review');		
	}

	public function view_main_reviewProductNoAsc()
	{
		$review_json = $this->getAllSortedProductNoAsc();		
		$paginator = json_decode($review_json->getContent())->{'messages'};		
		$perPage = 5;   
		$page = Input::get('page', 1);
		if ($page > count($paginator) or $page < 1) { $page = 1; }
			$offset = ($page * $perPage) - $perPage;
		$articles = array_slice($paginator,$offset,$perPage);
		$datas = Paginator::make($articles, count($paginator), $perPage);		
					
		return View::make('pages.admin.review.manage_review', compact('datas'));		
	}
	
	public function view_main_reviewProductNoDesc()
	{
		$review_json = $this->getAllSortedProductNoDesc();		
		$paginator = json_decode($review_json->getContent())->{'messages'};		
		$perPage = 5;   
		$page = Input::get('page', 1);
		if ($page > count($paginator) or $page < 1) { $page = 1; }
			$offset = ($page * $perPage) - $perPage;
		$articles = array_slice($paginator,$offset,$perPage);
		$datas = Paginator::make($articles, count($paginator), $perPage);		
					
		return View::make('pages.admin.review.manage_review', compact('datas'));		
	}
	
	public function view_main_reviewProductNameAsc()
	{
		$review_json = $this->getAllSortedProductNameAsc();		
		$paginator = json_decode($review_json->getContent())->{'messages'};		
		$perPage = 5;   
		$page = Input::get('page', 1);
		if ($page > count($paginator) or $page < 1) { $page = 1; }
			$offset = ($page * $perPage) - $perPage;
		$articles = array_slice($paginator,$offset,$perPage);
		$datas = Paginator::make($articles, count($paginator), $perPage);		
					
		return View::make('pages.admin.review.manage_review', compact('datas'));		
	}
	
	public function view_main_reviewProductNameDesc()
	{
		$review_json = $this->getAllSortedProductNameDesc();		
		$paginator = json_decode($review_json->getContent())->{'messages'};		
		$perPage = 5;   
		$page = Input::get('page', 1);
		if ($page > count($paginator) or $page < 1) { $page = 1; }
			$offset = ($page * $perPage) - $perPage;
		$articles = array_slice($paginator,$offset,$perPage);
		$datas = Paginator::make($articles, count($paginator), $perPage);		
					
		return View::make('pages.admin.review.manage_review', compact('datas'));		
	}
	
	public function view_main_reviewTextAsc()
	{
		$review_json = $this->getAllSortedTextAsc();		
		$paginator = json_decode($review_json->getContent())->{'messages'};		
		$perPage = 5;   
		$page = Input::get('page', 1);
		if ($page > count($paginator) or $page < 1) { $page = 1; }
			$offset = ($page * $perPage) - $perPage;
		$articles = array_slice($paginator,$offset,$perPage);
		$datas = Paginator::make($articles, count($paginator), $perPage);		
					
		return View::make('pages.admin.review.manage_review', compact('datas'));		
	}

	public function view_main_reviewTextDesc()
	{
		$review_json = $this->getAllSortedTextDesc();		
		$paginator = json_decode($review_json->getContent())->{'messages'};		
		$perPage = 5;   
		$page = Input::get('page', 1);
		if ($page > count($paginator) or $page < 1) { $page = 1; }
			$offset = ($page * $perPage) - $perPage;
		$articles = array_slice($paginator,$offset,$perPage);
		$datas = Paginator::make($articles, count($paginator), $perPage);		
					
		return View::make('pages.admin.review.manage_review', compact('datas'));		
	}
	
	public function view_main_reviewRatingAsc()
	{
		$review_json = $this->getAllSortedRatingAsc();		
		$paginator = json_decode($review_json->getContent())->{'messages'};		
		$perPage = 5;   
		$page = Input::get('page', 1);
		if ($page > count($paginator) or $page < 1) { $page = 1; }
			$offset = ($page * $perPage) - $perPage;
		$articles = array_slice($paginator,$offset,$perPage);
		$datas = Paginator::make($articles, count($paginator), $perPage);		
					
		return View::make('pages.admin.review.manage_review', compact('datas'));		
	}
	
	public function view_main_reviewRatingDesc()
	{
		$review_json = $this->getAllSortedRatingDesc();		
		$paginator = json_decode($review_json->getContent())->{'messages'};		
		$perPage = 5;   
		$page = Input::get('page', 1);
		if ($page > count($paginator) or $page < 1) { $page = 1; }
			$offset = ($page * $perPage) - $perPage;
		$articles = array_slice($paginator,$offset,$perPage);
		$datas = Paginator::make($articles, count($paginator), $perPage);		
					
		return View::make('pages.admin.review.manage_review', compact('datas'));		
	}
	
	public function view_main_reviewApprovedAsc()
	{
		$review_json = $this->getAllSortedApprovedAsc();		
		$paginator = json_decode($review_json->getContent())->{'messages'};		
		$perPage = 5;   
		$page = Input::get('page', 1);
		if ($page > count($paginator) or $page < 1) { $page = 1; }
			$offset = ($page * $perPage) - $perPage;
		$articles = array_slice($paginator,$offset,$perPage);
		$datas = Paginator::make($articles, count($paginator), $perPage);		
					
		return View::make('pages.admin.review.manage_review', compact('datas'));		
	}
	
	public function view_main_reviewApprovedDesc()
	{
		$review_json = $this->getAllSortedApprovedDesc();		
		$paginator = json_decode($review_json->getContent())->{'messages'};		
		$perPage = 5;   
		$page = Input::get('page', 1);
		if ($page > count($paginator) or $page < 1) { $page = 1; }
			$offset = ($page * $perPage) - $perPage;
		$articles = array_slice($paginator,$offset,$perPage);
		$datas = Paginator::make($articles, count($paginator), $perPage);		
					
		return View::make('pages.admin.review.manage_review', compact('datas'));		
	}
	
	public function view_detail_review($id)
	{
		$json = json_decode($this->getById($id)->getContent());
		return json_encode($json);
	}
		
	public function view_search_review()
	{
		$json_data = Input::get('json_data');
		$json = json_decode($json_data);
				
		$product_no = $json->{'product_no'};		
		$product_name = $json->{'product_name'};		
		$text = $json->{'text'};		
		$rating = $json->{'rating'};		
		$approved = $json->{'approved'};		
		
		if($rating == ""){
			$rating = -1;
		}
		
		if($approved == ""){
			$approved = -1;
		}
		
		$input = array(
				'product_no' => $product_no,
				'product_name' => $product_name,
				'text' => $text,
				'rating' => $rating,
				'approved' => $approved
		);
		
		$review_json = $this->searchReview($input);		
		$decode = json_decode($review_json->getContent());
		if($decode->code==404)
		{
			//not found
			$datas = null;
		}
		else
		{		
			$temp = json_decode($review_json->getContent())->{'messages'};					
			$result = array();
			foreach($temp as $key)						
			{
				$result[] = $key;
			}
			$datas = $result;			
		}						
		return $datas;
	}
	
	// public function w_insert()
	// {
		// $json = Input::get('json_data');
		// $decode = json_decode($json);
		
		// $product_id = $decode->{'product_id'};
		// $text = $decode->{'text'}:
		// $rating = $decode->{'rating'};
		// $approved = $decode->{'approved'};
		
		// $input = array(
					// 'product_id' => $product_id,
					// 'text' => $text,
					// 'rating' => $rating,
					// 'approved' => 0);
					
		// return $this->insert($input);
	// }
	
	public function editApproved()
	{
		$json_data = Input::get('json_data');
		$json = json_decode($json_data);
		
		$id = $json->{'id'};
		$approved = $json->{'new_approved'};				
				
		$json = json_decode($this->updateApproved($id, $approved)->getContent());
		return json_encode($json);
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
	*/
	
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
