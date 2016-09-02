<!-- add role //-->
<div class="panel panel-primary panel-shadow">
	<div class="panel-heading">
		<div class="panel-title">
			<h3><i class="entypo-flow-tree"></i>Add Campaign</h3>
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
				<form id="add-campaign-form" method="post" action="<?= site_url('Bl/add_campaign')?>" class="validate" role="form" class="form-horizontal">

						<div class="form-group">
								<label class="control-label" for="survey_id">Survey</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-map"></i>
									</div>
									<select name="survey_id" class="select2" data-allow-clear="true" data-placeholder="Select survey..." id="survey_id" data-validate="required">
										<option></option>
										<optgroup label="Survey List">									
										<?php
										// TODO
										// get survey list
										$surveys = $this->survey_model->get_record_list();
										foreach($surveys as $row=>$survey):
										?>
										
											<option value="<?= $survey['id'] ?>"><?= $survey['title']?></option>
										<?php endforeach; ?>			
										</optgroup>
									</select>
								</div>
							</div>
							<div class="row">
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label" for="back_limit">Back Limit</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="entypo-pencil"></i>
											</div>
											<input name="back_limit" id="back_limit" class="form-control" data-validate="required" data-mask="decimal" placeholder="Enter value here..." />
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label class="control-label" for="date_range">Date Range</label>
										<div class="input-group">
											<div class="input-group-addon">
												<i class="entypo-calendar"></i>
											</div>
											<input type="text" class="form-control daterange" data-validate="required" name="date_range" id="date_range" />
										</div>
									</div>
								</div>
								
							</div>



							
							
							<div class="form-group">
									<label class="control-label" for="assoc_agents">Assoicated Agents</label>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="entypo-users"></i>
										</div>
										<select multiple="multiple" name="agents[]" class="form-control multi-select">
										<?php $agentlist = $this->userdetails_model->get_alldata();
											if(!empty($agentlist)):
										?>
											<?php foreach($agentlist as $agent):?>
											<option value="<?= $agent['userid'] ?>"><?= $agent['fullname'] ?></option>
											
											<?php endforeach; ?>
										<?php endif; ?>
										</select>
									</div>
							</div>
												
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Save Campaign</button>
							</div>
						
						
				</form>
			
		</div>
	</div>	
</div>