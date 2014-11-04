<?php
	class DashboardsManagementController extends \BaseController 
	{
		public function view_dashboard_mgmt()
		{
			$hasil = array();
			$trans = new TransactionsController();
			$report = $trans->getDayReportDashboard();
			$topTenProd = $trans->getTopTenProduct();
			//$topTenBuy =$trans->getTopTenBuyer();
			
			$hsl1 = json_decode($report->getContent());
			if($hsl1->{'code'} == "200")
			{
				$hasil = $hsl1->{'messages'};
			}else
			{
				$hasil = null;
			}
			
			$hsl2 = json_decode($topTenProd->getContent());
			if($hsl2->{'code'} == "200")
			{
				$hasil2 = $hsl2->{'messages'};
			}else
			{
				$hasil2 = null;
			}
			
			return View::make('pages.admin.dashboard', compact('hasil','hasil2'));
		}
	}
?>