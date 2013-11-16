<?php

class Controller{
	protected $_controller;
	protected $_action;
	protected $_model;

	function __construct($controller){
		$this->_controller = $controller;
		$model = trim(ucfirst($controller),'s');
		$this->$model = new $model;
	}

	function __destruct(){
	}
	
}
