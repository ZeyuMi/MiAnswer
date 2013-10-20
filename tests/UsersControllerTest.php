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
		$this->assertEquals('1',$_SESSION['uid']);
		$this->assertEquals('test',$_SESSION['uname']);
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

//	/**
//	* Before run this test, make sure there is no record in table users with uid equaling to '4'
//	**/
//	function testRegisterSuccessfully(){
//		global $variables;
//		$_POST['uid'] = '4';
//		$_POST['password'] = 'test';
//		$_POST['uname'] = 'test';
//		$controllerName = 'users';
//		$action = "register";
//		$controller = new UsersController($controllerName,$action);
//		$result = $controller->$action();
//		$this->assertEquals('success', $result);	
//		
//		$_POST['uid']= '4';
//		$_POST['password'] = 'test';
//		$controllerName = 'users';
//		$action = 'login';
//		$controller = new UsersController($controllerName,$action);
//		$result = $controller->$action();
//		$this->assertEquals('test',$variables['uname']);
//		$this->assertEquals('success', $result);
//		$variables = array();
//	}

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

	function testValidateTrue(){
		$controllerName = 'users';
		$action = "validate";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action('1', 'test');
		$this->assertEquals(True, $result);	
	}

	function testValidateFalseNoUser(){
		$controllerName = 'users';
		$action = "validate";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action('-1','test');
		$this->assertEquals(False, $result);	
	}

	function testValidateFalseWrongPwd(){
		$controllerName = 'users';
		$action = "validate";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action('1','psw');
		$this->assertEquals(False, $result);	
	}

	function testPersonalInfoSuccessfully(){
		$controllerName = 'users';
		$action = "personalInfo";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action('1');
		$this->assertEquals('1', $result['User']['uid']);
		$this->assertEquals('test', $result['User']['uname']);
		$this->assertEquals('test', $result['User']['password']);
		$this->assertEquals('description', $result['User']['description']);
		$this->assertEquals('10', $result['User']['scores']);
		$this->assertEquals('0', $result['User']['level']);
	}

	function testPersonalInfoFailed(){
		$controllerName = 'users';
		$action = "personalInfo";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action('-1');
		$this->assertEquals(0, count($result));
	}

	function testCheckIdtySuccessfully(){
		$_POST['uid'] = '1';
		$_POST['password'] = 'test';
		$controllerName = 'users';
		$action = "checkIdty";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action();
		$this->assertEquals('success', $result);
	}

	function testCheckIdtyNoUser(){
		$_POST['uid'] = '-1';
		$_POST['password'] = 'test';
		$controllerName = 'users';
		$action = "checkIdty";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action();
		$this->assertEquals('fail', $result);
	}

	function testcheckIdtyWrongpsw(){
		$_POST['uid'] = '1';
		$_POST['password'] = 'test2';
		$controllername = 'users';
		$action = "checkIdty";
		$controller = new userscontroller($controllername,$action);
		$result = $controller->$action();
		$this->assertequals('fail', $result);
	}

	function testExistSuccessfully(){
		$controllername = 'users';
		$action = "exist";
		$controller = new userscontroller($controllername,$action);
		$result = $controller->$action('1');
		$this->assertequals(TRUE, $result);
	}

	function testExistFailed(){
		$controllername = 'users';
		$action = "exist";
		$controller = new userscontroller($controllername,$action);
		$result = $controller->$action('-1');
		$this->assertequals(FALSE, $result);
	}

	function testEditPersonalInfoSuccessfully(){
		$_SESSION['uid'] = '1';
		$_POST['uid'] = '1';
		$_POST['password'] = 'test2';
		$_POST['uname'] = 'test2';
		$_POST['description'] = 'description2';
		$controllerName = 'users';
		$action = "editPersonalInfo";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action();
		$this->assertEquals('success', $result);

		$controllerName = 'users';
		$action = "personalInfo";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action('1');
		$this->assertEquals('1', $result['User']['uid']);
		$this->assertEquals('test2', $result['User']['uname']);
		$this->assertEquals('test2', $result['User']['password']);
		$this->assertEquals('description2', $result['User']['description']);
		$this->assertEquals('10', $result['User']['scores']);

		$_SESSION['uid'] = '1';
		$_POST['uid'] = '1';
		$_POST['password'] = 'test';
		$_POST['uname'] = 'test';
		$_POST['description'] = 'description';
		$controllerName = 'users';
		$action = "editPersonalInfo";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action();
		$this->assertEquals('success', $result);

		$controllerName = 'users';
		$action = "personalInfo";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action('1');
		$this->assertEquals('1', $result['User']['uid']);
		$this->assertEquals('test', $result['User']['uname']);
		$this->assertEquals('test', $result['User']['password']);
		$this->assertEquals('description', $result['User']['description']);
		$this->assertEquals('10', $result['User']['scores']);
		$this->assertEquals('0', $result['User']['level']);
	}

	function testEditPersonalInfoNoUser(){
		$_SESSION['uid'] = '-1';
		$_POST['uid'] = '-1';
		$_POST['password'] = 'test2';
		$_POST['uname'] = 'test2';
		$_POST['description'] = 'description2';
		$controllerName = 'users';
		$action = "editPersonalInfo";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action();
		$this->assertEquals('fail', $result);
	}

	function testEditPersonalInfoWrongUser(){
		$_SESSION['uid'] = '2';
		$_POST['uid'] = '1';
		$_POST['password'] = 'test2';
		$_POST['uname'] = 'test2';
		$_POST['description'] = 'description2';
		$controllerName = 'users';
		$action = "editPersonalInfo";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action();
		$this->assertEquals('fail', $result);
	}

}
