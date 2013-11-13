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
		$this->assertEquals(1, $result['Topic']['uid']);	
		$this->assertEquals('TopicName1', $result['Topic']['title']);	
		$this->assertEquals('here is details', $result['Topic']['details']);	
		$this->assertEquals('2013-11-13 18:00:00', $result['Topic']['time']);	
		$this->assertEquals(5, $result['Topic']['scores']);	
		$this->assertEquals(1, $result['Topic']['active']);	
	}	

	/*
	  Test getTopicByID when topic does not exist
	*/
	function testGetTopicByIDNoTopic(){
		$controllerName = 'topics';
		$action = 'getTopicByID';
		$controller = new TopicsController($controllerName,$action);
		$result = $controller->$action(2);
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
		$this->assertEquals(1, $variables['topicinfo']['Topic']['uid']);	
		$this->assertEquals('TopicName1', $variables['topicinfo']['Topic']['title']);	
		$this->assertEquals('here is details', $variables['topicinfo']['Topic']['details']);	
		$this->assertEquals('2013-11-13 18:00:00', $variables['topicinfo']['Topic']['time']);	
		$this->assertEquals(5, $variables['topicinfo']['Topic']['scores']);	
		$this->assertEquals(1, $variables['topicinfo']['Topic']['active']);	
		/*then test user info who post this topic*/
		$this->assertEquals(1, $variables['userinfo']['User']['uid']);	
		$this->assertEquals('test', $variables['userinfo']['User']['uname']);	
		$this->assertEquals(1, $variables['answers'][0]['Answer']['aid']);

		/*test answers related to this topic*/
		$this->assertEquals('answer1', $variables['answers'][0]['Answer']['details']);
		$this->assertEquals('2013-11-13 20:00:00', $variables['answers'][0]['Answer']['time']);
		$this->assertEquals(2, $variables['answers'][0]['User']['uid']);
		$this->assertEquals('user2', $variables['answers'][0]['User']['uname']);
		$this->assertEquals('answer2', $variables['answers'][1]['Answer']['details']);
		$this->assertEquals('2013-11-13 21:00:00', $variables['answers'][1]['Answer']['time']);
		$this->assertEquals(3, $variables['answers'][1]['User']['uid']);
		$this->assertEquals('user3', $variables['answers'][1]['User']['uname']);
		$this->assertEquals('success', $result);
		$variables = array();
	}

	/*
	  Test show when topic does not exist
	*/
	function testShowSuccessfully(){
		global $variables;
		$_POST['tid'] = 2;
		$controllerName = 'topics';
		$action = 'show';
		$controller = new TopicsController($controllerName,$action);
		$result	= $controller->$action();
		$this->assertEquals('fail', $result);
		$variables = array();
	}


	


}
