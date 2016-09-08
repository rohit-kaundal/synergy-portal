<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class Api extends REST_Controller{
	
	function __construct()
	{
		parent::__construct();
		header('Access-Control-Allow-Origin: *');
		header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
		header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
		$method = $_SERVER['REQUEST_METHOD'];
		if($method == "OPTIONS") {
			die();
		}
	}
	
	/**
	* Users api
	*/
	/*function users_get()
	{
		$id = $this->get('id');
		if($id){
			$user = $this->userdetails_model->get_all_details_ofid($id);
			if($user){
				$this->response($user,200);	
			}else{
				$this->response(null,404);
			}
			
		}else{
			$users = $this->userdetails_model->get_all_details();
			if($users){
				$this->response($users,200);	
			}else{
				$this->response(null,404);
			}
			
		}
	}
	
	function users_delete()
	{
		// delete user
		$id = $this->delete('id');
		if($id>0){
			$del = $this->userdetails_model->delete($id);
			if($del){
				$this->response(['Deleted user'], 200);
			}else{
				$this->response(["Invalid ID"], 400);
			}
		}else{
			$this->response(["Invalid ID"], 400);
		}
	}*/
	
	
	/**
	* Login api implemented
	*/
	function login_post(){
		
		$username = $this->post('login');
		$password = $this->post('pwd');
		
		
		if(!$username && !$password){
			$this->response(["Invalid credentials"], 400);
		}
		
		$user = $this->userlogin_model->check_login($username,$password);
		if($user){
			$userdetails = $this->userdetails_model->get_all_details_ofid($user['id']);
			$this->response($userdetails,200);
		}else{
			$this->response(["Invalid ID/Password!"], 400);
		}
		
	}
	
	// Post agentid and get survey list
	function survey_post(){
		
		$id = $this->post('agentid');
		
		if($id > 0){
			$data = $this->get_surveydata($id);
			if(!empty($data)){
				$this->response($data, 200);	
			}else{
				$this->response(['Error'=>'Error connecting'], 400);
			}
			
		}else{
			$this->response(['Error'=>'Survey not found'], 400);
		}
	}
	
	private function get_surveydata($agentid)
	{
		$agentid; 
		
				
		$surveydetails;
		$qsa = null; // final form
		
		$query = $this->db->query('select * from tblcampaign, tblsurvey
					where tblcampaign.survey_id = tblsurvey.id and
						find_in_set(?, agents_assoc)', $agentid);
		if($query){
			$surveydetails = $query->result_array();
			
			foreach($surveydetails as $k => $s){
				$qsa[$k]['survey'] = $s;
				
				$survey_id = $s['survey_id'];
				$query = $this->db->query('SELECT * FROM tblquestions where survey_id = ?', $survey_id);
				if($query){
					$questions = $query->result_array();
					$qsa[$k]['survey']['questions'] = 	$questions;
					foreach($questions as $k1=> $q){
						$questionid = $q['id'];
						$query = $this->db->query('SELECT * FROM  tblanswers
							where tblanswers.questionid = ?', $questionid);
							if($query){
								$answers = $query->result_array();
								$qsa[$k]['survey']['questions'][$k1]['answers']=$answers; 
							}
					}
					
				}
			}
			
			return $qsa;
		}
		
		
			
		
		
		foreach($surveydetails as $key => $s){
			$qas['survey'][$s['survey_id']] = $s;
			foreach($questions as $key2 => $q ){
				if($q['survey_id'] === $s['survey_id']){
					$qas['survey'][$s['survey_id']]['questions'][$q['id']] = $q;
				}
				foreach($answers as $key3 => $a){
					if($a['questionid'] === $q['id']){
						$qas['survey'][$s['survey_id']]['questions'][$q['id']]['answers'][] = $a;					
					}
				}
			}
		}
		
		return $qas;
	}
	
	
	// sync votes from mobile app
	
	public function syncvotes_post()
	{
		
		$postdata = $this->post();
		$this->response(['status'=>200, 'votes'=>$postdata], 200);
	}
	
	
	
}

?>