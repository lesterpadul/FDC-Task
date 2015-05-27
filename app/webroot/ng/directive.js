app.directive("message",['$rootScope', function($rootScope){
	var obj        = new Object();
	obj.restrict   = "A";

	obj.controller = function(){
		setTimeout(function(){
			$('.threadItem').readmore();
		},50);
	}
	
	return obj;
}]);