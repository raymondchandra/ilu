@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			
			<div class="s_title_n_control">
				<h3 style="float: left;">
					Manage Report Produk
				</h3>
				<!--<a data-toggle="modal" data-target=".pop_up_view_report_range" href="javascript:void(0);" class="btn btn-primary" style="float: right; margin-top: 20px;margin-left: 10px;" >By Range</a>
				<a href="{{action('ReportingManagementController@view_reporting_mgmt_day', array('reportBy' => 'day'))}}" class="btn btn-primary" style="float: right; margin-top: 20px;margin-left: 10px;" >By Day</a>
				<a href="{{action('ReportingManagementController@view_reporting_mgmt_day', array('reportBy' => 'week'))}}" class="btn btn-primary" style="float: right; margin-top: 20px;margin-left: 10px;" >By Week</a>
				<a href="{{action('ReportingManagementController@view_reporting_mgmt_day', array('reportBy' => 'month'))}}" class="btn btn-primary" style="float: right; margin-top: 20px;margin-left: 10px;" >By Month</a>
				<a href="{{action('ReportingManagementController@view_reporting_mgmt_day', array('reportBy' => 'sixMonth'))}}" class="btn btn-primary" style="float: right; margin-top: 20px;margin-left: 10px;" >By 6 Month</a>
				<a href="{{action('ReportingManagementController@view_reporting_mgmt_day', array('reportBy' => 'year'))}}" class="btn btn-primary" style="float: right; margin-top: 20px;margin-left: 10px;" >By Year</a>
				<a href="{{ URL::to('test/manage_shipping_agent') }}" class="btn btn-default" style="float: right; margin-top: 20px;margin-left: 10px;" >Manage Shipping Agent</a>-->
			</div>
			<span class="clearfix"></span>
			<hr></hr>
			

			<span class="clearfix"></span>

			<div class="col-sm-12">
				<div class="pull-left" style="width: 20%;">
					<style>
					.nav-tabs > li {
						width: 100%;
					}
					.nav-tabs > li > a {
						border-top: 1px solid #ddd;
						border-bottom: 1px solid #ddd;
						border-left: 1px solid #ddd;
						border-right: 1px solid #ddd;
						border-radius: 4px 4px 4px 4px;
						background-color: #ddd;
					}

					.nav-tabs > li.active > a, .nav-tabs > li.active > a:focus{
						border-top: 1px solid #ddd;
						border-bottom: 1px solid #ddd;
						border-left: 1px solid #ddd;
						border-right: 1px solid #ddd;
						border-radius: 4px 4px 4px 4px;
						background-color: #fff;
					}
					</style>
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist" style="border: 0px;">
						<li role="presentation" class="active pull-right"><a href="#3" role="tab" data-toggle="tab" style="">Lakunya Sebuah Produk</a></li>
						<span class="clearfix "></span>
						<li role="presentation" class="pull-right"><a href="#4" id='cms_news' role="tab" data-toggle="tab" style="">News</a></li>
					</ul>
				</div>
				<!-- Tab panes -->
				<div class="pull-left" style="width:76%; padding-left:20px; padding-right: 20px;border: 1px solid #676767 !important;">
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane fade in active" id="3">
							<!-- --------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
							<h3 class="pull-left">
								Daftar Informasi 

							</h3>
							<label class="radio-inline pull-right" style="margin-top: 20px;">
								<input type="radio" name="f_radio_pilih_lakunya_sebuah_produk" id="" value="range"> Range
							</label>
							<label class="radio-inline pull-right" style="margin-right: 20px; margin-top: 20px;">
								<input type="radio" name="f_radio_pilih_lakunya_sebuah_produk" id="" value="one_month" checked> Per 1 Bulan
							</label>
							<div id="f_lakunya_sebuah_produk_bulan">
								<form class="form-horizontal" role="form">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>
													Nama Produk
												</th>
												<th>
													Bulan
												</th>
												<th>
													Tahun
												</th>
												<th>
													Command 
												</th>
											</tr>
										</thead>
										<tbody class="f_lakunya_sebuah_produk">
											<tr>
												<td>
													<select class="form-control idPro">
														@foreach($hsl2 as $key )
															<option value="{{$key->id}}">{{$key->name}}</option>
														@endforeach
													</select>
												</td>
												<td>
													<select class="form-control bulanRepPro">
														<option value="January">Januari</option>
														<option value="February">Februari</option>
														<option value="March">Maret</option>
														<option value="April">April</option>
														<option value="May">Mei</option>
														<option value="June">Juni</option>
														<option value="July">Juli</option>
														<option value="August">Agustus</option>
														<option value="September">September</option>
														<option value="October">Oktober</option>
														<option value="November">November</option>
														<option value="December">Desember</option>
													</select>
												</td>
												<td>
													<select class="form-control tahunRepPro">
														<?php
														for($i = 0; $i<50; $i++){
															?>
															<option value="<?php echo(date('Y')-$i);?>"><?php echo(date('Y')-$i); ?></option>
															<?php
														}
														?>

													</select>
												</td>
												<td>
													<button type="button" class="btn btn-success procBut">Show</button>
												</td>
											</tr>
										</tbody>
									</table>
								</form>		
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>
												Date
											</th>
											<th>
												Penjualan
											</th>
										</tr>
									</thead>
									<tbody class="f_lakunya_sebuah_produk_hasil">
										
									</tbody>
								</table>
							</div>
							<div id="f_lakunya_sebuah_produk_range" class="hidden">
								<form class="form-horizontal" role="form">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>
													Nama Produk
												</th>
												<th>
													Bulan
												</th>
												<th>
													Tahun
												</th>
												<th>
													Command 
												</th>
											</tr>
										</thead>
										<tbody class="f_lakunya_sebuah_produk">
											<tr>
												<td>
													<select class="form-control idPro">
														@foreach($hsl2 as $key )
															<option value="{{$key->id}}">{{$key->name}}</option>
														@endforeach
													</select>
												</td>
												<td>
													<select class="form-control bulanRepPro">
														<option value="January">Januari</option>
														<option value="February">Februari</option>
														<option value="March">Maret</option>
														<option value="April">April</option>
														<option value="May">Mei</option>
														<option value="June">Juni</option>
														<option value="July">Juli</option>
														<option value="August">Agustus</option>
														<option value="September">September</option>
														<option value="October">Oktober</option>
														<option value="November">November</option>
														<option value="December">Desember</option>
													</select>
												</td>
												<td>
													<select class="form-control tahunRepPro">
														<?php
														for($i = 0; $i<50; $i++){
															?>
															<option value="<?php echo(date('Y')-$i);?>"><?php echo(date('Y')-$i); ?></option>
															<?php
														}
														?>

													</select>
												</td>
												<td>
													<button type="button" class="btn btn-success procBut">Show</button>
												</td>
											</tr>
										</tbody>
									</table>
								</form>		
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>
												Date
											</th>
											<th>
												Count Penjualan
											</th>
										</tr>
									</thead>
									<tbody class="f_lakunya_sebuah_produk_hasil2">
										<tr data-toggle="modal" data-target=".pop_up_view_report_produk_detail">
											<td>
												45 45 3454
											</td>
											<td>
												Count Penjualan
											</td>
										</tr>
									</tbody>
								</table>		
							</div>
							<script>
							$('body').on('change', 'input:radio[name="f_radio_pilih_lakunya_sebuah_produk"]', function() {

								if ($(this).is(':checked') && $(this).val() == 'one_month') {
									$('#f_lakunya_sebuah_produk_range').addClass('hidden');
									$('#f_lakunya_sebuah_produk_bulan').removeClass('hidden');
								}else{
									$('#f_lakunya_sebuah_produk_range').removeClass('hidden');
									$('#f_lakunya_sebuah_produk_bulan').addClass('hidden');
								}

							});
							</script>

							<!-- --------------------------------------------------------------------------------------------------------------------------------------------------------------- -->				
						</div>
						
						<div role="tabpanel" class="tab-pane fade" id="4">
							<!-- --------------------------------------------------------------------------------------------------------------------------------------------------------------- -->
							<h3 class="pull-left">
								Daftar Informasi 

							</h3>
							<label class="radio-inline pull-right" style="margin-top: 20px;">
								<input type="radio" name="f_radio_pilih_lakunya_sebuah_produk_1" id="" value="range"> Range
							</label>
							<label class="radio-inline pull-right" style="margin-right: 20px; margin-top: 20px;">
								<input type="radio" name="f_radio_pilih_lakunya_sebuah_produk_1" id="" value="one_month" checked> Per 1 Bulan
							</label>
							<div id="f_lakunya_sebuah_produk_bulan_1">
								<form class="form-horizontal" role="form">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>
													Dari Tanggal
												</th>
												<th>
													Sampai Tanggal
												</th>
												<th>
													Command 
												</th>
											</tr>
										</thead>
										<tbody class="f_lakunya_sebuah_produk">
											<tr>
												<td>
													<input type='text' class="form-control"  id='datepicker001_lakunya_sebuah_produk'/> 
												</td>
												<td>
													<input type='text' class="form-control"  id='datepicker011_lakunya_sebuah_produk'/>
												</td>
												<td>
													<button type="button" class="btn btn-success butRepPro">
														Show
													</button>
												</td>
											</tr>
										</tbody>
										<script type="text/javascript">
										$(function () {
											$('#datepicker001_lakunya_sebuah_produk').datepicker({
												format:"dd-MM-yyyy"
											});
											$('#datepicker011_lakunya_sebuah_produk').datepicker({
												format:"dd-MM-yyyy"
												
											});
										});
										</script>
									</table>
								</form>		
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>
												Date
											</th>
											<th>
												Penjualan
											</th>
										</tr>
									</thead>
									<tbody class="f_lakunya_sebuah_produk_hasil">
										
									</tbody>
								</table>
							</div>
							<div id="f_lakunya_sebuah_produk_range_1" class="hidden">
								<form class="form-horizontal" role="form">
									<table class="table table-bordered">
										<thead>
											<tr>
												<th>
													Dari Tanggal
												</th>
												<th>
													Sampai Tanggal
												</th>
												<th>
													Command 
												</th>
											</tr>
										</thead>
										<tbody class="f_lakunya_sebuah_produk">
											<tr>
												<td>
													<input type='text' class="form-control"  id='datepicker00_lakunya_sebuah_produk'/> 
												</td>
												<td>
													<input type='text' class="form-control"  id='datepicker01_lakunya_sebuah_produk'/>
												</td>
												<td>
													<button type="button" class="btn btn-success butRepPro">
														Show
													</button>
												</td>
											</tr>
										</tbody>
										<script type="text/javascript">
										$(function () {
											$('#datepicker00_lakunya_sebuah_produk').datepicker({
												format:"dd-MM-yyyy"
											});
											$('#datepicker01_lakunya_sebuah_produk').datepicker({
												format:"dd-MM-yyyy"
												
											});
										});
										</script>
									</table>
								</form>		
								<table class="table table-bordered table-striped">
									<thead>
										<tr>
											<th>
												Date
											</th>
											<th>
												Count Penjualan
											</th>
										</tr>
									</thead>
									<tbody class="f_lakunya_sebuah_produk_hasil2">
										<tr data-toggle="modal" data-target=".pop_up_view_report_produk_detail">
											<td>
												45 45 3454
											</td>
											<td>
												Count Penjualan
											</td>
										</tr>
									</tbody>
								</table>		
							</div>
							<script>
							$('body').on('change', 'input:radio[name="f_radio_pilih_lakunya_sebuah_produk_1"]', function() {

								if ($(this).is(':checked') && $(this).val() == 'one_month') {
									$('#f_lakunya_sebuah_produk_range_1').addClass('hidden');
									$('#f_lakunya_sebuah_produk_bulan_1').removeClass('hidden');
								}else{
									$('#f_lakunya_sebuah_produk_range_1').removeClass('hidden');
									$('#f_lakunya_sebuah_produk_bulan_1').addClass('hidden');
								}

							});
							</script>

							<!-- --------------------------------------------------------------------------------------------------------------------------------------------------------------- -->				
						</div>
						
												
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
</div>
</div>

