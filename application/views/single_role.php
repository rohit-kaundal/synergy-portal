<?php
	$data = $this->userrole_model->get_role_byid($id);
	if(empty($data)){
		redirect(site_url('dashboard/edit_role'), 'refresh');
	}
?>
<div class="panel panel-primary panel-shadow">
	<div class="panel-heading">
		<div class="panel-title">
			<h3><i class="entypo-key"></i>Edit Role</h3>
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
				<form id="add-role-form" method="post" action="<?= site_url('bl/edit_role')?>" class="validate" role="form" class="form-horizontal">
				<input type="hidden" name="_id" id="_id" value="<?= $data['role_id'] ?>"/>
						
							<div class="form-group">
								<label class="control-label" for="role_title">Role Title</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-lock"></i>
									</div>
									<input name="role_title" id="role_title" class="form-control" data-validate="required"  placeholder="Enter role title here..." value="<?= $data['role_title'] ?>" />
								</div>
							</div>
							<div class="form-group">
								<label class="control-label" for="role_description">Role Description</label>
								
									<textarea name="role_description" class="form-control autogrow" id="role_description" placeholder="Enter about role here..."><?= $data['role_desc'] ?></textarea>
								
							</div>
							
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Save role</button>
							</div>
						
						
				</form>
			
		</div>
	</div>	
</div>