<?php

class ReviewsManagementController extends \BaseController
{
	public function view_admin_review()
	{
		$sortBy = Input::get('sortBy','none');
		$sortType = Input::get('order','none');
		$filtered = Input::get('filtered','0');			
		$reviewController = new ReviewsController();
		
		if($filtered == '0')
		{					
			if($sortBy === "none")
			{
				$reviewsJson = $reviewController->getAll();
			}
			else
			{
				$reviewsJson = $reviewController->getAllSorted($sortBy, $sortType);
			}
			
			$json = json_decode($reviewsJson->getContent());
					
			if($json->{'code'} == "200")
			{
				$paginator = $json->{'messages'};
										
				$perPage = 5;   
				$page = Input::get('page', 1);
				if ($page > count($paginator) or $page < 1)
				{
					$page = 1; 
				}
				$offset = ($page * $perPage) - $perPage;
				$articles = array_slice($paginator,$offset,$perPage);
				$reviews = Paginator::make($articles, count($paginator), $perPage);
				$filtered = 0;
			}
			else
			{
				$page = null;
				$reviews = null;
			}
			
			return View::make('pages.admin.review.manage_review', compact('reviews','sortBy','sortType','page','filtered'));
		}
		else
		{			
			$product_no = Input::get('product_no', '');
				if($product_no == '')
				{
					$product_no = '';
				}	
			$product_name = Input::get('product_name', '');
				if($product_name == '')
				{
					$product_name = '';
				}				
			$text = Input::get('text', '');
				if($text == '')
				{
					$text = '';
				}
			$rating = Input::get('rating', -1);
				if($rating == '')				
				{
					$rating = -1;
				}
			$approved = Input::get('approved', -1);
				if($approved == '')				
				{
					$approved = -1;
				}
			if($sortBy === "none")
			{
				$reviewsJson = $reviewController->getFilteredReview($product_no, $product_name, $text, $rating, $approved);								
			}			
			else
			{
				$reviewsJson = $reviewController->getFilteredReviewSorted($product_no, $product_name, $text, $rating, $approved, $sortBy, $sortType);				
			}						
		
			$json = json_decode($reviewsJson->getContent());
			
			if($json->{'code'} == "200")
			{
				$paginator = $json->{'messages'};
				$reviews = $paginator;
			}
			else
			{				
				$reviews = null;
			}
			return View::make('pages.admin.review.manage_review', compact('reviews','filtered','product_no','product_name','text','rating','approved','sortBy','sortType'));									
		}
	}
	
	public function view_detail_review($id)
	{
		$reviewController = new ReviewsController();
		$json = json_decode($reviewController->getById($id)->getContent());
		return json_encode($json);
	}
	
	// public function addReview()
	// {
		
	// }
	
	public function editApproved()
	{
		$json_data = Input::get('json_data');		
		$json = json_decode($json_data);
		
		$id = $json->{'id'};
		$new_approved = $json->{'new_approved'};
		
		$reviewController = new ReviewsController();
		$json = json_decode($reviewController->updateApproved($id, $new_approved)->getContent());
		return json_encode($json);
	}
	
	// public function deleteReview()
	// {
	// }
}