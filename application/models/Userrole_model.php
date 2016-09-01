<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Userrole_model extends CI_Model {

        public $role_id = 0;
        public $role_title;
        public $role_desc;
        public $created_on;
        public $created_by;
        
		const tblName = 'tbluserrole';
        function __construct()
        {
                parent::__construct();
                

        }
        
        public function delete_record(){
        	$id = $this->id;			
			$query = $this->db->delete(self::tblName, ['role_id'=>$id]);
			if($query){
				return true;
			}
		
			return false;
			
		}
		
		public function get_role_byid($id){
			$result = array();
			$query = $this->db->where(['role_id'=>$id])
								->get(self::tblName);
            $result = $query->result_array();
            return $result[0];
			
		}
		
        public function get_roles()
        {
        	
			$query = $this->db->get('tbluserrole');
			$result = $query->result_array();
			return $result;
		}


       

        public function insert_entry()
        {
                $data = [
                  'role_title' => $this->role_title,
                  'role_desc' => $this->role_desc,
                  'created_by' => $this->created_by
                ];
                if($this->db->insert('tbluserrole', $data))
                {
                        $this->role_id = $this->db->insert_id();
                }
                return $this->role_id;

        }

        public function update_entry()
        {
               $data = [
                  'role_title' => $this->role_title,
                  'role_desc' => $this->role_desc,
                  'created_by' => $this->created_by
                ];
                if($this->db->update('tbluserrole', $data,['role_id'=>$this->role_id]))
                {
                        $this->role_id = $this->db->insert_id();
                }
                return $this->role_id;
                
        }

        public function save()
        {
                
               // $data = $this->db->query('show databases');
                //$result = $data->result();
                //print_r($result);
                //exit;

                if($this->role_id == 0)
                {
                        return $this->insert_entry();
                }
                return $this->update_entry();
        }

}