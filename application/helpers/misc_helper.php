<?php
// Angular form survey helper functions js to PHP
if( !function_exists('getMergedData') ){
	function getMergedData($formData, $respData){
		$CI = &get_instance();
		$query = $CI->db->query('select angular_form_response from tblrespondant where surveyid = 7 and userid = 28 order by id desc limit 0,3');
		if($query){
			return $query->result_array();
		}
		return array();
	}
}

if(!function_exists('extractResponse')){
	function extractResponse($question, $questionResponse){
		//print_r($questionResponse);return;
		$questionTypesWithDefaultAnswer = [
			'sample-buffer',
            'text',
            'textarea',
            'number',
            'date',
            'time',
            'email',
            'range',
            'url'
        ];

		if (array_search($question->type, $questionTypesWithDefaultAnswer) !== false) {
                return $questionResponse->answer;
        } else {
            if ($question->type == 'radio' || $question->type == 'checkbox' || $question->type == 'select') {
                return extractResponseForQuestionWithOfferedAnswers($question, $questionResponse);
            }
            if ($question->type == 'grid') {
                return extractResponseForGridQuestion($question, $questionResponse);
            }
            if ($question->type == 'priority') {
                return extractResponseForPriorityQuestion($question, $questionResponse);
            }
            if ($question->type == 'division') {
                return extractResponseForDivisionQuestion($question, $questionResponse);
            }
        }

        return null;

	}
}

if(!function_exists('extractResponseForDivisionQuestion')){
	function extractResponseForDivisionQuestion($question, $questionResponse){
		
		#TODO: needs to be done
		/*

		$result = [];
        $itemById = getObjectByIdMap($question->divisionList);
        Object.getOwnPropertyNames(questionResponse).forEach(function (itemId) {
            var value = questionResponse[itemId];
            var item = itemById[itemId];
            if (!item) {
                return;
            }
            result.push({
                id: item.id,
                label: item.value,
                value: value
            });
        });
        return result;
        */
	}
}

if(!function_exists('extractResponseForPriorityQuestion')){
	function extractResponseForPriorityQuestion($question, $questionResponse){
		$result = [];
        if (!isset($questionResponse->priorityList)) {
            return $result;
        }
        $itemById = getObjectByIdMap($question->priorityList);
        foreach ($questionResponse->priorityList as $i) {
        	$item = $itemById->{$i->id};
        	$result[] = array(['id'=>$item->id, 'value'=>$item->value, 'priority'=>$i->priority]);
        }        
        return $result;
	}
}


if(!function_exists('extractResponseForRadioGridQuestion')){
	function extractResponseForRadioGridQuestion($question, $questionResponse){
		$result = [];
        $colById = getObjectByIdMap($question->grid->cols);
        foreach ($question->grid->rows as $row) {

            $selectedColId = $questionResponse->{$row->id};
            $selectedCol = null;
            if ($selectedColId) {
                $selectedCol = $colById->{$selectedColId};
            }

            $rowResponse['row']['id'] = $row->id;
            $rowResponse['row']['label'] = $row->label;
            $rowResponse['col'] = null;

            if ($selectedCol) {
                
                $rowResponse['col']['id'] = $selectedCol->id;
                $rowResponse['col']['label'] = $selectedCol->label;

            }
            $result[] = $rowResponse;        	
        }
        
        return $result;
	}
}

if(!function_exists('extractResponseForGridQuestion')){
	function extractResponseForGridQuestion($question, $questionResponse){

		$result = [];

	    if (!isset($question->grid) || !isset($question->grid->rows)) {
	        return $result;
	    }

	    if($question->grid->cellInputType == 'radio'){
	        return extractResponseForRadioGridQuestion($question, $questionResponse);
	    }
	    foreach($question->grid->rows as $row){
	    	foreach($question->grid->cols as $col){
	    		  
	            $res = [];
	            $res['row']['id'] = $row->id;
	            $res['row']['label'] = $row->label;
	            $res['col']['id'] = $col->id;
	            $res['col']['label'] = $col->label;
	            $res['value'] = null;

	            if(isset($questionResponse->{$row->id}) && isset($questionResponse->{$row->id}->{$col->id} ) ){
	                $res['value'] = $questionResponse->{row.id}->{col.id};
	            }

	            $result[]=$res;

	    	}
	    }
	    
	    return $result;
	}
}

