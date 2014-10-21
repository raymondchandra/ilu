<div class="modal fade pop_up_view_review" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Detail Review</h4>
			</div>
			<form class="form-horizontal" role="form">
				<div class="modal-body">
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Product ID</label>
						<div class="col-sm-6">
							<p id="detail_product_no" type="text" class="form-control-static">8764656y5</p>				
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Name Product</label>
						<div class="col-sm-6">
							<p id="detail_product_name" type="text" class="form-control-static">Tas Epic Banget</p>				
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Komentar</label>
						<div class="col-sm-6">
							<p id="detail_text" type="text" class="form-control-static">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Nequ</p>				
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Rating</label>
						<div class="col-sm-6">
							<p id="detail_rating" type="text" class="form-control-static">4.5 / 5</p>				
						</div>
					</div>

					<div class="form-group">
						<label for="inputPassword3" class="col-sm-3 control-label">Status</label>
						<div class="col-sm-6">														
							<p id="review_status" class="form-control-static"></p>							
							<select id="review_status_list" class="form-control hidden">
								<option value="0">Pending</option>
								<option value="1">Approved</option>
							</select>
						<div class="col-sm-6">
							<p id="review_status" class="form-control-static">Pending</p>
							<!--<select id="review_status_list" class="form-control hidden">
								<option val="pending">Pending</option>
								<option val="onship">Approved</option>
							</select>-->
						</div>
						<div class="col-sm-3">
							<button type="button" class="btn btn-warning" id="review_status_editor">Change</button>
							<button type="button" class="btn btn-success hidden" id="review_status_setter">Set</button>
							<script>
							$( 'body' ).on( "click",'#review_status_editor', function() {
								if($('#review_status').text() == "Pending"){
									$('#review_status').text("Approved");
								}else{
									$('#review_status').text("Pending");
								}
								//$('#review_status_list').removeClass('hidden');
								//$('#review_status_setter').removeClass('hidden');
								//$('#review_status').addClass('hidden');
								//$('#review_status_editor').addClass('hidden');

							});

						/*	$( 'body' ).on( "click",'#review_status_setter', function() {
								var selectedStatus = $('#review_status_list').find(":selected").text();
								$new_approved = $('#review_status_list').val();
								$data = {
									'id' : $id,
									'new_approved' : $new_approved
								};
								var json_data = JSON.stringify($data);
								$.ajax({																	
									type: 'POST',
									url: "{{URL('admin/review/editApproved')}}",
									data: {
											'json_data' : json_data
									},
									success: function(response){
										// alert(response);
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
								
								$('#review_status_list').addClass('hidden');
								$('#review_status_setter').addClass('hidden');
								$('#review_status').removeClass('hidden');
								$('#review_status_editor').removeClass('hidden');
								$('#review_status').text(selectedStatus);
							});*/
							</script>
						</div>
					</div>



						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-success" data-dismiss="modal">Simpan</button>
							<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
						</div>
					</form>
				</div>
			</div>
		</div>
