

<div class="panel panel-primary">
	<div class="panel-heading">
	<div class="panel-title"><h3><i class="entypo-user-add"></i> Add user</h3>
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
		
		<form id="add-user-form" method="post" action="<?= site_url('Bl/add_user')?>" class="form-wizard validate">
			
			<div class="steps-progress">
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
			
			<div class="tab-content">
				<div class="tab-pane active" id="tab2-1">
					
					<strong>Login detais</strong>
					<br/>
					<br/>

					<div class="row">
						<div class="col-md-6">

							<div class="form-group">
								<label class="control-label">Choose Username / Email</label>
								
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-user"></i>
									</div>
									
									<input type="text" class="form-control" name="username" id="username" data-validate="required,minlength[5]" data-message-minlength="Username must have minimum of 5 chars." placeholder="Could also be your email" />
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
												<option value="<?= $role['role_id']?>"><?=$role['role_title']?></option>
											<?php endforeach; ?>
											
										</optgroup>
									</select>
								</div>
								
							</div>
						</div>
					</div>


					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Choose Password</label>
								
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-key"></i>
									</div>
									
									<input type="password" class="form-control" name="password" id="password" data-validate="required" placeholder="Enter strong password" />
								</div>
							</div>
						</div>
						
						<div class="col-md-6">						
							<div class="form-group">
								<label class="control-label">Repeat Password</label>
								
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-cw"></i>
									</div>
									
									<input type="password" class="form-control" name="password" id="password" data-validate="required,equalTo[#password]" data-message-equal-to="Passwords doesn't match." placeholder="Confirm password" />
								</div>
							</div>
						</div>
						
					</div>

				</div>
				
				<div class="tab-pane" id="tab2-2">
					
					<div class="row">
						<strong>Personal info</strong>
						<br/>
						<br/>
						
							<div class="form-group">
								<label class="control-label" for="full_name">Full Name</label>

								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-user"></i>
									</div>
							
									<input class="form-control" name="full_name" id="full_name" data-validate="require" placeholder="Enter your full name"/>
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
									    <input type="checkbox" checked name="gender" id="gender">
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
									<input class="form-control datepicker" name="dob" id="dob" placeholder="(Optional)" />
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
								
										<input class="form-control" name="mobile" id="mobile"  placeholder="Enter your mobile (91-99999-99999)" data-mask="99-99999-99999" data-validate="require"/>
									</div>
									
									
									
							</div>
						</div>

					</div>

					<div class="row">
						<strong>Address</strong>
						<br/>
						<div class="col-md-4">
							<div class="form-group">
									<label class="control-label" for="address">Address</label>

									<div class="input-group">
										<div class="input-group-addon">
											<i class="entypo-location"></i>
										</div>
								
										<input class="form-control" name="address" id="address"  placeholder="Enter your address"/>
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
												<option value="<?= $city_id ?>"><?=$city_name?></option>
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
											<option value="<?=$state['id']?>"><?=$state['State']?></option>
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
								
										<input class="form-control" name="pincode" id="pincode"  placeholder="Pincode" data-mask="999999"/>
									</div>
									
									
									
							</div>
						</div>

					</div>
					<div class="row">
						<div class="form-group">
						<div class="checkbox checkbox-replace">
							<input type="checkbox" name="chk-rules" id="chk-rules" data-validate="required" data-message-message="You must accept rules in order to complete this registration.">
							<label for="chk-rules">By registering I accept terms and conditions.</label>
						</div>
					</div>
					
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Save | Finish Registration</button>
					</div>
					</div>
				</div>
						
				<ul class="pager wizard">
					<li class="previous">
						<a href="#"><i class="entypo-left-open"></i> Previous</a>
					</li>
					
					<li class="next">
						<a href="#">Next <i class="entypo-right-open"></i></a>
					</li>
				</ul>
			</div>
		
		</form>
	</div>
</div>