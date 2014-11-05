<?php

class CustomerManagementController extends \BaseController 
{
	public function view_cust_mgmt()
	{	
		$sortBy = Input::get('sortBy','none');
		$sortType = Input::get('order','none');
		$filtered = Input::get('filtered', '0');
		$profileController = new ProfilesController();
		if($filtered == '0')
		{
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
			if(count($paginator) != 0)
			{
				foreach($paginator as $prof)
				{
					$account = Profile::find($prof->id)->account;
					$prof->acc_id = $account->id;
					$prof->acc_active = $account->active;
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
				$filtered = 0;
			}
			else
			{
				$profiles = null;
				$filtered = 0;
			}
			return View::make('pages.admin.customer.manage_customer', compact('profiles','sortBy','sortType','page','filtered'));
		}
		else
		{
			$memberId = Input::get('memberId','-');
			$fullName = Input::get('namaFull', '-');
			$profileName = Input::get('namaProfile', '-');
			$email = Input::get('email', '-');
			$active = Input::get('active');
			if($active == "Banned")
			{
				$activeTab = 0;
			}
			else if($active == "Active")
			{
				$activeTab = 1;
			}
			else
			{
				$activeTab = 2;
			}
			
			if($sortBy == "none")
			{
				$profilesJson = $profileController->getFilteredProfile($memberId, $fullName, $profileName, $email, $activeTab);
			}
			else
			{
				$profilesJson = $profileController->getFilteredProfileSorted($memberId, $fullName, $profileName, $email,$sortBy, $sortType, $activeTab);
			}
			
			$json = json_decode($profilesJson->getContent());
			if($json->{'code'} == "404")
			{
				$profiles = null;
			}
			else
			{
				$paginator = $json->{'messages'};
				foreach($paginator as $prof)
				{
					$account = Profile::find($prof->id)->account;
					$prof->acc_id = $account->id;
					$prof->acc_active = $account->active;
				}
				$profiles=$paginator;
			}
			return View::make('pages.admin.customer.manage_customer', compact('profiles','filtered','memberId','fullName','profileName', 'email','sortBy','sortType','active'));
		}
	}
}