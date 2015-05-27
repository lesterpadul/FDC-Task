'use strict'
var app =angular.module('messanger');

app
.controller('MessangerList',['$scope','$rootScope','Ajax','$compile','$sce',function($s,$rs,Ajax,$compile,sce){
	$s.threads           = [];
	$s.loading           = false;
	$s.error             = false;
	$s.thread            = {};
	$s.thread.searchTerm = "";
	$s.thread.category   = "user";
	$s.limitReached      = false;
	$s.perPage           = 2;

	$s.init = function(){
		$s.loadThreads();
	}

	$s.loadThreads = function(){
		var obj    = {};
		obj.method = 'POST';
		obj.url    = $rs.base_url+'messages/getThreads';
		obj.data   = {};
		obj.params = {perPage:$s.perPage};
		
		$s.loading = true;

		Ajax
		.restAction(obj)
		.then(
			function(response){
				var data = response.data.content;
				$s.threads = data;
				$s.loading = false;
				$s.error   = false;
			},
			function(response){
				$s.loading = false;
				$s.error   = true;
			}
		);
	}

	$s.getThreadAvatar = function($user){
		var imgSrc = $rs.base_url + 'public/images/users/';
		$user.image = String($user.image);

		if($user.image!='null') {
			imgSrc += $user.image;
		} else {
			imgSrc += 'default.jpg';
		}

		return imgSrc;
	}

	$s.navigateToConversation = function($userId){
		window.location.href = $rs.base_url+'messages/conversation/'+$userId;
	}
	
	$s.loadMoreThreads = function(){
		var lastId = $s.threads[$s.threads.length-1];
		
		var obj    = {};
		obj.method = 'POST';
		obj.url    = $rs.base_url+'messages/getMoreThreads';
		obj.data   = {};
		obj.params = {lastId:lastId.Message.id, perPage:$s.perPage};

		Ajax
		.restAction(obj)
		.then(
			function(response){
				var data = response.data.content;
				if(data.length!==0) {
					if(data.length < $s.perPage){
						$s.limitReached = true;
					} else {
						$s.limitReached = false;
					}
					
					for(var i = 0; i<data.length;i++) {
						$s.threads.push(data[i]);
					}
				}else{
					$s.limitReached = true;
				}
			},
			function(response){
				
			}
		);
	}

	$s.init();
}])
.controller('ConversationList',['$scope','$rootScope','Ajax','$compile','$sce',function($s,$rs,Ajax,$compile,sce){	

	$s.init = function(){
		
	}

}]);