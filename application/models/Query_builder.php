<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Query_builder extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->db = $this->load->database('default', TRUE);
	}

	public function query_do_login($table,$where)
	{
		$sql = $this->db->get_where($table,$where);
		return $sql;
	}

	public function session_cek($userid)
	{
		$query = 'SELECT * FROM db_vas_hr_users WHERE userid = "'.$userid.'"';
		$sql	= $this->db->query("".$query."");
		return $sql->result_array();
	}

	public function query_get_sessionlogged($table,$where)
	{
		$sql = $this->db->get_where($table,$where);
		return $sql->result_array();
	}

	public function query_get_table($table)
	{
		$sql = $this->db->get($table);
		return $sql->result_array();
	}

	public function get_menuPID($menuurl)
    {
		$query 	= "SELECT * FROM db_vas_menus WHERE menu_url = '".$menuurl."'";
		$sql	= $this->db->query("".$query."");
		$data 	= $sql->result_array();
		$arr 	= array();
		foreach($data as $menuid){
			$arr['menuid'] = $menuid['menuid'];
		}
		// print_r($arr);
		// exit;
		return($arr);
	}

	public function get_menuid($pid,$menumodel)
    {
		$query 	= "SELECT * FROM db_vas_menus WHERE pid = '$pid' and model='$menumodel'";
		$sql	= $this->db->query("".$query."");
		return $sql->result_array();
    }

	public function getPrivilegesAccess($menuID,$groupID)
    {
		$query 	= "SELECT * FROM db_vas_menu_group where menuid='$menuID' and groupID = '$groupID'";
		$sql	= $this->db->query("".$query."");
		return $sql->result_array();
	}

	public function query_get_menulist($groupID)
    {
		if($groupID!='A')
		{
			$level = " and menuid in (SELECT menuid FROM db_vas_menu_group where groupID='$groupID' and view_access='1' union select menuid from db_vas_menus where isdefault=1) ";
		}
		$query = 'SELECT * FROM db_vas_menus WHERE status = "ACTIVE" '.$level.' ORDER BY pid ASC, sortorder ASC, menu_item_name ASC';
		$sql= $this->db->query("".$query."");
		return $sql->result_array();
	}

	public function query_get_menulist_full($groupID)
    {
		switch ($groupID)
		{
			case ($groupID!='A'):
				$union = '( SELECT menuid FROM db_vas_menu_group where groupID='.str_replace("\\","",$groupID).' and view_access = 1 union select menuid from db_vas_menus where isdefault=1 )';
				$this->db->where('status = "ACTIVE" and menuid IN '.$union.' ');
				$this->db->order_by('pid ASC');
				$this->db->order_by('sortorder ASC');
				//$this->db->order_by('menu_item_name ASC');
				$this->db->order_by('trees ASC');
				$this->db->order_by('trees_child ASC');
				$sql = $this->db->get_where('db_vas_menus');
				return $sql->result_array();
			break;
			default:
				$this->db->order_by('pid ASC');
				$this->db->order_by('sortorder ASC');
				//$this->db->order_by('menu_item_name ASC');
				$this->db->order_by('trees ASC');
				$this->db->order_by('trees_child ASC');
				$sql = $this->db->get_where('db_vas_menus');
				return $sql->result_array();
			break;
		}
    }

	public function query_get_edit_hr_users($table_area,$parameter_id)
	{
		$sql = $this->db->get_where($table_area,'userid = '.$parameter_id.'');
		return $sql->result_array();
	}

	public function query_get_edit_area($table_area,$parameter_id)
	{
		$sql = $this->db->get_where($table_area,'areaid = '.$parameter_id.'');
		return $sql->result_array();
	}

	public function query_get_edit_division($table_division,$parameter_id)
	{
		$sql = $this->db->get_where($table_division,'divid = '.$parameter_id.'');
		return $sql->result_array();
	}

	public function query_get_edit_group($table_group,$parameter_id)
	{
		$sql = $this->db->get_where($table_group,'groupID = '.$parameter_id.'');
		return $sql->result_array();
	}

	public function query_get_edit_menugroup($table_group,$parameter_id)
	{
		$sql = $this->db->get_where($table_group,'mnID = '.$parameter_id.'');
		return $sql->result_array();
	}

	public function query_get_edit_menus($table_group,$parameter_id)
	{
		$sql = $this->db->get_where($table_group,'menuid = '.$parameter_id.'');
		return $sql->result_array();
	}

    public function autocomplete_product($table_product,$partialstring)
	{
		$this->db->order_by('product_name');
        $query = $this->db->get_where($table_product,'product_name LIKE "%'.$partialstring.'%"');
        if (!empty($query)) { //jika ada maka jalankan
            return $query->result_array();
        }
    }

	public function getallfield($tablename)
    {
        $dbname = $database;
        $sql = "select column_name as Field from information_schema.columns where table_name='".$tablename."' and table_schema='".$dbname."'";
		$rs = $this->db->query($sql);
		$res = $rs->result_array();
		$colum = '';
		foreach($res as $field)
		{
			$type = $field['Field'];
			if (preg_match("/(int)/", $type))
			{
			$colum .= ' cast('.$field['Field'].' as char),';
			}elseif (preg_match("/(timestamp)/", $type))
			{
			$colum .= ' cast('.$field['Field'].' as char),';
			}
			else
			{
			$colum .= $field['Field'].',';
			}
		}
		$colum = ' lower(concat ('.rtrim($colum,",").'))';
		return $colum;
    }

	public function searchfield($tablename,$algorithma,$partialstring)
    {
		$query = $this->db->get_where($tablename,' '.$algorithma.' like "%'.$partialstring.'%" LIMIT 16');
		 return $query->result_array();
	}

	public function getallfield_data($dbname,$tablename)
    {
        $dbname = 'db_vas';
		$this->db->where('table_schema', $dbname);
		$this->db->where('table_name', $tablename);
		$this->db->select('column_name as Field');
		$sql = $this->db->get('information_schema.columns');
		$res = $sql->result();

		$colum = '';
		foreach($res as $field)
		{
			$type = $field->Field;
			if (preg_match("/(int)/", $type))
			{
			$colum .= ' cast('.$field->Field.' as char),';
			}elseif (preg_match("/(timestamp)/", $type))
			{
			$colum .= ' cast('.$field->Field.' as char),';
			}
			else
			{
			$colum .= $field->Field.',';
			}
		}
		$colum = ' lower(concat ('.rtrim($colum,",").'))';
		return $colum;
    }

	public function searchfield_data($tablename,$algorithma,$partialstring,$limit,$start,$dates)
    {
		($start === 5)? $this->db->limit($limit) : $this->db->limit($start,$limit) ;
		if(empty($partialstring))
		{
			$this->db->select('
			todolist_id,update
			descriptions,
			subdescription,
			apps,
			appsname,
			pic,
			date_start,
			date_end,
			liststatus,
			statusname');
			$query = $this->db->get_where($tablename,' '.$algorithma.'');
			// echo $this->db->last_query(); die;
		}
		else
		{
			$this->db->select('
			todolist_id,
			descriptions,
			subdescription,
			apps,
			appsname,
			pic,
			date_start,
			date_end,
			liststatus,
			statusname');
			$query = $this->db->get_where($tablename,''.$algorithma.' like "%'.$partialstring.'%" ');
		}
		if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
                $data[] = $row;
            }

            return $data;
        }
        return false;
	}

   public function get_total_data($tablename,$algorithma,$partialstring,$dates)
   {
		$this->db->like(''. $algorithma, $partialstring);// Produces an integer, like 25
      return $this->db->count_all_results($tablename); ;
   }

	public function insert_data($table,$data){
 		$this->db->insert($table, $data);
 		return true;
 	}

	public function update_data($table,$set,$where){
		$this->db->where($where);
    	$this->db->update($table,$set);
    	return true;
	}
}
