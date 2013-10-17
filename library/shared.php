<?php
function setReporting() {
	if (DEVELOPMENT_ENVIRONMENT == true) {
		error_reporting(E_ALL);
		ini_set('display_errors','On');
	} else {
		error_reporting(E_ALL);
		ini_set('display_errors','Off');
		ini_set('log_errors', 'On');
		ini_set('error_log', SERVER_ROOT.DS.'tmp'.DS.'logs'.DS.'error.log');
	}
}

/** Autoload any classes that are required **/

function __autoload($className) {
	if (file_exists(SERVER_ROOT . DS . 'library' . DS . strtolower($className) . '.class.php')) {
		require_once(SERVER_ROOT . DS . 'library' . DS . strtolower($className) . '.class.php');
	} else if (file_exists(SERVER_ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.class.php')) {
		require_once(SERVER_ROOT . DS . 'application' . DS . 'controllers' . DS . strtolower($className) . '.class.php');
	} else if (file_exists(SERVER_ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.class.php')) {
		require_once(SERVER_ROOT . DS . 'application' . DS . 'models' . DS . strtolower($className) . '.class.php');
	} else if (file_exists(SERVER_ROOT . DS . 'application' . DS . 'views' . DS . strtolower($className) . '.class.php')) {
		require_once(SERVER_ROOT . DS . 'application' . DS . 'views' . DS . strtolower($className) . '.class.php');
	} else {
		/* Error Generation Code Here */
	}
}
