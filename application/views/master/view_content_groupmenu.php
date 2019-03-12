<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$parameter_1 	= $this->uri->segment(1);
$parameter_2 	= $this->uri->segment(2);
$parameter_edit = $this->uri->segment(3);
$parameter_id 	= $this->uri->segment(4);
$link_cancel 	= array($parameter_1,$parameter_2);
$link_delete 	= array($parameter_1,$parameter_2,'delete',$parameter_id);
switch($parameter_edit)
{
	case 'edit':
		$actionlink = array('ControllerPost','post_menugroup','edit',$parameter_id );
		$button  = '<button type="submit" class="btn btn-primary">Save Edit</button>';
		$button .= ' <a href="'.site_url($link_cancel).'"><button type="button" class="btn btn-warning">Cancel</button></a>';
		$button .= ' <a href="'.site_url($link_delete).'"><button type="button" class="btn btn-danger">Delete</button></a>';
		$row_mnID		= $edit_menugroup[0]['mnID'];	
		$row_groupID	= $edit_menugroup[0]['groupID'];
		$row_groupname	= ucfirst($edit_menugroup[0]['groupname']);
		$row_menuid		= $edit_menugroup[0]['menuid'];
		$row_menuname	= ucfirst($edit_menugroup[0]['menu_item_name']);
		$row_view		= ucfirst($edit_menugroup[0]['view_access']);
		$row_add		= ucfirst($edit_menugroup[0]['add_access']);
		$row_edit		= ucfirst($edit_menugroup[0]['edit_access']);
		$row_delete  	= ucfirst($edit_menugroup[0]['delete_access']);	
		$has = 'has-success';
	break;
	case 'delete':
		$actionlink = array('ControllerPost','post_menugroup','delete',$parameter_id );
		$button  = ' <a href="'.site_url($link_cancel).'"><button type="button" class="btn btn-warning">Cancel</button></a>';
		$button .= ' <button type="	submit" class="btn btn-danger">Delete</button>';
		$row_mnID		= $edit_menugroup[0]['mnID'];	
		$row_groupID	= $edit_menugroup[0]['groupID'];
		$row_groupname	= ucfirst($edit_menugroup[0]['groupname']);
		$row_menuid		= $edit_menugroup[0]['menuid'];
		$row_menuname	= ucfirst($edit_menugroup[0]['menu_item_name']);
		$row_view		= ucfirst($edit_menugroup[0]['view_access']);
		$row_add		= ucfirst($edit_menugroup[0]['add_access']);
		$row_edit		= ucfirst($edit_menugroup[0]['edit_access']);
		$row_delete  	= ucfirst($edit_menugroup[0]['delete_access']);	
		$has = '';
	break;
	default:
		$actionlink = array('ControllerPost','post_menugroup','add');
		$button ='<button type="submit" class="btn btn-primary">Submit</button>';
		$row_mnID		= '';
		$row_groupID	= '';
		$row_groupname	= '';
		$row_menuid		= '';
		$row_menuname	= '';
		$row_view		= '';
		$row_add		= '';
		$row_edit		= '';
		$row_delete		= '';
		$has = '';
	break;
}
?>
<div class="content-wrapper">
	<section class="content-header">
	  <h1>
		<i class="fa fa-users"></i> menugroups
		<small>menugroups</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i>menugroups</a></li>
		<li class="active">menugroups</li>
	  </ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="box box-danger">
				<div class="box-header with-border">
				  <h3 class="box-title">Add menugroups</h3>
				</div>								
				<form role="form" action="<?php echo site_url($actionlink)?>" method="post">
				  <div class="box-body">
				  <?php echo $this->session->flashdata('message'); ?>
				  <div class="form-group <?php echo $has?>">
					  <label for="exampleInputPassword1">Group Name</label>
						<select name="form[level]" class="form-control select2" style="width: 100%;">
						  <option value="">Please Select</option>
							<?php 
								foreach($select_group as $row_group)
								{
									$tbl_groupID = $row_group['groupID'];											
									$options = '';
									if($tbl_groupID==$row_groupID)
									{
										$options = 'selected="selected"';
									}
									echo '<option value="'.$row_group['groupID'].'" '.$options.'>&#8984;  '.ucwords(strtolower($row_group['groupname'])).'</option>'; 
								}
							?>								  
						</select>  
						<?php if($parameter_edit){echo form_input(array('type'=>'hidden','name'=>'form[mnID]','value'=>$row_mnID));}?>
					</div>
					<div class="form-group <?php echo $has?>">
					  <label for="exampleInputPassword1">Menu Name</label>
					   <select class="form-control" name="form[menuid]">
							<option value="">Please select</option>
							<?php
							$select_menus = array();
							foreach($select_menu as $data)
							{
								switch($data['pid'])
								{
									case 0:
										$select_menus[$data['menuid'] ] = $data;
									break;
									default:
										$select_menus[$data['pid'] ]['children'][ $data['menuid'] ] = $data;
									break;
								}								
							}
							$menu_structure = '';
							foreach($select_menus as $row_menulist)
							{
								switch($row_menulist['mntype'])
								{
									case 1:
										$childs = $row_menulist['children'];
										$tbl_menuid = $row_menulist['menuid'];
										$tbl_menuname = '&#8984; '.$row_menulist['menu_item_name'];
										$options = '';
										if($row_menuid==$tbl_menuid)
										{
											$options = ' selected="selected" ';
										}
										$menu_structure .= '<option value="'.$tbl_menuid.'" '.$options.'>'.ucfirst($tbl_menuname).'</option>';
										if(!empty($childs))
										{
											foreach($childs as $child=>$mn)
											{
												$options = '';
												$child_menuid = $mn['menuid'];
												if($row_menuid==$child_menuid)
												{
													$options = ' selected="selected" ';
												}                                                
												$child_menuname = '&nbsp;&nbsp;&nbsp; &#8998; '.$mn['menu_item_name'];
												$menu_structure .= '<option value="'.$child_menuid.'" '.$options.'>'.ucfirst($child_menuname).'</option>';
											}
										}
									break;
								}								
							}
							echo $menu_structure;
							?>
						</select>                
					</div>	
					<?php
						$checked = ' checked="checked" ';
					?>
					<div class="form-group">
						<label for="exampleInputEmail1">Access Control</label>
						<div class="checkbox">
							<label>
								<input name="form[view]" class="minimal" type="checkbox" <?php echo ($row_view==1)? $checked:'';?> />
								Grant view access?
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input name="form[add]"  class="minimal" type="checkbox" <?php echo ($row_add==1)? $checked:'';?> />
								Grant add access?
							</label>
						</div>                            
						<div class="checkbox">
							<label>
								<input name="form[edit]" class="minimal" type="checkbox" <?php echo ($row_edit==1)? $checked:'';?>/>
								Grant edit access?
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input name="form[delete]" class="minimal" type="checkbox" <?php echo ($row_delete==1)? $checked:'';?>/>
								Grant delete access?
							</label>
						</div>
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
					  <h3 class="box-title">Table Menugroup</h3>
					</div>
					<div class="box-body">
						<div class="table-responsive">          
							<table class="table table-bordered table-striped">
								<thead>
								  <tr>
									<th>#</th>
									<th>Group Access</th>
									<th>Menu_name</th>
									<th>View ?</th>
									<th>Add ?</th>
									<th>Edit ?</th>
									<th>Delete ?</th>
									<th>Edit</th>
								  </tr>
								</thead>
								<tbody>
								<?php
									$no = 1;
									foreach($data_menugroup as $key =>$data)
									{
										
										$link_edit = array($parameter_1,$parameter_2,'edit',$data['mnID']);
										switch($parameter_id)
										{
											case ($data['mnID']):
												$edit_table = '<td><a><span class="badge bg-green">Current Edit</span></a></td>';
											break;
											default:
												$edit_table ='<td><a href="'.site_url($link_edit).'"><span class="badge bg-red">Edit</span></a></td>' ;
											break;
										}										
										$view 	= ($data['view_access']==1)? '<i class="fa fa-check text-green"></i>':'<i class="fa fa-times text-red"></i>';
										$add 	= ($data['add_access']==1)? '<i class="fa fa-check text-green"></i>':'<i class="fa fa-times text-red"></i>';
										$edit 	= ($data['edit_access']==1)? '<i class="fa fa-check text-green"></i>':'<i class="fa fa-times text-red"></i>';
										$delete = ($data['delete_access']==1)? '<i class="fa fa-check text-green"></i>':'<i class="fa fa-times text-red"></i>';
										echo'
											<tr>
												<td>'.$no.'.'.'</td>
												<td>'.ucfirst($data['groupname']).'</td>
												<td>'.ucfirst($data['menu_item_name']).'</td>
												<td class="text-center">'.$view.'</td>
												<td class="text-center">'.$add.'</td>
												<td class="text-center">'.$edit.'</td>
												<td class="text-center">'.$delete.'</td>
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
