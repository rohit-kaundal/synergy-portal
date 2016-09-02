<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey_model extends CI_Model {

        public $id = 0;
		public $title;
		public $description;
		public $keywords;
		public $created_by;
		public $created_on;
		
	
        const tblName = 'tblsurvey';

        function __construct()
        {
                parent::__construct();
                

        }
        
        public function get_survey($id){
			$obj = null;
			
			$query = $this->db->where(['id'=>$id])
						->get(self::tblName);
			$data = $query->result_object();
			if($data){
				$obj = new Survey_model();
				$data = $data[0];
				
				$obj->id = $data->id;
				$obj->title = $data->title;
				$obj->description = $data->description;
				$obj->keywords = $data->keywords;
				$obj->created_by = $data->created_by;
				$obj->created_on = $data->created_on;
				
				
				return $obj;
			}else{
				return null;
			}
			
		}
        
       

	   public function get_record_list()
        {
                
                $query = $this->db->order_by('id', 'DESC')
                			->get(self::tblName);
                $blocks = $query->result_array();
                return $blocks;
        }
        
      
                

        public function insert_entry()
        {
                
                        
                if($this->db->replace(self::tblName, $this))
                {
                        $this->id = $this->db->insert_id();
                }
                return $this->id;

        }

        public function update_entry()
        {
              
                if($this->db->replace(self::tblName, $this))
                {
                        //$this->id = $this->db->insert_id();
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
        
        // delete record  based on id
		public function delete_record(){
			$id = $this->id;			
			$query = $this->db->delete(self::tblName, ['id'=>$id]);
			if($query){
				return true;
			}
		
			return false;
		}

}