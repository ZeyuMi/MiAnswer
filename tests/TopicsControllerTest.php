<?php
define('SERVER_ROOT', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);
include '../config/config.php';
include '../library/controller.class.php';
include '../application/controllers/topicscontroller.class.php';
include '../library/sqlquery.class.php';
include '../library/model.class.php';
include '../application/models/topic.class.php';
include '../library/template.class.php';
$variables = array();
class TopicsControllerTest extends PHPUnit_Framework_TestCase{
	
	function testGetTopicByIDSuccessfully(){
		$controllerName = 'topics';
		$action = 'getTopicByID';
		$controller = new TopicsController($controllerName,$action);
		$result = $controller->$action(1);
		$this->assertEquals(1, $result['Topic']['tid']);	
		$this->assertEquals('u1', $result['Topic']['uid']);	
		$this->assertEquals('topic1', $result['Topic']['title']);	
		$this->assertEquals('details1', $result['Topic']['details']);	
		$this->assertEquals('2013-11-14 09:40:00', $result['Topic']['time']);	
		$this->assertEquals(20, $result['Topic']['scores']);	
		$this->assertEquals(1, $result['Topic']['active']);	
	}	

	/*
	  Test getTopicByID when topic does not exist
	*/
	function testGetTopicByIDNoTopic(){
		$controllerName = 'topics';
		$action = 'getTopicByID';
		$controller = new TopicsController($controllerName,$action);
		$result = $controller->$action(3);
		$this->assertEquals(NULL, $result);	
	}

	/*
	  Test show function. Show is a function which fill variables with all infomation related to a topic, and template will use these variables to generate html file
	*/
	function testShowSuccessfully(){
		global $variables;
		$_POST['tid'] = 1;
		$controllerName = 'topics';
		$action = 'show';
		$controller = new TopicsController($controllerName,$action);
		$result	= $controller->$action();
		$this->assertEquals(1, $variables['topicinfo']['Topic']['tid']);	
		$this->assertEquals('u1', $variables['topicinfo']['Topic']['uid']);	
		$this->assertEquals('topic11', $variables['topicinfo']['Topic']['title']);	
		$this->assertEquals('details1', $variables['topicinfo']['Topic']['details']);	
		$this->assertEquals('2013-11-14 09:40:00', $variables['topicinfo']['Topic']['time']);	
		$this->assertEquals(20, $variables['topicinfo']['Topic']['scores']);	
		$this->assertEquals(1, $variables['topicinfo']['Topic']['active']);	
		/*then test user info who post this topic*/
		$this->assertEquals('u1', $variables['userinfo']['User']['uid']);	
		$this->assertEquals('u1', $variables['userinfo']['User']['uname']);	

		/*test answers related to this topic*/
		$this->assertEquals(1, $variables['answers'][0]['Answer']['aid']);
		$this->assertEquals('answer1details', $variables['answers'][0]['Answer']['details']);
		$this->assertEquals('2013-11-15 12:00:00', $variables['answers'][0]['Answer']['time']);
		$this->assertEquals('u1', $variables['answers'][0]['User']['uid']);
		$this->assertEquals('u1', $variables['answers'][0]['User']['uname']);
		$this->assertEquals(2, $variables['answers'][0]['Answer']['aid']);
		$this->assertEquals('answer2details', $variables['answers'][1]['Answer']['details']);
		$this->assertEquals('2013-11-15 12:45:00', $variables['answers'][1]['Answer']['time']);
		$this->assertEquals('u2', $variables['answers'][1]['User']['uid']);
		$this->assertEquals('u2', $variables['answers'][1]['User']['uname']);
		$this->assertEquals('success', $result);
		$variables = array();
	}

	/*
	  Test show when topic does not exist
	*/
	function testShowNoTopic(){
		global $variables;
		$_POST['tid'] = 3;
		$controllerName = 'topics';
		$action = 'show';
		$controller = new TopicsController($controllerName,$action);
		$result	= $controller->$action();
		$this->assertEquals('fail', $result);
		$variables = array();
	}

	/*
	  Test getTopicsByUserid successfully
	  getTopicsByUserid only return id of each topic
	*/
	function testGetTopicsByUseridSuccessfully(){
		$controllerName = 'topics';
		$action = 'getTopicByUserid';
		$controller = new TopicsController($controllerName, $action);
		$reuslt = $controller->$action('u1');
		$this->assertEquals(1, $result['topics'][0]['Topic']['tid']);
	}


	function testGetTopicsbyUseridNoTopic(){
		$controllerName = 'topics';
		$action = 'getTopicByUserid';
		$controller = new TopicsController($controllerName, $action);
		$reuslt = $controller->$action('u3');
		$this->assertEquals(NULL, $result);
	}


	function testGetTopicsbyUseridNoUser(){
		$controllerName = 'topics';
		$action = 'getTopicByUserid';
		$controller = new TopicsController($controllerName, $action);
		$reuslt = $controller->$action('-1');
		$this->assertEquals(NULL, $result);
	}

	/*
	  Test function which returns hottest topics of different type including month, week and day, determined by a parameter type.
	*/
	function testGetHottestTopicsByType(){
		$controllerName = 'topics';
		$action = 'getHottestTopicsByType';
		$controller = new TopicsController($controllerName, $action);
		$result = $controller->$action('Month');
		$this->assertEquals(1, $result[0]['Topic']['tid']);
		$this->assertEquals(2, $result[1]['Topic']['tid']);
		$result = $controller->$action('Week');
		$this->assertEquals(1, $result[0]['Topic']['tid']);
		$this->assertEquals(2, $result[1]['Topic']['tid']);
		$result = $controller->$action('Day');
		$this->assertEquals(1, $result[0]['Topic']['tid']);
		$this->assertEquals(2, $result[1]['Topic']['tid']);
	}
}
