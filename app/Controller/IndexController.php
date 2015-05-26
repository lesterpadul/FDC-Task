<?php 
class IndexController extends AppController{
	public $helpers = array('Html','Form');

	public function initialize(){
		parent::initialize();
	}
	
	public function index(){
		IndexController::initialize();
		$this->data['styles'][]         ='css/index/index.css';
		$this->data['header_scripts'][] = 'js/index/index.js';
		$this->data['landing_page']     = true;
		
		$this->set($this->data);
	}
}
