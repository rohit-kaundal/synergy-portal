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
	/**
	* Login api implemented
	*/
	function login_post(){
		
		$username = $this->post('login');
		$password = $this->post('pwd');
		
		
		if(!$username && !$password){
			$this->response(["Invalid credentials"], 500);
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
		$recordType = $this->post('recordtype');
		$record = $this->post('record');
		
		if($recordType && $record){
			switch ($recordType) {
			    case "vote":
			        $vm = new vote_model();
					$vm->id = 0;
					$vm->questionid = $record['questionid'];
					$vm->answerid = $record['answerid'];
					$vm->answertext = $record['answertext'];
					$vm->respondantind = $record['respondantind'];
					$vm->surveyid = $record['surveyid'];
					$vm->votedon = date('Y-m-d H:i:s', $record['votedon'] / 1000);
					$vm->userid = $record['userid'];
					if($vm->save()){
						
						$this->response($vm, 200);
					}
			        break;
			        
			    case "respondant":
			        $rm = new respondant_model();

					$rm->id = 0;
					$rm->fullname = $record['fullname'];
					$rm->mobileid = $record['mobileid'];
					$rm->photo = $record['photo'];
					$rm->address = $record['address'];
					$rm->pincode = $record['pincode'];
					
					$rm->latitude = $record['latitude'];
					$rm->longitude = $record['longitude'];
					$rm->surveyid = $record['surveyid'];
					$rm->userid = $record['userid'];
					$rm->dateofsurvey = date('Y-m-d H:i:s', $record['dateofsurvey'] / 1000);
					if($rm->save()){
						$this->response($rm,200);	
					}
			        
			    
			    default:
			        $this->response("Unknown Record Type",500);
			}
		}
		
	}
	

	public function syncdataofagent_post(){

		$id = $this->post('agentid');
		$respdata = [];

		if(!$id){
			$this->response("Access-Denied",500);
		}else{
			
			$query = $this->db->where('userid', $id)
		             ->get('tblrespondant');

		    $total_count = $query->num_rows() ? $query->num_rows() : 0;

			$respdata['uploadedSurveysCount'] = $total_count;

			// More variables here


			$this->response($respdata, 200);

		}
	}
	
	
}

?>