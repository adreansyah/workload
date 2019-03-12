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
  <style>
.bg-img {
  min-height: 100%;
  width: 100%;
  height: auto;
  position: fixed;
  top: 0;
  left: 0;
  opacity: 0.8;
    filter: alpha(opacity=50); /* For IE8 and earlier */
}
.trans{
  position: relative;
  background-color: #000000cc;
  color:#fff
}
</style>
</head>
<body class="hold-transition login-page">
<div class="clearops"></div>
<div >
  <div class="login-box">
    <div id="notif"></div>
    <div class="login-box-body trans">
      <img class="logo-img" src="<?php echo base_url('dist/img/telkomsel.png');?>"/>
      <h1 class="login-box-msg"><b>Sign</b>In</h1>
      <form id="myform" >
        <div class="form-group has-feedback">
          <input id ="name" type="text" class="form-control" placeholder="Username">
          <input id="token" type="hidden" value="<?php echo $token;?>"/>
          <span class="fa fa-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input id="pass" type="password" class="form-control" placeholder="Password">
          <span class="fa fa-lock form-control-feedback"></span>
        </div>
        <div class="row">
          <div class="col-xs-12">
            <button id="login_load" type="submit" class="btn btn-info btn-block btn-flat"><i class="fa fa-sign-in"></i>
            Sign In</button>
          </div>
        </div>
      </form>
      <div class="margin">
        <!-- Vas Apps -->
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
