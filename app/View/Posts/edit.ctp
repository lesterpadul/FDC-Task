<?php 
	echo $this->Form->create('Post');
	echo $this->Form->input('title');
	echo $this->Form->input('body',array('class'=>'form-control','rows'=>'3'));
	echo $this->Form->end('Save Post');
?>