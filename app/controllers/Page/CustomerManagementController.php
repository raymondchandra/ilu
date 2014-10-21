<?php

class CustomerManagementController extends \BaseController 
{
	public function view_cust_mgmt()
	{
		$profileController = new ProfilesController();
		$profilesJson = $profileController->getAll();
		
		$json = json_decode($profilesJson->getContent());
	
		$profiles = $json->{'messages'};
		
		foreach($profiles as $prof)
		{
			$prof->acc_id = Profile::find($prof->id)->account->id;
		}
		
		return View::make('pages.admin.customer.manage_customer', compact('profiles'));
	}
}