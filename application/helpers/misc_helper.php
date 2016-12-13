<?php

if( !function_exists('getMergedData') ){
	function getMergedData($formData, $respData){
		$CI = &get_instance();
		$query = $CI->db->query('select angular_form from tblsurvey where id = 7');
		if($query){
			return $query->result_array();
		}
		return array();
	}
}