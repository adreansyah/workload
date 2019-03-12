<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$do_login   = array('controller_login','do_login');
$token = bin2hex(openssl_random_pseudo_bytes(25));
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php echo TITLE;?></title>
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<link rel="icon" href="<?php echo base_url('favicon.ico');?>" type="image/x-icon">
	<link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
	<link rel="stylesheet" href="<?php echo base_url('dist/css/AdminLTE.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('dist/css/AdminLTE.min.css');?>">
	<link rel="stylesheet" href="<?php echo base_url('dist/css/animate.css');?>">
  <link rel="stylesheet" href="<?php echo base_url('plugins/iCheck/square/blue.css');?>">
</head>
<style>
.line{
width: 112px;
height: 47px;
border-bottom: 1px solid black;
position: absolute;
}
</style>
<body style="background:white" class="hold-transition login-page">
<!-- <div class="clearops"></div> -->
<div>
  <div class="row">
	  <!-- <div class="col-md-6">
		  <div class="box-body">
				<div class="col-md-12 box-body login-inf mycontent-left">
					<ul class="timeline">
						<?php
						foreach ($values as $key => $value) {
							echo '
								<li class="time-label">
									<span class="bg-teal">
										'.$key.'
									</span>
								</li>
							';
							foreach($value as $row){
								echo'
									<li>
										<div style="margin: 8px;">
											<img class="img-circle" width="50px" height="50px" src="'.base_url($row['doctor_image']).'">
										</div>
										<div class="timeline-item">
											<span class="time bg-green">Available</span>
												<h3 class="timeline-header bg-aqua">
													'.$row['doctor_name'].'
												</h3>
											<div class="timeline-body">
												<span></span>Available at  '.str_replace(',',' | ',$row['practice_time']).'
											</div>
										</div>
									</li>
								';
							}
						}
						?>
					</ul>
				</div>
			</div>
	  </div> -->
	  <div class="col-md-12">
		  <div class="clearops"></div>
		  <div class="login-box">
			 <div id="notif"></div>
			 <div class="">
				<img class="logo-img-2" src="<?php echo base_url('dist/img/gigis.png');?>"/>
				<!-- <h1 class="login-box-msg"><b>Sign</b>In</h1> -->
				<form id="myform" >
				  <div class="form-group has-feedback">
					 <input id ="name" type="text" class="form-control" placeholder="Username">
					 <input id="token" type="hidden" value="<?php echo $token;?>"/>
					 <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
				  </div>
				  <div class="form-group has-feedback">
					 <input id="pass" type="password" class="form-control" placeholder="Password">
					 <span class="glyphicon glyphicon-lock form-control-feedback"></span>
				  </div>
				  <div class="row">
					 <!-- <div class="col-xs-8">
						<div class="checkbox icheck">
						  <label>
							 <input name="form[remember_me]" type="checkbox"> Remember Me
						  </label>
						</div>
					 </div> -->
					 <div class="col-md-12">
						<!-- <button id="login_load" type="submit" class="btn btn-info btn-block btn-flat"><i class="fa fa-sign-in"></i>
						Sign In</button> -->
						<button id="login_load" type="submit" class="btn btn-info btn-block btn-flat"><i class="fa fa-sign-in"></i>
						Sign In</button>
					 </div>
				  </div>
				</form>
				<!-- <a href="#">I forgot my password</a> -->
				<div class="registration-form text-aqua">
				  &copy; Powered By Dentassure Clinic
				</div>
				<!-- <div class="registration-form">
				  You don't have an account?? <a href="<?php echo site_url('registration')?>"> register Here !!!</a>
				</div> -->
			 </div>
		  </div>
	 </div>
  </div>
</div>
<script src="<?php echo base_url('plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.17.1/axios.js"></script>
<script src="<?php echo base_url('dist/ajax/Authentication.js')?>" type="text/javascript" ></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qs/6.5.1/qs.min.js"></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('plugins/iCheck/icheck.min.js');?>"></script>
<script>
$(function () {
	$('input').iCheck({
	  checkboxClass: 'icheckbox_square-blue',
	  radioClass: 'iradio_square-blue',
	  increaseArea: '20%'
	});
  Authentication('<?php echo $token?>');
});
</script>
</body>
</html>