if(!function_exists('extractResponseForQuestionWithOfferedAnswers')){
	function extractResponseForQuestionWithOfferedAnswers($question, $questionResponse){
			$offeredAnswerById = getOfferedAnswerByIdMap($question);
            $result = array();
            if (isset($questionResponse->selectedAnswers)) {
                $result['selectedAnswers'] = array();
                $sAnswers = $questionResponse->selectedAnswers;
                foreach($sAnswers as $answerId){
                	array_push($result['selectedAnswers'], $offeredAnswerById->{$answerId});
                }
                
            } elseif (isset($questionResponse->selectedAnswer)) {
                $result['selectedAnswer'] = $offeredAnswerById->{$questionResponse->selectedAnswer};
            }
            if (isset($questionResponse->other)) {
                $result->other = $questionResponse->other;
            }
            return $result;

	}
}

if( !function_exists('getQuestionWithResponseList') ){
	function getQuestionWithResponseList($formData, $responseData){
		$result = array();
		$qlist = getQuestionList($formData, true);
		//var_dump($qlist);exit;
        foreach($qlist as $question) {
        	$id = $question->id;
            $questionResponse = isset($responseData->{$id}) ? $responseData->{$id} : null;
            if ($questionResponse) {
            	//print_r($questionResponse);exit;

                $question->response = extractResponse($question, $questionResponse);
            } else {
                $question->response = null;
            }
            
            array_push($result, $question);
        }
        return $result;

	}
}



if( !function_exists('getHeader') ){
	function getHeader($number, $questionText, $subQuestionNumbers, $subQuestionTexts, $withQuestionNumber){
		//print_r($subQuestionTexts);
		$result = "";

        if ($withQuestionNumber) {

            if ($number || $number === 0) {
                $result .= $number . '.';
            }

            if($subQuestionNumbers!==null /*&& $subQuestionNumbers!==undefined*/){
                if(!is_array($subQuestionNumbers)){
                	
                    $subQuestionNumbers = array($subQuestionNumbers);
                }

                foreach ($subQuestionNumbers as $num) {
                	$result .= $num . '.';
                }
                
            }

            if (strlen($result)>0) {
                $result .= ' ';
            }
        }


        $result .= $questionText;


        if($subQuestionTexts===null /*|| subQuestionTexts===undefined*/){
            return $result;
        }

        if(!is_array($subQuestionTexts)){
        	//echo $subQuestionTexts+'_';
            $subQuestionTexts = array($subQuestionTexts);
        }
        foreach ($subQuestionTexts as $txt) {
        	$result .= ' [' . $txt . ']';
        }
        


        return $result;
	}
}


if( !function_exists('getQuestionList') ){
	function getQuestionList($formData, $copy=false){

		$result = array();
		$pages = $formData->pages;
		
        foreach($pages as $page) {
        	$elements = $page->elements;
            foreach($elements as $element) {

                if (!isset($element->question)) {
                	//print_r($elements);
                    continue;
                }

                $question = $element->question;
                if ($copy) {
                    
                    $question = clone $element->question;
                    
                }
                
                array_push($result, $question);
            }

        }
        return $result;
	}
}


