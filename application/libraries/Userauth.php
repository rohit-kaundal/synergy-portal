<?php
defined('BASEPATH') or die("No direct access");

class Userauth {
	
	protected $ci;
	
	function __construct(){
		$this->ci = &get_instance();
		$this->ci->load->model('userlogin_model');
		$this->ci->load->model('userdetails_model');
		$this->ci->load->library('session');
	}
	
	function user_login($username, $password){
		$user = $this->ci->userlogin_model->check_login($username,$password);
		
		if(!empty($user)){
			$userdetails = $this->ci->userdetails_model->get_all_details_ofid($user['id']);
			$this->ci->session->set_userdata(
								['user_id' => $user['id'],
								 'user_email' => $user['user_email'],
								 'user_details' => $userdetails							
								]);
			return true;
			
		}
		return false;
	}
	
	
	
	function log_out(){
		$this->ci->session->unset_userdata(['user_id','user_email', 'user_details']);
		redirect('dashboard/login');
	}
	
	function check_login(){
		$uid = $this->ci->session->userdata('user_id');
		if(empty($uid)){
			redirect('dashboard/login');
		}
	}
	
	function get_user_details(){
		$details = $this->ci->session->userdata('user_details');
		if(!empty($details)){
			return $details;
		}else{
			return null;
		}
	}
	
	
}