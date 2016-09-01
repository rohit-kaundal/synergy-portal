<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_model extends CI_Model {

        public $id = 0;
        public $company_title;
        public $company_addr;
        public $created_by;
        public $created_on;

        public $tblName = 'tblcompany';

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
        
        
		public function get_recordlist_byid($id){
		    $query = $this->db->where(['id'=>$id])
		    					->get($this->tblName);
            $blocks = $query->result_array();
            return $blocks[0];
		}
		
        public function get_record_list()
        {
                
                $query = $this->db->get($this->tblName);
                $blocks = $query->result_array();
                return $blocks;
        }

                

        public function insert_entry()
        {
                $data = [
                        'company_title'=>$this->company_title,
                        'company_addr'=>$this->company_addr,
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
                        'company_title'=>$this->company_title,
                        'company_addr'=>$this->company_addr,
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