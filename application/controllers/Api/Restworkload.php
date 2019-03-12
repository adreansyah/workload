<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restworkload extends MY_Controller
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
		$datax  = $_POST;
		if(empty($_POST['project_id'])){
			echo json_encode(array("err"=>true,"msg"=>'project_id Cannot Empty'));
		}
		else if(empty($_POST['request'])){
			echo json_encode(array("err"=>true,"msg"=>'Request Cannot Empty'));
		}
		else if(empty($_POST['time'])){
			echo  json_encode(array("err"=>true,"msg"=>'Time Cannot Empty'));
		}
		else if(empty($_POST['start'])){
			echo json_encode(array("err"=>true,"msg"=>'Start Date Cannot Empty'));
		}
		else if(empty($_POST['end'])){
			echo json_encode(array("err"=>true,"msg"=>'Finish Date Cannot Empty'));
		}
		else{
			// print_r());
			$data = array(
						"level_id"    => $this->session->userdata('level'),
						"project_id" => $_POST['project_id'],
						"request"     => $_POST['request'],
						"time"        => $_POST['time'],
						"date_start"  => $_POST['start'],
						"date_end"    => $_POST['end']
			);
			$this->db->insert('db_vas_workload', $data);
			echo json_encode(array("err"=>false,"msg"=>'Workload Success Input'));
		}
	}

	public function Filterload(){
		$level = $this->session->userdata('level');
		$sql	 = $this->db->query("
			select
				a.workload_id,
				a.project_id,
				b.project_name,
				a.level_id,
				a.request,
				a.time,
				a.date_start,
				a.date_end
			from
				db_vas_workload as a
			left join db_vas_project as b
			on
				a.project_id = b.project_id
			where
				a.date_start >= '".$_POST['start']."' and a.date_end <= '".$_POST['finish']."' and level_id ='".$level."'
		");
		$stat = $sql->num_rows();
		$arr  = $sql->result_array();
		echo json_encode(array("status"=>$stat,"req"=>$arr));
	}

	public function DataWorkload(){
		$sql	 = $this->db->query("
			select
				a.project_id,
				b.project_name,
				b.project_remark,
				a.level_id,
				a.request,
				a.time,
				a.date_start,
				a.date_end
			from
				db_vas_workload as a
			left join db_vas_project as b
			on
				a.project_id = b.project_id
		");
		$arr = $sql->result_array();

		$project_leader  = array('name' =>'project leader', 'id'=>'project leader');
		$quality_control = array('name' =>'quality control', 'id'=>'quality control');
		$array = array();
		foreach ($arr as $key => $value) {
			$formulas = ($value['request'] * $value['time']) / (60 * 22 *8); //Rumus
			$completed = round($formulas,2);
			if($completed >= 0.75 && $completed < 0.80){
				$color = '#f3e211';
			}
			elseif($completed >= 0.80){
				$color = '#dd4b39';
			}
			elseif($completed <0.75){
				$color = '#8fea7d';
			}
			$array[] = array(
				"name"=> $value['project_name'],
				"parent"=> 'project leader',
				"start"=>$this->dates($value['date_start']),
				"end"=>$this->dates($value['date_end']),
				"completed"=>$completed,
				"color"=>$value['project_remark']
			);
		}
		echo json_encode(
			array_merge(
				array($project_leader),
				array($quality_control),
				$array
			),JSON_NUMERIC_CHECK
		);
	}

	private function dates($date){
		$dt = date("Y-m-d\TH:i:s\Z",strtotime($date));
		$d  = new DateTime($dt);
		return $d->format('U')*1000;
	}

	public function UpdateDetailWorkload(){
		$level = $this->session->userdata('level');
		$sql	 = $this->db->query("
		select
                a.workload_id,
				a.project_id,
				b.project_name,
				a.level_id,
				a.request,
				a.time,
				a.date_start,
				a.date_end
			from
				db_vas_workload as a
			left join db_vas_project as b
			on
				a.project_id = b.project_id
			where
			a.project_id = '".$_POST['project_id']."' and	a.date_start >= '".$_POST['start']."' and a.date_end <= '".$_POST['finish']."' and level_id ='".$level."'
			order by a.date_start
		");
		$stat = $sql->num_rows();
		$arr  = $sql->result_array();
		echo json_encode(array("status"=>$stat,"req"=>$arr));
	}

	public function SetUpdateDetailWorkload(){
		$where = array(
			"workload_id" => $_POST['workload_id'],
			"project_id" => $_POST['project_id']
		);
		$set = array(
			"request"=>$_POST['request'],
			"time"=>$_POST['time'],
			"date_start" => $_POST['start'],
			"date_end"=>$_POST['finish']
		);
		$this->db->where($where);
		$this->db->update('db_vas_workload',$set);
	}
}
