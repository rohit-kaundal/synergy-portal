<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require(APPPATH.'/libraries/REST_Controller.php');

class Api extends REST_Controller{
	
	/**
	* Users api
	*/
	function users_get()
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
	}
	
	
	
}

?>