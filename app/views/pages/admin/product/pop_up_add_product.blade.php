<div class="modal fade pop_up_add_product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Add Product</h4>
			</div>
			<form class="form-horizontal" role="form">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">

							<div class="form-group">
								<label class="col-sm-4 control-label">Name</label>
								<div class="col-sm-5">
									<input type="text" class="form-control "/>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Description</label>
								<div class="col-sm-5">
									<textarea class="form-control"></textarea>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Category</label>
								<div class="col-sm-5">
									<select id="" class="form-control ">
										<option val="">Kategori 0</option>
										<option val="">Kategori 1</option>
										<option val="">Kategori 2</option>
										<option val="">Kategori 3</option>
										<option val="">Kategori 4</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Promotion ID</label>
								<div class="col-sm-5">
									<select id="" class="form-control ">
										<option val="">Promotion ID 0</option>
										<option val="">Promotion ID 1</option>
										<option val="">Promotion ID 2</option>
										<option val="">Promotion ID 3</option>
										<option val="">Promotion ID 4</option>
									</select>
								</div>
							</div>
							
							<div class="form-group">
								<label class="col-sm-4 control-label">Product Image</label>
								<div class="col-sm-5">
									<img src="" width="200" height="200">
									<input type="file"/>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Product Galery</label>
								<div class="col-sm-5">
									<button type="button" class="btn btn-primary f_add_product"><span class="glyphicon glyphicon-plus"></span>Add Photo</button>
								</div>
							</div>



						</div>
						<div class="col-sm-8 col-sm-push-2">
							
							<table class="table">
								
								<tbody id="product_promo_list">
									
								</tbody>
							</table>
						</div>
						<script>

					/*
					Script untuk add baris produk
					*/
					$( '.f_add_product' ).on( "click", function() {
						var text =' <tr>';
						text +='		<td><img src="" width="150" height="150" class="pull-right"/></td>';
						text +='		<td><input type="file"></td>';
						text +='		<td><button type="button" class="btn btn-danger f_remove_product"><span class="glyphicon glyphicon-remove"></span></button></td>';
						text +='	</tr>';
						$('#product_promo_list').prepend(text);
						
					});

					/*
					Script untuk remove baris produk
					*/
					$( 'body' ).on( "click",'.f_remove_product', function() {
						$(this).parent().parent().hide(300, function(){ 
							$(this).remove(); 
						});
					});

					</script>

						<!--
						<div class="col-sm-7">
							<div class="panel panel-default">
								<div class="panel-heading">Informasi Pelanggan</div>
								<div class="panel-body">
									<div class="form-group" id="nama_promosi">
										<label class="col-sm-4 control-label">Full Name</label>
										<div class="col-sm-8">
											<p class="form-control-static">Muhaudhashdk Nausahjdgjsa</p>
										</div>
									</div>

									<div class="form-group" id="nama_promosi">
										<label class="col-sm-4 control-label">Name in Profile</label>
										<div class="col-sm-8">
											<p class="form-control-static">Muhaudhashdk</p>
										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Member ID</label>
										<div class="col-sm-8">
											<p class="form-control-static">234234324</p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">No KTP</label>
										<div class="col-sm-8">
											<p class="form-control-static">324234234234234234234234564645645</p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Email</label>
										<div class="col-sm-8">
											<p class="form-control-static">emailweh@on.com</p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Tanggal Lahir</label>
										<div class="col-sm-8">
											<p class="form-control-static">11 Oktober 1950</p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Company Name</label>
										<div class="col-sm-8">
											<p class="form-control-static">PT Gono Gini</p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Company Address</label>
										<div class="col-sm-8">
											<p class="form-control-static">Jl Gono Gini No. 999</p>

										</div>
									</div>

									<div class="form-group">
										<label class="col-sm-4 control-label">Member Since</label>
										<div class="col-sm-8">
											<p class="form-control-static">11 Oktober 2014</p>

										</div>
									</div>

								</div>
							</div>
							
						</div> -->
					</div>



					

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>