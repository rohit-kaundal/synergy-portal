<?php
	$survey = $this->survey_model->get_survey($id);
	if(empty($survey)){
		redirect(site_url('dashboard/edit_survey'));
	}
	
	print_r($survey);	
?>