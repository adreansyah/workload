<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ControllerPost extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('query_builder');
		$this->load->helper('form','url');
		$this->load->library('form_validation');
		date_default_timezone_set('Asia/Jakarta');
		if($this->session->userdata('status') != 1)
		{
			redirect(site_url("sitelogin"));
		}
	}

	public function post_area()
	{
		$parameter_status = $this->uri->segment(3);
		switch ($parameter_status)
		{
			case 'add':
				$post_name = array("form[areaid]","form[areacode]","form[areaname]","form[address]");
				$tag_mess  = array("Area Id","Area Code","Area Name","Address");
				$db_field  = array('areaid','areacode','areaname','address');
				$db_table  = 'db_vas_area';
				$url  	   = 'master/areas';
				$this->validation($post_name,$tag_mess,$url,$db_field,$db_table);
			break;
			case 'edit':
				$post_name = array("form[areaid]","form[areacode]","form[areaname]","form[address]");
				$tag_mess  = array("Area Id","Area Code","Area Name","Address");
				$db_field  = array('areaid','areacode','areaname','address');
				$db_table  = 'db_vas_area';
				$where 	   = 'areaid';
				$url  	   = 'master/areas';
				$this->validation($post_name,$tag_mess,$url,$db_field,$db_table,$where);
			break;
			case 'delete':
				$post_name = array("form[areaid]","form[areacode]","form[areaname]","form[address]");
				$tag_mess  = array("Area Id","Area Code","Area Name","Address");
				$db_field  = array('areaid','areacode','areaname','address');
				$db_table  = 'db_vas_area';
				$where 	   = 'areaid';
				$url  	   = 'master/areas';
				$this->validation($post_name,$tag_mess,$url,$db_field,$db_table,$where);
			break;
		}
	}

	public function post_division()
	{
		$parameter_status  = $this->uri->segment(3);
		switch($parameter_status)
		{
			case 'add':
				$post_name = array("form[divisionid]","form[divisiontag]","form[divisionname]","form[description]");
				$tag_mess  = array("Departement Id","Departement Tag","Departement Tag","Description");
				$db_field  = array('divid','divtag','divname','description');
				$db_table  = 'db_vas_departement';
				$url  	   = 'master/division';
				$this->validation($post_name,$tag_mess,$url,$db_field,$db_table);
			break;
			case 'edit':
				$post_name = array("form[divisionid]","form[divisiontag]","form[divisionname]","form[description]");
				$tag_mess  = array("Departement Id","Departement Tag","Departement Tag","Description");
				$db_field  = array('divid','divtag','divname','description');
				$db_table  = 'db_vas_departement';
				$where 	   = 'divid';
				$url  	   = 'master/division';
				$this->validation($post_name,$tag_mess,$url,$db_field,$db_table,$where);
			break;
			case 'delete':
				$post_name = array("form[divisionid]","form[divisiontag]","form[divisionname]","form[description]");
				$tag_mess  = array("Departement Id","Departement Tag","Departement Tag","Description");
				$db_field  = array('divid','divtag','divname','description');
				$db_table  = 'db_vas_departement';
				$where 	   = 'divid';
				$url  	   = 'master/division';
				$this->validation($post_name,$tag_mess,$url,$db_field,$db_table,$where);
			break;
		}
	}

	public function do_upload()
	{
		$parameter_status = $this->uri->segment(3);
		switch ($parameter_status)
		{
			case 'add':
				$post_name    = array("form[userid]","form[username]","form[displayname]","form[password]","form[email]","form[no_telfon]","form[level]");
				$tag_mess     = array("User Id","User Name","Displayname","Password","Email","No Telfon","Level");
				$db_field     = array('userid','username','displayname','password','email','phone','level','areaid','divid');
				$db_table     = 'db_vas_hr_users';
				$url  	      = 'master/users';
				$path 		  = './uploads/avatar';
				$allowed_type = 'gif|jpg|png';
				$file_name	  = $_FILES['avatar']['name'];
				$max_size	  = 1024;
				$file_type	  = $_FILES['avatar']['type'];
				$max_width    = 2500;
				$max_height   = 2500;
				$form_name	  =	'avatar';
				$avatar = $this->upload_file($path,$allowed_type,$file_name,$max_size,$file_type,$max_width,$max_height,$form_name);
				$this->validation($post_name, $tag_mess, $url, $db_field, $db_table, $where, $avatar);
			break;
			case 'edit':
				$post_name    = array("form[userid]","form[username]","form[displayname]","form[password]","form[email]","form[no_telfon]","form[level]");
				$tag_mess     = array("User Id","User Name","Displayname","Password","Email","No Telfon","Level");
				$db_field     = array('userid','username','displayname','password','email','phone','level','areaid','divid');
				$db_table     = 'db_vas_hr_users';
				$url  	      = 'master/users';
				$path 		  = './uploads/avatar';
				$allowed_type = 'gif|jpg|png';
				$file_name	  = $_FILES['avatar']['name'];
				$max_size	  = 1024;
				$file_type	  = $_FILES['avatar']['type'];
				$max_width    = 2500;
				$max_height   = 2500;
				$form_name	  =	'avatar';
				$where 		  = 'userid';
				$avatar = $this->upload_file($path,$allowed_type,$file_name,$max_size,$file_type,$max_width,$max_height,$form_name);
				$this->validation($post_name, $tag_mess, $url, $db_field, $db_table, $where, $avatar);
			break;
			case 'delete':
				$post_name    = array("form[userid]","form[username]","form[displayname]","form[password]","form[email]","form[no_telfon]","form[level]");
				$tag_mess     = array("User Id","User Name","Displayname","Password","Email","No Telfon","Level");
				$db_field     = array('userid','username','displayname','password','email','phone','level','areaid','divid');
				$db_table     = 'db_vas_hr_users';
				$url  	      = 'master/users';
				$where 		  = 'userid';
				$this->validation($post_name, $tag_mess, $url, $db_field, $db_table, $where, $avatar);
			break;
		}
	}

	public function post_usergroup()
	{
		$parameter_status = $this->uri->segment(3);
		switch($parameter_status)
		{
			case 'add':
				$post_name = array("form[usergroupid]","form[usergroupname]","form[description]");
				$tag_mess  = array("Usergroup Id","Usergroup Name","Description");
				$db_field  = array('groupID','groupname','description');
				$db_table  = 'db_vas_user_group';
				$url  	   = 'master/usergroup';
				$this->validation($post_name,$tag_mess,$url,$db_field,$db_table);
			break;
			case 'edit':
				$post_name = array("form[usergroupid]","form[usergroupname]","form[description]");
				$tag_mess  = array("Usergroup Id","Usergroup Name","Description");
				$db_field  = array('groupID','groupname','description');
				$db_table  = 'db_vas_user_group';
				$where	   = 'groupID';
				$url  	   = 'master/usergroup';
				$this->validation($post_name,$tag_mess,$url,$db_field,$db_table,$where);
			break;
			case 'delete':
				$post_name = array("form[usergroupid]","form[usergroupname]","form[description]");
				$tag_mess  = array("Usergroup Id","Usergroup Name","Description");
				$db_field  = array('groupID','groupname','description');
				$db_table  = 'db_vas_user_group';
				$where	   = 'groupID';
				$url  	   = 'master/usergroup';
				$this->validation($post_name,$tag_mess,$url,$db_field,$db_table,$where);
			break;
		}
	}

	public function post_menugroup()
	{
		$parameter_status = $this->uri->segment(3);
		$post_mnID	  = $this->input->post('form[mnID]');
		$post_menuid  = $this->input->post('form[menuid]');
		$post_level   = $this->input->post('form[level]');
		$post_view    = $this->input->post('form[view]');
		$post_add     = $this->input->post('form[add]');
		$post_edit    = $this->input->post('form[edit]');
		$post_delete  = $this->input->post('form[delete]');
		$isview = ($post_view=='on')? 1:0;
		$isadd = ($post_add=='on')? 1:0;
		$isedit = ($post_edit=='on')? 1:0;
		$isdelete = ($post_delete=='on')? 1:0;
		switch($parameter_status)
		{
			case 'add':
				if(empty($post_level))
				{
					$this->session->set_flashdata('message',$this->messagelist('error','&nbsp;Group Name required'));
					redirect(site_url(array('master','groupmenu',$post_usergroupid)));
				}
				elseif(empty($post_menuid))
				{
					$this->session->set_flashdata('message',$this->messagelist('error','&nbsp;Menu Name required'));
					redirect(site_url(array('master','groupmenu',$post_usergroupid)));
				}
				$data_menugroup = array();
				$data_menugroup['menuid']  = $post_menuid;
				$data_menugroup['groupID'] = $post_level;
				$data_menugroup['view_access']   = $isview;
				$data_menugroup['add_access']    = $isadd;
				$data_menugroup['edit_access']   = $isedit;
				$data_menugroup['delete_access'] = $isdelete;
				$this->db->insert('db_vas_menu_group', $data_menugroup);
				$this->session->set_flashdata('message',$this->messagelist('success','&nbsp;Menu Access has been add'));
				redirect(site_url(array('master','groupmenu')));
			break;
			case 'edit':
				$data_menugroup = array();
				$data_menugroup['mnID']  = $post_mnID;
				$data_menugroup['menuid']  = $post_menuid;
				$data_menugroup['groupID'] = $post_level;
				$data_menugroup['view_access']   = $isview;
				$data_menugroup['add_access']    = $isadd;
				$data_menugroup['edit_access']   = $isedit;
				$data_menugroup['delete_access'] = $isdelete;
				$this->db->update('db_vas_menu_group', $data_menugroup, array('mnID' => $post_mnID));
				$this->session->set_flashdata('message',$this->messagelist('success','&nbsp;Menu Access has been Update'));
				redirect(site_url(array('master','groupmenu','edit',$post_mnID)));
			break;
			default:
				$this->db->delete('db_vas_menu_group', array('mnID' => $post_mnID));
				$this->session->set_flashdata('message',$this->messagelist('success','&nbsp;usergroup has been deleted'));
				redirect(site_url(array('master','groupmenu')));
			break;
		}
	}

	public function post_menu()
	{
		$parameter_status = $this->uri->segment(3);
		$post_menu_id 		 = $this->input->post('form[menuid]');
		$post_menu_item_name = $this->input->post('form[menu_item_name]');
		$post_menu_url 		 = $this->input->post('form[menu_url]');
		$post_menu_model	 = $this->input->post('form[menu_model]');
		$post_menu_icon		 = $this->input->post('form[menu_icon]');
		$post_menu_sortorder = $this->input->post('form[menu_sortorder]');
		$post_mn_type    	 = $this->input->post('form[mn_type]');
		$post_mn_status	     = $this->input->post('form[mn_status]');
		$post_isdefault 	 = $this->input->post('form[mn_isdefault]');
		$istype    = ($post_mn_type=='on')? 1:0;
		$isstatus  = ($post_mn_status=='on')? 'ACTIVE':'NOT ACTIVE';
		$isdefault = ($post_isdefault=='on')? 1:0;

		switch($parameter_status)
		{
			case 'add-parent':
				$data_menu = array();
				$data_menu['menu_item_name'] = $post_menu_item_name;
				$data_menu['menu_url'] 		 = $post_menu_url;
				$data_menu['icon']  	 	 = $post_menu_icon;
				$data_menu['sortorder']  	 = $post_menu_sortorder;
				$data_menu['mntype'] 		 = $istype;
				$data_menu['status'] 	   	 = $isstatus;
				$data_menu['isdefault']  	 = $isdefault;
				$this->db->insert('db_vas_menus', $data_menu);
				$this->session->set_flashdata('message',$this->messagelist('success','&nbsp;Menu Parent has been Add'));
				redirect(site_url(array('master','menus')));
			break;
			case 'edit-parent':
				$data_menu = array();
				$data_menu['menu_item_name'] = $post_menu_item_name;
				$data_menu['menu_url'] 		 = $post_menu_url;
				$data_menu['icon']  	 	 = $post_menu_icon;
				$data_menu['sortorder']  	 = $post_menu_sortorder;
				$data_menu['mntype'] 		 = $istype;
				$data_menu['status'] 	   	 = $isstatus;
				$data_menu['isdefault']  	 = $isdefault;
				$this->db->update('db_vas_menus', $data_menu, array('menuid' => $post_menu_id));
				$this->session->set_flashdata('message',$this->messagelist('success','&nbsp;Menu Parent has been update'));
				redirect(site_url(array('master','menus','edit-parent','parent',$post_menu_item_name,$post_menu_id)));
			break;
			case 'delete-parent':
				$this->db->delete('db_vas_menus', array('menuid' => $post_menu_id));
				$this->db->delete('db_vas_menus', array('pid' => $post_menu_id));
				$this->session->set_flashdata('message',$this->messagelist('success','&nbsp;Menu Parent '.$post_menu_item_name.' has been delete'));
				redirect(site_url(array('master','menus')));
			break;
			case 'add-children':
				$data_menu = array();
				$data_menu['pid'] 		 	 = $post_menu_id;
				$data_menu['menu_item_name'] = $post_menu_item_name;
				$data_menu['model']		  	 = $post_menu_model;
				$data_menu['sortorder']  	 = $post_menu_sortorder;
				$data_menu['status'] 	   	 = $isstatus;
				$data_menu['isdefault']  	 = $isdefault;
				$this->db->insert('db_vas_menus', $data_menu);
				$this->session->set_flashdata('message',$this->messagelist('success','&nbsp;Menu Children has been Add'));
				redirect(site_url(array('master','menus')));
			break;
			case 'edit-children':
				$data_menu = array();
				$data_menu['menu_item_name'] = $post_menu_item_name;
				$data_menu['model']		  	 = $post_menu_model;
				$data_menu['sortorder']  	 = $post_menu_sortorder;
				$data_menu['status'] 	   	 = $isstatus;
				$data_menu['isdefault']  	 = $isdefault;
				$this->db->update('db_vas_menus', $data_menu, array('menuid' => $post_menu_id));
				$this->session->set_flashdata('message',$this->messagelist('success','&nbsp;Menu Children '.$post_menu_item_name.' has been update'));
				redirect(site_url(array('master','menus','edit-children','parent',str_replace(" ","-",$post_menu_item_name),$post_menu_id)));
			break;
		}
	}
}