if( !function_exists('getResponseSheetRow') ){
	function getResponseSheetRow($formData, $responseData){

	    $answerDelimiter = ', ';
	    
        $result = array();

        if (!$responseData) {
            return $result;
        }
        
        $questions = getQuestionWithResponseList($formData, $responseData);
        
        $colIndex = 0;

        $questionsWithSpecialFormatting = [
        	"buffer",
            "radio",
            "checkbox",
            "select",
            "grid",
            "priority",
            "division"
        ];

        for ($i = 0; $i < sizeof($questions); $i++) {
            $question = $questions[$i];
            $response = isset($question->response) ? (object)$question->response : null;
            

            
            //print_r($response);
            if (array_search($question->type, $questionsWithSpecialFormatting) !== false) {

                if ($question->type == 'radio' || $question->type == 'select') {
                    if (!$response) {
                        
                        array_push($result, " ");
                        continue;
                    }

                    $cellVal = "";
                    if (isset($response->selectedAnswer)) {
                         $cellVal = $response->selectedAnswer->value;
                    }

                    if (isset($response->other)) {
                        if ($cellVal) {
                            $cellVal .= $answerDelimiter;
                        }
                        $cellVal .= $response->other;
                    }
                    
                    array_push($result, $cellVal);
                }
                elseif ($question->type == 'checkbox') {
                    if (!$response || !isset($response->selectedAnswers)) {
                        
                        array_push($result, "");
                        continue;
                    }
                    $cellVal = "";
                    $selectedAnswers = $response->selectedAnswers;
                    foreach($selectedAnswers as $selectedAnswer) {
                        if ($cellVal) {
                            $cellVal .= $answerDelimiter;
                        }
                         $cellVal .= $selectedAnswer->value;

                    }
                    if (isset($response->other)) {
                        if ($cellVal) {
                            $cellVal .= $answerDelimiter;
                        }
                         $cellVal .= $response->other;
                    }
                    
                    array_push($result, $cellVal);
                }
                elseif ($question->type == 'grid') {
                    if (!isset($question->grid)) {
                        continue;
                    }
                    if (!$response) {
                        if($question->grid->cellInputType=='radio'){
                        	$rows = $question->grid->rows;
                            foreach($rows as $row) {
                            	 
                            	 array_push($result, "");
                         	}

                        }else{
                        	$rows = $question->grid->rows;
                            foreach( $rows as $row ) { 
                            	$cols = $question->grid->cols;
                            	foreach($cols as$col) { 
                            		array_push($result, "");
                            	}
                            }
                        }

                        continue;
                    }
                    if($question->grid->cellInputType=='radio'){
                    	foreach($response as $entry){
                           $lbl = isset($entry->col) ? $entry->col->label : "";
                           array_push($result, $lbl);
                        }
                    }else{
                    	foreach($response as $entry){
                            
                            array_push($result, $entry->value);
                        }
                    }

                }
                elseif ($question->type == 'priority') {
                    if (!isset($question->priorityList)) {
                        continue;
                    }
                    $orderedItemById = getObjectByIdMap($response);
                    $plist = $question->priorityList;
                    foreach($plist as $item) {
                        $orderedItem = $orderedItemById[$item->id];
                        if ($orderedItem) {
                            
                            array_push($result, $orderedItem->priority);
                        } else {

                        	array_push($result, "");
                        }

                    }
                }
                elseif ($question->type == 'division') {
                    if (!isset($question->divisionList)) {
                        continue;
                    }
                    $assignedItemById = getObjectByIdMap($response);
                    $dlist = $question->divisionList;
                    foreach($dlist as $item) {
                        $assignedItem = $assignedItemById[$item->id];
                        if ($assignedItem) {
                            
                            array_push($result, $assignedItem->value);
                        } else {
                            
                            array_push($result, "");
                        }

                    }
                }
            } else {
            	$resp = isset($response) ? $response->scalar : "";
                array_push($result, $resp);
            }

            //echo $result[$i].'<br/>';
        }
        return $result;

	}
}



