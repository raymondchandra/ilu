
			<h3>
				Bank<button type="button" class="btn btn-success pull-right" id="f_add_new_bank">
				Add New Bank
			</button>
		</h3>
		<form class="form-horizontal" role="form">
			<div class="modal-body">
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
							<!--<tr>
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
							</tr>-->
						</tbody>
					</table>
					<script>
					$('body').on('click','#f_add_new_bank',function(){
						$.ajax({
							type: 'POST',
							url: "{{URL('admin/banks')}}",
							data:{
								name:'',
								acc_owner:''
							},
							success: function(response){
								alert(response.code);
								if(response.code == 201){
									$.ajax({
										type: 'GET',
										url: "{{URL('admin/banks')}}",
										success: function(response){
											//alert(response);
											var tr_bank ='';
											$msg = response.messages;
											$.each($msg,function(){
												tr_bank +='<tr>';
												tr_bank +='		<td class="form-name">';
												tr_bank +='			<input type="text" value="'+$(this)[0].name+'" class="form-control" placeholder="Bank Name"  />';
												tr_bank +='		</td>';
												tr_bank +='		<td class="form-number">';
												tr_bank +='			<input type="text" value="'+$(this)[0].acc_number+'" class="form-control" placeholder="Account Number"  />';
												tr_bank +='		</td>';
												tr_bank +='		<td class="form-owner">';
												tr_bank +='			<input type="text"  value="'+$(this)[0].acc_owner+'" class="form-control" placeholder="Account Owner" />';
												tr_bank +='		</td>';
												tr_bank +='		<td>';
												tr_bank +='			<button type="button" class="btn btn-danger f_delete_bank">Delete</button>';
												tr_bank +='		</td>';
												tr_bank +="<input type='hidden' value="+$(this)[0].id+" class='id_bank'   />";
												tr_bank +='	</tr>';
											});
											$('.f_tbody_bank').html(tr_bank);
										},
										error: function(jqXHR, textStatus, errorThrown){
											alert(errorThrown);
										}
									});
								}
							},
							error: function(jqXHR, textStatus, errorThrown){
								alert(errorThrown);
							}
						},'json');
						
						

							//alert('dsa');
						});

						
					$('body').on('change','.form-control',function(){
						$core = $(this).parent().parent();
						$name = $core.children('.form-name').children('.form-control').val();
						$number = $core.children('.form-number').children('.form-control').val();
						$owner = $core.children('.form-owner').children('.form-control').val();
						$id = $core.children('.id_bank').val();
						
						$.ajax({
							type: 'PUT',
							url: "{{URL('admin/banks')}}/"+$id,
							data:{
								name:$name,
								acc_number:$number,
								acc_owner:$owner
							},
							success: function(response){
								if(response.code == 200){
									$.ajax({
										type: 'GET',
										url: "{{URL('admin/banks')}}",
										success: function(response){
											//alert(response);
											var tr_bank ='';
											$msg = response.messages;
											$.each($msg,function(){
												tr_bank +='<tr>';
												tr_bank +='		<td class="form-name">';
												tr_bank +='			<input type="text" value="'+$(this)[0].name+'" class="form-control" placeholder="Bank Name"  />';
												tr_bank +='		</td>';
												tr_bank +='		<td class="form-number">';
												tr_bank +='			<input type="text" value="'+$(this)[0].acc_number+'" class="form-control" placeholder="Account Number"  />';
												tr_bank +='		</td>';
												tr_bank +='		<td class="form-owner">';
												tr_bank +='			<input type="text"  value="'+$(this)[0].acc_owner+'" class="form-control" placeholder="Account Owner" />';
												tr_bank +='		</td>';
												tr_bank +='		<td>';
												tr_bank +='			<button type="button" class="btn btn-danger f_delete_bank">Delete</button>';
												tr_bank +='		</td>';
												tr_bank +="<input type='hidden' value="+$(this)[0].id+" class='id_bank'   />";
												tr_bank +='	</tr>';
											});
											$('.f_tbody_bank').html(tr_bank);
											//alert('Success Edit Bank Information');
										},
										error: function(jqXHR, textStatus, errorThrown){
											alert(errorThrown);
										}
									});
								}
							},
							error: function(jqXHR, textStatus, errorThrown){
								alert(errorThrown);
							}
						},'json');
						//alert($name+" "+$number+" "+$owner);
					});
					
					$('body').on('click','.f_delete_bank',function(){
						$id = $(this).parent().siblings('.id_bank').val();
						$.ajax({
							type: 'DELETE',
							url: "{{URL('admin/banks')}}/"+$id,
							success: function(response){
								//alert(response.code);
								if(response.code == 200){
									$.ajax({
										type: 'GET',
										url: "{{URL('admin/banks')}}",
										success: function(response){
											//alert(response);
											var tr_bank ='';
											$msg = response.messages;
											$.each($msg,function(){
												tr_bank +='<tr>';
												tr_bank +='		<td>';
												tr_bank +='		<td class="form-name">';
												tr_bank +='			<input type="text" value="'+$(this)[0].name+'" class="form-control" placeholder="Bank Name"  />';
												tr_bank +='		</td>';
												tr_bank +='		<td class="form-number">';
												tr_bank +='			<input type="text" value="'+$(this)[0].acc_number+'" class="form-control" placeholder="Account Number"  />';
												tr_bank +='		</td>';
												tr_bank +='		<td class="form-owner">';
												tr_bank +='			<input type="text"  value="'+$(this)[0].acc_owner+'" class="form-control" placeholder="Account Owner" />';
												tr_bank +='		</td>';
												tr_bank +='		<td>';
												tr_bank +='			<button type="button" class="btn btn-danger f_delete_bank">Delete</button>';
												tr_bank +='		</td>';
												tr_bank +="<input type='hidden' value="+$(this)[0].id+" class='id_bank'   />";
												tr_bank +='	</tr>';
											});
											$('.f_tbody_bank').html(tr_bank);
										},
										error: function(jqXHR, textStatus, errorThrown){
											alert(errorThrown);
										}
									});
								}
							},
							error: function(jqXHR, textStatus, errorThrown){
								alert(errorThrown);
							}
						},'json');
					});

					</script>
				</div>


			</div>
			<!--<div class="modal-footer">
				<button type="button" class="btn btn-success" data-dismiss="modal">Save</button>
				<!-- <button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
			</div>-->
		</form>
		<!--</div>
	</div>
</div>-->