<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Question_model extends CI_Model {

        public  $id = 0,
				$question,
				$question_type,
				$survey_id,
				$isoptional,
				$created_on,
				$created_by;
		
        const tblName = 'tblquestions';

        function __construct()
        {
                parent::__construct();
                

        }

        function get_questions()
        {
            
            $query = $this->db->get(self::tblName);
            $result = $query->result_array();
            if($result){
				return $result;
			}else{
				return null;	
			}
            
        }


        public function get_question($id)
        {
            $query = $this->db->where(['id'=>$id])
            				->get(self::tblName);
            $result = $query->result_array();
            if($result){
            	return $result[0];
			}else{
				return null;	
			}
        }
        

        public function insert_entry()
        {
               
                if($this->db->replace(self::tblName, $this))
                {
                        $this->id = $this->db->insert_id();
                }
                return $this->id;

        }

       

        public function save()
        {               
               $id = $this->insert_entry();
                if($this->id == 0)
                {
                        return $id;
                }
                return $this->id;
        }
        
        public function delete()
        {
        	$id = $this->id;
			if($id > 0){				
					$this->db->where(['id'=>$id])
							->delete(self::tblName);
				return $this->db->affected_rows();				
			}else{
				return null;
			}
		}
        

}