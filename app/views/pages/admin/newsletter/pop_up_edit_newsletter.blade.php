<div class="modal fade pop_up_edit_newsletter" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Edit Newsletter</h4>
			</div>
			<form class="form-horizontal" role="form">
				<div class="modal-body">
					
					<div class="form-group">
						<label class="col-sm-3 control-label">Template Name *</label>
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
						<label class="col-sm-3 control-label">Template Subject *</label>
						<div class="col-sm-6">
							<textarea class="form-control" rows="5"></textarea>			
						</div>
						<div class="col-sm-3">
							<span class="btn btn-danger">
								Maaf form harus diisi
							</span>
						</div>
					</div>
				  	<!--
					<div class="form-group">
						<label class="col-sm-3 control-label">Sender Name *</label>
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
						<label class="col-sm-3 control-label">Sender Email *</label>
						<div class="col-sm-6">
							<textarea class="form-control" rows="5"></textarea>			
						</div>
						<div class="col-sm-3">
							<span class="btn btn-danger">
								Maaf form harus diisi
							</span>
						</div>
					</div>
				-->
				<div class="form-group">
					<label class="col-sm-3 control-label">Template Editor *</label>
					<div class="col-sm-6">
						<script type="text/javascript">
						tinymce.init({
							selector: ".te"
						});
						</script>
						<style>
						</style>
						<textarea class="te"></textarea>

					</div>
					<div class="col-sm-3">
						<span class="btn btn-danger">
							Maaf form harus diisi
						</span>
					</div>
				</div>


					<!-- <div class="form-group">
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
					</script> -->
					

					
					

					




				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-success" data-dismiss="modal">Ya</button>
					<button type="button" class="btn btn-primary" data-dismiss="modal">Tidak</button>
				</div>
			</form>
		</div>
	</div>
</div>