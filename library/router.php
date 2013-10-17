<?php 

function callMethod(){
	$request = $_SERVER[PATH_INFO];


	$params = explode('/', substr($request,1));


	$getVar = array();

	$controller = array_shift($params);
	$action = array_shift($params);

	$queryString = $params;

	$controllerName = $controller;
	$controller = ucfirst($controller);
	$model = rtrim($controller, 's');
	$controller .= 'Controller';

	$controllerObject = new $controller($model, $controller, $action);

	if((int)method_exists($controller, $action)){
		call_user_func_array(array($controllerObject, $action), $queryString);
	}
}

setReporting();
callMethod();

