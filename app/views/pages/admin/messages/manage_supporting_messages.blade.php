@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')

<link href="{{ asset('assets/js/jqte/jquery-te-1.4.0.css') }}" rel="stylesheet">
<script src="{{ asset('assets/js/jqte/jquery-te-1.4.0.min.js') }}"></script>

<script>
	function getMessages(){
		$.ajax({
			type: 'GET',
			url: "{{URL('admin/messages')}}",
			success: function(response){
				$msgs = response.messages;
				var div = '';
				var div2 ='';
				for($i = 0;$i<$msgs.length;$i++){
					if($i==0){
						div+="<li role='presentation' class='active pull-right'>";
						div+="<a href='#0' role='tab' data-toggle='tab' style=''>";
						div+="<b class='show'>"+$msgs[$i].name+"</b>";
						div+="<span>"+$msgs[$i].subject+"</span>";
						div+="</a>";
						div+="</li>";
						
						div2+="<div role='tabpanel' class='tab-pane fade in active' id='0'>";
						div2+="<div class='col-lg-8 col-lg-push-2'>"
						div2+="<div>"
						div2+="<b class='show'>Name: "+$msgs[$i].name+"</b>";
						div2+="<span class='show'>Email: "+$msgs[$i].email+"</span>";
						div2+="<span>Subject: "+$msgs[$i].subject+"</span>";
						div2+="<span class='pull-right'>"+$msgs[$i].created_at+"</span>";
						div2+="<p style='margin-top: 20px;'>";
						div2+=$msgs[$i].text;
						div2+="</p>";
						div2+="<hr></hr>"; 
						div2+="</div>";
						div2+="<div class='msg_area'>";
						div2+="</div>";
						div2+="<div>";
						//text editor
						div2+="<textarea class='form-control f_message_textinput' id='0' rows='3'></textarea>";
						div2+="<button type='button' class='btn btn-success pull-right f_message_textbtn' style='margin-top: 20px;'>Send</button>";
						div2+="</div>";
						div2+="</div>";
						div2+="</div>";
					}
					else{
						div+="<li role='presentation' class='pull-right'>";
						div+="<a href='#"+$i+"' role='tab' data-toggle='tab' style=''>";
						div+="<b class='show'>"+$msgs[$i].name+"</b>";
						div+="<span>"+$msgs[$i].subject+"</span>";
						div+="</a>";
						div+="</li>";
						div+="<span class='clearfix'></span>";
						
						div2+="<div role='tabpanel' class='tab-pane fade in' id='"+$i+"'>";
						div2+="<div class='col-lg-8 col-lg-push-2'>"
						div2+="<div>"
						div2+="<b class='show'>Name: "+$msgs[$i].name+"</b>";
						div2+="<span class='show'>Email: "+$msgs[$i].email+"</span>";
						div2+="<span>Subject: "+$msgs[$i].subject+"</span>";
						div2+="<span class='pull-right'>"+$msgs[$i].created_at+"</span>";
						div2+="<p style='margin-top: 20px;'>";
						div2+=$msgs[$i].text;
						div2+="</p>";
						div2+="<hr></hr>";
						div2+="</div>";
						div2+="<div class='msg_area'>";
						div2+="</div>";
						div2+="<div>";
						//text editor
						div2+="<textarea class='form-control f_message_textinput' id='"+$i+"' rows='3'></textarea>";
						div2+="<button type='button' class='btn btn-success pull-right f_message_textbtn' style='margin-top: 20px;'>Send</button>";
						div2+="</div>";
						div2+="</div>";
						div2+="</div>";
					}
				}
				$('.message_list').html(div);
				$('.messages_content').html(div2);
				
		
			$('textarea').jqte();

				/*var te = document.createElement("script");
				te.type = "text/javascript";
				te.innerHTML = "$(textarea').jqte();";
				$('.message_list').append(te);
				$('.messages_content').append(te);*/
			},
			error: function(jqXHR, textStatus, errorThrown){
				alert(errorThrown);
			}
		});
	};
	
	
	jQuery(document).ready(function(){
		getMessages();
		setInterval('getMessages()', 30000);
		$('textarea').jqte();
	});
	
	
</script>
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			
			<div class="s_title_n_control">
				<h3 style="float: left;">
					Supporting Messages
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
							border-right: 1px solid #fff !important;
							border-radius: 4px 4px 4px 4px;
							background-color: #fff;
						}
						</style>
						<!-- Nav tabs -->
						<ul class="nav nav-tabs f_height_display message_list" role="tablist" style="border: 0px; overflow-y: scroll;">
							
						</ul>
					</div>
					<div class="col-sm-9">
						<!-- Tab panes -->
						<div class="tab-content f_height_display messages_content" style="overflow-y: scroll;">

							<div role="tabpanel" class="tab-pane fade in active" id="0">
								<div class="col-lg-8 col-lg-push-2">
									<div>
										<b class="show">Nama: Nama Seseorang 0</b>
										<span class="show">Email: epic0@gmail.com</span>
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
										<button type="button" class="btn btn-success pull-right f_message_textbtn" style="margin-top: 20px;">
											Send
										</button>
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
										<button type="button" class="btn btn-success pull-right f_message_textbtn" style="margin-top: 20px;">
											Send
										</button>
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
										text+='<span>Subject: Re-Subjectnya taruh disini</span>';
										text+='<span class="pull-right">timestamp</span>';
										text+='<p style="margin-top: 20px;">';
										text+=''+ $(this).siblings("textarea").val(); +'';
										text+='</p>';
										text+='</div>';
										text+='<hr></hr>';

										$(this).parent().siblings('.msg_area').append(text);


									});
									</script>
					</div>
				</div>


			</div>

		</div>
	</div>
</div>
<script>
$(document).ready(function(){
setTimeout(function() {
      // Do something after 5 seconds
	$("textarea").jqte();
},500);

});
</script>

@include('includes.modals.alertYesNo')	

@stop