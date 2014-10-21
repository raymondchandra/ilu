<div class="modal fade pop_up_edit_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Category</h4>
			</div>
			<form class="form-horizontal" role="form">
				<div class="modal-body">

					<div class="form-group">
						<label class="col-sm-3 control-label">Nama Category</label>
						<div class="col-sm-6">
							<input id="edit_name_input" type="text" class="form-control">			
						</div>
					</div>

					<div class="form-group">
						<label for="inputPassword3" class="col-sm-3 control-label">Choose Parent</label>
						<div class="col-sm-6">
							{{Form::select('edit_parent_category', $list_category, '', array('id'=>'edit_parent_category_input'))}}
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
							</select>-->
						</div>
					</div>
					

				</div>
				<div class="modal-footer">
					<button id="edit_category" type="button" class="btn btn-success" data-dismiss="modal">Ya</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$('body').on('click', '#edit_category', function(){		
		$edit_name = $('#edit_name_input').val();
		$edit_parent_category = $('#edit_parent_category_input').val();
		$data = {
			'id' : $id,
			'name' : $edit_name,
			'parent_category' : $edit_parent_category
		};
		var json_data = JSON.stringify($data);
		$.ajax({
			type: 'POST',
			url: "{{URL('admin/category/editFull')}}",
			data : {
				'json_data' : json_data
			},
			success: function(response){
				result = JSON.parse(response);
				if(result.code==204){
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
