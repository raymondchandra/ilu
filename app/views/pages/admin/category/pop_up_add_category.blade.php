<div class="modal fade pop_up_add_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Add New Category</h4>
			</div>
			<form class="form-horizontal" role="form">
				<div class="modal-body">

					<div class="form-group">
						<label class="col-sm-3 control-label">Nama Category</label>
						<div class="col-sm-6">
							<input id="new_name_input" type="text" class="form-control" placeholder="Nama Category">			
						</div>
					</div>

					<div class="form-group">
						<label for="inputPassword3" class="col-sm-3 control-label">Choose Parent</label>
						<div class="col-sm-6">
							{{Form::select('parent_category', $list_category, '', array('id'=>'new_parent_category_input'))}}
							<!--<select class="form-control">
								<option value="">Category</option>
								<option value="">Category</option>
								<option value="">Category</option>
								<option value="">Category</option>
								<option value="">Category</option>
								<option value="">Category</option>
								<option value="">Category</option>
								<option value="">Category</option>
								<option value="">Category</option>
							</select>	-->
						</div>
					</div>					

				</div>
				<div class="modal-footer">
					<button id="add_category" type="button" class="btn btn-success" data-dismiss="modal">Ya</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$('body').on('click', '#add_category', function(){		
		$name = $('#new_name_input').val();
		alert($name);
		$parent_category = $('#new_parent_category_input').val();
		alert($parent_category);
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