<?php

class TransactionManagementController extends \BaseController 
{
	public function view_transaction_mgmt()
	{
		$shp = new TransactionsController();
		$json = $shp->getAll();
		$hsl = json_decode($json->getContent());
		$paginator = $hsl->{'messages'};
		
		$perPage = 5;   
		$page = Input::get('page', 1);
		if ($page > count($paginator) or $page < 1)
		{
			$page = 1; 
		}
		$offset = ($page * $perPage) - $perPage;
		$articles = array_slice($paginator,$offset,$perPage);
		$hasil = Paginator::make($articles, count($paginator), $perPage);
		
		return View::make('pages.admin.transaction.manage_transaction', compact('hasil'));
	}
	
}