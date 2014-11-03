@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			
				<div class="s_title_n_control">
					<h3 style="float: left;">
						Manage Taxes
					</h3>
				</div>
				<span class="clearfix"></span>
				<hr></hr>
				
				<div>					
					@if($taxes == null)
						@if($filtered == 0)
							<button class="btn btn-success" style="float: right; margin-top: 20px; margin-bottom: 25px;"  data-toggle="modal" data-target=".pop_up_add_tax">+ Add New Tax</button>
							<p>No Taxes</p>
						@else
							<button class="btn btn-success backButton" style="float: right; margin-top: 20px; margin-bottom: 25px;">Back</button>
							<p>Search not match anything</p>
							<table class="table table-striped table-hover table-condensed table-bordered">
								<thead class="table-bordered">
									<tr>
										<th class="table-bordered">
											<a href="javascript:void(0)">Nama</a>
											@if($filtered == 0)
												@if($sortBy == "name")
													@if($sortType == "asc")
														<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'name', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
													@else
														<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
													@endif
												@else
													<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
												@endif	
											@else
												@if($sortBy == "name")
													@if($sortType == "asc")
														<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'name', 'order' => 'desc', 'filtered' => $filtered, 'name' => $name, 'amount' => $amount))}}">
													@else
														<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'name', 'order' => 'asc', 'filtered' => $filtered, 'name' => $name, 'amount' => $amount))}}">
													@endif
												@else
													<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'name', 'order' => 'asc', 'filtered' => $filtered, 'name' => $name, 'amount' => $amount))}}">
												@endif	
											@endif								
											<span class="glyphicon glyphicon-sort" style="float: right;"></span>
											</a>
										</th>
										<th class="table-bordered">
											<a href="javascript:void(0)">Nilai</a>
											@if($filtered == 0)
												@if($sortBy == "amount")
													@if($sortType == "asc")
														<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'amount', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
													@else
														<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'amount', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
													@endif
												@else
													<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'amount', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
												@endif	
											@else
												@if($sortBy == "amount")
													@if($sortType == "asc")
														<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'amount', 'order' => 'desc', 'filtered' => $filtered, 'name' => $name, 'amount' => $amount))}}">
													@else
														<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'amount', 'order' => 'asc', 'filtered' => $filtered, 'name' => $name, 'amount' => $amount))}}">
													@endif
												@else
													<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'amount', 'order' => 'asc', 'filtered' => $filtered, 'name' => $name, 'amount' => $amount))}}">
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
										
										<td width=""><a id="search-tax" class="btn btn-primary btn-xs filterButton">Filter</a></td>
									</tr>
								</thead>
							</table>	
						@endif
					@else
						@if($filtered == 0)
							{{$taxes->appends(array('sortBy' => $sortBy, 'order' => $sortType, 'filtered' => $filtered))->links()}}
							<button class="btn btn-success" style="float: right; margin-top: 20px; margin-bottom: 25px;"  data-toggle="modal" data-target=".pop_up_add_tax">+ Add New Tax</button>
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
													<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'name', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
												@else
													<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
												@endif
											@else
												<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
											@endif	
										@else
											@if($sortBy == "name")
												@if($sortType == "asc")
													<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'name', 'order' => 'desc', 'filtered' => $filtered, 'name' => $name, 'amount' => $amount))}}">
												@else
													<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'name', 'order' => 'asc', 'filtered' => $filtered, 'name' => $name, 'amount' => $amount))}}">
												@endif
											@else
												<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'name', 'order' => 'asc', 'filtered' => $filtered, 'name' => $name, 'amount' => $amount))}}">
											@endif	
										@endif								
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
										</a>
									</th>
									<th class="table-bordered">
										<a href="javascript:void(0)">Nilai</a>
										@if($filtered == 0)
											@if($sortBy == "amount")
												@if($sortType == "asc")
													<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'amount', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
												@else
													<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'amount', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
												@endif
											@else
												<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'amount', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
											@endif	
										@else
											@if($sortBy == "amount")
												@if($sortType == "asc")
													<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'amount', 'order' => 'desc', 'filtered' => $filtered, 'name' => $name, 'amount' => $amount))}}">
												@else
													<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'amount', 'order' => 'asc', 'filtered' => $filtered, 'name' => $name, 'amount' => $amount))}}">
												@endif
											@else
												<a href="{{action('TaxesManagementController@view_admin_tax', array('sortBy' => 'amount', 'order' => 'asc', 'filtered' => $filtered, 'name' => $name, 'amount' => $amount))}}">
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
									
									<td width=""><a id="search-tax" class="btn btn-primary btn-xs filterButton">Filter</a></td>
								</tr>
							</thead>
							<tbody>	
								@foreach($taxes as $tax)
									<tr> 								
										<td id="name_{{$tax->name}}">{{$tax->name}}</td>
										<td id="amount_{{$tax->amount}}">{{$tax->amount}}</td>									
										<td>
											<input type='hidden' value='{{$tax->id}}'>
											<button class="btn btn-info btn-xs detailButton" data-toggle="modal" data-target=".pop_up_edit_tax">Edit</button>										
											<input type='hidden' value='{{$tax->id}}'>
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
	
	@include('pages.admin.tax.alertYesNo')
	@include('pages.admin.tax.pop_up_add_tax')
	@include('pages.admin.tax.pop_up_edit_tax')

	<script>
		$('body').on('click', '.detailButton', function(){
			$id = $(this).prev().val();	
			$('#alert_edit_name_required').addClass('hidden');
			$('#alert_edit_amount_required').addClass('hidden');		
			$('#alert_edit_amount_format').addClass('hidden');		
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/tax')}}/"+$id,
				success: function(response){
					result = JSON.parse(response);
					if(result.code==200){
						$message = result.messages;
						$('#edit_name_input').val($message.name);
						$('#edit_amount_input').val($message.amount);
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
			window.location = "{{URL::route('viewTaxesManagement')}}"+"?filtered=1&name="+$name+"&amount="+$amount;			
		});
		
		$('body').on('click','.backButton', function(){
			window.location = "{{URL::route('viewTaxesManagement')}}";
		});
	
		/*
		//global
		var view_all = "{{URL('admin/tax')}}";		
		var filtered = 0;			//0 false, 1 true
		// var sorted_id = 0;	//-1 desc, 1 asc
		// var sorted_name = 0;	//-1 desc, 1 asc
		var temp_id;
		var temp_name;
		var temp_amount;
		var fill = "";
		var search_result;
			
		// sort on values
		function srt(desc) {
		  return function(a,b){
		   return desc ? ~~(a < b) : ~~(a > b);
		  };
		}
		
		$('body').on('click', '#toogle_sorted_name', function(){
			if(filtered == 1)
			{							
				//BERHASIL SORT NAME ASC
				// var temp = search_result.sort(srt({key:'name', string:true}, true));
				// temp = search_result.sort(srt({key:'name', string:true}, true));
				// temp = search_result.sort(srt({key:'name', string:true}, true));			
				
				//BERHASIL SORT NAME DESC
				// var temp = search_result.sort(srt({key:'name', string:true}, true));
				// temp = search_result.sort(srt({key:'name', string:true}, true));
				// temp = search_result.sort(srt({key:'name', string:true}, true));			
				// temp.reverse();
				
				//BERHASIL SORT AMOUNT ASC				
				// var temp = search_result.sort(srt({key:'amount', float:true}, true));
				// temp = search_result.sort(srt({key:'amount', float:true}, true));
				// temp = search_result.sort(srt({key:'amount', float:true}, true));
				
				//BERHASIL SORT AMOUTN DESC				
				// var temp = search_result.sort(srt({key:'amount', float:true}, true));
				// temp = search_result.sort(srt({key:'amount', float:true}, true));
				// temp = search_result.sort(srt({key:'amount', float:true}, true));
				// temp.reverse();
								
				fill = "";
				fill += "<a id='button_view_all' href='"+view_all+"' class='btn btn-success' style='float: left; margin-top: 20px; margin-bottom: 25px;'>View All</a><button class='btn btn-success' style='float: right; margin-top: 20px; margin-bottom: 25px;'  data-toggle='modal' data-target='.pop_up_add_tax'>+ Add New Tax</button>";
				fill += "<table class='table table-striped table-hover '><thead class='table-bordered'><tr><th class='table-bordered'><a href='javascript:void(0)'>Nama</a><a href='javascript:void(0)'><span id='toogle_sorted_name' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Nilai</a><a href='javascript:void(0)'><span id='toogle_sorted_amount' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'></th></thead><thead><tr><td><input id='search_name_input' type='text' class='form-control input-sm'></td><td><input id='search_amount_input' type='text' class='form-control input-sm'></td><td width=''><a id='search-tax' class='btn btn-primary btn-xs'>Filter</a></td></tr></thead><tbody>	";					
				for(i=0; i<temp.length; i++){
					temp_id = temp[i]['id'];							
					temp_name = temp[i]['name'];
					temp_amount = temp[i]['amount'];
					fill += "<tr><td>"+temp_name+"</td><td>"+temp_amount+"</td><td><input type='hidden' class='id_tax' value='"+temp_id+"'><button class='btn btn-warning btn-xs detail-tax' data-toggle='modal' data-target='.pop_up_edit_tax'>Edit</button>										<button class='btn btn-danger btn-xs' data-toggle='modal' data-target='.alertYesNo'>Delete</button></td></tr>";
				}					
				fill += "</tbody></table>";						
				document.getElementById("div_pagination").innerHTML = fill;
			}
		});
		
		$('body').on('click', '.detail-tax',function(){
			$id = $(this).siblings('.id_tax').val();
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/tax')}}/"+$id,
				success: function(response){
					result = JSON.parse(response);
					if(result.code==200){
						$message = result.messages;
						$('#edit_name_input').val($message.name);
						$('#edit_amount_input').val($message.amount);
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert(errorThrown);
				}
			},'json');
		});
		
		$('body').on('click', '#search-tax', function(){
			//change filtered status
				filtered = 1;			
			$name = $('#search_name_input').val();			
			$amount = $('#search_amount_input').val();
			$data = {				
				'name' : $name,
				'amount' : $amount
			};			
			var json_data = JSON.stringify($data);
			// alert(json_data);
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/searchTax')}}",
				data : {
					'json_data' : json_data
				},				
				success: function(response){									
					alert("searching");					
					// var temp_id;
					// var temp_name;
					// var fill = "";
					if(response != ""){
						//fill result
						search_result = response;
						//alert("null");	
						fill = "";
						fill += "<a id='button_view_all' href='"+view_all+"' class='btn btn-success' style='float: left; margin-top: 20px; margin-bottom: 25px;'>View All</a><button class='btn btn-success' style='float: right; margin-top: 20px; margin-bottom: 25px;'  data-toggle='modal' data-target='.pop_up_add_tax'>+ Add New Tax</button>";
						fill += "<table class='table table-striped table-hover '><thead class='table-bordered'><tr><th class='table-bordered'><a href='javascript:void(0)'>Nama</a><a href='javascript:void(0)'><span id='toogle_sorted_name' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Nilai</a><a href='javascript:void(0)'><span id='toogle_sorted_amount' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'></th></thead><thead><tr><td><input id='search_name_input' type='text' class='form-control input-sm'></td><td><input id='search_amount_input' type='text' class='form-control input-sm'></td><td width=''><a id='search-tax' class='btn btn-primary btn-xs'>Filter</a></td></tr></thead><tbody>	";					
						for(i=0; i<response.length; i++){
							temp_id = response[i]['id'];							
							temp_name = response[i]['name'];
							temp_amount = resopnse[i]['amount'];
							fill += "<tr><td>"+temp_name+"</td><td>"+temp_amount+"</td><td><input type='hidden' class='id_tax' value='"+temp_id+"'><button class='btn btn-warning btn-xs detail-tax' data-toggle='modal' data-target='.pop_up_edit_tax'>Edit</button>										<button class='btn btn-danger btn-xs' data-toggle='modal' data-target='.alertYesNo'>Delete</button></td></tr>";
						}					
						fill += "</tbody></table>";						
						document.getElementById("div_pagination").innerHTML = fill;
					}else{		
						fill = "";
						fill += "<a id='button_view_all' href='"+view_all+"' class='btn btn-success' style='float: left; margin-top: 20px; margin-bottom: 25px;'>View All</a><button class='btn btn-success' style='float: right; margin-top: 20px; margin-bottom: 25px;'  data-toggle='modal' data-target='.pop_up_add_tax'>+ Add New Tax</button>";
						fill += "<table class='table table-striped table-hover '><thead class='table-bordered'><tr><th class='table-bordered'><a href='javascript:void(0)'>Nama</a><a href='javascript:void(0)'><span id='toogle_sorted_name' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Nilai</a><a href='javascript:void(0)'><span id='toogle_sorted_amount' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'></th></thead><thead><tr><td><input id='search_name_input' type='text' class='form-control input-sm'></td><td><input id='search_amount_input' type='text' class='form-control input-sm'></td><td width=''><a id='search-tax' class='btn btn-primary btn-xs'>Filter</a></td></tr></thead><tbody>	";					
						fill += "<tr><td>No Result</td></tr>";
						fill += "</tbody></table>";
						document.getElementById("div_pagination").innerHTML = fill;
					}	
					//keep input					
					$('#search_name_input').val($name);	
					$('#search_amount_input').val($amount);	
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert("error");
					alert(errorThrown);
				}
			},'json');
		});
		*/
	</script>
@stop