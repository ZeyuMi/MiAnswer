<?php
$default['controller'] = 'topics';
$default['action'] = 'getHottestTopicsByType';

//next is the routing table for controller's action to jump according to their result

$routingTable = array(
	'users' => array(
				'login' => array(
							'success' => 'hello.php',
							'fail'    => '',
						),
				'signup' => array(

						),
				'info' => array(
			
						),
		   	),
	'topics' => array(
				'getHottestTopicsByType' => array(
							'success' => 'home.php',
						),
			),
);
