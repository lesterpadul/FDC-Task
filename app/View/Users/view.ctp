<div class="panel panel-info">
  	<div class="panel-heading">
		<div class="panel-title clearfix">
			<h3 class="pull-left">
				User Profile
			</h3>
			<div class="pull-right">
				<a href="<?php echo $base_url.'users/update/'.$user['User']['id']; ?>" class='btn btn-primary'>Update</a>
			</div>
		</div>
  	</div>
  	<div class="panel-body clearfix">
 		
 		<!-- upper row data -->
  		<div class="row">
  			<div class="col-xs-4">
  				<?php 
					$img_src = $base_url;
					if(is_null($user['User']['image']) || empty($user['User']['image'])):
						$img_src .= 'public/images/users/default.jpg';
					else:
						$img_src .= $this->request->data['User']['image'];
					endif;
				?>
  				<img src="<?php echo $img_src; ?>" alt="" class="img-responsive">
  			</div>
  			<div class="col-xs-8">
  				<h1>
  					<?php echo $user['User']['name']; ?>
  				</h1>
  				<div>
  					Gender :
  					<?php
  						if($user['User']['gender']=='1'):
  							echo "Male";
  						elseif($user['User']['gender']=='2'):
  							echo "Female";
  						else:
  							echo "Other";
  						endif;
  					?>
  				</div>
  				<div>
  					Birthdate : <?php echo date("F j, Y",strtotime($user['User']['birthday'])); ?>
  				</div>
  				<div>
  					Joined : <?php echo $user['User']['created']; ?>
  				</div>
  				<div>
  					Last Login : <?php echo $user['User']['last_login_time']; ?>
  				</div>
  			</div>
  		</div>
  		<!-- /. -->
		
		<hr>
		
		<!-- hobby -->
  		<div class="row">
  			<div class="col-xs-12">
  				<?php 
  					echo $user['User']['hobby'];
  				?>
  			</div>
  		</div>
		<!-- /. -->

  	</div>
</div>