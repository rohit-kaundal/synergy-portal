<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	
	
	private $userid = 0;
		 
	public function index()
	{
		// Give auth wall
		$this->userauth->check_login();
		
		$this->load->view('admin_header', ['title'=>'Dashboard', 'effect' => 'page-left-in']);
		$this->load->view('admin_dashboard');
		$this->load->view('admin_footer');
	}

	public function test()
	{
		$this->load->view('admin_header');
		$this->load->view('admin_test');
		$this->load->view('admin_footer');
	}

	public function __construct()
	{
		parent::__construct();
		$this->userid = ($this->session->has_userdata('user_id') ? $this->session->userdata('user_id') : 1);
	}
	
	//Auth management
	
	function forgotpassword(){
		// view of forgot password
	}
	
	function do_forgotpassword(){
		// do http forgot password
		print_r($_POST);
	}
	
	function do_forgotpasswordajax(){
		// do ajax forgot password
	}
	
	
	function dologin(){
		
		
		print_r($_POST);
		
		// does form processing login
	}
	
	function dologinajax(){	
		//get data
		$post = $this->input->post();
		
		//init response
		//$response['redirect_url'] = urlencode(site_url());
		
		// check for empty field
		if(!empty($post)){
			
			$lg = $this->userauth->user_login($post['username'], $post['password']);
			if($lg){
				$response['login_status'] = 1;			
			}else{
				$response['login_status'] = 0;			
			}
		}
		
		
		
		echo json_encode($response);
		
		// does form processing login
	}
	
	public function login()
	{
		// Give auth wall
		//$this->userauth->check_login();
		$this->load->view('view_login', ['title'=>'Login']);
		
	}
	
	function logout()
	{
		$this->userauth->log_out();
	}

	// User management
	
	public function changemypassword(){
		
		// Give auth wall
		$this->userauth->check_login();
		
		
		$this->load->view('admin_header', ['title'=>'Change password','id' => $this->userid]);
		$this->load->view('changemypwd');
		$this->load->view('admin_footer');
	
	}
	
	
	public function changepassword($id = 0){
		
		// Give auth wall
		$this->userauth->check_login();
		
		if($id>0){
			$this->load->view('admin_header', ['title'=>'Change password', 'id'=>$id]);
			$this->load->view('changepwd');
			$this->load->view('admin_footer');
		}
	}

	public function add_user()
	{
		// Give auth wall
		$this->userauth->check_login();
		
		$this->load->view('admin_header', ['title'=>'Add user']);
		$this->load->view('add_user');
		$this->load->view('admin_footer');

	}

	public function edit_user($userid = 0)
	{
		// Give auth wall
		$this->userauth->check_login();
		
		if($userid > 0){
			$this->load->view('admin_header', ['title'=>'Edit user', 'id' => $userid]);
			$this->load->view('single_user');
			$this->load->view('admin_footer');	
		}else{
			$this->load->view('admin_header', ['title'=>'Users list']);
			$this->load->view('edit_user');
			$this->load->view('admin_footer');
		}
		
		
		
	}

	public function delete_user($id=0)
	{
		// Give auth wall
		$this->userauth->check_login();
		
		
	}

	/**
	*
	*Roles Definition
	**/
	public function add_role()
	{
		// Give auth wall
		$this->userauth->check_login();
		
		$this->load->view('admin_header', ['title'=>'Add role']);
		$this->load->view('add_role');
		$this->load->view('admin_footer');
	}
	
	public function delete_role($id = 0){
		
		// Give auth wall
		$this->userauth->check_login();
		
		if($id > 0){
			// load deletion view
			$this->userrole_model->id = $id;
			$result = $this->userrole_model->delete_record();
			if($result){
				$this->session->set_flashdata('msg', 'Success!!!');
			}else{
				$this->session->set_flashdata('err', 'Error deleting record!');
			}
			
		}
		redirect(site_url('dashboard/edit_role'), 'refresh');
		
		
	}
	
	public function edit_role($id =0)
	{
		// Give auth wall
		$this->userauth->check_login();
		
		if($id > 0){
			$this->load->view('admin_header', ['title'=>'Edit role', 'id'=>$id]);
			$this->load->view('single_role');
			$this->load->view('admin_footer');
		}else{
			$this->load->view('admin_header', ['title'=>'Role list']);
			$this->load->view('edit_role');
			$this->load->view('admin_footer');	
		}
		
	}


	//District routes
	public function add_district()
	{
		// Give auth wall
		$this->userauth->check_login();
		
		$this->load->view('admin_header', ['title'=>'Add district']);
		$this->load->view('add_district');
		$this->load->view('admin_footer');
	}
	
	public function delete_district($id = 0){
		// Give auth wall
		$this->userauth->check_login();
		
		if($id > 0){
			// load deletion view
			$this->district_model->id = $id;
			$result = $this->district_model->delete_record();
			if($result){
				$this->session->set_flashdata('msg', 'Success!!!');
			}else{
				$this->session->set_flashdata('err', 'Error deleting record!');
			}
			
		}
		redirect(site_url('dashboard/update_district'), 'refresh');
		
	}
	
	public function update_district($id = 0)
	{
		// Give auth wall
		$this->userauth->check_login();
		
		if($id > 0){
			$this->load->view('admin_header', ['title'=>'Update district', 'id'=>$id]);
			$this->load->view('single_district');
			$this->load->view('admin_footer');
			
		}else{
			$this->load->view('admin_header', ['title'=>'District list']);
			$this->load->view('edit_district');
			$this->load->view('admin_footer');
		}
		
		
	}


	// Block routes
	public function add_block()
	{
		// Give auth wall
		$this->userauth->check_login();
		
		$this->load->view('admin_header', ['title'=>'Add block']);
		$this->load->view('add_block');
		$this->load->view('admin_footer');

	}
	
	public function edit_block($id = 0)
	{
		// Give auth wall
		$this->userauth->check_login();
		
		if($id > 0){
			$this->load->view('admin_header', ['title'=>'Edit block', 'id'=>$id]);
			$this->load->view('single_block');
			$this->load->view('admin_footer');
		}else{
			$this->load->view('admin_header', ['title'=>'Block list']);
			$this->load->view('edit_block');
			$this->load->view('admin_footer');	
		}
		
		

	}
	
	public function delete_block($id = 0){
		
		// Give auth wall
		$this->userauth->check_login();
		
		if($id > 0){
			// load deletion view
			$this->block_model->id = $id;
			$result = $this->block_model->delete_record();
			if($result){
				$this->session->set_flashdata('msg', 'Success!!!');
			}else{
				$this->session->set_flashdata('err', 'Error deleting record!');
			}
			
		}
		redirect(site_url('dashboard/edit_block'), 'refresh');
		
	}

	//Company routes
	public function add_company()
	{
		// Give auth wall
		$this->userauth->check_login();
		
		$this->load->view('admin_header', ['title'=>'Add company']);
		$this->load->view('add_company');
		$this->load->view('admin_footer');
	}
	
	public function edit_company($id = 0)
	{
		// Give auth wall
		$this->userauth->check_login();
		
		if($id > 0){
			$this->load->view('admin_header', ['title'=>'Edit company', 'id'=>$id]);
			$this->load->view('single_company');
			$this->load->view('admin_footer');
			
		}else{
			$this->load->view('admin_header', ['title'=>'Company List']);
			$this->load->view('edit_company');
			$this->load->view('admin_footer');	
		}
		
		
	}
	
	public function delete_company($id = 0){
		
		// Give auth wall
		$this->userauth->check_login();
		
		if($id > 0){
			// load deletion view
			$this->company_model->id = $id;
			$result = $this->company_model->delete_record();
			if($result){
				$this->session->set_flashdata('msg', 'Success!!!');
			}else{
				$this->session->set_flashdata('err', 'Error deleting record!');
			}
			
		}
		redirect(site_url('dashboard/edit_company'), 'refresh');
		
	}

	//UOM routes
	public function add_uom()
	{
		// Give auth wall
		$this->userauth->check_login();
		
		$this->load->view('admin_header', ['title'=>'Add UOM']);
		$this->load->view('add_uom');
		$this->load->view('admin_footer');
	}
	
	public function edit_uom($id = 0)
	{
		// Give auth wall
		$this->userauth->check_login();
		
		if($id > 0){
			// if id passed then load single file
			$this->load->view('admin_header', ['title'=>'Edit UOM', 'id'=>$id]);
			$this->load->view('single_uom');
			$this->load->view('admin_footer');
		}else{
			// else load list
			$this->load->view('admin_header', ['title'=>'UOM List']);
			$this->load->view('edit_uom');
			$this->load->view('admin_footer');
		}
		
		
	}
	
	function delete_uom($id = 0){
		
		// Give auth wall
		$this->userauth->check_login();
		
		if($id > 0){
			// load deletion view
			$this->uom_model->id = $id;
			$result = $this->uom_model->delete_record();
			if($result){
				$this->session->set_flashdata('msg', 'Success!!!');
			}else{
				$this->session->set_flashdata('err', 'Error deleting record!');
			}
			
		}
		redirect(site_url('dashboard/edit_uom'), 'refresh');
	}

	// Campaing routes

	public function add_campaign()
	{
		// Give auth wall
		$this->userauth->check_login();
		
		$this->load->view('admin_header', ['title'=>'Add Campaign']);
		$this->load->view('add_campaign');
		$this->load->view('admin_footer');

	}
	
	public function edit_campaign($id = 0)
	{
		// Give auth wall
		$this->userauth->check_login();
		
		if($id > 0){
			$this->load->view('admin_header', ['title'=>'Edit campaign', 'id' => $id]);
			$this->load->view('single_campaign');
			$this->load->view('admin_footer');
	
		}else{
			$this->load->view('admin_header', ['title'=>'Campaign List']);
			$this->load->view('edit_campaign');
			$this->load->view('admin_footer');

		}
		
		
	}
	
	public function delete_campaign($id = 0){
		
		// Give auth wall
		$this->userauth->check_login();
		
		if($id > 0){
			// load deletion view
			$this->campaign_model->id = $id;
			$result = $this->campaign_model->delete_record();
			if($result){
				$this->session->set_flashdata('msg', 'Success!!!');
			}else{
				$this->session->set_flashdata('err', 'Error deleting record!');
			}
			
		}
		redirect(site_url('dashboard/edit_campaign'), 'refresh');
		
	}
	
	
	
	/**
	* Survey Related Routes
	* 
	* @return
	*/
	
		// Campaing routes

	public function add_survey()
	{
		// Give auth wall
		$this->userauth->check_login();
		
		$this->load->view('admin_header', ['title'=>'Add Survey']);
		$this->load->view('add_survey');
		$this->load->view('admin_footer');

	}
	
	public function edit_survey($id = 0)
	{
		// Give auth wall
		$this->userauth->check_login();
		
		if($id > 0){
			$this->load->view('admin_header', ['title'=>'Edit survey', 'id' => $id]);
			$this->load->view('single_survey');
			$this->load->view('admin_footer');
	
		}else{
			$this->load->view('admin_header', ['title'=>'Survey List']);
			$this->load->view('edit_survey');
			$this->load->view('admin_footer');

		}
		
		
	}
	
	public function delete_survey($id = 0){
		
		// Give auth wall
		$this->userauth->check_login();
		
		if($id > 0){
			// load deletion view
			$this->survey_model->id = $id;
			$result = $this->survey_model->delete_record();
			if($result){
				$this->session->set_flashdata('msg', 'Success!!!');
			}else{
				$this->session->set_flashdata('err', 'Error deleting record!');
			}
			
		}
		redirect(site_url('dashboard/edit_survey'), 'refresh');
		
	}

	

	public function change_pic(){
		
		// get auth wall
		$this->userauth->check_login();
		
			$this->load->view('admin_header', ['title'=>'Change Profile Pic']);
			$this->load->view('change_pic');
			$this->load->view('admin_footer');
	}
	
	public function angulartest()
	{
		// get auth wall
		$this->userauth->check_login();
		$this->load->view('admin_header', ['title'=>'Angular JS']);
		$this->load->view('angularjs-test');
		$this->load->view('admin_footer');
	}
	
	function edit_questions($id)
	{
		// get auth wall
		$this->userauth->check_login();
		
		$url = site_url('dashboard/edit_survey');
		if($id>0){
			$this->load->view('admin_header', ['title'=>'Survey Questionaire Builder']);
			$this->load->view('survey_builder', ['id'=>$id]);
			$this->load->view('admin_footer');
			
		}else{
			redirect($url);
		}
	}
	
	

}

