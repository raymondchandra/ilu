<?php

class CustomerManagementController extends \BaseController 
{
	public function view_cust_mgmt()
	{
		$sortBy = Input::get('sortBy','none');
		$sortType = Input::get('order','none');
		$profileController = new ProfilesController();
		if($sortBy === "none")
		{
			$profilesJson = $profileController->getAll();
		}
		else
		{
			$profilesJson = $profileController->getSortedAll($sortBy, $sortType);
		}
		
		$json = json_decode($profilesJson->getContent());
	
		$paginator = $json->{'messages'};
		
		foreach($paginator as $prof)
		{
			$prof->acc_id = Profile::find($prof->id)->account->id;
		}
		
		$perPage = 5;   
		$page = Input::get('page', 1);
		if ($page > count($paginator) or $page < 1)
		{
			$page = 1; 
		}
		$offset = ($page * $perPage) - $perPage;
		$articles = array_slice($paginator,$offset,$perPage);
		$profiles = Paginator::make($articles, count($paginator), $perPage);
		
		return View::make('pages.admin.customer.manage_customer', compact('profiles','sortBy','sortType','page'));
	}
}