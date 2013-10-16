<?php

class Controller{
	protected $_template;
	protected $_model;

	function __construct(){

	}

	function set($name, $value){
		$this->$_template->set($name, $value);
	}

	function __destruct(){
		$this->$_template->render();
	}
	
}
