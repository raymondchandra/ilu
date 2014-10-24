@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			
			<div class="s_title_n_control">
				<h3 style="float: left;">
					Manage Shipping Agent
				</h3>
				<a href="{{ URL::to('test/manage_shipping') }}" class="btn btn-info" style="float: right; margin-top: 20px;margin-left: 10px;" >Manage Shipping</a>
				<a href="{{ URL::to('test/manage_shipping_agent') }}" class="btn btn-default" style="float: right; margin-top: 20px;margin-left: 10px;" >Manage Shipping Agent</a>
			</div>
			<span class="clearfix"></span>
			<hr></hr>

			<div>
				{{$hasil->links()}}
				<button class="btn btn-success" style="float: right; margin-top: 20px;"  data-toggle="modal" data-target=".pop_up_add_shipping_agent">+ Add New Kurir</button>

				<table class="table table-striped table-hover ">
					<thead class="table-bordered">
						<tr>
							<th class="table-bordered">
								<a href="javascript:void(0)">ID Kurir</a>
								<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
								</a>
							</th>
							<th class="table-bordered" width="120">
								<a href="javascript:void(0)">Nama Kurir</a>
								<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
								</a>
							</th>
							<th class="table-bordered">
								<a href="javascript:void(0)">Destinasi</a>
								<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
								</a>
							</th>
							<th class="table-bordered">
								<a href="javascript:void(0)">Price</a>
								<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
								</a>
							</th>
							<th class="table-bordered">

							</th>
						</thead>
						<thead>
							<tr>
								<td><input type="text" class="form-control input-sm"></td>
								<td><input type="text" class="form-control input-sm"></td>
								<td><input type="text" class="form-control input-sm"></td>
								<td><input type="text" class="form-control input-sm"></td>
								
								<td width=""><a class="btn btn-primary btn-xs">Filter</a></td>
							</tr>
						</thead>
						<tbody>
							@foreach($hasil as $key)
								<tr> 
									<td>{{$key->id}}</td>
									<td>{{$key->courier}}</td>
									<td>{{$key->destination}}</td>
									<td>{{$key->price}}</td>

									<td>
										<input type="hidden" value="{{$key->id}}">
										<button class="btn btn-info btn-xs viewShippingAgent" data-toggle="modal" data-target=".pop_up_view_shipping_agent">View</button>
										<!-- Button trigger modal class ".alertYesNo" -->
										<button class="btn btn-danger btn-xs" data-toggle="modal" data-target=".alertYesNo">Delete</button>
									</td>
								</tr>
							@endforeach
							
						</tbody>
					</table>
				</div>
				
			</div>
		</div>
	</div>
	
	@include('includes.modals.alertYesNo')
	@include('pages.admin.shipping.pop_up_view_shipping_agent')
	@include('pages.admin.shipping.pop_up_add_shipping_agent')

	<script>
		$('body').on('click','.viewShippingAgent',function(){
			$acc_id = $(this).prev().val();
			$('#idAgent').html("");
			$('#namaKurir').html("");
			$('#tujuan').html("");
			$('#dari').html("");
			$('#harga_pengiriman').html("");
			$.ajax({
					type: 'GET',
					url: '{{URL::route('jeffry.getDetailShipAgent')}}',
					data: {	
						"id": $acc_id
					},
					success: function(response){
						if(response['code'] == '404')
						{
							//$('#wishlistcontent').append("<td>agent tidak ditemukan</td>");
						}
						else
						{
							$('#idAgent').text(response['messages'].id);
							$('#namaKurir').text(response['messages'].courier);
							$('#tujuan').text(response['messages'].destination);
							$('#dari').text(response['messages'].destination);
							$('#harga_pengiriman').text(response['messages'].price);
							
						}
					},error: function(xhr, textStatus, errorThrown){
						alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
						alert("responseText: "+xhr.responseText);
					}
				},'json');
		});
		//create edit price
		$('body').on('click','.harga_pengiriman_setter',function(){
			$harga = $('#harga_pengiriman_input').val();
			$id = $('#idAgent').val();
			$.ajax({
					type: 'PUT',
					url: '{{URL::route('jeffry.putPriceShipAgent')}}',
					data: {	
						"price": $harga,
						"id": $id
					},
					success: function(response){
						if(response['code'] == '404')
						{
							//$('#wishlistcontent').append("<td>agent tidak ditemukan</td>");
						}
						else
						{
							
							
						}
					},error: function(xhr, textStatus, errorThrown){
						alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
						alert("responseText: "+xhr.responseText);
					}
				},'json');
		});
	</script>
	
	@stop