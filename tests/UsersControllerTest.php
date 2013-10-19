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
$variables = array();
class UsersControllerTest extends PHPUnit_Framework_TestCase{
	function setUp(){
	}

	function testLoginSuccessfully(){
		global $variables;
		$_POST['uid']= '1';
		$_POST['password'] = 'test';
		$controllerName = 'users';
		$action = 'login';
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action();
		$this->assertEquals('test',$variables['uname']);
		$this->assertEquals('success', $result);
		$variables = array();
	}

	function testLoginFailed(){
		global $variables;
		$_POST['uid']= '-1';
		$_POST['password'] = 'test';
		$controllerName = 'users';
		$action = 'login';
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action();
		$this->assertEquals('fail', $result);

		$_POST['uid']= '1';
		$_POST['password'] = 'test2';
		$controllerName = 'users';
		$action = 'login';
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action();
		$this->assertEquals('fail', $result);
		$variables = array();

	}

	function testInfoSuccessfully(){
		global $variables;
		$_GET['uid'] = '1';
		$controllerName = 'users';
		$action = 'info';
		$controller = new UsersController($controllerName,$action);
		$result	= $controller->$action();
		$this->assertEquals('test', $variables['userinfo']['User']['uname']);
		$this->assertEquals('description', $variables['userinfo']['User']['description']);
		$this->assertEquals(10, $variables['userinfo']['User']['scores']);
		$this->assertEquals(0, $variables['userinfo']['User']['level']);
		$this->assertEquals('topic1title', $variables['topics'][0]['Topic']['title']);
		$this->assertEquals('topic1details', $variables['topics'][0]['Topic']['details']);
		$this->assertEquals(5, $variables['topics'][0]['Topic']['scores']);
		$this->assertEquals('topic1title', $variables['answers'][0]['Topic']['title']);
		$this->assertEquals('answer1details', $variables['answers'][0]['Answer']['details']);
		$this->assertEquals('success', $result);
		$variables = array();
	}

	function testInfoNoTopicsOrAnswer(){
		global $variables;
		$_GET['uid']= '2';
		$controllerName = 'users';
		$action = "info";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action();
		$this->assertEquals('test', $variables['userinfo']['User']['uname']);
		$this->assertEquals('description', $variables['userinfo']['User']['description']);
		$this->assertEquals(10, $variables['userinfo']['User']['scores']);
		$this->assertEquals(0, $variables['userinfo']['User']['level']);
		$this->assertEquals(count($variables['topics']), 0);
		$this->assertEquals(count($variables['answers']), 0);
		$this->assertEquals('success', $result);
		$variables = array();
	}

	function testInfoNoUser(){
		global $variables;
		$_GET['uid']= '3';
		$controllerName = 'users';
		$action = "info";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action();
		$this->assertEquals('fail', $result);
		$this->assertEquals('user does not exist.', $variables['errormessage']);
		$variables = array();

	}

	function testRegisterSuccessfully(){
		global $variables;
		$_POST['uid'] = '4';
		$_POST['password'] = 'test';
		$_POST['uname'] = 'test';
		$controllerName = 'users';
		$action = "register";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action();
		$this->assertEquals('success', $result);	
		
		$_POST['uid']= '4';
		$_POST['password'] = 'test';
		$controllerName = 'users';
		$action = 'login';
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action();
		$this->assertEquals('test',$variables['uname']);
		$this->assertEquals('success', $result);
		$variables = array();
	}

	function testRegisterFailed(){
		global $variables;
		$_POST['uid'] = '1';
		$_POST['password'] = 'test';
		$_POST['uname'] = 'test';
		$controllerName = 'users';
		$action = "register";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action();
		$this->assertEquals('fail', $result);	
		$variables = array();
	}
}
