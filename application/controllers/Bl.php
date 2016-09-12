<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bl extends CI_Controller
{
	private $userid;
	
	function __construct()
	{
		parent::__construct();

		// Load logged in userid
		$this->userid = ($this->session->has_userdata('user_id') ? $this->session->userdata('user_id') : 1);
	}

	function index()
	{
		echo "<h4>This is business access layer where all the data related parameters will be posted and processed</h4>";
	}


	// User management

	public function view_users()
	{
		
	}
	
	public function changemypwd(){
		
		// Give auth wall
		$this->userauth->check_login();
		
		// Set redirection url
		$url = site_url('dashboard/');
		
		//get post details
		$postdata = $this->input->post();
		
		//verify otp
		$resp = $this->otpapi->verifyOTP(['oneTimePassword' => $postdata['otp']]);
		$resp = json_decode($resp);
		
		
		$msg = $resp->message;
		$errors = array();
		
		
		
		if(0==strcmp($msg, 'INVALID')){
				$errors[] = "Wrong OTP";

			
		}else{
				$this->userlogin_model = $this->userlogin_model->getobject_fromid($postdata['_id']);
				$this->userlogin_model->user_password = md5($postdata['password']);
				$id = $this->userlogin_model->save();

				//set success msgs 
				$this->session->set_flashdata('msg', 'Success!!!');
				$this->session->set_flashdata('msgbox', " Password changed successfully !" );
		}
		// save it to show them on form
				$this->session->set_flashdata('err', $errors);
				
		redirect($url);// redirect to url finaly
		
	}
	
	public function changepwd(){
		
		// Give auth wall
		$this->userauth->check_login();
		
		// Set redirection url
		$url = site_url('dashboard/edit_user');

		// fetch post data
		$postdata = $this->input->post();

		//if not empty
		if($postdata && !empty($postdata))
		{
			// fetch data into variables
		
			$uid = (!empty($this->userid) ? $this->userid : 1);

			// set form rules
			$this->form_validation->set_rules('password','Password', 'required');

			// validate form
			if($this->form_validation->run() != FALSE)
			{
				//save data
				$this->userlogin_model = $this->userlogin_model->getobject_fromid($postdata['_id']);
				$this->userlogin_model->user_password = md5($postdata['password']);
				$id = $this->userlogin_model->save();

				//set success msgs 
				$this->session->set_flashdata('msg', 'Success!!!');
				$this->session->set_flashdata('msgbox', " Password changed successfully !" );
			}else{
				//get errors
				$errors = $this->form_validation->error_array();

				// save it to show them on form
				$this->session->set_flashdata('err', $errors);
			}

		}

		// redirect finally to the url	
		redirect($url);
		
		
		
	}

	public function add_user()
	{
		// Give auth wall
		$this->userauth->check_login();
		
		// Empty errors
		$errors = array();
		
		// Set redirection url
		$url = site_url('dashboard/add_user');

		// fetch post data
		$postdata = $this->input->post();

		//if not empty
		if($postdata && !empty($postdata)){
			$uid = (!empty($this->userid) ? $this->userid : 1);
			
			// set form rules
			$this->form_validation->set_rules('username','Username/Email', 'required');
			$this->form_validation->set_rules('password','Password', 'required');
			$this->form_validation->set_rules('mobile','Mobile number', 'required');

			// validate form
			if($this->form_validation->run() != FALSE){
				
				// Save data
				
				$this->userlogin_model->user_email = $postdata['username'];
				$this->userlogin_model->user_roleid = $postdata['role'];
				$this->userlogin_model->created_by = $uid;
				$this->userlogin_model->user_password = md5($postdata['password']);
				$id = $this->userlogin_model->save();
				if(!empty($id)){
					$this->userdetails_model->userid = $id;
					$this->userdetails_model->fullname = $postdata['full_name'];
					$this->userdetails_model->gender = (empty($postdata['gender'])?'F':'M');
					$this->userdetails_model->dob = date('Y-m-d', strtotime($postdata['dob']));
					$this->userdetails_model->mobile = str_replace('-','', $postdata['mobile']);
					$this->userdetails_model->address = $postdata['address'];
					$this->userdetails_model->cityid = $postdata['city'];
					$this->userdetails_model->stateid = $postdata['state'];
					$this->userdetails_model->pincode = $postdata['pincode'];
					$title = $this->userdetails_model->fullname;
					$userdetailsid = $this->userdetails_model->save();
					if($userdetailsid){
						$this->session->set_flashdata('msg', 'Success!!!');
						$this->session->set_flashdata('msgbox', 'User with name '. $title." added successfully !" );					}else{
							$errors[] = "Not able to save data";
						}		
					
				}				
			}else{
				//get errors
				$error = $this->form_validation->error_array();
				$errors = array_merge($errors, $error);

				// save it to show them on form
				$this->session->set_flashdata('err', $errors);
			}
			
			
		}
		
		
		// redirect finally to the url	
		redirect($url);
		

	}

	public function edit_user()
	{
		// Give auth wall
		$this->userauth->check_login();
		
		// Empty errors
		$errors = array();
		
		// Set redirection url
		$url = site_url('dashboard/edit_user');

		// fetch post data
		$postdata = $this->input->post();

		//if not empty
		if($postdata && !empty($postdata)){
			$uid = (!empty($this->userid) ? $this->userid : 1);
			
			// set form rules
			//$this->form_validation->set_rules('username','Username/Email', 'required');
			//$this->form_validation->set_rules('password','Password', 'required');
			//$this->form_validation->set_rules('mobile','Mobile number', 'required');

			// validate form
			if(true){
				
				// Save data
				$this->userlogin_model = $this->userlogin_model->getobject_fromid($postdata['userid']);
				//$this->userlogin_model->user_email = $postdata['username'];
				$this->userlogin_model->user_roleid = $postdata['role'];
				$this->userlogin_model->created_by = $uid;
				//$this->userlogin_model->user_password = md5($postdata['password']);
				$id = $this->userlogin_model->save();
				if(true){
					$this->userdetails_model = $this->userdetails_model->getobject_fromid($postdata['_id']);
					//$this->userdetails_model->userid = $id;
					$this->userdetails_model->fullname = $postdata['full_name'];
					$this->userdetails_model->gender = (empty($postdata['gender'])?'F':'M');
					$this->userdetails_model->dob = date('Y-m-d', strtotime($postdata['dob']));
					$this->userdetails_model->mobile = str_replace('-','', $postdata['mobile']);
					$this->userdetails_model->address = $postdata['address'];
					$this->userdetails_model->cityid = $postdata['city'];
					$this->userdetails_model->stateid = $postdata['state'];
					$this->userdetails_model->pincode = $postdata['pincode'];
					$title = $this->userdetails_model->fullname;
					$userdetailsid = $this->userdetails_model->save();
					if(true){
						$this->session->set_flashdata('msg', 'Success!!!');
						$this->session->set_flashdata('msgbox', 'User with name '. $title." added successfully !" );					}else{
							$errors[] = "Not able to save data";
						}		
					
				}				
			}else{
				//get errors
				$error = $this->form_validation->error_array();
				$errors = array_merge($errors, $error);

				// save it to show them on form
				$this->session->set_flashdata('err', $errors);
			}
			
			
		}
		
		
		// redirect finally to the url	
		redirect($url);
		

		
	}

	public function delete_user()
	{
		
	}

	/**
	*
	*Roles Definition
	**/
	public function add_role()
	{
		// Give auth wall
		$this->userauth->check_login();

		// Set redirection url
		$url = site_url('dashboard/add_role');

		// fetch post data
		$postdata = $this->input->post();

		//if not empty
		if($postdata && !empty($postdata))
		{
			// fetch data into variables
			$title = $this->input->post('role_title');
			$desc = $this->input->post('role_description');

			$uid = (!empty($this->userid) ? $this->userid : 1);

			// set form rules
			$this->form_validation->set_rules('role_title','Role Title', 'required');

			// validate form
			if($this->form_validation->run() != FALSE)
			{
				//save data
				$this->userrole_model->role_id = 0;
				$this->userrole_model->role_title = $title;
				$this->userrole_model->role_desc = $desc;
				$this->userrole_model->created_by = $uid;
				$id = $this->userrole_model->save();

				//set success msgs 
				$this->session->set_flashdata('msg', 'Success!!!');
				$this->session->set_flashdata('msgbox', 'Role with title '. $title.' and ID: '. $id . " added successfully !" );
			}else{
				//get errors
				$errors = $this->form_validation->error_array();

				// save it to show them on form
				$this->session->set_flashdata('err', $errors);
			}

		}

		// redirect finally to the url	
		redirect($url);
	}
	
	public function edit_role(){
		// Give auth wall
		$this->userauth->check_login();

		// Set redirection url
		$url = site_url('dashboard/edit_role');

		// fetch post data
		$postdata = $this->input->post();

		//if not empty
		if($postdata && !empty($postdata))
		{
			// fetch data into variables
			$title = $this->input->post('role_title');
			$desc = $this->input->post('role_description');

			$uid = (!empty($this->userid) ? $this->userid : 1);

			// set form rules
			$this->form_validation->set_rules('role_title','Role Title', 'required');

			// validate form
			if($this->form_validation->run() != FALSE)
			{
				//save data
				$this->userrole_model->role_id = $postdata['_id'];
				$this->userrole_model->role_title = $title;
				$this->userrole_model->role_desc = $desc;
				$this->userrole_model->created_by = $uid;
				$id = $this->userrole_model->save();

				//set success msgs 
				$this->session->set_flashdata('msg', 'Success!!!');
				$this->session->set_flashdata('msgbox', 'Role with title '. $title. " updated successfully !" );
			}else{
				//get errors
				$errors = $this->form_validation->error_array();

				// save it to show them on form
				$this->session->set_flashdata('err', $errors);
			}

		}

		// redirect finally to the url	
		redirect($url);
	}


	//District routes
	public function add_district()
	{
		// Give auth wall
		$this->userauth->check_login();


		// Set redirection url
		$url = site_url('dashboard/add_district');

		// fetch post data
		$postdata = $this->input->post();

		//if not empty
		if($postdata && !empty($postdata))
		{
			// fetch data into variables
			$title = $this->input->post('district_title');
			$state = $this->input->post('state');

			$uid = (!empty($this->userid) ? $this->userid : 1);

			// set form rules
			$this->form_validation->set_rules('district_title','District Title', 'required');
			$this->form_validation->set_rules('state','State', 'required');

			// validate form
			if($this->form_validation->run() != FALSE)
			{
				//save data
				$this->district_model->id = 0;
				$this->district_model->district_name = $title;
				$this->district_model->state_id = $state;
				$this->district_model->created_by = $uid;
				$id = $this->district_model->save();

				//set success msgs 
				$this->session->set_flashdata('msg', 'Success!!!');
				$this->session->set_flashdata('msgbox', 'District with title '. $title.' and ID: '. $id . " added successfully !" );
			}else{
				//get errors
				$errors = $this->form_validation->error_array();

				// save it to show them on form
				$this->session->set_flashdata('err', $errors);
			}

		}

		// redirect finally to the url	
		redirect($url);
		
	}
	
	public function update_district()
	{
		// Give auth wall
		$this->userauth->check_login();


		// Set redirection url
		$url = site_url('dashboard/update_district');

		// fetch post data
		$postdata = $this->input->post();

		//if not empty
		if($postdata && !empty($postdata))
		{
			// fetch data into variables
			$title = $this->input->post('district_title');
			$state = $this->input->post('state');

			$uid = (!empty($this->userid) ? $this->userid : 1);

			// set form rules
			$this->form_validation->set_rules('district_title','District Title', 'required');
			$this->form_validation->set_rules('state','State', 'required');

			// validate form
			if($this->form_validation->run() != FALSE)
			{
				//save data
				$this->district_model->id = $postdata['_id'];
				$this->district_model->district_name = $title;
				$this->district_model->state_id = $state;
				$this->district_model->created_by = $uid;
				$id = $this->district_model->save();

				//set success msgs 
				$this->session->set_flashdata('msg', 'Success!!!');
				$this->session->set_flashdata('msgbox', 'District with title '. $title.' and ID: '. $id . " added successfully !" );
			}else{
				//get errors
				$errors = $this->form_validation->error_array();

				// save it to show them on form
				$this->session->set_flashdata('err', $errors);
			}

		}

		// redirect finally to the url	
		redirect($url);
		
	}
	
	

	function ajax_getdistrictlist()
	{
		
		$state_id = $this->input->post('state_id');
		$statename = $this->state_model->get_statename($state_id); 
		$districts = $this->district_model->get_district_fromstateid($state_id);
		
		$output = "<optgroup label=\"{$statename}\">";

		
		foreach($districts as $district)
		{
			$output .="<option value=\"{$district['id']}\">{$district['district_name']}</option>";
		}
		
		
		$output .= "</optgroup>";

		echo $output;




	}


	// Block routes
	public function add_block()
	{
		// Give auth wall
		$this->userauth->check_login();
		
		// Set redirection url
		$url = site_url('dashboard/add_block');

		// fetch post data
		$postdata = $this->input->post();

		//if not empty
		if($postdata && !empty($postdata))
		{
			// fetch data into variables

			$state = $this->input->post('state');
			$district = $this->input->post('district');
			$title = $this->input->post('block_title');

			$uid = (!empty($this->userid) ? $this->userid : 1);

			// set form rules
			$this->form_validation->set_rules('district','Disrict', 'required');
			$this->form_validation->set_rules('block_title','Block Title', 'required');
			$this->form_validation->set_rules('state','State', 'required');

			// validate form
			if($this->form_validation->run() != FALSE)
			{
				//save data
				$this->block_model->id = 0;
				$this->block_model->block_name = $title;
				$this->block_model->state_id = $state;
				$this->block_model->district_id = $district;
				$this->block_model->created_by = $uid;
				$id = $this->block_model->save();

				//set success msgs 
				$this->session->set_flashdata('msg', 'Success!!!');
				$this->session->set_flashdata('msgbox', 'Block with title '. $title.' and ID: '. $id . " added successfully !" );
			}else{
				//get errors
				$errors = $this->form_validation->error_array();

				// save it to show them on form
				$this->session->set_flashdata('err', $errors);
			}

		}

		// redirect finally to the url	
		redirect($url);
		
		

	}
	
	public function edit_block(){
		
		// Give auth wall
		$this->userauth->check_login();
		
		// Set redirection url
		$url = site_url('dashboard/edit_block');

		// fetch post data
		$postdata = $this->input->post();
		
		//if not empty
		if($postdata && !empty($postdata))
		{
			// fetch data into variables

			$state = $this->input->post('state');
			$district = $this->input->post('district');
			$title = $this->input->post('block_title');

			$uid = (!empty($this->userid) ? $this->userid : 1);

			// set form rules
			$this->form_validation->set_rules('district','Disrict', 'required');
			$this->form_validation->set_rules('block_title','Block Title', 'required');
			$this->form_validation->set_rules('state','State', 'required');

			// validate form
			if($this->form_validation->run() != FALSE)
			{
				//save data
				$this->block_model->id = $postdata['_id'];
				$this->block_model->block_name = $title;
				$this->block_model->state_id = $state;
				$this->block_model->district_id = $district;
				$this->block_model->created_by = $uid;
				$id = $this->block_model->save();

				//set success msgs 
				$this->session->set_flashdata('msg', 'Success!!!');
				$this->session->set_flashdata('msgbox', 'Block with title '. $title.' and ID: '. $id . " added successfully !" );
			}else{
				//get errors
				$errors = $this->form_validation->error_array();

				// save it to show them on form
				$this->session->set_flashdata('err', $errors);
			}

		}

		// redirect finally to the url	
		redirect($url);
		
		
	}

	//Company routes
	public function add_company()
	{
		// Give auth wall
		$this->userauth->check_login();

		// Set redirection url
		$url = site_url('dashboard/add_company');

		// fetch post data
		$postdata = $this->input->post();

		//if not empty
		if($postdata && !empty($postdata))
		{
			// fetch data into variables

			$company_title = $this->input->post('company_title');
			$company_addr = $this->input->post('company_addr');
			

			$uid = (!empty($this->userid) ? $this->userid : 1);

			// set form rules
			$this->form_validation->set_rules('company_title','Company Title', 'required');
			$this->form_validation->set_rules('company_addr','Address', 'required');
			

			// validate form
			if($this->form_validation->run() != FALSE)
			{
				//save data
				$this->company_model->id = 0;
				$this->company_model->company_title = $company_title;
				$this->company_model->company_addr = $company_addr;
				$this->company_model->created_by = $uid;
				$id = $this->company_model->save();

				//set success msgs 
				$this->session->set_flashdata('msg', 'Success!!!');
				$this->session->set_flashdata('msgbox', 'Company with title '. $title.' and ID: '. $id . " added successfully !" );
			}else{
				//get errors
				$errors = $this->form_validation->error_array();

				// save it to show them on form
				$this->session->set_flashdata('err', $errors);
			}

		}

		// redirect finally to the url	
		redirect($url);
		
	}

	public function edit_company()
	{
		// Give auth wall
		$this->userauth->check_login();

		// Set redirection url
		$url = site_url('dashboard/edit_company');

		// fetch post data
		$postdata = $this->input->post();

		//if not empty
		if($postdata && !empty($postdata))
		{
			// fetch data into variables

			$company_title = $this->input->post('company_title');
			$company_addr = $this->input->post('company_addr');
			

			$uid = (!empty($this->userid) ? $this->userid : 1);

			// set form rules
			$this->form_validation->set_rules('company_title','Company Title', 'required');
			$this->form_validation->set_rules('company_addr','Address', 'required');
			

			// validate form
			if($this->form_validation->run() != FALSE)
			{
				//save data
				$this->company_model->id = $postdata['_id'];
				$this->company_model->company_title = $company_title;
				$this->company_model->company_addr = $company_addr;
				$this->company_model->created_by = $uid;
				$id = $this->company_model->save();

				//set success msgs 
				$this->session->set_flashdata('msg', 'Success!!!');
				$this->session->set_flashdata('msgbox', 'Company updated successfully !' );
			}else{
				//get errors
				$errors = $this->form_validation->error_array();

				// save it to show them on form
				$this->session->set_flashdata('err', $errors);
			}

		}

		// redirect finally to the url	
		redirect($url);
		
	}




	//UOM routes
	public function add_uom()
	{
		// Give auth wall
		$this->userauth->check_login();
		
		// Set redirection url
		$url = site_url('dashboard/add_uom');

		// fetch post data
		$postdata = $this->input->post();
		

		//if not empty
		if($postdata && !empty($postdata))
		{
			// fetch data into variables

			$state = $this->input->post('state');
			$uom1 = $this->input->post('uom1');
			$uom1_value = floatval($this->input->post('uom1_value'));
			$uom2 = $this->input->post('uom2');
			$uom2_value = floatval($this->input->post('uom2_value'));

			$uid = (!empty($this->userid) ? $this->userid : 1);

			// set form rules
			$this->form_validation->set_rules('state','State', 'required');
			$this->form_validation->set_rules('uom1','UOM1', 'required');
			$this->form_validation->set_rules('uom1_value','UOM1 Value', 'required|decimal');
			$this->form_validation->set_rules('uom2','UOM2', 'required');
			$this->form_validation->set_rules('uom2_value','UOM2 Value', 'required|decimal');
			
			

			// validate form
			if($this->form_validation->run() != FALSE)
			{
				//save data
				$this->uom_model->id = 0;
				$this->uom_model->state_id = $state;
				$this->uom_model->uom1_text = $uom1;
				$this->uom_model->uom1_value = $uom1_value;
				$this->uom_model->uom2_text = $uom2;
				$this->uom_model->uom2_value = $uom2_value;
				$this->uom_model->created_by = $uid;
				$id = $this->uom_model->save();

				//set success msgs 
				$this->session->set_flashdata('msg', 'Success!!!');
				$this->session->set_flashdata('msgbox', 'UOM  with id '. $id . " added successfully !" );
			}else{
				//get errors
				$errors = $this->form_validation->error_array();

				// save it to show them on form
				$this->session->set_flashdata('err', $errors);
			}

		}

		// redirect finally to the url	
		redirect($url);
	}
	
	// edit uom based data from single template file based on primary key _id
	public function edit_uom()
	{
		// Give auth wall
		$this->userauth->check_login();
		
		// Set redirection url
		$url = site_url('dashboard/edit_uom');

		// fetch post data
		$postdata = $this->input->post();
		
		

		//if not empty
		if($postdata && !empty($postdata))
		{
			// fetch data into variables

			$state = $this->input->post('state');
			$uom1 = $this->input->post('uom1');
			$uom1_value = floatval($this->input->post('uom1_value'));
			$uom2 = $this->input->post('uom2');
			$uom2_value = floatval($this->input->post('uom2_value'));

			$uid = (!empty($this->userid) ? $this->userid : 1);

			// set form rules
			$this->form_validation->set_rules('state','State', 'required');
			$this->form_validation->set_rules('uom1','UOM1', 'required');
			$this->form_validation->set_rules('uom1_value','UOM1 Value', 'required|decimal');
			$this->form_validation->set_rules('uom2','UOM2', 'required');
			$this->form_validation->set_rules('uom2_value','UOM2 Value', 'required|decimal');
			
			

			// validate form
			if($this->form_validation->run() != FALSE)
			{
				//save data
				$this->uom_model->id = $postdata['_id'];
				$this->uom_model->state_id = $state;
				$this->uom_model->uom1_text = $uom1;
				$this->uom_model->uom1_value = $uom1_value;
				$this->uom_model->uom2_text = $uom2;
				$this->uom_model->uom2_value = $uom2_value;
				$this->uom_model->created_by = $uid;
				$id = $this->uom_model->save();

				//set success msgs 
				$this->session->set_flashdata('msg', 'Success!!!');
				$this->session->set_flashdata('msgbox', 'UOM  with id '. $id . " updated successfully !" );
			}else{
				//get errors
				$errors = $this->form_validation->error_array();

				// save it to show them on form
				$this->session->set_flashdata('err', $errors);
			}

		}

		// redirect finally to the url	
		redirect($url);
	}

	// Campaing routes

	public function add_campaign()
	{
		
		// Give auth wall
		$this->userauth->check_login();	
	
	
		// Set redirection url
		$url = site_url('dashboard/add_campaign');

		// fetch post data
		$postdata = $this->input->post();		
				
		$datelist = explode('-',$postdata['date_range']);
				
		$postdata['start_date'] = date('Y-m-d', strtotime($datelist[0]));
		$postdata['end_date'] =  date('Y-m-d', strtotime($datelist[1]));
		$agents = implode(',', $postdata['agents']);
		$postdata['assoc_agents'] = $agents;
		
		//if not empty
		if($postdata && !empty($postdata))
		{
			// fetch data into variables
			
			 $uid = (!empty($this->userid) ? $this->userid : 1);
			 
			 $this->campaign_model->id = 0;
			 $this->campaign_model->survey_id = $postdata['survey_id'];
			 $this->campaign_model->start_date = $postdata['start_date'];
			 $this->campaign_model->end_date = $postdata['end_date'];
			 $this->campaign_model->back_limit = $postdata['back_limit'];
			 $this->campaign_model->agents_assoc = $postdata['assoc_agents'];
			 $this->campaign_model->created_by = $uid;			

			// set form rules
			$this->form_validation->set_rules('survey_id','Survey', 'required');
			$this->form_validation->set_rules('date_range','Date Range', 'required');
			$this->form_validation->set_rules('back_limit','Back Limit', 'required');
						

			// validate form
			if($this->form_validation->run() != FALSE)
			{
				//save data
				$id = $this->campaign_model->save();
				
				if($id){
						//set success msgs 
					$this->session->set_flashdata('msg', 'Success!!!');
					$this->session->set_flashdata('msgbox', 'Campaign  with id '. $id . " added successfully !" );
					
				}else{
					$this->session->set_flashdata('err', "Error adding records !");
				}
				
			}else{
				//get errors
				$errors = $this->form_validation->error_array();

				// save it to show them on form
				$this->session->set_flashdata('err', $errors);
			}

		}

		// redirect finally to the url	
		redirect($url);

	}
	
	
	public function edit_campaign()
	{
		
		// Give auth wall
		$this->userauth->check_login();	
	
	
		// Set redirection url
		$url = site_url('dashboard/edit_campaign');

		// fetch post data
		$postdata = $this->input->post();		
				
		$datelist = explode('-',$postdata['date_range']);
				
		$postdata['start_date'] = date('Y-m-d', strtotime($datelist[0]));
		$postdata['end_date'] =  date('Y-m-d', strtotime($datelist[1]));
		$agents = implode(',', $postdata['agents']);
		$postdata['assoc_agents'] = $agents;
		
		//if not empty
		if($postdata && !empty($postdata))
		{
			// fetch data into variables
			
			 $uid = (!empty($this->userid) ? $this->userid : 1);
			 
			 $this->campaign_model->id = $postdata['_id'];
			 $this->campaign_model->survey_id = $postdata['survey_id'];
			 $this->campaign_model->start_date = $postdata['start_date'];
			 $this->campaign_model->end_date = $postdata['end_date'];
			 $this->campaign_model->back_limit = $postdata['back_limit'];
			 $this->campaign_model->agents_assoc = $postdata['assoc_agents'];
			 $this->campaign_model->created_by = $uid;			

			// set form rules
			$this->form_validation->set_rules('survey_id','Survey', 'required');
			$this->form_validation->set_rules('date_range','Date Range', 'required');
			$this->form_validation->set_rules('back_limit','Back Limit', 'required');
						

			// validate form
			if($this->form_validation->run() != FALSE)
			{
				//save data
				$id = $this->campaign_model->save();
				
				if($id){
						//set success msgs 
					$this->session->set_flashdata('msg', 'Success!!!');
					$this->session->set_flashdata('msgbox', 'Campaign  with id '. $id . " added successfully !" );
					
				}else{
					$this->session->set_flashdata('err', "Error adding records !");
				}
				
			}else{
				//get errors
				$errors = $this->form_validation->error_array();

				// save it to show them on form
				$this->session->set_flashdata('err', $errors);
			}

		}

		// redirect finally to the url	
		redirect($url);

	}
	
	public function add_survey()
	{
		/*// Give auth wall
		$this->userauth->check_login();	
		echo('<pre>');
		print_r($_POST);
		echo('</pre>');*/
		
		
		
		
		// Give auth wall
		$this->userauth->check_login();	
	
	
		// Set redirection url
		$url = site_url('dashboard/add_survey');

		// fetch post data
		$postdata = $this->input->post();				
				
				
		//if not empty
		if($postdata && !empty($postdata))
		{
			// fetch data into variables
			
			 $uid = (!empty($this->userid) ? $this->userid : 1);
			 
			 $this->survey_model->id = 0;
			 $this->survey_model->title = $postdata['title'];
			 $this->survey_model->description = $postdata['description'];
			 $this->survey_model->keywords = $postdata['keywords'];
			 $this->survey_model->created_by = $uid;			

			// set form rules
			$this->form_validation->set_rules('title','Survey', 'required');
			$this->form_validation->set_rules('description','Description', 'required');
			$this->form_validation->set_rules('keywords','Keywords', 'required');
						

			// validate form
			if($this->form_validation->run() != FALSE)
			{
				//save data
				$id = $this->survey_model->save();
				
				if($id){
						//set success msgs 
					$this->session->set_flashdata('msg', 'Success!!!');
					$this->session->set_flashdata('msgbox', 'Survey  with id '. $id . " added successfully !" );
					
				}else{
					$this->session->set_flashdata('err', "Error adding records !");
				}
				
			}else{
				//get errors
				$errors = $this->form_validation->error_array();

				// save it to show them on form
				$this->session->set_flashdata('err', $errors);
			}

		}

		// redirect finally to the url	
		redirect($url);

	}
	
	public function edit_survey()
	{
		
		
		
		// Give auth wall
		$this->userauth->check_login();	
	
	
		// Set redirection url
		$url = site_url('dashboard/edit_survey');

		// fetch post data
		$postdata = $this->input->post();				
				
				
		//if not empty
		if($postdata && !empty($postdata))
		{
			// fetch data into variables
			
			 $uid = (!empty($this->userid) ? $this->userid : 1);
			 
			 $this->survey_model->id = $postdata['_id'];
			 $this->survey_model->title = $postdata['title'];
			 $this->survey_model->description = $postdata['description'];
			 $this->survey_model->keywords = $postdata['keywords'];
			 $this->survey_model->created_by = $uid;			

			// set form rules
			$this->form_validation->set_rules('title','Survey', 'required');
			$this->form_validation->set_rules('description','Description', 'required');
			$this->form_validation->set_rules('keywords','Keywords', 'required');
						

			// validate form
			if($this->form_validation->run() != FALSE)
			{
				//save data
				$id = $this->survey_model->save();
				
				if($id){
						//set success msgs 
					$this->session->set_flashdata('msg', 'Success!!!');
					$this->session->set_flashdata('msgbox', 'Survey  with id '. $id . " updated successfully !" );
					
				}else{
					$this->session->set_flashdata('err', "Error adding records !");
				}
				
			}else{
				//get errors
				$errors = $this->form_validation->error_array();

				// save it to show them on form
				$this->session->set_flashdata('err', $errors);
			}

		}

		// redirect finally to the url	
		redirect($url);
		
	}

	

	function printPages($pages){
		foreach ($pages['pages'] as $key => $page) {

			print(PHP_EOL."Page no: ".$page['number'].PHP_EOL);
			print("Name: ".$page['name'].PHP_EOL);
			print("Desc: ".$page['description'].PHP_EOL);
			$nextpage = array_key_exists('nextPage', $page['pageFlow']) ? $page['pageFlow']['nextPage'] : $page['pageFlow']['page']['number'];
			print("Next Page: ".$nextpage.PHP_EOL);
			print("=====================================================".PHP_EOL);
			foreach($page['elements'] as $index => $questions ){
				print("Question: ".$questions['question']['text'].PHP_EOL);
				if(array_key_exists('offeredAnswers', $questions['question'])){
					foreach($questions['question']['offeredAnswers'] as $key => $answers){
						print("     ==================".PHP_EOL);
						print("                 ".$answers['value'].PHP_EOL);
					}

				}
			}

		}
	}

	function savePages($pages){
		$pageData = [];

		foreach ($pages['pages'] as $key => $page) {
			$pageData['id'] = $page['id'];
			$pageData['number'] = $page['number'];
			$pageData['name'] =$page['name'];
			$pageData['description'] = $page['description'];
			$pageData['page_flow_id'] = array_key_exists('page', $page['pageFlow']) ? $page['pageFlow']['page']['id'] : 0;
			$pageData['page_flow_number'] = array_key_exists('page', $page['pageFlow']) ? $page['pageFlow']['page']['number'] : 0;
			$pageData['survey_id'] = 786;

			
			$query = $this->db->replace('tblsurvey_pages', $pageData);
			print("Rows added: ".$this->db->affected_rows());

			

		}
	}

	function survey_post(){
		$data = file_get_contents('php://input');
		$pages = json_decode($data, true);
		
		$this->savePages($pages);

		
	}

}