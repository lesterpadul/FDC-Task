<div class='col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1' ng-cloak='' ng-controller='ConversationList' ng-cloak>
	<input type="hidden" id='recipientId' value='<?php echo $recipientId; ?>'>
	<input type="hidden" id="profileId" value="<?php echo $profileId; ?>">

	<header class="clearfix">
		<textarea class="form-control"></textarea>
		<button class="btn btn-default">Reply</button>
	</header>


	<div class="conversationContainer">
		
		<div class='threadContainerMain' ng-repeat="conversation in conversations">
			
			<!-- incoming messages -->
			<div class="threadContainer clearfix" ng-if="conversation.Message.from_id!=profileId">
				<div class="col-xs-2 avatar" style='background:url({{getThreadAvatar(conversation.User);}}) center; background-size:cover; background-color: #ccc; '></div>
				<div class="col-xs-10 content">
					<div class="message">
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
			<div class="threadContainerOutgoing clearfix" ng-if="conversation.Message.from_id==profileId">
				<div class="col-xs-10 content">
					<div class="message">
						{{conversation.Message.content}}
					</div>
					<div class="time text-right">
						<i class="fa fa-clock-o"></i>
						{{formatDate(conversation.Message.created)}}
					</div>
				</div>
				<div class="col-xs-2 avatar" style='background:url({{getThreadAvatar(conversation.User);}}) center; background-size:cover; background-color: #ccc; '></div>
			</div>
			<!-- /. -->
			
		</div>
	



	</div>
	
	<footer class='threadFooter text-center' ng-show="!limitReached" ng-cloak="">
		<hr>
		<button class="btn btn-default" ng-click="loadMoreConversations();">
			Show More
		</button>
	</footer>
	
</div>