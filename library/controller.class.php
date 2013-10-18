<?php

class Controller{
	protected $_controller;
	protected $_action;
	protected $_model;

	function __construct($controller, $action){
		$this->_controller = $controller;
		$this->_action = $action;
		$model = trim(ucfirst($controller),'s');
		$this->$model = new $model;
	}

	function __destruct(){
	}
	
}
