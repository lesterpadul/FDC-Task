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
	$s.perPage           = 10;
	$s.profileId     = $('#profileId').val();

	/**
	 * [init description]
	 * @return {[type]} [description]
	 */
	$s.init = function(){
		$s.loadThreads();
	}

	/**
	 * [loadThreads description]
	 * @return {[type]} [description]
	 */
	$s.loadThreads = function(){
		var obj    = {};
		obj.method = 'POST';
		obj.url    = $rs.base_url+'messages/getThreads';
		obj.data   = {};

		obj.params = {	
						perPage : $s.perPage, 
						searchTerm : $s.thread.searchTerm,
						category : $s.thread.category
					};
		
		$s.loading = true;

		Ajax
		.restAction(obj)
		.then(
			function(response){
				var data = response.data.content;

				if(data.length<$s.perPage) {
					$s.limitReached = true;
				} else {
					$s.limitReached = false;
				}

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
	
	/**
	 * [getThreadAvatar description]
	 * @param  {[type]} $user [description]
	 * @return {[type]}       [description]
	 */
	$s.getThreadAvatar = function($conv){
		var imgSrc = $rs.base_url + 'public/images/users/';
		
		$conv.User2.senderImage = String($conv.User2.senderImage);

		if($conv.User2.senderImage!='null') {
			imgSrc += $conv.User2.senderImage;
		} else {
			imgSrc += 'default.jpg';
		}
		
		return imgSrc;
	}

	/**
	 * [navigateToConversation description]
	 * @param  {[type]} $userId [description]
	 * @return {[type]}         [description]
	 */
	$s.navigateToConversation = function($userId){
		window.location.href = $rs.base_url+'messages/conversation/'+$userId;
	}
	
	/**
	 * [loadMoreThreads description]
	 * @return {[type]} [description]
	 */
	$s.loadMoreThreads = function(){
		var lastId = $s.threads[$s.threads.length-1];
		
		var obj    = {};
		obj.method = 'POST';
		obj.url    = $rs.base_url+'messages/getMoreThreads';
		obj.data   = {};
		obj.params = {
						lastId:lastId.Message.id, 
						perPage:$s.perPage,
						searchTerm : $s.thread.searchTerm,
						category : $s.thread.category
					};

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
	

	$s.formatDate = function(dateString){
		var newDate = moment(dateString).format("YYYY-MM-DD hh:mm A");
		return newDate;
	}

	//call the initialize function
	$s.init();
}])
.controller('ConversationList',['$scope','$rootScope','Ajax','$compile','$sce',function($s,$rs,Ajax,$compile,sce){	
	$s.conversations = [];
	$s.loading       = false;
	$s.error         = false;
	$s.limitReached  = true;
	$s.perPage       = 10;
	$s.recipientId   = $('#recipientId').val();
	$s.profileId     = $('#profileId').val();

	/**
	 * [init description]
	 * @return {[type]} [description]
	 */
	$s.init = function(){
		$s.loadConversation();
	}

	/**
	 * [loadThreads description]
	 * @return {[type]} [description]
	 */
	$s.loadConversation = function(){
		var obj    = {};
		obj.method = 'POST';
		obj.url    = $rs.base_url+'messages/getConversation';
		obj.data   = {};

		obj.params = {	
						perPage : $s.perPage, 
						recipientId : $s.recipientId
					};
		
		$s.loading = true;

		Ajax
		.restAction(obj)
		.then(
			function(response){
				var data = response.data.content;

				if(data.length<$s.perPage) {
					$s.limitReached = true;
				} else {
					$s.limitReached = false;
				}
				$s.conversations = data;
				$s.loading = false;
				$s.error   = false;
			},
			function(response){
				$s.loading = false;
				$s.error   = true;
			}
		);
	}

	/**
	 * [getThreadAvatar description]
	 * @param  {[type]} $user [description]
	 * @return {[type]}       [description]
	 */
	$s.getThreadAvatar = function($conv,$messageType){

		var imgSrc = $rs.base_url + 'public/images/users/';
		
		$conv.User2.senderImage = String($conv.User2.senderImage);

		if($conv.User2.senderImage!='null') {
			imgSrc += $conv.User2.senderImage;
		} else {
			imgSrc += 'default.jpg';
		}
		
		return imgSrc;
	}
	
	/**
	 * [navigateToConversation description]
	 * @param  {[type]} $userId [description]
	 * @return {[type]}         [description]
	 */
	$s.navigateToConversation = function($userId){
		window.location.href = $rs.base_url+'messages/conversation/'+$userId;
	}
	
	/**
	 * [loadMoreThreads description]
	 * @return {[type]} [description]
	 */
	$s.loadMoreConversations = function(){
		var lastId = $s.conversations[$s.conversations.length-1];
		
		var obj    = {};
		obj.method = 'POST';
		obj.url    = $rs.base_url+'messages/getMoreConversations';
		obj.data   = {};
		obj.params = {
						lastId:lastId.Message.id, 
						perPage:$s.perPage,
						recipientId : $s.recipientId
					};

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
						$s.conversations.push(data[i]);
					}
				}else{
					$s.limitReached = true;
				}
			},
			function(response){
				
			}
		);
	}	
	
	$s.formatDate = function(dateString){
		var newDate = moment(dateString).format("YYYY-MM-DD hh:mm A");
		return newDate;
	}

	$s.newReply = function(){
		var obj    = {};
		obj.method = 'POST';
		obj.url    = $rs.base_url+'messages/replyMessage';
		obj.data   = new FormData(document.getElementById('replyFormData'));
		obj.params = {};

		Ajax
		.restAction(obj)
		.then(
			function(response){
				var data = response.data.content;
				$s.conversations.unshift(data[0]);
				$("[name='content']").empty().val('');
			},
			function(response){
				
			}
		);
	}

	//call the initialize function
	$s.init();
}]);