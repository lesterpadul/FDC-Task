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
		$profile    = $this->Session->read('profile');
		$this->set("profileId",$profile["id"]);
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
											        ),
											        array(
											            'table' => 'users',
											            'alias' => 'User2',
											            'type' => 'left',
											            'conditions' => array(
											                'User2.id = Message.from_id'
											            )
											        )
											    ),
												'fields' => array(
																'User.name as recipientName',
																'User.id as recipientId',
																'User.image as recipientImage',
																'User2.name as senderName',
																'User2.image as senderImage',
																'User2.id as senderId',
																'User.id as userId', 
																'Message.*'
															),
												'order' => 'Message.id DESC',
												'conditions' => array(
													'OR'=>array(
															'Message.to_id'   =>$profile['id'],
															'Message.from_id' =>$profile['id']
														),
													$likeSearch,
													"Message.status='active'"
												),
												'group' => 'Message.from_id, Message.to_id',
												'limit'=>$perPage
											)
										);
		
		//debug($threads);
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
											        ),
											        array(
											            'table' => 'users',
											            'alias' => 'User2',
											            'type' => 'left',
											            'conditions' => array(
											                'User2.id = Message.from_id'
											            )
											        )
											    ),
												'fields' => array(
																'User.name as recipientName',
																'User.id as recipientId',
																'User.image as recipientImage',
																'User2.name as senderName',
																'User2.image as senderImage',
																'User2.id as senderId',
																'User.id as userId', 
																'Message.*'
															),
												'order' => 'Message.id DESC',
												'conditions' => array(
													'OR'=>array(
															'Message.to_id'   =>$profile['id'],
															'Message.from_id' =>$profile['id']
														),
													'AND'=>$andQuery,
													$likeSearch,
													"Message.status='active'"
												),
												'limit'=>$perPage,
												'group' => 'Message.from_id, Message.to_id',
											)
										);

		die(json_encode(array("error"=>false,"content"=>$threads)));
	}
	
	public function conversation($userId){
		MessagesController::initialize();
		$profile     = $this->Session->read('profile');


		$recipient = $this->User->find('first',
									array(
										'conditions'=>array(
											'User.id'=>$userId
										)
									)
								);

		$this->set('recipientId',$userId);
		$this->set('profileId',$profile['id']);
		$this->set('recipient',$recipient);

	}

	public function getConversation(){
		$perPage     = (int) $this->params->query['perPage'];
		$profile     = $this->Session->read('profile');
		$recipientId = $this->params->query['recipientId'];

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
											        ),
											        array(
											            'table' => 'users',
											            'alias' => 'User2',
											            'type' => 'left',
											            'conditions' => array(
											                'User2.id = Message.from_id'
											            )
											        )
											    ),
												'fields' => array(
																'User.name as recipientName',
																'User.id as recipientId',
																'User.image as recipientImage',
																'User2.name as senderName',
																'User2.image as senderImage',
																'User2.id as senderId',
																'User.id as userId', 
																'Message.*'
															),
												'order' => 'Message.id DESC',
												'conditions' => array(
															"(Message.to_id={$recipientId} OR Message.from_id={$recipientId}) AND (Message.to_id={$profile['id']} OR Message.from_id={$profile['id']})",
															"Message.status='active'"
												),
												'limit'=>$perPage
											)
										);
		
		die(json_encode(array("error"=>false,"content"=>$threads)));
	}

	public function getMoreConversations(){
		$perPage     = (int) $this->params->query['perPage'];
		$profile     = $this->Session->read('profile');
		$recipientId = $this->params->query['recipientId'];
		$lastId      = $this->params->query['lastId'];

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
											        ),
											        array(
											            'table' => 'users',
											            'alias' => 'User2',
											            'type' => 'left',
											            'conditions' => array(
											                'User2.id = Message.from_id'
											            )
											        )
											    ),
												'fields' => array(
																'User.name as recipientName',
																'User.id as recipientId',
																'User.image as recipientImage',
																'User2.name as senderName',
																'User2.image as senderImage',
																'User2.id as senderId',
																'User.id as userId', 
																'Message.*'
															),
												'order' => 'Message.id DESC',
												'conditions' => array(
															"(Message.to_id={$recipientId} OR Message.from_id={$recipientId}) AND (Message.to_id={$profile['id']} OR Message.from_id={$profile['id']})",
															"Message.id < {$lastId}",
															"Message.status='active'"
												),
												'limit'=>$perPage
											)
										);

		die(json_encode(array("error"=>false,"content"=>$threads)));
	}

	public function replyMessage(){
		$error   = false;
		$content = "";

		if($this->request->is(array('post','put'))) {

			$this->Message->create();

			if($this->Message->save($this->request->data)) {
				$error   = false;
				$content = "";


				$thread = $this->Message->find('all',
											array(
												'joins' => array(
											        array(
														'table'      => 'users',
														'alias'      => 'User',
														'type'       => 'left',
														'conditions' => array(
											                'User.id = Message.to_id'
											            ),
											        ),
											        array(
											            'table' => 'users',
											            'alias' => 'User2',
											            'type' => 'left',
											            'conditions' => array(
											                'User2.id = Message.from_id'
											            )
											        )
											    ),
												'fields' => array(
																'User.name as recipientName',
																'User.id as recipientId',
																'User.image as recipientImage',
																'User2.name as senderName',
																'User2.image as senderImage',
																'User2.id as senderId',
																'User.id as userId', 
																'Message.*'
															),
												'conditions' => array(
															"Message.id = {$this->Message->id}",
															"Message.status='active'"
												),
												'limit'=>1
											)
										);

				$content = $thread;
			} else {
				$error = true;
				$content = $this->Message->validationErrors();
			}
		} else {
			$error   = true;
			$content = "No Request!";
		}

		die(json_encode(array("error"=>$error,"content"=>$content)));
	}
		
	public function removeMessage(){
		$messageId = $this->params->query['messageId'];
		
		$this->Message->id = $messageId;
		$this->Message->save(array("status"=>"inactive"));
		die(json_encode(array("error"=>false,"content"=>"")));
	}
	
	public function getMessageInformation(){
		$messageId = $this->params->query['messageId'];
		$message = $this->Message->find('all',array('conditions'=>array('Message.id'=>$messageId)));
		die(json_encode(array("error"=>false,"content"=>$message)));
	}
	
	public function saveMessageForm(){
		$this->Message->id = $_POST['convId'];
		$this->Message->save(array("content"=>$_POST["content"]));
		die();
	}

	public function checkEmailExistence(){
		MessagesController::initialize();

		$email  = "";

		if(!is_null(@$this->params->query['data']['User']['email'])) {
			$email = $this->params->query['data']['User']['email'];
		} else {
			$email = $this->params->query['email'];
		}

		$profile = $this->Session->read('profile');

		$checkEmail = $this->User->find('all',array(
													"conditions"=>array(
															"User.email='{$email}'",
															"User.email!='{$profile['email']}'"
														)
													)
										);

      	if(count($checkEmail)!=0) {

        	die(json_encode(array("valid"=>false)));

      	} else {

        	die(json_encode(array("valid"=>true)));

      	}
      	
	}
		
}
