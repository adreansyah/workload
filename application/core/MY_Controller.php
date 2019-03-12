<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class MY_Controller extends CI_controller
{
	public function __construct()
	{
		parent::__construct();
		error_reporting(E_ALL & ~E_NOTICE);
		$this->load->model('query_builder');
		$this->load->helper('form','url');
		$this->load->library('form_validation');
		$this->load->library('user_agent');
		$this->load->library('session');
		$this->load->library('pagination');
		$options = $this->query_builder->query_get_table('db_vas_options');
		$val = array();
		foreach($options as $key => $options)
		{
			$val[$options['option_name']] = $options;
		}
		define('TITLE', $val['title']['option_value']);
		define('DASHBOARDTITLE',$val['dashboard-title']['option_value']);
		$ternary   = ($this->session->userdata('status') != 1) ? redirect(site_url("sitelogin")) : '';

	}

	public function getPrivilleges($menuID,$groupID,&$view=0,&$add=0,&$edit=0,&$delete=0)
    {
		if($this->session->userdata('level')=='A')
		{
			$view 	= true;
			$add    = true;
			$edit   = true;
			$delete = true;
		}
		else
		{
			$tbl_privilleges = $this->query_builder->getPrivilegesAccess($menuID,$groupID);
			$view_accs       = $tbl_privilleges[0]['view_access'];
			$add_accs        = $tbl_privilleges[0]['add_access'];
			$edit_accs       = $tbl_privilleges[0]['edit_access'];
			$delet_accs      = $tbl_privilleges[0]['delete_access'];

			$view 	= ($view_accs==1)? true : false;
			$add  	= ($add_accs==1)? true : false;
			$edit   = ($edit_accs==1)? true : false;
			$delete = ($delet_accs==1)? true : false;
		}
	}

	public function ContentPrivilleges($menuID,$groupID,$view,$throw_data=array())
    {
		$tbl_privilleges = $this->query_builder->getPrivilegesAccess($menuID,$groupID);
		if($parameter_url = $this->uri->segment(1)=='welcome')
		{
			if(empty($throw_data)){
				$this->load->view($view);
			}
			else{
				$this->load->view($view,$throw_data);
			}
		}
		elseif($this->session->userdata('level')=='A')
		{
			if(empty($throw_data)){
				$this->load->view($view);
			}
			else{
				$this->load->view($view,$throw_data);
			}
		}
		elseif(!empty($tbl_privilleges))
		{
			if(empty($throw_data)){
				$this->load->view($view);
			}
			else{
				$this->load->view($view,$throw_data);
			}
		}
		elseif(empty($tbl_privilleges)){

			$this->load->view('view_false_action');
		}
    }

	public function Templating($view,$throw_data=array())
	{
		// echo $this->uri->segment(2);
		$data         = $this->query_builder->query_get_table('db_vas_options');
		$menuPID      = $this->query_builder->get_menuPID($this->uri->segment(1));
		$get_menuPID  = $menuPID['menuid'];
		$menuID 	  = $this->query_builder->get_menuid($get_menuPID,$this->uri->segment(2));
		// echo'<pre>';
		// print_r($menuID);
		$get_menuID  = $menuID[0]['menuid'];
		$userGroupID = $this->session->userdata('level');
		$akses 		  = $this->getPrivilleges($get_menuID,$userGroupID,$priv_view,$priv_add,$priv_edit,$priv_delete);

		// echo 'ate';
		$userid 	= $this->session->userdata('userid');
		// $cekAccount = $this->Appointment_DB->Call_Appointment_Patient_Account($userid)->num_rows();
		// $curl = curl_init();
		// curl_setopt_array($curl, array(
		// 	CURLOPT_RETURNTRANSFER => 1,
		// 	CURLOPT_URL => 'https://rest.dentassure.com/data/PatientAccount',
		// 	CURLOPT_USERAGENT => 'Codular Sample cURL Request',
		// 	CURLOPT_POST => 1,
		// 	CURLOPT_POSTFIELDS => array(
		// 		'userid' => $userid,
		// 	)
		// ));
		// $cekAccount 	    = curl_exec($curl);

		$data_cek['account'] =  0;
		$this->load->view('view_header');
		$this->load->view('view_content_header',$data_cek);
		//Menus Left
		$groupID = $this->session->userdata("groupID");
		$menusTable = $this->query_builder->query_get_menulist($groupID);

		//Menus Left
		$parameter_url = $this->uri->segment(1);
		$parameter_direct = $this->uri->segment(2);
		$menusLeft = $this->left_menu($menusTable,$parameter_direct,$parameter_url);
		$data['my_nav_left'] = $menusLeft;
		$this->load->view('view_content_left',$data);
		// echo $pages;
		// echo '<pre>';
		// print_r($menusTable);
		// exit();

		$this->ContentPrivilleges($get_menuID,$userGroupID,$view,$throw_data);

		//footer
		$agent = $this->user_agent();
		$data_agent['user_agent']= $agent;
		$data_agent['user_platform']= $this->agent->platform();
		$this->load->view('view_content_footer',$data_agent);
	}

	protected function _myurl($menumodel,$link = array())
	{
		switch($menumodel)
		{
			case 'areas':
				$link = array('master',$menumodel);
			break;
			case 'division':
				$link = array('master',$menumodel);
			break;
			case 'menus':
				$link = array('master',$menumodel);
			break;
			case 'menus':
				$link = array('master',$menumodel);
			break;
			case 'users':
				$link = array('master',$menumodel);
			break;
			case 'usergroup':
				$link = array('master',$menumodel);
			break;
			case 'groupmenu':
				$link = array('master',$menumodel);
			break;
			case 'child': //Menu Model
				$link = array('test',$menumodel); //Menu URL
			break;
			case 'child2': //Menu Model
				$link = array('test',$menumodel); //Menu URL
			break;
		}
		return $link;
	}

	private function _is_parent_menu_active($parameter_url,$key)
	{
		switch($parameter_url)
		{
			case 'master':
				if($key==1)
				{
					$treemenu .='<li class="treeview active">';
				}
				else
				{
					$treemenu .='<li class="treeview">';
				}
			break;
			case 'Customer':
			if($key==62)
			{
				$treemenu .='<li class="treeview active">';
			}
			else
			{
				$treemenu .='<li class="treeview">';
			}
			break;
			case 'Receptionist':
			if($key==67)
			{
				$treemenu .='<li class="treeview active">';
			}
			else
			{
				$treemenu .='<li class="treeview">';
			}
			break;
			case 'Setup':
			if($key==71)
			{
				$treemenu .='<li class="treeview active">';
			}
			else
			{
				$treemenu .='<li class="treeview">';
			}
			break;
			case 'Nurse':
			if($key==76)
			{
				$treemenu .='<li class="treeview active">';
			}
			else
			{
				$treemenu .='<li class="treeview">';
			}
			break;
			case 'Doctor':
			if($key==74)
			{
				$treemenu .='<li class="treeview active">';
			}
			else
			{
				$treemenu .='<li class="treeview">';
			}
			break;
			default:
				$treemenu .='<li class="treeview">';
			break;
		}
		return $treemenu;
	}

	public function left_menu($my_nav_left,$parameter_direct,$parameter_url)
	{
		$result = array();
		foreach($my_nav_left as  $key => $data)
		{
			// echo'<pre>';
			// print_r($data);
			// exit();
			switch($data)
			{
				case ($data['pid']==0):
					$result[$data['menuid'] ] = $data;
				break;
				case ($data['trees']==0):
					$result[$data['pid'] ]['children'][ $data['menuid'] ] = $data;
				break;
				default:
					$result[ $data['pid'] ]['children'][$data['trees']]['childset'][$data['menuid'] ]= $data;
				break;
			}
		}
		$treemenu = '';
		foreach($result as $key => $menu)
		{
			$type = $menu['mntype'];
			switch($type)
			{
				case 1:
					$parameter_direct;
					$childs 	= &$menu['children'];
					$parenturl 	= $menu['menu_url'];
					$parentname = $menu['menu_item_name'];
					$parenticon = $menu['icon'];
					$model 		= $menu['model'];
					$treemenu  .= $this->_is_parent_menu_active($parameter_url,$key);
					$treemenu  .= '<a href="#">';
					$treemenu  .= '<i class="'.$parenticon.'"></i>';
					$treemenu  .= '<span>'.$parentname.'</span>';
					$treemenu  .= '<i class="fa fa-angle-left pull-right"></i></a>';
					switch($childs)
					{
						case (!empty($childs)):
							$treemenu .= '<ul class="treeview-menu">';
							if (is_array($childs) || is_object($childs))
							{
								foreach($childs as $child=>$mn)
								{
									$childset = &$mn['childset'];
									$menumodel = strtolower($mn['model']);
									$childname = $mn['menu_item_name'];
									$parent_id = $mn['menuid'];
									$trees_id  = $mn['trees_childs'];
									$link = $this->_myurl($menumodel);
									$class ='';
									$icon = 'far fa-circle text-aqua';
									$icos = 'far fa-circle text-red';
									if($parameter_direct==$menumodel)
									{
										$class = ' class= "active" ';
										$icon = ' far fa-circle text-aqua text-maroon';
									}
									$mnset 	 = &$mn['mntype'];
									switch($mnset)
									{
										case 2:
											switch($childset)
											{
												case ($childset!=0):
													$treemenu  .= $this->_is_parent_menu_active($parameter_url,$key);
													$treemenu .= '<a href="#"><i class="'.$icos.'"></i> '.$childname.'';
													$treemenu .= '<span class="pull-right-container">';
													$treemenu .= '<i class="fa fa-angle-left pull-right"></i>';
													$treemenu .= '</span>';
													$treemenu .= '</a>';
													$treemenu .= '<ul class="treeview-menu">';
													foreach($childset as $dataku => $arrchild)
													{
														$menumodelset = strtolower($arrchild['model']);
														$childsetname = $arrchild['menu_item_name'];
														$linkset  = $this->_myurl($menumodelset);
														$classset ='';
														$icosset  = 'fa fa-share';
														if($parameter_direct==$menumodelset)
														{
															$classset = ' class= "active" ';
															$icosset  = 'fa fa-hand-o-right text-red';
														}
														$treemenu .= '<li '.$classset.'><a href="'.site_url($linkset).'"><i class="'.$icosset.'"></i> '.$childsetname.'</a></li>';
													}
													$treemenu .= '</ul>';
													$treemenu .= '</li>';
												break;
											}
										break;
										default:
											$treemenu .= '<li '.$class.'><a href="'.site_url($link).'">';
											$treemenu .= '<i class="'.$icon.'"></i> '.$childname.'</a></li>';
										break;
									}
								}
							}
						break;
					}
					$treemenu .= '</ul>';
					$treemenu .= '</li>';
				break;
			}
		}
		return $treemenu;
	}

	public function level_akses_pages($content = array())
	{
		$levels = $this->session->userdata('level');
		switch($levels)
		{
			case 'A'://ADMINISTRATOR
				$page_akses = $this->load->view('view_content_default');
			break;
			case '1'://VICE PRESIDENT
				$page_akses = $this->load->view('view_content_default');
			break;
			case '8'://GENERAL MANAGER
				$page_akses = $this->load->view('view_content_default');
			break;
			default:
				$page_akses = $this->load->view('view_false_action');
			break;
		}
		return $page_akses;
	}

	public function user_agent()
	{
		$user_agent = array(
						"browser" => $this->agent->is_browser(),
						"robot"	  => $this->agent->is_robot(),
						"mobil"	  => $this->agent->is_mobile()
					);
		switch($user_agent)
		{
			case ($user_agent['browser']):
				$agent = $this->agent->browser().' '.$this->agent->version();
			break;
			case ($user_agent['robot']):
				$agent = $this->agent->robot();
			break;
			case ($user_agent['mobile']):
				$agent = $this->agent->mobile();
			break;
			default:
				$agent = 'Unidentified User Agent';
			break;
		}
		return $agent;
	}

	public function messagelist($msgtype,$message)
	{
		$mtype = $msgtype;
		switch ($mtype)
		{
		case 'warning':
			$mess  = '<div class="alert alert-warning alert-dismissible animated animate fadeInUp">';
			$mess .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
			$mess .= '<h4 class="pull-left"><i class="fa fa-warning"></i> Alert!</h4>'.$message.'';
			$mess .= '</div>';
		break;
		case 'success':
			$mess  = '<div class="alert alert-success alert-dismissible animated animate fadeInUp">';
			$mess .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
			$mess .= '<h4 class="pull-left"><i class="fa fa-check"></i> Alert!</h4>'.$message.'';
			$mess .= '</div>';
		break;
		case 'error':
			$mess  = '<div class="alert alert-danger alert-dismissible animated animate fadeInUp">';
			$mess .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
			$mess .= '<h4 class="pull-left"><i class="fa fa-ban"></i> Alert!</h4>'.$message.'';
			$mess .= '</div>';
		break;
		case 'info':
			$mess  = '<div class="alert alert-info alert-dismissible animated animate fadeInUp">';
			$mess .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
			$mess .= '<h4 class="pull-left"><i class="fa fa-info"></i> Alert!</h4>'.$message.'';
			$mess .= '</div>';
		break;
		default:
			$mess  = '<div class="alert alert-warning alert-dismissible animated animate fadeInUp">';
			$mess .= '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>';
			$mess .= '<h4 class="pull-left"><i class="fa fa-warning"></i> Alert!</h4>'.$message.'';
			$mess .= '</div>';
		break;
		}
		return $mess;
	}

	public function validation($post_name=array(),$tag_mess=array(),$url=array(),$field,$database=array(),$where,$avatar)
	{
		$parameter_status = $this->uri->segment(3);
		foreach($post_name as $key => $postform)
		{
			$validate[$key]= array($postform,$tag_mess[$key]);
		}
		$forms_name = $validate[0][0];
		$forms_tag  = $validate[0][1];
		$post_id 	= $this->input->post($forms_name);

		if(isset($validate[0]))
		{
			unset($validate[0]);
		}

		$data = array();
		foreach($validate as $key => $setflash)
		{
			$post_value = $this->input->post($setflash[0]);
			if($parameter_status == 'add')
			{
				if(empty($post_value))
				{
					$this->session->set_flashdata('message',$this->messagelist('error','&nbsp;'.$setflash[1].' recquired'));
					redirect(site_url($url));
				}
				else
				{
					if($setflash[0]=='form[password]')
					{
						$data[$field[$key]] = md5($post_value);
					}
					else
					{
						$data[$field[$key]] = $post_value;
					}
					if(!empty($avatar))
					{
						$data['avatar'] = $avatar;
					}
					else
					{
						false;
					}
				}
			}
			elseif($parameter_status == 'edit')
			{
				if($setflash[0]=='form[password]')
				{
					$data[$field[$key]] = md5($post_value);
				}
				else
				{
					$data[$field[$key]] = $post_value;
				}
				if(!empty($avatar))
				{
					$data['avatar'] = $avatar;
				}
				else
				{
					false;
				}
			}
			elseif($parameter_status == 'delete')
			{
				$data[$field[$key]] = $post_value;
			}
		}

		if(isset($data)== true)
		{
			if($parameter_status == 'add')
			{
				if(!empty($avatar))
				{
					if($this->upload->do_upload('avatar'))
					{
						$this->db->insert($database, $data);
						$this->session->set_flashdata('message',$this->messagelist('success','&nbsp;New User has been add'));
						redirect(site_url('master/users/'.$parameter.''));
					}
					elseif(!$this->upload->do_upload('avatar')){
						$this->db->insert($database, $data);
						$this->session->set_flashdata('message',$this->messagelist('success','&nbsp;New User has been add'));
						redirect(site_url('master/users/'.$parameter.''));
					}
					else
					{
						$error = array('error' => $this->upload->display_errors());
						$text  = str_ireplace('<p>','',$error['error']);
						$text  = str_ireplace('</p>','',$text);
						$this->session->set_flashdata('message',$this->messagelist('error','&nbsp;'.$text.''));
						redirect(site_url('master/users/'.$parameter.''));
					}
				}
				else
				{
					$this->db->insert($database, $data);
					$this->session->set_flashdata('message',$this->messagelist('success','&nbsp;Data has been save'));
					redirect(site_url($url));
				}
			}
			elseif($parameter_status == 'edit')
			{
				$this->db->update($database, $data, array($where => $post_id));
				$this->session->set_flashdata('message',$this->messagelist('success','&nbsp;Data has been update'));
				redirect(site_url(''.$url.'/'.$parameter_status.'/'.$post_id.''));
			}
			elseif($parameter_status == 'delete')
			{
				$this->db->delete($database, array($where => $post_id));
				$this->session->set_flashdata('message',$this->messagelist('success','&nbsp;Data has been delete'));
				redirect(site_url($url));
			}
		}
	}

	public function upload_file($path,$allowed_type,$file_name,$max_size,$file_type,$max_width,$max_height,$form_name)
	{
		$date = new DateTime();
        $timestamp = $date->getTimestamp();
		$OriginalFilename = $file_name;
		$config['upload_path']          = $path;
		$config['allowed_types']        = $allowed_type;
		$config['file_name']        	= md5($file_name.$OriginalFilename.$timestamp);
		$config['max_size']             = $max_size;
		$config['file_type']            = $file_type;
		$config['max_width']            = $max_width;
		$config['max_height']           = $max_height;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);
		$this->load->library('image_lib');
		$gbr = $this->upload->data();

		$config['image_library'] 		= 'gd2';
		$config['source_image'] 		= ''.$path.'/'.$gbr['file_name'];
		$config['create_thumb'] 		= FALSE; // remove comment jika perlu membuat thumb image
		$config['maintain_ratio'] 		= TRUE;
		$config['width']         		= 160;
		$config['height']       		= 160;
		$this->image_lib->clear();
		$this->image_lib->initialize($config);
		$this->image_lib->resize();
		$get_file = ''.$path.'/'.$gbr['file_name'];
		return $get_file;
	}

	public function pagination_tools($get_all_field,$page,$limit_per_page,$slno_start,$total_records,$find,$table_name)
	{
		// exit;
		if ($total_records > 0)
        {
			$date = $this->uri->segment(3);
			$params["results"] = $this->query_builder->searchfield_data($table_name,$get_all_field ,$find ,$limit_per_page,$page+$limit_per_page,$ext);;
            $params["total"]   = $this->query_builder->get_total_data($table_name,$get_all_field,$find,$ext);

			$config['base_url'] = base_url() . 'index.php/Main/mass_deletion/link';
            $config['total_rows']  = $total_records;
            $config['per_page']    = $limit_per_page;
            $config["uri_segment"] = 4;

            // custom paging configuration
            $config['num_links']          = 3;
            $config['use_page_numbers']   = TRUE;
            $config['reuse_query_string'] = TRUE;

            $config['full_tag_open']   = '<ul class="pagination pagination-sm no-margin pull-right">';
            $config['full_tag_close']  = '</ul>';

            $config['first_link']      = 'First Page';
            $config['first_tag_open']  = '<li class="firstlink">';
            $config['first_tag_close'] = '</li>';

            $config['last_link']       = 'Last Page';
            $config['last_tag_open']   = '<li class="lastlink">';
            $config['last_tag_close']  = '</li>';

            $config['next_link']       = 'Next Page';
            $config['next_tag_open']   = '<li class="nextlink">';
            $config['next_tag_close']  = '</li>';

            $config['prev_link']       = 'Prev Page';
            $config['prev_tag_open']   = '<li class="prevlink">';
            $config['prev_tag_close']  = '</li>';

            $config['cur_tag_open']    = '<li class="active"><a>';
            $config['cur_tag_close']   = '</a></li>';

            $config['num_tag_open']    = '<li class="numlink">';
            $config['num_tag_close']   = '</li>';

            $this->pagination->initialize($config);

            // build paging links
            $params["links"]  = $this->pagination->create_links();
			$params["number"] = $slno_start;
        }
		if(!empty($params))
		{
			return $params;
		}
		else
		{
			false;
		}
	}

	public function create_random_hex($type,$number){
		$token = bin2hex(openssl_random_pseudo_bytes($number));
		$value =''.$type.''.$token;
		return $value;
	}

	public function cvf_convert_object_to_array($data) {
	    if (is_object($data)) {
	        $data = get_object_vars($data);
	    }

	    if (is_array($data)) {
	        return array_map(__METHOD__, $data);
	    }
	    else {
	        return $data;
	    }
	}
}
