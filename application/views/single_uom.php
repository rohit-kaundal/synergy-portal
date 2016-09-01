<?php
	$results = $this->uom_model->get_record_list_byid($id);
	if(empty($results)){
		redirect(site_url('dashboard/edit_uom'), 'refresh');
	}
?>
<div class="panel panel-primary panel-shadow">
	<div class="panel-heading">
		<div class="panel-title">
			<h3><i class="entypo-pencil"></i>Edit UOM</h3>
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
				<form id="add-uom-form" method="post" action="<?= site_url('bl/edit_uom')?>" class="validate" role="form" class="form-horizontal">
<input type="hidden" name="_id" id="_id" value="<?= $results['id'] ?>"/> 
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
											<option value="<?=$state['id']?>" <?= ($results['state_id'] == $state['id'] ? 'selected' : '') ?>><?=$state['State']?></option>
											<?php endforeach;?>
											</optgroup>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
								<div class="form-group">
								<label class="control-label" for="uom1">UOM1</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-thermometer"></i>
									</div>
									<select name="uom1" class="select2" data-allow-clear="true" data-placeholder="Select UOM1" id="uom1">
										<option></option>
										<optgroup label="UOM Values">
											<option  value="Acre" <?= !strcmp(trim(strtolower($results['uom1_text'])), 'acre') ? 'selected' : '' ?>>Acre</option>
	                                        <option  value="Bigha" <?= !strcmp(trim(strtolower($results['uom1_text'])), 'bigha') ? 'selected' : '' ?>>Bigha</option>
	                                        <option  value="Kanal" <?= !strcmp(trim(strtolower($results['uom1_text'])), 'kanal') ? 'selected' : '' ?>>Kanal</option>
	                                        <option  value="Killa" <?= !strcmp(trim(strtolower($results['uom1_text'])), 'killa') ? 'selected' : '' ?>>Killa</option>
	                                        <option  value="Meter" <?= !strcmp(trim(strtolower($results['uom1_text'])), 'meter') ? 'selected' : '' ?>>Meter</option>
	                                        <option  value="Hectare" <?= !strcmp(trim(strtolower($results['uom1_text'])), 'hectare') ? 'selected' : '' ?>>Hectare</option>
										</optgroup>
									</select>
								</div>
							</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
								<label class="control-label" for="uom1_value">UOM1 Value</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-infinity"></i>
									</div>
									<input name="uom1_value" id="uom1_value" class="form-control" data-validate="required" data-mask="fdecimal" placeholder="Enter value here..." value="<?= $results['uom1_value'] ?>" />
								</div>
							</div>
							</div>
						</div>

						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
								<label class="control-label" for="uom2">UOM2</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-thermometer"></i>
									</div>
									<select name="uom2" class="select2" data-allow-clear="true" data-placeholder="Select UOM2" id="uom2">
										<option></option>
										<optgroup label="UOM Values">
											<option  value="Acre" <?= !strcmp(trim(strtolower($results['uom2_text'])), 'acre') ? 'selected' : '' ?>>Acre</option>
	                                        <option  value="Bigha" <?= !strcmp(trim(strtolower($results['uom2_text'])), 'bigha') ? 'selected' : '' ?>>Bigha</option>
	                                        <option  value="Kanal" <?= !strcmp(trim(strtolower($results['uom2_text'])), 'kanal') ? 'selected' : '' ?>>Kanal</option>
	                                        <option  value="Killa" <?= !strcmp(trim(strtolower($results['uom2_text'])), 'killa') ? 'selected' : '' ?>>Killa</option>
	                                        <option  value="Meter" <?= !strcmp(trim(strtolower($results['uom2_text'])), 'meter') ? 'selected' : '' ?>>Meter</option>
	                                        <option  value="Hectare" <?= !strcmp(trim(strtolower($results['uom2_text'])), 'hectare') ? 'selected' : '' ?>>Hectare</option>
										</optgroup>
									</select>
								</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
								<label class="control-label" for="uom1_value">UOM2 Value</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-infinity"></i>
									</div>
									<input name="uom2_value" id="uom2_value" class="form-control" data-validate="required" data-mask="fdecimal" placeholder="Enter value here..." value="<?= $results['uom2_value'] ?>" />
								</div>
								</div>		
							</div>
						</div>

							<div class="row">
								<div class="form-group">
									<button type="submit" class="btn btn-primary">Save UOM</button>
								</div>
							</div>
							
						
						
				</form>
			
		</div>
	</div>	
</div>