<?php 

$request = $_SERVER['QUERY_STRING'];

$params = explode('&', $request);

$page = array_shift($params);

$getVar = array();

for($i = 0; $i < count($params); $i++){
	list($variable, $value) = explode('=', $params[$i]);
	$getVar[$variable] = $value;
}

print "The page your requested is '$page'";
print '<br/>';
$vars = print_r($getVar, TRUE);
print "The following GET vars were passed to the page:<pre>".$vars."</pre>";
