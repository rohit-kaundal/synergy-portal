<script src="https://code.angularjs.org/1.2.16/angular.js">
</script>
    <div ng-app="app" ng-controller="DemoController as ctrl" ng-cloak>

        <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container-fluid" style="border-bottom: 1px solid #e7e7e7;" role="presentation">
                <div class="navbar-header" role="presentation" aria-hidden="true">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
                            data-target="#navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#"><span>angular-surveys demo</span></a>
                </div>
                <div class="collapse navbar-collapse" id="navbar-collapse" role="presentation">
                    <ul class="nav navbar-nav nav-pills navbar-right" role="menubar">
                        <li uib-dropdown class=" pointer"  role="presentation">
                            <a id="language-menu-item"  href="javascript:;" role="menuitem" uib-dropdown-toggle aria-haspopup="true" aria-expanded="false">
                                <span>
                                    <span class="glyphicon glyphicon-flag"></span>
                                    <span class="hidden-tablet">Language</span>
                                    <b class="caret"></b>
                                </span>
                            </a>
                            <ul uib-dropdown-menu  role="menu" aria-labelledby="language-menu-item">
                                <li active-menu="{{language}}" ng-repeat="language in ctrl.languages" role="presentation">
                                    <a href="" ng-click="ctrl.changeLanguage(language)"  role="menuitem">{{language}}</a>
                                </li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>


        <div class="demo-container" ng-if="ctrl.formData">

            <uib-tabset active="active">
                <uib-tab index="0" heading="Builder">
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
                            <mw-form-builder api="ctrl.formBuilder" options="ctrl.optionsBuilder" form-data="ctrl.formData" form-status="ctrl.formStatus" read-only="ctrl.builderReadOnly" on-image-selection="ctrl.onImageSelection()"></mw-form-builder>
                        </div>
                    </div>
                </uib-tab>
                <uib-tab select="ctrl.resetViewer()"  heading="Viewer">
                    <div class="form-inline">
                        <button type="button" style="margin-bottom: 15px" class="btn btn-default" ng-click="ctrl.resetViewer()">Reset</button>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" ng-model="ctrl.formOptions.autoStart"> Autostart
                            </label>
                        </div>
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" ng-model="ctrl.viewerReadOnly"> Read only
                            </label>
                        </div>
                    </div>

                    <mw-form-viewer form-data="ctrl.formData" template-data="ctrl.templateData"  form-status="ctrl.formStatus" options="ctrl.formOptions" api="ctrl.formViewer" response-data="ctrl.responseData" read-only="ctrl.viewerReadOnly" on-submit="ctrl.saveResponse()"></mw-form-viewer>

                    <hr>

                    <div class="checkbox">
                        <label>
                            <input type="checkbox" ng-model="ctrl.showResponseData"> Show response data
                        </label>
                    </div>
                    <pre ng-if="ctrl.showResponseData">
{{ctrl.responseData|json}}
                    </pre>
                </uib-tab>
                <uib-tab  heading="Model">
                    <pre>
                        {{ctrl.formData|json}}
                    </pre>
                </uib-tab>
                
                <uib-tab  heading="Utils">
                    <h3>mwFormResponseUtils service</h3>
                    <br />
                    <h4><a ng-click="ctrl.cmergeFormWithResponse = !ctrl.cmergeFormWithResponse"  href="#mergeFormWithResponse" aria-expanded="false" aria-controls="collapseExample"> mergeFormWithResponse(formData, responseData)</a></h4>
                    <div uib-collapse="ctrl.cmergeFormWithResponse" id="mergeFormWithResponse">
                        <div class="well">
                            <pre>
{{ctrl.getMerged() | json}}
                            </pre>
                        </div>
                    </div>

                    <h4><a ng-click="ctrl.cgetQuestionWithResponseList = !ctrl.cgetQuestionWithResponseList" href="#getQuestionWithResponseList" aria-expanded="false" aria-controls="collapseExample"> getQuestionWithResponseList(formData, responseData)</a></h4>
                    <div uib-collapse="ctrl.cgetQuestionWithResponseList" id="getQuestionWithResponseList">
                        <div class="well">
                            <pre>
{{ctrl.getQuestionWithResponseList() | json}}
                            </pre>
                        </div>
                    </div>

                    <h4><a ng-click="ctrl.cgetResponseSheetHeaders = !ctrl.cgetResponseSheetHeaders"  href="#getResponseSheetHeaders" aria-expanded="false" aria-controls="collapseExample"> getResponseSheetHeaders(formData, withQuestionNumbers)</a></h4>
                    <div uib-collapse="ctrl.cgetResponseSheetHeaders" id="getResponseSheetHeaders">
                        <div class="well">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" ng-model="ctrl.headersWithQuestionNumber"> withQuestionNumbers
                                </label>
                            </div>
                            <pre>
{{ctrl.getResponseSheetHeaders() | json}}
                            </pre>
                        </div>
                    </div>

                    <h4><a ng-click="ctrl.cgetResponseSheetRow = !ctrl.cgetResponseSheetRow" href="#getResponseSheetRow" aria-expanded="false" aria-controls="collapseExample"> getResponseSheetRow(formData, responseData)</a></h4>
                    <div  uib-collapse="ctrl.cgetResponseSheetRow" class="collapse" id="getResponseSheetRow">
                        <div class="well">
                            <pre>
{{ctrl.getResponseSheetRow() | json}}
                            </pre>
                        </div>
                    </div>

                    <h4><a ng-click="ctrl.cgetResponseSheet = !ctrl.cgetResponseSheet" href="#getResponseSheet" aria-expanded="false" aria-controls="collapseExample"> getResponseSheet(formData, responseDataObjectOrList, headersWithQuestionNumber)</a></h4>
                    <div uib-collapse="ctrl.cgetResponseSheet" id="getResponseSheet">
                        <div class="well">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" ng-model="ctrl.headersWithQuestionNumber"> headersWithQuestionNumber
                                </label>
                            </div>

                            <pre>
{{ctrl.getResponseSheet() | json}}
                            </pre>
                        </div>
                    </div>

                </uib-tab>
            </uib-tabset>

        </div>







        <script src="../bower_components/angular/angular.js"></script>
        <script src="../bower_components/angular-sanitize/angular-sanitize.min.js"></script>
        <script src="../bower_components/angular-translate/angular-translate.min.js"></script>
        <script src="../bower_components/angular-translate-loader-static-files/angular-translate-loader-static-files.min.js"></script>
        <script src="../bower_components/angular-elastic/elastic.js"></script>
        <script src="../bower_components/angular-bootstrap/ui-bootstrap.min.js"></script>
        <script src="../bower_components/angular-bootstrap/ui-bootstrap-tpls.min.js"></script>
        <script src="../bower_components/Sortable/Sortable.min.js"></script>
        <script src="../vendor/angular-legacy-sortable.js"></script>
        <script src="../dist/form-utils.min.js"></script>
        <script src="../dist/form-builder.min.js"></script>
        <script src="../dist/form-builder-bootstrap-tpls.min.js"></script>
        <script src="../dist/form-viewer.min.js"></script>
        <script src="../dist/form-viewer-bootstrap-tpls.min.js"></script>
        <script src="demo.js"></script>


    </div>