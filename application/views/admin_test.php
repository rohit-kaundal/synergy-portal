<?php

	echo '<pre>';
	
	
		
		
		/**
		* 
		* Model tests
		* 
		*/
		$q = new Respondant_model();
		
				
		$q->fullname = "Rohit Kaundal";
		$q->mobileid = "9816483986";
		$q->photo = "/var/www/img/rohit.jpg";
		$q->address = "Zirakput";
		$q->pincode = "140603";
		$q->latitude = "34.333";
		$q->longitude = "34.444";
		$q->surveyid = 1;
		$q->userid = $_SESSION['user_id'];
		
		
		// Create test with 5 records
		
		$q->save();
		
		
		
		$q->id = 0;
		$q->fullname = "Kiran Manhas";
		$q->mobileid = "8628083986";
		$q->photo = "/var/www/img/kiran.jpg";
		$q->address = "Zirakput";
		$q->pincode = "140603";
		$q->latitude = "34.333";
		$q->longitude = "34.444";
		$q->surveyid = 1;
		$q->userid = $_SESSION['user_id'];
		$q->save();
		
		
		$q->id = 0;
		$q->fullname = "Happy Manhas";
		$q->mobileid = "9816483986";
		$q->photo = "/var/www/img/happy.jpg";
		$q->address = "Zirakput";
		$q->pincode = "140603";
		$q->latitude = "34.333";
		$q->longitude = "34.444";
		$q->surveyid = 2;
		$q->userid = $_SESSION['user_id'];
		$q->save();
		
		$q->id = 0;
		$q->fullname = "Arvin";
		$q->mobileid = "9876543234";
		$q->photo = "/var/www/img/arvin.jpg";
		$q->address = "shimla";
		$q->pincode = "171002";
		$q->latitude = "34.333";
		$q->longitude = "34.444";
		$q->surveyid = 2;
		$q->userid = $_SESSION['user_id'];
		$q->save();
		
		$q->id = 0;
		$q->fullname = "Rohit Kaundal";
		$q->mobileid = "9816483986";
		$q->photo = "/var/www/img/rohit.jpg";
		$q->address = "Zirakput";
		$q->pincode = "140603";
		$q->latitude = "89.333";
		$q->longitude = "23.444";
		$q->surveyid = 2;
		$q->userid = $_SESSION['user_id'];
		
		$q->save();
		
		echo "<br/>";
		echo "============== Create test ==================";
		echo "<br/>";
		print_r($q->get_respondants());	
		
		// Replace test 3rd record
		$q->fullname = "Sameer Chawla Sam";
		$q->id = 4;
		$q->save();
		
		echo "<br/>";
		echo "============== Update test ==================";
		echo "<br/>";
		print_r($q->get_respondants());
		
		// Delete test 4rd record
		$q->id = 3;
		$q->delete();
		echo "<br/>";
		echo "============== Delete test ==================";
		echo "<br/>";
		print_r($q->get_respondants());
		
		// Get answer with id 3
		echo "<br/>";
		echo "============== Single answer test ==================";
		echo "<br/>";
		print_r($q->get_respondant(4));
		
		// Get answers fof questions
		$q->id = 3;
		$q->delete();
		echo "<br/>";
		echo "============== Resondandts of survey test ==================";
		echo "<br/>";
		print_r($q->get_respondants_tosurvey(2));
		
		
		
		
	echo '</pre>';
	
	
	
	
