<?php 
class UsersController extends AppController{
	public $helpers = array('Html','Form');
    public $hasMany = array(
    					'Message'=>array(
    						'className'=>'Message',
    						'conditions'=>'Message.from_id = User.id',
    						'order' => 'Message.created DESC'
    					)
    				);

	/**
	 * [initialize description]
	 * @return [type] [description]
	 */
	public function initialize(){
		parent::initialize();
	}
		

	/**
	 * [login description]
	 * @return [type] [description]
	 */
	public function login(){
		$data = $this->request->data['User'];
		
		$user = $this->User->find('first',
								array(
									'conditions'=>array(
										'email'    =>$data['email'],
										'password' =>$this->hash($data['password'])
										)
									)
								);

		if(count($user)!==0):
			$this->Session->write('profile',$user['User']);
			$this->User->id = $user['User']['id'];
			$this->User->save(array('User'=>array('last_login_time'=>date('Y-m-d H:i:s'))));
			die(json_encode(array('error'=>false,'content'=>'success')));
		else:	
			die(json_encode(array('error'=>true,'content'=>'fail')));
		endif;

		return false;
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
    public function view($userId){
    	UsersController::initialize();
    	$user = $this->User->findById($userId);
    	$this->data['styles'][] = 'css/main.css';
    	$this->set($this->data);
    	$this->set('user',$user);
    }

    /**
     * [update description]
     * @return [type] [description]
     */
    public function update($userId){
    	UsersController::initialize();

    	if($this->request->is(array('post','put'))):

    		$error = array();

    		$this->User->id = $userId;

			$this->request->data['User']['gender']      = $this->request->data['gender'];
			$this->request->data['User']['birthday']    = $this->request->data['birthday'];
			$this->request->data['User']['hobby']       = $this->request->data['hobby'];
			$this->request->data['User']['modified_ip'] = $this->request->clientIp();

			if(!empty($_FILES['image']['name'])):
				$ext           =  strtolower(pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION)); #get extension
				$name          = explode('.',basename($_FILES['image']['name']))[0].time();
				$allowed_types = array("gif","jpg","jpeg","png","tmp");

				if(!in_array($ext, $allowed_types)):
					$error[] = 'invalid_type';
				endif;

				$img_name = $name.'.'.$ext;

				if(move_uploaded_file($_FILES['image']['tmp_name'],WWW_ROOT.'public/images/users/'.$img_name)):
					$this->User->id = $userId;
					$this->User->save(array('User'=>array('image'=>$img_name)));
				else:
					$error[] = 'upload_error';
				endif;

			endif;

			if(count($error)==0):
				if($this->User->save($this->request->data)):
					$this->Session->setFlash('Success!','default',array('class'=>'alert alert-success'));

					$user = $this->User->findById($userId);	
					$this->Session->write('profile',$user['User']);
					$this->redirect(array('controller'=>'users','action'=>'view',$userId));
				else:
					$error[] = $this->User->validationErrors;
				endif;
			endif;
			
    	endif;

		$this->data['styles'][]         = 'css/main.css';
		$this->data['header_scripts'][] = 'js/users/update.js';
		
    	$user = $this->User->findById($userId);
		$this->set($this->data);
		$this->request->data = $user;
		
    }
    
    /**
     * [register description]
     * @return [type] [description]
     */
   	public function register(){

   		if($this->request->is(array('post','put'))):
   			$this->User->create();
   			$user = array(
   						'User'=>array(
							'name'       =>$_POST['name_user'],
							'email'      =>$_POST['email'],
							'password'   =>$this->hash($_POST['password']),
							'status'     =>1,
							'created_ip' =>$this->request->clientIp()
   						)
   					);
   			$this->User->save($user);

   			$user = $this->User->findById($this->User->id);

   			$this->Session->write('profile',$user['User']);

   			$this->User->id = $user['User']['id'];
			$this->User->save(array('User'=>array('last_login_time'=>date('Y-m-d H:i:s'))));
			
			die(json_encode(array('error'=>false,'content'=>'success')));
   		endif;
   		
   		$this->autoRender =false;
   	}
   	
}