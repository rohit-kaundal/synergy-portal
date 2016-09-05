<?php

	echo '<pre>';
		
		/**
		* 
		* Model tests
		* 
		*/
		$q = new Question_model();
		$q->question = "Replaced Question 5 - Test";
		$q->question_type = "matrix";
		$q->survey_id = 5;
		$q->isoptional = 'n';
		$q->created_by = $_SESSION['user_id'];
		
		// test crud
		$q->save();
		$q->id = 5;
		$q->save();
		
		// get data test
		$question = $this->question_model->get_question(5);
		$questions = $this->question_model->get_questions();
		
		echo "<br/>========= Single Question =======<br/>";
		print_r($question);
		
		echo "<br/>============ Table of Questions ============================<br/>";
		print_r($questions);
		
		
		
		
	echo '</pre>';
	
	
	
	
