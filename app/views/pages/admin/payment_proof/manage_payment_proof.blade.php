@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			
				<div class="s_title_n_control">
					<h3 style="float: left;">
						Manage Payment Proof
					</h3>
				</div>
				<span class="clearfix"></span>
				<hr></hr>
				
				<div>
					<table class="table table-striped table-hover table-bordered">
						<thead class="table-bordered">
							<tr>
								<th>
									Nama Pembayar
								</th>
								<th>
									Bank Asal
								</th>
								<th>
									No. Rek. Asal
								</th>
								<th>
									Bank Tujuan
								</th>
								<th>
									No. Rek. Tujuan
								</th>
								<th>
									No. Invoice
								</th>
								<th>
									Nominal
								</th>
							</tr>
						</thead>
						<tbody>
							<?php
								for($i = 0; $i < 10; $i++){
							?>
							<tr>
								<td>
									Seseorang
								</td>
								<td>
									BCA
								</td>
								<td>
									12345 12345
								</td>
								<td>
									BCA
								</td>
								<td>
									45677 45677
								</td>
								<td>
									54689684543634
								</td>
								<td>
									7.000.000
								</td>
							</tr>
							<?php
								}
							?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	
	@include('includes.modals.alertYesNo')
	@include('pages.admin.payment_proof.pop_up_view_payment_proof')

	<script>
		//filter button
		$('body').on('click','#filterButton',function(){
			$invoice = $('#filterInvoice').val();
			$accId = $('#filterAccId').val();
			$fullName = $('#filterFullName').val();
			$totalPrice = $('#filterTotalPrice').val();
			$status = $('#filterStatus').val();
			$paid = $('#filterPaid').val();
			window.location = "{{URL::route('jeffry.getTransaction')}}" + "?filtered=1&invoice="+$invoice+"&accId="+$accId+"&fullName="+$fullName+"&totalPrice="+$totalPrice+"&status="+$status+"&paid="+$paid;
		});
		$('body').on('click','.backButton',function(){
			window.location = "{{URL::route('jeffry.getTransaction')}}" ;
		});
		
		function toRp(angka){
		var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
		var rev2    = '';
		for(var i = 0; i < rev.length; i++){
			rev2  += rev[i];
			if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
				rev2 += '.';
			}
		}
		return 'Rp ' + rev2.split('').reverse().join('')+',-';
		//return 'IDR ' + rev2.split('').reverse().join('') + ',00';
	}
	</script>
	
	
@stop