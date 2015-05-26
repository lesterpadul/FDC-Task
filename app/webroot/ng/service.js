'use strict'
var app = angular.module('messanger');

app
.factory('Ajax',['$rootScope','$http',function($rs,$ht){
	
	var fac = {};
	
	fac.restAction = function(obj){
		
		var ht = $ht
				(
					{
						method:obj.method,
						url   :obj.url,
						data  :obj.data,
						params:obj.params,
						transformRequest:angular.identity,
						headers:{'Content-Type':undefined}
					}
				);
			
		return ht;
	}
	
	return fac;
}]);