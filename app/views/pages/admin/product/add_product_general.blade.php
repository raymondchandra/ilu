@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')		
				<div class="container-fluid">
					<div class="row">
						<div class="col-lg-12">
							<div class="s_title_n_control">
								<h3 style="float: left;">
									New Product
								</h3>
								<a href="index.php" class="btn btn-default" style="float: right; margin-top: 20px; margin-right: 10px;">Back</a>
							</div>
							<span class="clearfix"></span>
							<hr></hr>
							
							@include('includes.sidebar.manage_product')
							
							<div class="col-lg-10">
							<div class="panel panel-default">
								<div class="panel-heading">
									<h3 class="panel-title">General</h3>
								</div>
								<div class="panel-body">
								
									
								
											<form class="form-horizontal" role="form">
												<div class="form-group">
													<label class="col-sm-3 control-label">Name *</label>
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
													<label class="col-sm-3 control-label">Description *</label>
													<div class="col-sm-6">
														<textarea class="form-control" rows="5"></textarea>			
													</div>
													<div class="col-sm-3">
														<span class="btn btn-danger">
															Maaf form harus diisi
														</span>
													</div>
												</div>
											  
												<div class="form-group">
													<label class="col-sm-3 control-label">Short Description *</label>
													<div class="col-sm-6">
														<textarea class="form-control" rows="5"></textarea>			
													</div>
													<div class="col-sm-3">
														<span class="btn btn-danger">
															Maaf form harus diisi
														</span>
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-sm-3 control-label">Price in IDR *</label>
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
													<label class="col-sm-3 control-label">SKU *</label>
													<div class="col-sm-6">
														<input type="text" class="form-control" >				
													</div>
													<div class="col-sm-3">
														<span class="btn btn-danger">
															Maaf form harus diisi
														</span>
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-sm-3 control-label">Weight</label>
													<div class="col-sm-6">
														<input type="text" class="form-control" >				
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-sm-3 control-label">New from Date</label>
													<div class='input-group date g-sm-6'>
														<input type='text' class="form-control"  id='datepicker00'/>
														<span class="input-group-addon"><span class="glyphicon glyphicon-calendar" ></span>
														</span>
													</div>
												</div>
												<script type="text/javascript">
													$(function () {
														$('#datepicker00').datepicker();
													});
												</script>
												
												<div class="form-group">
													<label class="col-sm-3 control-label">New to Date</label>
													<div class='input-group date g-sm-6'>
														<input type='text' class="form-control"  id='datepicker01'/>
														<span class="input-group-addon"><span class="glyphicon glyphicon-calendar" ></span>
														</span>
													</div>
												</div>
												<script type="text/javascript">
													$(function () {
														$('#datepicker01').datepicker();
													});
												</script> 
												
												<div class="form-group">
													<label for="inputPassword3" class="col-sm-3 control-label">Status *</label>
													<div class="col-sm-6">
														<select class="form-control">
															<option value="one">Enabled</option>
															<option value="two">Disabled</option>
														</select>
													</div>
													<div class="col-sm-3">
														<span class="btn btn-danger">
															Maaf form harus diisi
														</span>
													</div>
												</div>
												
												<div class="form-group">
													<label class="col-sm-3 control-label">URL Key</label>
													<div class="col-sm-6">
														<input type="text" class="form-control" >				
													</div>
												</div>
												
												
												<div class="form-group">
													<label for="inputPassword3" class="col-sm-3 control-label">Visibility *</label>
													<div class="col-sm-6">
														<select class="form-control">
															<option value="one">Catalog</option>
															<option value="two">Search</option>
															<option value="two">Catalog, Search</option>
														</select>
													</div>
													<div class="col-sm-3">
														<span class="btn btn-danger">
															Maaf form harus diisi
														</span>
													</div>
												</div>
												
												
												<div class="form-group">
													<label class="col-sm-3 control-label">Color</label>
													<div class="col-sm-6">
														<input type="text" class="form-control" >				
													</div>
												</div>
											  
												<div class="form-group">
													<div class=" g-sm-3 g-sm-push-3">
														<button type="submit" class="btn btn-warning">continue</button>
													</div>
												</div>
											</form>
								
									</div>
							  </div>
							</div>

							
						</div>
					</div>
				</div>
@stop