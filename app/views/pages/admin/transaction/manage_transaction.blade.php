@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			
				<div class="s_title_n_control">
					<h3 style="float: left;">
						Manage Transaction
					</h3>
				</div>
				<span class="clearfix"></span>
				<hr></hr>
				
				<div>
						{{$hasil->links()}}
					<table class="table table-striped table-hover ">
						<thead class="table-bordered">
							<tr>
								<th class="table-bordered">
									<a href="javascript:void(0)">Invoice</a>
									<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Account ID</a>
									<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Full Name</a>
									<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Total Price</a>
									<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Status</a>
									<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Paid</a>
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
								<td><input type="text" class="form-control input-sm"></td>
								<td><input type="text" class="form-control input-sm"></td>
								
								<td width=""><a class="btn btn-primary btn-xs">Filter</a></td>
							</tr>
						</thead>
						<tbody>
							@foreach($hasil as $key)
								<tr> 
								
									<td>{{$key->invoice}}</td>
									<td>{{$key->account_id}}</td>
									<td>{{$key->full_name}}</td>
									<td>{{$key->total_price}}</td>
									<td>{{$key->status}}</td>
									<td>@if($key->paid == 0)
									UnPaid
									@else
									Paid
									@endif</td>
								
									<td>
										<input type="hidden" value="{{$key->id}}">
										<button class="btn btn-info btn-xs viewTransactionDetail" data-toggle="modal" data-target=".pop_up_view_transaction">View</button>
										<!-- Button trigger modal class ".alertYesNo" -->
										<!-- <button class="btn btn-danger btn-xs" data-toggle="modal" data-target=".alertYesNo">Delete</button> -->
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
	@include('pages.admin.transaction.pop_up_view_transaction')

	<script>
		$('body').on('click','.viewTransactionDetail',function(){
			$trans_id = $(this).prev().val();
			$('#invoice').html("");
			$('#price').html("");
			$('#voucher').html("");
			$('#transaction_status').html("");
			$('#transaction_paid').html("");
			$('#idShipment').html("");
			$('#courier').html("");
			$('#destinasi').html("");
			$('#full_name').html("");
			$('#prof_name').html("");
			$('#memberId').html("");
			$('#noKtp').html("");
			$('#email').html("");
			$('#ttl').html("");
			$('#comName').html("");
			$('#comAdd').html("");
			$('#MemberSince').html("");
			$('#idTrans').html("");
			$.ajax({
					type: 'GET',
					url: '{{URL::route('jeffry.getDetailTransaction')}}',
					data: {	
						"id": $trans_id
					},
					success: function(response){
						if(response['code'] == '404')
						{
							alert('failed');
						}
						else
						{
							$('#invoice').text(response['messages']['0'].invoice);
							$('#price').text(response['messages']['0'].total_price);
							$('#voucher').text(response['messages']['0'].voucher_id);
							$('#transaction_status').text(response['messages']['0'].status);
							if(response['messages']['0'].paid == '0')
							{
								$('#transaction_paid').text('UnPaid');
							}
							else
							{
								$('#transaction_paid').text('Paid');
							}
							$('#idShipment').text(response['messages']['0'].shipment['0'].number);
							$('#courier').text(response['messages']['0'].shipment['0'].courier);
							$('#destinasi').text(response['messages']['0'].shipment['0'].destination);
							$('#full_name').text(response['messages']['0'].profile.full_name);
							$('#prof_name').text(response['messages']['0'].profile.name_in_profile);
							$('#memberId').text(response['messages']['0'].profile.member_id);
							$('#noKtp').text(response['messages']['0'].profile.no_ktp);
							$('#email').text(response['messages']['0'].profile.email);
							$('#ttl').text(response['messages']['0'].profile.dob);
							$('#comName').text(response['messages']['0'].profile.company_name);
							$('#comAdd').text(response['messages']['0'].profile.company_address);
							$('#MemberSince').text((response['messages']['0'].profile.created_at).split(" ",1));
							$('#idTrans').val(response['messages']['0'].id);
						}
					},error: function(xhr, textStatus, errorThrown){
						alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
						alert("responseText: "+xhr.responseText);
					}
				},'json');
		});
		//create edit status
		$('body').on('click','#transaction_status_setter',function(){
			$statusBaru = $('#transaction_status_list').val();
			$id = $('#idTrans').val();
			$.ajax({
					type: 'PUT',
					url: '{{URL::route('jeffry.putStatusTransaction')}}',
					data: {	
						"id": $id,
						"status" : $statusBaru
					},
					success: function(response){
						if(response['code'] == '404')
						{
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
		//create edit paid
		$('body').on('click','#transaction_paid_setter',function(){
			$paidBaru = $('#transaction_paid_list').val();
			$id = $('#idTrans').val();
			$.ajax({
					type: 'PUT',
					url: '{{URL::route('jeffry.putPaidTransaction')}}',
					data: {	
						"id": $id,
						"paid" : $paidBaru
					},
					success: function(response){
						if(response['code'] == '404')
						{
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