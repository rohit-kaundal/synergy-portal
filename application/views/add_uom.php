<!-- add role //-->
<div class="panel panel-primary panel-shadow">
	<div class="panel-heading">
		<div class="panel-title">
			<h3><i class="entypo-pencil"></i>Add UOM</h3>
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
				<form id="add-uom-form" method="post" action="<?= site_url('bl/add_uom')?>" class="validate" role="form" class="form-horizontal">

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
											<?php endforeach;?>
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
											<option  value="Acre">Acre</option>
	                                        <option  value="Bigha">Bigha</option>
	                                        <option  value="Kanal">Kanal</option>
	                                        <option  value="Killa">Killa</option>
	                                        <option  value="Meter">Meter</option>
	                                        <option  value="Hectare">Hectare</option>
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
									<input name="uom1_value" id="uom1_value" class="form-control" data-validate="required" data-mask="fdecimal" placeholder="Enter value here..." />
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
											<option  value="Acre">Acre</option>
	                                        <option  value="Bigha">Bigha</option>
	                                        <option  value="Kanal">Kanal</option>
	                                        <option  value="Killa">Killa</option>
	                                        <option  value="Meter">Meter</option>
	                                        <option  value="Hectare">Hectare</option>
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
									<input name="uom2_value" id="uom2_value" class="form-control" data-validate="required" data-mask="fdecimal" placeholder="Enter value here..." />
								</div>
								</div>		
							</div>
						</div>

							
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Save UOM</button>
							</div>
						
						
				</form>
			
		</div>
	</div>	
</div>