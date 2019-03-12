<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	$variable = $this->uri->segment(1);
?>
	<footer class="main-footer">
		<div class="pull-right hidden-xs">
		  <b><i class="fab fa-windows"></i> Version</b> 2.3.8
		</div>
		<strong><i class="fa fa-laptop"></i> <?php echo $user_agent?> <?php echo $user_platform;?></strong>
	</footer>
	</div>
</body>
<script src="<?php echo base_url('plugins/jQuery/jquery-2.2.3.min.js')?>"></script>
<script src="<?php echo base_url('plugins/jQuery/jquery-ui.min.js')?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/qs/6.5.1/qs.min.js"></script>
<script src="<?php echo base_url('fullcalendar/lib/moment.min.js');?>"></script>
<script src="<?php echo base_url('dist/js/jquery.easing.min.js')?>" type="text/javascript"></script>
<script src="<?php echo base_url('dist/js/axios.js')?>"></script>
<script src="<?php echo base_url('dist/js/qs.min.js')?>"></script>
<script src="<?php echo base_url('dist/js/lobipanel/lobipanel.min.js')?>"></script>
<script src="<?php echo base_url('dist/ajax/ui.js')?>" type="text/javascript" ></script>
<script src="<?php echo base_url('dist/ajax/select.js')?>"  type="text/javascript" ></script>
<script src="<?php echo base_url('bootstrap/js/bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('dist/css/interface/js/lib/datatables-net/datatables.js');?>"></script>
<script src="<?php echo base_url('dist/css/interface/js/lib/datatables-net/datatables.min.js');?>"></script>
<script src="<?php echo base_url('dist/css/interface/js/lib/datatables-net/buttons-1.2.0/js/dataTables.buttons.min.js');?>"></script>
<script src="<?php echo base_url('plugins/datatables/dataTables.bootstrap.min.js');?>"></script>
<script src="<?php echo base_url('plugins/datepicker/bootstrap-datepicker.js');?>"></script>
<script src="<?php echo base_url('dist/js/bootstrap-timepicker.min.js')?>"></script>
<script src="<?php echo base_url('plugins/pace/pace.min.js');?>"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="<?php echo base_url('plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')?>"></script>
<script src="<?php echo base_url('plugins/slimScroll/jquery.slimscroll.min.js')?>"></script>
<script src="<?php echo base_url('plugins/fastclick/fastclick.js')?>"></script>
<script src="<?php echo base_url('plugins/morris/morris.min.js')?>"></script>
<script src="<?php echo base_url('plugins/iCheck/icheck.min.js')?>"></script>
<script src="<?php echo base_url('dist/js/app.min.js')?>"></script>
<script src="<?php echo base_url('dist/js/demo.js')?>"></script>
<script src="<?php echo base_url('node_modules/izitoast/dist/js/iziToast.js')?>"></script>
<script src="<?php echo base_url('node_modules/izitoast/dist/js/iziToast.min.js')?>"></script>
<script src="<?php echo base_url('node_modules/loading-overlay/dist/loadingoverlay.min.js')?>"  type="text/javascript" ></script>
<script src="<?php echo base_url('dist/ajax/MainFunction.js')?>" type="text/javascript" ></script>
<?php
if($variable == 'welcome'){
	echo '
	<script src="https://code.highcharts.com/gantt/highcharts-gantt.js"></script>



	<script src="'.base_url('dist/ajax/gantchart.js').'" type="text/javascript" ></script>
	';
}
?>
<script src="<?php echo base_url('dist/ajax/workload.js')?>" type="text/javascript" ></script>
<script>
$(document).ajaxStart(function() {
	Pace.restart();
});

$('#datepicker,#datepicker2').datepicker({
  autoclose: true
});

$.widget.bridge('uibutton', $.ui.button);

$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
  checkboxClass: 'icheckbox_minimal-red',
  radioClass: 'iradio_minimal-blue'
});
</script>
</html>
