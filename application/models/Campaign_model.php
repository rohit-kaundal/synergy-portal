<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaign_model extends CI_Model {

        public $id = 0;
		public $survey_id;
		public $start_date;
		public $end_date;
		public $back_limit;
		public $agents_assoc;
		public $created_by;
		public $created_on;

        const tblName = 'tblcampaign';

        function __construct()
        {
                parent::__construct();
                

        }
        
        public function get_campaign($id){
			$obj = null;
			
			$query = $this->db->where(['id'=>$id])
						->get(self::tblName);
			$data = $query->result_object();
			if($data){
				$obj = new Campaign_model();
				$data = $data[0];
				
				$obj->id = $data->id;
				$obj->survey_id = $data->survey_id;
				$obj->start_date = $data->start_date;
				$obj->end_date = $data->end_date;
				$obj->back_limit = $data->back_limit;
				$obj->agents_assoc = $data->agents_assoc;
				$obj->created_by = $data->created_by;
				$obj->created_on = $data->created_on;
				
				
				return $obj;
			}else{
				return null;
			}
			
		}
        
        public function get_formattedlist()
        {
			$campaign_list = $this->get_detailed_list();
						
			foreach($campaign_list as $key => $campaign){
				$assoclist = $campaign['agents_assoc'];
				$ids = explode(',', $assoclist );
				$agentlist = array();
				foreach($ids as $id){
					$name = $this->userdetails_model->get_username($id);
					if($name){
						$agentlist[] = $name[0]['fullname'];
					}
					
				}
				$campaign_list[$key]['agents'] = $agentlist;
				$campaign_list[$key]['survey_title'] =" Sample Survey 1";			
			}
			
			return $campaign_list;
		}

		public function get_detailed_list(){
			$query = $this->db->get(self::tblName);
                $blocks = $query->result_array();
                return $blocks;
		}
        public function get_record_list()
        {
                
                $query = $this->db->get(self::tblName);
                $blocks = $query->result_array();
                return $blocks;
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