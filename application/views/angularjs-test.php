<script src="https://code.angularjs.org/1.2.16/angular.js">
</script>
<div ng-app ng-cloak>
	<div class="form-group">
		<input type="text" name="firstName" ng-model="firstName" placeholder="Enter your name..." class="form-control"/>
	</div>
	<div>
		<p>Hello {{firstName}}</p>
	</div>
</div>
