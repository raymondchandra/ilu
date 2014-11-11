<!--<div class="modal fade pop_up_edit_company_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Company Information</h4>
			</div>-->
			<h3>
				Company Profile
			</h3>
			<form class="form-horizontal" role="form">
				<div class="modal-body">
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Company Logo *</label>
						<div class="col-sm-6">
							<img src="" width="100" height="100">
							<input type="file" class="">				
						</div>
						<div class="col-sm-3">
							<span class="btn btn-danger">
								Maaf file harus diupload
							</span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Company Name *</label>
						<div class="col-sm-6">
							<input type="text" class="form-control">				
						</div>
						<div class="col-sm-3">
							<span class="btn btn-danger">
								Maaf form harus diisi
							</span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Company Email *</label>
						<div class="col-sm-5">
							<input type="text" class="form-control">				
						</div>
						<div class="col-sm-1">
							<button type="button" class="btn btn-success f_email_addition_btn">
								<span class="glyphicon glyphicon-plus"></span>			
							</button>			
						</div>
						<div class="col-sm-3">
							<span class="btn btn-danger">
								Maaf form harus diisi
							</span>
						</div>
					</div>
					<!-- company email ADDITION START -->
					<div id="f_email_addition_form">
					</div>
					<script>
					$('body').on('click','.f_email_addition_btn',function(){
						var email_form = '<div class="form-group f_email_addition_form_node">';
						email_form += '		<label class="col-sm-3 control-label"></label>';
						email_form += '		<div class="col-sm-5">';
						email_form += '			<input type="text" class="form-control">	';			
						email_form += '		</div>';
						email_form += '		<div class="col-sm-1">';
						email_form += '			<button type="button" class="btn btn-danger f_email_del_addition_btn">';
						email_form += '			 	<span class="glyphicon glyphicon-remove"></span>';		
						email_form += '			</button>		';	
						email_form += '		</div>';
						email_form += '		<div class="col-sm-3">';
						email_form += '		</div>';
						email_form += '	</div>';

						$('#f_email_addition_form').append(email_form);

					});


					$('body').on('click','.f_email_del_addition_btn',function(){
						$(this).parents('.f_email_addition_form_node').remove();
					});
					</script>
					<!-- company email ADDITION END -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Company Telephone Number *</label>
						<div class="col-sm-5">
							<input type="text" class="form-control">				
						</div>
						<div class="col-sm-1">
							<button type="button" class="btn btn-success f_telp_addition_btn">
								<span class="glyphicon glyphicon-plus"></span>			
							</button>			
						</div>
						<div class="col-sm-3">
							<span class="btn btn-danger">
								Maaf form harus diisi
							</span>
						</div>
					</div>
					<!-- company telp ADDITION START -->
					<div id="f_telp_addition_form">
					</div>
					<script>
					$('body').on('click','.f_telp_addition_btn',function(){
						var telp_form = '<div class="form-group f_telp_addition_form_node">';
						telp_form += '		<label class="col-sm-3 control-label"></label>';
						telp_form += '		<div class="col-sm-5">';
						telp_form += '			<input type="text" class="form-control">	';			
						telp_form += '		</div>';
						telp_form += '		<div class="col-sm-1">';
						telp_form += '			<button type="button" class="btn btn-danger f_telp_del_addition_btn">';
						telp_form += '			 	<span class="glyphicon glyphicon-remove"></span>';		
						telp_form += '			</button>		';	
						telp_form += '		</div>';
						telp_form += '		<div class="col-sm-3">';
						telp_form += '		</div>';
						telp_form += '	</div>';

						$('#f_telp_addition_form').append(telp_form);

					});


					$('body').on('click','.f_telp_del_addition_btn',function(){
						$(this).parents('.f_telp_addition_form_node').remove();
					});
					</script>
					<!-- company email ADDITION END -->

					<div class="form-group">
						<label class="col-sm-3 control-label">Company Fax Number</label>
						<div class="col-sm-5">
							<input type="text" class="form-control">				
						</div>
						<div class="col-sm-1">
							<button type="button" class="btn btn-success f_fax_addition_btn">
								<span class="glyphicon glyphicon-plus"></span>			
							</button>			
						</div>
						<div class="col-sm-3">
							<!--<span class="btn btn-danger">
								Maaf form harus diisi
							</span>-->
						</div>
					</div>
					<!-- company fax ADDITION START -->
					<div id="f_fax_addition_form">
					</div>
					<script>
					$('body').on('click','.f_fax_addition_btn',function(){
						var fax_form = '<div class="form-group f_fax_addition_form_node">';
						fax_form += '		<label class="col-sm-3 control-label"></label>';
						fax_form += '		<div class="col-sm-5">';
						fax_form += '			<input type="text" class="form-control">	';			
						fax_form += '		</div>';
						fax_form += '		<div class="col-sm-1">';
						fax_form += '			<button type="button" class="btn btn-danger f_fax_del_addition_btn">';
						fax_form += '			 	<span class="glyphicon glyphicon-remove"></span>';		
						fax_form += '			</button>		';	
						fax_form += '		</div>';
						fax_form += '		<div class="col-sm-3">';
						fax_form += '		</div>';
						fax_form += '	</div>';

						$('#f_fax_addition_form').append(fax_form);

					});


					$('body').on('click','.f_fax_del_addition_btn',function(){
						$(this).parents('.f_fax_addition_form_node').remove();
					});
					</script>
					<!-- company fax ADDITION END -->

					<div class="form-group">
						<label class="col-sm-3 control-label">Company Address</label>
						<div class="col-sm-5">
							<input type="text" class="form-control">				
						</div>
						<div class="col-sm-1">
							<button type="button" class="btn btn-success f_address_addition_btn">
								<span class="glyphicon glyphicon-plus"></span>			
							</button>			
						</div>
						<div class="col-sm-3">
							<!--<span class="btn btn-danger">
								Maaf form harus diisi
							</span>-->
						</div>
					</div>
					<!-- company address ADDITION START -->
					<div id="f_address_addition_form">
					</div>
					<script>
					$('body').on('click','.f_address_addition_btn',function(){
						var address_form = '<div class="form-group f_address_addition_form_node">';
						address_form += '		<label class="col-sm-3 control-label"></label>';
						address_form += '		<div class="col-sm-5">';
						address_form += '			<input type="text" class="form-control">	';			
						address_form += '		</div>';
						address_form += '		<div class="col-sm-1">';
						address_form += '			<button type="button" class="btn btn-danger f_address_del_addition_btn">';
						address_form += '			 	<span class="glyphicon glyphicon-remove"></span>';		
						address_form += '			</button>		';	
						address_form += '		</div>';
						address_form += '		<div class="col-sm-3">';
						address_form += '		</div>';
						address_form += '	</div>';

						$('#f_address_addition_form').append(address_form);

					});


					$('body').on('click','.f_address_del_addition_btn',function(){
						$(this).parents('.f_address_addition_form_node').remove();
					});
					</script>
					<!-- company address ADDITION END -->

					<div class="form-group">
						<label class="col-sm-3 control-label">Company Description</label>
						<div class="col-sm-6">
							<textarea class="form-control" rows="3"></textarea>				
						</div>
						<div class="col-sm-3">
							<!--<span class="btn btn-danger">
								Maaf form harus diisi
							</span>-->
						</div>
					</div>


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
					<!-- <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button> -->
				</div>
			</form>
		<!--</div>
	</div>
</div>-->