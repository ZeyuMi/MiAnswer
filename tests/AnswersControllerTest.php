<?php
define('SERVER_ROOT', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);
include '../config/config.php';
include '../library/controller.class.php';
include '../application/controllers/answerscontroller.class.php';
include '../library/sqlquery.class.php';
include '../library/model.class.php';
include '../application/models/answer.class.php';
include '../library/template.class.php';
$variables = array();
class AnswersControllerTest extends PHPUnit_Framework_TestCase{


//	function testPostAnswerSuccessfully(){
//		global $variables;
//		$_SESSION['uid'] = 'u1';
//		$_POST['tid'] = 1;
//		$_POST['details'] = 'testdetails';
//		$controllerName = 'answers';
//		$action = 'postAnswer';
//		$controller = new AnswersController($controllerName);
//		$result = $controller->$action();
//		$this->assertEquals('success', $result);
//		$this->assertEquals('u1', $variables['answerinfo']['Answer']['uid']);	
//		$this->assertEquals(1, $variables['answerinfo']['Answer']['tid']);	
//		$this->assertEquals('testdetails', $variables['answerinfo']['Answer']['details']);	
//		$this->assertEquals(0, $variables['answerinfo']['Answer']['accept']);	
//		$action = 'deleteAnswer';
//		$_POST['aid'] = $variables['answerinfo']['Answer']['aid'];
//		$controller->$action();
//		$variables = array();
//	}
//
//
//	function testPostAnswerInvalidUser(){
//		$_POST['tid'] = 1;
//		$_POST['details'] = 'testdetails';
//		$controllerName = 'answers';
//		$action = 'postAnswer';
//		$controller = new AnswersController($controllerName);
//		$result = $controller->$action();
//		$this->assertEquals('invalidUser', $result);
//	}
//
//
//	function testDeleteAnswerSuccessfully(){
//		global $variables;
//		$_SESSION['uid'] = 'u1';
//		$_POST['tid'] = 1;
//		$_POST['details'] = 'testdetails';
//		$controllerName = 'answers';
//		$action = 'postAnswer';
//		$controller = new AnswersController($controllerName);
//		$result = $controller->$action();
//		$this->assertEquals('success', $result);
//		$this->assertEquals('u1', $variables['answerinfo']['Answer']['uid']);	
//		$this->assertEquals(1, $variables['answerinfo']['Answer']['tid']);	
//		$this->assertEquals('testdetails', $variables['answerinfo']['Answer']['details']);	
//		$this->assertEquals(0, $variables['answerinfo']['Answer']['accept']);	
//		$action = 'deleteAnswer';
//		$_POST['aid'] = $variables['answerinfo']['Answer']['aid'];
//		$result = $controller->$action();
//		$this->assertEquals('success', $result);
//		$action = 'getAnswerByID';
//		$result = $controller->$action($_POST['aid']);
//		$this->assertEquals(NULL, $result);	
//		$variables = array();
//	}
//	
//
//	function testDeleteAnswerInvalidUser(){
//		global $variables;
//		$_POST['aid'] = 1;
//		$controllerName = 'answers';
//		$action = 'deleteAnswer';
//		$controller = new AnswersController($controllerName);
//		$result = $controller->$action();
//		$this->assertEquals('invalidUser', $result);
//		$variables = array();
//	}

  
	function testEditAnswerSuccessfully(){
		global $variables;
		$_SESSION['uid'] = 'u1';
		$_POST['tid'] = 1;
		$_POST['title'] = 'testtitle';
		$_POST['details'] = 'testdetails';
		$_POST['scores'] = 10;
		$_POST['tags'] = 'tag1 tag2 tag3 tag4';
		$controllerName = 'answers';
		$action = 'editAnswer';
		$controller = new AnswersController($controllerName);
		$result = $controller->$action();
		$this->assertEquals('success', $result);


		$action = 'show';
		$result	= $controller->$action();
		$this->assertEquals('success', $result);
		$this->assertEquals(1, $variables['answerinfo']['Answer']['tid']);	
		$this->assertEquals('u1', $variables['answerinfo']['Answer']['uid']);	
		$this->assertEquals('testtitle', $variables['answerinfo']['Answer']['title']);	
		$this->assertEquals('testdetails', $variables['answerinfo']['Answer']['details']);	
		$this->assertEquals(10, $variables['answerinfo']['Answer']['scores']);	
		$this->assertEquals(1, $variables['answerinfo']['Answer']['active']);	
		/*then test user info who post this answer*/
		$this->assertEquals('u1', $variables['userinfo']['User']['uid']);	
		$this->assertEquals('u1', $variables['userinfo']['User']['uname']);	

		/*test answers related to this answer*/
		$this->assertEquals(1, $variables['answers'][0]['Answer']['aid']);
		$this->assertEquals('answer1details', $variables['answers'][0]['Answer']['details']);
		$this->assertEquals('2013-11-15 12:00:00', $variables['answers'][0]['Answer']['time']);
		$this->assertEquals('u1', $variables['answers'][0]['User']['uid']);
		$this->assertEquals('u1', $variables['answers'][0]['User']['uname']);

		$this->assertEquals(2, $variables['answers'][1]['Answer']['aid']);
		$this->assertEquals('answer2details', $variables['answers'][1]['Answer']['details']);
		$this->assertEquals('2013-11-15 12:45:00', $variables['answers'][1]['Answer']['time']);
		$this->assertEquals('u2', $variables['answers'][1]['User']['uid']);
		$this->assertEquals('u2', $variables['answers'][1]['User']['uname']);
		$this->assertEquals('success', $result);

		/*test tags related to this answer*/
		$this->assertEquals('tag1', $variables['tags'][0]['Tag']['tname']);
		$this->assertEquals('tag2', $variables['tags'][1]['Tag']['tname']);
		$this->assertEquals('tag3', $variables['tags'][2]['Tag']['tname']);
		$this->assertEquals('tag4', $variables['tags'][3]['Tag']['tname']);

		$_POST['tid'] = 1;
		$_POST['title'] = 'answer1';
		$_POST['details'] = 'details1';
		$_POST['scores'] = 20;
		$_POST['tags'] = 'tag1 tag2';
		$action = 'editAnswer';
		$result = $controller->$action();

		$this->assertEquals('success', $result);
		$variables = array();
	}


