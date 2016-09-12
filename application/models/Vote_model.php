<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vote_model extends CI_Model {

        public  $id = 0,
				$questionid,
				$answerid,
				$answertext,
				$respondantind,
				$surveyid,
				$votedon,
                $userid;
		
        const tblName = 'tblvotes';

        function __construct()
        {
                parent::__construct();
                

        }

        function get_votes()
        {
            
            $query = $this->db->get(self::tblName);
            $result = $query->result_array();
            if($result){
				return $result;
			}else{
				return null;	
			}
            
        }
        
        function get_votes_onanswers($aid)
        {
            
            $query = $this->db->where(['answerid'=>$aid])
            				->get(self::tblName);
            $result = $query->result_array();
            if($result){
				return $result;
			}else{
				return null;	
			}
            
        }
        
        function get_votes_byrespondant($rid)
        {
            
            $query = $this->db->where(['respondantind'=>$rid])
            				->get(self::tblName);
            $result = $query->result_array();
            if($result){
				return $result;
			}else{
				return null;	
			}
            
        }
        


        public function get_vote($id)
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