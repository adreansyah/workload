<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class ControllerLogin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('query_builder');
		$this->load->helper(array('form','url'));
		$options = $this->query_builder->query_get_table('db_vas_options');
		$val=array();
		foreach($options as $key => $options)
		{
			$val[$options['option_name']] = $options;
		}
		define('TITLE', $val['title']['option_value']);
		define('DASHBOARDTITLE',$val['dashboard-title']['option_value']);
	}

	public function login()
	{
		$this->session->userdata('status');
		if($this->session->userdata('status') != 1)
		{
			$this->load->view('login/view_login');
		}
		else
		{
			redirect(base_url(array("welcome")));
		}
	}

	public function do_login()
	{
		$username  	  = $this->input->post('username',TRUE);
		$password  	  = $this->input->post('password',TRUE);
		$token 		  = $this->input->post('token',TRUE);
		if(empty($username))
		{
			$vartest ='<div id="message" class="animated fadeIn alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4 class="pull-left"><i class="fa fa-ban"></i> Alert!</h4>&nbsp;
						 username required.
					  </div>';
			echo json_encode(array("no_name"=>$vartest));
		}
		elseif(empty($password))
		{
			$vartest ='<div id="message" class="animated fadeIn alert alert-danger alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
						<h4 class="pull-left"><i class="fa fa-ban"></i> Alert!</h4>&nbsp;
						 Password required.
					  </div>';
			echo json_encode(array("no_name"=>$vartest));
		}
		else
		{
			$where 		  = array('username' => $username,'password' => md5($password));
			$ceklogged    = $this->query_builder->query_get_sessionlogged("db_vas_hr_users",$where);
			if(empty($ceklogged)){
				$vartest ='<div id="message" class="animated fadeIn alert alert-danger alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<h4 class="pull-left"><i class="fa fa-ban"></i> Alert!</h4>&nbsp;
								Password and username is wrong.
							</div>';
					echo json_encode(array("no_name"=>$vartest));
			}else{
				$last_log	  = strtotime($ceklogged[0]['last_login']);
				$current 	  = strtotime(date("Y-m-d H:i:s"));
				$expiration_token = $current - $last_log;
				$sestime = $this->config->config['sess_expiration'];
				if($expiration_token < $sestime){
					//masih active
					$call_token = 'active';
				}
				else{
					//sudah expire
					$call_token = 'expiration';
				}
				if($call_token=='active'){
					$where_upd =  array('username' => $username,'password' => md5($password));
					$data = array(
						'last_login'=>date('Y-m-d H:i:s')
					);
					$this->db->update('db_vas_hr_users', $data,$where_upd);
					$where = array('username' => $username,'password' => md5($password));
					$cek = $this->query_builder->query_do_login("db_vas_hr_users",$where)->num_rows();
					$enginelogged = $this->query_builder->query_get_sessionlogged("db_vas_hr_users",$where);
					if(!empty($cek))
					{
						$data_session = array(
								'userid' => $enginelogged[0]['userid'],
								'avatar' => $enginelogged[0]['avatar'],
								'username' => $username,
								'groupID' => $enginelogged[0]['level'],
								'phone' => $enginelogged[0]['phone'],
								'areaID' => $enginelogged[0]['areaid'],
								'divID' => $enginelogged[0]['divid'],
								'displayname' => $enginelogged[0]['displayname'],
								'level' => $enginelogged[0]['level'],
								'email' => $enginelogged[0]['email'],
								'status' => '1',
								'last_login' => $enginelogged[0]['last_login']
							);
						$this->session->set_userdata($data_session);
						$welcome = site_url(array('welcome'));
						echo json_encode(array("load-page"=> $welcome));
					}
					else
					{
						$vartest ='<div id="message" class="animated fadeIn alert alert-danger alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<h4 class="pull-left"><i class="fa fa-ban"></i> Alert!</h4>&nbsp;
									Password and username is wrong.
								</div>';
						echo json_encode(array("no_name"=>$vartest));
					}
				}elseif($call_token == 'expiration'){
					$where_upd =  array('username' => $username,'password' => md5($password));
					$data = array(
						'token' => $token,
						'last_login'=>date('Y-m-d H:i:s')
					);
					$this->db->update('db_vas_hr_users', $data,$where_upd);
					$cek = $this->query_builder->query_do_login("db_vas_hr_users",$where)->num_rows();
					$enginelogged = $this->query_builder->query_get_sessionlogged("db_vas_hr_users",$where);
					if(!empty($cek))
					{
						$data_session = array(
								'userid' => $enginelogged[0]['userid'],
								'avatar' => $enginelogged[0]['avatar'],
								'username' => $username,
								'groupID' => $enginelogged[0]['level'],
								'areaID' => $enginelogged[0]['areaid'],
								'divID' => $enginelogged[0]['divid'],
								'phone' => $enginelogged[0]['phone'],
								'displayname' => $enginelogged[0]['displayname'],
								'level' => $enginelogged[0]['level'],
								'email' => $enginelogged[0]['email'],
								'status' => '1',
								'last_login' => $enginelogged[0]['last_login']
							);
						$this->session->set_userdata($data_session);
						$welcome = site_url(array('welcome'));
						echo json_encode(array("load-page"=> $welcome));
					}
					else
					{
						$vartest ='<div id="message" class="animated fadeIn alert alert-danger alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
									<h4 class="pull-left"><i class="fa fa-ban"></i> Alert!</h4>&nbsp;
									Password and username is wrong.
								</div>';
						echo json_encode(array("no_name"=>$vartest));
					}
				}
			}
		}
	}

	public function do_logout(){
		$where_upd = array('username' => $this->session->userdata('username'),'userid' => $this->session->userdata('userid') );
		$data = array(
				'is_active' => 0,
		);
		$this->db->update('db_vas_hr_users', $data,$where_upd);
		$this->session->sess_destroy();
		redirect(site_url("sitelogin"));
	}
}
