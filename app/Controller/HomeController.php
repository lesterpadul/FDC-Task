<?php 
class HomeController extends AppController{
	public $helpers = array('Html','Form');

	public function initialize(){
		parent::initialize();
	}
	
	public function index(){
		$this->initialize();
		$this->set($this->data);
	}
}
