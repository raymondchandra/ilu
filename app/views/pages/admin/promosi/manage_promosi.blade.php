@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
<script>
	var text;
	var temp_json_data;
	
	//temp insert
	var temp_id;
	var temp_name;
	var temp_price;
	var temp_photo;
		
	//list_insert product
	var arr_id = new Array();
</script>

	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			
				<div class="s_title_n_control">
					<h3 style="float: left;">
						Manage Promosi
					</h3>
				</div>
				<span class="clearfix"></span>
				<hr></hr>
				
				<div>
					@if($promotions == null)
						@if($filtered == 0)
							<button class="btn btn-success showAddPopUp" style="float: right; margin-top: 20px;"  data-toggle="modal" data-target=".pop_up_add_promosi">+ Add New Promosi</button>
							<p>No Promotions</p>
						@else
							<button class="btn btn-success backButton" style="float: right; margin-top: 20px; margin-bottom: 25px;">Back</button>
							<p>Search not match anything</p>
							
							
							
						@endif
					@else
						@if($filtered == 0)
							{{$promotions->appends(array('sortBy' => $sortBy, 'order' => $sortType, 'filtered' => $filtered))->links()}}
							<button class="btn btn-success showAddPopUp" style="float: right; margin-top: 20px;"  data-toggle="modal" data-target=".pop_up_add_promosi">+ Add New Promosi</button>
						@else
							<button class="btn btn-success backButton" style="float: right; margin-top: 20px; margin-bottom: 25px;">Back</button>
						@endif
						<table class="table table-striped table-hover table-condensed table-bordered">
							<thead class="table-bordered">
								<tr>
									<th class="table-bordered">
										<a href="javascript:void(0)">Nama</a>
										@if($filtered == 0)
											@if($sortBy == "name")
												@if($sortType == "asc")
													<a href="{{action('PromotionsManagementController@view_admin_promotion', array('sortBy' => 'name', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
												@else
													<a href="{{action('PromotionsManagementController@view_admin_promotion', array('sortBy' => 'name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
												@endif
											@else
												<a href="{{action('PromotionsManagementController@view_admin_promotion', array('sortBy' => 'name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
											@endif	
										@else
											@if($sortBy == "name")
												@if($sortType == "asc")
													<a href="{{action('PromotionsManagementController@view_admin_promotion', array('sortBy' => 'name', 'order' => 'desc', 'filtered' => $filtered, 'name' => $name, 'amount' => $amount))}}">
												@else
													<a href="{{action('PromotionsManagementController@view_admin_promotion', array('sortBy' => 'name', 'order' => 'asc', 'filtered' => $filtered, 'name' => $name, 'amount' => $amount))}}">
												@endif
											@else
												<a href="{{action('PromotionsManagementController@view_admin_promotion', array('sortBy' => 'name', 'order' => 'asc', 'filtered' => $filtered, 'name' => $name, 'amount' => $amount))}}">
											@endif	
										@endif
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
										</a>
									</th>
									<th class="table-bordered">
										<a href="javascript:void(0)">Nilai Promosi</a>
										@if($filtered == 0)
											@if($sortBy == "amount")
												@if($sortType == "asc")
													<a href="{{action('PromotionsManagementController@view_admin_promotion', array('sortBy' => 'amount', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
												@else
													<a href="{{action('PromotionsManagementController@view_admin_promotion', array('sortBy' => 'amount', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
												@endif
											@else
												<a href="{{action('PromotionsManagementController@view_admin_promotion', array('sortBy' => 'amount', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
											@endif	
										@else
											@if($sortBy == "amount")
												@if($sortType == "asc")
													<a href="{{action('PromotionsManagementController@view_admin_promotion', array('sortBy' => 'amount', 'order' => 'desc', 'filtered' => $filtered, 'name' => $name, 'amount' => $amount))}}">
												@else
													<a href="{{action('PromotionsManagementController@view_admin_promotion', array('sortBy' => 'amount', 'order' => 'asc', 'filtered' => $filtered, 'name' => $name, 'amount' => $amount))}}">
												@endif
											@else
												<a href="{{action('PromotionsManagementController@view_admin_promotion', array('sortBy' => 'amount', 'order' => 'asc', 'filtered' => $filtered, 'name' => $name, 'amount' => $amount))}}">
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
									<td><input type="text" class="form-control input-sm filterName"></td>
									<td><input type="text" class="form-control input-sm filterAmount"></td>
									
									<td width=""><a class="btn btn-primary btn-xs filterButton">Filter</a></td>
								</tr>
							</thead>
							<tbody>
								@foreach($promotions as $promotion)	
									<tr> 									
										<td id="name_{{$promotion->name}}">{{$promotion->name}}</td>
										<td id="amount_{{$promotion->amount}}">{{$promotion->amount}}</td>										
										<td>
											<input type='hidden' value='{{$promotion->id}}'>
											<button class="btn btn-warning btn-xs detailButton" data-toggle="modal" data-target=".pop_up_edit_promosi">Edit</button>										
											<input type='hidden' value='{{$promotion->id}}'>
											<button class="btn btn-danger btn-xs deleteButton" data-toggle="modal" data-target=".alertYesNo">Delete</button>
										</td>
									</tr> 
								@endforeach	
							</tbody>
						</table>
					@endif								
				</div>				
			</div>
		</div>
	</div>
	
	@include('pages.admin.promosi.alertYesNo')	
	@include('pages.admin.promosi.pop_up_add_promosi')
	@include('pages.admin.promosi.pop_up_edit_promosi')

	<script>
		$('body').on('click', '.showAddPopUp', function(){
			//inisialisasi arr_id
			arr_id = new Array();
			//clear field pop up add
			$('#new_name_input').val('');
			$('#new_amount_input').val('');
			$('.new_start_date_input').val('');
			$('.new_expired_input').val('');
			$('#new_promoted_product_input').val('');
			$('#product_promo_list').html('');
		});
	
		$('body').on('click', '.detailButton', function(){
			$id = $(this).prev().val();					
				
			//clear field editpop up
			$('#edit_name_input').val('');
			 $('#edit_amount_input').val('');
			 $('.edit_start_date_input').val('');
			 $('.edit_expired_input').val('');	
			 $('#edit_promoted_product_input').val('');
			 $('#edit_product_promo_list').html('');
			 arr_edit_id = new Array();
			
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/promotion')}}/"+$id,
				success: function(response){				
					result = JSON.parse(response);					
					if(result.code==200){
						$message = result.messages;
						 //set detail value
						 $('#edit_name_input').val($message.name);
						 $('#edit_amount_input').val($message.amount);
						 $('.edit_start_date_input').val($message.start_date);
						 $('.edit_expired_input').val($message.expired);						 
						 temp_edit_id = $message.id;
						 temp_arr_product_detail = $message.products;						 
						 
						 // alert(temp_edit_id);
						 // alert(JSON.stringify(arr_edit_id));
						 // alert(arr_edit_id[0]['id']);
						 // alert(arr_edit_id[1]['id']);
						 // alert(arr_edit_id.length);
						 
						//add table yang sudah termasuk promosi												
						var ct = 0;
						var ct_price = 0;
						for(ct = 0; ct < temp_arr_product_detail.length; ct++){	
							//add arr id detail
								arr_edit_id[arr_edit_id.length] = temp_arr_product_detail[ct]['id'];
							
							for(ct_price = 0; ct_price < temp_arr_product_detail[ct]['prices'].length; ct_price++) //looping sebanyak price product
							{
								text = '';
								 text +='<tr>';
								 // text +='<td><img src="{{asset("assets/img/1x1.jpg")}}" width="150" class="pull-right"/></td>';
								 if(temp_arr_product_detail[ct]['main_photo'] == '')
								 {
									 text +='<td><img src="" alt="no photo" width="150" class="pull-right"/></td>';
								 }
								 else
								 {
									 text +='<td><img src="{{asset("'+temp_arr_product_detail[ct]['main_photo']+'")}}" width="150" class="pull-right"/></td>';
								 }								
								 text +='<td>'+temp_arr_product_detail[ct]['name']+' , '+temp_arr_product_detail[ct]['prices'][ct_price]['attr_name']+' : '+temp_arr_product_detail[ct]['prices'][ct_price]['attr_value']+'</td>';
								 text +='<td>'+temp_arr_product_detail[ct]['prices'][ct_price]['price_with_tax']+'</td>';								
								 text +='<td>'+temp_arr_product_detail[ct]['prices'][ct_price]['price_with_tax_promotion']+'</td>';								
								 text +='<td><input type="hidden" value="'+temp_arr_product_detail[ct]['id']+'"/><button type="button" class="btn btn-danger f_remove_product"><span class="glyphicon glyphicon-remove"></span></button></td>';
								 text +='</tr>';
								 $('#edit_product_promo_list').prepend(text);
							}							
						}						
						// $('#edit_name_input').val($message[0].name);	
						// if($message[0].parent_category == null)
						// {
							// $message[0].parent_category = -1;
						// }
						// $('#edit_parent_category_input').val($message[0].parent_category);						
					}					
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert(errorThrown);
				}
			},'json');			
		});	
		
		$('body').on('click', '.deleteButton', function(){
			$id = $(this).prev().val();
			// alert($id);			
		});
		
		$('body').on('click', '.filterButton', function(){			
			$name = $('.filterName').val();
			$amount = $('.filterAmount').val();
			window.location = "{{URL::route('viewPromotionsManagement')}}"+"?filtered=1&name="+$name+"&amount="+$amount;			
		});
		
		$('body').on('click','.backButton', function(){
			window.location = "{{URL::route('viewPromotionsManagement')}}";
		});
	</script>
@stop