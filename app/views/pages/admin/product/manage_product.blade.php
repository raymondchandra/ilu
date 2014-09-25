@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
				<div class="container-fluid">
					<div class="row">
						<div class="g-lg-12">
						
							<div class="s_title_n_control">
								<h3 style="float: left;">
									Manage Product
								</h3>
								<a href="add_product_00" class="btn btn-success" style="float: right; margin-top: 20px;">+ Add Product</a>
							</div>
							<span class="clearfix"></span>
							<hr></hr>
							
							<div>
								<table class="table table-striped table-hover ">
									<thead>
										<tr>
											<th></th>
											<th>ID</th>
											<th>Nama</th>
											<th>Tipe</th>
											<th>Attribute Set</th>
											<th>SKU</th>
											<th>Harga</th>
											<th>Qty</th>
											<th>Visibility</th>
											<th>Status</th>
											<th>Website</th>
											<th>Edit</th>
										</tr>
									</thead>
									<tbody>
										<?php 
										for ($i=0; $i<=30; $i++) {
										  ?>
										<tr> 
											<td><input type="checkbox"></td>
											<td><?php echo($i); ?></td>
											<td>Barang bagus</td>
											<td>Pakaian</td>
											<td>Set atribut pakaian</td>
											<td>242342</td>
											<td>300000</td>
											<td>90</td>
											<td>catalog</td>
											<td>enables</td>
											<td>-</td>
											<td><a class="btn btn-warning btn-xs">Edit</a></td>
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
			@stop