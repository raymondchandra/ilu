<div class="modal fade pop_up_add_attribute" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Add New Attribute</h4>
			</div>
			<form class="form-horizontal" role="form">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12"><!-- col-sm-5 -->

							<div class="form-group">
								<label class="col-sm-4 control-label">Nama Attribute</label>
								<div class="col-sm-5">
									<input id="new_name_input" type="text" class="form-control" value="">	
								</div>
								<div class="col-sm-3">
									<span class="btn btn-danger">Nama attribute ini sudah ada</span>	
								</div>
							</div>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button id="add_attribute" type="button" class="btn btn-success" data-dismiss="modal">Add</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$('body').on('click', '#add_attribute', function(){		
		$name = $('#new_name_input').val();		
		$deleted = 0;
		$data = {
			'name' : $name,
			'deleted' : $deleted
		};
		var json_data = JSON.stringify($data);
		// alert(json_data);
		$.ajax({
			type: 'POST',
			url: "{{URL('admin/attribute/addAttribute')}}",
			data : {
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