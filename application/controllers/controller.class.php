<?php

class Controller{
	protected $_controller;
	protected $_action;
	protected $_template;
	protected $_model;

	function __construct($controller, $action){
		$this->_controller = $controller;
		$this->_action = $action;
		$model = trim(ucfirst($controller),'s');
		$this->$model = new $model;
		$this->_template = new Template($controller, $action);
	}

	function set($name, $value){
		$this->_template->set($name, $value);
	}

	function __destruct(){
		$this->_template->render();
	}
	
}
