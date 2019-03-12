<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$ts1 = strtotime('2018-01-30 01:08:00');
$ts2 = strtotime('2018-01-30 03:08:00');
$seconds_diff = $ts2 - $ts1;
// $time = ($seconds_diff/3600); //hour
$time = ($seconds_diff/60); //minutes
// echo '<pre>';
// echo $time;
// echo '</pre>';
?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-md-2 col-md-offset-4">
				<div class="box box-widget box-solid box-info with-border">
            <div class="box-body">
							<div class="text-center">
								<input autocomplete="off" type="text" id="datepicker-start" class="form-control" placeholder="Start"/>
							</div>
						</div>
        </div>
			</div>
			<div class="col-md-2">
				<div class="box box-widget box-solid box-info with-border">
            <div class="box-body">
							<div class="text-center">
								<input autocomplete="off" id="datepicker-end" class="form-control" placeholder="Finish"/>
							</div>
						</div>
        </div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="box box-info">
					<div class="box-header with-border">
						<h3 class="box-title">Input Workload Project Leader</h3>
					</div>
					<div class="box-body table-responsive">
						<table id="tables-workload" class="table table-bordered table-striped table-responsive">
							<thead>
								<tr>
									<th width="4%">#</th>
									<th width="20%">Projects</th>
									<th>Request</th>
									<th>Time</th>
									<th>Start</th>
									<th>Finish</th>
									<th class="text-center" width="20%">Execute</th>
							 </tr>
						 </thead>
						 <tbody>

						 </tbody>
					 </table>
				</div>
			</div>
	 </div>
		</div>
	</section>
</div>
