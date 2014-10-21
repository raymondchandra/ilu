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
				
				<div>
					{{$datas->links()}}
					<!--<ul class="pagination">
					  <li><a href="#">&laquo;</a></li>
					  <li><a href="#">1</a></li>
					  <li><a href="#">2</a></li>
					  <li><a href="#">3</a></li>
					  <li><a href="#">4</a></li>
					  <li><a href="#">5</a></li>
					  <li><a href="#">&raquo;</a></li>
					</ul>-->
					<button class="btn btn-success" style="float: right; margin-top: 20px;"  data-toggle="modal" data-target=".pop_up_add_category">+ Add Category</button>
					<table class="table table-striped table-hover ">
						<thead class="table-bordered">
							<tr>
								<th class="table-bordered">
								ID
									<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Nama Category</a>
									<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Parent Category</a>
									<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
								Edit
								</th>
							</tr>
						</thead>
						<thead>
							<tr>
								<td width="125"><input type="text" class="form-control input-sm"></td>
								<td><input type="text" class="form-control input-sm"></td>
								<td><input type="text" class="form-control input-sm"></td>
								
								<td width="120"><a class="btn btn-primary btn-xs">Filter</a></td>
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
										<!-- Button trigger modal class ".alertYesNo" -->
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
	</script>
@stop