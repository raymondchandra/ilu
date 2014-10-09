<?php

class Promotion extends \Eloquent {

	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'amount' => 'required|regex:/^\d*(\.\d{2})?$/',
		'expired' => 'required',
		'active' => 'required|integer'
	];

	// Don't forget to fill this array
	protected $fillable = ['amount', 'expired', 'active'];
	
	public function product()
	{
		return $this->hasMany('Product');
	}
}

/*
method :
	insert()
	getAll()
	getAllAmountAsc()
	getAllAmountDesc()
	getAllExpiredAsc();
	getAllExpiredDesc();
	getById($id)
	getByAmountLessThanEqual($limit)
	getByAmountLessThanEqualAsc($limit)
	getByAmountLessThanEqualDesc($limit)
	getByAmountMoreThanEqual($limit)
	getByAmountMoreThanEqualAsc($limit)
	getByAmountMoreThanEqualDesc($limit)
	getByAmountBetweenEqual($lower_limit, $upper_limit)	
	getByAmountBetweenEqualAsc($lower_limit, $upper_limit)	
	getByAmountBetweenEqualDesc($lower_limit, $upper_limit)
	getByExpiredLessThanEqual($date)
	getByExpiredLessThanEqualAsc($date)
	getByExpiredLessThanEqualDesc($date)
	getByExpiredMoreThanEqual($date)
	getByExpiredMoreThanEqualAsc($date)
	getByExpiredMoreThanEqualDesc($date)
	getByExpiredBetweenEqual($lower_date, $upper_date)
	getByExpiredBetweenEqualAsc($lower_date, $upper_date)
	getByExpiredBetweenEqualDesc($lower_date, $upper_date)
	getByActive($active)	
	updateFull($id)
	updateAmount($id, $new_amount)
	updateExpired($id, $new_expired)
	updateActive($id, $new_active)
	delete($id)	
*/