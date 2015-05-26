<?php 
class UsersController extends AppController{
	public $helpers = array('Html','Form');

	public function initialize(){
		parent::initialize();
	}
		

	public function login(){
		$data = $this->request->data['User'];
		
		$user = $this->User->find('first',array('conditions'=>array('email'=>$data['email'],'password'=>$this->hash($data['password']))));

		if(count($user)!==0):
			$this->Session->write('profile',$user['User']);
			$this->User->id = $user['User']['id'];
			$this->User->save(array('User'=>array('last_login_time'=>date('Y-m-d H:i:s'))));
			die(json_encode(array('error'=>false,'content'=>'success')));
		else:	
			die(json_encode(array('error'=>true,'content'=>'fail')));
		endif;
		$this->autoRender = false;
	}
	
	/**
	 * [hash description]
	 * @param  [type] $string [description]
	 * @return [type]         [description]
	 */
	public function hash($string) {
      return hash('sha512', $string);
    }

    /**
     * [logout description]
     * @return [type] [description]
     */
    public function logout(){
    	$this->Session->destroy();
    	$this->redirect(array('controller'=>'index','action'=>'index'));
    	$this->autoRender = false;
    }

    /**
     * [view description]
     * @param  [type] $user_id [description]
     * @return [type]          [description]
     */
    public function view($user_id){
    	$this->initialize();
    	$user = $this->User->findById($user_id);
  		
    	$this->set($this->data);
    	$this->set('user',$user);

    }

    /**
     * [update description]
     * @return [type] [description]
     */
    public function update($user_id){
    	UsersController::initialize();

    	if($this->request->is(array('post','put'))):

    		$error = array();

    		$this->User->id = $user_id;
			$this->request->data['User']['password']    = $this->hash($this->request->data['password']);
			$this->request->data['User']['gender']      = $this->request->data['gender'];
			$this->request->data['User']['birthday']    = $this->request->data['birthday'];
			$this->request->data['User']['hobby']       = $this->request->data['hobby'];
			$this->request->data['User']['modified_ip'] = $this->request->clientIp();

			if(!empty($_FILES['image']['name'])):
				$ext           =  strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION)); #get extension
				$name          = substr($_FILES['image']['name'], 0, 50);
				$allowed_types = array("gif","jpg","jpeg","png","tmp");

				if(!in_array($ext, $allowed_types)):
					$error[] = 'invalid_type';
				endif;
				
				/*if(move_uploaded_file($_FILES['image']['tmp_name'],)):
				endif;*/
			endif;

			if(count($error)==0):
				if($this->User->save($this->request->data)):
					$this->Session->setFlash('Sucess!');
					$user = $this->User->findById($user_id);
					$this->Session->write('profile',$user['User']);
					$this->redirect(array('controller'=>'users','action'=>'view',$user_id));
				else:
					$error [] = $this->User->validationErrors;
				endif;
			endif;

			if(count($error)!==0):
				var_dump($error);
				die();
			endif;

    	endif;

    	$this->data['header_scripts'][] = 'js/users/update.js';
    	$user = $this->User->findById($user_id);
		$this->set($this->data);
		$this->request->data = $user;
    }
   	
}
