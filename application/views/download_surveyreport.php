<?php
	

	$q1 = $this->db->query('select angular_form from tblsurvey where id ='.intval($id));
	$sForm = $q1->result_array();
	if(!$sForm){
		die('Survey not found');
	}
	//print_r($sForm);
	$sForm = $sForm[0]['angular_form'];


	$q2 = $this->db->query('select r.*, u.id as agentid , u.fullname as agentname  from tblrespondant r left join tbluserdetails u on r.userid = u.id where r.surveyid = '.intval($id));
	$resp = $q2->result_array();

	if(!$resp){
		die('Empty respondants');
	}
	
	$tmpRecord = [];

	
	foreach ($resp as $key => $value) {
	
		$qas = getResponseSheet(json_decode($sForm), json_decode($value['angular_form_response']), false);
		$mergedata =[];
		$tmp = [
			'RespondantID' => $value['id'],
			'Respondant Full Name' => $value['fullname'],
			'Respondant Mobile' => $value['mobileid'],
			//'Photo' => $value['photo'],
			'Respondant Address' => $value['address'],
			'Respondant Pincode' => $value['pincode'],
			//'latitude' => $value['latitude'],
			//'longitude' => $value['longitude'],
			'Date Of Survey' => $value['dateofsurvey'],
			'Agent ID' => $value['agentid'],
			'Agent Name' => $value['agentname']

		];
		
		$q = $qas[0];
		$a = $qas[1];

		foreach ($q as $key => $value) {
			$mergedata[$value] = $a[$key];
		}
		//$tmpRecord[$key] = $tmp + $mergedata;
		//$resp[$key] = $tmp;
		//print_r($mergedata);
		$tmpRecord[] = $tmp+$mergedata;
		//print_r($mergedata);
	}

	//print_r($tmpRecord);

	$output = fopen("php://output",'w') or die("Can't open php://output");
	header("Content-Type:application/csv"); 
	header("Content-Disposition:attachment;filename=SurveyReport.csv"); 
	fputcsv($output, array_keys($tmpRecord[0]));
	foreach($tmpRecord as $r) {
	    fputcsv($output, $r);
	}
	fclose($output) or die("Can't close php://output");

	exit;

	
?>