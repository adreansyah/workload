<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//Parameter URI
$parameter_url 	  = $this->uri->segment(1);
$parameter_direct = $this->uri->segment(2);
$parameter_edit   = $this->uri->segment(3);
$parameter_status = $this->uri->segment(4);
$parameter_parent = $this->uri->segment(5);
$parameter_id	  = $this->uri->segment(6);

//CRUD Link
$link_cancel = array($parameter_url ,$parameter_direct);
$link_delete = array($parameter_url ,$parameter_direct,'delete',$parameter_id);

//SWITCH CRUD CONDITION
switch($parameter_edit)
{
	case 'edit-parent':
		//Action form
		$actionlink = array('ControllerPost','post_menu','edit-parent',$parameter_id );
		
		//Button
		$button  	= '<button type="submit" class="btn btn-primary">Save Edit</button>';
		$button    .= ' <a href="'.site_url($link_cancel).'"><button type="button" class="btn btn-warning">Cancel</button></a>';
		$button    .= ' <a href="'.site_url($link_delete).'"><button type="button" class="btn btn-danger">Delete</button></a>';	
		
		//Row table
		$row_menuid  		= $edit_menu[0]['menuid'];
		$row_menu_name 		= ucfirst($edit_menu[0]['menu_item_name']);
		$row_menu_url  		= $edit_menu[0]['menu_url'];
		$row_menu_type 		= ucfirst($edit_menu[0]['mntype']);
		$row_menu_pid  		= ucfirst($edit_menu[0]['pid']);
		$row_menu_model	 	= ucfirst($edit_menu[0]['model']);
		$row_menu_sortorder = ucfirst($edit_menu[0]['sortorder']);
		$row_menu_status	= ucfirst($edit_menu[0]['status']);
		$row_menu_icon		= $edit_menu[0]['icon'];
		$row_menu_isdefault	= ucfirst($edit_menu[0]['isdefault']);
		
		//Other
		$menus_title  = '<i class="fa fa-edit"></i> Menus Edit Children';
		$hides_parent = '';
		$hides = 'hidden';
	break;
	case 'delete-parent':
		//Action form
		$actionlink  = array('ControllerPost','post_menu','delete-parent',$parameter_id );
		
		//Button
		$button 	 = ' <a href="'.site_url($link_cancel).'"><button type="button" class="btn btn-warning">Cancel</button></a>';
		$button 	.= ' <button type="	submit" class="btn btn-danger">Delete</button>';
		
		//Row table
		$row_menuid  		= $edit_menu[0]['menuid'];
		$row_menu_name 		= ucfirst($edit_menu[0]['menu_item_name']);
		$row_menu_url  		= $edit_menu[0]['menu_url'];
		$row_menu_type 		= ucfirst($edit_menu[0]['mntype']);
		$row_menu_pid  		= ucfirst($edit_menu[0]['pid']);
		$row_menu_model	 	= ucfirst($edit_menu[0]['model']);
		$row_menu_sortorder = ucfirst($edit_menu[0]['sortorder']);
		$row_menu_status	= ucfirst($edit_menu[0]['status']);
		$row_menu_icon		= $edit_menu[0]['icon'];
		$row_menu_isdefault	= ucfirst($edit_menu[0]['isdefault']);
		
		//Other
		$menus_title  = '<i class="fa fa-edit"></i> Menus Edit';
		$hides_parent = '';
		$hides = '';
	break;
	case 'add-children':
		//Action form
		$actionlink  = array('ControllerPost','post_menu','add-children',$parameter_id );
		
		//Button
		$button 	 = ' <a href="'.site_url($link_cancel).'"><button type="button" class="btn btn-warning">Cancel</button></a>';
		$button 	.= ' <button type="submit" class="btn btn-primary">Submit</button>';

		//Row table
		$row_menuid  		= $edit_menu[0]['menuid'];
		$row_menu_name 		= '';
		$row_menu_url  		= '';
		$row_menu_type 		= '';
		$row_menu_pid  		= '';
		$row_menu_model	 	= '';
		$row_menu_sortorder = '';
		$row_menu_status	= '';
		$row_menu_icon		= '';
		$row_menu_isdefault	= '';
		
		//Other
		$menus_title  = '<i class="fa fa-object-group"></i> Menus Children';
		$hides_parent = 'hidden';
		$hides = '';
	break;
	case 'edit-children':
		//Action form
		$actionlink = array('ControllerPost','post_menu','edit-children',$parameter_id );
		
		//Button
		$button  	= '<button type="submit" class="btn btn-primary">Save Edit</button>';
		$button    .= ' <a href="'.site_url($link_cancel).'"><button type="button" class="btn btn-warning">Cancel</button></a>';
		
		//Row table
		$row_menuid  		= $edit_menu[0]['menuid'];
		$row_menu_name 		= ucfirst($edit_menu[0]['menu_item_name']);
		$row_menu_url  		= $edit_menu[0]['menu_url'];
		$row_menu_type 		= ucfirst($edit_menu[0]['mntype']);
		$row_menu_pid  		= ucfirst($edit_menu[0]['pid']);
		$row_menu_model	 	= ucfirst($edit_menu[0]['model']);
		$row_menu_sortorder = ucfirst($edit_menu[0]['sortorder']);
		$row_menu_status	= ucfirst($edit_menu[0]['status']);
		$row_menu_icon		= $edit_menu[0]['icon'];
		$row_menu_isdefault	= ucfirst($edit_menu[0]['isdefault']);
		
		//Other
		$menus_title  = '<i class="fa fa-edit"></i> Menus Edit Children';
		$hides_parent = 'hidden';
		$hides = '';
	break;
	default:
		//Action form
		$actionlink   = array('ControllerPost','post_menu','add-parent');
		
		//Button
		$button 	  = '<button type="submit" class="btn btn-primary">Submit</button>';
		
		//Row table
		$row_menuid  		= '';
		$row_menu_name 		= '';
		$row_menu_url  		= '';
		$row_menu_type 		= '';
		$row_menu_pid  		= '';
		$row_menu_model	 	= '';
		$row_menu_sortorder = '';
		$row_menu_status	= '';
		$row_menu_icon		= '';
		$row_menu_isdefault	= '';
		
		//Other
		$menus_title  = '<i class="fa fa-object-ungroup"></i> Menus Parent';
		$hides_parent = '';
		$hides = 'hidden';
	break;	
}
?>
<!--@Start Content-->
<div class="content-wrapper">
	<section class="content-header">
	  <h1>
		<i class="fa fa-th"></i> Menu modul
		<small>Menu modul</small>
	  </h1>
	  <ol class="breadcrumb">
		<li><a href="#"><i class="fa fa-dashboard"></i>Menu modul</a></li>
		<li class="active">Menu modul</li>
	  </ol>
	</section>
	<section class="content">
		<div class="row">
			<div class="col-md-6">
				<div class="box box-danger">
				<div class="box-header with-border">
				  <h3 class="box-title"><?php echo $menus_title;?></h3>
				</div>								
				<form role="form" action="<?php echo site_url($actionlink)?>" method="post">
				  <div class="box-body">
				  <?php echo $this->session->flashdata('message'); ?>
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
							  <label for="exampleInputEmail1">menu Item</label>
							  <?php echo form_input(
									array('type'=>'text',
										  'name'=>'form[menu_item_name]',
										  'id'=>'example',
										  'value'=>$row_menu_name,
										  'class' =>'form-control',
										  'placeholder' =>'menu Name...'
									));
									if($parameter_edit){echo form_input(array('type'=>'hidden','name'=>'form[menuid]','value'=>''.$row_menuid.''));}
								?>
							</div>
						</div>
						<div class="col-md-3" <?php echo $hides_parent;?>>
							<div class="form-group">
							  <label for="exampleInputPassword1">Parameter Url</label>
							  <?php echo form_input(
									array('type'=>'text',
										  'name'=>'form[menu_url]',
										  'id'=>'example',
										  'value'=>$row_menu_url,
										  'class' =>'form-control',
										  'placeholder' =>'Parameter Url...'
									));
								?>                  
							</div>
						</div>
						<div class="col-md-3" <?php echo $hides;?>>
							<div class="form-group">
							  <label for="exampleInputPassword1">Model</label>
							  <?php echo form_input(
									array('type'=>'text',
										  'name'=>'form[menu_model]',
										  'id'=>'example',
										  'value'=>$row_menu_model,
										  'class' =>'form-control',
										  'placeholder' =>'Model...'
									));
								?>                  
							</div>
						</div>
						<div class="col-md-2" <?php echo $hides_parent;?>>
							<div class="form-group">
							  <label for="exampleInputPassword1">Icon</label>
							  <?php echo form_input(
									array('type'=>'text',
										  'name'=>'form[menu_icon]',
										  'id'=>'example',
										  'value'=>$row_menu_icon,
										  'class' =>'form-control',
										  'placeholder' =>'Icon...'
									));
								?>                  
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
							  <label for="exampleInputPassword1">Sortorder</label>
							  <?php echo form_input(
									array('type'=>'text',
										  'name'=>'form[menu_sortorder]',
										  'id'=>'example',
										  'value'=>$row_menu_sortorder,
										  'class' =>'form-control',
										  'placeholder' =>'Sortorder...'
									));
								?>                  
							</div>
						</div>
					</div>
					<?php
						$checked = ' checked="checked" ';
					?>
					<div class="form-group">
						<label for="exampleInputEmail1">menu Grant</label>
						<div class="checkbox">
							<label <?php echo $hides_parent;?>>
								<input name="form[mn_type]" class="minimal" type="checkbox" <?php echo ($row_menu_type==1)? $checked:'';?>/>
								menu Type ?
							</label>
						</div>
						<div class="checkbox">
							<label>
								<input name="form[mn_status]"  class="minimal" type="checkbox" <?php echo ($row_menu_status=='ACTIVE')? $checked:'';?>/>
								Active Or Not Active ?
							</label>
						</div>                            
						<div class="checkbox">
							<label>
								<input name="form[mn_isdefault]" class="minimal" type="checkbox" <?php echo ($row_menu_isdefault==1)? $checked:'';?>/>
								Is Default ?
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
					  <h3 class="box-title"><i class="fa fa-th"></i> Menus view</h3>
					</div>
					<div class="box-body">
						<div class="row">  																		
						<?php 
						$result = array();
						foreach($data_menu as $data)
						{
							switch($data)
							{
								case ($data['pid']==0):
									$result[$data['menuid'] ] = $data;
								break;
								default:
									$result[$data['pid'] ]['children'][ $data['menuid'] ] = $data;
								break;
							}							
						}						
						$treemenu = '';
						foreach($result as $menu)
						{							
						// echo'<pre>';				
						// 	print_r($menu);
						// 	exit();			
							$type = $menu['mntype'];
							if($menu['status'] === 'ACTIVE'){
								$color_stat = 'text-teal';
								$status = 'Active';
							}
							else{
								$color_stat = 'text-red';
								$status = 'Nonactive';
							}	
							switch($type)
							{
								 case ($type==1):
									$parameter_direct;
									$childs 	= &$menu['children'];
									$parenturl  = $menu['menu_url'];
									$parentname = $menu['menu_item_name'];
									$parenticon = $menu['icon'];
									$model 		= $menu['model'];
									
									$edit_parent   = array($parameter_url,$parameter_direct,'edit-parent','parent',$parentname = str_replace(" ","-",strtolower($menu['menu_item_name'])),$menu['menuid']);
									$delete_parent = array($parameter_url,$parameter_direct,'delete-parent','parent',$parentname =  str_replace(" ","-",strtolower($menu['menu_item_name'])),$menu['menuid']);
									$append_child  = array($parameter_url,$parameter_direct,'add-children','parent',$parentname =  str_replace(" ","-",strtolower($menu['menu_item_name'])),$menu['menuid']);
									
									$treemenu .= '<div class="col-md-12">';
									$treemenu .= '<div class="box box-danger bg-black collapsed-box">';
									$treemenu .= '<div class="box-header with-border">';
									$treemenu .= '<h3 class="box-title text-teal"><i class="'.$parenticon.'"></i> <b>'.strtoupper($parentname).' <small class="'.$color_stat.'"><i>'.$status.'</i></small></b></h3>';
									$treemenu .= '<div class="box-tools pull-right">';
									$treemenu .= '<a class="btn" data-widget="collapse"><i class="fa fa-plus text-teal"></i></a>';
									$treemenu .= '<a href="'.site_url($append_child).'" class="btn" title="append children"><i class="fa fa-object-group text-teal"></i></a>';
									$treemenu .= '<a href="'.site_url($edit_parent).'" class="btn" title="edit"><i class="fa fa-edit text-teal"></i></a>';
									$treemenu .= '<a href="'.site_url($delete_parent).'" class="btn" title="edit"><i class="fa fa-times text-teal"></i></a>';								
									$treemenu .= '</div>';
									$treemenu .= '</div>';											
									if(!empty($childs)) 
									{												
										$treemenu .= '<div class="box-body">';
										foreach($childs as $child=>$mn)
										{				
											// print_r($mn);
											// exit();
											if($mn['status'] === 'ACTIVE'){
												$color_stat = 'text-teal';
												$status = 'Active';
											}
											else{
												$color_stat = 'text-red';
												$status = 'Nonactive';
											}											
											$menumodel = strtolower($mn['model']);
											$childname = $mn['menu_item_name'];
											$sortorder = $mn['sortorder'];
											$link = array($parenturl,$menumodel);
											$class ='';
											$icon = 'fa far fa-circle ';	
											$edit_children   = array($parameter_url,$parameter_direct,'edit-children','parent',md5(str_replace(' ','-',strtolower($childname))),$mn['menuid']);
											$treemenu .= '<p class=""><i class="fa far fa-circle  '.$color_stat.'"> '.$sortorder.').</i> <b>'.$childname.' <small class="'.$color_stat.'"><i>'.$status.'</i></small></b>';
											$treemenu .= '<a href="'.site_url($edit_children).'" class="btn btn-box-tool pull-right" title="edit"><i class="fa far fa-edit text-teal"></i></a>';										
											$treemenu .= '</p>';											
										}
										$treemenu .= '</div>';										
									}
									$treemenu .= '</div>';
									$treemenu .= '</div>';
								 break;								 
							}
						}
						echo $treemenu;											
						?>									
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<!---@End Content--->