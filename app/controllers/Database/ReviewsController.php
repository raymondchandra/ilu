<?php

class ReviewsController extends \BaseController {

	/**
	 * Insert a newly created review in database.
	 *
	 * @return Response
	 */
	public function insert()
	{
		$respond = array();
		//validate
		$validator = Validator::make($data = Input::all(), Review::$rules);

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

	/**
	 * Display all of the review.
	 *
	 * @return Response
	 */
	public function getAll(){
		$respond = array();
		$review = Review::all();
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

	/**
	 * Display all of the review.
	 *
	 * @return Response
	 */
	public function getAllRatingAsc(){
		$respond = array();
		$review = Review::all()->orderBy('rating');
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
	
	/**
	 * Display all of the review.
	 *
	 * @return Response
	 */
	public function getAllRatingDesc(){
		$respond = array();
		$review = Review::all()->orderBy('rating', 'desc');
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
	
	/**
	 * Display the specified review.
	 *
	 * @param  int  $id
	 * @return Response
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
			$respond = array('code'=>'200','status' => 'OK','messages'=>$review);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified review by .
	 *
	 * @param  
	 * @return Response
	 */	
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
	
	/**
	 * Display the specified review by 
	 *
	 * @param  
	 * @return Response
	 */	
	public function getByText($text)
	{
		$respond = array();
		$review = Review::where('text', 'LIKE', '%'.$text.'%')->get();
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

	/**
	 * Display the specified tax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getByRatingLessThanEqual($limit)
	{
		$respond = array();		
		$review = Review::where('rating', '<=', $limit)->get();
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
	
	/**
	 * Display the specified tax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getByRatingLessThanEqualAsc($limit)
	{
		$respond = array();		
		$review = Review::where('rating', '<=', $limit)->orderBy('rating')->get();
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
	
	/**
	 * Display the specified tax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getByRatingLessThanEqualDesc($limit)
	{
		$respond = array();		
		$review = Review::where('rating', '<=', $limit)->orderBy('rating', 'desc')->get();
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
	
	/**
	 * Display the specified tax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getByRatingMoreThanEqual($limit)
	{
		$respond = array();		
		$review = Review::where('rating', '>=', $limit)->get();
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
	
	/**
	 * Display the specified tax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getByRatingMoreThanEqualAsc($limit)
	{
		$respond = array();		
		$review = Review::where('rating', '>=', $limit)->orderBy('rating')->get();
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
	
	/**
	 * Display the specified tax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getByRatingMoreThanEqualDesc($limit)
	{
		$respond = array();		
		$review = Review::where('rating', '>=', $limit)->orderBy('rating', 'desc')->get();
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
	
	/**
	 * Display the specified tax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getByRatingBetweenEqual($lower_limit, $upper_limit)
	{
		$respond = array();		
		$review = Review::where('rating', '>=', $lower_limit)
					->where('rating', '<=', $upper_limit)->get();
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
	
	/**
	 * Display the specified tax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getByRatingBetweenEqualAsc($lower_limit, $upper_limit)
	{
		$respond = array();		
		$review = Review::where('rating', '>=', $lower_limit)
					->where('rating', '<=', $upper_limit)
					->orderBy('rating')->get();
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
	
	/**
	 * Display the specified tax.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getByRatingBetweenEqualDesc($lower_limit, $upper_limit)
	{
		$respond = array();		
		$review = Review::where('rating', '>=', $lower_limit)
					->where('rating', '<=', $upper_limit)
					->orderBy('rating', 'desc')->get();
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
	
	/**
	 * Update all value of the specified review in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateFull($id)
	{
		$respond = array();
		$review = Review::find($id);
		if ($review == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//validate
			$validator = Validator::make($data = Input::all(), Review::$rules);

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			//save
			try {
				$review->update($data);
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}

	/**
	 * Update value of the specified review in database.
	 *
	 * @param  
	 * @return Response
	 */
	public function updateProductId($id, $new_product_id)
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
			$review->product_id = $new_product_id;
			try {
				$review->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	/**
	 * Update value of the specified review in database.
	 *
	 * @param  
	 * @return Response
	 */
	public function updateText($id, $new_text)
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
			$review->text = $new_text;
			try {
				$review->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	/**
	 * Update value of the specified review in database.
	 *
	 * @param  
	 * @return Response
	 */
	public function updateRating($id, $new_rating)
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
			$review->rating = $new_rating;
			try {
				$review->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	/**
	 * Update value of the specified review in database.
	 *
	 * @param  
	 * @return Response
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
	
	/**
	 * Remove the specified review from database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
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
		$review = Review::where('','=','')->get();
		if (count($review) >= 0)
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

}
