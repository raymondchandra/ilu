@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			
				<div class="s_title_n_control">
					<h3 style="float: left;">
						Manage Customer 
					</h3>
				</div>
				<span class="clearfix"></span>
				<hr></hr>
				
				<div>
					<ul class="pagination">
					  <li><a href="#">&laquo;</a></li>
					  <li><a href="#">1</a></li>
					  <li><a href="#">2</a></li>
					  <li><a href="#">3</a></li>
					  <li><a href="#">4</a></li>
					  <li><a href="#">5</a></li>
					  <li><a href="#">&raquo;</a></li>
					</ul>
					<table class="table table-striped table-hover ">
						<thead class="table-bordered">
							<tr>
								<th class="table-bordered">
									<a href="javascript:void(0)">Member ID</a>
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
									<a href="javascript:void(0)">Name in Profile</a>
									<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Email</a>
									<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered" width="480">
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
							@foreach($profiles as $profile)
							<tr> 
								
								<td id="member_id_{{$profile->acc_id}}">{{$profile->member_id}}</td>
								<td id="full_name_{{$profile->acc_id}}">{{$profile->full_name}}</td>
								<td id="profile_name_{{$profile->acc_id}}">{{$profile->name_in_profile}}</td>
								<td id="email_{{$profile->acc_id}}">{{$profile->email}}</td>
								
								<td>
									<input type="hidden" value="{{$profile->acc_id}}">
									<button class="btn btn-info btn-xs wishlistbutton" data-toggle="modal" data-target=".pop_up_view_wishlist">View Wishlist</button>
									<input type="hidden" value="{{$profile->acc_id}}">
									<button class="btn btn-info btn-xs searchbutton" data-toggle="modal" data-target=".pop_up_view_search">View History Search</button>
									<input type="hidden" value="{{$profile->acc_id}}">
									<button class="btn btn-info btn-xs belanjabutton" data-toggle="modal" data-target=".pop_up_view_belanja">View History Belanja</button>
									<input type="hidden" value="{{$profile->acc_id}}">
									<button class="btn btn-info btn-xs profilebutton" data-toggle="modal" data-target=".pop_up_view_customer">View Profile</button>
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
	@include('pages.admin.customer.pop_up_view_customer')
	@include('pages.admin.customer.pop_up_view_wishlist')
	@include('pages.admin.customer.pop_up_view_search')
	@include('pages.admin.customer.pop_up_view_belanja')
	
	<script>
		$('body').on('click','.wishlistbutton',function(){
			$acc_id = $(this).prev().val();
			$nama = $('#full_name_'+$acc_id).html();
			$('.modal-title').html("Wishlist dari " + $nama);
			$('#wishlistcontent').empty();
			$.ajax({
					type: 'GET',
					url: '{{URL::route('david.getWishlist')}}',
					data: {	
						"acc_id": $acc_id
					},
					success: function(response){
						if(response['code'] == '404')
						{
							alert("asd");
							$('#wishlistcontent').append("<td>wishlist tidak ditemukan</td>");
						}
						else
						{
							alert("def");
							$.each(response, function( i, resp ) {
								$data = "<tr><td>";
								$data = $data + "243TYF876</td><td>";
								$data = $data + "The Epic Bag</td><td>";
								$data = $data + "31 January 2014</td><td></tr>";
								$('#wishlistcontent').append("<td>asd</td>");
							});
						}
					},error: function(xhr, textStatus, errorThrown){
						alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
						alert("responseText: "+xhr.responseText);
					}
				},'json');
		});
		//------end of script buat wishlist
		$('body').on('click','.searchbutton',function(){
			$acc_id = $(this).prev().val();
			alert($acc_id);
		});
		//------end of script buat search
		$('body').on('click','.belanjabutton',function(){
			$acc_id = $(this).prev().val();
			alert($acc_id);
		});
		//------end of script buat belanja
		$('body').on('click','.profilebutton',function(){
			$acc_id = $(this).prev().val();
			alert($acc_id);
		});
		//------end of script buat profile
	</script>

@stop