<?php
	$survey = $this->survey_model->get_survey($id);

	
	if(empty($survey)){
		redirect(site_url('dashboard/edit_survey'));
	}
	
	
?>

    <link rel="stylesheet" href="<?=base_url('bower_components/angular/angular-csp.css')?>">
    <link rel="stylesheet" href="<?=base_url('bower_components/font-awesome/css/font-awesome.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('bower_components/bootstrap/dist/css/bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('bower_components/angular-surveys/dist/form-builder-bootstrap.min.css')?>">
    <link rel="stylesheet" href="<?=base_url('bower_components/angular-surveys/dist/form-viewer.min.css')?>">
     <link rel="stylesheet" href="<?=base_url('bower_components/ng-sortable/dist/ng-sortable.css')?>">
    <link rel="stylesheet" href="<?=base_url('bower_components/angular-surveys/dist/demo.css')?>">

	<div class="panel panel-primary panel-shadow" >
		<div class="panel-heading">
			<div class="panel-title">
				<h3><i class="entypo-pencil"></i><?= $survey->title ?> - Questionairre</span>

				</h3>
			</div>
			
		</div>

		   
		<div class="panel-body">	
						
			<div class="tab-content">

	            <div ng-app="app">   
		                    
		                    

			                <div ng-controller="DemoController as ctrl" ng-cloak ng-init="ctrl.loadSurveyForm(<?=$survey->id?>)">
			                

				                	<div class="demo-container" ng-if="!ctrl.formData">Loading...</div>
					                <div class="demo-container" ng-if="ctrl.formData">

					                    

					                    <ul class="nav nav-tabs" role="tablist">
					                        <li role="presentation" class="active"><a href="#builder" aria-controls="home" role="tab" data-toggle="tab">Builder</a></li>
					                        <li role="presentation"><a href="#viewer" aria-controls="profile" role="tab" data-toggle="tab" ng-click="ctrl.resetViewer()">Viewer</a></li>
					                        <li role="presentation"><a href="#model" aria-controls="messages" role="tab" data-toggle="tab">Model</a></li>
					                        
					                    </ul>

					                    <div class="tab-content" >
					                        <div role="tabpanel" class="tab-pane active" id="builder">
					                            <div class="row">
					                                <div class="col-md-offset-2 col-md-8">
					                                    <div class="form-inline">
					                                        <button type="button" style="margin-bottom: 15px" class="btn btn-default" ng-click="ctrl.resetBuilder()">Reset</button>
					                                        <div class="checkbox">
					                                            <label>
					                                                <input type="checkbox" ng-model="ctrl.builderReadOnly"> Read only
					                                            </label>
					                                        </div>
					                                    </div>
					                                    <mw-form-builder form-data="ctrl.formData" api="ctrl.formBuilder" form-status="ctrl.formStatus" read-only="ctrl.builderReadOnly" on-image-selection="ctrl.onImageSelection()"></mw-form-builder>
					                                </div>
					                            </div>
					                        </div>
					                        <div role="tabpanel" class="tab-pane" id="viewer">
					                            <div class="form-inline">
					                                <button type="button" style="margin-bottom: 15px" class="btn btn-default" ng-click="ctrl.resetViewer()">Reset</button>
					                                <div class="checkbox">
					                                    <label>
					                                        <input type="checkbox" ng-model="ctrl.formOptions.autoStart"> Auto start
					                                    </label>
					                                </div>
					                                <div class="checkbox">
					                                    <label>
					                                        <input type="checkbox" ng-model="ctrl.viewerReadOnly"> Read only
					                                    </label>
					                                </div>
					                            </div>
					                            <mw-form-viewer form-data="ctrl.formData" form-status="ctrl.formStatus" api="ctrl.formViewer" response-data="ctrl.responseData" options="ctrl.formOptions" read-only="ctrl.viewerReadOnly" on-submit="ctrl.saveResponse()"></mw-form-viewer>

					                            <hr>

					                            <div class="checkbox">
					                                <label>
					                                    <input type="checkbox" ng-model="ctrl.showResponseData"> Show response data
					                                </label>
						                <pre ng-if="ctrl.showResponseData">
						                {{ctrl.responseData|json}}
						                </pre>
						                            </div>

						                        </div>
						                        <div role="tabpanel" class="tab-pane" id="model">
						                <pre>
						                {{ctrl.formData|json}}
						                </pre>
						                            <div class="checkbox">
						                                <label>
						                                    <input type="checkbox" ng-model="ctrl.showModelJsonInput"> Set model value
						                                </label>
						                            </div>
						                            <div ng-if="ctrl.showModelJsonInput">
						                                <textarea class="form-control"  ng-model="ctrl.modelJsonInput"></textarea>
						                                <button class="btn btn-default" ng-click="ctrl.setModelFromJsonInput()">Set</button>
						                            </div>

						                        </div>
						                        
						                    </div>
						                    <hr/>
						                    <div class="form-group">
							                    <button class="btn btn-success btn-icon icon-left" ng-click="ctrl.saveData(<?= $survey->id?>)"><i class="entypo-pencil"></i>Save Questionairre</button>
						                    </div>
						                    <hr/>         

					                </div>
			                </div>
	            </div>
			</div>
	    </div>        
		 
	</div>



<script src="<?=base_url('bower_components/angular/angular.js')?>"></script>
<script src="<?=base_url('bower_components/angular-sanitize/angular-sanitize.min.js')?>"></script>
<script src="<?=base_url('bower_components/angular-translate/angular-translate.min.js')?>"></script>
<script src="<?=base_url('bower_components/angular-translate-loader-static-files/angular-translate-loader-static-files.min.js')?>"></script>
<script src="<?=base_url('bower_components/angular-elastic/elastic.js')?>"></script>
<script src="<?=base_url('bower_components/angular-bootstrap/ui-bootstrap.min.js')?>"></script>
<script src="<?=base_url('bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js')?>"></script>
<script src="<?=base_url('bower_components/Sortable/Sortable.min.js')?>"></script>
<script src="<?=base_url('bower_components/angular-surveys/vendor/angular-legacy-sortable.js')?>"></script>
<script src="<?=base_url('bower_components/angular-surveys/dist/form-utils.min.js')?>"></script>
<script src="<?=base_url('bower_components/angular-surveys/dist/form-builder.min.js')?>"></script>
<script src="<?=base_url('bower_components/angular-surveys/dist/form-builder-bootstrap-tpls.min.js')?>"></script>
<script src="<?=base_url('bower_components/angular-surveys/dist/form-viewer.min.js')?>"></script>
<script src="<?=base_url('bower_components/angular-surveys/dist/form-viewer-bootstrap-tpls.min.js')?>"></script>
<script src="<?=base_url('bower_components/ng-sortable/dist/ng-sortable.js')?>"></script>
<script src="<?=base_url('bower_components/angular-surveys/dist/demo.js')?>"></script>