@include('includes.modals.alertYesNo')
@include('pages.admin.report.pop_up_view_report_produk_detail')

<script>
	$('body').on('click','.procBut',function(){
	$bln = $('.bulanRepPro').val();
	$thn = $('.tahunRepPro').val();
	$id = $('.idPro').val();
	$.ajax({
		type: 'GET',
		url: '{{URL::route('jeffry.getReportProduk1Month')}}',
		data: {	
			"bulanRepPro": $bln,
			"tahunRepPro" : $thn,
			"idPro" : $id
		},
		success: function(response){
			if(response['code'] == '404')
			{
				alert('failed');
				location.reload();
			}
			else
			{
				var tab ="";
				var obj = response['messages'];
				//alert(obj);
				var responses = obj;
				var tab = "";
				$(responses).each(function() {
						tab+= "<input type='hidden'  value='"+(this)['tanggal']+"-"+(this)['bulan']+"'/>";
						tab+= "<tr data-toggle='modal' data-target='.pop_up_view_report_produk_detail' class='viewDetTgl'>";
						tab+="<td>"+(this)['tanggal']+"-"+(this)['bulan']+"</td>";
						tab+="<td>"+toRp((this)['penjualan'])+"</td>";
						tab+="</tr>";
					});
					$('.f_lakunya_sebuah_produk_hasil').html(tab);
			}
		},error: function(xhr, textStatus, errorThrown){
			alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
			alert("responseText: "+xhr.responseText);
		}
	},'json');

});

