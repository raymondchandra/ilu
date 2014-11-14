@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			
			<div class="s_title_n_control">
				<h3 style="float: left;">
					Edit Informasi
				</h3>
			</div>
			<span class="clearfix"></span>
			<hr></hr> 

			<div>
				<!-- <ul class="pagination">
					<li><a href="#">&laquo;</a></li>
					<li><a href="#">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li><a href="#">4</a></li>
					<li><a href="#">5</a></li>
					<li><a href="#">&raquo;</a></li>
				</ul> -->
				<!-- <button class="btn btn-success" style="float: right; margin-top: 20px;"  data-toggle="modal" data-target=".pop_up_add_tax">+ Add New Tax</button> -->

				<div class="row">
					

					<div class="col-sm-12">
						<div class="pull-left" style="width: 20%;">
							<style>
							.nav-tabs > li {
								width: 100%;
							}
							.nav-tabs > li > a {
								border-top: 1px solid #ddd;
								border-bottom: 1px solid #ddd;
								border-left: 1px solid #ddd;
								border-right: 1px solid #ddd;
								border-radius: 4px 4px 4px 4px;
								background-color: #ddd;
							}

							.nav-tabs > li.active > a, .nav-tabs > li.active > a:focus{
								border-top: 1px solid #ddd;
								border-bottom: 1px solid #ddd;
								border-left: 1px solid #ddd;
								border-right: 1px solid #ddd;
								border-radius: 4px 4px 4px 4px;
								background-color: #fff;
							}
							</style>
							<!-- Nav tabs -->
							<ul class="nav nav-tabs" role="tablist" style="border: 0px;">
								<li role="presentation" class="active pull-right"><a href="#0" role="tab" data-toggle="tab" style="">Edit Kontent Informasi</a></li>
								<!--<span class="clearfix "></span>
								<li role="presentation" class="pull-right"><a href="#1" role="tab" data-toggle="tab" style="">Preview Info</a></li>
								<span class="clearfix "></span>
								<li role="presentation" class="pull-right"><a href="#4" id='cms_news' role="tab" data-toggle="tab" style="">News</a></li>
								<span class="clearfix "></span>
								<li role="presentation" class="pull-right"><a href="#5" id='cms_slideshow' role="tab" data-toggle="tab" style="">Slideshow</a></li>-->
							</ul>
						</div>
						<!-- Tab panes -->
						<div class="pull-left" style="width:76%; padding-left:20px; padding-right: 20px;border: 1px solid #676767 !important;">
							<div class="tab-content">
								<div role="tabpanel" class="tab-pane fade in active" id="0">
									<h3>Preview Informasi
										<button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target=".pop_up_detail_info">Add</button>
									</h3>

									<div class="panel panel-default">
										<div class="panel-body">
										@foreach($informations as $info)
											<div class="f_section">
												<div class="f_subtitle_info">	
													<h4>
														{{$info->sub_title}}
														<button type="button" class="btn btn-danger pull-right reset hidden">Reset</button>
														<input type='hidden' />
														<button type="button" class="btn btn-danger pull-right f_section_deleter information_deleter">X</button>
														
														<input type='hidden' class='article_id' value='{{$info->id}}' />
														
														@if($info->content[0].$info->content[1].$info->content[2].$info->content[3] == "<img")
														
														@else
															<button type="button" class="btn btn-warning pull-right f_section_editor edit_article" style="margin-right:10px;">Edit</button>
															<button type="button" class="btn btn-warning pull-right f_section_editor save_article hidden" style="margin-right:10px;">Save</button>
														@endif
														
													</h4>	
												</div>		
												<div class="f_konten_info">
													{{$info->content}}
												</div>
											</div>
										@endforeach
										
										<script>
											$('body').on('click','.edit_article',function(){
												$(this).siblings('.save_article').removeClass('hidden');
												$(this).siblings('.reset').removeClass('hidden');
												$('.edit_article').addClass('hidden');
												$('.information_deleter').addClass('hidden');
												$container = $(this).parent().parent().siblings('.f_konten_info');
												$content = $container.html();
												$(this).siblings('.reset').next().val($content);
												$container.html("<br /><textarea id='edit_article'></textarea>");
												tinymce.init({selector:'#edit_article'});
												tinyMCE.activeEditor.setContent($content);
											})
											
											$('body').on('click','.save_article',function(){
												$id = $(this).siblings('.article_id').val();
												$content = tinyMCE.activeEditor.getContent();
												$.ajax({
													type: 'PUT',
													url: "{{URL('admin/information_content')}}/"+$id,
													data:{
														'content':$content
													},
													success: function(response){
														if(response = 200){
															alert('Success');
															location.reload();
														}
														else{
															alert('Failed');
														}
													},
													error: function(jqXHR, textStatus, errorThrown){
														alert(errorThrown);
													}
												})
											});
											
											$('body').on('click','.reset',function(){
												$(this).siblings('.save_article').addClass('hidden');
												$(this).addClass('hidden');
												$('.edit_article').removeClass('hidden');
												$('.information_deleter').removeClass('hidden');
												
												$container = $(this).parent().parent().siblings('.f_konten_info');
												$container.html($(this).next().val());
											});
											
										</script>
										</div>
									</div>
									<script>
										$('body').on('click','.f_section_deleter',function(){
											$(this).closest('.f_section').remove();
										});
									</script>
									
									<!--<h3>Detail Informasi
										<button type="button" class="btn btn-success f_add_new_section pull-right" >
											Add New Section
										</button>
									</h3>
									<hr></hr>-->
									<!--
									<div class="form-horizontal" role="form">	


										

										<div class="f_section_container">
											<div class="form-group" id="">
												<label class="col-sm-4 control-label">Judul Section</label>
												<div class="col-sm-7">
													<input type="text" class="form-control" id="">
												</div>
											</div>

											<div class="form-group" id="">
												<label class="col-sm-4 control-label">Metoda Pengisian Data</label>
												<div class="col-sm-7">
													<label class="radio-inline">
														<input type="radio" name="metode_pengisian0" id="inlineRadio1" value="gambar0" checked> Gambar
													</label>
													<label class="radio-inline">
														<input type="radio" name="metode_pengisian0" id="inlineRadio2" value="deskripsi0"> Deskripsi
													</label>
												</div>
											</div>

											<div class="form-group" id="gambar_edit_cont_info0">
												<label class="col-sm-4 control-label" >Upload Gambar</label>
												<div class="col-sm-7">
													<img srs="" width="200" height="200"/>
													<input type="file" class="" id="">
												</div>
											</div>

											<div class="form-group hidden" id="deskripsi_edit_cont_info0">
												<label class="col-sm-4 control-label" >Tulis Deskripsi</label>
												<div class="col-sm-7">
													<textarea id="deskripsi_edit_info0"></textarea>
												</div>
											</div>
										</div>

										<div class="f_section_container_appenden">

										</div>

										<script>
										var i=0;
										tinymce.init({selector:'#deskripsi_edit_info0'});

										$('body').on('click','.f_add_new_section', function(){
											i++;

											var new_add_info ='<div class="f_section_container">';
											new_add_info +='<div class="form-group" id="">';
											new_add_info +='	<label class="col-sm-4 control-label">Judul Section </label>';
											new_add_info +='	<div class="col-sm-6">';
											new_add_info +='		<input type="text" class="form-control" id="">';
											new_add_info +='	</div>';
											new_add_info +='	<div class="col-sm-1">';
											new_add_info +='		<button type="button" class="btn btn-danger f_section_info_deleter" >';
											new_add_info +='			<span class="glyphicon glyphicon-remove"></span>';
											new_add_info +='		</button>';
											new_add_info +='	</div>';
											new_add_info +='</div>';

											new_add_info += '<div class="form-group" id="">';
											new_add_info += '	<label class="col-sm-4 control-label">Metoda Pengisian Data</label>';
											new_add_info += '	<div class="col-sm-7">';
											new_add_info += '		<label class="radio-inline">';
											new_add_info += '			<input type="radio" name="metode_pengisian" id="inlineRadio1" value="gambar" checked> Gambar';
											new_add_info += '		</label>';
											new_add_info += '		<label class="radio-inline">';
											new_add_info += '			<input type="radio" name="metode_pengisian" id="inlineRadio2" value="deskripsi"> Deskripsi';
											new_add_info += '		</label>';
											new_add_info += '	</div>';
											new_add_info += '</div>';

											new_add_info +=' <div class="form-group gambar_edit_cont_info">';
											new_add_info +=' 	<label class="col-sm-4 control-label" >Upload Gambar</label>';
											new_add_info +=' 	<div class="col-sm-7">';
											new_add_info +=' 		<img srs="" width="200" height="200"/>';
											new_add_info +=' 		<input type="file" class="" id="">';
											new_add_info +=' 	</div>';
											new_add_info +=' </div>';

											new_add_info +='<div class="form-group hidden deskripsi_edit_cont_info">';
											new_add_info +='	<label class="col-sm-4 control-label" >Tulis Deskripsi</label>';
											new_add_info +='	<div class="col-sm-7">';
											new_add_info +='		<textarea id="deskripsi_edit_info'+i+'"></textarea>';
											new_add_info += '</div>';
											new_add_info += '</div>';
											new_add_info += '</div>';

											var s = document.createElement("script");
											s.type = "text/javascript";
											s.innerHTML = "tinymce.init({selector:'#deskripsi_edit_info"+i+"'});";


											$('.f_section_container_appenden').append(new_add_info).append(s);

										});

														//Untuk men-delete section info
														$('body').on('click','.f_section_info_deleter',function(){
															$(this).closest('.f_section_container').remove();
														});

														//Untuk men-delete section info pada saat di-close
														$('.pop_up_detail_info').on('hidden.bs.modal', function (e) {
															$(this).find('.f_section_container_appenden > .f_section_container').remove();
														})

														$('body').on('change', 'input:radio[name="metode_pengisian0"]', function() {
															if ($(this).is(':checked') && $(this).val() == 'gambar0') {
																$('#deskripsi_edit_cont_info0').addClass('hidden');
																$('#gambar_edit_cont_info0').removeClass('hidden');
															}else{
																$('#deskripsi_edit_cont_info0').removeClass('hidden');
																$('#gambar_edit_cont_info0').addClass('hidden');
															}

														});

														$('body').on('change', 'input:radio[name="metode_pengisian"]', function() {
															if ($(this).is(':checked') && $(this).val() == 'gambar') {
																$(this).parent().parent().parent().siblings('.deskripsi_edit_cont_info').addClass('hidden');
																$(this).parent().parent().parent().siblings('.gambar_edit_cont_info').removeClass('hidden');
															}else{
																$(this).parent().parent().parent().siblings('.deskripsi_edit_cont_info').removeClass('hidden');
																$(this).parent().parent().parent().siblings('.gambar_edit_cont_info').addClass('hidden');
															}

														});
														
														$('body').on('click','.delete_info',function(){
															$id = $(this).prev().val();
															$('#deleted_id').val($id);
														})
														</script>



														<div class="modal-footer">
															<button type="button" class="btn btn-success" data-dismiss="modal">Update Info Baru</button>
															<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
														</div>
													</div>			
												</div>
												<!--<div role="tabpanel" class="tab-pane fade" id="1">
															d				
												</div>
												<div role="tabpanel" class="tab-pane fade" id="2">
													{{-- @include('pages.admin.cms.edit_seo') --}}							
												</div>
												<div role="tabpanel" class="tab-pane fade" id="3">
													{{-- @include('pages.admin.cms.edit_bank_info') --}}
												</div>-->
								
								<!-- <div role="tabpanel" class="tab-pane fade" id="4">
									{{-- @include('pages.admin.cms.edit_news')	--}}						
								</div>
								<div role="tabpanel" class="tab-pane fade" id="5">
									{{-- @include('pages.admin.cms.edit_slideshow')	--}}						
								</div> -->
							</div>
						</div>
					</div>
				</div>




				<!-- <table class="table table-striped table-hover ">
					<thead class="table-bordered">
						<tr>
							<th class="table-bordered">
								<a href="javascript:void(0)">Name</a>
								<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
								</a>
							</th>
							<th class="table-bordered">

							</th>
						</thead>
						<thead>
							<tr>
								<td><input type="text" class="form-control input-sm"></td>

								<td width=""><a class="btn btn-primary btn-xs">Filter</a></td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Header Title</td>

								<td>
									<button class="btn btn-warning btn-xs" data-toggle="modal" data-target=".pop_up_edit_company_info">Edit</button>
								</td>
							</tr> 
							<tr>
								<td>SEO</td>

								<td>
									<button class="btn btn-warning btn-xs" data-toggle="modal" data-target=".pop_up_edit_seo">Edit</button>
								</td>
							</tr> 
						</tbody>
					</table> -->
				</div>

			</div>
		</div>
	</div>

	<!-- modal add -->
			<div class="modal fade pop_up_detail_info" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
							<h4 class="modal-title title1" id="myModalLabel">Detail Informasi</h4>
						</div>
						<div class="form-horizontal" role="form">	
							
							<div class="modal-body">

							<!--<button type="button" class="btn btn-success f_add_new_section" >
								Add New Section
							</button>-->

								<div class="f_section_container">
									<div class="form-group" id="">
										<label class="col-sm-4 control-label">Judul Section</label>
										<div class="col-sm-7">
											<input type="text" class="form-control" id="section_title">
										</div>
									</div>

									<div class="form-group" id="">
										<label class="col-sm-4 control-label">Metoda Pengisian Data</label>
										<div class="col-sm-7">
											<label class="radio-inline">
												<input type="radio" name="metode_pengisian0" id="inlineRadio1" value="gambar0" checked> Gambar
											</label>
											<label class="radio-inline">
												<input type="radio" name="metode_pengisian0" id="inlineRadio2" value="deskripsi0"> Deskripsi
											</label>
										</div>
									</div>

									<div class="form-group" id="gambar_edit_cont_info0">
										<label class="col-sm-4 control-label" >Upload Gambar</label>
										<div class="col-sm-7">
											<img src="" id='preview_image' width="200" height="200"/>
											<input type="file" class="" id="image_uploader">
										</div>
									</div>

									<div class="form-group hidden" id="deskripsi_edit_cont_info0">
										<label class="col-sm-4 control-label" >Tulis Deskripsi</label>
										<div class="col-sm-7">
											<textarea id="deskripsi_edit_info0"></textarea>
										</div>
									</div>
								</div>
								
								<!--<div class="f_section_container_appenden">

								</div>-->

								<script>
								var i=0;
								tinymce.init({selector:'#deskripsi_edit_info0'});

								$('body').on('click','.f_add_new_section', function(){
									i++;

							var new_add_info ='<div class="f_section_container">';
									new_add_info +='<div class="form-group" id="">';
									new_add_info +='	<label class="col-sm-4 control-label">Judul Section </label>';
									new_add_info +='	<div class="col-sm-6">';
									new_add_info +='		<input type="text" class="form-control" id="">';
									new_add_info +='	</div>';
									new_add_info +='	<div class="col-sm-1">';
									new_add_info +='		<button type="button" class="btn btn-danger f_section_info_deleter" >';
									new_add_info +='			<span class="glyphicon glyphicon-remove"></span>';
									new_add_info +='		</button>';
									new_add_info +='	</div>';
									new_add_info +='</div>';

									new_add_info += '<div class="form-group" id="">';
									new_add_info += '	<label class="col-sm-4 control-label">Metoda Pengisian Data</label>';
									new_add_info += '	<div class="col-sm-7">';
									new_add_info += '		<label class="radio-inline">';
									new_add_info += '			<input type="radio" name="metode_pengisian" id="inlineRadio1" value="gambar" checked> Gambar';
									new_add_info += '		</label>';
									new_add_info += '		<label class="radio-inline">';
									new_add_info += '			<input type="radio" name="metode_pengisian" id="inlineRadio2" value="deskripsi"> Deskripsi';
									new_add_info += '		</label>';
									new_add_info += '	</div>';
									new_add_info += '</div>';

									new_add_info +=' <div class="form-group gambar_edit_cont_info">';
									new_add_info +=' 	<label class="col-sm-4 control-label" >Upload Gambar</label>';
									new_add_info +=' 	<div class="col-sm-7">';
									new_add_info +=' 		<img srs="" width="200" height="200"/>';
									new_add_info +=' 		<input type="file" class="" id="">';
									new_add_info +=' 	</div>';
									new_add_info +=' </div>';

									new_add_info +='<div class="form-group hidden deskripsi_edit_cont_info">';
									new_add_info +='	<label class="col-sm-4 control-label" >Tulis Deskripsi</label>';
									new_add_info +='	<div class="col-sm-7">';
									new_add_info +='		<textarea id="deskripsi_edit_info'+i+'"></textarea>';
									new_add_info += '</div>';
									new_add_info += '</div>';
								new_add_info += '</div>';

								var s = document.createElement("script");
								s.type = "text/javascript";
								s.innerHTML = "tinymce.init({selector:'#deskripsi_edit_info"+i+"'});";


									$('.f_section_container_appenden').append(new_add_info).append(s);

								});
								
								//Untuk men-delete section info
								$('body').on('click','.information_deleter',function(){
									$id = $(this).next().val();
									$.ajax({
										type: 'DELETE',
										url: "{{URL('admin/information_content')}}/"+$id,
										success: function(response){
											if(response = 200){
												alert('Success');
												$(this).closest('.f_section').remove();
											}
											else{
												alert('Failed');
											}
										},
										error: function(jqXHR, textStatus, errorThrown){
											alert(errorThrown);
										}
									})
								});

								//Untuk men-delete section info pada saat di-close
								$('.pop_up_detail_info').on('hidden.bs.modal', function (e) {
								  $(this).find('.f_section_container_appenden > .f_section_container').remove();
								})

								$('body').on('change', 'input:radio[name="metode_pengisian0"]', function() {
									if ($(this).is(':checked') && $(this).val() == 'gambar0') {
										$('#deskripsi_edit_cont_info0').addClass('hidden');
										$('#gambar_edit_cont_info0').removeClass('hidden');
									}else{
										$('#deskripsi_edit_cont_info0').removeClass('hidden');
										$('#gambar_edit_cont_info0').addClass('hidden');
									}
								});
								
								

								$('body').on('change', 'input:radio[name="metode_pengisian"]', function() {
									if ($(this).is(':checked') && $(this).val() == 'gambar') {
										$(this).parent().parent().parent().siblings('.deskripsi_edit_cont_info').addClass('hidden');
										$(this).parent().parent().parent().siblings('.gambar_edit_cont_info').removeClass('hidden');
									}else{
										$(this).parent().parent().parent().siblings('.deskripsi_edit_cont_info').removeClass('hidden');
										$(this).parent().parent().parent().siblings('.gambar_edit_cont_info').addClass('hidden');
									}

								});
								
								$('body').on('click','.delete_info',function(){
									$id = $(this).prev().val();
									$('#deleted_id').val($id);
								})
								</script>



							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-success add_information_content" data-dismiss="modal">Tambah Info Baru</button>
								<input type='hidden' value='{{$informations[0]->id_information}}' />
								<button type="button" class="btn btn-default " data-dismiss="modal">Keluar</button>
							</div>
						</div>
					</div>
				</div>
			</div>
	<script>
		//var asd = $()
		$('body').on('click','[data-dismiss="modal"]', function(){
			$('.modal-backdrop').removeClass('in');
			setTimeout(function() {
				$('.modal-backdrop').fadeOut( 300, function(){});
			}, 500);
		});

		$('body').on('click','[aria-hidden="true"]', function(){
			$('.modal-backdrop').removeClass('in');
			setTimeout(function() {
				$('.modal-backdrop').fadeOut( 300, function(){});
			}, 500);
		});
		
		var uploaded_image = '';
		$('#image_uploader').change(function(){
			var i = 0, len = this.files.length, img, reader, file;
			for ( ; i < len; i++ ){
				file = this.files[i];
				if (!!file.type.match(/image.*/)) {
					if ( window.FileReader ) {
						reader = new FileReader();
						reader.onloadend = function (e) {
							$('#preview_image').attr('src',e.target.result);
						};
						reader.readAsDataURL(file);
					}
				}
				uploaded_image = file;
			}
		});
		
		$('body').on('click','.add_information_content',function(){
			$type='';
			$id_information = $(this).next().val();
			$title = $('#section_title').val();
			$form_data = new FormData();
			$form_data.append('title',$title);
			if($('#inlineRadio1').is(':checked')){
				$form_data.append('image',uploaded_image);
				$form_data.append('type',0);
			}
			else{
				$content = tinyMCE.activeEditor.getContent();
				$form_data.append('content',$content);
				$form_data.append('type',1);
			}
			
			$.ajax({
				type: 'POST',
				url: "{{URL('admin/information_content')}}/"+$id_information,
				data:$form_data,
				processData:false,
				contentType:false,
				success: function(response){
					if(response = 200){
						alert('Success');
						location.reload();
					}
					else{
						alert('Failed');
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert(errorThrown);
				}
			})
		});
		
		/*$('body').on('click','#cms_news',function(){
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/news')}}",
				success: function(response){
					$msgs = response.messages;
					var div="";
					$($msgs).each(function(){
						//alert($(this)[0].id);
						div+="<tr>";
						div+="<td class='news_title'>";
						div+=$(this)[0].title;
						div+="</td>";
						div+="<td>";
						div+="<input type='hidden' value='"+$(this)[0].id+"'>";
						div+="<button type='button' class='btn btn-success view_detail' data-toggle='modal' data-target='.pop_up_edit_news'>Detail</button>";
						div+="<input type='hidden' value='"+$(this)[0].description+"'>";
						div+="</td>";
						div+="</tr>";
					});
					
					$('.f_news_table').html(div);
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert(errorThrown);
				}
			})
		});
		
		$('body').on('click','#cms_slideshow',function(){
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/slideshow')}}",
				success: function(response){
					if(response.code == 404){
						
					}
					else{
						var msgs = response.messages;
						var div = '';
						$(msgs).each(function(){
							div+="<tr>";
							div+="<td class='photo_preview'>";
							div+="<img src='"+$(this)[0].photo_path+"' class='preview_image' width='160' height='120' alt=''/>";
							div+="</td>";
							div+="<td>";
							div+="<button class='btn btn-warning edit_slideshow' data-toggle='modal' data-target='.pop_up_edit_image'>";
							div+="Edit";
							div+="</button>";
							div+="<input type='hidden' value='"+$(this)[0].id+"' />";
							div+="<button class='btn btn-danger delete_slideshow' data-toggle='modal' data-target='.pop_up_delete_image'>";
							div+="Delete";
							div+="</button>";
							div+="</td>";
							div+="</tr>";
						});
						$('.f_tbody_slideshow').html(div);
					}
					
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert(errorThrown);
				}
			});
		});
		
		$('body').on('click','#cms_bank',function(){
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
		});
		
		$('body').on('click','#cms_seo',function(){
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/seo')}}",
				success: function(response){
					$msgs = response.messages;
					var tr_seo="";
					$.each($msgs,function(){
						//alert($(this)[0].id);
						tr_seo += '<tr>';
						tr_seo +='	<td>';
						tr_seo +=''+ $(this)[0].name +'';
						tr_seo +='	</td>';
						tr_seo +='	<td>';
						tr_seo +='		<span class="meta">'+ $(this)[0].content +'</span>';
						tr_seo +='		<input type="text" class="form-control hidden meta">';
						tr_seo +='	</td>';
						tr_seo +='	<td>';
						tr_seo +='		<span class="meta">'+ $(this)[0].key +'</span>';
						tr_seo +='		<input type="text" class="form-control hidden meta">';
						tr_seo +='	</td>';
						tr_seo +='</tr>';
					});
					
					$('.f_tbody_table').html(tr_seo);
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert(errorThrown);
				}
			});
		});*/
		</script>

@include('includes.modals.alertYesNo')	
@include('pages.admin.cms.pop_up_edit_container_info')	

@stop