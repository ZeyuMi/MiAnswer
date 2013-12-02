<?php

class Template{
	protected $_view;
	
	function __construct($view){
		$this->_view = $view;
	}

	function render(){
		global $variables;
		extract($variables);

		if (file_exists(SERVER_ROOT . DS . 'public' . DS . $this->_view .  '-header.php')) {
			include (SERVER_ROOT . DS . 'public' . DS . $this->_view .  '-header.php');
		} else {			
			include(SERVER_ROOT . DS . 'public'  . DS  . 'header.php');
		}
		include(SERVER_ROOT . DS . 'public'  . DS  . $this->_view . '.php');
		if (file_exists(SERVER_ROOT . DS . 'public' . DS . $this->_view . '-footer.php')) {
			include (SERVER_ROOT . DS . 'public' . DS . $this->_view .  '-footer.php');
		} else {			
			include(SERVER_ROOT . DS . 'public'  . DS  . 'footer.php');
		}

	}

}
