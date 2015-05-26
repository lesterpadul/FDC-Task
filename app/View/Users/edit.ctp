<h1>Edit</h1>

<?php 
	echo $this->Form->create('User');
	echo $this->Form->input('name');
	echo $this->Form->input('email');
	echo $this->Form->end("Save");
?>