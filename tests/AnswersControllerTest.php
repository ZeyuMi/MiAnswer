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


	function testPostAnswerSuccessfully(){
		global $variables;
		$_SESSION['uid'] = 'u1';
		$_POST['tid'] = 1;
		$_POST['details'] = 'testdetails';
		$controllerName = 'answers';
		$action = 'postAnswer';
		$controller = new AnswersController($controllerName);
		$result = $controller->$action();
		$this->assertEquals('success', $result);
		$this->assertEquals('u1', $variables['answerinfo']['Answer']['uid']);	
		$this->assertEquals(1, $variables['answerinfo']['Answer']['tid']);	
		$this->assertEquals('testdetails', $variables['answerinfo']['Answer']['details']);	
		$this->assertEquals(0, $variables['answerinfo']['Answer']['accept']);	
		$action = 'deleteAnswer';
		$_POST['aid'] = $variables['answerinfo']['Answer']['aid'];
		$controller->$action();
		$variables = array();
	}


	function testPostAnswerInvalidUser(){
		$_POST['tid'] = 1;
		$_POST['details'] = 'testdetails';
		$controllerName = 'answers';
		$action = 'postAnswer';
		$controller = new AnswersController($controllerName);
		$result = $controller->$action();
		$this->assertEquals('invalidUser', $result);
	}


	function testDeleteAnswerSuccessfully(){
		global $variables;
		$_SESSION['uid'] = 'u1';
		$_POST['tid'] = 1;
		$_POST['details'] = 'testdetails';
		$controllerName = 'answers';
		$action = 'postAnswer';
		$controller = new AnswersController($controllerName);
		$result = $controller->$action();
		$this->assertEquals('success', $result);
		$this->assertEquals('u1', $variables['answerinfo']['Answer']['uid']);	
		$this->assertEquals(1, $variables['answerinfo']['Answer']['tid']);	
		$this->assertEquals('testdetails', $variables['answerinfo']['Answer']['details']);	
		$this->assertEquals(0, $variables['answerinfo']['Answer']['accept']);	
		$action = 'deleteAnswer';
		$_POST['aid'] = $variables['answerinfo']['Answer']['aid'];
		$result = $controller->$action();
		$this->assertEquals('success', $result);
		$action = 'getAnswerByID';
		$result = $controller->$action($_POST['aid']);
		$this->assertEquals(NULL, $result);	
		$variables = array();
	}
	

	function testDeleteAnswerInvalidUser(){
		global $variables;
		$_POST['aid'] = 1;
		$controllerName = 'answers';
		$action = 'deleteAnswer';
		$controller = new AnswersController($controllerName);
		$result = $controller->$action();
		$this->assertEquals('invalidUser', $result);
		$variables = array();


		$_SESSION['uid'] = 'u1';
		$_POST['aid'] = 2;
		$result = $controller->$action();
		$this->assertEquals('invalidUser', $result);
		$variables = array();
	}


	function testEditAnswerSuccessfully(){
		global $variables;
		$_SESSION['uid'] = 'u1';
		$_POST['aid'] = 1;
		$_POST['details'] = 'testdetails';
		$controllerName = 'answers';
		$action = 'editAnswer';
		$controller = new AnswersController($controllerName);
		$result = $controller->$action();
		$this->assertEquals('success', $result);

		$action = 'show';
		$result	= $controller->$action();
		$this->assertEquals('success', $result);
		$this->assertEquals(1, $variables['answerinfo']['Answer']['tid']);	
		$this->assertEquals(1, $variables['answerinfo']['Answer']['aid']);	
		$this->assertEquals('u1', $variables['answerinfo']['Answer']['uid']);	
		$this->assertEquals('testdetails', $variables['answerinfo']['Answer']['details']);	
		$this->assertEquals(0, $variables['answerinfo']['Answer']['accept']);	
		$this->assertEquals(1, $variables['commentnum']);
		/*then test user info who post this answer*/
		$this->assertEquals('u1', $variables['userinfo']['User']['uid']);	
		$this->assertEquals('u1', $variables['userinfo']['User']['uname']);	

		$_POST['aid'] = 1;
		$_POST['details'] = 'answer1details';
		$action = 'editAnswer';
		$result = $controller->$action();

		$this->assertEquals('success', $result);
		$variables = array();
	}


	function testEditAnswerInvalidUser(){
		global $variables;
		$_POST['aid'] = 1;
		$_POST['details'] = 'testdetails';
		$controllerName = 'answers';
		$action = 'editAnswer';
		$controller = new AnswersController($controllerName);
		$result = $controller->$action();
		$this->assertEquals('invalidUser', $result);
		$variables = array();

		$_SESSION['uid'] = 'u2';
		$_POST['aid'] = 1;
		$_POST['details'] = 'testdetails';
		$controllerName = 'answers';
		$action = 'editAnswer';
		$result = $controller->$action();
		$this->assertEquals('invalidUser', $result);
		$variables = array();
	}


	function testGetAnswerByIDSuccessfully(){
		$controllerName = 'answers';
		$action = 'getAnswerByID';
		$controller = new AnswersController($controllerName);
		$result = $controller->$action(1);
		$this->assertEquals(1, $result['Answer']['aid']);	
		$this->assertEquals('u1', $result['Answer']['uid']);	
		$this->assertEquals('answer1details', $result['Answer']['details']);	
		$this->assertEquals('2013-11-15 12:00:00', $result['Answer']['time']);	
		$this->assertEquals(0, $result['Answer']['accept']);	
	}	

	/*
	  Test getAnswerByID when answer does not exist
	*/
	function testGetAnswerByIDNoAnswer(){
		$controllerName = 'answers';
		$action = 'getAnswerByID';
		$controller = new AnswersController($controllerName);
		$result = $controller->$action(-1);
		$this->assertEquals(NULL, $result);	
	}

	/*
	  Test show function. Show is a function which fill variables with all infomation related to a answer, and template will use these variables to generate html file
	*/
	function testShowSuccessfully(){
		global $variables;
		$_POST['aid'] = 1;
		$controllerName = 'answers';
		$action = 'show';
		$controller = new AnswersController($controllerName);
		$result	= $controller->$action();
		$this->assertEquals(1, $variables['answerinfo']['Answer']['aid']);	
		$this->assertEquals('u1', $variables['answerinfo']['Answer']['uid']);	
		$this->assertEquals('answer1details', $variables['answerinfo']['Answer']['details']);	
		$this->assertEquals('2013-11-15 12:00:00', $variables['answerinfo']['Answer']['time']);	
		$this->assertEquals(0, $variables['answerinfo']['Answer']['accept']);	
		/*then test user info who post this answer*/
		$this->assertEquals('u1', $variables['userinfo']['User']['uid']);	
		$this->assertEquals('u1', $variables['userinfo']['User']['uname']);	

		$this->assertEquals(1, $variables['commentnum']);
		$variables = array();
	}

	/*
	  Test show when answer does not exist
	*/
	function testShowNoAnswer(){
		global $variables;
		$_POST['aid'] = -1;
		$controllerName = 'answers';
		$action = 'show';
		$controller = new AnswersController($controllerName);
		$result	= $controller->$action();
		$this->assertEquals('fail', $result);
		$variables = array();
	}

  /*
    Test getAnswersByUserid successfully
  */
	function testGetAnswersByUseridSuccessfully(){
		global $variables;
		$_POST['uid'] = 'u1';
		$controllerName = 'answers';
		$action = 'getAnswersByUserid';
		$controller = new AnswersController($controllerName);
		$result = $controller->$action();
		$this->assertEquals('success', $result);
		$this->assertEquals(1, $variables[0]['Answer']['aid']);
		$this->assertEquals('u1', $variables[0]['Answer']['uid']);
		$this->assertEquals('answer1details', $variables[0]['Answer']['details']);
		$this->assertEquals('2013-11-15 12:00:00', $variables[0]['Answer']['time']);
		$this->assertEquals(0, $variables[0]['Answer']['accept']);
		$variables = array();
	}


	function testGetAnswersbyUseridNoAnswer(){
		global $variables;
		$_POST['uid'] = 'u4';
		$controllerName = 'answers';
		$action = 'getAnswersByUserid';
		$controller = new AnswersController($controllerName);
		$result = $controller->$action();
		$this->assertEquals('fail', $result);
		$variables = array();
	}


	function testGetAnswersbyUseridNoUser(){
		global $variables;
		$_POST['uid'] = '-1';
		$controllerName = 'answers';
		$action = 'getAnswersByUserid';
		$controller = new AnswersController($controllerName);
		$result = $controller->$action();
		$this->assertEquals('fail', $result);
		$variables = array();
	}


	
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
