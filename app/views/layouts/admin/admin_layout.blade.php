<!DOCTYPE html>
<html lang="en">
	<head>
		@include('includes.head_html')
		
	</head>
	<body>
		<div class="s_orenji_header">
		</div>
		<div class="s_top_header">
			<div class="container-fluid">
				<div class="row">
					<div class="col-lg-4">
						<img src="{{asset('assets/company_logo.jpeg')}}" height="50" width="75" style="float: left; margin-right:20px; margin-top: 10px;"/><h2>
						<?php
								$info = new CompanyInfoManagementController();
								$result = $info->get_company_info();
								if($result == NULL){
									
								}
								else{
									echo $result['company_name'];
								}
						?> Panel</h2>
					</div>
					<div class="col-lg-8" style="line-height: 69px; text-align: right;">
						@if(Auth::check())
							log in as admin | <a href="{{action('AccountsController@postLogout', array())}}">log out</a>
						@endif
					</div>
				</div>
			</div>
		</div>
			
		@include('includes.navigation.admin')
		
		<div id="yield_content" class="s_content_admin">
			@yield('content')
		</div>
			
		<script type="text/javascript">
			function updateSize(){
				// Get the dimensions of the viewport
				var width = $(window).width();
				var height = $(window).height();
				var iHeight = $(window).height() - 270;
				
				$('.s_set_height_window').height(iHeight);
				$('.f_height_display').height(iHeight);
				//$('.irashai').width(width);
				//$('.willkommen').width($('.irashai').width()/2);
				//$('.willkommen').height(height);
				//$('body').css('overflow-x','hidden');//.css('overflow-x','visible');
				//$('body').mousewheel(function(event, delta) {
				//	this.scrollLeft -= (delta * 50);
				//	event.preventDefault();
				//});
			};
			$(document).ready(updateSize);
			$(window).resize(updateSize);
		</script>
		<script>
			var timeout    = 500;
			var closetimer = 0;
			var ddmenuitem = 0;

			function jsddm_open()
			{  jsddm_canceltimer();
			   jsddm_close();
			   ddmenuitem = $(this).find('ul').css('visibility', 'visible');}

			function jsddm_close()
			{  if(ddmenuitem) ddmenuitem.css('visibility', 'hidden');}

			function jsddm_timer()
			{  closetimer = window.setTimeout(jsddm_close, timeout);}

			function jsddm_canceltimer()
			{  if(closetimer)
			   {  window.clearTimeout(closetimer);
				  closetimer = null;}}

			$(document).ready(function()
			{  $('.s_top_nav > li').bind('mouseover', jsddm_open)
			   $('.s_top_nav > li').bind('mouseout',  jsddm_timer)});

			document.onclick = jsddm_close;
		</script>
		<script>
			//Resetter input[type=text] untuk seluruh modal
			$('.modal').on('hidden.bs.modal', function (e) {
			  //alert('modal closed');
			  //-- fungsi untuk me-reset sluruh input[type=text] pada modal --
			  $(this).find('input[type=text]').val('');
			})
		</script>
	</body>
</html>