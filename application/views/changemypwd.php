<?php
	
	$details = $this->userlogin_model->getobject_fromid($id);
	$mobile = $this->userdetails_model->getmobileno($id);
	//$mobile = $_SESSION['user_details']['mobile'];
	$mobile = $mobile['mobile'];
	
	if(empty($details) || $details == null || empty($mobile)){
		redirect(site_url('dashboard/edit_user'));
	}
	
	$ccode = substr($mobile,0,2);
	$number = substr($mobile, 2, 10);
	$request = [
				 'countryCode' => $ccode,
				 'mobileNumber' => $number
				];
	
	//print_r($request);
	$resp = $this->otpapi->generateOTP($request);
	
	
?>
<div class="panel panel-primary panel-shadow">
	<div class="panel-heading">
		<div class="panel-title">
			<h3><i class="entypo-key"></i>Change password</h3>
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
		<div class="tab-content">
				<form id="add-uom-form" method="post" action="<?= site_url('bl/changemypwd')?>" class="validate" role="form" class="form-horizontal">
				<input type="hidden" name="_id" id="_id" value="<?= $details->id ?>"/>

						
							

						<div class="row">
							
							<div class="col-sm-6">
								<div class="form-group">
								
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-key"></i>
									</div>
									<input name="password" id="password" class="form-control" data-validate="required" placeholder="Enter new password here..." type="password" />
								</div>
								</div>		
							</div>
						</div>
						
						<div class="row">
							
							<div class="col-sm-6">
								<div class="form-group">
								
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-mobile"></i>
									</div>
									<input name="otp" id="otp" class="form-control" data-validate="required" placeholder="Enter OTP here..." />
								</div>
								</div>		
							</div>
						</div>
						

							
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Change password</button>
							</div>
						
						
				</form>
			
		</div>
	</div>	
</div>
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
		
			toastr.success("OTP sent to your registered mobile number !", "OTP Verification", opts);
		});
			
		</script>