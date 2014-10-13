<div class="modal fade pop_up_view_belanja" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
				<h4 class="modal-title" id="myModalLabel">History Belanja</h4>
			</div>
			<div class="modal-body">
				<table class="table">	
					<thead>
						<tr>
							<th>
								ID Transaksi
							</th>
							<th>
								Total Price
							</th>
							<th>
								Tanggal Belanja
							</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						for ($i=0; $i<=27; $i++) {
						?>
						<tr>
							<td>
								765675YTYU678
							</td>
							<td>
								IDR 900.000
							</td>
							<td>
								31 January 2014
							</td>
						</tr>
						<?php
						}
						?>
					</tbody>
				</table>



			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
			</div>
		</div>
	</div>
</div>