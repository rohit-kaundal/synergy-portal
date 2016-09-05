<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Answer_model extends CI_Model {

        public  $id = 0,
				$answer,
				$answerkey,
				$answernumerickey,
				$redirectquestionid,
				$questionid,
				$created_on,
				$created_by;
		
        const tblName = 'tblanswers';

        function __construct()
        {
                parent::__construct();
                

        }

        function get_answers()
        {
            
            $query = $this->db->get(self::tblName);
            $result = $query->result_array();
            if($result){
				return $result;
			}else{
				return null;	
			}
            
        }
        
        function get_answers_toquestion($qid)
        {
            
            $query = $this->db->where(['questionid'=>$qid])
            				->get(self::tblName);
            $result = $query->result_array();
            if($result){
				return $result;
			}else{
				return null;	
			}
            
        }
        


        public function get_answer($id)
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