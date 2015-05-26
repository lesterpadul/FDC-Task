<h1><?php echo $post['Post']['title']; ?></h1>
<p>
	<?php echo $post['Post']['body']; ?>
</p>

<?php 
	echo $this->Html->link('Return',array('controller'=>'posts','action'=>'index'));
?>