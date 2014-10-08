<?php

class Product extends \Eloquent {


// 'name' => 'required|unique:categories',
		// 'parent_category' => '',
		// 'deleted' => 'required'
		
	// Add your validation rules here
	public static $rules = [
		// 'title' => 'required'
		'product_no' => 'required|unique:products',
		'name' => 'required',
		'description' => 'required',
		'category_id' => 'required|integer',
		'promotion_id' => 'integer',
		'deleted' => 'required|integer'		
	];

	// Don't forget to fill this array
	protected $fillable = ['product_no', 'name', 'description', 'category_id', 'promotion_id', 'deleted'];

/*
method :
	insert()
	getAll()
	getAllProductNoAsc()
	getAllProductNoDesc()
	getAllNameAsc()
	getAllNameDesc()	
	getById()
	getByProductNo($product_no)
	getByProductNoAsc($product_no)
	getByProductNoDesc($product_no)
	getByName($name)
	getByNameAsc($name)
	getByNameDesc($name)
	getByDescription($description)
	getByCategoryId($category_id)
	//getByCategoryIdProductNoAsc($category_id)
	//getByCategoryIdProductNoDesc($category_id)
	//getByCategoryIdNameAsc($category_id)
	//getByCategoryIdNameDesc($category_id)
	getByPromotionId($promotion_id)
	// getByPromotionIdProductIdAsc($promotion_id)
	// getByPromotionIdProductIdDesc($promotion_id)
	// getByPromotionIdNameAsc($promotion_id)
	// getByPromotionIdNameDesc($promotion_id)
	getByDeleted($deleted)	
	updateFull($id)
	updateProductNo($id, $new_product_no)
	updateName($id, $new_name)
	updateDescription($id, $new_description)
	updateCategoryId($id, $new_category_id)
	updatePromotionId($id, $new_promotion_id)
	updateDeleted($id, $new_deleted)
	delete($id)	
*/

	public function category()
    {
        return $this->belongsTo('Category');
    }

    public function price()
    {
        return $this->hasMany('Price');
    }

    public function order()
    {
        return $this->hasMany('Order');
    }

    public function gallery()
    {
        return $this->hasMany('Gallery');
    }

    public function review()
    {
    	return $this->hasMany('Review');
    }

    public function promotion()
    {
    	return $this->belongsTo('Promotion');
    }

    public function wishlist()
    {
    	return $this->hasMany('Wishlist');
    }
}