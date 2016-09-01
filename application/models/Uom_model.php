<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Uom_model extends CI_Model {

        public $id = 0;
        public $state_id;
        public $uom1_text;
        public $uom1_value;
        public $uom2_text;
        public $uom2_value;
        public $created_by;
        public $created_on;

        const tblName = 'tbluom';

        function __construct()
        {
                parent::__construct();
                

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
        public function get_record_list()
        {
                
                $query = $this->db->get(self::tblName);
                $blocks = $query->result_array();
                return $blocks;
        }
        
        public function get_record_list_byid($id){
			$query = $this->db->where(['id'=>$id])
								->get(self::tblName);
            $blocks = $query->result_array();
            return $blocks[0];
		}
        
        public function get_record_list_withstate()
        {
			$query = $this->db->select('u.*, s.state')
							->from('tbluom u')
							->join('tblstate s', 'u.state_id=s.id', 'left')
							->get();
			$data = $query->result_array();
			return $data;
		}

                

        public function insert_entry()
        {
                /*$data = [
                            'state_id' =>$this->state_id,
                            'uom1_text' => $this->uom1_text,
                            'uom1_value' => $this->uom1_value,
                            'uom2_text' => $this->uom2_text,
                            'uom2_value' => $this->uom2_value,
                            'created_by' => $this->created_by,
                            'created_on' => $this->created_on
                        ];*/
                        
                if($this->db->replace(self::tblName, $this))
                {
                        $this->id = $this->db->insert_id();
                }
                return $this->id;

        }

        public function update_entry()
        {
              /* $data = [
                            'state_id' =>$this->state_id,
                            'uom1_text' => $this->uom1_text,
                            'uom1_value' => $this->uom1_value,
                            'uom2_text' => $this->uom2_text,
                            'uom2_value' => $this->uom2_value,
                            'created_by' => $this->created_by,
                            'created_on' => $this->created_on
                        ];*/
                if($this->db->replace(self::tblName, $this))
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