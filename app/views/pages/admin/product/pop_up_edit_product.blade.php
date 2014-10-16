<div class="modal fade pop_up_edit_product" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Product Info</h4>
			</div>
			<form class="form-horizontal" role="form">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12">

							<div class="form-group" id="nama_promosi">
								<label class="col-sm-4 control-label">ID</label>
								<div class="col-sm-8">
									<p class="form-control-static">0000000</p>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Product No.</label>
								<div class="col-sm-5">
									<p id="product_no" class="form-control-static">00045383945</p>
									<input id="product_no_input" class="form-control hidden"/>
								</div>
								<div class="col-sm-3">
									<button type="button" class="btn btn-warning" id="product_no_editor">Edit</button>
									<button type="button" class="btn btn-success hidden" id="product_no_setter">Set</button>
									<script>
									$( 'body' ).on( "click",'#product_no_editor', function() {
										$('#product_no_input').val($('#product_no').text());
										$('#product_no_input').removeClass('hidden');
										$('#product_no_setter').removeClass('hidden');
										$('#product_no').addClass('hidden');
										$('#product_no_editor').addClass('hidden');
									});

									$( 'body' ).on( "click",'#product_no_setter', function() {
										var selectedStatus = $('#product_no_input').val();
										$('#product_no_input').addClass('hidden');
										$('#product_no_setter').addClass('hidden');
										$('#product_no').removeClass('hidden');
										$('#product_no_editor').removeClass('hidden');
										$('#product_no').text(selectedStatus);
									});
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Name</label>
								<div class="col-sm-5">
									<p id="product_name" class="form-control-static">fsddsf</p>
									<input id="product_name_input" class="form-control hidden"/>
								</div>
								<div class="col-sm-3">
									<button type="button" class="btn btn-warning" id="product_name_editor">Edit</button>
									<button type="button" class="btn btn-success hidden" id="product_name_setter">Set</button>
									<script>
									$( 'body' ).on( "click",'#product_name_editor', function() {
										$('#product_name_input').val($('#product_name').text());
										$('#product_name_input').removeClass('hidden');
										$('#product_name_setter').removeClass('hidden');
										$('#product_name').addClass('hidden');
										$('#product_name_editor').addClass('hidden');
									});

									$( 'body' ).on( "click",'#product_name_setter', function() {
										var selectedStatus = $('#product_name_input').val();
										$('#product_name_input').addClass('hidden');
										$('#product_name_setter').addClass('hidden');
										$('#product_name').removeClass('hidden');
										$('#product_name_editor').removeClass('hidden');
										$('#product_name').text(selectedStatus);
									});
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Description</label>
								<div class="col-sm-5">
									<p id="product_description" class="form-control-static">fsddsf</p>
									<textarea id="product_description_area" class="form-control hidden"></textarea>
								</div>
								<div class="col-sm-3">
									<button type="button" class="btn btn-warning" id="product_description_editor">Edit</button>
									<button type="button" class="btn btn-success hidden" id="product_description_setter">Set</button>
									<script>
									$( 'body' ).on( "click",'#product_description_editor', function() {
										$('#product_description_area').text($('#product_description').text());
										$('#product_description_area').removeClass('hidden');
										$('#product_description_setter').removeClass('hidden');
										$('#product_description').addClass('hidden');
										$('#product_description_editor').addClass('hidden');
									});

									$( 'body' ).on( "click",'#product_description_setter', function() {
										var selectedStatus = $('#product_description_area').val();
										$('#product_description_area').addClass('hidden');
										$('#product_description_setter').addClass('hidden');
										$('#product_description').removeClass('hidden');
										$('#product_description_editor').removeClass('hidden');
										$('#product_description').text(selectedStatus);
									});
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Category</label>
								<div class="col-sm-5">
									<p id="product_category" class="form-control-static">Kategori 0</p>
									<select id="product_category_list" class="form-control hidden">
										<option val="">Kategori 0</option>
										<option val="">Kategori 1</option>
										<option val="">Kategori 2</option>
										<option val="">Kategori 3</option>
										<option val="">Kategori 4</option>
									</select>
								</div>
								<div class="col-sm-3">
									<button type="button" class="btn btn-warning" id="product_category_editor">Edit</button>
									<button type="button" class="btn btn-success hidden" id="product_category_setter">Set</button>
									<script>
									$( 'body' ).on( "click",'#product_category_editor', function() {
										$('#product_category_list').removeClass('hidden');
										$('#product_category_setter').removeClass('hidden');
										$('#product_category').addClass('hidden');
										$('#product_category_editor').addClass('hidden');
									});

									$( 'body' ).on( "click",'#product_category_setter', function() {
										var selectedStatus = $('#product_category_list').find(":selected").text();
										$('#product_category_list').addClass('hidden');
										$('#product_category_setter').addClass('hidden');
										$('#product_category').removeClass('hidden');
										$('#product_category_editor').removeClass('hidden');
										$('#product_category').text(selectedStatus);
									});
									</script>
								</div>
							</div>

							<div class="form-group">
								<label class="col-sm-4 control-label">Promotion ID</label>
								<div class="col-sm-5">
									<p id="promotion_id" class="form-control-static">Promotion ID 0</p>
									<select id="promotion_id_input" class="form-control hidden">
										<option val="">Promotion ID 0</option>
										<option val="">Promotion ID 1</option>
										<option val="">Promotion ID 2</option>
										<option val="">Promotion ID 3</option>
										<option val="">Promotion ID 4</option>
									</select>
								</div>
								<div class="col-sm-3">
									<button type="button" class="btn btn-warning" id="promotion_id_editor">Edit</button>
									<button type="button" class="btn btn-success hidden" id="promotion_id_setter">Set</button>
									<script>
									$( 'body' ).on( "click",'#promotion_id_editor', function() {
										$('#promotion_id_input').removeClass('hidden');
										$('#promotion_id_setter').removeClass('hidden');
										$('#promotion_id').addClass('hidden');
										$('#promotion_id_editor').addClass('hidden');
									});

									$( 'body' ).on( "click",'#promotion_id_setter', function() {
										var selectedStatus = $('#promotion_id_input').find(":selected").text();
										$('#promotion_id_input').addClass('hidden');
										$('#promotion_id_setter').addClass('hidden');
										$('#promotion_id').removeClass('hidden');
										$('#promotion_id_editor').removeClass('hidden');
										$('#promotion_id').text(selectedStatus);
									});
									</script>
								</div>
							</div>

						</div>


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