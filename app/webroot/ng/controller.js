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
	$s.profileId         = $('#profileId').val();

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
		
		if($s.profileId==$conv.User2.senderId) {
			$conv.User.recipientImage = String($conv.User.recipientImage);

			if($conv.User.recipientImage!='null') {
				imgSrc += $conv.User.recipientImage;
			} else {
				imgSrc += 'default.jpg';
			}
		} else {
			$conv.User2.senderImage = String($conv.User2.senderImage);

			if($conv.User2.senderImage!='null') {
				imgSrc += $conv.User2.senderImage;
			} else {
				imgSrc += 'default.jpg';
			}
		}

		return imgSrc;
	}

	/**
	 * [navigateToConversation description]
	 * @param  {[type]} $userId [description]
	 * @return {[type]}         [description]
	 */
	$s.navigateToConversation = function($message){

		var $userId = 0;

		if($s.profileId==$message.from_id) {
			$userId = $message.to_id;
		} else {
			$userId = $message.from_id;
		}

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
	
	/**
	 * [formatDate description]
	 * @param  {[type]} dateString [description]
	 * @return {[type]}            [description]
	 */
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
	$s.perPage       = 5;
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
	
	/**
	 * [formatDate description]
	 * @param  {[type]} dateString [description]
	 * @return {[type]}            [description]
	 */
	$s.formatDate = function(dateString){
		var newDate = moment(dateString).format("YYYY-MM-DD hh:mm A");
		return newDate;
	}

	/**
	 * [newReply description]
	 * @return {[type]} [description]
	 */
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

	/**
	 * [deleteConversation description]
	 * @return {[type]} [description]
	 */
	$s.deleteConversation = function($conversationId,$index){
		bootbox.confirm("Do you really want to remove this message?",function(result){
			if(result) {
				var obj    = {};
				obj.method = 'POST';
				obj.url    = $rs.base_url+'messages/removeMessage';
				obj.data   = {};
				obj.params = {messageId:$conversationId};

				Ajax
				.restAction(obj)
				.then(
					function(response){
						bootbox.alert("Message has been removed!");
						$s.conversations.splice($index,1);
					},
					function(response){
						
					}
				);
			}
		});
	}

	/**
	 * [updateConversation description]
	 * @param  {[type]} $convId [description]
	 * @param  {[type]} $index  [description]
	 * @return {[type]}         [description]
	 */
	$s.updateConversation = function($convId,$index){

		var scope = angular.element($("#messageUpdateModal")).scope();

		$('#messageUpdateModal')
		.modal("show")
		.off("shown.bs.modal")
		.on("shown.bs.modal",function(){
			scope.$apply(function(){
				scope.convId    = $convId;
				scope.convIndex = $index;
				scope.loadConv();
			});
		})
		.off("hidden.bs.modal")
		.on("hidden.bs.modal",function(){
			scope.$apply(function(){
				scope.convId = 0;
				scope.loadConv();
			});
		});

	}

	//call the initialize function
	$s.init();
}])
.controller('ConversationUpdate',['$scope','$rootScope','Ajax','$compile','$sce',function($s,$rs,Ajax,$compile,sce){	
	$s.convId      = 0;
	$s.convContent = "";
	$s.convIndex   = 0;

	/**
	 * [loadConv description]
	 * @return {[type]} [description]
	 */
	$s.loadConv = function(){
		$s.convId = parseInt($s.convId);
		if(!isNaN($s.convId) && $s.convId!==0) {
			var obj    = {};
				obj.method = 'POST';
				obj.url    = $rs.base_url+'messages/getMessageInformation';
				obj.data   = {};
				obj.params = {messageId:$s.convId};

				Ajax
				.restAction(obj)
				.then(
					function(response){
						$s.convContent = response.data.content[0].Message.content;
					},
					function(response){
						
					}
				);
		} else {
			$s.convId      = 0;
			$s.convContent = "";
			$s.convIndex   = 0;
		}
	}

	/**
	 * [saveMessage description]
	 * @return {[type]} [description]
	 */
	$s.saveMessage = function(){
		$s.convContent = $.trim($s.convContent);
		if($s.convContent.length!==0) {
			var obj    = {};
			obj.method = 'POST';
			obj.url    = $rs.base_url+'messages/saveMessageForm';
			obj.data   = new FormData(document.getElementById('ConversationUpdateForm'));
			obj.params = {};

			Ajax
			.restAction(obj)
			.then(
				function(response){
					var scope = angular.element($("[ng-controller='ConversationList']")).scope();
					
					scope.conversations[$s.convIndex].Message.content = $s.convContent;
					
					//close modal
					$('#messageUpdateModal')
					.modal("hide");

					//popup
					bootbox.alert("Message has been updated!");
				},
				function(response){
					
				}
			);
		} else {
			alert("Content must not be empty!");
		}
	}	
}]);