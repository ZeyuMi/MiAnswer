<?php

class Template{
	protected $_controller;
	protected $_action;
	protected $variables = array();

	function __construct($controller, $action){
		$this->$_controller = $controller;
		$this->$_action = $action;
	}

	function set($name, $value){
		$this->$variables[$name] = $value;
	}

	function render(){
		extract($this->variables);

		include(SERVER_ROOT . '/application/view/' . $controller . '/' . $action . '.php');
	}

}
