<h3>
	Change Password
</h3>
<div class="modal-body">

	<form class="form-horizontal">
		<div class="row">
			<div class="col-lg-2 radioButtonContainer">
				<div class="radio">
					<label>
						<input type="radio" class="templateRadios" name="templateRadios" id="templateView0" value="" checked>
						Template #0
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" class="templateRadios" name="templateRadios" id="templateView1" value="">
						Template #1
					</label>
				</div>
				<div class="radio">
					<label>
						<input type="radio" class="templateRadios" name="templateRadios" id="templateView2" value="">
						Template #2
					</label>
				</div>

				<div class="radio">
					<label>
						<input type="radio" class="templateRadios" name="templateRadios" id="templateView3" value="">
						Template #3
					</label>
				</div>

				<div class="radio">
					<label>
						<input type="radio" class="templateRadios" name="templateRadios" id="templateView4" value="">
						Template #4
					</label>
				</div>

				<div class="radio">
					<label>
						<input type="radio" class="templateRadios" name="templateRadios" id="templateView5" value="">
						Template #5
					</label>
				</div>
			</div>
			<div class="col-lg-10 viewContainer">
				<div class="templateViews" id="templateView0">
				@include('pages.admin.email_template.voucher')
				</div>
				<div class="templateViews hidden" id="templateView1">
				@include('pages.admin.email_template.promo')
				</div>
				<div class="templateViews hidden" id="templateView2">
				@include('pages.admin.email_template.news')
				</div>
				<div class="templateViews hidden" id="templateView3">
				@include('pages.admin.email_template.new_registran')
				</div>
				<div class="templateViews hidden" id="templateView4">
				@include('pages.admin.email_template.message')
				</div>
				<div class="templateViews hidden" id="templateView5">
				@include('pages.admin.email_template.forgot_password')
				</div>
			</div>
		</div>
		<script> 
			//fucntion untuk merubah view currently use template 
			$('body').on('click','.templateRadios',function(){
				var radID = $(this).attr('id');
				$(this).closest('.radioButtonContainer').siblings('.viewContainer').children('#' + radID).removeClass('hidden');
				$(this).closest('.radioButtonContainer').siblings('.viewContainer').children(':not(#' + radID + ')').addClass('hidden');
			});
		</script>
	</form>

</div>
<div class="modal-footer">
	<button type="button" class="btn btn-succes">Select This</button>
</div>


<script>
</script>

