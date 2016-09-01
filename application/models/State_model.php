<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class State_model extends CI_Model {

        public $id = 0;
        public $state;
        public $country_id;
        public $created_on;
        public $created_by;
        

        function __construct()
        {
                parent::__construct();
                

        }

        function get_statename($id)
        {
            $this->db->where(['id' => $id]);
            $this->db->select('state');
            $this->db->limit(0,1);
            $query = $this->db->get('tblstate');
            $result = $query->result_array();
            return $result[0]['state'];
        }


        public function get_state_list()
        {
                
                $query = $this->db->get('tblstate');
                $states = $query->result_array();
                return $states;
        }
        /*

        public function insert_entry()
        {
                $data = [
                  'role_title' => $this->role_title,
                  'role_desc' => $this->role_desc,
                  'created_by' => $this->created_by
                ];
                if($this->db->insert('tblUserRole', $this))
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
                if($this->db->update('tblUserRole', $data,['role_id'=>$this->role_id]))
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
        */

}