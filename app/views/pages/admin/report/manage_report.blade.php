@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
<div class="container-fluid">
	<div class="row">
		<div class="col-lg-12">
			
			<div class="s_title_n_control">
				<h3 style="float: left;">
					Manage Report
				</h3>
				<a href="javascript:void(0);" class="btn btn-primary" style="float: right; margin-top: 20px;margin-left: 10px;" >By Day</a>
				<a href="javascript:void(0);" class="btn btn-primary" style="float: right; margin-top: 20px;margin-left: 10px;" >By Week</a>
				<a href="javascript:void(0);" class="btn btn-primary" style="float: right; margin-top: 20px;margin-left: 10px;" >By Month</a>
				<a href="javascript:void(0);" class="btn btn-primary" style="float: right; margin-top: 20px;margin-left: 10px;" >By Year</a>
				<!--<a href="{{ URL::to('test/manage_shipping_agent') }}" class="btn btn-default" style="float: right; margin-top: 20px;margin-left: 10px;" >Manage Shipping Agent</a>-->
			</div>
			<span class="clearfix"></span>
			<hr></hr>
			<div>
				<style type="text/css">
				${demo.css}
				</style>
				<script type="text/javascript">
				$(function () {

	    // Get the CSV and create the chart
	    $.getJSON('http://www.highcharts.com/samples/data/jsonp.php?filename=analytics.csv&callback=?', function (csv) {

	    	$('#container').highcharts({

	    		data: {
	    			csv: csv
	    		},

	    		title: {
	    			text: 'By Day'
	    		},

	    		subtitle: {
	    			text: ''
	    		},

	    		xAxis: {
	                tickInterval: 7 * 24 * 3600 * 1000, // one week
	                tickWidth: 0,
	                gridLineWidth: 1,
	                labels: {
	                	align: 'left',
	                	x: 3,
	                	y: -3
	                }
	            },

	            yAxis: [{ // left y axis
	            	title: {
	            		text: null
	            	},
	            	labels: {
	            		align: 'left',
	            		x: 3,
	            		y: 16,
	            		format: '{value:.,0f}'
	            	},
	            	showFirstLabel: false
	            }, { // right y axis
	            	linkedTo: 0,
	            	gridLineWidth: 0,
	            	opposite: true,
	            	title: {
	            		text: null
	            	},
	            	labels: {
	            		align: 'right',
	            		x: -3,
	            		y: 16,
	            		format: '{value:.,0f}'
	            	},
	            	showFirstLabel: false
	            }],

	            legend: {
	            	align: 'left',
	            	verticalAlign: 'top',
	            	y: 20,
	            	floating: true,
	            	borderWidth: 0
	            },

	            tooltip: {
	            	shared: true,
	            	crosshairs: true
	            },

	            plotOptions: {
	            	series: {
	            		cursor: 'pointer',
	            		point: {
	            			events: {
	            				click: function (e) {
	            					hs.htmlExpand(null, {
	            						pageOrigin: {
	            							x: e.pageX,
	            							y: e.pageY
	            						},
	            						headingText: this.series.name,
	            						maincontentText: Highcharts.dateFormat('%A, %b %e, %Y', this.x) + ':<br/> ' +
	            						this.y + ' visits',
	            						width: 200
	            					});
	            				}
	            			}
	            		},
	            		marker: {
	            			lineWidth: 1
	            		}
	            	}
	            },

	            series: [{
	            	name: 'All visits',
	            	lineWidth: 4,
	            	marker: {
	            		radius: 4
	            	}
	            }, {
	            	name: 'New visitors'
	            }]
	        });
	});

	});


	</script>

	<script src="{{ asset('assets/js/highcharts4/js/highcharts.js') }}"></script>
	<script src="{{ asset('assets/js/highcharts4/js/modules/data.js') }}"></script>
	<script src="{{ asset('assets/js/highcharts4/js/modules/exporting.js') }}"></script>

	<!-- Additional files for the Highslide popup effect -->
	<script type="text/javascript" src="http://www.highcharts.com/media/com_demo/highslide-full.min.js"></script>
	<script type="text/javascript" src="http://www.highcharts.com/media/com_demo/highslide.config.js" charset="utf-8"></script>
	<link rel="stylesheet" type="text/css" href="http://www.highcharts.com/media/com_demo/highslide.css" />

	<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

	</div>

	<span class="clearfix"></span>

	<div>
	<ul class="pagination">
		<li><a href="#">&laquo;</a></li>
		<li><a href="#">1</a></li>
		<li><a href="#">2</a></li>
		<li><a href="#">3</a></li>
		<li><a href="#">4</a></li>
		<li><a href="#">5</a></li>
		<li><a href="#">&raquo;</a></li>
	</ul>
	<!--<button class="btn btn-success" style="float: right; margin-top: 20px;"  data-toggle="modal" data-target=".pop_up_add_shipping_agent">+ Add New Kurir</button>
	-->
	<table class="table table-striped table-hover ">
		<thead class="table-bordered">
			<tr>
				<th class="table-bordered">
					<a href="javascript:void(0)">Tanggal</a>
					<a href="javascript:void(0)">
						<span class="glyphicon glyphicon-sort" style="float: right;"></span>
					</a>
				</th>
				<th class="table-bordered" width="">
					<a href="javascript:void(0)">Pemasukan</a>
					<a href="javascript:void(0)">
						<span class="glyphicon glyphicon-sort" style="float: right;"></span>
					</a>
				</th>
				<!-- <th class="table-bordered">

				</th> -->
			</thead>
			<thead>
				<tr>
					<td><input type="text" class="form-control input-sm"></td>
					<td><input type="text" class="form-control input-sm"></td>

					<!-- <td width=""><a class="btn btn-primary btn-xs">Filter</a></td> -->
				</tr>
			</thead>
			<tbody>
				<?php 
				for ($i=0; $i<=30; $i++) {
					?>
					<tr> 

						<td>20 Oktober 2014</td>
						<td>IDR 90.000.000</td>

						<!-- <td>
							<button class="btn btn-info btn-xs" data-toggle="modal" data-target=".pop_up_view_report">View</button>
						</td> -->
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
@include('pages.admin.report.pop_up_view_report')
{{-- @include('pages.admin.shipping.pop_up_add_shipping_agent') --}}

@stop