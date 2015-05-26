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
		
		if($this->request->is(array('post','put'))):
			$this->Message->create();
			
			$this->request->data['from_id'] = $this->Session->read('profile')['id'];
			
			if($this->Message->save($this->request->data)) {
				$this->Session->setFlash('Message sent!');
				$this->redirect(array('controller'=>'messages','action'=>'index'));
			} else {
				$this->Session->setFlash('Message not sent!');
			}
		endif;
		
		$profile    = $this->Session->read('profile');
		$recipients = $this->User->find('all',array('condition'=>array('id !='=>$profile['id'])));

		$this->set('recipients',$recipients);
	}
	
}
