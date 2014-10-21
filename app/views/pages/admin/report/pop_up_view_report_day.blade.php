<div class="modal fade pop_up_view_report_range" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">Informasi Pemasukan</h4>
			</div>
			<form class="form-horizontal" role="form">
				<div class="modal-body">
					<div class="row">
						<div class="col-sm-12"><!-- col-sm-5 -->

							<div class="form-group has-success has-feedback">
								<label class="col-sm-4 control-label">Dari Tanggal</label>
								<div class='input-group date col-sm-7'>
									<input type='text' class="form-control"  id='datepicker00'/>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar" >
										</span>
									</span>
								</div>
							</div>
							<script type="text/javascript">
							$(function () {
								$('#datepicker00').datepicker();
							});
							</script>

							<div class="form-group has-error has-feedback">
								<label class="col-sm-4 control-label">Sampai Tanggal</label>
								<div class='input-group date col-sm-7'>
									<input type='text' class="form-control"  id='datepicker01'/>
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar" >
										</span>
									</span>
								</div>
							</div>
							<script type="text/javascript">
							$(function () {
								$('#datepicker01').datepicker();
							});
							</script>
						</div>
					</div>



					

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Show</button>
					<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
				</div>
			</form>
		</div>
	</div>
</div>