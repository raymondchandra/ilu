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
						<label class="col-sm-3 control-label">Company Telephone Number *</label>
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
						<label class="col-sm-3 control-label">Company Fax Number</label>
						<div class="col-sm-6">
							<input type="text" class="form-control">				
						</div>
						<div class="col-sm-3">
							<!--<span class="btn btn-danger">
								Maaf form harus diisi
							</span>-->
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-3 control-label">Company Address</label>
						<div class="col-sm-6">
							<input type="text" class="form-control">				
						</div>
						<div class="col-sm-3">
							<!--<span class="btn btn-danger">
								Maaf form harus diisi
							</span>-->
						</div>
					</div>
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

					<hr></hr>
					<h3>
						Bank
						<button type="button" class="btn btn-success pull-right" id="f_add_new_bank">
							Add New Bank
						</button>
					</h3>
					<div class="bank_area">


						<table class="table table-bordered" style="margin-top: 20px;">
							<thead>
								<th>
									Nama Bank
								</th>
								<th>
									Nomer Rekening
								</th>
								<th>
									Nama Nasabah
								</th>
								<th>
									Command
								</th>
							</thead>
							<tbody class="f_tbody_bank">
								<tr>
									<td>
										<input type="text" class="form-control" placeholder="">
									</td>
									<td>
										<input type="text" class="form-control" placeholder="">
									</td>
									<td>
										<input type="text" class="form-control" placeholder="">
									</td>
									<td>
										<button type="button" class="btn btn-danger f_delete_bank">Delete</button>
									</td>
								</tr>
							</tbody>
						</table>
						<script>
						$('body').on('click','#f_add_new_bank',function(){
							var tr_bank='<tr>';
							tr_bank +='		<td>';
							tr_bank +='			<input type="text" class="form-control" placeholder="">';
							tr_bank +='		</td>';
							tr_bank +='		<td>';
							tr_bank +='			<input type="text" class="form-control" placeholder="">';
							tr_bank +='		</td>';
							tr_bank +='		<td>';
							tr_bank +='			<input type="text" class="form-control" placeholder="">';
							tr_bank +='		</td>';
							tr_bank +='		<td>';
							tr_bank +='			<button type="button" class="btn btn-danger f_delete_bank">Delete</button>';
							tr_bank +='		</td>';
							tr_bank +='	</tr>';

							$('.f_tbody_bank').append(tr_bank);

							//alert('dsa');
						});

						$('body').on('click','.f_delete_bank',function(){
							
							$(this).parent().parent().remove();

							//alert('dsa');
						});

					</script>
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