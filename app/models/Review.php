<?php

class Review extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'product_id' => 'required|integer',
		'text' => 'required',
		'rating' => 'required|regex:/^\d*(\.\d{2})?$/',
		'approved' => 'required|integer'
	];

	// Don't forget to fill this array
	protected $fillable = ['product_id', 'text', 'rating', 'approved'];

	public function product()
	{
		return $this->belongsTo('Product');
	}
}

/*
method :
	insert()
	getAll()
	getAllRatingAsc()
	getAllRatingDesc()
	getById($id)
	getByProductId($product_id)
	getByText($text)	
	getByRatingLessThanEqual($limit)
	getByRatingLessThanEqualAsc($limit)
	getByRatingLessThanEqualDesc($limit)
	getByRatingMoreThanEqual($limit)
	getByRatingMoreThanEqualAsc($limit)
	getByRatingMoreThanEqualDesc($limit)
	getByRatingBetweenEqual($lower_limit, $upper_limit)	
	getByRatingBetweenEqualAsc($lower_limit, $upper_limit)	
	getByRatingBetweenEqualDesc($lower_limit, $upper_limit)	
	updateFull($id)
	updateProductId($id, $new_product_id)
	updateText($id, $new_text)
	updateRating($id, $new_rating)
	updateApproved($id, $new_approved)
	delete($id)		
*/