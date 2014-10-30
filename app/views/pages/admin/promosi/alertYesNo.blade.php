<!-- Modal ".alertYesNo"-->
<div class="modal fade alertYesNo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
	<div class="modal-content">
	  <div class="modal-header">
		<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
		<h4 class="modal-title" id="myModalLabel">Alert!</h4>
	  </div>
	  <div class="modal-body"  style="text-align: center;">
			Apakah Anda yakin ingin menghapus ini?
	  </div>
	  <div class="modal-footer" style="text-align: center;">
		<button id="delete_promotion" type="button" class="btn btn-danger" data-dismiss="modal">Ya</button>
		<button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
	  </div>
	</div>
  </div>
</div>

<script>
	$('body').on('click', '#delete_promotion', function(){				
		$data = {
			'id' : $id			
		};
		alert($id);
		json_data = JSON.stringify($data);
		// alert(json_data);
		$.ajax({
			type: 'DELETE',
			url: "{{URL('admin/promotion/deletePromotion')}}",
			data : {
				'json_data' : json_data
			},
			success: function(response){
				result = JSON.parse(response);
				if(result.code==204){
					// alert(result.status);
					alert('Success delete');
					location.reload();
				}							
				else
				{
					alert(result.status);
					alert(JSON.stringify(result.messages));		
					alert('gagal delete');
				}
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(errorThrown);
			}
		},'json');
	});
</script>