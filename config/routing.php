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
							'fail'    => 'resignin',
						),
				'register' => array(
							'redirect' => array('controller' => 'topics',
												'action' => 'getHottestTopicsByType',
											),
							'fail' => 'fail',
						),
				'info' => array(
							'success' => 'edituserinfo',
						),
				'logout' => array(
							'redirect' => array('controller' => 'topics',
												'action' => 'getHottestTopicsByType',
											),
						),
		   	),
	'topics' => array(
				'getHottestTopicsByType' => array(
							'success' => 'home',
						),
				'show' => array(
							'success' => 'edittopicdetail',
							'fail' => 'error'
						),
			),
	'tags'	=> array(
				'getHottestTagsByType' => array(
							'success' => 'tags',
						),
				'show' => array(
							'success' => 'tagdetail',
						),
			),
);
