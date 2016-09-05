<?php
	$survey = $this->survey_model->get_survey($id);
	
	if(empty($survey)){
		redirect(site_url('dashboard/edit_survey'));
	}
	
	
?>
<div class="panel panel-primary panel-shadow">
	<div class="panel-heading">
		<div class="panel-title">
			<h3><i class="entypo-pencil"></i>Add Questions to <span class="green"><?= $survey->title ?></span></h3>
		</div>
		
	</div>

	<div class="panel-body">
	
				
		<div class="tab-content">
			<div class="row">
				<div class="col"><p><?= $survey->description;?></p></div>
			</div>
			
		</div>
	</div>
</div>
	
