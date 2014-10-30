<?php

class ReportingManagementController extends \BaseController 
{
	public function view_reporting_mgmt_day()
	{
		$rpt = Input::get('reportBy','day');
		$shp = new TransactionsController();
		if($rpt == 'day')
		{
			$json = $shp->getDayReport();
		}else if($rpt == 'week')
		{
			$json = $shp->getWeekReport();
		}else if($rpt == 'month')
		{
			$json = $shp->getMonthReport();
		}else if($rpt == 'year')
		{
			$json = $shp->getYearReport();
		}else if($rpt == 'range')
		{
			$d1 = Input::get('date1');
			$d2 = Input::get('date2');
			$json = $shp->getRangeReport($d1,$d2);
		}

		$hsl = json_decode($json->getContent());
		$hsl2 = $hsl->{'messages'};
		if($hsl->{'code'} == "200")
		{
			$paginator = $hsl->{'messages'};
			
			$perPage = 16;   
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
		if($rpt == 'range')
		{
			$rptr = $hsl2;
			$perPage = 16;   
			$page = Input::get('page', 1);
			if ($page > count($rptr) or $page < 1) { $page = 1; }
			$offset = ($page * $perPage) - $perPage;
			$articles = array_slice($rptr,$offset,$perPage);
			$datas = Paginator::make($articles, count($rptr), $perPage);
			
			$datas->appends(array('reportBy'=> 'range'));
			$datas->appends(array('date1'=> $d1));
			$datas->appends(array('date2' =>$d2));
			$links = $datas ->links();
			
			$a = array('hasil1' =>$datas->getCollection()->toArray(), 'hasil2' => $hsl2, 'links' =>json_encode((string)$links));
			return $a;
		}else
		{
			return View::make('pages.admin.report.manage_report', compact('hasil','hsl2'));
		}
	}
}