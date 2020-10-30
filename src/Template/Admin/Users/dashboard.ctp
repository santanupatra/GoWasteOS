<div class="container-fluid">
	<div class="panel panel-headline">
		<div class="panel-heading">
			<h3 class="panel-title">Welcome to Dashboard</h3>
			<!-- <p class="panel-subtitle"><?php echo date('M d, Y', strtotime($date)); ?></p> -->
		</div>
		
		<div class="panel-body">
			<div class="row">

				<div class="col-lg-3 col-xs-12">
					<div class="small-box bg-aqua">
						<div class="inner">
							<h3><?php echo @$dashboard_count_arr['bookings']; ?></h3>
							<p>Bookings</p>
						</div>
						<div class="icon">
							<i class="lnr lnr-cart" aria-hidden="true"></i>
						</div>
						<a href="<?php echo $this->Url->build(["controller"=>"Bookings", "action"=>"index"]); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-3 col-xs-12">
					<div class="small-box bg-yellow">
						<div class="inner">
							<h3><?php echo @$dashboard_count_arr['cities']; ?></h3>
							<p>City</p>
						</div>
						<div class="icon">
							<i class="lnr lnr-map-marker" aria-hidden="true"></i>
						</div>
						<a href="<?php echo $this->Url->build(["controller"=>"Cities", "action"=>"index"]); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-3 col-xs-12">
					<div class="small-box bg-blue">
						<div class="inner">
							<h3><?php echo @$dashboard_count_arr['services']; ?></h3>
							<p>Service</p>
						</div>
						<div class="icon">
							<i class="lnr lnr-pushpin" aria-hidden="true"></i>
						</div>
						<a href="<?php echo $this->Url->build(["controller"=>"Services", "action"=>"index"]); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-3 col-xs-12">
					<div class="small-box bg-purple">
						<div class="inner">
							<h3><?php echo @$dashboard_count_arr['service_providers']; ?></h3>
							<p>Service Provider</p>
						</div>
						<div class="icon">
							<i class="lnr lnr-users" aria-hidden="true"></i>
						</div>
						<a href="<?php echo $this->Url->build(["controller"=>"Users", "action"=>"service_provider_list"]); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-3 col-xs-12">
					<div class="small-box bg-green">
						<div class="inner">
							<h3><?php echo @$dashboard_count_arr['customers']; ?></h3>
							<p>Customer</p>
						</div>
						<div class="icon">
							<i class="lnr lnr-users" aria-hidden="true"></i>
						</div>
						<a href="<?php echo $this->Url->build(["controller"=>"Users", "action"=>"customer_list"]); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-3 col-xs-12">
					<div class="small-box bg-red">
						<div class="inner">
							<h3><?php echo @$dashboard_count_arr['reviews']; ?></h3>
							<p>Rating</p>
						</div>
						<div class="icon">
							<i class="lnr lnr-star" aria-hidden="true"></i>
						</div>
						<a href="<?php echo $this->Url->build(["controller"=>"Reviews", "action"=>"index"]); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-3 col-xs-12">
					<div class="small-box bg-navy">
						<div class="inner">
							<h3><?php echo @$dashboard_count_arr['subadmin']; ?></h3>
							<p>Sub Admin</p>
						</div>
						<div class="icon">
							<i class="lnr lnr-users" aria-hidden="true"></i>
						</div>
						<a href="<?php echo $this->Url->build(["controller"=>"Users", "action"=>"subadmin_list"]); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-3 col-xs-12">
					<div class="small-box bg-maroon">
						<div class="inner">
							<h3>Admin</h3>
							<p>Settings</p>
						</div>
						<div class="icon">
							<i class="lnr lnr-cog"></i>
						</div>
						<a href="<?php echo $this->Url->build(["controller"=>"Settings", "action"=>"index"]); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
					</div>
				</div>

				<div class="col-lg-6 col-xs-12">
					<canvas id="booking_canvas"></canvas>
				</div>

				<div class="col-lg-6 col-xs-12">
					<canvas id="citybooking_canvas" height="300"></canvas>
				</div>


			</div>
		</div>
	</div>
</div>




<script src="<?php echo $this->Url->build('/'); ?>assets/vendor/chartist/js/chart.min.js"></script>

