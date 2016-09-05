<?php

	echo '<pre>';
		
		/**
		* 
		* Model tests
		* 
		*/
		$q = new Answer_model();
		
		$q->answer = 'Sexy';
		$q->answerkey = 'VI';
		$q->answernumerickey = 6;
		$q->redirectquestionid = 3;
		$q->questionid = 1;
		$q->created_by = $_SESSION['user_id'];
		
		// Create test with 5 records
		
		$q->save();
		
		$q->id = 0;
		$q->save();
		
		$q->questionid = 2;
		$q->id = 0;
		$q->save();
		
		$q->id = 0;
		$q->save();
		
		$q->id = 0;
		$q->questionid = 3;
		$q->save();
		
		echo "<br/>";
		echo "============== Create test ==================";
		echo "<br/>";
		print_r($q->get_answers());	
		
		// Replace test 3rd record
		$q->answer = "Replaced Answer";
		$q->id = 3;
		$q->save();
		
		echo "<br/>";
		echo "============== Update test ==================";
		echo "<br/>";
		print_r($q->get_answers());
		
		// Delete test 4rd record
		$q->id = 3;
		$q->delete();
		echo "<br/>";
		echo "============== Delete test ==================";
		echo "<br/>";
		print_r($q->get_answers());
		
		// Get answer with id 3
		echo "<br/>";
		echo "============== Single answer test ==================";
		echo "<br/>";
		print_r($q->get_answer(1));
		
		// Get answers fof questions
		$q->id = 3;
		$q->delete();
		echo "<br/>";
		echo "============== Answer of question test ==================";
		echo "<br/>";
		print_r($q->get_answers_toquestion(1));
		
		
		
		
	echo '</pre>';
	
	
	
	
