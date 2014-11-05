@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			
				<div class="s_title_n_control">
					<h3 style="float: left;">
						Welcome To Dashboard
					</h3>
				</div>
				<span class="clearfix"></span>
				<hr></hr>
				
				<div>
					<div class="col-lg-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Penjualan Bulan Ini</h3>
							</div>
							<div class="panel-body">
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
						</div>
					</div>
					<div class="col-lg-3">
						<div class="panel panel-default">
						  <div class="panel-heading">
						    <h3 class="panel-title">Top 10 Products</h3>
						  </div>
						  <div class="panel-body">
						   	<table class="table table-condensed table-bordered">
						   		<thead>
						   			<tr>
						   				<th>
						   					Nama Produk
						   				</th>
						   			</tr>
						   		</thead>
						   		<tbody>
						   			@foreach($hasil2 as $key)
										<tr>
											<td>
												<input type="hidden" id = "idProd" value="{{$key->product_id}}" />
												{{$key->product_name}}
											</td>
										</tr>
									@endforeach
						   		</tbody>
						   	</table>
						  </div>
						</div>
					</div>
					<div class="col-lg-3">
						<div class="panel panel-default">
						  <div class="panel-heading">
						    <h3 class="panel-title">Top 10 Buyers</h3>
						  </div>
						  <div class="panel-body">
						   	<table class="table table-condensed table-bordered">
						   		<thead>
						   			<tr>
						   				<th>
						   					Nama Produk
						   				</th>
						   			</tr>
						   		</thead>
						   		<tbody>
						   			<?php
						   				for($i = 0; $i < 10; $i++){
				   					?>
						   			<tr>
						   				<td>
						   					Nama Orang
						   				</td>
						   			</tr>

				   					<?php
						   				}
						   			?>
						   		</tbody>
						   	</table>
							<?php 
								$str = '';
								$str2 = '';
								$i = 0;
							?>
							@foreach($hasil as $key)
								<?php 
									if($i == 0)
									{
										$str = $str.$key->penjualan ;
										if($key->ket == 'day' || $key->ket == 'month' || $key->ket == 'year'|| $key->ket == 'range')
										{
											$str2 = $str2.$key->tanggal ;
										}else if($key->ket == 'week')
										{
											$str2 = $str2.$key->week ;
										}
									}else
									{
										$str = $str.','.$key->penjualan ;
										if($key->ket == 'day'  || $key->ket == 'month' || $key->ket == 'year' || $key->ket == 'range')
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
				
			</div>
		</div>
	</div>
	
	@include('includes.modals.alertYesNo')	
	@include('pages.admin.cms.pop_up_edit_company_info')
	@include('pages.admin.cms.pop_up_edit_seo')
	
@stop