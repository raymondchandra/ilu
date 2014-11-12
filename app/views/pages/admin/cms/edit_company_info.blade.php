<!--<div class="modal fade pop_up_edit_company_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Company Information</h4>
			</div>-->
			<script>
				$('document').ready(function(){
					$.ajax({
						type: 'GET',
						url: "{{URL('admin/company')}}",
						success: function(response){
							if(response){
								$('#company_name').val(response.company_name);
								$('#company_address').val(response.company_address);
								$('#company_city').val(response.company_city);
								/*$.each(response.emails.email,function(){
									alert($(this));
								});*/
								var email_form='';
								if( typeof response.emails.email === 'string' ) {
									$('#main_email').val(response.emails.email);
								}
								else{
									for($i=0;$i< response.emails.email.length;$i++){
										if($i==0){
											email_form = '';
											$('#main_email').val(response.emails.email[0]);
										}
										else{
											email_form += '<div class="form-group f_email_addition_form_node">';
											email_form += '		<label class="col-sm-3 control-label"></label>';
											email_form += '		<div class="col-sm-5">';
											email_form += '			<input type="text" class="form-control" name="email[]" value="'+response.emails.email[$i]+'" />	';			
											email_form += '		</div>';
											email_form += '		<div class="col-sm-1">';
											email_form += '			<button type="button" class="btn btn-danger f_email_del_addition_btn">';
											email_form += '			 	<span class="glyphicon glyphicon-remove"></span>';		
											email_form += '			</button>		';	
											email_form += '		</div>';
											email_form += '		<div class="col-sm-3">';
											email_form += '		</div>';
											email_form += '	</div>';
										}
									}
									$('#f_email_addition_form').html(email_form);
								}
								
								var telp_form='';
								if( typeof response.phones.phone === 'string' ) {
									$('#main_phone').val(response.phones.phone);
								}
								else{
									for($i=0;$i< response.phones.phone.length;$i++){
										if($i==0){
											telp_form = '';
											$('#main_phone').val(response.phones.phone[0]);
										}
										else{
											telp_form += '<div class="form-group f_telp_addition_form_node">';
											telp_form += '		<label class="col-sm-3 control-label"></label>';
											telp_form += '		<div class="col-sm-5">';
											telp_form += '			<input type="text" class="form-control" name="phone[]" value="'+response.phones.phone[$i]+'" />	';			
											telp_form += '		</div>';
											telp_form += '		<div class="col-sm-1">';
											telp_form += '			<button type="button" class="btn btn-danger f_telp_del_addition_btn">';
											telp_form += '			 	<span class="glyphicon glyphicon-remove"></span>';		
											telp_form += '			</button>		';	
											telp_form += '		</div>';
											telp_form += '		<div class="col-sm-3">';
											telp_form += '		</div>';
											telp_form += '	</div>';
										}
									}
									$('#f_telp_addition_form').html(telp_form);
								}
								
								var fax_form='';
								if( typeof response.faxs.fax === 'string' ) {
									$('#main_fax').val(response.faxs.fax);
								}
								else{
									for($i=0;$i< response.faxs.fax.length;$i++){
										if($i==0){
											fax_form = '';
											$('#main_fax').val(response.faxs.fax[0]);
										}
										else{
											fax_form = '<div class="form-group f_fax_addition_form_node">';
											fax_form += '		<label class="col-sm-3 control-label"></label>';
											fax_form += '		<div class="col-sm-5">';
											fax_form += '			<input type="text" class="form-control" name="fax[]" value="'+response.faxs.fax[$i]+'" />	';			
											fax_form += '		</div>';
											fax_form += '		<div class="col-sm-1">';
											fax_form += '			<button type="button" class="btn btn-danger f_fax_del_addition_btn">';
											fax_form += '			 	<span class="glyphicon glyphicon-remove"></span>';		
											fax_form += '			</button>		';	
											fax_form += '		</div>';
											fax_form += '		<div class="col-sm-3">';
											fax_form += '		</div>';
											fax_form += '	</div>';
										}
									}
									$('#f_fax_addition_form').html(fax_form);
								}
								
								$('#company_description').html(response.company_description);
							}
						},
						error: function(jqXHR, textStatus, errorThrown){
							alert(errorThrown);
						}
					},'json');
				});
			</script>
			<h3>
				Company Profile
			</h3>
			<form class="form-horizontal company_form" role="form">
				<div class="modal-body">
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Company Logo *</label>
						<div class="col-sm-6">
							<img src="{{asset('assets/company_logo.jpeg')}}" id='company_logo_prev' width="100" height="100">
							<input type="file" class="company_logo" name='company_logo' />				
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
							<input type="text" class="form-control" id='company_name' name='name' />				
						</div>
						<div class="col-sm-3">
							<span class="btn btn-danger">
								Maaf form harus diisi
							</span>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Company Address *</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id='company_address' name='address' />				
						</div>
						<div class="col-sm-3">
							<span class="btn btn-danger">
								Maaf form harus diisi
							</span>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Company City *</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" id = 'company_city' name='city' />				
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
							<input type="text" class="form-control" id='main_email' name='email[]' />				
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
						email_form += '			<input type="text" class="form-control" name="email[]" />	';			
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
						$(this).closest('.f_email_addition_form_node').remove();
					});
					</script>
					<!-- company email ADDITION END -->
					<div class="form-group">
						<label class="col-sm-3 control-label">Company Telephone Number *</label>
						<div class="col-sm-5">
							<input type="text" class="form-control" id='main_phone' name='phone[]' />				
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
						telp_form += '			<input type="text" class="form-control" name="phone[]" />	';			
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
						$(this).closest('.f_telp_addition_form_node').remove();
					});
					</script>
					<!-- company email ADDITION END -->

					<div class="form-group">
						<label class="col-sm-3 control-label">Company Fax Number</label>
						<div class="col-sm-5">
							<input type="text" id='main_fax' class="form-control" name='fax[]' />				
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
						fax_form += '			<input type="text" class="form-control" name="fax[]" />	';			
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
						$(this).closest('.f_fax_addition_form_node').remove();
					});
					</script>
					<!-- company fax ADDITION END -->

					
					

					<div class="form-group">
						<label class="col-sm-3 control-label">Company Description</label>
						<div class="col-sm-6">
							<textarea class="form-control" id='company_description' rows="3" name ='desc'></textarea>				
						</div>
						<div class="col-sm-3">
							<!--<span class="btn btn-danger">
								Maaf form harus diisi
							</span>-->
						</div>
					</div>


				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success save_company" data-dismiss="modal">Save</button>
					<!-- <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button> -->
				</div>
			</form>
		<!--</div>
	</div>
</div>-->

<script>
	var uploaded_image = '';
	$('body').on('click','.save_company',function(){
		$form_data = $('.company_form').serialize();
		$formData = new FormData();
		$formData.append('image',uploaded_image);
		$formData.append('data',$form_data);
		$.ajax({
			type: 'POST',
			url: "{{URL('admin/company')}}",
			data:$formData,
			processData:false,
			contentType:false,
			success: function(response){
				alert(response);
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(errorThrown);
			}
		},'json');
	});
	
	$('body').on('change','.company_logo',function(){
		var i = 0, len = this.files.length, img, reader, file;
		for ( ; i < len; i++ ){
			file = this.files[i];
			if (!!file.type.match(/image.*/)) {
				if ( window.FileReader ) {
					reader = new FileReader();
					reader.onloadend = function (e) {
						$('#company_logo_prev').attr('src',e.target.result);
					};
					reader.readAsDataURL(file);
				}
			}
			uploaded_image = file;
		}
	});
</script>