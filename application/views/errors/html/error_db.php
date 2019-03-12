<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Database Error</title>
<link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>">
<link rel="stylesheet" href="<?php echo base_url('dist/css/AdminLTE.min.css');?>">
<link rel="stylesheet" href="<?php echo base_url('dist/css/AdminLTE.css');?>">
<style type="text/css">
::selection { background-color: #E13300; color: white; }
::-moz-selection { background-color: #E13300; color: white; }

body {
	background-color: #fff;
	margin: 40px;
	font: 13px/20px normal Helvetica, Arial, sans-serif;
	color: #4F5155;
}

a {
	color: #003399;
	background-color: transparent;
	font-weight: normal;
}

h1 {
	color: #444;
	background-color: transparent;
	border-bottom: 1px solid #D0D0D0;
	font-size: 19px;
	font-weight: normal;
	margin: 0 0 14px 0;
	padding: 14px 15px 10px 15px;
}

code {
	font-family: Consolas, Monaco, Courier New, Courier, monospace;
	font-size: 12px;
	background-color: #f9f9f9;
	border: 1px solid #D0D0D0;
	color: #002166;
	display: block;
	margin: 14px 0 14px 0;
	padding: 12px 10px 12px 10px;
}

#container {
	margin: 10px;
	border: 1px solid #D0D0D0;
	box-shadow: 0 0 8px #D0D0D0;
}

p {
	margin: 12px 15px 12px 15px;
}
</style>
</head>
<body class="bg-black">
	<div class="col-md-4  col-md-offset-4" id="login-box">
        <div class="box-header with-border  bg-maroon text-center"><h3 class="box-title"><b>Page Not Found</b></h3></div>
            <div class="box-body bg-gray">
                    <img width="100%" src="<?php echo base_url('dist/img/error_page.jpg');?>"/>
            </div>
             <div class="footer">                    
            <a href="<?php echo base_url();?>" class="btn btn-lg btn-flat bg-maroon btn-block">Click here to refresh page</a>
        </div>
    </div>
	<!---div id="container">
		<h1><?php echo $heading; ?></h1>
		<?php echo $message; ?>
	</div--->
</body>
</html>