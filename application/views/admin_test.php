<?php

	echo '<pre>';
	
	$agentid = 5; // Rohit
	
	$survey_id = 1;
	
	$surveydetails;
	$questions;
	$answers;
	
	$qas; // final form
	
	$query = $this->db->query('select * from tblcampaign
left join tblsurvey on tblcampaign.survey_id = tblsurvey.id
where tblcampaign.survey_id = ?', $survey_id);
	if($query){
		$surveydetails = $query->result_array();
	}
	
	$query = $this->db->query('SELECT * FROM tblquestions where survey_id = ?', $survey_id);
	if($query){
		$questions = $query->result_array();	
	}
	
	$query = $this->db->query('SELECT tblanswers.*, tblquestions.survey_id  FROM  tblanswers
left join tblquestions on tblanswers.questionid = tblquestions.id
where tblquestions.survey_id = ?', $survey_id);
	if($query){
		$answers = $query->result_array();
	}
	
	
		
	
	
	foreach($surveydetails as $key => $s){
		$qas['survey'][$s['survey_id']] = $s;
		foreach($questions as $key2 => $q ){
			if($q['survey_id'] === $s['survey_id']){
				$qas['survey'][$s['survey_id']]['questions'][$q['id']] = $q;
			}
			foreach($answers as $key3 => $a){
				if($a['questionid'] === $q['id']){
					$qas['survey'][$s['survey_id']]['questions'][$q['id']]['answers'][] = $a;					
				}
			}
		}
	}
	
	
	
	print_r($qas);
	
	
	
	
	
	
		
	echo '</pre>';
	
	
	

	