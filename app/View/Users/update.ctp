<div class="col-xs-offset-1 col-xs-10">
	<div class="panel panel-info">
	  	<div class="panel-heading">
			<h3>
				User Edit
			</h3>
	  	</div>
	  	<div class="panel-body">
			<?php 
				
				if(count(@$validationError)!==0) {
					echo "<div class='alert alert-danger'><ul>";
					foreach($validationError as $error) {
						if($error=="invalid_type"):
							echo "<li>Invalid File Type!</li>";
						elseif($error=="upload_error"):
							echo "<li>An error occurred during the upload!</li>";
						endif;
					}
					echo "</ul></div>";
				}

				echo $this->Form->create('User',array('class'=>'form-horizontal','enctype'=>'multipart/form-data','id'=>'UpdateUserForm'));
			?>
				<div class="clearfix">

					<!-- img src -->
					<?php 
						$img_src = $base_url;
						if(is_null($this->request->data['User']['image']) || empty($this->request->data['User']['image'])):
							$img_src .= 'public/images/users/default.jpg';
						else:
							$img_src .= 'public/images/users/'.$this->request->data['User']['image'];
						endif;
					?>
					
					<div class="col-xs-4">

						<div class="fileinput fileinput-new" data-provides="fileinput" >
						  <div class="fileinput-new thumbnail" style="max-width:200px;">
						    <img data-src="<?php echo $img_src; ?>" src='<?php echo $img_src; ?>' class='img-responsive'>
						  </div>
						  <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;"></div>
						  <div>
						    <span class="btn btn-default btn-file"><span class="fileinput-new">Select image</span><span class="fileinput-exists">Change</span><input type="file" name="image"></span>
						    <a href="#" class="btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
						  </div>
						</div>
						
					</div>
					<!-- /. -->
					
					<!-- form content -->
					<div class="col-xs-8">
						
						<div class="form-group">
							<label>Name*</label>
							<input type="text" name='data[User][name]' maxlength="25" value="<?php echo $this->request->data['User']['name'] ?>" class="form-control">
						</div>	
						
						<div class="form-group">
							
							<div class="col-xs-6" style='padding-left:0px;'>
								<label>Birthday*</label>
								<div class="input-group"  id='userBirthday' data-date-format="YYYY-MM-DD">
									<input type="text" name='birthday' value="<?php echo $this->request->data['User']['birthday']; ?>" class="form-control" data-date-format="YYYY-MM-DD">
									<div class="input-group-btn">
										<button class="btn btn-default" type='button'>
											<i class="fa fa-calendar"></i>
										</button>
									</div>
								</div>
							</div>
							
							<div class="col-xs-6" style='padding-right:0px;'>
								<label>Gender*</label>
								<select name="gender" id="" class="form-control">
									<option value="">- SELECT -</option>
									<option value="1" <?php if($this->request->data['User']['gender']=='1'): echo "selected='selected'"; endif; ?>>Male</option>
									<option value="2" <?php if($this->request->data['User']['gender']=='2'): echo "selected='selected'"; endif; ?> >Female</option>
									<option value="3" <?php if($this->request->data['User']['gender']=='3'): echo "selected='selected'"; endif; ?>>Other</option>
								</select>
							</div>
							
						</div>
						
						<div class="form-group">
							<label>Hobby</label>
							<textarea name="hobby" id="" cols="30" rows="10" class="form-control"><?php echo $this->request->data['User']['hobby']; ?></textarea>
						</div>
						
						<div class="form-group">
							<label>Email Address*</label>
							<?php
								echo $this->Form->input('email',array('label'=>false,'class'=>'form-control'));
							?>
						</div>
						
						<div class="form-group">
							<div class="col-xs-6" style='padding-left:0px;'>
								<label>Password</label>
								<input type="password" class="form-control" name='password'>
							</div>
							<div class="col-xs-6" style='padding-right:0px;'>
								<label>C. Password</label>
								<input type="password" class='form-control' name='cpassword'>
							</div>
						</div>
						
						<div class="form-group">
							<button class="btn btn-default btn-block clearfix">
								<span class="pull-left">
									<i class="fa fa-save"></i>
								</span>
								<span class="pull-right">
									SAVE
								</span>
							</button>
						</div>
						
					</div>
					<!-- /. -->
					
				</div>
			<?php
				echo $this->Form->end();
			?>	
	  	</div>
	</div>
</div>