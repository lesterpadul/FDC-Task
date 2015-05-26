<?php 
class MessagesController extends AppController{
	

	public function initialize(){
		parent::initialize();
		$this->data['styles'][] = 'css/main.css';
		$this->data['header_scripts'][] = 'js/messages/message.js';
		$this->set($this->data);
		$this->loadModel('User');
	}	
	
	public function index(){
		MessagesController::initialize();
	}

	public function add(){
		MessagesController::initialize();
		$profile = $this->Session->read('profile');
		$recipients = $this->User->find('all',array('condition'=>array('id !='=>$profile['id'])));
		$this->set('recipients',$recipients);
	}
		
}
