<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html base-url='<?php echo $base_url; ?>'>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');
		
		if(count($header_scripts)!==0):
			foreach($header_scripts as $script):
				echo "<script src='{$base_url}{$script}' type='text/javascript'></script>";
			endforeach;
		endif;

		if(count($styles)!==0):
			foreach($styles as $style):
				echo "<link rel='stylesheet' href='{$base_url}{$style}'>";
			endforeach;
		endif;
		
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	
	
	<?php if(!$landing_page): ?>
	<nav class="navbar navbar-default" role="navigation">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#"></a>
		</div>
		
		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse navbar-ex1-collapse">
			<ul class="nav navbar-nav navbar-right">

				<li>
					<a href="<?php echo $base_url.'messages/index'; ?>">
						<i class="fa fa-envelope"></i>&nbsp;Messages
					</a>
				</li>

				<li>
					<a href="<?php echo $base_url."users/view/".$this->Session->read('profile')['id']; ?>">
						<i class="fa fa-user"></i>&nbsp;
						<?php echo $this->Session->read('profile')['name']; ?>
					</a>
				</li>

				<li>
					<a href="<?php echo $base_url."users/logout"; ?>">
						<i class="fa fa-sign-out"></i>&nbsp;Logout
					</a>
				</li>

			</ul>
		</div><!-- /.navbar-collapse -->

	</nav>
	<?php endif;  ?>
	
	<!-- main content -->
	<div class='container'>
		<?php 
			echo $this->Session->flash();
			echo $this->fetch('content'); 
		?>
	</div>
	<!-- /. -->

</body>
</html>
