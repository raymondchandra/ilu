@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			
			<div class="s_title_n_control">
				<h3 style="float: left;">
					Manage Report Pembayaran
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
						<li role="presentation" class="active pull-right"><a href="#3" role="tab" data-toggle="tab" style="">Laporan Pembayaran</a></li>
						<span class="clearfix "></span>
						<li role="presentation" class="pull-right"><a href="#4" id='' role="tab" data-toggle="tab" style="">Laporan Pembayaran 2</a></li>

						<!--
						<li role="presentation" class="pull-right"><a href="#4" id='cms_news' role="tab" data-toggle="tab" style="">News</a></li>
						<span class="clearfix "></span>
						<li role="presentation" class="pull-right"><a href="#5" id='cms_slideshow' role="tab" data-toggle="tab" style="">Slideshow</a></li>
					-->
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
								<input type="radio" name="f_radio_pilih_laporan_pembayaran" id="" value="one_month"> Range
							</label>
							<label class="radio-inline pull-right" style="margin-right: 20px; margin-top: 20px;">
								<input type="radio" name="f_radio_pilih_laporan_pembayaran" id="" value="range" checked> Per 1 Bulan
							</label>

						<div id="f_laporan_pembayaran_today" class="f_m">
							<form class="form-horizontal" role="form">
								<table class="table table-bordered">
										<thead>
											<tr>
												<th>
													Status
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
													<select class="form-control idStatus">
														<option value="paid">Paid</option>
														<option value="unpaid">Unpaid</option>
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
													<button type="button" class="btn btn-success procBut1">Show</button>
												</td>
											</tr>
										</tbody>
									</table>
							</form>		
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>
											Nama Pembeli
										</th>
										<th>
											No. Invoice
										</th>
										<th>
											Total Pembelian
										</th>
									</tr>
								</thead>
								<tbody class="f_laporan_pembayaran_hasil_today">
									
								</tbody>
							</table>
						</div>
						
						<div id="f_laporan_pembayaran_this_week" class="hidden f_m">
							<form class="form-horizontal" role="form">
								<table class="table table-bordered">
										<thead>
											<tr>
												<th>
													Nama Produk
												</th>
												<th>
													Dari tanggal
												</th>
												<th>
													Sampai tanggal
												</th>
												<th>
													Command 
												</th>
											</tr>
										</thead>
										<tbody class="f_lakunya_sebuah_produk">
											<tr>
												<td>
													<select class="form-control idStatus2">
															<option value="paid">Paid</option>
															<option value="unpaid">Unpaid</option>
													</select>
												</td>
												<td>
													<input type='text' class="form-control"  id='datepicker000_lakunya_sebuah_produk'/> 
												</td>
												<td>
													<input type='text' class="form-control"  id='datepicker010_lakunya_sebuah_produk'/>
												</td>
												<td>
													<button type="button" class="btn btn-success procBut2">Show</button>
												</td>
											</tr>
											<script type="text/javascript">
											$(function () {
												$('#datepicker000_lakunya_sebuah_produk').datepicker({
													format:"dd-MM-yyyy"
												});
												$('#datepicker010_lakunya_sebuah_produk').datepicker({
													format:"dd-MM-yyyy"
													
												});
											});
											</script>
										</tbody>
									</table>
							</form>		
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>
											Nama Pembeli
										</th>
										<th>
											No. Invoice
										</th>
										<th>
											Total Pembelian
										</th>
									</tr>
								</thead>
								<tbody class="f_laporan_pembayaran_hasil_this_week">
									
								</tbody>
							</table>
						</div>

						<script>
						$('body').on('change', 'input:radio[name="f_radio_pilih_laporan_pembayaran"]', function() {

							if ($(this).is(':checked') && $(this).val() == 'range') {
								$('#f_laporan_pembayaran_today').siblings('.f_m').addClass('hidden');
								$('#f_laporan_pembayaran_today').removeClass('hidden');
							/*}else if($(this).is(':checked') && $(this).val() == 'this_week'){
								$('#f_laporan_pembayaran_this_week').siblings('.f_m').addClass('hidden');
								$('#f_laporan_pembayaran_this_week').removeClass('hidden');
							}else if($(this).is(':checked') && $(this).val() == 'this_month'){
								$('#f_laporan_pembayaran_this_month').siblings('.f_m').addClass('hidden');
								$('#f_laporan_pembayaran_this_month').removeClass('hidden');
							*/}else{
								$('#f_laporan_pembayaran_this_week').siblings('.f_m').addClass('hidden');
								$('#f_laporan_pembayaran_this_week').removeClass('hidden');
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
										<tbody class="f_lakunya_sebuah_produk_1">
											<tr>
												<td>
													<select class="form-control bulanRepPro2">
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
													<select class="form-control tahunRepPro2">
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
													<button type="button" class="btn btn-success butRepPro1">
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
											Nama Pembeli
										</th>
										<th>
											No. Invoice
										</th>
										<th>
											Total Pembelian
										</th>
										<th>
											Status
										</th>
									</tr>
								</thead>
								<tbody class="f_laporan_pengiriman_hasil_range3">
									
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
										<tbody class="f_lakunya_sebuah_produk_1">
											<tr>
												<td>
													<input type='text' class="form-control"  id='datepicker00_lakunya_sebuah_produk'/> 
												</td>
												<td>
													<input type='text' class="form-control"  id='datepicker01_lakunya_sebuah_produk'/>
												</td>
												<td>
													<button type="button" class="btn btn-success butRepPro2">
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
											Nama Pembeli
										</th>
										<th>
											No. Transaksi
										</th>
										<th>
											Total Price
										</th>
										<th>
											Status
										</th>
									</tr>
								</thead>
								<tbody class="f_laporan_pengiriman_hasil_range4">
									
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

@include('includes.modals.alertYesNo')
@include('pages.admin.report.pop_up_view_report_pembayaran_detail')


<script>

$('body').on('click','.procBut1',function(){
	$stat = $('.idStatus').val();
	if($stat == 'paid')
	{
		$statHasil = 1;
	}else if($stat == 'unpaid')
	{
		$statHasil = 0;
	}
	$bln = $('.bulanRepPro').val();
	$thn = $('.tahunRepPro').val(); 
	$.ajax({
		type: 'GET',
		url: '{{URL::route('jeffry.getReportPembayaranMonth')}}',
		data: {	
			"status": $statHasil,
			"bulanRepPro": $bln,
			"tahunRepPro" : $thn
		},
		success: function(response){
			if(response['code'] == '404')
			{
				var tab ="";
				tab += "<tr>";
				tab+= "<td colspan='3'>Not Found</td>";
				tab+= "</tr>";
				$('.f_laporan_pembayaran_hasil_today').html(tab);
			}
			else
			{
				var tab ="";
				var obj = response['messages'];
				var responses = obj;
				var tab = "";
				var idx = 0;
					$(responses).each(function() {
						tab+= "<input type='hidden'  value='"+responses[idx].id+"'/>";
						tab+= "<tr data-toggle='modal' data-target='.pop_up_view_report_pembayaran_detail' class='viewDet'>";
						tab+="<td>"+responses[idx].full_name+"</td>";
						tab+="<td>"+responses[idx].invoice+"</td>";
						tab+="<td>"+toRp(responses[idx].total_price)+"</td>";
						tab+="</tr>";
						idx = idx+1;
					});
					$('.f_laporan_pembayaran_hasil_today').html(tab);
			}
		},error: function(xhr, textStatus, errorThrown){
			alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
			alert("responseText: "+xhr.responseText);
		}
	},'json');

});

$('body').on('click','.procBut2',function(){
	$stat = $('.idStatus2').val();
	if($stat == 'paid')
	{
		$statHasil = 1;
	}else if($stat == 'unpaid')
	{
		$statHasil = 0;
	}
	$d1 = $('#datepicker000_lakunya_sebuah_produk').val();
	$d2 = $('#datepicker010_lakunya_sebuah_produk').val();
	$.ajax({
		type: 'GET',
		url: '{{URL::route('jeffry.getReportPembayaranRange')}}',
		data: {	
			"status": $statHasil,
			"date1": $d1,
			"date2" : $d2
		},
		success: function(response){
			if(response['code'] == '404')
			{
				var tab ="";
				tab += "<tr>";
				tab+= "<td colspan='3'>Not Found</td>";
				tab+= "</tr>";
				$('.f_laporan_pembayaran_hasil_this_week').html(tab);
			}
			else
			{
				var tab ="";
				var obj = response['messages'];
				var responses = obj;
				var tab = "";
				var idx = 0;
					$(responses).each(function() {
						tab+= "<input type='hidden'  value='"+responses[idx].id+"'/>";
						tab+= "<tr data-toggle='modal' data-target='.pop_up_view_report_pembayaran_detail' class='viewDet'>";
						tab+="<td>"+responses[idx].full_name+"</td>";
						tab+="<td>"+responses[idx].invoice+"</td>";
						tab+="<td>"+toRp(responses[idx].total_price)+"</td>";
						tab+="</tr>";
						idx = idx+1;
					});
					$('.f_laporan_pembayaran_hasil_this_week').html(tab);
			}
		},error: function(xhr, textStatus, errorThrown){
			alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
			alert("responseText: "+xhr.responseText);
		}
	},'json');

});

$('body').on('click','.butRepPro1',function(){
	
	$bln = $('.bulanRepPro2').val();
	$thn = $('.tahunRepPro2').val(); 
	$.ajax({
		type: 'GET',
		url: '{{URL::route('jeffry.getReportAllPembayaranMonth')}}',
		data: {	
			"bulanRepPro": $bln,
			"tahunRepPro" : $thn
		},
		success: function(response){
			if(response['code'] == '404')
			{
				var tab ="";
				tab += "<tr>";
				tab+= "<td colspan='4'>Not Found</td>";
				tab+= "</tr>";
				$('.f_laporan_pengiriman_hasil_range3').html(tab);
			}
			else
			{
				var tab ="";
				var obj = response['messages'];
				var responses = obj;
				var tab = "";
				var idx = 0;
					$(responses).each(function() {
						tab+= "<input type='hidden'  value='"+responses[idx].id+"'/>";
						tab+= "<tr data-toggle='modal' data-target='.pop_up_view_report_pembayaran_detail' class='viewDet'>";
						tab+="<td>"+responses[idx].full_name+"</td>";
						tab+="<td>"+responses[idx].invoice+"</td>";
						tab+="<td>"+toRp(responses[idx].total_price)+"</td>";
						if(responses[idx].paid == 1)
						{
							tab+="<td>"+"Paid"+"</td>";
						}else if(responses[idx].paid == 0)
						{
							tab+="<td>"+"UnPaid"+"</td>";
						}
						tab+="</tr>";
						idx = idx+1;
					});
					$('.f_laporan_pengiriman_hasil_range3').html(tab);
			}
		},error: function(xhr, textStatus, errorThrown){
			alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
			alert("responseText: "+xhr.responseText);
		}
	},'json');

});

$('body').on('click','.butRepPro2',function(){
	$d1 = $('#datepicker00_lakunya_sebuah_produk').val();
	$d2 = $('#datepicker01_lakunya_sebuah_produk').val();
	$.ajax({
		type: 'GET',
		url: '{{URL::route('jeffry.getReportAllPembayaranRange')}}',
		data: {	
			"date1": $d1,
			"date2" : $d2
		},
		success: function(response){
			if(response['code'] == '404')
			{
				var tab ="";
				tab += "<tr>";
				tab+= "<td colspan='4'>Not Found</td>";
				tab+= "</tr>";
				$('.f_laporan_pengiriman_hasil_range4').html(tab);
			}
			else
			{
				var tab ="";
				var obj = response['messages'];
				var responses = obj;
				var tab = "";
				var idx = 0;
					$(responses).each(function() {
						tab+= "<input type='hidden'  value='"+responses[idx].id+"'/>";
						tab+= "<tr data-toggle='modal' data-target='.pop_up_view_report_pembayaran_detail' class='viewDet'>";
						tab+="<td>"+responses[idx].full_name+"</td>";
						tab+="<td>"+responses[idx].invoice+"</td>";
						tab+="<td>"+toRp(responses[idx].total_price)+"</td>";
						if(responses[idx].paid == 1)
						{
							tab+="<td>"+"Paid"+"</td>";
						}else if(responses[idx].paid == 0)
						{
							tab+="<td>"+"UnPaid"+"</td>";
						}
						tab+="</tr>";
						idx = idx+1;
					});
					$('.f_laporan_pengiriman_hasil_range4').html(tab);
			}
		},error: function(xhr, textStatus, errorThrown){
			alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
			alert("responseText: "+xhr.responseText);
		}
	},'json');

});

$('body').on('click','.viewDet',function(){
			$idTrans = $(this).prev().val();
			$.ajax({
				type: 'GET',
				url: '{{URL::route('jeffry.getReportPembayaranMonthDetail')}}',
				data: {	
					"id" : $idTrans
				},
				success: function(response){
					if(response['code'] == '404')
					{
						var tab="";
						tab+= "<tr>";
						tab+="<td colspan='4'>"+"Not Found"+"</td>";
						tab+="</tr>";
						
						$('.isiTab').html(tab);
					}
					else
					{
						var tab = "";
						var obj = response['messages'];
						$('#myModalLabelPe').text("Detail Pengiriman No Invoice "+ obj[0]['invoice']);
						var responses = obj;
						var idx = 0;
						$(responses).each(function() {
								tab+= "<tr>";
								tab+="<td>"+responses[idx].name+"</td>";
								tab+="<td><img width='100' height='100' src='"+responses[idx].path_photo+"' /></td>";
								tab+="<td>"+responses[idx].catName+"</td>";
								tab+="<td>"+responses[idx].attName+" - "+responses[idx].attr_value+"</td>";
								tab+="<td>"+responses[idx].quantity+"</td>";
								tab+="<td>"+toRp(responses[idx].priceNow)+"</td>";
								tab+="<td>"+toRp((responses[idx].priceNow * responses[idx].quantity))+"</td>";
								tab+="</tr>";
								idx = idx+1;
							});
							$('.isiTab').html(tab);
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