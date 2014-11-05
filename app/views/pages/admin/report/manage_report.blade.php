@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			
			<div class="s_title_n_control">
				<h3 style="float: left;">
					Manage Report
				</h3>
				<a data-toggle="modal" data-target=".pop_up_view_report_range" href="javascript:void(0);" class="btn btn-primary" style="float: right; margin-top: 20px;margin-left: 10px;" >By Range</a>
				<a href="{{action('ReportingManagementController@view_reporting_mgmt_day', array('reportBy' => 'day'))}}" class="btn btn-primary" style="float: right; margin-top: 20px;margin-left: 10px;" >By Day</a>
				<a href="{{action('ReportingManagementController@view_reporting_mgmt_day', array('reportBy' => 'week'))}}" class="btn btn-primary" style="float: right; margin-top: 20px;margin-left: 10px;" >By Week</a>
				<a href="{{action('ReportingManagementController@view_reporting_mgmt_day', array('reportBy' => 'month'))}}" class="btn btn-primary" style="float: right; margin-top: 20px;margin-left: 10px;" >By Month</a>
				<a href="{{action('ReportingManagementController@view_reporting_mgmt_day', array('reportBy' => 'sixMonth'))}}" class="btn btn-primary" style="float: right; margin-top: 20px;margin-left: 10px;" >By 6 Month</a>
				<a href="{{action('ReportingManagementController@view_reporting_mgmt_day', array('reportBy' => 'year'))}}" class="btn btn-primary" style="float: right; margin-top: 20px;margin-left: 10px;" >By Year</a>
				<!--<a href="{{ URL::to('test/manage_shipping_agent') }}" class="btn btn-default" style="float: right; margin-top: 20px;margin-left: 10px;" >Manage Shipping Agent</a>-->
			</div>
			<span class="clearfix"></span>
			<hr></hr>
			<div>
				<style type="text/css">
				${demo.css}
				</style>
				<script type="text/javascript">
					$(function () {
						var a = $('#penjualanGraf').val();
						var b = $('#tanggalGraf').val();
						var c;
						var d = $('#ket').val();
						var e;
						if(d == 'day')
						{
							e = 'Report By Day';
							c = $('#bulanGraf').val().replace('-',' ');
						}else if(d == 'week')
						{
							e = 'Report By Week';
							c = $('#bulanGraf').val().replace('-',' ');
						}else if(d == 'month')
						{
							e = 'Report By Month';
							c = $('#bulanGraf').val();
						}else if(d == 'year')
						{
							e = 'Report By Year';
						}else if(d == 'range')
						{
							e = 'Report By Range';
						}else if(d == 'sixmonth')
						{
							e = 'Report By Six Month';
						}
						b = b.split(",");
						$('#container').highcharts({
							chart: {
								type: 'line'
							},
							title: {
								text: e
							},
							subtitle: {
								text: c
							},
							xAxis: {
								categories: b	
							},
							yAxis: {
								title: {
									text: 'Rupiah'
								}
							},
							plotOptions: {
								line: {
									dataLabels: {
										enabled: true
									},
									enableMouseTracking: false
								}
							},
							series: [{
								name: 'Penjualan',
								data: JSON.parse("[" + a + "]")
							}]
						});
					});
			</script>
	<script src="{{ asset('assets/js/highcharts4/js/highcharts.js') }}"></script>
	<script src="{{ asset('assets/js/highcharts4/js/modules/data.js') }}"></script>
	<script src="{{ asset('assets/js/highcharts4/js/modules/exporting.js') }}"></script>

	<!-- Additional files for the Highslide popup effect -->
	<script type="text/javascript" src="http://www.highcharts.com/media/com_demo/highslide-full.min.js"></script>
	<script type="text/javascript" src="http://www.highcharts.com/media/com_demo/highslide.config.js" charset="utf-8"></script>
	<link rel="stylesheet" type="text/css" href="http://www.highcharts.com/media/com_demo/highslide.css" />

	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	</div>

	<span class="clearfix"></span>

	<div>
	<div id="navigator">
	{{$hasil->links()}}
	</div>
	<!--<button class="btn btn-success" style="float: right; margin-top: 20px;"  data-toggle="modal" data-target=".pop_up_add_shipping_agent">+ Add New Kurir</button>
	-->
	<table class="table table-striped table-hover table-condensed table-bordered" >
		<thead class="table-bordered">
			<tr>
				<th class="table-bordered">
					<a href="javascript:void(0)">Tanggal</a>
				</th>
				<th class="table-bordered" width="">
					<a href="javascript:void(0)">Penjualan</a>
				</th>
				<!-- <th class="table-bordered">

				</th> -->
			</thead>
			<tbody id="tblrg">
				@foreach($hasil as $key)
					<tr> 
						@if($key->ket == 'day')
							<td>{{$key->tanggal}}-{{$key->bulan}}</td>
							<td>{{$key->penjualan}}</td>
						@elseif($key->ket == 'week')
							<td>Week-{{$key->week}} ({{$key->tanggal_awal}} - {{$key->tanggal_akhir}})</td>
							<td>{{$key->penjualan}}</td>
						@elseif($key->ket == 'month')
							<td>{{$key->tanggal}}-{{$key->bulan}}</td>
							<td>{{$key->penjualan}}</td>
						@elseif($key->ket == 'year' || $key->ket == 'range')
							<td>{{$key->tanggal}}</td>
							<td>{{$key->penjualan}}</td>
						@elseif($key->ket == 'sixmonth')
							<td>{{$key->bulan}}</td>
							<td>{{$key->penjualan}}</td>
						@endif
					</tr> 
				@endforeach
			</tbody>
		</table>
		<?php 
			$str = '';
			$str2 = '';
			$i = 0;
		?>
		@foreach($hsl2 as $key)
			<?php 
				if($i == 0)
				{
					$str = $str.$key->penjualan ;
					if($key->ket == 'day' || $key->ket == 'month' || $key->ket == 'year'|| $key->ket == 'range' || $key->ket == 'sixmonth' )
					{
						$str2 = $str2.$key->tanggal ;
					}else if($key->ket == 'week')
					{
						$str2 = $str2.$key->week ;
					}
				}else
				{
					$str = $str.','.$key->penjualan ;
					if($key->ket == 'day'  || $key->ket == 'month' || $key->ket == 'year' || $key->ket == 'range' || $key->ket == 'sixmonth' )
					{
						$str2 = $str2.','.$key->tanggal ;
					}else if($key->ket == 'week')
					{
						$str2 = $str2.','.$key->week ;
					}
				}
				if( $key->ket != 'year')
				{
					$str3 = $key->bulan;
				}
				$str4 = $key->ket;
				$i++;
			?>
		@endforeach
		<?php 
			echo '<input type="hidden" id = "penjualanGraf" value='.$str.' />';
			echo '<input type="hidden" id = "tanggalGraf" value='.$str2.' />';
			if( $key->ket != 'year')
			{
				echo '<input type="hidden" id = "bulanGraf" value='.$str3.' />';
			}
			echo '<input type="hidden" id = "ket" value='.$str4.' />';
		?>
	</div>

