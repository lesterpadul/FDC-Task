'use strict'
var app = angular.module('messanger',[], function($interpolateProvider) {
   
});
app.run(['$rootScope','$sce',function($rs,sce){
	$rs.base_url = $('html').attr('base-url');
}]);