if( !function_exists('getResponseSheetHeaders')){
	function getResponseSheetHeaders($formData, $withQuestionNumbers){
		$specialCaseQuestions = ['buffer', 'grid', 'priority', 'division'];

        $result = array();

        $questionNumber = 0;
        $qlist = getQuestionList($formData);
        //print_r($formData);      
        

        foreach($qlist as $question) {

            $questionNumber++;
            $subIndex = 1;

            if (array_search($question->type, $specialCaseQuestions) === false) {
                $gheader = getHeader($questionNumber, $question->text, null, null, $withQuestionNumbers);
                array_push($result, $gheader);
            } else {

            	
                if ($question->type == 'grid') {
                    if (!isset($question->grid)) {
                        continue;
                    }
                    if($question->grid->cellInputType=='radio'){
                    	$rows = $question->grid->rows;
                        foreach($rows as $row) {
                            
                            $gh = getHeader($questionNumber, $question->text, $subIndex, $row->label, $withQuestionNumbers);
                            array_push($result, $gh);
                            $subIndex++;
                        }
                    }else{
                    	$rows = $question->grid->rows;
                    	foreach($rows as $rowIndex => $row) {
                    		$cols = $question->grid->cols;
                    		foreach($cols as $colIndex => $col) {                       
                                $gh = getHeader($questionNumber, $question->text, [$rowIndex+1, $colIndex+1], [$row->label, $col->label], $withQuestionNumbers);
                                array_push($result, $gh);
                                $subIndex++;
                            }
                        }
                    }

                }
                elseif ($question->type == 'priority') {
                    if (!isset($question->priorityList)) {
                        continue;
                    }
                    $plist = $question->priorityList;
                    foreach($plist as $item){                        
                        $gh = getHeader($questionNumber, $question->text, $subIndex, $item->value, $withQuestionNumbers);
                        array_push($result, $gh);
                        $subIndex++;
                    }
                }
                elseif ($question->type == 'division') {
                    if (!isset($question->divisionList)) {
                        continue;
                    }
                    $dlist = $question->divisionList;
                    foreach($dlist as $item) {
                        
                        $gh = getHeader($questionNumber, $question->text, $subIndex, $item->value, $withQuestionNumbers);
                        array_push($dlist, $gh);
                        $subIndex++;
                    }
                }
            }
        }
        return $result;

	}
}

if( !function_exists('getResponseSheet')){
	function getResponseSheet($formData, $responseDataObjectOrList, $headersWithQuestionNumber){
		/*var_dump($formData);
		var_dump($responseDataObjectOrList); return;*/
		$sheet = array();
        $headers = getResponseSheetHeaders($formData, $headersWithQuestionNumber);
        array_push($sheet, $headers);
        
        if (!$responseDataObjectOrList) {
            return $sheet;
        }

        if( is_array($responseDataObjectOrList) ) {
        	foreach($responseDataObjectOrList as $response){
        		$row = getResponseSheetRow($formData, $response);
        		array_push($sheet, $row);
        	}
        }else{
        	$row = getResponseSheetRow($formData, $responseDataObjectOrList);
        	array_push($sheet, $row);
        }

        return $sheet;
	}
}

if(!function_exists('extractResponseForQuestionWithOfferedAnswers')){
	function extractResponseForQuestionWithOfferedAnswers($question, $questionResponse){
		$offeredAnswerById = getOfferedAnswerByIdMap($question);
        $result = array();
        if (isset($questionResponse->selectedAnswers)) {
            $result['selectedAnswers'] = [];
            $sanswers = $questionResponse->selectedAnswers;
            foreach($sanswers as $answerId) {                
                $ofa = $offeredAnswerById->{$answerId};
                array_push($result['selectedAnswers'], $ofa);
            }
        } elseif (isset($questionResponse->selectedAnswer)) {
            $result['selectedAnswer'] = $offeredAnswerById->{$questionResponse->selectedAnswer};
        }
        if (isset($questionResponse->other)) {
            $result['other'] = $questionResponse->other;
        }
        return (object)$result;

	}
}

if(!function_exists('getOfferedAnswerByIdMap')){
	function getOfferedAnswerByIdMap($question){
		return getObjectByIdMap($question->offeredAnswers, 'gOABTM');

	}
}

function gOABTM($oferAnswer){
	$tmp = array();
	$tmp['id'] = $oferAnswer->id;
	$tmp['value'] = $oferAnswer->value;
	return (object)$tmp;
}

if(!function_exists('getObjectByIdMap')){
	function getObjectByIdMap($objectList, $mappingFn=null){
		$objectById = array();
        if (!$objectList) {
            return $objectById;
        }
        foreach($objectList as $obj){
        	$val = $obj;
            if ($mappingFn) {
                $val = $mappingFn($obj);
            }
            $objectById[$obj->id] = $val;
        }
        
        return (object)$objectById;
	}
}



# Functions other than ANGULAR JS surveys
# starts from here









