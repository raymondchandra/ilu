<div class="modal fade pop_up_add_tax" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Tambah Pajak Baru</h4>
			</div>
			<form class="form-horizontal" role="form">
				<div class="modal-body">
					<div class="form-group">
						<label class="col-sm-3 control-label">Name *</label>
						<div class="col-sm-6">
							<input id="new_name_input" type="text" class="form-control">				
						</div>
						<div class="col-sm-3">
							<span class="btn btn-danger">
								Maaf form harus diisi
							</span>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-3 control-label">Nilai (dalam %) *</label>
						<div class="col-sm-6">
							<input id="new_amount_input" type="text" class="form-control" >				
						</div>
						<div class="col-sm-3">
							<span class="btn btn-danger">
								Maaf form harus diisi
							</span>
						</div>
					</div>


					
				</div>
				<div class="modal-footer">
					<button id="add_tax" type="button" class="btn btn-success" data-dismiss="modal">Ya</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$('body').on('click', '#add_tax', function(){		
		$name = $('#new_name_input').val();	
		$amount = $('#new_amount_input').val();
		$deleted = 0;
		$data = {
			'name' : $name,
			'amount' : $amount,
			'deleted' : $deleted
		};
		var json_data = JSON.stringify($data);
		// alert(json_data);
		$.ajax({
			type: 'POST',
			url: "{{URL('admin/tax/addTax')}}",
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