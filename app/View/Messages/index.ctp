<div class='col-xs-10 col-xs-offset-1' ng-controller='MessangerList' ng-cloak>
	<h1>
		Conversations
	</h1>

	<div class="well well-sm">
		<input type="hidden" id="profileId" value="<?php echo $profileId; ?>" >
		
		<header class="clearfix">
			<!-- upper row -->
			<div class="row upper-row">
				<div class="col-xs-8">
					<div class="input-group">
						<input type="text" ng-model="thread.searchTerm" class="form-control" placeholder='Search...'>
						<div class="input-group-btn dropdown">
							<button class="btn btn-default  dropdown-toggle" data-toggle="dropdown">
								<i class="fa fa-caret-down"></i>
							</button>
							<ul class="dropdown-menu"  >
								<li>	
									<a ng-click='thread.category="user"; ' href='javascript:void(0);'>
										<i class="fa fa-user"></i>
										&nbsp;User
									</a>
								</li>
								<li>
									<a ng-click='thread.category="message"; ' href='javascript:void(0);'>
										<i class="fa fa-envelope"></i>
										&nbsp;Message
									</a>
								</li>
							</ul>
						</div>
						<div class="input-group-btn">
							<button class="btn btn-default" ng-click='loadThreads();'>
								<i class="fa fa-search"></i>
							</button>
						</div>
					</div>
				</div>
				<div class="col-xs-4 text-right">
					<a class="btn btn-default" href='<?php echo $base_url.'messages/add'; ?>'>
						<i class="fa fa-plus-square"></i>
						&nbsp;New Message
					</a>
				</div>
			</div>
			<!-- /. -->
		</header>
		
		<div class='threadMain' ng-show='!loading && threads.length!=0'>
			<div class="threadContainerParent" ng-repeat='thread in threads track by $index'>
				
				<!-- incoming messages -->
				<div class="threadContainer clearfix"  ng-click="navigateToConversation(thread.Message);">
					<div class="col-xs-2 avatar" style='background:url({{getThreadAvatar(thread);}}) center; background-size:cover; background-color: #ccc; '></div>

					<div class="col-xs-10 content">
						<div class="user">


							<a href="<?php echo $base_url."users/view/{{thread.User2.senderId}}"; ?>" ng-if="profileId!=thread.User2.senderId">
								{{thread.User2.senderName}}
								<i class="fa fa-long-arrow-left"></i>
							</a>
								
							<a href="<?php echo $base_url."users/view/{{thread.User2.senderId}}"; ?>" ng-if="profileId==thread.User2.senderId">
								{{thread.User.recipientName}}
								<i class="fa fa-long-arrow-right"></i>
							</a>
								
						</div>

						<div class="message">
							{{thread.Message.content}}
						</div>

						<div class="time text-right">
							<i class="fa fa-clock-o"></i>
							{{formatDate(thread.Message.created)}}
						</div>
						
					</div>
				</div>
				<!-- /. -->
				
			</div>
		</div>
		
		<div class="threadEmpty text-center fdc-general-empty" ng-show="!loading && threads.length==0">
			<i class="fa fa-comment"></i>
			<p>
				You have 0 conversations.
			</p>
		</div>

		<div class='text-center' ng-show="loading">
			<h1>
				<i class="fa fa-spinner fa-spin"></i>
			</h1>
		</div>
		
		<footer class='threadFooter text-center' ng-show="!limitReached">
			<hr>
			<button class="btn btn-default" ng-click="loadMoreThreads();">
				Show More
			</button>
		</footer>
	</div>
		
	
</div>