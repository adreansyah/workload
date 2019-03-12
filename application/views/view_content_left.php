<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$displayname =  $this->session->userdata('displayname');
$username  =  $this->session->userdata('username');
$avatars   =  $this->session->userdata('avatar');
$avatarsOn =  $this->session->userdata('doctor_id');
if(empty($avatarsOn)){
	$av =  0;
}
else{
	$av =  $this->session->userdata('doctor_id');
}

if(file_exists($avatars))
{
	$avatar =  trim($this->session->userdata('avatar'),'.');
}
else
{
	$avatar =  'dist/img/user2-160x160.jpg';
}
?>
<aside class="main-sidebar">
	<section class="sidebar">
	  <!-- Sidebar user panel -->
	  <div class="user-panel">
		<div id="d-img" class="pull-left">
		  <img style="margin: 0px 0px 0px -7px;" width="45px" height="45px" src="<?php echo base_url($avatar);?>" class="img-circle" alt="User Image">
		</div>
		<div class="pull-left info ">
		  <p><?php echo $displayname;?></p>
		  <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
		</div>
	  </div>
	  <!-- sidebar menu: : style can be found in sidebar.less -->
	  <ul class="sidebar-menu">
		<li class="header bg-teal"><?php echo TITLE;?></li>
		<?php if($this->session->userdata('level') == 13){?>

		<?php }elseif($this->session->userdata('level') == 12){ ?>

		<?php }elseif($this->session->userdata('level') == 3){ ?>

		<?php }elseif($this->session->userdata('level') == 5){ ?>

		<?php }else{?>
			<li class="treeview">
					<a href="<?php echo site_url('/welcome')?>"><i class="fa fas fa-signal"></i><span>Dashboard</span></a>
			</li>
		<?php }?>
		<?php echo $my_nav_left;?>
	  </ul>
	</section>
	<!-- /.sidebar -->
</aside>
<script async>
	var doc_image = <?php echo $av;?>
</script>
