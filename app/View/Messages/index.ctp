<div class='col-sm-8 col-sm-offset-2 col-xs-10 col-xs-offset-1' ng-controller='MessangerList' ng-cloak>
	
	<header class="clearfix">
		<!-- upper row -->
		<div class="row upper-row">
			<div class="col-xs-8">
				<div class="input-group">
					<input type="text" class="form-control" placeholder='Search...'>
					<div class="input-group-btn dropdown">
						<button class="btn btn-default  dropdown-toggle" data-toggle="dropdown">
							<i class="fa fa-caret-down"></i>
						</button>
						<ul class="dropdown-menu"  >
							<li>	
								<a ng-click='thread.searchTerm="user"; ' href='javascript:void(0);'>
									<i class="fa fa-user"></i>
									&nbsp;User
								</a>
							</li>
							<li>
								<a ng-click='thread.searchTerm="message"; ' href='javascript:void(0);'>
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
	
	<hr>


	<div class='threadMain' ng-show='!loading'>
		<div class="threadContainer clearfix" ng-repeat='thread in threads track by $index' ng-click='navigateToConversation(thread.User.userId);'>
			<div class="col-xs-2 avatar" style='background:url({{getThreadAvatar(thread.User);}}) center; background-size:cover; background-color: #ccc; '></div>

			<div class="col-xs-10 content">
				<div class="message">
					{{thread.Message.id}}

					{{thread.Message.content}}
				</div>
				<div class="time text-right">
					<i class="fa fa-clock-o"></i>
					{{thread.Message.created}}
				</div>
			</div>
		</div>
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