<style>
.bg-aqua {
	background-color: #00c0ef !important;
	color: #fff !important;
}
.bg-green {
	background-color: #00a65a !important;
	color: #fff !important;
}
.bg-yellow {
	background-color: #f39c12 !important;
	color: #fff !important;
}
.bg-red {
	background-color: #dd4b39 !important;
	color: #fff !important;
}
.bg-purple {
	background-color: #605ca8 !important;
	color: #fff !important;
}
.bg-navy {
	background-color: #001f3f !important;
	color: #fff !important;
}
.bg-blue {
	background-color: #0073b7 !important;
	color: #fff !important;
}
.bg-maroon {
	background-color: #d81b60 !important;
	color: #fff !important;
}

.small-box {
    border-radius: 2px;
    position: relative;
    display: block;
    margin-bottom: 20px;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}
.inner {
    padding: 10px;
}
.icon {
    -webkit-transition: all .3s linear;
    -o-transition: all .3s linear;
    transition: all .3s linear;
    position: absolute;
    top: 10px;
    right: 14px;
    z-index: 0;
    font-size: 60px;
    /* color: rgba(0,0,0,0.15); */
}
.small-box-footer {
    position: relative;
    text-align: center;
    padding: 3px 0;
    color: #fff;
    color: rgba(255,255,255,0.8);
    display: block;
    z-index: 10;
    background: rgba(0,0,0,0.1);
    text-decoration: none;
}

#booking_canvas {
	width: 500px;
    height: 300px;
}
#citybooking_canvas {
	width: 500px;
    height: 300px;
}
</style>

<script> 
	var areachartlevel_arr= []; 
	var areachartdata_arr= [];

	var barchartlevel_arr= []; 
	var barchartdata_arr= []; 
</script>
<?php foreach ($bookings as $rowsell) { ?>
   <script>
      areachartdata_arr.push('<?php echo $rowsell['counted_leads']; ?>');
      areachartlevel_arr.push('<?php echo date('j M Y',strtotime(@$rowsell['count_date'])); ?>');
   </script>
<?php } ?>
<?php foreach ($city_bookings as $rowcitybookings) { ?>
   <script>
      barchartdata_arr.push('<?php echo $rowcitybookings['total_booking']; ?>');
      barchartlevel_arr.push('<?php echo $rowcitybookings['name']; ?>');
   </script>
<?php } ?>
<script>
	window.chartColors = {
		red: 'rgb(255, 99, 132)',
		orange: 'rgb(255, 159, 64)',
		yellow: 'rgb(255, 205, 86)',
		green: 'rgb(75, 192, 192)',
		blue: 'rgb(54, 162, 235)',
		purple: 'rgb(153, 102, 255)',
		grey: 'rgb(201, 203, 207)'
	};

	var color = Chart.helpers.color;
	
	var areaChartData = {
		labels: areachartlevel_arr,
		datasets: [{
			label: 'Total Booking',
			backgroundColor: color(window.chartColors.blue).alpha(0.5).rgbString(),
			borderColor: window.chartColors.blue,
			borderWidth: 1,
			data: areachartdata_arr
		}]

	};

	var barChartData = {
			labels: barchartlevel_arr,
			datasets: [{
				label: 'Total Booking',
				backgroundColor: color(window.chartColors.red).alpha(0.5).rgbString(),
				borderColor: window.chartColors.red,
				borderWidth: 1,
				data: barchartdata_arr
			}]

		};

	var areaOptions = {
		maintainAspectRatio: false,
		spanGaps: false,
		elements: {
			line: {
				tension: 0.000001
			}
		},
		plugins: {
			filler: {
				propagate: false
			}
		},
		scales: {
			x: {
				ticks: {
					autoSkip: false,
					maxRotation: 0
				}
			}
		}
	};

	var barOptions = {
		responsive: true,
		legend: {
			position: 'top',
		},
		title: {
			display: true,
			text: 'Total Booking'
		}
	};

	

	window.onload = function() {
		var barCtx = document.getElementById('citybooking_canvas').getContext('2d');
		var areaCtx = document.getElementById('booking_canvas').getContext('2d');

		new Chart(areaCtx, {
			type: 'line',
			data: areaChartData,
			options: areaOptions
		});

		new Chart(barCtx, {
			type: 'bar',
			data: barChartData,
			options: barOptions
		});

		

	};
</script>




