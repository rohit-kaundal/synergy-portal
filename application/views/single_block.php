<?php
	$details = $this->block_model->get_record_listbyid($id);
	if(empty($details)){
		redirect(site_url('dashboard/edit_block'));
	}
?>
<div class="panel panel-primary panel-shadow">
	<div class="panel-heading">
		<div class="panel-title">
			<h3><i class="entypo-location"></i>Edit Block</h3>
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
				<form id="add-block-form" method="post" action="<?=site_url('Bl/edit_block')?>" class="validate" role="form" class="form-horizontal">
				<input type="hidden" name="_id" id="_id" value="<?=$details['id']?>"/>
							
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
											<option value="<?=$state['id']?>" <?= $state['id'] == $details['state_id'] ?'selected' : '' ?> ><?=$state['State']?></option>
										<?php endforeach;?>
										</optgroup>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label" for="district">District</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-map"></i>
									</div>
									<select name="district" class="select2" data-allow-clear="true" data-placeholder="Select District" id="district">
										<option value="<?=$details['district_id']?>"><?=$details['district_name']?></option>
										
										
									</select>
								</div>
							</div>
							<script type="text/javascript" charset="utf-8">
					            jQuery(function(){
					            	jQuery('#state').change(function(){
					            		jQuery.post("<?=site_url('Bl/ajax_getdistrictlist')?>",{state_id: jQuery('#state').val()}, function(data){
					            			
					            			jQuery('#district').html(data);
					            		});
					            	});
					            });
       					 	</script>



							<div class="form-group">
								<label class="control-label" for="district_title">Block Title</label>
								<div class="input-group">
									<div class="input-group-addon">
										<i class="entypo-location"></i>
									</div>
									<input name="block_title" id="block_title" class="form-control" data-validate="required" value="<?=$details['block_name']?>" />
								</div>
							</div>
							
							<div class="form-group">
								<button type="submit" class="btn btn-primary">Save block</button>
							</div>
						
						
				</form>
			
		</div>
	</div>	
</div>