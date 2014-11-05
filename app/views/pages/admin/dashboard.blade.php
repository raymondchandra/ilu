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
									@if($hasil2 != null)
										@foreach($hasil2 as $key)
											<tr>
												<td>
													<input type="hidden" id = "idProd" value="{{$key->idProd}}" />
													<a class="detailButtonInfo" data-toggle="modal" data-target=".pop_up_edit_product" href="javascript:void(0)">
														{{$key->product_name}}
													</a>
												</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td>
												Not Found
											</td>
										</tr>
									@endif
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
						   					Nama Orang
						   				</th>
						   			</tr>
						   		</thead>
						   		<tbody>
									@if($hasil3 != null)
										@foreach($hasil3 as $key)
											<tr>
												<td>
													<input type="hidden" id = "idProf" value="{{$key->account_id}}" />
													<a id="profilebutton" href="javascript:void(0)" data-toggle="modal" data-target=".pop_up_view_customer"> 
														{{$key->account_name}}
													</a>
												</td>
											</tr>
										@endforeach
									@else
										<tr>
											<td>
												Not Found
											</td>
										</tr>
									@endif
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
	@include('pages.admin.pop_up_view_customer')
	@include('pages.admin.pop_up_edit_product')
	<script>
		//detail customer
		$('body').on('click','#profilebutton',function(){
		$id = $(this).prev().val();
		$nama = $('#profilebutton').html();
		$('.title1').html("Data Customer Dari " + $nama);
		$('#custName').html("");
		$('#custProfileName').html("");
		$('#custMemberID').html("");
		$('#custKTP').html("");
		$('#custEmail').html("");
		$('#custBirthDate').html("");
		$('#custCompany').html("");
		$('#custCompanyAddress').html("");
		$('#custCompanyAddress').html("");
		$('#custMemberDate').html("");
		$('#something_hidden').val($id);
		$('#voucher_list').html("");
		$.ajax({
				type: 'GET',
				url: '{{URL::route('david.getProfDet')}}',
				data: {	
					"id": $id
				},
				success: function(response){
					if(response['code'] == '404')
					{
						//$('#belanjaHistoryContent').append("<td>transaction history tidak ditemukan</td>");
						alert('failed');
					}
					else
					{
						$('#custName').html(response['messages'].full_name);
						$('#custProfileName').html(response['messages'].name_in_profile);
						$('#custMemberID').html(response['messages'].member_id);
						$('#custKTP').html(response['messages'].no_ktp);
						$('#custEmail').html(response['messages'].email);
						$('#custBirthDate').html(response['messages'].dob);
						$('#custCompany').html(response['messages'].company_name);
						$('#custCompanyAddress').html(response['messages'].company_address);
						$('#custCompanyAddress').html(response['messages'].company_address);
						$('#custMemberDate').html(response['messages'].created_at);
						//ajax buat voucher
						
						$.ajax({
							type: 'GET',
							url: '{{URL::route('david.getVoucherList')}}',
							data: {	
								"acc_id": $id
							},
							success: function(response){
								if(response['code'] == '404')
								{
									$data = "<tr><td>Voucher List Not Found</td></tr>"
									$('#voucher_list').append($data);
								}
								else
								{
									
									$.each(response['messages'], function( i, resp ) {
										$data = "<tr><td>";
										$data = $data + resp.type + "</td><td>";
										$data = $data + "IDR " + resp.amount + "</td><td>";
										$data = $data + resp.code + "</td><td></tr>";
										$('#voucher_list').append($data);
									
									});
								}
							},error: function(xhr, textStatus, errorThrown){
								alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
								alert("responseText: "+xhr.responseText);
							}
						},'json');
						//end ajax buat voucher
					}
				},error: function(xhr, textStatus, errorThrown){
					alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
					alert("responseText: "+xhr.responseText);
				}
			},'json');
		});
		//detail product
		$('body').on('click', '.detailButtonInfo', function(){
			$id = $(this).prev().val();								
				//set value di pop up edit
				$.ajax({
					type: 'GET',
					url: "{{URL('admin/product')}}/"+$id,
					success: function(response){
						result = JSON.parse(response);
						if(result.code==200){
							$message = result.messages;
							//set value di pop up edit						
							$('#edit_id').text($message.id);
							$('#edit_product_no').text($message.product_no);
							$('#edit_name').text($message.name);
							$('#edit_description').text($message.description);
							$('#edit_category_id').text($message.category_name);						
							$('#edit_category_id_input').val($message.category_id);
							$('#edit_promotion_id').text($message.promotion_name);						
							$('#edit_promotion_id_input').val($message.promotion_id);
						}					
					},
					error: function(jqXHR, textStatus, errorThrown){
						alert(errorThrown);
					}
				},'json');
		});
	</script>
@stop