<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ControllerDefault extends MY_Controller
{
	public function index()
	{
		$view = 'view_content_default';
		$this->Templating($view);
	}

	public function areas()
	{
		//view_content
		$parameter_id = $this->uri->segment(4);
		$call_area = $this->query_builder->query_get_table('db_vas_area');
		$edit_area = $this->query_builder->query_get_edit_area('db_vas_area',$parameter_id);
		//view_content
		$data_area['data_area'] = $call_area;
		$data_area['edit_area'] = $edit_area;
		$view = 'master/view_content_area';
		$throw = $data_area;
		$this->Templating($view,$throw);
	}

	public function division()
	{
		//view_content
		$parameter_id  = $this->uri->segment(4);
		$call_division = $this->query_builder->query_get_table('db_vas_departement');
		$edit_division = $this->query_builder->query_get_edit_division('db_vas_departement',$parameter_id);
		//view_content
		$data_division['data_division'] = $call_division;
		$data_division['edit_division'] = $edit_division;
		$view = 'master/view_content_division';
		$throw = $data_division;
		$this->Templating($view,$throw);
	}

	public function users()
	{
		//view_content
		$parameter_id  = $this->uri->segment(4);
		$call_area     = $this->query_builder->query_get_table('db_vas_area');
		$call_division = $this->query_builder->query_get_table('db_vas_departement');
		$call_group    = $this->query_builder->query_get_table('db_vas_user_group');
		$call_hr_users = $this->query_builder->query_get_table('db_vas_hr_users');
		$call_edit_users = $this->query_builder->query_get_edit_hr_users('db_vas_hr_users',$parameter_id);
		//view_content
		$data_select['select_area']		= $call_area;
		$data_select['select_division'] = $call_division;
		$data_select['select_group'] 	= $call_group;
		$data_select['data_users'] 		= $call_hr_users;
		$data_select['edit_users'] 		= $call_edit_users;
		$view = 'master/view_content_users';
		$throw = $data_select;
		$this->Templating($view,$throw);
	}

	public function usergroup()
	{
		//view_content
		$parameter_id  = $this->uri->segment(4);
		$call_group    = $this->query_builder->query_get_table('db_vas_user_group');
		$call_edit_usergroup = $this->query_builder->query_get_edit_group('db_vas_user_group',$parameter_id);
		//view_content
		$data_group['data_usergroup'] 	= $call_group;
		$data_group['edit_usergroup'] 	= $call_edit_usergroup;
		$view = 'master/view_content_usergroup';
		$throw = $data_group;
		$this->Templating($view,$throw);
	}

	public function groupmenu()
	{
		//view_content
		$parameter_id  = $this->uri->segment(4);
		$call_menugroup    = $this->query_builder->query_get_table('view_menu_split_access_db_vas');
		$call_edit_menugroup = $this->query_builder->query_get_edit_menugroup('view_menu_split_access_db_vas',$parameter_id);
		$call_group    = $this->query_builder->query_get_table('db_vas_user_group');
		$groupID = $this->session->userdata("groupID");
		$menusTable = $this->query_builder->query_get_menulist($groupID);

		//view_content
		$data_menugroup['data_menugroup'] 	= $call_menugroup;
		$data_menugroup['edit_menugroup'] 	= $call_edit_menugroup;
		$data_menugroup['select_menu'] 		= $menusTable;
		$data_menugroup['select_group'] 	= $call_group;
		$view = 'master/view_content_groupmenu';
		$throw = $data_menugroup;
		$this->Templating($view,$throw);
	}

	public function menus()
	{
		//Menus Left
		$groupID = $this->session->userdata("groupID");
		$menusTable_full = $this->query_builder->query_get_menulist_full($groupID);
		//view_content
		$parameter_id = $this->uri->segment(6);
		$call_edit_menus = $this->query_builder->query_get_edit_menus('db_vas_menus',$parameter_id);
		//view_content
		$data_menus['data_menu'] = $menusTable_full ;
		$data_menus['edit_menu'] = $call_edit_menus;
		$view = 'master/view_content_menus';
		$throw = $data_menus;
		$this->Templating($view,$throw);
	}
}
