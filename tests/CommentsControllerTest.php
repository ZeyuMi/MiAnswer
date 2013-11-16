<?php
define('SERVER_ROOT', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);
include '../config/config.php';
include '../library/controller.class.php';
include '../application/controllers/commentscontroller.class.php';
include '../library/sqlquery.class.php';
include '../library/model.class.php';
include '../application/models/comment.class.php';
include '../library/template.class.php';
$variables = array();
class CommentsControllerTest extends PHPUnit_Framework_TestCase{


	function testPostCommentSuccessfully(){
		global $variables;
		$_SESSION['uid'] = 'u1';
		$_POST['aid'] = 1;
		$_POST['details'] = 'testdetails';
		$controllerName = 'comments';
		$action = 'postComment';
		$controller = new CommentsController($controllerName);
		$result = $controller->$action();
		$this->assertEquals('success', $result);
		$this->assertEquals('u1', $variables['commentinfo']['Comment']['uid']);	
		$this->assertEquals(1, $variables['commentinfo']['Comment']['aid']);	
		$this->assertEquals('testdetails', $variables['commentinfo']['Comment']['details']);	
		$action = 'deleteComment';
		$_POST['cid'] = $variables['commentinfo']['Comment']['cid'];
		$controller->$action();
		$variables = array();
	}


	function testPostCommentInvalidUser(){
		$_POST['aid'] = 1;
		$_POST['details'] = 'testdetails';
		$controllerName = 'comments';
		$action = 'postComment';
		$controller = new CommentsController($controllerName);
		$result = $controller->$action();
		$this->assertEquals('invalidUser', $result);
	}


	function testDeleteCommentSuccessfully(){
		global $variables;
		$_SESSION['uid'] = 'u1';
		$_POST['aid'] = 1;
		$_POST['details'] = 'testdetails';
		$controllerName = 'comments';
		$action = 'postComment';
		$controller = new CommentsController($controllerName);
		$result = $controller->$action();
		$this->assertEquals('success', $result);
		$this->assertEquals('u1', $variables['commentinfo']['Comment']['uid']);	
		$this->assertEquals(1, $variables['commentinfo']['Comment']['aid']);	
		$this->assertEquals('testdetails', $variables['commentinfo']['Comment']['details']);	
		$action = 'deleteComment';
		$_POST['cid'] = $variables['commentinfo']['Comment']['cid'];
		$result = $controller->$action();
		$this->assertEquals('success', $result);
		$action = 'getCommentByID';
		$result = $controller->$action($_POST['cid']);
		$this->assertEquals(NULL, $result);	
		$variables = array();
	}
	

	function testDeleteCommentInvalidUser(){
		global $variables;
		$_POST['cid'] = 1;
		$controllerName = 'comments';
		$action = 'deleteComment';
		$controller = new CommentsController($controllerName);
		$result = $controller->$action();
		$this->assertEquals('invalidUser', $result);
		$variables = array();


		$_SESSION['uid'] = 'u1';
		$_POST['cid'] = 2;
		$result = $controller->$action();
		$this->assertEquals('invalidUser', $result);
		$variables = array();
	}


	function testGetCommentByIDSuccessfully(){
		$controllerName = 'comments';
		$action = 'getCommentByID';
		$controller = new CommentsController($controllerName);
		$result = $controller->$action(1);
		$this->assertEquals(1, $result['Comment']['cid']);	
		$this->assertEquals('u3', $result['Comment']['uid']);	
		$this->assertEquals('comment1', $result['Comment']['details']);	
		$this->assertEquals('2013-11-16 12:00:00', $result['Comment']['time']);	
	}	

	/*
	  Test getCommentByID when comment does not exist
	*/
	function testGetCommentByIDNoComment(){
		$controllerName = 'comments';
		$action = 'getCommentByID';
		$controller = new CommentsController($controllerName);
		$result = $controller->$action(-1);
		$this->assertEquals(NULL, $result);	
	}

	function testGetCommentsSuccessfully(){
		global $variables;
		$_POST['aid'] = 1;
		$controllerName = 'comments';
		$action = 'getComments';
		$controller = new CommentsController($controllerName);
		$result	= $controller->$action();
		$this->assertEquals('u3', $variables['comments'][1]['User']['uid']);
		$this->assertEquals('u3', $variables['comments'][1]['User']['uname']);
		$this->assertEquals(1, $variables['comments'][1]['Comment']['cid']);
		$this->assertEquals('u3', $variables['comments'][1]['Comment']['uid']);
		$this->assertEquals(1, $variables['comments'][1]['Comment']['aid']);
		$this->assertEquals('comment1', $variables['comments'][1]['Comment']['details']);	
		$this->assertEquals('2013-11-16 12:00:00', $variables['comments'][1]['Comment']['time']);	

		$this->assertEquals('u2', $variables['comments'][0]['User']['uid']);
		$this->assertEquals('u2', $variables['comments'][0]['User']['uname']);
		$this->assertEquals(3, $variables['comments'][0]['Comment']['cid']);
		$this->assertEquals('u2', $variables['comments'][0]['Comment']['uid']);
		$this->assertEquals(1, $variables['comments'][0]['Comment']['aid']);
		$this->assertEquals('comment3', $variables['comments'][0]['Comment']['details']);	
		$this->assertEquals('2013-11-16 21:00:00', $variables['comments'][0]['Comment']['time']);	
		
		$this->assertEquals('u3', $variables['comments'][2]['User']['uid']);
		$this->assertEquals('u3', $variables['comments'][2]['User']['uname']);
		$this->assertEquals(4, $variables['comments'][2]['Comment']['cid']);
		$this->assertEquals('u3', $variables['comments'][2]['Comment']['uid']);
		$this->assertEquals(1, $variables['comments'][2]['Comment']['aid']);
		$this->assertEquals('comment4', $variables['comments'][2]['Comment']['details']);	
		$this->assertEquals('2013-11-15 14:00:00', $variables['comments'][2]['Comment']['time']);	
		$variables = array();
	}

	/*
	  Test show when comment does not exist
	*/
	function testGetCommentsNoComment(){
		global $variables;
		$_POST['aid'] = -1;
		$controllerName = 'comments';
		$action = 'getComments';
		$controller = new CommentsController($controllerName);
		$result	= $controller->$action();
		$this->assertEquals(0, count($variables));
		$this->assertEquals('success', $result);
		$variables = array();
	}
	
	/*
	  Test function which returns hottest comments of different type including month, week and day, determined by a parameter type.
	*/
	//function testGetHottestCommentsByType(){
	//	global $variables;
	//	$controllerName = 'comments';
	//	$action = 'getHottestCommentsByType';
	//	$controller = new CommentsController($controllerName);
	//	$result = $controller->$action('Month');
	//	$this->assertEquals(1, $result[0]['Comment']['aid']);
	//	$this->assertEquals(2, $result[1]['Comment']['aid']);
	//	$result = $controller->$action('Week');
	//	$this->assertEquals(1, $result[0]['Comment']['aid']);
	//	$this->assertEquals(2, $result[1]['Comment']['aid']);
	//	$result = $controller->$action('Day');
	//	$this->assertEquals(1, $result[0]['Comment']['aid']);
	//	$this->assertEquals(2, $result[1]['Comment']['aid']);
	//	$variables = array();
	//}
}
