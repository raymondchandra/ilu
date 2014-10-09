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
									<h3 class="panel-title">Images</h3>
								</div>
								<div class="panel-body">
								
									
								
											<form class="form-horizontal" role="form">
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