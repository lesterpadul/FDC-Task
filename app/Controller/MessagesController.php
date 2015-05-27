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
				
				$this->Session->setFlash('Message sent!','default',array('class'=>'alert alert-success'));

				$this->redirect(array('controller'=>'messages','action'=>'index'));
			} else {
				$this->Session->setFlash('Message not sent!','default',array('class'=>'alert alert-danger'));
			}
		endif;
		
		$profile    = $this->Session->read('profile');
		$recipients = $this->User->find('all',array('conditions'=>array('User.id !='=>$profile['id'])));

		$this->set('recipients',$recipients);
	}

	public function getThreads(){
		MessagesController::initialize();

		$profile    = $this->Session->read('profile');
		$perPage    = (int) $this->params->query['perPage'];
		$category   = $this->params->query['category'];
		$searchTerm = $this->params->query['searchTerm'];


		$likeSearch = "";

		if($category == "user") {
			$likeSearch = "User.name like '%{$searchTerm}%'";
		} else {
			$likeSearch = "Message.content like '%{$searchTerm}%'";
		}

		$threads = $this->Message->find('all',
											array(
												'joins' => array(
											        array(
											            'table' => 'users',
											            'alias' => 'User',
											            'type' => 'left',
											            'conditions' => array(
											                'User.id = Message.to_id'
											            )
											        )
											    ),
												'fields' => array('User.name','User.image','User.id as userId', 'Message.*'),
												'group' => 'Message.to_id',
												'order' => 'Message.id DESC',
												'conditions' => array(
													'OR'=>array(
															'Message.to_id'=>$profile['id'],
															'Message.from_id'=>$profile['id']
														),
													$likeSearch
												),
												'limit'=>$perPage
											)
										);

		die(json_encode(array('error'=>false,'content'=>$threads)));
	}

	public function getMoreThreads(){
		MessagesController::initialize();

		$lastId     = $this->params->query['lastId'];
		$perPage    = (int) $this->params->query['perPage'];
		$category   = $this->params->query['category'];
		$searchTerm = $this->params->query['searchTerm'];

		
		$andQuery                 = array();
		$andQuery['Message.id <'] = $lastId;

		$likeSearch = "";

		if($category == "user") {
			$likeSearch = "User.name like '%{$searchTerm}%'";
		} else {
			$likeSearch = "Message.content like '%{$searchTerm}%'";
		}

		$profile = $this->Session->read('profile');
		$threads = $this->Message->find('all',
											array(
												'joins' => array(
											        array(
											            'table' => 'users',
											            'alias' => 'User',
											            'type' => 'left',
											            'conditions' => array(
											                'User.id = Message.to_id'
											            )
											        )
											    ),
												'fields' => array('User.name','User.image','User.id as userId', 'Message.*'),
												'group' => 'Message.to_id',
												'order' => 'Message.id DESC',
												'conditions' => array(
													'OR'=>array(
															'Message.to_id'=>$profile['id'],
															'Message.from_id'=>$profile['id']
														),
													'AND'=>$andQuery,
													$likeSearch
												),
												'limit'=>$perPage
											)
										);

		die(json_encode(array("error"=>false,"content"=>$threads)));
	}
		
	public function conversation($userId){
		MessagesController::initialize();
	}
	
}
