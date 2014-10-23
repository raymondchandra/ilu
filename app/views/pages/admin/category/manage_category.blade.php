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
				
				<div id="div_pagination">
					{{$datas->links()}}
					
					<button class="btn btn-success" style="float: right; margin-top: 20px;"  data-toggle="modal" data-target=".pop_up_add_category">+ Add Category</button>
					
					<table class="table table-striped table-hover ">
						<thead class="table-bordered">
							<tr>
								<th class="table-bordered">
								ID
									<a href="javascript:void(0)">
									<span id="toogle_sorted_id" class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Nama Category</a>
									<a href="javascript:void(0)">
									<span id="toogle_sorted_name" class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Parent Category</a>
									<a href="javascript:void(0)">
									<span id="toogle_sorted_parent_name" class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
								Edit
								</th>
							</tr>
						</thead>
						<thead>
							<tr>
								<td width="125"><input id="search_id_input" type="text" class="form-control input-sm"></td>
								<td><input id="search_name_input" type="text" class="form-control input-sm"></td>
								<td><input id="search_parent_name_input" type="text" class="form-control input-sm"></td>
								
								<td width="120"><a id="search-category" class="btn btn-primary btn-xs">Filter</a></td>
							</tr>
						</thead>
						<tbody>			
							@foreach($datas as $category)
								<tr> 
									<td>{{$category->id}}</td>
									<td>{{$category->name}}</td>
									<td>{{$category->parent_name}}</td>								
									<td>
										<input type='hidden' class='id_category' value='{{$category->id}}'>
										<a class="btn btn-warning btn-xs detail-category" data-toggle="modal" data-target=".pop_up_edit_category">Edit</a>										
										<a class="btn btn-danger btn-xs" data-toggle="modal" data-target=".alertYesNo">Delete</a>
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
	@include('pages.admin.category.pop_up_add_category')
	@include('pages.admin.category.pop_up_edit_category')

	<script>
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
	</script>
@stop