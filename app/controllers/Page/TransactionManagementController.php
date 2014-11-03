<?php

class TransactionManagementController extends \BaseController 
{
	public function view_transaction_mgmt()
	{
		$sortBy = Input::get('sortBy','none');
		$sortType = Input::get('order','none');
		$filtered = Input::get('filtered', '0');
		
		$transController = new TransactionsController();
		
		if($filtered == '0')
		{
			if($sortBy == 'none')
			{
				$json = $transController->getAll();
			}else
			{
				$json = $transController->getAllSort($sortBy, $sortType);
			}
			$hsl = json_decode($json->getContent());
			if($hsl->{'code'} == "200")
			{
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
			}else
			{
				$page = null;
				$hasil = $hsl;
			}
			$filtered = 0;
			return View::make('pages.admin.transaction.manage_transaction', compact('hasil','sortBy','sortType','page','filtered'));
		}else
		{
			$invoice = Input::get('invoice','-');
			$accId = Input::get('accId','-');
			$fullName = Input::get('fullName','-');
			$totalPrice = Input::get('totalPrice','-');
			$status = Input::get('status','-');
			$paid = Input::get('paid','-');
			
			if($sortBy === "none")
			{
				$json = $transController->getFilteredTransaction($invoice, $accId, $fullName, $totalPrice,$status,$paid);
			}
			else
			{
				$json = $transController->getFilteredTransactionSort($invoice, $accId, $fullName, $totalPrice,$status,$paid,$sortBy, $sortType);
			}
			
			$json2 = json_decode($json->getContent());
			if($json2->{'code'} == "404")
			{
				$hasil = $json2;
			}
			else
			{
				$paginator = $json2->{'messages'};
				
				$hasil=$paginator;
			}
			return View::make('pages.admin.transaction.manage_transaction', compact('hasil','sortBy','sortType','page','filtered', 'invoice', 'accId', 'fullName', 'totalPrice', 'status', 'paid'));
		}
	}
	
}