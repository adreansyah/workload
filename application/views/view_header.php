<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$variable = $this->uri->segment(3);
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo TITLE;?></title>

<?php if($variable == 'additem'){ ?>
<?php }else{?>
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<?php }?>

<link rel="icon" href="<?php echo base_url('favicon.ico');?>" type="image/x-icon">
<link rel="stylesheet" href="<?php echo base_url('bootstrap/css/bootstrap.min.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url('dist/web-fonts-with-css/css/fontawesome-all.min.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url('dist/css/lib/datatables-net/responsive-2.1.0/css/responsive.dataTables.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url('dist/css/lib/datatables-net/responsive-2.1.0/css/responsive.dataTables.min.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url('dist/css/lib/datatables-net/buttons-1.2.0/css/buttons.dataTables.min.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url('plugins/datatables/dataTables.bootstrap.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url('dist/css/AdminLTE.min.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url('dist/css/AdminLTE.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url('dist/css/animate.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url('dist/css/skins/_all-skins.min.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url('plugins/iCheck/flat/blue.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url('plugins/datepicker/datepicker3.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url('plugins/daterangepicker/daterangepicker.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url('dist/css/bootstrap-timepicker.min.css')?>"/>
<link rel="stylesheet" href="<?php echo base_url('plugins/pace/pace.min.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url('plugins/iCheck/all.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url('dist/css/lib/lobipanel/lobipanel.min.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url('dist/css/separate/vendor/lobipanel.min.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url('node_modules/izitoast/dist/css/iziToast.css');?>"/>
<link rel="stylesheet" href="<?php echo base_url('node_modules/izitoast/dist/css/iziToast.min.css');?>"/>
</head>
<body class="skin-black sidebar-collapse wysihtml5-supported">
<div class="wrapper">
