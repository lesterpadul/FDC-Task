<div class='col-xs-10 col-xs-offset-1' ng-cloak='' ng-controller='ConversationList' ng-cloak>
	
	<h1>
		Conversation
		<small>
			with <?php echo $recipient['User']['name']; ?>
		</small>	
	</h1>

	<div class="well well-sm">

		<header class="clearfix">
			<form action="" id="replyFormData">
				<input type="hidden" id='recipientId' name='to_id' value='<?php echo $recipientId; ?>'>
				<input type="hidden" id="profileId" name='from_id' value="<?php echo $profileId; ?>">
				<textarea class="form-control" name='content' rows="5"></textarea>
				<button class="btn btn-default" type='button' ng-click="newReply();">Reply</button>
			</form>
		</header>

		<hr>

		<div class="conversationContainer" ng-show="conversations.length!=0">
			
			<div class='threadContainerMain' ng-repeat="conversation in conversations track by $index">
				
				<!-- incoming messages -->
				<div class="threadContainer clearfix threadItem" ng-if="conversation.Message.from_id!=profileId">
					<div class="col-xs-2 avatar" style='background:url({{getThreadAvatar(conversation,"incoming");}}) center; background-size:cover; background-color: #ccc; '></div>
					<div class="col-xs-10 content">
						<div class="user">
							<a href="<?php echo $base_url."users/view/{{conversation.User2.senderId}}";  ?>">
								{{conversation.User2.senderName}}
							</a>
						</div>

						<div class="message" message>
							{{conversation.Message.content}}
						</div>

						<div class="time text-right">
							<i class="fa fa-clock-o"></i>
							{{formatDate(conversation.Message.created)}}
						</div>
					</div>
				</div>
				<!-- /. -->
				
				<!-- outgoing messages -->
				<div class="threadContainerOutgoing clearfix threadItem" ng-if="conversation.Message.from_id==profileId">
					<div class="col-xs-10 content">
						<div class="user">
							<a href="<?php echo $base_url."users/view/{{conversation.User2.senderId}}";  ?>">
								{{conversation.User2.senderName}}
							</a>
						</div>
						
						<div class="message" message>
							{{conversation.Message.content}}
						</div>

						<div class="time clearfix">
							<div class="pull-left">
								<a href="javascript:void(0);" class='btn btn-primary btn-xs' ng-click="updateConversation(conversation.Message.id,$index);">Update</a>
								<a href="javascript:void(0);" class='btn btn-danger btn-xs' ng-click="deleteConversation(conversation.Message.id,$index);">Remove</a>
							</div>

							<div class="pull-right">
								<i class="fa fa-clock-o"></i>
								{{formatDate(conversation.Message.created)}}
							</div>
						</div>
					</div>
					<div class="col-xs-2 avatar" style='background:url({{getThreadAvatar(conversation,"outgoing");}}) center; background-size:cover; background-color: #ccc; '></div>
				</div>
				<!-- /. -->
				
			</div>
		</div>

		<div class="fdc-general-empty text-center" ng-show="conversations.length==0">
			<i class="fa fa-comment"></i>
			<p>
				This conversation has 0 messages.
			</p>
		</div>

		<footer class='threadFooter text-center' ng-show="!limitReached" ng-cloak="">
			<hr>
			<button class="btn btn-default" ng-click="loadMoreConversations();">
				Show More
			</button>
		</footer>


	</div>

	
</div>


<div class="modal fade" id="messageUpdateModal" ng-controller="ConversationUpdate">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title">Update Message</h4>
			</div>
			<div class="modal-body clearfix">
				<div class="col-xs-12">
					<form action="" method="POST" class="form-horizontal" role="form" id="ConversationUpdateForm">
						<input type="text" ng-model="convId" name="convId" style="display:none;">
						<div class="form-group">
							<textarea name="content" id="" cols="30" rows="10" class="form-control" ng-model="convContent"></textarea>
						</div>
					</form>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" ng-click="saveMessage();">Save changes</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->