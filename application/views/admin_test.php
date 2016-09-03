<?php

	echo '<pre>';
		$id = 1;
		$singleSurvey = $this->survey_model->get_survey($id);
		print_r($singleSurvey);
	echo '</pre>';
	
	
	
	
