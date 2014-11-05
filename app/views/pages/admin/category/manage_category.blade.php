@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			
				<div class="s_title_n_control">
					<h3 style="float: left;">
						Manage Category
					</h3>
				</div>
				<span class="clearfix"></span>
				<hr></hr>
				
				<div class="container">		
					<div class="col-lg-12">

						<div class="modal-dialog modal-lg">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" id="addButton" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
									<h4 class="modal-title" id="myModalLabel">Add New Category</h4>
								</div>
								<form class="form-horizontal" role="form">
									<div class="modal-body">

										<div class="form-group">
											<label class="col-sm-3 control-label">Nama Category</label>
											<div class="col-sm-6">
												<input id="new_name_input" type="text" class="form-control" placeholder="Nama Category">			
											</div>
											<div class="col-sm-3">
												<span id="alert_new_name_taken" class="btn btn-danger hidden">Nama category ini sudah ada</span>	
											</div>
											<div class="col-sm-3">
												<span id="alert_new_name_required" class="btn btn-danger hidden">Nama category harus diisi</span>	
											</div>
										</div>

										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">Choose Parent</label>
											<div class="col-sm-6">
												{{Form::select('parent_category', $list_category, '', array('id'=>'new_parent_category_input','class'=>'form-control'))}}							
											</div>
										</div>					

									</div>
									<div class="modal-footer">
										<button id="add_category" type="button" class="btn btn-success">Ya</button>
										<button type="button" id="cancelAddButton" class="btn btn-primary" data-dismiss="modal">Tidak</button>
									</div>
								</form>
							</div>
						</div>


						<script>
							$('body').on('click', '#addButton', function(){
								//set default 
								$('#new_name_input').val('');
								$('#new_parent_category_input').val('-1');
								$('#alert_new_name_required').addClass('hidden');
								$('#alert_new_name_taken').addClass('hidden');
							});
							$('body').on('click', '#cancelAddButton', function(){
								//set default 
								$('#new_name_input').val('');
								$('#new_parent_category_input').val('-1');
								$('#alert_new_name_required').addClass('hidden');
								$('#alert_new_name_taken').addClass('hidden');
							});
							
							$('body').on('click', '#add_category', function(){		
								$name = $('#new_name_input').val();		
								$parent_category = $('#new_parent_category_input').val();		
								$deleted = 0;
								$data = {
									'name' : $name,
									'parent_category' : $parent_category,
									'deleted' : $deleted
								};
								var json_data = JSON.stringify($data);
								$.ajax({
									type: 'POST',
									url: "{{URL('admin/category/addCategory')}}",
									data: {
										'json_data' : json_data
									},
									success: function(response){				
										result = JSON.parse(response);
										if(result.code==201){
											alert(result.status);
											location.reload();
										}
										else if(result.code==400)
										{
											alert(result.status);	
											if(result.messages['name'] == 'The name field is required.')
											{
												$('#alert_new_name_required').removeClass('hidden');
											}
											else
											{
												$('#alert_new_name_required').addClass('hidden');
											}
											if(result.messages['name'] == 'The name has already been taken.')
											{
												$('#alert_new_name_taken').removeClass('hidden');
											}
											else
											{
												$('#alert_new_name_taken').addClass('hidden');
											}										
										}
										else
										{
											alert(result.status);
											alert(result.messages);
										}
									},
									error: function(jqXHR, textStatus, errorThrown){
										alert(errorThrown);
									}
								},'json');
							});		
						</script>			
					</div>			
					<div class="col-lg-12">					
					@if($categories == null) 
						@if($filtered == 0)
							<!--<button class="btn btn-success" style="float: right; margin-bottom: 20px;"  data-toggle="modal" data-target=".pop_up_add_category">+ Add Category</button>-->
							<p>No Categories</p>
						@else
							<button class="btn btn-success backButton" style="float: right; margin-bottom: 20px;">Back</button>
							<p>Search not match anything</p>
							<table class="table table-striped table-hover table-condensed table-bordered">
								<thead class="table-bordered">
									<tr>
										<th class="table-bordered">
											<a href="javascript:void(0)">ID</a>
											@if($filtered == 0)
												@if($sortBy == "id")
													@if($sortType == "asc")
														<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'id', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
													@else
														<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'id', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
													@endif
												@else
													<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'id', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
												@endif	
											@else
												@if($sortBy == "id")
													@if($sortType == "asc")
														<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'id', 'order' => 'desc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, 'parent_name' => $parent_name))}}">
													@else
														<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'id', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, 'parent_name' => $parent_name))}}">
													@endif
												@else
													<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'id', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, 'parent_name' => $parent_name))}}">
												@endif	
											@endif		
											<span class="glyphicon glyphicon-sort" style="float: right;"></span>										
											</a>
										</th>
										<th class="table-bordered">
											<a href="javascript:void(0)">Nama Category</a>
											@if($filtered == 0)
												@if($sortBy == "name")
													@if($sortType == "asc")
														<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'name', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
													@else
														<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
													@endif
												@else
													<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
												@endif	
											@else
												@if($sortBy == "name")
													@if($sortType == "asc")
														<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'name', 'order' => 'desc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, 'parent_name' => $parent_name))}}">
													@else
														<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'name', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, 'parent_name' => $parent_name))}}">
													@endif
												@else
													<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'name', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, 'parent_name' => $parent_name))}}">
												@endif	
											@endif		
											<span class="glyphicon glyphicon-sort" style="float: right;"></span>										
											</a>
										</th>
										<th class="table-bordered">
											<a href="javascript:void(0)">Parent Category</a>
											@if($filtered == 0)
												@if($sortBy == "parent_name")
													@if($sortType == "asc")
														<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'parent_name', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
													@else
														<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'parent_name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
													@endif
												@else
													<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'parent_name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
												@endif	
											@else
												@if($sortBy == "parent_name")
													@if($sortType == "asc")
														<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'parent_name', 'order' => 'desc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, 'parent_name' => $parent_name))}}">
													@else
														<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'parent_name', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, 'parent_name' => $parent_name))}}">
													@endif
												@else
													<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'parent_name', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, 'parent_name' => $parent_name))}}">
												@endif	
											@endif		
											<span class="glyphicon glyphicon-sort" style="float: right;"></span>										
											</a>
										</th>
										<th class="table-bordered">
										
										</th>
									</tr>
								</thead>
							</table>	
						@endif
					@else
						@if($filtered == 0)
							{{$categories->appends(array('sortBy' => $sortBy, 'order' => $sortType, 'filtered' => $filtered))->links()}}
							<!--<button class="btn btn-success" style="float: right;  margin-bottom: 20px;"  data-toggle="modal" data-target=".pop_up_add_category">+ Add Category</button>-->
						@else
							<button class="btn btn-success backButton" style="float: right; margin-top: 20px; margin-bottom: 25px;">Back</button>
						@endif
						<table class="table table-striped table-hover table-condensed table-bordered">
							<thead class="table-bordered">
								<tr>
									<th class="table-bordered">
										<a href="javascript:void(0)">ID</a>
										@if($filtered == 0)
											@if($sortBy == "id")
												@if($sortType == "asc")
													<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'id', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
												@else
													<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'id', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
												@endif
											@else
												<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'id', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
											@endif	
										@else
											@if($sortBy == "id")
												@if($sortType == "asc")
													<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'id', 'order' => 'desc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, 'parent_name' => $parent_name))}}">
												@else
													<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'id', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, 'parent_name' => $parent_name))}}">
												@endif
											@else
												<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'id', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, 'parent_name' => $parent_name))}}">
											@endif	
										@endif		
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>										
										</a>
									</th>
									<th class="table-bordered">
										<a href="javascript:void(0)">Nama Category</a>
										@if($filtered == 0)
											@if($sortBy == "name")
												@if($sortType == "asc")
													<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'name', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
												@else
													<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
												@endif
											@else
												<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
											@endif	
										@else
											@if($sortBy == "name")
												@if($sortType == "asc")
													<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'name', 'order' => 'desc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, 'parent_name' => $parent_name))}}">
												@else
													<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'name', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, 'parent_name' => $parent_name))}}">
												@endif
											@else
												<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'name', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, 'parent_name' => $parent_name))}}">
											@endif	
										@endif		
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>										
										</a>
									</th>
									<th class="table-bordered">
										<a href="javascript:void(0)">Parent Category</a>
										@if($filtered == 0)
											@if($sortBy == "parent_name")
												@if($sortType == "asc")
													<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'parent_name', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
												@else
													<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'parent_name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
												@endif
											@else
												<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'parent_name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
											@endif	
										@else
											@if($sortBy == "parent_name")
												@if($sortType == "asc")
													<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'parent_name', 'order' => 'desc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, 'parent_name' => $parent_name))}}">
												@else
													<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'parent_name', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, 'parent_name' => $parent_name))}}">
												@endif
											@else
												<a href="{{action('CategoriesManagementController@view_admin_category', array('sortBy' => 'parent_name', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, 'parent_name' => $parent_name))}}">
											@endif	
										@endif		
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>										
										</a>
									</th>
									<th class="table-bordered">
									
									</th>
								</tr>
							</thead>
							<thead>
								<tr>
									<td width="125"><input type="text" class="form-control input-sm filterId"></td>
									<td><input type="text" class="form-control input-sm filterName"></td>
									<td><input type="text" class="form-control input-sm filterParentName"></td>
									
									<td width="120"><a class="btn btn-primary btn-xs filterButton">Filter</a></td>
								</tr>
							</thead>
							<tbody>			
								@foreach($categories as $category)
									<tr> 
										<td id="id_{{$category->id}}">{{$category->id}}</td>
										<td id="name_{{$category->name}}">{{$category->name}}</td>
										<td id="parent_name_{{$category->parent_name}}">{{$category->parent_name}}</td>								
										<td>
											<input type='hidden' value='{{$category->id}}'>
											<a class="btn btn-warning btn-xs detailButton" data-toggle="modal" data-target=".pop_up_edit_category">Edit</a>										
											<input type='hidden' value='{{$category->id}}'>
											<a class="btn btn-danger btn-xs deleteButton" data-toggle="modal" data-target=".alertYesNo">Delete</a>
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
	</div>
	
	@include('pages.admin.category.alertYesNo')
	{{-- @include('pages.admin.category.pop_up_add_category') --}}
	@include('pages.admin.category.pop_up_edit_category')

	<script>
		$('body').on('click', '.detailButton', function(){
			$id = $(this).prev().val();					
			$('#alert_edit_nama_required').addClass('hidden');
			$('#alert_edit_nama_taken').addClass('hidden');
			// $edit_name = $('#edit_name_input').val();
			// $edit_parent_category = $('#edit_parent_category_input').val();		
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/category')}}/"+$id,
				success: function(response){				
					result = JSON.parse(response);					
					if(result.code==200){
						$message = result.messages;						
						$('#edit_name_input').val($message[0].name);	
						if($message[0].parent_category == null)
						{
							$message[0].parent_category = -1;
						}
						$('#edit_parent_category_input').val($message[0].parent_category);						
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
			$id = $('.filterId').val();
			$name = $('.filterName').val();
			$parent_name = $('.filterParentName').val();
			window.location = "{{URL::route('viewCategoriesManagement')}}"+"?filtered=1&id="+$id+"&name="+$name+"&parent_name="+$parent_name;			
		});
		
		$('body').on('click','.backButton', function(){
			window.location = "{{URL::route('viewCategoriesManagement')}}";
		});
		/*
		//global
		var view_all = "{{URL('admin/category')}}";		
		var filtered = 0;			//0 false, 1 true
		// var sorted_id = 0;	//-1 desc, 1 asc
		// var sorted_name = 0;	//-1 desc, 1 asc
		var temp_id;
		var temp_name;
		var temp_parent_name;
		var fill = "";
		var search_result;
		
		// sort on values
		function srt(desc) {
		  return function(a,b){
		   return desc ? ~~(a < b) : ~~(a > b);
		  };
		}
		
		$('body').on('click', '.detail-category',function(){
			$id = $(this).siblings('.id_category').val();			
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/category')}}/"+$id,
				success: function(response){
					result = JSON.parse(response);
					if(result.code==200){
						$message = result.messages;						
						$('#edit_name_input').val($message.name);
						$('#edit_parent_category_input').val($message.parent_category);
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert(errorThrown);
				}
			},'json');
		});
		
		$('body').on('click', '#toogle_sorted_id', function(){
			if(filtered == 1)
			{
				//BERHASIL SORT PARENT_NAME ASC
				// var temp = search_result.sort(srt({key:'parent_name', string:true}, true));
				// temp = search_result.sort(srt({key:'parent_name', string:true}, true));
				// temp = search_result.sort(srt({key:'parent_name', string:true}, true));			
				
				//BERHASIL SORT PARENT_NAME DESC
				// var temp = search_result.sort(srt({key:'parent_name', string:true}, true));
				// temp = search_result.sort(srt({key:'parent_name', string:true}, true));
				// temp = search_result.sort(srt({key:'parent_name', string:true}, true));			
				// temp.reverse();
				
				//BERHASIL SORT NAME ASC
				// var temp = search_result.sort(srt({key:'name', string:true}, true));
				// temp = search_result.sort(srt({key:'name', string:true}, true));
				// temp = search_result.sort(srt({key:'name', string:true}, true));			
				
				//BERHASIL SORT NAME DESC
				// var temp = search_result.sort(srt({key:'name', string:true}, true));
				// temp = search_result.sort(srt({key:'name', string:true}, true));
				// temp = search_result.sort(srt({key:'name', string:true}, true));			
				// temp.reverse();
				
				//BERHASIL SORT ID ASC				
				// var temp = search_result.sort(srt({key:'id', integer:true}, true));
				// temp = search_result.sort(srt({key:'id', integer:true}, true));
				// temp = search_result.sort(srt({key:'id', integer:true}, true));
				
				//BERHASIL SORT ID DESC				
				// var temp = search_result.sort(srt({key:'id', integer:true}, true));
				// temp = search_result.sort(srt({key:'id', integer:true}, true));
				// temp = search_result.sort(srt({key:'id', integer:true}, true));
				// temp.reverse();
				
				fill = "";
				fill += "<a id='button_view_all' href='"+view_all+"' class='btn btn-success' style='float: left; margin-top: 20px; margin-bottom: 25px;'>View All</a><button class=;btn btn-success' style='float: right; margin-top: 20px; margin-bottom: 25px;'  data-toggle='modal' data-target='.pop_up_add_category'>+ Add Category</button>";				
				fill += "<table class='table table-striped table-hover '><thead class='table-bordered'><tr><th class='table-bordered'>ID<a href='javascript:void(0)'><span id='toogle_sorted_id' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Nama Category</a><a href='javascript:void(0)'><span id='toogle_sorted_name' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Parent Category</a><a href='javascript:void(0)'><span id='toogle_sorted_parent_name' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'>Edit</th></tr></thead><thead><tr><td width='125'><input id='search_id_input' type='text' class='form-control input-sm'></td><td><input id='search_name_input' type='text' class='form-control input-sm'></td><td><input id='search_parent_name_input' type='text' class='form-control input-sm'></td><td width='120'><a id='search-category' class='btn btn-primary btn-xs'>Filter</a></td></tr></thead><tbody>";	
				for(i=0; i<temp.length; i++){
					temp_id = temp[i]['id'];							
					temp_name = temp[i]['name'];
					temp_parent_name = temp[i]['parent_name'];
					fill += "<tr><td>"+temp_id+"</td><td>"+temp_name+"</td><td>"+temp_parent_name+"</td><td><input type='hidden' class='id_category' value='"+temp_id+"'><a class='btn btn-warning btn-xs detail-category' data-toggle='modal' data-target='.pop_up_edit_category'>Edit</a><a class='btn btn-danger btn-xs' data-toggle='modal' data-target='.alertYesNo'>Delete</a></td></tr>";
				}					
				fill += "</tbody></table>";						
				document.getElementById("div_pagination").innerHTML = fill;
			}
		});
		
		
		$('body').on('click', '#search-category', function(){
			//change filtered status
				filtered = 1;
			$id = $('#search_id_input').val();			
			$name = $('#search_name_input').val();	
			$parent_name = $('#search_parent_name_input').val();
			$data = {
				'id' : $id,
				'name' : $name,
				'parent_name' : $parent_name
			};			
			var json_data = JSON.stringify($data);
			// alert(json_data);
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/searchCategory')}}",
				data : {
					'json_data' : json_data
				},				
				success: function(response){									
					alert("searching");	
					alert(response);					
					// var temp_id;
					// var temp_name;
					// var fill = "";
					if(response != ""){
						//fill result
						search_result = response;
						//alert("null");	
						fill = "";							
						fill += "<a id='button_view_all' href='"+view_all+"' class='btn btn-success' style='float: left; margin-top: 20px; margin-bottom: 25px;'>View All</a><button class='btn btn-success' style='float: right; margin-top: 20px; margin-bottom: 25px;'  data-toggle='modal' data-target='.pop_up_add_category'>+ Add Category</button>";				
						fill += "<table class='table table-striped table-hover '><thead class='table-bordered'><tr><th class='table-bordered'>ID<a href='javascript:void(0)'><span id='toogle_sorted_id' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Nama Category</a><a href='javascript:void(0)'><span id='toogle_sorted_name' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Parent Category</a><a href='javascript:void(0)'><span id='toogle_sorted_parent_name' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'>Edit</th></tr></thead><thead><tr><td width='125'><input id='search_id_input' type='text' class='form-control input-sm'></td><td><input id='search_name_input' type='text' class='form-control input-sm'></td><td><input id='search_parent_name_input' type='text' class='form-control input-sm'></td><td width='120'><a id='search-category' class='btn btn-primary btn-xs'>Filter</a></td></tr></thead><tbody>";	
						for(i=0; i<response.length; i++){
							temp_id = response[i]['id'];							
							temp_name = response[i]['name'];
							temp_parent_name = response[i]['parent_name'];
							fill += "<tr><td>"+temp_id+"</td><td>"+temp_name+"</td><td>"+temp_parent_name+"</td><td><input type='hidden' class='id_category' value='"+temp_id+"'><a class='btn btn-warning btn-xs detail-category' data-toggle='modal' data-target='.pop_up_edit_category'>Edit</a><a class='btn btn-danger btn-xs' data-toggle='modal' data-target='.alertYesNo'>Delete</a></td></tr>";
						}					
						fill += "</tbody></table>";						
						document.getElementById("div_pagination").innerHTML = fill;
					}else{		
						fill = "";
						fill += "<a id='button_view_all' href='"+view_all+"' class='btn btn-success' style='float: left; margin-top: 20px; margin-bottom: 25px;'>View All</a><button class=;btn btn-success' style='float: right; margin-top: 20px; margin-bottom: 25px;'  data-toggle='modal' data-target='.pop_up_add_category'>+ Add Category</button>";				
						fill += "<table class='table table-striped table-hover'><thead class='table-bordered'><tr><th class='table-bordered'>ID<a href='javascript:void(0)'><span id='toogle_sorted_id' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Nama Category</a><a href='javascript:void(0)'><span id='toogle_sorted_name' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Parent Category</a><a href='javascript:void(0)'><span id='toogle_sorted_parent_name' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'>Edit</th></tr></thead><thead><tr><td width='125'><input id='search_id_input' type='text' class='form-control input-sm'></td><td><input id='search_name_input' type='text' class='form-control input-sm'></td><td><input id='search_parent_name_input' type='text' class='form-control input-sm'></td><td width='120'><a id='search-category' class='btn btn-primary btn-xs'>Filter</a></td></tr></thead><tbody>";	
						fill += "<tr><td>No Result</td></tr>";				
						fill += "</tbody></table>";						
						document.getElementById("div_pagination").innerHTML = fill;												
					}	
					//keep input
					$('#search_id_input').val($id);			
					$('#search_name_input').val($name);	
					$('#search_parent_name_input').val($parent_name);
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