<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class District_model extends CI_Model {

        public $id = 0;
        public $state_id;
        public $district_name;
        public $created_on;
        public $created_by;

        public $tblName = 'tbldistrict';

        function __construct()
        {
                parent::__construct();
                

        }
		
		public function delete_record(){
			
			$id = $this->id;			
			$query = $this->db->delete($this->tblName, ['id'=>$id]);
			if($query){
				return true;
			}
		
			return false;	
		}
		
		public function get_statelist_byid($id){
			$query = $this->db->select('d.* , s.state')
								->from('tbldistrict d')
								->join('tblstate s', 'd.state_id = s.id', 'left')
								->where(['d.id'=>$id])								
								->get();
			$data = $query->result_array();
			return $data[0];
		}
		
		public function get_statelist()
		{
			$query = $this->db->select('d.* , s.state')
								->from('tbldistrict d')
								->join('tblstate s', 'd.state_id = s.id', 'left')								
								->get();
			$data = $query->result_array();
			return $data;
		}

        public function get_record_list()
        {
                
                $query = $this->db->get($this->tblName);
                $states = $query->result_array();
                return $states;
        }

        public function get_district_fromstateid($state_id)
        {
                $this->db->where(['state_id'=>$state_id]);
                $query = $this->db->get($this->tblName);
                $states = $query->result_array();
                return $states;
        }
        

        public function insert_entry()
        {
                $data = [
                  'state_id' => $this->state_id,
                  'district_name' => $this->district_name,
                  'created_by' => $this->created_by
                ];
                if($this->db->insert($this->tblName, $data))
                {
                        $this->id = $this->db->insert_id();
                }
                return $this->id;

        }

        public function update_entry()
        {
               $data = [
                  'state_id' => $this->state_id,
                  'district_name' => $this->district_name,
                  'created_by' => $this->created_by
                ];
                if($this->db->update($this->tblName, $data,['id'=>$this->id]))
                {
                        $this->id = $this->db->insert_id();
                }
                return $this->id;
                
        }

        public function save()
        {
                
               // $data = $this->db->query('show databases');
                //$result = $data->result();
                //print_r($result);
                //exit;

                if($this->id == 0)
                {
                        return $this->insert_entry();
                }
                return $this->update_entry();
        }
        

}