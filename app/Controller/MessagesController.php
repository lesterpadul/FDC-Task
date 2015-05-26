<?php 
class MessagesController extends AppController{
	

	public function initialize(){
		parent::initialize();
		$this->data['styles'][] = 'css/main.css';
		$this->set($this->data);
	}	
	
	public function index(){
		MessagesController::initialize();
	}
}