</div>
</div>
</div>

@include('includes.modals.alertYesNo')
@include('pages.admin.report.pop_up_view_report_day')
<script>
		$('body').on('click','#rangeClick',function(){
			//$('#datepicker00').html("");
			//$('#datepicker01').html("");
			$.ajax({
					type: 'GET',
					url: "{{URL::route('jeffry.getReport')}}",
					data: {	
						"reportBy": "range",
						"date1" : $('#datepicker00').val(),
						"date2" : $('#datepicker01').val()
					},
					success: function(response){
						if(response['code'] == '404')
						{
							//$('#wishlistcontent').append("<td>agent tidak ditemukan</td>");
							
						}
						else
						{
							var respon = response['hasil2'];
							var pjln = '';
							var tgl='';
							var bln='';
							var ket='';
							for(i=0; i < respon.length;i++)
							{
								if(i == 0)
								{
									pjln = pjln + (respon[i].penjualan);
									tgl = tgl + (respon[i].tanggal);
									
								}else
								{
									pjln = pjln + ',' + (respon[i].penjualan);
									tgl = tgl + ',' + (respon[i].tanggal);
								}
								bln = (respon[i].bulan);
								ket = (respon[i].ket);
							}
							$('#penjualanGraf').val(pjln);
							$('#tanggalGraf').val(tgl);
							$('#bulanGraf').val(bln);
							$('#ket').val(ket);
							
							var a = $('#penjualanGraf').val();
							var b = $('#tanggalGraf').val();
							var c;
							var d = $('#ket').val();
							var e;
							if(d == 'day')
							{
								e = 'Report By Day';
								c = $('#bulanGraf').val().replace('-',' ');
							}else if(d == 'week')
							{
								e = 'Report By Week';
								c = $('#bulanGraf').val().replace('-',' ');
							}else if(d == 'month')
							{
								e = 'Report By Month';
								c = $('#bulanGraf').val();
							}else if(d == 'year')
							{
								e = 'Report By Year';
							}else if(d == 'range')
							{
								e = 'Report By Range';
								c = $('#bulanGraf').val();
							}
							b = b.split(",");
							$('#container').highcharts({
								chart: {
									type: 'line'
								},
								title: {
									text: e
								},
								subtitle: {
									text: c
								},
								xAxis: {
									categories: b	
								},
								yAxis: {
									title: {
										text: 'Rupiah'
									}
								},
								plotOptions: {
									line: {
										dataLabels: {
											enabled: true
										},
										enableMouseTracking: false
									}
								},
								series: [{
									name: 'Penjualan',
									data: JSON.parse("[" + a + "]")
								}]
							});
							
							var tab ="";
							var obj = response['hasil1'];
							var responses = obj;
							$(responses).each(function() {
								tab+= "<tr>";
								tab+="<td>"+$(this)[0].tanggal2+"</td>";
								tab+="<td>"+$(this)[0].penjualan+"</td>";
								tab+="</tr>";
							});
							$('#tblrg').html(tab);
							$('#navigator').html(jQuery.parseJSON(response.links));
						}
					},error: function(xhr, textStatus, errorThrown){
						alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
						alert("responseText: "+xhr.responseText);
					}
				},'json');
		});
		
		$('body').on('click','#navigator ul li a',function(){
		
			var cek;
			var link = $(this).attr('href');
			$.get(link,function(response){
				try
				{
					if(response['hasil2'][0].ket == 'range')
					{
						cek = false;
						var tab ="";
						var obj = response['hasil1'];
						var responses = obj;
						$(responses).each(function() {
							tab+= "<tr>";
							tab+="<td>"+$(this)[0].tanggal2+"</td>";
							tab+="<td>"+$(this)[0].penjualan+"</td>";
							tab+="</tr>";
						});
						$('#tblrg').html(tab);
						$('#navigator').html(jQuery.parseJSON(response.links));
					}
				}catch(e)
				{
					window.location.assign(link);
				}
			});
			
			return false;
			
		});
		
</script>
@stop