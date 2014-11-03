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

				@if($profiles != null)
				<div>
					@if($filtered == 0)
					
						{{$profiles->appends(array('sortBy' => $sortBy, 'order' => $sortType, 'filtered'=>$filtered))->links()}}
					@else
						<button class="btn btn-success backButton" style="float: left; margin-top: 20px; margin-left: 20px; margin-bottom: 20px" data-toggle="modal" data-target=".pop_up_add_attribute">Back</button>
					@endif
					<table class="table table-striped table-hover table-condensed table-bordered">
						<thead class="table-bordered">
							<tr>
								<th class="table-bordered">
									<a href="javascript:void(0)">Member ID</a>
									@if($filtered == 0)
									
										@if($sortBy == "member_id")
											@if($sortType == "asc")
												<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'member_id', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
											@else
												<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'member_id', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
											@endif
										@else
											<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'member_id', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
										@endif
									@else
										@if($sortBy == "member_id")
											@if($sortType == "asc")
												<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'member_id', 'order' => 'desc', 'filtered'=>  $filtered, 'memberId'=>$memberId, 'namaFull'=>$fullName, 'namaProfile'=>$profileName, 'email'=>$email))}}">
											@else
												<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'member_id', 'order' => 'asc', 'filtered'=>  $filtered, 'memberId'=>$memberId, 'namaFull'=>$fullName, 'namaProfile'=>$profileName, 'email'=>$email))}}">
											@endif
										@else
											<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'member_id', 'order' => 'asc', 'filtered'=>  $filtered, 'memberId'=>$memberId, 'namaFull'=>$fullName, 'namaProfile'=>$profileName, 'email'=>$email))}}">
										@endif
									@endif
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
										</a>
									</th>
									<th class="table-bordered">
										<a href="javascript:void(0)">Full Name</a>
										@if($filtered == 0)
											@if($sortBy == "full_name")
												@if($sortType == "asc")
													<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'full_name', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@else
													<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'full_name', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@endif
											@else
												<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'full_name', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
											@endif
										@else
											@if($sortBy == "full_name")
												@if($sortType == "asc")
													<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'full_name', 'order' => 'desc', 'filtered'=>  $filtered, 'memberId'=>$memberId, 'namaFull'=>$fullName, 'namaProfile'=>$profileName, 'email'=>$email))}}">
												@else
													<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'full_name', 'order' => 'asc', 'filtered'=>  $filtered, 'memberId'=>$memberId, 'namaFull'=>$fullName, 'namaProfile'=>$profileName, 'email'=>$email))}}">
												@endif
											@else
												<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'full_name', 'order' => 'asc', 'filtered'=>  $filtered, 'memberId'=>$memberId, 'namaFull'=>$fullName, 'namaProfile'=>$profileName, 'email'=>$email))}}">
											@endif
										@endif
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
										</a>
									</th>
									<th class="table-bordered">
										<a href="javascript:void(0)">Name in Profile</a>
										@if($filtered == 0)
											@if($sortBy == "name_in_profile")
												@if($sortType == "asc")
													<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'name_in_profile', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@else
													<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'name_in_profile', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@endif
											@else
												<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'name_in_profile', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
											@endif
										@else
											@if($sortBy == "name_in_profile")
												@if($sortType == "asc")
													<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'name_in_profile', 'order' => 'desc', 'filtered'=>  $filtered, 'memberId'=>$memberId, 'namaFull'=>$fullName, 'namaProfile'=>$profileName, 'email'=>$email))}}">
												@else
													<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'name_in_profile', 'order' => 'asc', 'filtered'=>  $filtered, 'memberId'=>$memberId, 'namaFull'=>$fullName, 'namaProfile'=>$profileName, 'email'=>$email))}}">
												@endif
											@else
												<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'name_in_profile', 'order' => 'asc', 'filtered'=>  $filtered, 'memberId'=>$memberId, 'namaFull'=>$fullName, 'namaProfile'=>$profileName, 'email'=>$email))}}">
											@endif
										@endif
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
										</a>
									</th>
									<th class="table-bordered">
										<a href="javascript:void(0)">Email</a>
										@if($filtered == 0)
											@if($sortBy == "email")
												@if($sortType == "asc")
													<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'email', 'order' => 'desc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@else
													<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'email', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
												@endif
											@else
												<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'email', 'order' => 'asc', 'page'=>  $page, 'filtered'=>'0'))}}">
											@endif
										@else
											@if($sortBy == "email")
												@if($sortType == "asc")
													<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'email', 'order' => 'desc', 'filtered'=>  $filtered, 'memberId'=>$memberId, 'namaFull'=>$fullName, 'namaProfile'=>$profileName, 'email'=>$email))}}">
												@else
													<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'email', 'order' => 'asc', 'filtered'=>  $filtered, 'memberId'=>$memberId, 'namaFull'=>$fullName, 'namaProfile'=>$profileName, 'email'=>$email))}}">
												@endif
											@else
												<a href="{{action('CustomerManagementController@view_cust_mgmt', array('sortBy' => 'email', 'order' => 'asc', 'filtered'=>  $filtered, 'memberId'=>$memberId, 'namaFull'=>$fullName, 'namaProfile'=>$profileName, 'email'=>$email))}}">
											@endif
										@endif
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
										</a>
									</th>
									<th class="table-bordered" width="480">
									</th>
							</thead>
							<thead>
								<tr>
									<td><input type="text" class="form-control input-sm filterMemberID"></td>
									<td><input type="text" class="form-control input-sm filterFullName"></td>
									<td><input type="text" class="form-control input-sm filterProfileName"></td>
									<td><input type="text" class="form-control input-sm filterEmail"></td>
									
									<td width=""><a class="btn btn-primary btn-xs filterButton">Filter</a></td>
								</tr>
							</thead>
							<tbody class="customerManagementContent">
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
										<input type="hidden" value="{{$profile->id}}">
										<button class="btn btn-info btn-xs profilebutton" data-toggle="modal" data-target=".pop_up_view_customer">View Profile</button>
										<!-- Button trigger modal class ".alertYesNo" -->
										<!-- <button class="btn btn-danger btn-xs" data-toggle="modal" data-target=".alertYesNo">Delete</button> -->
									</td>
								</tr> 
								@endforeach		
							</tbody>
						</table>
					</div>
				@else
					<div>
						<p>Nothing to show</p>
					</div>
				@endif
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
							$('#wishlistcontent').append("<tr><td>wishlist tidak ditemukan</td></tr>");
						}
						else
						{
							$.each(response['messages'], function( i, resp ) {
								$data = "<tr><td>";
								$data = $data + resp.productNumber + "</td><td>";
								$data = $data + resp.productName + "</td><td>";
								$data = $data + resp.created_at + "</td><td></tr>";
								$('#wishlistcontent').append($data);
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
			$nama = $('#full_name_'+$acc_id).html();
			$('.modal-title').html("Search history dari " + $nama);
			
			$('#searchHistorycontent').empty();
			$.ajax({
					type: 'GET',
					url: '{{URL::route('david.getSearchHistory')}}',
					data: {	
						"acc_id": $acc_id
					},
					success: function(response){
						if(response['code'] == '404')
						{
							$('#searchHistorycontent').append("<tr><td>search history tidak ditemukan</td></tr>");
						}
						else
						{
							$.each(response['messages'], function( i, resp ) {
								$data = "<tr><td>";
								$data = $data + resp.description + "</td><td>";
								//$data = $data + resp.productName + "</td><td>";
								$data = $data + resp.created_at + "</td><td></tr>";
								$('#searchHistorycontent').append($data);
							});
						}
					},error: function(xhr, textStatus, errorThrown){
						alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
						alert("responseText: "+xhr.responseText);
					}
				},'json');
		});
		//------end of script buat search
		$('body').on('click','.belanjabutton',function(){
			$acc_id = $(this).prev().val();
			$nama = $('#full_name_'+$acc_id).html();
			$('.modal-title').html("Transaction history dari " + $nama);
			
			$('#belanjaHistoryContent').empty();
			$.ajax({
					type: 'GET',
					url: '{{URL::route('david.getTransHistory')}}',
					data: {	
						"acc_id": $acc_id
					},
					success: function(response){
						if(response['code'] == '404')
						{
							$('#belanjaHistoryContent').append("<tr><td>transaction history tidak ditemukan</td></tr>");
						}
						else
						{
							$.each(response['messages'], function( i, resp ) {
								$data = "<tr><td>";
								$data = $data + resp.id + "</td><td>";
								$data = $data + resp.total_price + "</td><td>";
								$data = $data + resp.created_at + "</td><td></tr>";
								$('#belanjaHistoryContent').append($data);
							});
						}
					},error: function(xhr, textStatus, errorThrown){
						alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
						alert("responseText: "+xhr.responseText);
					}
				},'json');
		});
		//------end of script buat belanja
		$('body').on('click','.profilebutton',function(){
			$id = $(this).prev().val();
			$nama = $('#full_name_'+$id).html();
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
		//------end of script buat profile
		$('body').on('click','.filterButton',function(){
			$id = $('.filterMemberID').val();
			$namaFull = $('.filterFullName').val();
			$namaProfile = $('.filterProfileName').val();
			$email = $('.filterEmail').val();
			window.location = "{{URL::route('david.viewCustomerManagement')}}" + "?filtered=1&memberId="+$id+"&namaFull="+$namaFull+"&namaProfile="+$namaProfile+"&email="+$email;
		});
		$('body').on('click','.backButton',function(){
			window.location = "{{URL::route('david.viewCustomerManagement')}}" ;
		});
		//--------end of script buat back button
		$('body').on('click','.tambah_voucher_button',function(){
			$.ajax({
					type: 'GET',
					url: '{{URL::route('david.getNewVoucherCode')}}',
					data: {	
					},
					success: function(response){
						if(response['code'] == '404')
						{
							//$('#belanjaHistoryContent').append("<td>transaction history tidak ditemukan</td>");
							alert('failed');
						}
						else
						{
							//new_kode_voucher
							$('#new_kode_voucher').html(response['messages']);
						}
					},error: function(xhr, textStatus, errorThrown){
						alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
						alert("responseText: "+xhr.responseText);
					}
				},'json');
		});
		//--------end of script buat generate kode vcr
		$('body').on('click','.submit_voucher',function(){
			$type = $('#new_type_voucher').val();
			$amount = $('#new_amount_voucher').val();
			$code = $('#new_kode_voucher').text();
			$acc_id = $('#something_hidden').val();
			
			$.ajax({
					type: 'POST',
					url: '{{URL::route('david.postNewVoucher')}}',
					data: {
					'type' : $type,
					'amount' : $amount,
					'account_id' : $acc_id,
					'code' : $code
					},
					success: function(response){
						if(response['code'] == '400')
						{
							//$('#belanjaHistoryContent').append("<td>transaction history tidak ditemukan</td>");
							alert('failed');
						}
						else if(response['code'] == '500')
						{
							alert('failed');
						}
						else
						{
							if($('#voucher_list').html() == "<tr><td>Voucher List Not Found</td></tr>")
							{
								$('#voucher_list').html("");
							}
							alert("success");
							$data = "<tr><td>";
							$data = $data + $type + "</td><td>";
							$data = $data + "IDR " + $amount + "</td><td>";
							$data = $data + $code + "</td><td></tr>";
							$('#voucher_list').append($data);
						}
					},error: function(xhr, textStatus, errorThrown){
						alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
						alert("responseText: "+xhr.responseText);
					}
				},'json');			
		});
	</script>

@stop