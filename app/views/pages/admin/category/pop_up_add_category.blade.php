<div class="modal fade pop_up_add_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
							{{Form::select('parent_category', $list_category, '', array('id'=>'new_parent_category_input'))}}							
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