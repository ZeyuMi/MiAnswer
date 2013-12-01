<?php
$default['controller'] = 'topics';
$default['action'] = 'getHottestTopicsByType';

//next is the routing table for controller's action to jump according to their result

$routingTable = array(
	'users' => array(
				'login' => array(
							'redirect' => array('controller' => 'topics',
												'action' => 'getHottestTopicsByType',
											),
							'fail'    => 'error.php',
						),
				'register' => array(
							'redirect' => array('controller' => 'topics',
												'action' => 'getHottestTopicsByType',
											),
							'fail' => 'fail.php',
						),
				'info' => array(
							'success' => 'edituserinfo.php',
						),
				'logout' => array(
							'redirect' => array('controller' => 'topics',
												'action' => 'getHottestTopicsByType',
											),
						),
		   	),
	'topics' => array(
				'getHottestTopicsByType' => array(
							'success' => 'home.php',
						),
				'show' => array(
							'success' => 'edittopicdetail.php',
							'fail' => 'error.php'
						),
			),
	'tags'	=> array(
				'getHottestTagsByType' => array(
							'success' => 'tags.php',
						),
				'show' => array(
							'success' => 'tagdetail.php',
						),
			),
);
