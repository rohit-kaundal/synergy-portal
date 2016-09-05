<?php

	echo '<pre>';
	
	
		
		
		/**
		* 
		* Model tests
		* 
		*/
		
		print "<br/>====================Create test================<br/>";
		for($id = 1; $id <= 5; $id++){
			$this->vote_model->id = 0;
			$this->vote_model->questionid = $id;
			$this->vote_model->answerid = $id * 3;
			$this->vote_model->respondantind = $id * 5;
			$this->vote_model->surveyid = $id * $id;
			$this->vote_model->save();
		}
		print_r($this->vote_model->get_votes());
		
		print "<br/>====================Update test================<br/>";
			$this->vote_model->id = 3;
			$this->vote_model->questionid = 33;
			$this->vote_model->answerid = 33;
			$this->vote_model->respondantind = 33;
			$this->vote_model->surveyid = 33;
			$this->vote_model->save();
			print_r($this->vote_model->get_votes());
			
		print "<br/>====================Delete test================<br/>";
			$this->vote_model->id = 4;
			$this->vote_model->delete();
			print_r($this->vote_model->get_votes());
		
		print "<br/>====================Read single test================<br/>";
			print_r($this->vote_model->get_vote(2));
			
		print "<br/>====================Read by respondant test================<br/>";
			print_r($this->vote_model->get_votes_byrespondant(25));
			
		print "<br/>====================Read by awnser test================<br/>";
			print_r($this->vote_model->get_votes_onanswers(3));
		
		
		
	echo '</pre>';
	
	
	

	