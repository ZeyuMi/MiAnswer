<?php 

function callMethod(){
	global $default;
	$request = $_SERVER[PATH_INFO];
	if(!isset($request)){
		$controller = $default['controller'];
		$action = $default['action'];
	}else{
		$params = explode('/', substr($request,1));

		$getVar = array();
		$controller = array_shift($params);
		if(isset($params[0])){
			$action = array_shift($params);
		}else
			$action = 'index';
	}

	$controllerName = $controller;
	$controller = ucfirst($controller);
	$controller .= 'Controller';

	$controllerObject = new $controller($controllerName, $action);
	
	if((int)method_exists($controller, $action)){
		$controllerObject->$action();	
	}
}

setReporting();
callMethod();

