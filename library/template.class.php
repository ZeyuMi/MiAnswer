<?php

class Template{
	protected $_view;
	
	function __construct($view){
		$this->_view = $view;
	}

	function render(){
		global $variables;
		extract($variables);

		include(SERVER_ROOT . DS . 'public'  . DS  . 'header.php');
		include(SERVER_ROOT . DS . 'public'  . DS  . $this->_view);
		include(SERVER_ROOT . DS . 'public'  . DS  . 'footer.php');
	}

}
