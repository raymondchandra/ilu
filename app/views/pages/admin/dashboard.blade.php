@extends('layouts.admin.admin_layout'){{-- WARNING! fase ini sementara untuk show saja, untuk lebih lanjut akan dibuat controller agar tidak meng-extend layout --}}
@section('content')	
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
			
				<div class="s_title_n_control">
					<h3 style="float: left;">
						Welcome To Dashboard
					</h3>
				</div>
				<span class="clearfix"></span>
				<hr></hr>
				
				<div>
					<div class="col-lg-6">
						<div class="panel panel-default">
							<div class="panel-heading">
								<h3 class="panel-title">Penjualan Bulan Ini</h3>
							</div>
							<div class="panel-body">
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
						    			text: 'Kurva Penjualan'
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
						</div>
					</div>
					<div class="col-lg-3">
						<div class="panel panel-default">
						  <div class="panel-heading">
						    <h3 class="panel-title">Top 10 Products</h3>
						  </div>
						  <div class="panel-body">
						   	<table class="table table-condensed table-bordered">
						   		<thead>
						   			<tr>
						   				<th>
						   					Nama Produk
						   				</th>
						   			</tr>
						   		</thead>
						   		<tbody>
						   			<?php
						   				for($i = 0; $i < 10; $i++){
				   					?>
						   			<tr>
						   				<td>
						   					Nama Produk
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
					<div class="col-lg-3">
						<div class="panel panel-default">
						  <div class="panel-heading">
						    <h3 class="panel-title">Top 10 Buyers</h3>
						  </div>
						  <div class="panel-body">
						   	<table class="table table-condensed table-bordered">
						   		<thead>
						   			<tr>
						   				<th>
						   					Nama Produk
						   				</th>
						   			</tr>
						   		</thead>
						   		<tbody>
						   			<?php
						   				for($i = 0; $i < 10; $i++){
				   					?>
						   			<tr>
						   				<td>
						   					Nama Orang
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
				
			</div>
		</div>
	</div>
	
	@include('includes.modals.alertYesNo')	
	@include('pages.admin.cms.pop_up_edit_company_info')
	@include('pages.admin.cms.pop_up_edit_seo')

@stop