$('body').on('click','.viewDetTgl',function(){
			$tgl = $(this).prev().val();
			$id = $('.idPro').val();
			$('#myModalLabelDet').text("Detail Produk "+ $('.idPro').find(":selected").text()+ " Pada Tanggal "+$tgl);
			$.ajax({
				type: 'GET',
				url: '{{URL::route('jeffry.getReportProduk1MonthDetail')}}',
				data: {	
					"tgl": $tgl,
					"id" : $id
				},
				success: function(response){
					if(response['code'] == '404')
					{
						var tab="";
						tab+= "<tr>";
						tab+="<td colspan='2'>"+"No Transactions"+"</td>";
						tab+="</tr>";
						
						$('.detailProdTab').html(tab);
					}
					else
					{
						var tab = "";
						var obj = response['messages'];
						
						var responses = obj;
						var idx = 0;
						$(responses).each(function() {
								tab+= "<tr>";
								tab+="<td>"+responses[idx].invoice+"</td>";
								tab+="<td>"+responses[idx].quantity+"</td>";
								tab+="<td>"+responses[idx].full_name+"</td>";
								tab+="</tr>";
								idx = idx+1;
							});
							$('.detailProdTab').html(tab);
					}
				},error: function(xhr, textStatus, errorThrown){
					alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
					alert("responseText: "+xhr.responseText);
				}
			},'json');
	});

function toRp(angka){
		var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
		var rev2    = '';
		for(var i = 0; i < rev.length; i++){
			rev2  += rev[i];
			if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
				rev2 += '.';
			}
		}
		return 'Rp ' + rev2.split('').reverse().join('')+',-';
		//return 'IDR ' + rev2.split('').reverse().join('') + ',00';
	}
</script>
@stop