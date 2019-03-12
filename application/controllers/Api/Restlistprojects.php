<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restlistprojects extends MY_Controller
{
	public function __construct()
	{
		ini_set('max_execution_time', 300);
		header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
		header("Pragma: no-cache"); //HTTP 1.0
		header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); // Date in the past
		header("Cache-Control: max-age=2592000"); //30days (60sec * 60min * 24hours * 30days)
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
		$this->db = $this->load->database('default', TRUE);
	}

	public function index(){
		$sql 			= $this->db->get('db_vas_project');
		$response = $sql->result_array();
		echo json_encode($response);
	}
}
