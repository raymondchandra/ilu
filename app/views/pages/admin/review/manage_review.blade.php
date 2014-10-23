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
				
				<div id="div_pagination">
					{{$datas->links()}}
					
					<table class="table table-striped table-hover ">
						<thead class="table-bordered">
							<tr>
								<th class="table-bordered">
									<a href="javascript:void(0)">Product ID</a>
									<a href="javascript:void(0)">
									<span id="toogle_sorted_product_id" class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Nama Product</a>
									<a href="javascript:void(0)">
									<span id="toogle_sorted_product_name" class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Komentar</a>
									<a href="javascript:void(0)">
									<span id="toogle_sorted_text" class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Rating</a>
									<a href="javascript:void(0)">
									<span id="toogle_sorted_rating" class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									<a href="javascript:void(0)">Status</a>
									<a href="javascript:void(0)">
									<span id="toogle_sorted_approved" class="glyphicon glyphicon-sort" style="float: right;"></span>
									</a>
								</th>
								<th class="table-bordered">
									
								</th>
						</thead>
						<thead>						
							<tr>
								<td><input id="search_product_no_input" type="text" class="form-control input-sm"></td>
								<td><input id="search_product_name_input" type="text" class="form-control input-sm"></td>
								<td><input id="search_text_input" type="text" class="form-control input-sm"></td>
								<td><input id="search_rating_input" type="text" class="form-control input-sm"></td>
								<td><input id="search_approved_input" type="text" class="form-control input-sm"></td>
								
								<td width=""><a id="search-review" class="btn btn-primary btn-xs">Filter</a></td>
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
		//global
		var view_all = "{{URL('admin/review')}}";		
		var filtered = 0;			//0 false, 1 true
		// var sorted_id = 0;	//-1 desc, 1 asc
		// var sorted_name = 0;	//-1 desc, 1 asc
		var temp_product_no;
		var temp_product_name;
		var temp_text;
		var temp_rating;
		var temp_approved;
		var fill = "";
		var search_result;
			
		// sort on values
		function srt(desc) {
		  return function(a,b){
		   return desc ? ~~(a < b) : ~~(a > b);
		  };
		}
		
		$('body').on('click', '#toogle_sorted_product_id', function(){
			if(filtered == 1)
			{
				//BERHASIL SORT PRODUCT_NO ASC
				// var temp = search_result.sort(srt({key:'product_no', string:true}, true));
				// temp = search_result.sort(srt({key:'product_no', string:true}, true));
				// temp = search_result.sort(srt({key:'product_no', string:true}, true));			
				
				//BERHASIL SORT PRODUCT_NO DESC
				// var temp = search_result.sort(srt({key:'product_no', string:true}, true));
				// temp = search_result.sort(srt({key:'product_no', string:true}, true));
				// temp = search_result.sort(srt({key:'product_no', string:true}, true));			
				// temp.reverse();
				
				//BERHASIL SORT PRODUCT_NAME ASC
				// var temp = search_result.sort(srt({key:'product_name', string:true}, true));
				// temp = search_result.sort(srt({key:'product_name', string:true}, true));
				// temp = search_result.sort(srt({key:'product_name', string:true}, true));			
				
				//BERHASIL SORT PRODUCT_NAME DESC
				// var temp = search_result.sort(srt({key:'product_name', string:true}, true));
				// temp = search_result.sort(srt({key:'product_name', string:true}, true));
				// temp = search_result.sort(srt({key:'product_name', string:true}, true));			
				// temp.reverse();
				
				//BERHASIL SORT TEXT ASC
				// var temp = search_result.sort(srt({key:'text', string:true}, true));
				// temp = search_result.sort(srt({key:'text', string:true}, true));
				// temp = search_result.sort(srt({key:'text', string:true}, true));			
				
				//BERHASIL SORT TEXT DESC
				// var temp = search_result.sort(srt({key:'text', string:true}, true));
				// temp = search_result.sort(srt({key:'text', string:true}, true));
				// temp = search_result.sort(srt({key:'text', string:true}, true));			
				// temp.reverse();
				
				//BERHASIL SORT RATING ASC
				// var temp = search_result.sort(srt({key:'rating', integer:true}, true));
				// temp = search_result.sort(srt({key:'rating', integer:true}, true));
				// temp = search_result.sort(srt({key:'rating', integer:true}, true));			
				
				//BERHASIL SORT RATING DESC
				// var temp = search_result.sort(srt({key:'rating', integer:true}, true));
				// temp = search_result.sort(srt({key:'rating', integer:true}, true));
				// temp = search_result.sort(srt({key:'rating', integer:true}, true));			
				// temp.reverse();
				
				//BERHASIL SORT APPROVED ASC
				// var temp = search_result.sort(srt({key:'approved', integer:true}, true));
				// temp = search_result.sort(srt({key:'approved', integer:true}, true));
				// temp = search_result.sort(srt({key:'approved', integer:true}, true));			
				
				//BERHASIL SORT APPROVED DESC
				// var temp = search_result.sort(srt({key:'approved', integer:true}, true));
				// temp = search_result.sort(srt({key:'approved', integer:true}, true));
				// temp = search_result.sort(srt({key:'approved', integer:true}, true));			
				// temp.reverse();
				
				fill = "";
				
				fill += "</tbody></table>";						
				document.getElementById("div_pagination").innerHTML = fill;
			}
		});
		
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
		
		$('body').on('click', '#search-review', function(){
			//change filtered status
				filtered = 1;
			$product_no = $('#search_product_no_input').val();			
			$product_name = $('#search_product_name_input').val();			
			$text = $('#search_text_input').val();
			$rating = $('#search_rating_input').val();
			$approved = $('#search_approved_input').val();
			$data = {
				'product_no' : $product_no,
				'product_name' : $product_name,
				'text' : $text,
				'rating' : $rating,
				'approved' : $approved
			};			
			var json_data = JSON.stringify($data);
			// alert(json_data);
			$.ajax({
				type: 'GET',
				url: "{{URL('admin/searchReview')}}",
				data : {
					'json_data' : json_data
				},				
				success: function(response){									
					alert("searching");					
					var temp_id;
					// var temp_name;
					// var fill = "";
					if(response != ""){
						//fill result
						search_result = response;
						//alert("null");	
						fill = "";
						fill += "<a id='button_view_all' href='"+view_all+"' class='btn btn-success' style='float: left; margin-top: 20px; margin-bottom: 25px;'>View All</a>";
						fill += "<table class='table table-striped table-hover '><thead class='table-bordered'><tr><th class='table-bordered'><a href='javascript:void(0)'>Product ID</a><a href='javascript:void(0)'><span id='toogle_sorted_product_id' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Nama Product</a><a href='javascript:void(0)'><span id='toogle_sorted_product_name' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Komentar</a><a href='javascript:void(0)'><span id='toogle_sorted_text' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Rating</a><a href='javascript:void(0)'><span id='toogle_sorted_rating' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Status</a><a href='javascript:void(0)'><span id='toogle_sorted_approved' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'></th></thead><thead><tr><td><input id='search_product_no_input' type='text' class='form-control input-sm'></td><td><input id='search_product_name_input' type='text' class='form-control input-sm'></td><td><input id='search_text_input' type='text' class='form-control input-sm'></td><td><input id='search_rating_input' type='text' class='form-control input-sm'></td><td><input id='search_approved_input' type='text' class='form-control input-sm'></td><td width=''><a id='search-review' class='btn btn-primary btn-xs'>Filter</a></td></tr></thead><tbody>";
						for(i=0; i<response.length; i++){
							temp_id = response[i]['id'];
							temp_product_no = response[i]['product_no'];							
							temp_product_name = response[i]['product_name'];
							temp_text = response[i]['text'];
							temp_rating = response[i]['rating'];
							temp_approved = response[i]['approved'];
							fill += "<tr><td>"+temp_product_name+"</td><td>"+temp_product_name+"</td><td>"+temp_text+"</td><td>"+temp_rating+"</td><td>"+temp_approved+"</td><td><input type='hidden' class='id_review' value='"+temp_id+"'><button class='btn btn-info btn-xs detail-review' data-toggle='modal' data-target='.pop_up_view_review'>View</button><button class='btn btn-danger btn-xs delete-review' data-toggle='modal' data-target='.alertYesNo'>Delete</button></td></tr>";
						}					
						fill += "</tbody></table>";						
						document.getElementById("div_pagination").innerHTML = fill;
					}else{		
						fill = "";
						fill += "<a id='button_view_all' href='"+view_all+"' class='btn btn-success' style='float: left; margin-top: 20px; margin-bottom: 25px;'>View All</a>";
						fill += "<table class='table table-striped table-hover '><thead class='table-bordered'><tr><th class='table-bordered'><a href='javascript:void(0)'>Product ID</a><a href='javascript:void(0)'><span id='toogle_sorted_product_id' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Nama Product</a><a href='javascript:void(0)'><span id='toogle_sorted_product_name' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Komentar</a><a href='javascript:void(0)'><span id='toogle_sorted_text' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Rating</a><a href='javascript:void(0)'><span id='toogle_sorted_rating' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'><a href='javascript:void(0)'>Status</a><a href='javascript:void(0)'><span id='toogle_sorted_approved' class='glyphicon glyphicon-sort' style='float: right;'></span></a></th><th class='table-bordered'></th></thead><thead><tr><td><input id='search_product_no_input' type='text' class='form-control input-sm'></td><td><input id='search_product_name_input' type='text' class='form-control input-sm'></td><td><input id='search_text_input' type='text' class='form-control input-sm'></td><td><input id='search_rating_input' type='text' class='form-control input-sm'></td><td><input id='search_approved_input' type='text' class='form-control input-sm'></td><td width=''><a id='search-review' class='btn btn-primary btn-xs'>Filter</a></td></tr></thead><tbody>";
						fill += "<tr><td>No Result</td></tr>";
						fill += "</tbody></table>";
						document.getElementById("div_pagination").innerHTML = fill;
					}	
					//keep input
					$('#search_product_no_input').val($product_no);			
					$('#search_product_name_input').val($product_name);	
					$('#search_text_input').val($text);
					$('#search_rating_input').val($rating);					
					$('#search_approved_input').val($approved);
				},
				error: function(jqXHR, textStatus, errorThrown){
					alert("error");
					alert(errorThrown);
				}
			},'json');
		});
	</script>
	
@stop