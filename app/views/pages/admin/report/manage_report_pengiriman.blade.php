@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			
			<div class="s_title_n_control">
				<h3 style="float: left;">
					Manage Report Pengiriman
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
						<li role="presentation" class="active pull-right"><a href="#3" role="tab" data-toggle="tab" style="">Laporan Pengiriman</a></li>
						<span class="clearfix "></span>
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
							<input type="radio" name="f_radio_pilih_laporan_pengiriman" id="" value="range"> By Range
						</label>
						<label class="radio-inline pull-right" style="margin-right: 20px; margin-top: 20px;">
							<input type="radio" name="f_radio_pilih_laporan_pengiriman" id="" value="one_month" checked> By Status
						</label>
						<div id="f_laporan_pengiriman_status">
							<form class="form-horizontal" role="form">
								<table class="table table-bordered">
									<thead>
										<tr>
											<th>
												Status
											</th>
											<th>
												Command 
											</th>
										</tr>
									</thead>
									<tbody class="f_laporan_pengiriman">
										<tr>
											<td>
												<select class="form-control">
													<option value="Cancel">Cancel</option>
													<option value="Pending">Pending</option>
													<option value="On-process">On-process</option>
													<option value="On-ship">On-ship</option>
													<option value="Complete">Complete</option>
												</select>
											</td>
											<td>
												<button type="button" class="btn btn-success">Show</button>
											</td>
										</tr>
									</tbody>
								</table>
							</form>		
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>
											Nama Penerima
										</th>
										<th>
											No. Transaksi
										</th>
										<th>
											No. Resi
										</th>
										<th>
											Kurir
										</th>
										<th>
											Asal
										</th>
										<th>
											Destinasi
										</th>
										<th>
											Tanggal Pengiriman
										</th>
									</tr>
								</thead>
								<tbody class="f_laporan_pengiriman_hasil">
									<tr data-toggle="modal" data-target=".pop_up_view_report_produk_detail">
										<td>
											Orang
										</td>
										<td>
											24234234252
										</td>
										<td>
											234fv2343v
										</td>
										<td>
											JNE
										</td>
										<td>
											Narnia, Antah Berantah
										</td>
										<td>
											Frankfurt, Germany
										</td>
										<td>
											11-11-2014
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div id="f_laporan_pengiriman_range" class="hidden">								
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
									<tbody class="f_laporan_pengiriman">
										<tr>
											<td>
												<input type='text' class="form-control"  id='datepicker00_laporan_pengiriman'/>
												<input type="hidden">
											</td>
											<td>
												<input type='text' class="form-control"  id='datepicker01_laporan_pengiriman'/>
												<input type="hidden">
											</td>
											<td>
												<button type="button" class="btn btn-success">
													Show
												</button>
											</td>
										</tr>
									</tbody>
									<script type="text/javascript">
									$(function () {
										$('#datepicker00_laporan_pengiriman').datepicker({
											format:"dd-MM-yyyy"

										});
										$('#datepicker01_laporan_pengiriman').datepicker({
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
											Nama
										</th>
										<th>
											No. Transaksi
										</th>
										<th>
											No. Resi
										</th>
										<th>
											Kurir
										</th>
										<th>
											Asal
										</th>
										<th>
											Destinasi
										</th>
										<th>
											Tanggal Pengiriman
										</th>
									</tr>
								</thead>
								<tbody class="f_laporan_pengiriman_hasil">
									<tr data-toggle="modal" data-target=".pop_up_view_report_produk_detail">
										<td>
											Orang
										</td>
										<td>
											24234234252
										</td>
										<td>
											234fv2343v
										</td>
										<td>
											JNE
										</td>
										<td>
											Narnia, Antah Berantah
										</td>
										<td>
											Frankfurt, Germany
										</td>
										<td>
											11-11-2014
										</td>
									</tr>
								</tbody>
							</table>		
						</div>
						<script>
						$('body').on('change', 'input:radio[name="f_radio_pilih_laporan_pengiriman"]', function() {

							if ($(this).is(':checked') && $(this).val() == 'one_month') {
								$('#f_laporan_pengiriman_range').addClass('hidden');
								$('#f_laporan_pengiriman_status').removeClass('hidden');
							}else{
								$('#f_laporan_pengiriman_range').removeClass('hidden');
								$('#f_laporan_pengiriman_status').addClass('hidden');
							}

						});
						</script>

						<!-- --------------------------------------------------------------------------------------------------------------------------------------------------------------- -->				
					</div>
						<!--
						<div role="tabpanel" class="tab-pane fade" id="4">					
						</div>
						<div role="tabpanel" class="tab-pane fade" id="5">				
						</div>
					-->
				</div>
			</div>
		</div>
	</div>

</div>
</div>
</div>

@include('includes.modals.alertYesNo')
@include('pages.admin.report.pop_up_view_report_pengiriman_detail')

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