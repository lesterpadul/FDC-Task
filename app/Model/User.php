<?php 
class User extends AppModel{

		public $validate = array(
			'name'=>array(
				'nameNotEmpty' => array(
					"rule"    => 'notEmpty',
					"message" => "Name must not be empty!"
				)
			),
			'email'=>array(
				'emailNotEmpty'=>array(
					"rule" => "notEmpty",
					"message" => "Email must not be empty!"
				)
			)
		);
}