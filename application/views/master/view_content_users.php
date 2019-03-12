<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$actionlink = array('ControllerPost','do_upload');
$parameter_1 = $this->uri->segment(1);
$parameter_2 = $this->uri->segment(2);
$parameter_edit = $this->uri->segment(3);
$parameter_id = $this->uri->segment(4);
$link_cancel = array($parameter_1,$parameter_2);
$link_delete = array($parameter_1,$parameter_2,'delete',$parameter_id);
switch($parameter_edit)
{
	case 'edit':
		$actionlink = array('ControllerPost','do_upload','edit',$parameter_id );
		$button  = '<button type="submit" class="btn btn-primary">Save Edit</button>';
		$button .= ' <a href="'.site_url($link_cancel).'"><button type="button" class="btn btn-warning">Cancel</button></a>';
		$button .= ' <a href="'.site_url($link_delete).'"><button type="button" class="btn btn-danger">Delete</button></a>';	
		$row_userid   = $edit_users[0]['userid'];
		$row_username = $edit_users[0]['username'];
		$row_displayname = ucfirst($edit_users[0]['displayname']);
		$row_password  = ucfirst($edit_users[0]['password']);
		$row_email  = ucfirst($edit_users[0]['email']);
		$row_no_telfon  = ucfirst($edit_users[0]['no_telfon']);
		$row_areaid  = ucfirst($edit_users[0]['areaid']);
		$row_divid  = ucfirst($edit_users[0]['divid']);
		$row_avatar = ucfirst($edit_users[0]['avatar']);
		$row_level = ucfirst($edit_users[0]['level']);
		if($row_level == 'A')
		{
			$row_lvl = 999;
		} 
		else
		{
			
		}
		$has = 'has-success';
	break;
	case 'delete':
		$actionlink = array('ControllerPost','do_upload','delete',$parameter_id );
		$button = ' <a href="'.site_url($link_cancel).'"><button type="button" class="btn btn-warning">Cancel</button></a>';
		$button .= ' <button type="	submit" class="btn btn-danger">Delete</button>';
		$row_userid = $edit_users[0]['userid'];
		$row_username = $edit_users[0]['username'];
		$row_displayname = ucfirst($edit_users[0]['displayname']);
		$row_password = ucfirst($edit_users[0]['password']);
		$row_email = ucfirst($edit_users[0]['email']);
		$row_no_telfon = ucfirst($edit_users[0]['no_telfon']);
		$row_areaid = ucfirst($edit_users[0]['areaid']);
		$row_divid  = ucfirst($edit_users[0]['divid']);
		$row_avatar = ucfirst($edit_users[0]['avatar']);
		$row_level  = ucfirst($edit_users[0]['level']);
		if($row_level == 'A')
		{
			$row_lvl = 999;
		} 
		else
		{
			
		}
		$has = ucfirst($edit_users[0]['level']);
	break;
	default:
		$actionlink = array('ControllerPost','do_upload','add');
		$button ='<button type="submit" class="btn btn-primary">Submit</button>';
		$row_userid   = '';
		$row_username = '';
		$row_displayname = '';
		$row_password = '';
		$row_email = '';
		$row_no_telfon = '';
		$row_areaid  = '';
		$row_divid   = '';
		$row_avatar  = '';
		$row_level   = '';
		$has = '';
	break;
}
?>
<div class="content-wrapper">
	<section class="content-header">
	  <h1>
		<i class="fa fa-users"></i> Users
		<small>Users</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i>Users</a></li>
		<li class="active">Users</li>
	  </ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-5">
				<div class="box box-danger">
				<div class="box-header with-border">
				  <h3 class="box-title">Add User <i class="fa fa-plus"></i></h3>
				</div>								
				<?php echo form_open_multipart(site_url($actionlink));?>
				  <div class="box-body">
				  <?php echo $this->session->flashdata('message'); ?>
					<div class="form-group <?php echo $has?>">
					  <label for="exampleInputEmail1">Username</label>
					  <?php echo form_input(
							array('type'=>'text',
								  'name'=>'form[username]',
								  'id'=>'example',
								  'value'=>$row_username,
								  'class' =>'form-control',
								  'placeholder' =>'Username...'
							));
							if($parameter_edit){echo form_input(array('type'=>'hidden','name'=>'form[userid]','value'=>$row_userid));}
						?>
					</div>
					<div class="form-group <?php echo $has?>">
					  <label for="exampleInputEmail1">Displayname</label>
					  <?php echo form_input(
							array('type'=>'text',
								  'name'=>'form[displayname]',
								  'id'=>'example',
								  'value'=>$row_displayname,
								  'class' =>'form-control',
								  'placeholder' =>'Displayname...'
							));
						?>
					</div>
					<div class="form-group <?php echo $has?>">
					  <label for="exampleInputEmail1">Password</label>
					  <?php echo form_input(
							array('type'=>'password',
								  'name'=>'form[password]',
								  'id'=>'example',
								  'value'=>'',
								  'class' =>'form-control',
								  'placeholder' =>'Password...'
							));
						?>
					</div>
					<div class="form-group <?php echo $has?>">
					  <label for="exampleInputEmail1">Email</label>
					  <?php echo form_input(
							array('type'=>'email',
								  'name'=>'form[email]',
								  'id'=>'example',
								  'value'=>$row_email,
								  'class' =>'form-control',
								  'placeholder' =>'Email...'
							));
						?>
					</div>
					<div class="form-group <?php echo $has?>">
					  <label for="exampleInputEmail1">Phone Number</label>
					  <?php echo form_input(
							array('type'=>'text',
								  'name'=>'form[no_telfon]',
								  'id'=>'example',
								  'value'=>$row_no_telfon,
								  'class' =>'form-control',
								  'placeholder' =>'Phone Number...'
							));
						?>
					</div>
					<div class="form-group">
					  <label for="exampleInputEmail1">Avatar</label>
					  <?php echo form_input(
							array('type'=>'file',
								  'name'=>'avatar',
								  'value'=>$row_avatar
							));							
						?>
						<p class="help-block">
							<?php
							$avatarfile = ltrim($row_avatar,'.');
							if(file_exists($row_avatar))
							{
								//echo '<img src="'.$avatarfile.'"/>';
								echo '<img src="'.$avatarfile.'" class="" alt="User Image" />';
							}
							?>                               
						</p>
					</div>
					<div class="row">
						<div class="col-xs-12">
							<div class="form-group <?php echo $has?>">
								<label>Level</label>
								<select name="form[level]" class="form-control select2" style="width: 100%;">
								  <option value="">Select</option>
									<?php 
										foreach($select_group as $row_group)
										{
											echo $tbl_groupID = $row_group['groupID'];											
											$options = '';
											if($tbl_groupID==$row_lvl)
											{
												$options = 'selected="selected"';
											}
											echo '<option value="'.$row_group['groupID'].'" '.$options.'>⌘ '.ucwords(strtolower($row_group['groupname'])).'</option>'; 
										}
									?>								  
								</select>
							</div>
						</div>			
					</div>
				  </div>
				  <div class="box-footer">
					<?php echo $button;?>
				  </div>
				</form>
			  </div>
			</div>
			<div class="col-md-7">
				<div class="box box-danger">
					<div class="box-header with-border">
					  <h3 class="box-title">All Users</h3>
					</div>
					<div class="box-body table-responsive">
						<table class="table table-bordered table-striped">
							<thead>
							  <tr>
								<th width="5%">#</th>
								<th>Username</th>
								<th>Displayname</th>
								<th>Password</th>
								<th>Level</th>
								<th>Edit</th>
							  </tr>
							</thead>
							<tbody>
								<?php 
									$no = 1;
									foreach($data_users as $key =>$data)
									{
										$link_edit = array($parameter_1,$parameter_2,'edit',$data['userid']);
										switch($parameter_id)
										{
											case ($data['userid']):
												$edit_table = '<td><a href="'.site_url(array($parameter_1,$parameter_2)).'"><span class="badge bg-green">Current Edit</span></a></td>';
											break;
											default:
												$edit_table = '<td><a href="'.site_url($link_edit).'"><span class="badge bg-red">Edit</span></a></td>' ;
											break;
										}										
										echo'
											<tr>
												<td>'.$no.'.'.'</td>
												<td>'.ucfirst($data['username']).'</td>
												<td>'.ucfirst($data['displayname']).'</td>
												<td>'.ucfirst($data['password']).'</td>
												<td>'.ucfirst($data['level']).'</td>
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
	</section>
</div>