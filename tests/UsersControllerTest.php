<?php
define('SERVER_ROOT', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);
include '../config/config.php';
include '../library/controller.class.php';
include '../application/controllers/userscontroller.class.php';
include '../library/sqlquery.class.php';
include '../library/model.class.php';
include '../application/models/user.class.php';
include '../library/template.class.php';

class UsersControllerTest extends PHPUnit_Framework_TestCase{
	function setUp(){
	}

	function testLoginSuccessfully(){
		$_GET['uid']= '1';
		$_GET['password'] = 'test';
		$controllerName = 'users';
		$action = 'login';
		$controller = new UsersController($controllerName,$action);
		$template = new Template($controllerName, $action);
		$controller->$action($template);
		$variables = PHPUnit_Framework_Assert::readAttribute($template, 'variables');
		$this->assertEquals('test',$variables['name']);
	}

	function testLoginFailed(){
		$_GET['uid']= '1';
		$_GET['password'] = 'test2';
		$controllerName = 'users';
		$action = 'login';
		$controller = new UsersController($controllerName,$action);
		$template = new Template($controllerName, $action);
		$controller->$action($template);
		$this->assertEquals('error', $_SESSION['type']);
	}

	function testFetchPersonalInfo(){
		$_GET['uid'] = '1';
		$controllerName = 'users';
		$action = 'fetchPersonalInfo';
		$controller = new UsersController($controllerName,$action);
		$template = new Template($controllerName, $action);
		$controller->$action($template);
		$variables = PHPUnit_Framework_Assert::readAttribute($template, 'variables');
		$this->assertEquals('test', $variables['User']['name']);
		$this->assertEquals('description', $variables['User']['description']);
		$this->assertEquals(10, $variables['User']['scores']);
		$this->assertEquals(0, $variables['User']['level']);
		$this->assertEquals('topic1title', $variables['topics'][0]['Topic']['title']);
		$this->assertEquals('topic1details', $variables['topics'][0]['Topic']['details']);
		$this->assertEquals(5, $variables['topics'][0]['Topic']['scores']);
		$this->assertEquals('answer1topictitle1', $variables['answers'][0]['Topic']['title']);
		$this->assertEquals('answer1details', $variables['answers'][0]['Answer']['details']);
	}
	
}
