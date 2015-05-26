<?php 
class MessagesController extends AppController{
	

	public function initialize(){
		parent::initialize();
	}	
	
	public function index(){
		$this->initialize();
		$this->set($this->data);
	}
}
