<div class="col-xs-offset-1 col-xs-10">
	<div class="panel panel-info">
		<div class="panel-heading">
			<h3>
				<i class="fa fa-envelope"></i>
				&nbsp;
				Create Message
			</h3>
		</div>
		<div class="panel-body clearfix">
			<div class="col-xs-12">
				<form action="" method="POST" class="form-horizontal" role="form">
					<div class="form-group">
						<label>
							Recipient
						</label>

						<!-- select -->
						<select name="to_id" id="" class="form-control">
							<?php 
								if(count($recipients)!==0) {
									foreach($recipients as $recipient) {
							?>		
							<option value="<?php echo $recipient['User']['id']; ?>" img-src='<?php echo $recipient['User']['image']; ?>'><?php echo $recipient['User']['name']; ?></option>
							<?php
									}
								}	
							?>
						</select>
						<!-- /. -->


					</div>
					<div class="form-group">
						<label>
							Message
						</label>
						<textarea name="content" id="" cols="30" rows="10" class="form-control"></textarea>
					</div>
					<div class="form-group">
						<button class="btn btn-default">
							<i class="fa fa-send"></i>
							&nbsp; Send
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>