	function testEditAnswerInvalidUser(){
		global $variables;
		$_POST['tid'] = 1;
		$_POST['title'] = 'testtitle';
		$_POST['details'] = 'testdetails';
		$_POST['scores'] = 10;
		$_POST['tags'] = 'tag1 tag2 tag3 tag4';
		$controllerName = 'answers';
		$action = 'editAnswer';
		$controller = new AnswersController($controllerName);
		$result = $controller->$action();
		$this->assertEquals('invalidUser', $result);
		$variables = array();

		$_SESSION['uid'] = 'u2';
		$_POST['tid'] = 1;
		$_POST['title'] = 'testtitle';
		$_POST['details'] = 'testdetails';
		$_POST['scores'] = 10;
		$_POST['tags'] = 'tag1 tag2 tag3 tag4';
		$controllerName = 'answers';
		$action = 'editAnswer';
		$result = $controller->$action();
		$this->assertEquals('invalidUser', $result);
		$variables = array();
	}


//	function testGetAnswerByIDSuccessfully(){
//		$controllerName = 'answers';
//		$action = 'getAnswerByID';
//		$controller = new AnswersController($controllerName);
//		$result = $controller->$action(1);
//		$this->assertEquals(1, $result['Answer']['tid']);	
//		$this->assertEquals('u1', $result['Answer']['uid']);	
//		$this->assertEquals('answer1', $result['Answer']['title']);	
//		$this->assertEquals('details1', $result['Answer']['details']);	
//		$this->assertEquals('2013-11-14 09:40:00', $result['Answer']['time']);	
//		$this->assertEquals(20, $result['Answer']['scores']);	
//		$this->assertEquals(1, $result['Answer']['active']);	
//	}	
//
//	/*
//	  Test getAnswerByID when answer does not exist
//	*/
//	function testGetAnswerByIDNoAnswer(){
//		$controllerName = 'answers';
//		$action = 'getAnswerByID';
//		$controller = new AnswersController($controllerName);
//		$result = $controller->$action(-1);
//		$this->assertEquals(NULL, $result);	
//	}
//
//	/*
//	  Test show function. Show is a function which fill variables with all infomation related to a answer, and template will use these variables to generate html file
//	*/
//	function testShowSuccessfully(){
//		global $variables;
//		$_POST['tid'] = 1;
//		$controllerName = 'answers';
//		$action = 'show';
//		$controller = new AnswersController($controllerName);
//		$result	= $controller->$action();
//		$this->assertEquals(1, $variables['answerinfo']['Answer']['tid']);	
//		$this->assertEquals('u1', $variables['answerinfo']['Answer']['uid']);	
//		$this->assertEquals('answer1', $variables['answerinfo']['Answer']['title']);	
//		$this->assertEquals('details1', $variables['answerinfo']['Answer']['details']);	
//		$this->assertEquals('2013-11-14 09:40:00', $variables['answerinfo']['Answer']['time']);	
//		$this->assertEquals(20, $variables['answerinfo']['Answer']['scores']);	
//		$this->assertEquals(1, $variables['answerinfo']['Answer']['active']);	
//		/*then test user info who post this answer*/
//		$this->assertEquals('u1', $variables['userinfo']['User']['uid']);	
//		$this->assertEquals('u1', $variables['userinfo']['User']['uname']);	
//
//		/*test answers related to this answer*/
//		$this->assertEquals(1, $variables['answers'][0]['Answer']['aid']);
//		$this->assertEquals('answer1details', $variables['answers'][0]['Answer']['details']);
//		$this->assertEquals('2013-11-15 12:00:00', $variables['answers'][0]['Answer']['time']);
//		$this->assertEquals('u1', $variables['answers'][0]['User']['uid']);
//		$this->assertEquals('u1', $variables['answers'][0]['User']['uname']);
//
//		$this->assertEquals(2, $variables['answers'][1]['Answer']['aid']);
//		$this->assertEquals('answer2details', $variables['answers'][1]['Answer']['details']);
//		$this->assertEquals('2013-11-15 12:45:00', $variables['answers'][1]['Answer']['time']);
//		$this->assertEquals('u2', $variables['answers'][1]['User']['uid']);
//		$this->assertEquals('u2', $variables['answers'][1]['User']['uname']);
//		$this->assertEquals('success', $result);
//
//		/*test tags related to this answer*/
//		$this->assertEquals('tag1', $variables['tags'][0]['Tag']['tname']);
//		$this->assertEquals('tag2', $variables['tags'][1]['Tag']['tname']);
//		$variables = array();
//	}
//
//	/*
//	  Test show when answer does not exist
//	*/
//	function testShowNoAnswer(){
//		global $variables;
//		$_POST['tid'] = 3;
//		$controllerName = 'answers';
//		$action = 'show';
//		$controller = new AnswersController($controllerName);
//		$result	= $controller->$action();
//		$this->assertEquals('fail', $result);
//		$variables = array();
//	}
//
//	/*
//	  Test getAnswersByUserid successfully
//	*/
//	function testGetAnswersByUseridSuccessfully(){
//		global $variables;
//		$_POST['uid'] = 'u1';
//		$controllerName = 'answers';
//		$action = 'getAnswersByUserid';
//		$controller = new AnswersController($controllerName);
//		$result = $controller->$action();
//		$this->assertEquals('success', $result);
//		$this->assertEquals(1, $variables[0]['Answer']['tid']);
//		$this->assertEquals('u1', $variables[0]['Answer']['uid']);
//		$this->assertEquals('answer1', $variables[0]['Answer']['title']);
//		$this->assertEquals('details1', $variables[0]['Answer']['details']);
//		$this->assertEquals('2013-11-14 09:40:00', $variables[0]['Answer']['time']);
//		$this->assertEquals(20, $variables[0]['Answer']['scores']);
//		$this->assertEquals(1, $variables[0]['Answer']['active']);
//		$variables = array();
//	}
//
//
//	function testGetAnswersbyUseridNoAnswer(){
//		global $variables;
//		$_POST['uid'] = 'u3';
//		$controllerName = 'answers';
//		$action = 'getAnswersByUserid';
//		$controller = new AnswersController($controllerName);
//		$result = $controller->$action();
//		$this->assertEquals('fail', $result);
//		$variables = array();
//	}
//
//
//	function testGetAnswersbyUseridNoUser(){
//		global $variables;
//		$_POST['uid'] = '-1';
//		$controllerName = 'answers';
//		$action = 'getAnswersByUserid';
//		$controller = new AnswersController($controllerName);
//		$result = $controller->$action();
//		$this->assertEquals('fail', $result);
//		$variables = array();
//	}
//
	/*
	  Test function which returns hottest answers of different type including month, week and day, determined by a parameter type.
	*/
	//function testGetHottestAnswersByType(){
	//	global $variables;
	//	$controllerName = 'answers';
	//	$action = 'getHottestAnswersByType';
	//	$controller = new AnswersController($controllerName);
	//	$result = $controller->$action('Month');
	//	$this->assertEquals(1, $result[0]['Answer']['tid']);
	//	$this->assertEquals(2, $result[1]['Answer']['tid']);
	//	$result = $controller->$action('Week');
	//	$this->assertEquals(1, $result[0]['Answer']['tid']);
	//	$this->assertEquals(2, $result[1]['Answer']['tid']);
	//	$result = $controller->$action('Day');
	//	$this->assertEquals(1, $result[0]['Answer']['tid']);
	//	$this->assertEquals(2, $result[1]['Answer']['tid']);
	//	$variables = array();
	//}
}
