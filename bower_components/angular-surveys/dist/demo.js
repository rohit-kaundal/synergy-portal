angular.module('app', ['ui.bootstrap', 'mwFormBuilder', 'mwFormViewer', 'mwFormUtils', 'pascalprecht.translate', 'monospaced.elastic'])
    .config(function($translateProvider){
        $translateProvider.useStaticFilesLoader({
            prefix: '/app/i18n/',
            suffix: '/angular-surveys.json'
        });
        $translateProvider.preferredLanguage('en');
    })
    .controller('DemoController', function($q,$http, $translate, mwFormResponseUtils) {
        
        /*

        var ctrl = this;
        ctrl.mergeFormWithResponse = true;
        ctrl.cgetQuestionWithResponseList = true;
        ctrl.cgetResponseSheetHeaders = true;
        ctrl.cgetResponseSheetRow = true;
        ctrl.cgetResponseSheet = true;
        ctrl.headersWithQuestionNumber = true;
        ctrl.builderReadOnly = false;
        ctrl.viewerReadOnly = false;
        ctrl.languages = ['en', 'pl', "es", "ru"];
        ctrl.httpResponse = ""
        ctrl.formData = {};
        */

        var ctrl = this;
        ctrl.builderReadOnly = false;
        ctrl.viewerReadOnly = false;
        ctrl.languages = ['en', 'pl', "es"];
        ctrl.formData = null;
        
        ctrl.formBuilder={};
        ctrl.formViewer = {};
        ctrl.formOptions = {
            autoStart: false
        };
        ctrl.formStatus= {};
        ctrl.responseData={};
        ctrl.showResponseRata=false;

        ctrl.saveResponse = function(){
            var d = $q.defer();
        //    var res = confirm("Response save success?");
            if(res){
                d.resolve(true);
            }else{
                d.reject();
            }

            return d.promise;
        };


        ctrl.loadSurveyForm = function(sId){
            var loadFormUrl = 'http://allaboutfarmers.in/app/apiv1/api/getangularform';
            var postData = {
                sid:sId
            };

            $http.post(loadFormUrl,postData)
            .then(function(s){
                ctrl.formData = JSON.parse(s.data);
                //alert(s.data);
            },function(err){
                ctrl.formData ={ "pages":[] };
            });
        }

        ctrl.saveData = function(surveyId){
            
            var formDataUrl = 'http://allaboutfarmers.in/app/bl/survey_post';
            var postData = {
                surveyid:surveyId,
                angularform:ctrl.formData
            };

            $http.post(formDataUrl, postData).
            then(function(s){
                ctrl.httpResponse = s;
            },
            function(err){
                ctrl.httpResponse = err;
            });
            

        }                         
                            
        /*$http.get('form-data.json')
            .then(function(res){
                ctrl.formData = res.data;
            });*/
        ctrl.formBuilder={};
        ctrl.formViewer = {};
        ctrl.formOptions = {
            autoStart: false
        };
        ctrl.optionsBuilder={
            /*elementButtons:   [{title: 'My title tooltip', icon: 'fa fa-database', text: '', callback: ctrl.callback, filter: ctrl.filter, showInOpen: true}],
            customQuestionSelects:  [
                {key:"category", label: 'Category', options: [{key:"1", label:"Uno"},{key:"2", label:"dos"},{key:"3", label:"tres"},{key:"4", label:"4"}], required: false},
                {key:"category2", label: 'Category2', options: [{key:"1", label:"Uno"},{key:"2", label:"dos"},{key:"3", label:"tres"},{key:"4", label:"4"}]}
            ],*/
            elementTypes: ['question']
        };
        ctrl.formStatus= {};
        ctrl.responseData={};
       
        ctrl.showResponseRata=false;

        ctrl.saveResponse = function(){
            var d = $q.defer();
            var res = confirm("Response save success?");
            if(res){
                d.resolve(true);
            }else{
                d.reject();
            }
            return d.promise;
        };

        ctrl.onImageSelection = function (){

            var d = $q.defer();
            var src = prompt("Please enter image src");
            if(src !=null){
                d.resolve(src);
            }else{
                d.reject();
            }

            return d.promise;
        };

        ctrl.resetViewer = function(){
            if(ctrl.formViewer.reset){
                ctrl.formViewer.reset();
            }

        };

        ctrl.resetBuilder= function(){
            if(ctrl.formBuilder.reset){
                ctrl.formBuilder.reset();
            }
        };

        ctrl.changeLanguage = function (languageKey) {
            $translate.use(languageKey);
        };

        ctrl.getMerged=function(){
            return mwFormResponseUtils.mergeFormWithResponse(ctrl.formData, ctrl.responseData);
        };

        ctrl.getQuestionWithResponseList=function(){
            return mwFormResponseUtils.getQuestionWithResponseList(ctrl.formData, ctrl.responseData);
        };
        ctrl.getResponseSheetRow=function(){
            return mwFormResponseUtils.getResponseSheetRow(ctrl.formData, ctrl.responseData);
        };
        ctrl.getResponseSheetHeaders=function(){
            return mwFormResponseUtils.getResponseSheetHeaders(ctrl.formData, ctrl.headersWithQuestionNumber);
        };

        ctrl.getResponseSheet=function(){
            return mwFormResponseUtils.getResponseSheet(ctrl.formData, ctrl.responseData, ctrl.headersWithQuestionNumber);
        };

    });
