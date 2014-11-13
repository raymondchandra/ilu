@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	


<link href="{{ asset('assets/js/jqte/jquery-te-1.4.0.css') }}" rel="stylesheet">
<script src="{{ asset('assets/js/jqte/jquery-te-1.4.0.min.js') }}"></script>

<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			
			<div class="s_title_n_control">
				<h3 style="float: left;">
					Ticketing Messages
				</h3>
			</div>
			<span class="clearfix"></span>
			<hr></hr>

			<div>
				<div class="row">
					<div class="col-sm-3">
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
						<ul class="nav nav-tabs f_height_display" role="tablist" style="border: 0px; overflow-y: scroll;">
							<li role="presentation" class="active pull-right">
								<a href="#0" role="tab" data-toggle="tab" style="">
									<b class="show">Nama Seseorang 0</b>
									<span class="show">Ticket #: 123211</span>
									<span>Subjectnya taruh disini</span>
								</a>
							</li>
							<?php
							for($i=1; $i<16; $i++){
								?>
								<li role="presentation" class="pull-right">
									<a href="#<?php echo($i); ?>" role="tab" data-toggle="tab" style="">
										<b class="show">Nama Seseorang <?php echo($i); ?></b>
										<span class="show">Ticket #: 123211</span>
										<span>Subjectnya taruh disini</span>
									</a>
								</li>
								<span class="clearfix "></span>
								<?php
							}
							?>
						</ul>
					</div>
					<div class="col-sm-9">
						<!-- Tab panes -->
						<div class="tab-content f_height_display" style="overflow-y: scroll;">

							<div role="tabpanel" class="tab-pane fade in active" id="0">
								<div class="col-lg-8 col-lg-push-2">
									<div>
										<b class="show">Nama: Nama Seseorang 0</b>
										<span class="show">Email: epic0@gmail.com</span>
										<span class="show">Ticket #: 123211</span>
										<span>Subject: Subjectnya taruh disini</span>
										<span class="pull-right">12.30</span>

										<p style="margin-top: 20px;">
											It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
										</p>
									<hr></hr>
									</div>
									<div class="msg_area">
									</div>
									<div>
										<textarea class="form-control f_message_textinput" id="0" rows="3"></textarea>
										<div class="checkbox">
										    <label>
										      	<input type="checkbox"> Solved
										    </label>
											<button type="button" class="btn btn-success pull-right f_message_textbtn" style="margin-top: 20px;">
												Send
											</button>
										</div>
									</div>
								</div>
							</div>
							<?php
							for($i=1; $i<16; $i++){
								?>
								<div role="tabpanel" class="tab-pane fade in" id="<?php echo($i); ?>">

									<div class="col-lg-8 col-lg-push-2">
										<div>
											<b class="show">Nama: Nama Seseorang <?php echo($i); ?></b>
											<span class="show">Email: epic<?php echo($i); ?>@gmail.com</span>
										<span class="show">Ticket #: 123211</span>
											<span>Subject: Subjectnya taruh disini</span>
											<span class="pull-right">12.30</span>

											<p style="margin-top: 20px;">
												It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
											</p>
										<hr></hr>
									</div>
									<div class="msg_area">
									</div>
									<div>
										<textarea class="form-control f_message_textinput" id="0" rows="3"></textarea>
										<div class="checkbox">
										    <label>
										      	<input type="checkbox"> Solved
											</label>
											<button type="button" class="btn btn-success pull-right f_message_textbtn" style="margin-top: 20px;">
												Send
											</button>
										</div>
									</div>								
									</div>

								</div>
								<?php
							}
							?>

						</div>

									<script>
									$('body').on('click','.f_message_textbtn',function(){
										var id=$('.f_message_textinput').attr('id');

										var text='<div>';
										text+='<b class="show">Nama: Administrator</b>';
										text+='<span class="show">Email: admin@ilu.com</span>';
										text+='<span class="show">Ticket #: 324234</span>';
										text+='<span>Subject: Re-Subjectnya taruh disini</span>';
										text+='<span class="pull-right">timestamp</span>';
										text+='<p style="margin-top: 20px;">';
										text+=''+ $(this).parent().siblings("textarea").val(); +'';
										text+='</p>';
										text+='</div>';
										text+='<hr></hr>';

										$(this).parent().parent().siblings('.msg_area').append(text);


									});
									</script>
					</div>
				</div>


			</div>

		</div>
	</div>
</div>

<script>
	$("textarea").jqte();
</script>

@include('includes.modals.alertYesNo')	

@stop