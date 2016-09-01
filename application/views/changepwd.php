<?php
	$details = $this->userlogin_model->getobject_fromid($id);
	if(empty($details) || $details == null){
		redirect(site_url('dashboard/edit_user'));
	}
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
				<form id="add-uom-form" method="post" action="<?= site_url('bl/changepwd')?>" class="validate" role="form" class="form-horizontal">
				<input type="hidden" name="_id" id="_id" value="<?= $details->id ?>"/>

						
							

						<div class="row">
							
							<div class="col-sm-6">
								<div class="form-group">
								
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-key"></i>
									</div>
									<input name="password" id="password" class="form-control" data-validate="required" placeholder="Enter password here..." type="password" />
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