@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			
			<div class="s_title_n_control">
				<h3 style="float: left;">
					Manage Attribute
				</h3>
			</div>
			<span class="clearfix"></span>
			<hr></hr>

			<div>
				@if($attributes == null)
					@if($filtered == 0)
						<button class="btn btn-success" style="float: right; margin-bottom: 20px;"  data-toggle="modal" data-target=".pop_up_add_attribute">+ Add New Attribute</button>
						<p>No Attributes</p>
					@else
						<button class="btn btn-success backButton" style="float: right; margin-bottom: 20px;">Back</button>
						<p>Search not match anything</p>
						<table class="table table-striped table-hover table-condensed table-bordered">
							<thead class="table-bordered">
								<tr>
									<th class="table-bordered">
										<a href="javascript:void(0)">ID Attribute</a>
										@if($filtered == 0)
											@if($sortBy == "id")
												@if($sortType == "asc")
													<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'id', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
												@else
													<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'id', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
												@endif
											@else
												<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'id', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
											@endif	
										@else
											@if($sortBy == "id")
												@if($sortType == "asc")
													<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'id', 'order' => 'desc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, ))}}">
												@else
													<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'id', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, ))}}">
												@endif
											@else
												<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'id', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, ))}}">
											@endif	
										@endif								
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
										</a>
									</th>
									<th class="table-bordered">
										<a href="javascript:void(0)">Nama Attribute</a>
										@if($filtered == 0)
											@if($sortBy == "name")
												@if($sortType == "asc")
													<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'name', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
												@else
													<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
												@endif
											@else
												<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
											@endif	
										@else
											@if($sortBy == "name")
												@if($sortType == "asc")
													<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'name', 'order' => 'desc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, ))}}">
												@else
													<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'name', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, ))}}">
												@endif
											@else
												<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'name', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, ))}}">
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
										<td><input type="text" class="form-control input-sm filterId"></td>
										<td><input type="text" class="form-control input-sm filterName"></td>
										
										<td width=""><a class="btn btn-primary btn-xs filterButton">Filter</a></td>
									</tr>
								</thead>
						</table>	
					@endif					
				@else								
					@if($filtered == 0)					
						{{$attributes->appends(array('sortBy' => $sortBy, 'order' => $sortType, 'filtered' => $filtered))->links()}}
						<button class="btn btn-success" style="float: right; margin-bottom: 20px;"  data-toggle="modal" data-target=".pop_up_add_attribute">+ Add New Attribute</button>
					@else
						<button class="btn btn-success backButton" style="float: right; margin-top: 20px; margin-bottom: 25px;">Back</button>
					@endif
					<table class="table table-striped table-hover table-condensed table-bordered">
						<thead class="table-bordered">
							<tr>
								<th class="table-bordered">
									<a href="javascript:void(0)">ID Attribute</a>
									@if($filtered == 0)
										@if($sortBy == "id")
											@if($sortType == "asc")
												<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'id', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
											@else
												<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'id', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
											@endif
										@else
											<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'id', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
										@endif	
									@else
										@if($sortBy == "id")
											@if($sortType == "asc")
												<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'id', 'order' => 'desc', 'filtered' => $filtered, 'id' => $id, 'name' => $name ))}}">
											@else
												<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'id', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'name' => $name ))}}">
											@endif
										@else
											<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'id', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'name' => $name ))}}">
										@endif	
									@endif								
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Nama Attribute</a>
									@if($filtered == 0)
										@if($sortBy == "name")
											@if($sortType == "asc")
												<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'name', 'order' => 'desc', 'page' =>  $page, 'filtered' => '0'))}}">
											@else
												<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">
											@endif
										@else
											<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'name', 'order' => 'asc', 'page' =>  $page, 'filtered' => '0'))}}">	
										@endif	
									@else
										@if($sortBy == "name")
											@if($sortType == "asc")
												<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'name', 'order' => 'desc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, ))}}">
											@else
												<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'name', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, ))}}">
											@endif
										@else
											<a href="{{action('AttributesManagementController@view_admin_attribute', array('sortBy' => 'name', 'order' => 'asc', 'filtered' => $filtered, 'id' => $id, 'name' => $name, ))}}">
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
									<td><input type="text" class="form-control input-sm filterId"></td>
									<td><input type="text" class="form-control input-sm filterName"></td>
									
									<td width=""><a class="btn btn-primary btn-xs filterButton">Filter</a></td>
								</tr>
							</thead>
							<tbody>
								@foreach($attributes as $attribute)
									<tr> 
										<td id="id_{{$attribute->id}}">{{$attribute->id}}</td>
										<td id="name_{{$attribute->name}}">{{$attribute->name}}</td>
										<td>
											<input type='hidden' value='{{$attribute->id}}'>
											<button class="btn btn-info btn-xs detailButton" data-toggle="modal" data-target=".pop_up_view_attribute">View</button>											
											<input type='hidden' value='{{$attribute->id}}'>
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
	
	@include('pages.admin.attribute.alertYesNo')
	@include('pages.admin.attribute.pop_up_add_attribute')
	@include('pages.admin.attribute.pop_up_view_attribute')

	<script>			
		$('body').on('click', '.detailButton', function(){
			$id = $(this).prev().val();
			$('#alert_edit_nama_required').addClass('hidden');
			$('#alert_edit_nama_taken').addClass('hidden');
			$('#nama_attribute_input').addClass('hidden');
			$('#nama_attribute_setter').addClass('hidden');
			$('#nama_attribute').removeClass('hidden');
			$('#nama_attribute_editor').removeClass('hidden');
			$('#nama_attribute').text($('#nama_attribute_input').val());
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/attribute')}}/"+$id,
				success: function(response){
					result = JSON.parse(response);
					if(result.code==200){
						$message = result.messages;
						$('#nama_attribute').text($message.name);
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
			window.location = "{{URL::route('viewAttributesManagement')}}"+"?filtered=1&id="+$id+"&name="+$name;			
		});
		
		$('body').on('click','.backButton', function(){
			window.location = "{{URL::route('viewAttributesManagement')}}";
		});
		
		
	
		/*BEFORE
		//global
		// var view_all = "{{URL('admin/attribute')}}";		
		// var filtered = 0;			//0 false, 1 true
		// var sorted_id = 0;	//-1 desc, 1 asc
		// var sorted_name = 0;	//-1 desc, 1 asc
		// var temp_id;
		// var temp_name;
		// var fill = "";
		// var search_result;
			
		// sort on values
		// function srt(desc) {
		  // return function(a,b){
		   // return desc ? ~~(a < b) : ~~(a > b);
		  // };
		// }
		
		// sort on key values
		// function keysrt(key, desc) {
		  // return function(a,b){
		   // return desc ? ~~(a[key] < b[key]) : ~~(a[key] > b[key]);		   
		   // return a[key] < b[key];
		  // }
		// }
		
		//sorted view
		// $('body').on('click', '#toogle_sorted_id', function(){
			// alert("before " +sorted_id);
			// if(sorted_id==0 || sorted_id==-1){
				// window.location="{{URL('admin/attributeIdAsc')}}";
				// sorted_id = 1;
				// alert("after " +sorted_id);
			// }else if(sorted_id==0 || sorted_id==1){
				// window.location="{{URL('admin/attributeIdDesc')}}";	
				// sorted_id = -1;
				// alert("after " +sorted_id);
			// }			
		// });	

		// $('body').on('click', '#toogle_sorted_id', function(){
			// if(filtered == 1)
			// {							
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
				
				// BERHASIL SORT ID DESC				
				// var temp = search_result.sort(srt({key:'id', integer:true}, true));
				// temp = search_result.sort(srt({key:'id', integer:true}, true));
				// temp = search_result.sort(srt({key:'id', integer:true}, true));
				// temp.reverse();
								
				// fill = "";
				// fill += "<a id='button_view_all' href='"+view_all+"' class='btn btn-success' style='float: left; margin-top: 20px; margin-bottom: 25px;'>View All</a><button class='btn btn-success' style='float: right; margin-top: 20px; margin-bottom: 25px;'  data-toggle='modal' data-target='.pop_up_add_attribute'>+ Add New Attribute</button>";
				// fill += "<table class='table table-striped table-hover'><thead class='table-bordered'><tr><th class='table-bordered'><a href='javascript:void(0)'>ID Attribute</a><a href='javascript:void(0)'><span id='toogle_sorted_id' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Nama Attribute</a><a href='javascript:void(0)'><span id='toogle_sorted_name' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'></th></thead><thead><tr><td><input id='search_id_input' type='text' class='form-control input-sm'></td><td><input id='search_name_input' type='text' class='form-control input-sm'></td><td width=''><a id='search-attribute' class='btn btn-primary btn-xs'>Filter</a></td></tr></thead><tbody>";					
				// for(i=0; i<temp.length; i++){
					// temp_id = temp[i]['id'];							
					// temp_name = temp[i]['name'];
					// fill += "<tr><td>"+temp_id+"</td><td>"+temp_name+"</td><td><input type='hidden' class='id_attribute' value='"+temp_id+"'><button class='btn btn-info btn-xs detail-attribute' data-toggle='modal' data-target='.pop_up_view_attribute'>View</button><button class='btn btn-danger btn-xs delete-attribute' data-toggle='modal' data-target='.alertYesNo'>Delete</button></td></tr>";
				// }					
				// fill += "</tbody></table>";						
				// document.getElementById("div_pagination").innerHTML = fill;
			// }
		// });
				
		//kalo jadi 2 button berbeda
		// $('body').on('click', '#toogle_sorted_id_asc', function(){
			// if(filtered==0){			
				// window.location="{{URL('admin/attributeIdAsc')}}";
			// }else{
					
			// }	
		// });			
		// $('body').on('click', '#toogle_sorted_id_desc', function(){
			// window.location="{{URL('admin/attributeIdDesc')}}";
		// });			
		// $('body').on('click', '#toogle_sorted_name_asc', function(){
			// window.location="{{URL('admin/attributeNameAsc')}}";
		// });			
		// $('body').on('click', '#toogle_sorted_name_asc', function(){
			// window.location="{{URL('admin/attributeNameDesc')}}";
		// });							
		
		$('body').on('click', '.detail-attribute',function(){
			$id = $(this).siblings('.id_attribute').val();
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/attribute')}}/"+$id,
				success: function(response){
					result = JSON.parse(response);
					if(result.code==200){
						$message = result.messages;
						$('#nama_attribute').text($message.name);
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert(errorThrown);
				}
			},'json');
		});
		
		$('body').on('click', '#search-attribute', function(){
			//change filtered status
				filtered = 1;
			$id = $('#search_id_input').val();			
			$name = $('#search_name_input').val();			
			$data = {
				'id' : $id,
				'name' : $name
			};			
			var json_data = JSON.stringify($data);
			// alert(json_data);
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/searchAttribute')}}",
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
						fill += "<a id='button_view_all' href='"+view_all+"' class='btn btn-success' style='float: left; margin-top: 20px; margin-bottom: 25px;'>View All</a><button class='btn btn-success' style='float: right; margin-top: 20px; margin-bottom: 25px;'  data-toggle='modal' data-target='.pop_up_add_attribute'>+ Add New Attribute</button>";
						fill += "<table class='table table-striped table-hover'><thead class='table-bordered'><tr><th class='table-bordered'><a href='javascript:void(0)'>ID Attribute</a><a href='javascript:void(0)'><span id='toogle_sorted_id' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Nama Attribute</a><a href='javascript:void(0)'><span id='toogle_sorted_name' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'></th></thead><thead><tr><td><input id='search_id_input' type='text' class='form-control input-sm'></td><td><input id='search_name_input' type='text' class='form-control input-sm'></td><td width=''><a id='search-attribute' class='btn btn-primary btn-xs'>Filter</a></td></tr></thead><tbody>";					
						for(i=0; i<response.length; i++){
							temp_id = response[i]['id'];							
							temp_name = response[i]['name'];
							fill += "<tr><td>"+temp_id+"</td><td>"+temp_name+"</td><td><input type='hidden' class='id_attribute' value='"+temp_id+"'><button class='btn btn-info btn-xs detail-attribute' data-toggle='modal' data-target='.pop_up_view_attribute'>View</button><button class='btn btn-danger btn-xs delete-attribute' data-toggle='modal' data-target='.alertYesNo'>Delete</button></td></tr>";
						}					
						fill += "</tbody></table>";						
						document.getElementById("div_pagination").innerHTML = fill;
					}else{		
						fill = "";
						fill += "<a id='button_view_all' href='"+view_all+"' class='btn btn-success' style='float: left; margin-top: 20px; margin-bottom: 25px;'>View All</a><button class='btn btn-success' style='float: right; margin-top: 20px; margin-bottom: 25px;'  data-toggle='modal' data-target='.pop_up_add_attribute'>+ Add New Attribute</button>";
						fill += "<table class='table table-striped table-hover'><thead class='table-bordered'><tr><th class='table-bordered'><a href='javascript:void(0)'>ID Attribute</a><a href='javascript:void(0)'><span id='toogle_sorted_id' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Nama Attribute</a><a href='javascript:void(0)'><span id='toogle_sorted_name' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'></th></thead><thead><tr><td><input id='search_id_input' type='text' class='form-control input-sm'></td><td><input id='search_name_input' type='text' class='form-control input-sm'></td><td width=''><a id='search-attribute' class='btn btn-primary btn-xs'>Filter</a></td></tr></thead><tbody>";					
						fill += "<tr><td>No Result</td></tr>";
						fill += "</tbody></table>";
						document.getElementById("div_pagination").innerHTML = fill;
					}	
					//keep input
					$('#search_id_input').val($id);			
					$('#search_name_input').val($name);	
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert("error");
					alert(errorThrown);
				}
			},'json');
		});
		
		
		// $('body').on('click', '.delete-attribute',function(){			
			// $id_delete = $(this).siblings('.id_attribute').val();
			
		// });		
	*/
	</script>
	
	
	@stop