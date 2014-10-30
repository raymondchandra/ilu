@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
				<div class="container-fluid">
					<div class="row ">
						<div class="col-lg-12">
							<div class="s_title_n_control">
								<h3 style="float: left;">
									Login
								</h3>
								<!--<a href="index.php" class="btn btn-default" style="float: right; margin-top: 20px; margin-right: 10px;">Back</a> -->
							</div>
							<span class="clearfix"></span>
							<hr></hr>
							<div class="s_tbl s_set_height_window">
								<div class="s_cl">
									<div class="col-lg-6 col-lg-push-3">
									
										<p class="bg-danger hidden" style="padding-top: 10px; padding-bottom: 10px; margin-bottom: 20px;">Maaf username/password anda salah!</p>
										
										<div class="panel panel-default">
											<div class="panel-heading">
												<h3 class="panel-title">Login to Admin Panel</h3>
											</div>
											<div class="panel-body">
												<form class="form-horizontal" role="form">
													<div class="form-group">
														<label for="inputEmail3" class="col-sm-3 control-label">Username/Email</label>
														<div class="col-sm-6">
															<input type="text" class="form-control" placeholder="Username/Email" id="username">	
														</div>
													</div>
												  
													<div class="form-group">
														<label for="inputPassword3" class="col-sm-3 control-label">Password</label>
														<div class="col-sm-6">
															<input type="password" class="form-control" placeholder="Password" id="password">	
														</div>
													</div>
												  
													<div class="form-group">
														<div class=" g-sm-3 g-sm-push-3">
															<button type="button" class="btn btn-warning flogin">Login</button>
														</div>
													</div>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			
<script>
	
	$('body').on('click','.flogin',function(){
		$data = {
			'username' : $('#username').val(),
			'password' : $('#password').val()
		}
		$json_data = JSON.stringify($data);
		$.ajax({
			url: '{{URL::route('david.adminSignIn')}}',
			type: 'GET',
			data: {
				'json' : $json_data
			},
			success: function (res) {
				if(res['code'] == 200)
				{
					window.location = "{{URL::route('ilu.main.dashboard')}}" ;
				}
				else
				{
					alert("unauthorized");
				}
			},
			error: function(xhr, textStatus, errorThrown){
					alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
					alert("responseText: "+xhr.responseText);
			}
		},'json');	
	});
</script>
			@stop
