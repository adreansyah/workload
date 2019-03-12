<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$parameter_1 = $this->uri->segment(1);
$parameter_2 = $this->uri->segment(2);
$parameter_edit = $this->uri->segment(3);
$parameter_id = $this->uri->segment(4);
$link_cancel = array($parameter_1,$parameter_2);
$link_delete = array($parameter_1,$parameter_2,'delete',$parameter_id);
switch ($parameter_edit)
{
	case 'edit':
		$actionlink = array('ControllerPost','post_area','edit',$parameter_id );
		$button  = '<button type="submit" class="btn btn-primary">Save Edit</button>';
		$button .= ' <a href="'.site_url($link_cancel).'"><button type="button" class="btn btn-warning">Cancel</button></a>';
		$button .= ' <a href="'.site_url($link_delete).'"><button type="button" class="btn btn-danger">Delete</button></a>';	
		$row_areaid   = $edit_area[0]['areaid'];
		$row_areacode = $edit_area[0]['areacode'];
		$row_areaname = ucfirst($edit_area[0]['areaname']);
		$row_address  = ucfirst($edit_area[0]['address']);
	break;
	case 'delete':
		$actionlink = array('ControllerPost','post_area','delete',$parameter_id );
		$button = ' <a href="'.site_url($link_cancel).'"><button type="button" class="btn btn-warning">Cancel</button></a>';
		$button .= ' <button type="	submit" class="btn btn-danger">Delete</button>';
		$row_areaid   = $edit_area[0]['areaid'];
		$row_areacode = '';
		$row_areaname = '';
		$row_address  = '';
	break;	
	default:
		$actionlink = array('ControllerPost','post_area','add');
		$button ='<button type="submit" class="btn btn-primary">Submit</button>';
		$row_areaid   = '';
		$row_areacode = '';
		$row_areaname = '';
		$row_address  = '';
	break;	
}
?>
<div class="content-wrapper">
	<section class="content-header">
	  <h1>
		<i class="fa fa-map-marker"></i> Location Areas
		<small>Areas</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i>Areas</a></li>
		<li class="active">Areas</li>
	  </ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="box box-danger">
				<div class="box-header with-border">
				  <h3 class="box-title">Add Areas</h3>
				</div>								
				<form role="form" action="<?php echo site_url($actionlink)?>" method="post">
				  <div class="box-body">
				  <?php echo $this->session->flashdata('message'); ?>
					<div class="form-group">
					  <label for="exampleInputEmail1">Area Code</label>
					  <?php echo form_input(
							array('type'=>'text',
								  'name'=>'form[areacode]',
								  'id'=>'example',
								  'value'=>$row_areacode,
								  'class' =>'form-control',
								  'placeholder' =>'Area Code...'
							));
							if($parameter_edit){echo form_input(array('type'=>'hidden','name'=>'form[areaid]','value'=>$row_areaid));}
						?>
					</div>
					<div class="form-group">
					  <label for="exampleInputPassword1">Area name</label>
					  <?php echo form_input(
							array('type'=>'text',
								  'name'=>'form[areaname]',
								  'id'=>'example',
								  'value'=>$row_areaname,
								  'class' =>'form-control',
								  'placeholder' =>'Area Name...'
							));
						?>                  
					</div>
					<div class="form-group">
					  <label for="exampleInputPassword1">Address</label>
					  <?php echo form_input(
							array('type'=>'text',
								  'name'=>'form[address]',
								  'id'=>'example',
								  'value'=>$row_address,
								  'class' =>'form-control',
								  'placeholder' =>'Address...'
							));
						?>                  
					</div>
				  </div>
				  <div class="box-footer">
					<?php echo $button?>
				  </div>
				</form>
			  </div>
			</div>
			<div class="col-md-6">
				<div class="box box-danger">
					<div class="box-header with-border">
					  <h3 class="box-title">Table Areas</h3>
					</div>
					<div class="box-body">
						<div class="table-responsive">          
							<table class="table table-bordered table-striped">
								<thead>
								  <tr>
										<th class="text-center"><input type="checkbox" id="checkAll"/></th>
										<th class="text-center">#</th>										
										<th width="20%">Area Code</th>
										<th>Area Name</th>
										<th>Address</th>
										<th>Edit</th>
								  </tr>
								</thead>
								<tbody>
								<?php
									$no = 1;
									foreach($data_area as $key =>$data)
									{
										$link_edit = array($parameter_1,$parameter_2,'edit',$data['areaid']);
										switch ($parameter_id)
										{
											case ($data['areaid']):
												$edit_table = '<td><a><span class="badge bg-green">Current Edit</span></a></td>';
											break;
											default:
												$edit_table ='<td><a href="'.site_url($link_edit).'"><span class="badge bg-red">Edit</span></a></td>' ;
											break;
										}
										echo'
											<tr>
												<td id="checks"></td>
												<td>'.$no.'.'.'</td>												
												<td>'.ucfirst($data['areacode']).'</td>
												<td>'.ucfirst($data['areaname']).'</td>
												<td>'.ucfirst($data['address']).'</td>
												'.$edit_table.'
											</tr>
										';
										$no++;
									}
								?>								  
								</tbody>
							</table>
						</div>
						<div id="show_remove" class="text-center"></div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>