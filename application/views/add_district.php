<?php
	
	$statelist = $this->state_model->get_state_list();
	
?>
<!-- add role //-->
<div class="panel panel-primary panel-shadow">
	<div class="panel-heading">
		<div class="panel-title">
			<h3><i class="entypo-location"></i>Add District</h3>
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
				<form id="add-district-form" method="post" action="<?=site_url('Bl/add_district')?>" class="validate" role="form" class="form-horizontal">
							
							<div class="form-group">
								<label class="control-label" for="role_title">State</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-map"></i>
									</div>
									<select name="state" class="select2" data-allow-clear="true" data-placeholder="Select State" id="state">
										<option></option>
										<optgroup label="India">
										<?php foreach ($statelist as $state):?>
											
											<option value="<?= $state['id']?>"><?= $state['State']?></option>
											
											
											
											
										<?php endforeach; ?>
										</optgroup>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label" for="district_title">District Title</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-location"></i>
									</div>
									<input name="district_title" id="district_title" class="form-control" data-validate="required" />
								</div>
							</div>
							
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Save district</button>
							</div>
						
						
				</form>
			
		</div>
	</div>	
</div>