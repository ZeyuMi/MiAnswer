<?php 

$request = $_SERVER[REQUEST_URI];

$params = explode('/', $request);

array_shift($params); //remove MiAnswer
array_shift($params); //remove MiAnswer
array_shift($params); //remove index.php

$getVar = array();

$controller = array_shift($params);
$action = array_shift($params);

$queryString = $params;

$controllerName = $controller;
$controller = ucfirst($controller);
$controller .= 'Controller';

$controllerObject = new $controller;

if((int)method_exists($controller, $action)){
	call_user_func_array(array($controller, $action), $queryString);
}


/** Autoload any classes that are required **/

function __autoload($className) {
	if (file_exists(SERVER_ROOT .  '/library/' . strtolower($className) . '.class.php')) {
		require_once(SERVER_ROOT . '/library/' . strtolower($className) . '.class.php');
	} else if (file_exists(SERVER_ROOT  . '/application/' . '/controllers/' . strtolower($className) . '.php')) {
		require_once(SERVER_ROOT . '/application/' . '/controllers/' . strtolower($className) . '.php');
	} else if (file_exists(SERVER_ROOT  . '/application/' . '/models/'  . strtolower($className) . '.php')) {
		require_once(SERVER_ROOT . '/application/' . '/models/' . strtolower($className) . '.php');
	} else {
		/* Error Generation Code Here */
	}
}

