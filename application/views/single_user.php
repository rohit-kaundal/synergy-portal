<?php
	$userdetails = $this->userdetails_model->get_all_details_ofid($id);
	if(empty($userdetails)){
		redirect(site_url('dashboard/edit_user'));
	}
	
?>

<div class="panel panel-primary">
	<div class="panel-heading">
	<div class="panel-title"><h3><i class="entypo-user-add"></i> Update user</h3>
	</div>
	</div>
	<div class="panel-body">		
		
		<?php
		// if validation errors
		$err = $this->session->flashdata('err');
		if($err){
			foreach( $err as $er){
		
		?>
		<div class="row">
			<div class="alert alert-danger"><?= $er?></div>
		</div>
		<?php
			}
			}
			// check for success msg and print it
			$msg = $this->session->flashdata('msg');
			if($msg){
				echo '<div class="row">';
				echo '<div class="alert alert-success"><strong>Well done!</strong> '.$msg.'</div>';
				echo '</div>';
			}

			// check for msgbox msg and output the javascript accordingly
			$msgbox = $this->session->flashdata('msgbox');
			if($msgbox):
		?>
		<script type="text/javascript">
		jQuery(document).ready(function($){
			var opts = {
			"closeButton": true,
			"debug": false,
			"positionClass": "toast-bottom-left",
			"onclick": null,
			"showDuration": "300",
			"hideDuration": "1000",
			"timeOut": "5000",
			"extendedTimeOut": "1000",
			"showEasing": "swing",
			"hideEasing": "linear",
			"showMethod": "fadeIn",
			"hideMethod": "fadeOut"
			};
		
			toastr.success("<?= $msgbox ?>", "Success", opts);
		});
			
		</script>
		<?php endif; ?>
		
		<form id="add-user-form" method="post" action="<?= site_url('Bl/edit_user')?>" class="form-wizard validate">
			<input type="hidden" id="_id" name="_id" value="<?= $userdetails['_id'] ?>"/>
			<input  type="hidden" id="userid" name="userid" value="<?= $userdetails['userid'] ?>"/>
			<input type="hidden" class="form-control" name="password" id="password" data-validate="required" placeholder="Enter strong password" value="<?= $userdetails['user_password'] ?>"/>
			<!--<div class="steps-progress">
				<div class="progress-indicator"></div>
			</div>
			
			<ul>
				<li class="active">
					<a href="#tab2-1" data-toggle="tab"><span>1</span>Login info</a>
				</li>
				<li>
					<a href="#tab2-2" data-toggle="tab"><span>2</span>Personal Info</a>
				</li>
								
			</ul>
			//-->
			
			<div class="">
				<div class="tab-pane active" id="">
					
					
					<div class="row">
						<div class="col-md-6">

							<div class="form-group">
								<label class="control-label">Choose Username / Email</label>
								
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-user"></i>
									</div>
									
									<input type="text" class="form-control" name="username" id="username" data-validate="required,minlength[5]" data-message-minlength="Username must have minimum of 5 chars." placeholder="Could also be your email" value="<?= $userdetails['user_email'] ?>" disabled="true" />
								</div>
							</div>

						</div>

						<div class="col-mod-6">
							<div class="form-group">
								<label class="control-label" for="role">Role</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-lock"></i>
									</div>
									<select name="role" class="select2" data-allow-clear="true" data-placeholder="Select Role" id="role" data-validate="required">
										
										<optgroup label="User Role">
											<?php
												$roles = $this->userrole_model->get_roles();
												foreach($roles as $role):
											?>
												<option value="<?= $role['role_id']?>" <?= $userdetails['user_roleid'] == $role['role_id'] ? 'selected':'' ?>    ><?=$role['role_title']?></option>
											<?php endforeach; ?>
											
										</optgroup>
									</select>
								</div>
								
							</div>
						</div>
					</div>


					

				</div>
				
				<div class="" id="">
					<hr />
					<div class="row">
						
						<div class="col-md-12">
							<div class="form-group">
								<label class="control-label" for="full_name">Full Name</label>

								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-user"></i>
									</div>
							
									<input class="form-control" name="full_name" id="full_name" data-validate="require" placeholder="Enter your full name" value="<?= $userdetails['fullname'] ?>"/>
								</div>
								
								
								
							</div>
						</div>
						

						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="gender">Gender</label>
								<br/>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-google-circles"></i>
									</div>
									<div class="make-switch switch-small" data-on-label="Male" data-off-label="Female">
									    <input type="checkbox" name="gender" id="gender" <?= $userdetails['gender'] == 'M' ? 'checked' : '' ?>>
									</div>
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="gender">DOB</label>
								<div class="input-group">

									<div class="input-group-addon">
										<i class="entypo-clock"></i>
									</div>
									<input class="form-control datepicker" name="dob" id="dob" placeholder="(Optional)" value="<?= date('m/d/Y', strtotime($userdetails['dob'])) ?>" />
								</div>
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
									<label class="control-label" for="mobile">Mobile</label>

									<div class="input-group">
										<div class="input-group-addon">
											<i class="entypo-location"></i>
										</div>
								
										<input class="form-control" name="mobile" id="mobile"  placeholder="Enter your mobile (91-99999-99999)" data-mask="99-99999-99999" data-validate="require" value="<?= $userdetails['mobile'] ?>"/>
									</div>
									
									
									
							</div>
						</div>

					</div>

					<div class="row">
						
						<div class="col-md-4">
							<div class="form-group">
									<label class="control-label" for="address">Address</label>

									<div class="input-group">
										<div class="input-group-addon">
											<i class="entypo-location"></i>
										</div>
								
										<input class="form-control" name="address" id="address"  placeholder="Enter your address" value="<?= $userdetails['address'] ?>"/>
									</div>
									
									
									
							</div>
						</div>
						
						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="city">City</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-map"></i>
									</div>
									<select name="city" class="select2" data-allow-clear="true" data-placeholder="Select one city..." id="city">
										<option></option>
										<?php
											$cities = $this->city_model->get_allcitystate();
											foreach($cities as $state => $city ){
												
											
										?>
										<optgroup label="<?= $state?>">
											<?php
												foreach($city as $city_id => $city_name):
											?>
												<option value="<?= $city_id ?>"  <?= $userdetails['cityid']==$city_id?'selected':'' ?> ><?=$city_name?></option>
											<?php endforeach;?>
											
										</optgroup>
										<?php
											
										  }
										?>
									</select>
								</div>
								<!--
								<script type="text/javascript">
									jQuery(function(){
										jQuery('#city').change(function(){
											jQuery('#state').val(jQuery('#city').val());
										});
									});
								</script>
								//-->
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label class="control-label" for="state">State</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-map"></i>
									</div>
									<select name="state" class="select2" data-allow-clear="true" data-placeholder="Select State" id="state">
										<option></option>
										<optgroup label="India">
										<?php
											$state_list = $this->state_model->get_state_list();
											foreach($state_list as $state):
										?>
											<option value="<?=$state['id']?>"  <?= $userdetails['stateid']==$state['id']?'selected':'' ?>><?=$state['State']?></option>
										<?php endforeach; ?>
										</optgroup>
									</select>
								</div>
								
							</div>
						</div>

						<div class="col-md-4">
							<div class="form-group">
									<label class="control-label" for="pincode">Pincode</label>

									<div class="input-group">
										<div class="input-group-addon">
											<i class="entypo-location"></i>
										</div>
								
										<input class="form-control" name="pincode" id="pincode"  placeholder="Pincode" data-mask="999999" value="<?= $userdetails['pincode'] ?>"/>
									</div>
									
									
									
							</div>
						</div>

					</div>
					<div class="row">
						
						
						<div class="col-md-12">
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Update details</button>
							</div>
						</div>
					
						
					</div>
				</div>
						
				
			</div>
		
		</form>
	</div>
</div>