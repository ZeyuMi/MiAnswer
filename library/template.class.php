<?php

class Template{
	protected $_view;
	
	function __construct($view){
		$this->_view = $view;
	}

	function render(){
		global $variables;
		extract($variables);

		include(SERVER_ROOT . DS . 'application' . DS . 'views' . DS  . $this->_view . DS . '.php');
	}

}
