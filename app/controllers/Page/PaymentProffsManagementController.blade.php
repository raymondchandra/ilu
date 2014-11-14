<?php

class PaymentProffsManagementController extends \BaseController
{
	public function view_admin_paymentproff()
	{
		$paymentProffController = new PaymentProffsController();
		
		$paymentProffJson = $paymentProffController->getAll();
		$json = json_decode($paymentProffJson->getContent());
		
		if($json->{'code'} == "200")
		{
			$paginator = $json->{'messages'};
									
			$perPage = 10;   
			$page = Input::get('page', 1);
			if ($page > count($paginator) or $page < 1)
			{
				$page = 1; 
			}
			$offset = ($page * $perPage) - $perPage;
			$articles = array_slice($paginator,$offset,$perPage);
			$paymentProff = Paginator::make($articles, count($paginator), $perPage);			
		}
		else
		{
			$page = null;
			$paymentProff = null;
		}
		
		return View::make('pages.admin.payment_proof.manage_payment_proof', compact('paymentProff','page'));
	}
}