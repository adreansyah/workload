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
		$actionlink = array('ControllerPost','post_usergroup','edit',$parameter_id );
		$button  = '<button type="submit" class="btn btn-primary">Save Edit</button>';
		$button .= ' <a href="'.site_url($link_cancel).'"><button type="button" class="btn btn-warning">Cancel</button></a>';
		$button .= ' <a href="'.site_url($link_delete).'"><button type="button" class="btn btn-danger">Delete</button></a>';	
		$row_usergroupid   = $edit_usergroup[0]['groupID'];
		$row_usergroupname = ucfirst($edit_usergroup[0]['groupname']);
		$row_description  = ucfirst($edit_usergroup[0]['description']);
		$has = 'has-success';
	break;
	case 'delete':
		$actionlink = array('ControllerPost','post_usergroup','delete',$parameter_id );
		$button = ' <a href="'.site_url($link_cancel).'"><button type="button" class="btn btn-warning">Cancel</button></a>';
		$button .= ' <button type="	submit" class="btn btn-danger">Delete</button>';
		$row_usergroupid   = $edit_usergroup[0]['groupID'];
		$row_usergroupcode = '';
		$row_usergroupname = '';
		$row_description  = '';
		$has = '';
	break;
	default:
		$actionlink = array('ControllerPost','post_usergroup','add');
		$button ='<button type="submit" class="btn btn-primary">Submit</button>';
		$row_usergroupid   = '';
		$row_usergroupcode = '';
		$row_usergroupname = '';
		$row_description  = '';
		$has = '';
	break;
}
?>
<div class="content-wrapper">
	<section class="content-header">
	  <h1>
		<i class="fa fa-users"></i> usergroups
		<small>usergroups</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i>usergroups</a></li>
		<li class="active">usergroups</li>
	  </ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="box box-danger">
				<div class="box-header with-border">
				  <h3 class="box-title">Add usergroups</h3>
				</div>								
				<form role="form" action="<?php echo site_url($actionlink)?>" method="post">
				  <div class="box-body">
				  <?php echo $this->session->flashdata('message'); ?>
					<div class="form-group <?php echo $has?>">
					  <label for="exampleInputPassword1">usergroup name</label>
					  <?php echo form_input(
							array('type'=>'text',
								  'name'=>'form[usergroupname]',
								  'id'=>'example',
								  'value'=>$row_usergroupname,
								  'class' =>'form-control',
								  'placeholder' =>'usergroup Name...'
							));
							if($parameter_edit){echo form_input(array('type'=>'hidden','name'=>'form[usergroupid]','value'=>$row_usergroupid));}
						?>                  
					</div>
					<div class="form-group <?php echo $has?>">
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
					  <h3 class="box-title">Table userrgroup</h3>
					</div>
					<div class="box-body">
						<div class="table-responsive">          
							<table class="table table-bordered table-striped">
								<thead>
								  <tr>
									<th>#</th>
									<th>Usergroup Name</th>
									<th>Description</th>
									<th>Edit</th>
								  </tr>
								</thead>
								<tbody>
								<?php
									$no = 1;
									foreach($data_usergroup as $key =>$data)
									{
										$link_edit = array($parameter_1,$parameter_2,'edit',$data['groupID']);
										switch($parameter_id)
										{
											case ($data['groupID']):
												$edit_table = '<td><a><span class="badge bg-green">Current Edit</span></a></td>';
											break;
											default:
												$edit_table ='<td><a href="'.site_url($link_edit).'"><span class="badge bg-red">Edit</span></a></td>' ;
											break;
										}
										echo'
											<tr>
												<td>'.$no.'.'.'</td>
												<td>'.ucfirst($data['groupname']).'</td>
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