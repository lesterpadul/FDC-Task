<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $data = null;
	public $helpers = array('Html','Form');

	public function initialize(){

		$this->data['header_scripts'] = array(
									'bower_components/jquery/dist/jquery.js',
									'bower_components/bootstrap/dist/js/bootstrap.js',
									'bower_components/jasny-bootstrap/js/jasny-bootstrap.js',
									'bower_components/momentjs/moment.js',
									'bower_components/datetimepicker/build/js/bootstrap-datetimepicker.min.js',
									'bower_components/bootstrapvalidator/dist/js/bootstrapValidator.js',
									'bower_components/select2/dist/js/select2.full.js',
									'bower_components/bootbox/bootbox.js',
									'bower_components/readmore/readmore.min.js',
									'bower_components/angular/angular.js',
									'ng/app.js',
									'ng/controller.js',
									'ng/service.js',
									'ng/directive.js'
								);

		$this->data['styles']         = array(
									'bower_components/bootstrap/dist/css/bootstrap.css',
									'bower_components/bootstrap/dist/css/bootstrap-theme.css',
									'bower_components/fontawesome/css/font-awesome.css',
									'bower_components/jasny-bootstrap/css/jasny-bootstrap.css',
									'bower_components/datetimepicker/build/css/bootstrap-datetimepicker.css',
									'bower_components/bootstrapvalidator/dist/css/bootstrapValidator.css',
									'bower_components/select2/dist/css/select2.min.css'
								);
		
		$this->data['base_url']     = "http://fdc.dev/";
		$this->data['landing_page'] = false;
	}	
		
}
