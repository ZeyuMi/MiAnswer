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
							'fail' => 'reregister',
						),
				'info' => array(
							'success' => 'userinfo',
						),
				'beforeEdit' => array(
							'success' => 'edituserinfo',
						),
				'logout' => array(
							'redirect' => array('controller' => 'topics',
												'action' => 'getHottestTopicsByType',
											),
						),
				'editPersonalInfo' => array(
							'redirect' => array(
												'controller' => 'users',
												'action' => 'info',
											),
						),
		   	),
	'topics' => array(
				'getHottestTopicsByType' => array(
							'success' => 'home',
						),
				'show' => array(
							'success' => 'topicdetail',
							'fail' => 'error'
						),
				'postTopic' => array(
							'redirect' => array('controller' => 'topics',
												'action' => 'show',
							),
						),
				'editTopic' => array(
							'redirect' =>  array('controller' => 'topics',
												'action' => 'show',
							),
						),
				'beforeEdit' => array(
							'success' => 'edittopicdetail',
						),
				'acceptAnswer' => array(
							'redirect' => array( 'controller' => 'topics',
												'action' => 'show',
								),
						),
				'search' => array(
							'success' => 'searchresult',
						),
			),
	'tags'	=> array(
				'getAllHottestTags' => array(
							'success' => 'tags',
						),
				'show' => array(
							'success' => 'tagdetail',
						),
			),
	'answers' => array(
				'postAnswer' => array(
							'redirect' => array('controller' => 'topics',
												'action' => 'show',
								),
						),
			),
);
