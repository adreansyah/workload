<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$parameter_1 = $this->uri->segment(1);
$parameter_2 = $this->uri->segment(2);
$parameter_edit = $this->uri->segment(3);
$parameter_id = $this->uri->segment(4);
$link_cancel = array($parameter_1,$parameter_2);
$link_delete = array($parameter_1,$parameter_2,'delete',$parameter_id);
switch($parameter_edit)
{
	case 'edit':
		$actionlink = array('ControllerPost','post_division','edit',$parameter_id );
		$button  = '<button type="submit" class="btn btn-primary">Save Edit</button>';
		$button .= ' <a href="'.site_url($link_cancel).'"><button type="button" class="btn btn-warning">Cancel</button></a>';
		$button .= ' <a href="'.site_url($link_delete).'"><button type="button" class="btn btn-danger">Delete</button></a>';	
		$row_divisionid   = $edit_division[0]['divid'];
		$row_divisiontag = $edit_division[0]['divtag'];
		$row_divisionname = ucfirst($edit_division[0]['divname']);
		$row_description  = ucfirst($edit_division[0]['description']);
	break;
	case 'delete':
		$actionlink = array('ControllerPost','post_division','delete',$parameter_id );
		$button = ' <a href="'.site_url($link_cancel).'"><button type="button" class="btn btn-warning">Cancel</button></a>';
		$button .= ' <button type="	submit" class="btn btn-danger">Delete</button>';
		$row_divisionid   = $edit_division[0]['divid'];
		$row_divisiontag  = '';
		$row_divisionname = '';
		$row_description  = '';
	break;
	default:
		$actionlink = array('ControllerPost','post_division','add');
		$button ='<button type="submit" class="btn btn-primary">Submit</button>';
		$row_divisionid   = '';
		$row_divisiontag = '';
		$row_divisionname = '';
		$row_description  = '';
	break;
}
?>
<div class="content-wrapper">
	<section class="content-header">
	  <h1>
		<i class="fa fa-bank"></i> division
		<small>division</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i>division</a></li>
		<li class="active">division</li>
	  </ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="box box-danger">
				<div class="box-header with-border">
				  <h3 class="box-title">Add division</h3>
				</div>								
				<form role="form" action="<?php echo site_url($actionlink)?>" method="post">
				  <div class="box-body">
				  <?php echo $this->session->flashdata('message'); ?>
					<div class="form-group">
					  <label for="exampleInputEmail1">division Tag</label>
					  <?php echo form_input(
							array('type'=>'text',
								  'name'=>'form[divisiontag]',
								  'id'=>'example',
								  'value'=>$row_divisiontag,
								  'class' =>'form-control',
								  'placeholder' =>'division Tag...'
							));
							if($parameter_edit){echo form_input(array('type'=>'hidden','name'=>'form[divisionid]','value'=>$row_divisionid));}
						?>
					</div>
					<div class="form-group">
					  <label for="exampleInputPassword1">division name</label>
					  <?php echo form_input(
							array('type'=>'text',
								  'name'=>'form[divisionname]',
								  'id'=>'example',
								  'value'=>$row_divisionname,
								  'class' =>'form-control',
								  'placeholder' =>'division Name...'
							));
						?>                  
					</div>
					<div class="form-group">
					  <label for="exampleInputPassword1">Description</label>
					  <?php echo form_input(
							array('type'=>'text',
								  'name'=>'form[description]',
								  'id'=>'example',
								  'value'=>$row_description,
								  'class' =>'form-control',
								  'placeholder' =>'Description...'
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
					  <h3 class="box-title">Table division</h3>
					</div>
					<div class="box-body">
						<div class="table-responsive">          
							<table class="table table-bordered table-striped">
								<thead>
								  <tr>
									<th>#</th>
									<th width="20%">division Tag</th>
									<th>division Name</th>
									<th>Description</th>
									<th>Edit</th>
								  </tr>
								</thead>
								<tbody>
								<?php
									$no = 1;
									foreach($data_division as $key =>$data)
									{
										$link_edit = array($parameter_1,$parameter_2,'edit',$data['divid']);
										switch ($parameter_id)
										{
											case ($data['divid']):
												$edit_table = '<td><a><span class="badge bg-green">Current Edit</span></a></td>';
											break;
											default:
												$edit_table ='<td><a href="'.site_url($link_edit).'"><span class="badge bg-red">Edit</span></a></td>' ;
											break;
										}										
										echo'
											<tr>
												<td>'.$no.'.'.'</td>
												<td>'.ucfirst($data['divtag']).'</td>
												<td>'.ucfirst($data['divname']).'</td>
												<td>'.ucfirst($data['description']).'</td>
												'.$edit_table.'
											</tr>
										';
										$no++;
									}
								?>								  
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>