<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Mongo_builder extends CI_Model
{		
	// public function __construct()
	// {		
	// 	parent::__construct();		
	// 	$this->load->library('mongo_db', array('activate'=>'newdb'),'mongo_db2');			
	// }
	
	// public function mongo_data($date_orcl1,$date_orcl2,$replace_error)
	// {	
	// 	$this->mongo_db2->like('error', ''.$replace_error.'', 'both');
	// 	$this->mongo_db2->where_gte('Date_Start',new MongoDate($date_orcl1));
	// 	$this->mongo_db2->where_lte('Date_Start',new MongoDate($date_orcl2));
	// 	$sql = $this->mongo_db2->get('logerror');
	// 	return $sql;
	// }
	
	// public function mongo_data_filter()
	// {				
	// 	$this->mongo_db2->where(array('Sid'=>"155","Messages"=>"Processing response from AAM order  347366049going for Service"));
	// 	$sql = $this->mongo_db2->get('logfilewarning');
	// 	foreach($sql as $data)
	// 	return $data;
	// }
}
