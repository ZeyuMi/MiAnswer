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
		$_POST['uid']= 'u1';
		$_POST['password'] = 'u1';
		$controllerName = 'users';
		$action = 'login';
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action();
		$this->assertEquals('u1',$variables['uname']);
		$this->assertEquals('u1',$_SESSION['uid']);
		$this->assertEquals('u1',$_SESSION['uname']);
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

		$_POST['uid']= 'u1';
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
		$_GET['uid'] = 'u1';
		$controllerName = 'users';
		$action = 'info';
		$controller = new UsersController($controllerName,$action);
		$result	= $controller->$action();
		$this->assertEquals('u1', $variables['userinfo']['User']['uname']);
		$this->assertEquals('description1', $variables['userinfo']['User']['description']);
		$this->assertEquals('5', $variables['userinfo']['User']['scores']);
		$this->assertEquals('1', $variables['userinfo']['User']['level']);
		$this->assertEquals('topic1', $variables['topics'][0]['Topic']['title']);
		$this->assertEquals('details1', $variables['topics'][0]['Topic']['details']);
		$this->assertEquals('20', $variables['topics'][0]['Topic']['scores']);
		$this->assertEquals('topic1', $variables['answers'][0]['Topic']['title']);
		$this->assertEquals('answer1details', $variables['answers'][0]['Answer']['details']);
		$this->assertEquals('success', $result);
		$variables = array();
	}

	function testInfoNoTopicsOrAnswer(){
		global $variables;
		$_GET['uid']= 'u4';
		$controllerName = 'users';
		$action = "info";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action();
		$this->assertEquals('u4', $variables['userinfo']['User']['uname']);
		$this->assertEquals('description4', $variables['userinfo']['User']['description']);
		$this->assertEquals('5', $variables['userinfo']['User']['scores']);
		$this->assertEquals('1', $variables['userinfo']['User']['level']);
		$this->assertEquals(count($variables['topics']), 0);
		$this->assertEquals(count($variables['answers']), 0);
		$this->assertEquals('success', $result);
		$variables = array();
	}

	function testInfoNoUser(){
		global $variables;
		$_GET['uid']= '-1';
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
//		$_POST['uid'] = 'u5';
//		$_POST['password'] = 'u5';
//		$_POST['uname'] = 'u5';
//		$controllerName = 'users';
//		$action = "register";
//		$controller = new UsersController($controllerName,$action);
//		$result = $controller->$action();
//		$this->assertEquals('success', $result);	
//		
//		$_POST['uid']= 'u5';
//		$_POST['password'] = 'u5';
//		$controllerName = 'users';
//		$action = 'login';
//		$controller = new UsersController($controllerName,$action);
//		$result = $controller->$action();
//		$this->assertEquals('u5',$variables['uname']);
//		$this->assertEquals('success', $result);
//		$variables = array();
//	}

	function testRegisterFailed(){
		global $variables;
		$_POST['uid'] = 'u1';
		$_POST['password'] = 'u1';
		$_POST['uname'] = 'u1';
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
		$result = $controller->$action('u1', 'u1');
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
		$result = $controller->$action('u1','psw');
		$this->assertEquals(False, $result);	
	}

	function testPersonalInfoSuccessfully(){
		$controllerName = 'users';
		$action = "personalInfo";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action('u1');
		$this->assertEquals('u1', $result['User']['uid']);
		$this->assertEquals('u1', $result['User']['uname']);
		$this->assertEquals('u1', $result['User']['password']);
		$this->assertEquals('description1', $result['User']['description']);
		$this->assertEquals('5', $result['User']['scores']);
		$this->assertEquals('1', $result['User']['level']);
	}

	function testPersonalInfoFailed(){
		$controllerName = 'users';
		$action = "personalInfo";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action('-1');
		$this->assertEquals(0, count($result));
	}

	function testCheckIdtySuccessfully(){
		$_POST['uid'] = 'u1';
		$_POST['password'] = 'u1';
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
		$_POST['uid'] = 'u1';
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
		$result = $controller->$action('u1');
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
		$_SESSION['uid'] = 'u1';
		$_POST['uid'] = 'u1';
		$_POST['password'] = 'u1edit';
		$_POST['uname'] = 'u1edit';
		$_POST['description'] = 'description1edit';
		$controllerName = 'users';
		$action = "editPersonalInfo";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action();
		$this->assertEquals('success', $result);

		$controllerName = 'users';
		$action = "personalInfo";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action('u1');
		$this->assertEquals('u1', $result['User']['uid']);
		$this->assertEquals('u1edit', $result['User']['uname']);
		$this->assertEquals('u1edit', $result['User']['password']);
		$this->assertEquals('description1edit', $result['User']['description']);
		$this->assertEquals('5', $result['User']['scores']);

		$_SESSION['uid'] = 'u1';
		$_POST['uid'] = 'u1';
		$_POST['password'] = 'u1';
		$_POST['uname'] = 'u1';
		$_POST['description'] = 'description1';
		$controllerName = 'users';
		$action = "editPersonalInfo";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action();
		$this->assertEquals('success', $result);

		$controllerName = 'users';
		$action = "personalInfo";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action('u1');
		$this->assertEquals('u1', $result['User']['uid']);
		$this->assertEquals('u1', $result['User']['uname']);
		$this->assertEquals('u1', $result['User']['password']);
		$this->assertEquals('description1', $result['User']['description']);
		$this->assertEquals('5', $result['User']['scores']);
		$this->assertEquals('1', $result['User']['level']);
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
		$_SESSION['uid'] = 'u1';
		$_POST['uid'] = 'u2';
		$_POST['password'] = 'u2';
		$_POST['uname'] = 'u2';
		$_POST['description'] = 'description2';
		$controllerName = 'users';
		$action = "editPersonalInfo";
		$controller = new UsersController($controllerName,$action);
		$result = $controller->$action();
		$this->assertEquals('fail', $result);
	}

}
