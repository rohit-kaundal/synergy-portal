<?php
	$survey = $this->survey_model->get_survey($id);
	
	if(empty($survey)){
		redirect(site_url('dashboard/edit_survey'));
	}
	
	
?>

<script type="text/javascript" src="<?= base_url('assets/js/angular/angular.js') ?>"></script>
<script type="text/javascript">
	angular.module('appSurvey',[])
	.controller('myCtrl', ['$scope', function($scope){
		$scope.btnClick = function(){
			$scope.txtDesc = "Clicked !";
		}
		
	}]);
</script>



<div class="panel panel-primary panel-shadow" ng-cloak ng-app="appSurvey" ng-controller="myCtrl">
	<div class="panel-heading">
		<div class="panel-title">
			<h3><i class="entypo-pencil"></i>Add Questions to <span class="green"><?= $survey->title ?></span></h3>
		</div>
		
	</div>

	<div class="panel-body">
	
				
		<div class="tab-content">
			<div class="form-group">
				<div class="input-group">
					<h3 ng-bind="txtDesc"></h3>
										
				</div>
				<button class="btn btn-success btn-sm btn-icon icon-left" ng-click="btnClick()"><i class="entypo-pencil"></i>Check for angular</button>
			</div>
			
		</div>
	</div>
</div>
	
