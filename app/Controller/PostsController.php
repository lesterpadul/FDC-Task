<?php 
class PostsController extends AppController{
	public $helpers = array('Html','Form');

	public function index(){
		$this->set('posts', $this->Post->find('all'));
	}

	public function edit($id){

		if($this->request->is(array('post','put'))):
			$this->Post->id = $id;
			if($this->Post->save($this->request->data)):
				$this->Session->setFlash('blog updated!');
				$this->redirect(array('action'=>'index'));
			else:
				$this->Session->setFlash('unable to update blog!');
			endif;
		else:

		endif;
		
		$post = $this->Post->findById($id);
		
		$this->request->data = $post;
	}

	public function view($id){
		$post = $this->Post->findById($id);
		$this->set('post',$post);
	}
	
	public function remove($id){
		$this->Post->delete($id);
	}
	
}
