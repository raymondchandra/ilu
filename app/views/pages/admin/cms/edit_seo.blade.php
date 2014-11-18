
			<h3>
				Seo <!--<button id="f_add_informasi" class="btn btn-success pull-right" style="margin-bottom: 20px;" data-toggle="modal" data-target=".pop_up_add_seo">+ Add New SEO</button>-->
			</h3>
				<div class="modal-body">

					<table class="table table-bordered">
						<thead>
							<tr>
								<th>
									Page
								</th>
								<th>
									Meta Description
								</th>
								<th>
									Meta Keywords
								</th>
							</tr>
						</thead>
						<tbody class="f_tbody_table">




						</tbody>
					</table>
					<script>
						$('body').on('click','span.meta',function(){
							$(this).siblings('.meta').removeClass('hidden');
							$(this).siblings('.meta').val($(this).text());   
							$(this).addClass('hidden');
							//alert('dsa');
						});
						
						$('body').on('change','.content',function(){
							$element = $(this);
							$id = $(this).parent().siblings('.seo_id').val();
							$content = $(this).val();
							$.ajax({
								type: 'PUT',
								url: "{{URL('admin/seo')}}/"+$id,
								data:{
									description:$content
								},
								success: function(response){
									if(response.code == 200){
										alert('Success');
										$element.siblings('.meta').removeClass('hidden');
										$element.siblings('.meta').text($content);   
										$element.addClass('hidden');
									}
								},
								error: function(jqXHR, textStatus, errorThrown){
									alert(errorThrown);
								}
							});
						});
						
						$('body').on('change','.key',function(){
							$element = $(this);
							$id = $(this).parent().siblings('.seo_id').val();
							$key = $(this).val();
							$.ajax({
								type: 'PUT',
								url: "{{URL('admin/seo')}}/"+$id,
								data:{
									keyword:$key
								},
								success: function(response){
									if(response.code == 200){
										alert('Success');
										$element.siblings('.meta').removeClass('hidden');
										$element.siblings('.meta').text($key);   
										$element.addClass('hidden');
									}
								},
								error: function(jqXHR, textStatus, errorThrown){
									alert(errorThrown);
								}
							});
						});

						$('input.meta').keypress(function(event){
							 
								var keycode = (event.keyCode ? event.keyCode : event.which);
								if(keycode == '13'){

									$(this).siblings('span.meta').removeClass('hidden');
									$(this).siblings('span.meta').text($(this).val());   
									$(this).addClass('hidden');
								}
								event.stopPropagation();
							});
							 
					</script>

					<!--<div class="form-group">
						<label class="col-sm-3 control-label">Meta Tag Keywords</label>
						<div class="col-sm-6">
							<input type="text" class="form-control" placeholder="keyword 1, keyword 2, keyword 3, dll">
						</div>
						<div class="col-sm-3">
							<span class="btn btn-danger">
								Maaf form harus diisi
							</span>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Meta Tag Description</label>
						<div class="col-sm-6">
							<textarea class="form-control"></textarea>		
						</div>
						<div class="col-sm-3">
							<span class="btn btn-danger">
								Maaf form harus diisi
							</span>
						</div>
					</div>-->
					
				</div>
				<div class="modal-footer">
					<!--<button type="button" class="btn btn-success" data-dismiss="modal">Ya</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>-->
				</div>

							<!-- modal edit -->
			<div class="modal fade pop_up_add_seo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title title1" id="myModalLabel">Add SEO</h4>
						</div>
						<div class="form-horizontal" role="form">
							<div class="modal-body">


								<div class="form-group" id="nama_edit_cont_info">
									<label class="col-sm-4 control-label">Page Name</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="seo_pg_name">
									</div>
								</div>
								<div class="form-group" id="nama_edit_cont_info">
									<label class="col-sm-4 control-label">Meta Description</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="seo_desc_name">
									</div>
								</div>
								<div class="form-group" id="nama_edit_cont_info">
									<label class="col-sm-4 control-label">Meta Keyword</label>
									<div class="col-sm-7">
										<input type="text" class="form-control" id="seo_key_name">
									</div>
								</div>


							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success f_tbody_table_save" data-dismiss="modal">Save</button>
								<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			<script>
				$('body').on('click','.f_tbody_table_save',function(){
					var tr_seo = '<tr>';
					tr_seo +='	<td>';
					tr_seo +=''+ $('#seo_pg_name').val() +'';
					tr_seo +='	</td>';
					tr_seo +='	<td>';
					tr_seo +='		<span class="meta">'+ $('#seo_desc_name').val() +'</span>';
					tr_seo +='		<input type="text" class="form-control hidden meta">';
					tr_seo +='	</td>';
					tr_seo +='	<td>';
					tr_seo +='		<span class="meta">'+ $('#seo_key_name').val() +'</span>';
					tr_seo +='		<input type="text" class="form-control hidden meta">';
					tr_seo +='	</td>';
					tr_seo +='</tr>';
				
				//alert(tr_seo);
				$('.f_tbody_table').append(tr_seo);});
			</script>

