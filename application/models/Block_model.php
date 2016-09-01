<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Block_model extends CI_Model {

        public $id = 0;
        public $state_id;
        public $district_id;
        public $block_name;
        public $created_by;
        public $created_on;

        public $tblName = 'tblblock';

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
		
		public function get_record_listbyid($id){
			$query =  $this->db->select('b.*, s.state, d.district_name')
								->from('tblblock b')
								->join('tblstate s', 'b.state_id = s.id', 'left')
								->join('tbldistrict d', 'b.district_id = d.id', 'left')
								->where(['b.id'=>$id])
								->get();
            $blocks = $query->result_array();
            return $blocks[0];
		}
		
        public function get_record_list()
        {
                
                $query = $this->db->get($this->tblName);
                $blocks = $query->result_array();
                return $blocks;
        }
        
        public function get_blocklist()
        {
			$query = $this->db->select('b.*, s.state, d.district_name')
								->from('tblblock b')
								->join('tblstate s', 'b.state_id = s.id', 'left')
								->join('tbldistrict d', 'b.district_id = d.id', 'left')
								->get();
			$data = $query->result_array();
			return $data;
		}

        public function get_block_fromids($state_id, $district_id)
        {
                $this->db->where(['state_id'=>$state_id, 'district_id'=>$district_id]);
                $query = $this->db->get($this->tblName);
                $blocks = $query->result_array();
                return $blocks;
        }
        

        public function insert_entry()
        {
                $data = [
                  'state_id' => $this->state_id,
                  'district_id' => $this->district_id,
                  'block_name' => $this->block_name,
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
                  'district_id' => $this->district_id,
                  'block_name' => $this->block_name,
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
                
               if($this->id == 0)
                {
                        return $this->insert_entry();
                }
                return $this->update_entry();
        }
        

}