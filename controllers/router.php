<?php 

$request = $_SERVER['QUERY_STRING'];

$params = explode('&', $request);

$page = array_shift($params);

$getVar = array();

for($i = 0; $i < count($params); $i++){
	list($variable, $value) = explode('=', $params[$i]);
	$getVar[$variable] = $value;
}

$targetfile = SERVER_ROOT . '/controllers/' . $page . '.php';

if(file_exists($targetfile)){
	include_once($targetfile);
	$className = ucfirst($page) . 'Controller';

	if(class_exists($className)){
		$controller = new $className;
	}else{
		die('class does not exist');
	}
}else{
	die('file does not exist');
}

