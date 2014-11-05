@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			
			<div class="s_title_n_control">
				<h3 style="float: left;">
					Manage Shipping Agent
				</h3>
				<a href="{{ URL::to('test/manage_shipping_jeffry') }}" class="btn btn-info" style="float: right; margin-top: 20px;margin-left: 10px;" >Manage Shipping</a>
				<a href="{{ URL::to('test/manage_shipping_agent_jeffry') }}" class="btn btn-default" style="float: right; margin-top: 20px;margin-left: 10px;" >Manage Shipping Agent</a>
			</div>
			<span class="clearfix"></span>
			<hr></hr>

			<div>
				@if($hasil != null)
					@if($filtered == 0)
						{{$hasil->appends(array('sortBy' => $sortBy, 'order' => $sortType, 'filtered'=>$filtered))->links()}}
					@else
						<button class="btn btn-success backButton" style="float: left; margin-top: 20px; margin-left: 20px; margin-bottom: 20px" data-toggle="modal" data-target=".pop_up_add_attribute">Back</button>
					@endif
				<button class="btn btn-success" style="float: right; margin-top: 20px;"  data-toggle="modal" data-target=".pop_up_add_shipping_agent">+ Add New Kurir</button>
				<button class="btn btn-success" style="float: right; margin-top: 20px; margin-right: 10px;"  data-toggle="modal" data-target=".pop_up_import_shipping_agent">+ Import</button>

				<table class="table table-striped table-hover ">
					<thead class="table-bordered">
						<tr>
							<th class="table-bordered">
								<a href="javascript:void(0)">ID Kurir</a>
								@if($filtered == 0)
									@if($sortBy == "id")
										@if($sortType == "asc")
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'id', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
										@else
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'id', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
										@endif
									@else
										<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'id', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
									@endif	
								@else
									@if($sortBy == "id")
										@if($sortType == "asc")
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'id', 'order' => 'desc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
										@else
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'id', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
										@endif
									@else
										<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'id', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
									@endif
								@endif
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
								</a>
							</th>
							<th class="table-bordered" width="120">
								<a href="javascript:void(0)">Nama Kurir</a>
								@if($filtered == 0)
									@if($sortBy == "courier")
										@if($sortType == "asc")
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'courier', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
										@else
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'courier', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
										@endif
									@else
										<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'courier', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
									@endif	
								@else
									@if($sortBy == "courier")
										@if($sortType == "asc")
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'courier', 'order' => 'desc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
										@else
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'courier', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
										@endif
									@else
										<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'courier', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
									@endif
								@endif
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
								</a>
							</th>
							<th class="table-bordered">
								<a href="javascript:void(0)">Destinasi</a>
								@if($filtered == 0)
									@if($sortBy == "destination")
										@if($sortType == "asc")
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'destination', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
										@else
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'destination', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
										@endif
									@else
										<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'destination', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
									@endif	
								@else
									@if($sortBy == "destination")
										@if($sortType == "asc")
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'destination', 'order' => 'desc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
										@else
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'destination', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
										@endif
									@else
										<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'destination', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
									@endif
								@endif
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
								</a>
							</th>
							<th class="table-bordered">
								<a href="javascript:void(0)">Price</a>
								@if($filtered == 0)
									@if($sortBy == "price")
										@if($sortType == "asc")
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'price', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
										@else
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'price', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
										@endif
									@else
										<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'price', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
									@endif	
								@else
									@if($sortBy == "price")
										@if($sortType == "asc")
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'price', 'order' => 'desc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
										@else
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'price', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
										@endif
									@else
										<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'price', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
									@endif
								@endif
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
								</a>
							</th>
							<th class="table-bordered">

							</th>
						</thead>
						<thead>
							<tr>
								<td><input type="text" class="form-control input-sm idFilter"></td>
								<td><input type="text" class="form-control input-sm courierFilter"></td>
								<td><input type="text" class="form-control input-sm destinationFilter"></td>
								<td><input type="text" class="form-control input-sm priceFilter"></td>
								
								<td width=""><a class="btn btn-primary btn-xs filterButton">Filter</a></td>
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
										<input type="hidden" value="{{$key->id}}" id="shipAgtId">
										<button class="btn btn-info btn-xs viewShippingAgent" data-toggle="modal" data-target=".pop_up_view_shipping_agent">View</button>
										<!-- Button trigger modal class ".alertYesNo" -->
										<button class="btn btn-danger btn-xs deleteShippingAgent" data-toggle="modal" data-target=".pop_up_alert">Delete</button>
									</td>
								</tr>
							@endforeach
							
						</tbody>
					</table>
				</div>
			@elseif($hasil == null)
				@if($filtered == 0)
					Not found
				@elseif($filtered == 1)
					<button class="btn btn-success backButton" style="float: left; margin-top: 20px; margin-left: 20px; margin-bottom: 20px" data-toggle="modal" data-target=".pop_up_add_attribute">Back</button>
					<table class="table table-striped table-hover ">
					<thead class="table-bordered">
						<tr>
							<th class="table-bordered">
								<a href="javascript:void(0)">ID Kurir</a>
								@if($filtered == 0)
									@if($sortBy == "id")
										@if($sortType == "asc")
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'id', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
										@else
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'id', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
										@endif
									@else
										<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'id', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
									@endif	
								@else
									@if($sortBy == "id")
										@if($sortType == "asc")
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'id', 'order' => 'desc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
										@else
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'id', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
										@endif
									@else
										<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'id', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
									@endif
								@endif
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
								</a>
							</th>
							<th class="table-bordered" width="120">
								<a href="javascript:void(0)">Nama Kurir</a>
								@if($filtered == 0)
									@if($sortBy == "courier")
										@if($sortType == "asc")
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'courier', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
										@else
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'courier', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
										@endif
									@else
										<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'courier', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
									@endif	
								@else
									@if($sortBy == "courier")
										@if($sortType == "asc")
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'courier', 'order' => 'desc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
										@else
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'courier', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
										@endif
									@else
										<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'courier', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
									@endif
								@endif
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
								</a>
							</th>
							<th class="table-bordered">
								<a href="javascript:void(0)">Destinasi</a>
								@if($filtered == 0)
									@if($sortBy == "destination")
										@if($sortType == "asc")
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'destination', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
										@else
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'destination', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
										@endif
									@else
										<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'destination', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
									@endif	
								@else
									@if($sortBy == "destination")
										@if($sortType == "asc")
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'destination', 'order' => 'desc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
										@else
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'destination', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
										@endif
									@else
										<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'destination', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
									@endif
								@endif
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
								</a>
							</th>
							<th class="table-bordered">
								<a href="javascript:void(0)">Price</a>
								@if($filtered == 0)
									@if($sortBy == "price")
										@if($sortType == "asc")
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'price', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
										@else
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'price', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
										@endif
									@else
										<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'price', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
									@endif	
								@else
									@if($sortBy == "price")
										@if($sortType == "asc")
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'price', 'order' => 'desc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
										@else
											<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'price', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
										@endif
									@else
										<a href="{{action('ShippingAgentManagementController@view_shipping_agent_mgmt', array('sortBy' => 'price', 'order' => 'asc', 'filtered'=>  $filtered, 'id'=>$id, 'courier'=>$courier, 'destination'=>$destination, 'price'=>$price))}}">
									@endif
								@endif
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
								</a>
							</th>
							<th class="table-bordered">

							</th>
						</thead>
						<thead>
							<tr>
								<td><input type="text" class="form-control input-sm idFilter"></td>
								<td><input type="text" class="form-control input-sm courierFilter"></td>
								<td><input type="text" class="form-control input-sm destinationFilter"></td>
								<td><input type="text" class="form-control input-sm priceFilter"></td>
								
								<td width=""><a class="btn btn-primary btn-xs filterButton">Filter</a></td>
							</tr>
						</thead>
						<tbody>
							
								<tr> 
									<td colspan="5">Not Found</td>
									
									</td>
								</tr>
							
						</tbody>
					</table>
				@endif
			@endif
			</div>
		</div>
	</div>
	
	@include('pages.admin.shipping.pop_up_alert')
	@include('pages.admin.shipping.pop_up_view_shipping_agent')
	@include('pages.admin.shipping.pop_up_add_shipping_agent')
	@include('pages.admin.shipping.pop_up_import_shipping_agent')

	<script>
		//filter button
		$('body').on('click','.filterButton',function(){
			$id = $('.idFilter').val();
			
			$courier = $('.courierFilter').val();
			$destination = $('.destinationFilter').val();
			$price = $('.priceFilter').val();
			window.location = "{{URL::route('jeffry.getShippingAgent')}}" + "?filtered=1&id="+$id+"&courier="+$courier+"&destination="+$destination+"&price="+$price;
		});
		$('body').on('click','.backButton',function(){
			window.location = "{{URL::route('jeffry.getShippingAgent')}}" ;
		});
		//view button
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
		$('body').on('click','#harga_pengiriman_setter',function(){
			$harga = $('#harga_pengiriman_input').val();
			$id = $('#idAgent').text();
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
							alert('failed');
							location.reload();
						}
						else
						{
							
							alert('success');
							location.reload();
						}
					},error: function(xhr, textStatus, errorThrown){
						alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
						alert("responseText: "+xhr.responseText);
					}
				},'json');
		});
		//delete shipment agent
		$('body').on('click','.butDel',function(){
			$id = $('#shipAgtId').val();
			$.ajax({
					type: 'DELETE',
					url: '{{URL::route('jeffry.deleteShipmentAgent')}}',
					data: {	
						"id": $id
					},
					success: function(response){
						if(response['code'] == '404')
						{
							//$('#wishlistcontent').append("<td>agent tidak ditemukan</td>");
							alert('failed');
							location.reload();
						}
						else
						{
							
							alert('success');
							location.reload();
						}
					},error: function(xhr, textStatus, errorThrown){
						alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
						alert("responseText: "+xhr.responseText);
					}
				},'json');
		});
		//add shipment agent
		$('body').on('click','.addShippingAgent',function(){
			$courier = $('#courier').val();
			$destination = $('#destination').val();
			$price = $('#price').val();
			$.ajax({
					type: 'POST',
					url: '{{URL::route('jeffry.addShipmentAgent')}}',
					data: {	
						"courier": $courier,
						"destination" : $destination,
						"price" : $price,
						"deleted" : '0'
					},
					success: function(response){
						if(response['code'] != '201')
						{
							//$('#wishlistcontent').append("<td>agent tidak ditemukan</td>");
							alert('failed');
							location.reload();
						}
						else
						{
							alert('success');
							location.reload();
						}
					},error: function(xhr, textStatus, errorThrown){
						alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
						alert("responseText: "+xhr.responseText);
					}
				},'json');
		});
		//add shipment agent excel
		$('body').on('click','.addShippingAgentExcel',function(){
			$fileEx = $('#fileExl').val();
			$.ajax({
					type: 'POST',
					url: '{{URL::route('jeffry.addShipmentAgentExcel')}}',
					data: {	
						"fileExl": $fileEx
					},
					success: function(response){
						if(response['code'] != '201')
						{
							//$('#wishlistcontent').append("<td>agent tidak ditemukan</td>");
							alert('failed');
							location.reload();
						}
						else
						{
							alert('success');
							location.reload();
						}
					},error: function(xhr, textStatus, errorThrown){
						alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
						alert("responseText: "+xhr.responseText);
					}
				},'json');
		});
	</script>
	
	@stop