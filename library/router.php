<?php 
//setReporting();
if(array_key_exists('PATH_INFO', $_SERVER) == FALSE){
	$controller = $default['controller'];
	$action = $default['action'];
}else{
	$request = $_SERVER[PATH_INFO];
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
$controllerObject = new $controller($controllerName);

$variables = array();	
if((int)method_exists($controller, $action)){
	$result = $controllerObject->$action();
	while(strcmp($result, 'redirect') == 0){
		$oldController = $controllerName;
		$oldAction = $action;
		$controllerName = $routingTable[$oldController][$oldAction][$result]['controller'];
		$action = $routingTable[$oldController][$oldAction][$result]['action'];
		$controller = ucfirst($controllerName);
		$controller .= 'Controller';
		$controllerObject = new $controller($controllerName);

		$result = $controllerObject->$action();
	}
	$usercontroller = new UsersController('users'); 
	$usercontroller->getHottestUsers();
	$tagscontroller = new TagsController('tags');
	$tagscontroller->getHottestTags();
	$template =  new Template($routingTable[$controllerName][$action][$result]);
	$template->render();
}

