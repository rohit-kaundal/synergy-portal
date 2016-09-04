<?php

defined('BASEPATH') or die('not allowed');

class Userdetails_model extends CI_Model {
	
	public $id = 0;
	public $userid;
	public $fullname;
	public $gender;
	public $dob;
	public $mobile;
	public $address;
	public $cityid;
	public $stateid;
	public $pincode;
	
	const tblname ='tbluserdetails';
	
	function __construct(){
		parent::__construct();
	}
	
	
	private function dbarray_to_obj($array){
		$dao = new Userdetails_model();
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
	
	public function getmobileno($userid){
		$query = $this->db->select('mobile')
							->where(['userid'=>$userid])
							->get(self::tblname);
		$data = $query->result_array();
		if(!empty($data)){
			return $data[0];
		}else{
			return null;
		}
		
	}
	
	function get_all_details(){
		$query = $this->db->select("*")							
							->join('tbluserlogin', 'tbluserdetails.userid = tbluserlogin.id', 'left')
							->join('tbluserrole', 'tbluserrole.role_id = tbluserlogin.user_roleid','left' )
							->get(self::tblname);
		$data = $query->result_array();
		return $data;
	}
	
	function get_all_details_ofid($id){
		$query = $this->db->select("a.*, a.id as _id, b.*, c.*")
							->from(self::tblname.' a')							
							->join('tbluserlogin b', 'a.userid = b.id', 'left')
							->join('tbluserrole c', 'c.role_id = b.user_roleid','left' )
							->where(['b.id' => $id])
							->limit(0,1)
							->get();
							
		$data = $query->result_array();
		if($data){
			return $data[0];	
		}else{
			return null;
		}
		
	}
	
	function get_username($id){
		
		$query = $this->db->select('fullname')
							->limit(0,1)
							->where(['userid'=>$id])
							->get(self::tblname);
		$result = $query->result_array();
		return $result;
	}
		
	function get_alldata(){
		$query = $this->db->get(self::tblname);
		return $query->result_array();
	}
	
	
	function insert(){
		$query = $this->db->replace(self::tblname, $this);
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

