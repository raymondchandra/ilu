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

			<div id="div_pagination">					
					{{$datas->links()}}
					
					<button class="btn btn-success" style="float: right; margin-top: 20px;"  data-toggle="modal" data-target=".pop_up_add_attribute">+ Add New Attribute</button>

					<table class="table table-striped table-hover ">
						<thead class="table-bordered">
							<tr>
								<th class="table-bordered">
									<a href="javascript:void(0)">ID Attribute</a>
									<a href="javascript:void(0)">
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Nama Attribute</a>
									<a href="javascript:void(0)">
										<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">

								</th>
							</thead>
							<thead>
								<tr>
									<td><input id="search_id_input" type="text" class="form-control input-sm"></td>
									<td><input id="search_name_input" type="text" class="form-control input-sm"></td>
									
									<td width=""><a id="search-attribute" class="btn btn-primary btn-xs">Filter</a></td>
								</tr>
							</thead>
							<tbody>
								@foreach($datas as $attribute)
									<tr> 
										<td>{{$attribute->id}}</td>
										<td>{{$attribute->name}}</td>
										<td>
											<input type='hidden' class='id_attribute' value='{{$attribute->id}}'>
											<button class="btn btn-info btn-xs detail-attribute" data-toggle="modal" data-target=".pop_up_view_attribute">View</button>
											<!-- Button trigger modal class ".alertYesNo" -->
											<button class="btn btn-danger btn-xs delete-attribute" data-toggle="modal" data-target=".alertYesNo">Delete</button>
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
	@include('pages.admin.attribute.pop_up_add_attribute')
	@include('pages.admin.attribute.pop_up_view_attribute')

	<script>
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
					var temp_id;
					var temp_name;
					var fill = "";
					if(response != ""){
						//alert("null");						
						fill += "<button class='btn btn-success' style='float: right; margin-top: 20px;'  data-toggle='modal' data-target='.pop_up_add_attribute'>+ Add New Attribute</button>";
						fill += "<table class='table table-striped table-hover'><thead class='table-bordered'><tr><th class='table-bordered'><a href='javascript:void(0)'>ID Attribute</a><a href='javascript:void(0)'><span class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Nama Attribute</a><a href='javascript:void(0)'><span class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'></th></thead><thead><tr><td><input id='search_id_input' type='text' class='form-control input-sm'></td><td><input id='search_name_input' type='text' class='form-control input-sm'></td><td width=''><a id='search-attribute' class='btn btn-primary btn-xs'>Filter</a></td></tr></thead><tbody>";					
						for(i=0; i<response.length; i++){
							temp_id = response[i]['id'];							
							temp_name = response[i]['name'];
							fill += "<tr><td>"+temp_id+"</td><td>"+temp_name+"</td><td><input type='hidden' class='id_attribute' value='"+temp_id+"'><button class='btn btn-info btn-xs detail-attribute' data-toggle='modal' data-target='.pop_up_view_attribute'>View</button><button class='btn btn-danger btn-xs delete-attribute' data-toggle='modal' data-target='.alertYesNo'>Delete</button></td></tr>";
						}
						fill += "</tbody></table>";						
						document.getElementById("div_pagination").innerHTML = fill;
					}else{		
						fill += "<button class='btn btn-success' style='float: right; margin-top: 20px;'  data-toggle='modal' data-target='.pop_up_add_attribute'>+ Add New Attribute</button>";
						fill += "<table class='table table-striped table-hover'><thead class='table-bordered'><tr><th class='table-bordered'><a href='javascript:void(0)'>ID Attribute</a><a href='javascript:void(0)'><span class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Nama Attribute</a><a href='javascript:void(0)'><span class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'></th></thead><thead><tr><td><input id='search_id_input' type='text' class='form-control input-sm'></td><td><input id='search_name_input' type='text' class='form-control input-sm'></td><td width=''><a id='search-attribute' class='btn btn-primary btn-xs'>Filter</a></td></tr></thead><tbody>";					
						fill += "<tr><td>No Result</td></tr>";
						fill += "</tbody></table>";
						document.getElementById("div_pagination").innerHTML = fill;
					}																
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
	</script>
	
	@stop