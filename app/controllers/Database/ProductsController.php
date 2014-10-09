<?php

class ProductsController extends \BaseController {

	/**
	 * Insert a newly created product in database.
	 *
	 * @return Response
	 */
	public function insert()
	{
		$respond = array();
		//validate
		$validator = Validator::make($data = Input::all(), Product::$rules);

		if ($validator->fails())
		{
			$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
			return Response::json($respond);
		}

		//save
		try {
			Product::create($data);
			$respond = array('code'=>'201','status' => 'Created');
		} catch (Exception $e) {
			$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
		}
		return Response::json($respond);
	}

	/**
	 * Display all of the product.
	 *
	 * @return Response
	 */
	public function getAll(){
		$respond = array();
		$product = Product::all();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display all of the product.
	 *
	 * @return Response
	 */
	public function getAllProductNoAsc(){
		$respond = array();
		$product = Product::all()->orderBy('product_no')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display all of the product.
	 *
	 * @return Response
	 */
	public function getAllProductNoDesc(){
		$respond = array();
		$product = Product::all()->orderBy('product_no', 'desc')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display all of the product.
	 *
	 * @return Response
	 */
	public function getAllNameAsc(){
		$respond = array();
		$product = Product::all()->orderBy('name')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}

	/**
	 * Display all of the product.
	 *
	 * @return Response
	 */
	public function getAllNameDesc(){
		$respond = array();
		$product = Product::all()->orderBy('name', 'desc')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified product.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getById($id)
	{
		$respond = array();
		$product = Product::find($id);
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified product.
	 *
	 * @param  
	 * @return Response
	 */
	public function getByProductNo($product_no)
	{
		$respond = array();
		// $product = Product::find($id);
		$product = Product::where('product_no', 'LIKE','%'.$product_no.'%')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}

	/**
	 * Display the specified product.
	 *
	 * @param  
	 * @return Response
	 */
	public function getByProductNoAsc($product_no)
	{
		$respond = array();
		// $product = Product::find($id);
		$product = Product::where('product_no', 'LIKE','%'.$product_no.'%')->orderBy('product_no')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified product.
	 *
	 * @param  
	 * @return Response
	 */
	public function getByProductNoDesc($product_no)
	{
		$respond = array();
		// $product = Product::find($id);
		$product = Product::where('product_no', 'LIKE','%'.$product_no.'%')->orderBy('product_no', 'desc')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified product.
	 *
	 * @param  
	 * @return Response
	 */
	public function getByName($name)
	{
		$respond = array();
		// $product = Product::find($id);
		$product = Product::where('name', 'LIKE','%'.$name.'%')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified product.
	 *
	 * @param  
	 * @return Response
	 */
	public function getByNameAsc($name)
	{
		$respond = array();
		// $product = Product::find($id);
		$product = Product::where('name', 'LIKE','%'.$name.'%')->orderBy('name')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified product.
	 *
	 * @param  
	 * @return Response
	 */
	public function getByNameDesc($name)
	{
		$respond = array();
		// $product = Product::find($id);
		$product = Product::where('name', 'LIKE','%'.$name.'%')->orderBy('name', 'desc')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified product.
	 *
	 * @param  
	 * @return Response
	 */
	public function getByDescription($description)
	{
		$respond = array();
		// $product = Product::find($id);
		$product = Product::where('description', 'LIKE','%'.$description.'%')->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified product.
	 *
	 * @param  
	 * @return Response
	 */
	public function getByCategoryId($category_id)
	{
		$respond = array();
		// $product = Product::find($id);
		$product = Product::where('category_id', '=', $category_id)->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified product.
	 *
	 * @param  
	 * @return Response
	 */
	public function getByPromotionId($promotion_id)
	{
		$respond = array();
		// $product = Product::find($id);
		$product = Product::where('promotion_id', '=', $promotion_id)->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	/**
	 * Display the specified product.
	 *
	 * @param  
	 * @return Response
	 */
	public function getByDeleted($deleted)
	{
		$respond = array();
		// $product = Product::find($id);
		$product = Product::where('deleted', '=', $deleted)->get();
		if (count($product) == 0)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			$respond = array('code'=>'200','status' => 'OK','messages'=>$product);
		}
		return Response::json($respond);
	}
	
	/**
	 * Update all value of the specified product in database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function updateFull($id)
	{
		$respond = array();
		$product = Product::find($id);
		if ($product == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//validate
			$validator = Validator::make($data = Input::all(), Product::$rules);

			if ($validator->fails())
			{
				$respond = array('code'=>'400','status' => 'Bad Request','messages' => $validator->messages());
				return Response::json($respond);
			}
			//save
			try {
				$product->update($data);
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}

	/**
	 * Update value of the specified product in database.
	 *
	 * @param 
	 * @return Response
	 */
	public function updateProductNo($id, $new_product_no)
	{
		$respond = array();
		$product = Product::find($id);
		if ($product == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$product->product_no = $new_product_no;
			try {
				$product->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}	
	
	/**
	 * Update value of the specified product in database.
	 *
	 * @param 
	 * @return Response
	 */
	public function updateName($id, $new_name)
	{
		$respond = array();
		$product = Product::find($id);
		if ($product == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$product->name = $new_name;
			try {
				$product->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	/**
	 * Update value of the specified product in database.
	 *
	 * @param 
	 * @return Response
	 */
	public function updateDescription($id, $new_description)
	{
		$respond = array();
		$product = Product::find($id);
		if ($product == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$product->description = $new_description;
			try {
				$product->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	/**
	 * Update value of the specified product in database.
	 *
	 * @param 
	 * @return Response
	 */
	public function updateCategoryId($id, $new_category_id)
	{
		$respond = array();
		$product = Product::find($id);
		if ($product == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$product->category_id = $new_category_id;
			try {
				$product->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	/**
	 * Update value of the specified product in database.
	 *
	 * @param 
	 * @return Response
	 */
	public function updatePromotionId($id, $new_promotion_id)
	{
		$respond = array();
		$product = Product::find($id);
		if ($product == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$product->promotion_id = $new_promotion_id;
			try {
				$product->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	/**
	 * Update value of the specified product in database.
	 *
	 * @param 
	 * @return Response
	 */
	public function updateDeleted($id, $new_deleted)
	{
		$respond = array();
		$product = Product::find($id);
		if ($product == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			//edit value
			$product->deleted = $new_deleted;
			try {
				$product->save();
				$respond = array('code'=>'204','status' => 'No Content');
			} catch (Exception $e) {
				$respond = array('code'=>'500','status' => 'Internal Server Error', 'messages' => $e);
			}
			
		}
		return Response::json($respond);
	}
	
	/**
	 * Remove the specified product from database.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function delete($id)
	{
		$respond = array();
		$product = Product::find($id);
		if ($product == null)
		{
			$respond = array('code'=>'404','status' => 'Not Found');
		}
		else
		{
			try {
				$product->delete();
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
		$product = Product::where('','=','')->get();
		if (count($product) >= 0)
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
