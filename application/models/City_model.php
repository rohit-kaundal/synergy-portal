<?php

defined('BASEPATH') or die('no direct acccesss!');

class City_model extends CI_Model {
	
	public $Id = 0;
	public $CreatedBy;
	public $CreatedOn;
	public $Name;
	public $State;
	
	public $tblname = 'tblcity';
	
	function __construct(){
		
		parent::__construct();
	}
	
	function get_allcitystate()
	{
		$this->db->select('c.Name, s.State, c.id');
		$this->db->from('tblcity c');
		$this->db->join('tblstate s', 'c.State = s.ID', 'left');
		
		$query = $this->db->get();
		$cities = $query->result_array();
		// sorting
		
		$sort_date = array();
		if(!empty($cities)){
			foreach($cities as $rowid => $key){
				$sort_date[$key['State']][$key['id']] = $key['Name'];
			}
		}
		return $sort_date;	
		
	}
	function get_allcities(){
		$query = $this->db->get($this->tblname);
		$cities = $query->result_array();
		return $cities;	
		
	}
	function get_cities_from_state($stateid){
		$this->db->where(['State' => $stateid]);
		$query = $this->db->get($this->tblname);
		$cities = $query->result_array();
		return $cities;		
	}
	
	public function insert(){
		
	}
	
	public function update(){
		
		
	}
	
	public function save(){
		
	}
	
	
	
}
