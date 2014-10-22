@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			
				<div class="s_title_n_control">
					<h3 style="float: left;">
						Manage Review
					</h3>
				</div>
				<span class="clearfix"></span>
				<hr></hr>
				
				<div>
					{{$datas->links()}}
					<!--<ul class="pagination">
					  <li><a href="#">&laquo;</a></li>
					  <li><a href="#">1</a></li>
					  <li><a href="#">2</a></li>
					  <li><a href="#">3</a></li>
					  <li><a href="#">4</a></li>
					  <li><a href="#">5</a></li>
					  <li><a href="#">&raquo;</a></li>
					</ul>-->
					<table class="table table-striped table-hover ">
						<thead class="table-bordered">
							<tr>
								<th class="table-bordered">
									<a href="javascript:void(0)">Product ID</a>
									<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Nama Product</a>
									<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Komentar</a>
									<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Rating</a>
									<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Status</a>
									<a href="javascript:void(0)">
									<span class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									
								</th>
						</thead>
						<thead>
							<tr>
								<td><input type="text" class="form-control input-sm"></td>
								<td><input type="text" class="form-control input-sm"></td>
								<td><input type="text" class="form-control input-sm"></td>
								<td><input type="text" class="form-control input-sm"></td>
								<td><input type="text" class="form-control input-sm"></td>
								
								<td width=""><a class="btn btn-primary btn-xs">Filter</a></td>
							</tr>
						</thead>
						<tbody>	
							@foreach($datas as $review)
								<tr> 								
									<td>{{$review->product_no}}</td>
									<td>{{$review->product_name}}</td>
									<td>{{$review->text}}</td>
									<td>{{$review->rating}}</td>
									<td>{{$review->approved}}</td>									
									<td>
										<input type='hidden' class='id_review' value='{{$review->id}}'>
										<button class="detail-review btn btn-warning btn-xs" data-toggle="modal" data-target=".pop_up_view_review">Edit</button>
									</td>
								</tr> 							
							@endforeach
						</tbody>
					</table>
				</div>
				
			</div>
		</div>
	</div>
	
	@include('includes.modals.alertYesNo')
	@include('pages.admin.review.pop_up_view_review')

	<script>
		$('body').on('click', '.detail-review',function(){
			$id = $(this).siblings('.id_review').val();			
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/review')}}/"+$id,
				success: function(response){
					result = JSON.parse(response);
					if(result.code==200){
						$message = result.messages;						
						$('#detail_product_no').text($message.product_no);
						$('#detail_product_name').text($message.product_name);
						$('#detail_text').text($message.text);
						$('#detail_rating').text($message.rating);
						if($message.approved == 1){
							$('#review_status').text("Approved");
						}else{
							$('#review_status').text("Pending");
						}						
						$('#review_status_list').val($message.approved);
					}
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert(errorThrown);
				}
			},'json');
		});
	</script>
	
@stop