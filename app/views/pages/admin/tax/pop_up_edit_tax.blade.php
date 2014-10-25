<div class="modal fade pop_up_edit_tax" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Pajak</h4>
			</div>
			<form class="form-horizontal" role="form">
				<div class="modal-body">
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Name *</label>
						<div class="col-sm-6">
							<input id="edit_name_input" type="text" class="form-control">				
						</div>
						<div class="col-sm-3">
							<span id="alert_edit_name_required" class="btn btn-danger hidden">
								Name harus diisi
							</span>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-3 control-label">Nilai (dalam %) *</label>
						<div class="col-sm-6">
							<input id="edit_amount_input" type="text" class="form-control" >				
						</div>
						<div class="col-sm-3">
							<span id="alert_edit_amount_required" class="btn btn-danger hidden">
								Amount harus diisi
							</span>
						</div>
						<div class="col-sm-3">
							<span id="alert_edit_amount_format" class="btn btn-danger hidden">
								Amount harus berupa angka
							</span>
						</div>
					</div>
					
				</div>
				<div class="modal-footer">
					<button id="edit_tax" type="button" class="btn btn-success">Ya</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
$('body').on('click', '#edit_tax', function(){		
		$edit_name = $('#edit_name_input').val();
		$edit_amount = $('#edit_amount_input').val();
		$data = {
			'id' : $id,
			'name' : $edit_name,
			'amount' : $edit_amount
		};		
		var json_data = JSON.stringify($data);
		$.ajax({
			type: 'POST',
			url: "{{URL('admin/tax/editFull')}}",
			data : {
				'json_data' : json_data
			},
			success: function(response){
				result = JSON.parse(response);
				if(result.code==204){
					alert(result.status);
					location.reload();
				}
				else if(result.code==400)
				{
					alert(result.status);																		
					if(result.messages['name'] == 'The name field is required.')
					{
						$('#alert_edit_name_required').removeClass('hidden');
					}
					else
					{
						$('#alert_edit_name_required').addClass('hidden');
					}
					if(result.messages['amount'] == 'The amount field is required.')
					{
						$('#alert_edit_amount_required').removeClass('hidden');
					}
					else
					{
						$('#alert_edit_amount_required').addClass('hidden');
					}					
					if(result.messages['amount'] == 'The amount format is invalid.')
					{
						$('#alert_edit_amount_format').removeClass('hidden');
					}
					else
					{
						$('#alert_edit_amount_format').addClass('hidden');
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