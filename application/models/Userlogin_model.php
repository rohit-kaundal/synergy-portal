<?php

defined('BASEPATH') or die('not allowed');

class Userlogin_model extends CI_Model {
	public $id = 0;
	public $user_email;
	public $user_roleid;
	public $user_password;
	public $created_on;
	public $created_by;
	public $last_login;
	
	const tblname ='tbluserlogin';
	
	function __construct(){
		parent::__construct();
	}
	
	
	private function dbarray_to_obj($array){
		$dao = new Userlogin_model();
		if(!empty($array) || $array != null){
			foreach($array as $key=>$val){
				$dao->$key=$val;
			}
			return $dao;
		}
	}
	
	function getobject_fromid($id){
		$query = $this->db->where(['id'=>$id])
							->get(self::tblname);
		$data = $query->result_array();
		if($data){
			return $this->dbarray_to_obj($data[0]);					
		}else{
			return null;
		}
	}
	
	
	function check_login($useremail, $password){
		$this->db->where(['user_email'=>$useremail, 'user_password'=>md5($password)]);
		$this->db->limit(0,1);
		$query = $this->db->get(self::tblname);
		$result = $query->result_array();
		if(empty($result)){
			return null;
		}
		return $result[0];
		
	}
	
	function get_alldata(){
		$query = $this->db->get(self::tblname);
		return $query->result_array();
	}
	
	
	function insert(){
		$query = $this->db->insert(self::tblname, $this);
		if($query){
			
			$this->id = $this->db->insert_id();
			return $this->id;
		}
		return null;
		
	}
	
	function update(){
		$query =  $this->db->replace(self::tblname, $this);
		if($query){
			$this->id = $this->db->insert_id();
			return $this->id;
		}
		return null;
	}
	
	function save(){
		if($this->id == 0){
			return $this->insert();
		}
		return $this->update();
	}
	
}