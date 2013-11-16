<?php
define('SERVER_ROOT', dirname(dirname(__FILE__)));
define('DS', DIRECTORY_SEPARATOR);
include '../config/config.php';
include '../library/controller.class.php';
include '../application/controllers/tagscontroller.class.php';
include '../library/sqlquery.class.php';
include '../library/model.class.php';
include '../application/models/tag.class.php';
include '../library/template.class.php';
$variables = array();
class TagsControllerTest extends PHPUnit_Framework_TestCase{


	function testShowSuccessfully(){
		global $variables;
		$_POST['tagid'] = 1;
		$controllerName = 'tags';
		$action = 'show';
		$controller = new TagsController($controllerName);
		$result	= $controller->$action();
		$this->assertEquals(1, $variables['taginfo']['Tag']['tagid']);
		$this->assertEquals('tag1', $variables['taginfo']['Tag']['tname']);
		$this->assertEquals('u1', $variables['topics'][0]['User']['uid']);
		$this->assertEquals('u1', $variables['topics'][0]['User']['uname']);
		$this->assertEquals(1, $variables['topics'][0]['Topic']['tid']);
		$this->assertEquals('u1', $variables['topics'][0]['Topic']['uid']);
		$this->assertEquals('topic1', $variables['topics'][0]['Topic']['title']);
		$this->assertEquals('details1', $variables['topics'][0]['Topic']['details']);	
		$this->assertEquals('2013-11-14 09:40:00', $variables['topics'][0]['Topic']['time']);	
		$this->assertEquals(20, $variables['topics'][0]['Topic']['scores']);	
		$this->assertEquals(1, $variables['topics'][0]['Topic']['active']);	

		$this->assertEquals('u2', $variables['topics'][1]['User']['uid']);
		$this->assertEquals('u2', $variables['topics'][1]['User']['uname']);
		$this->assertEquals(2, $variables['topics'][1]['Topic']['tid']);
		$this->assertEquals('u2', $variables['topics'][1]['Topic']['uid']);
		$this->assertEquals('topic2', $variables['topics'][1]['Topic']['title']);
		$this->assertEquals('details2', $variables['topics'][1]['Topic']['details']);	
		$this->assertEquals('2013-11-12 09:00:00', $variables['topics'][1]['Topic']['time']);	
		$this->assertEquals(30, $variables['topics'][1]['Topic']['scores']);	
		$this->assertEquals(0, $variables['topics'][1]['Topic']['active']);	

		$variables = array();
	}
	
	/*
	  Test function which returns hottest topics of different type including month, week and day, determined by a parameter type.
	*/
	//function testGetHottestTopicsByType(){
	//	global $variables;
	//	$controllerName = 'topics';
	//	$action = 'getHottestTopicsByType';
	//	$controller = new TopicsController($controllerName);
	//	$result = $controller->$action('Month');
	//	$this->assertEquals(1, $result[0]['Topic']['aid']);
	//	$this->assertEquals(2, $result[1]['Topic']['aid']);
	//	$result = $controller->$action('Week');
	//	$this->assertEquals(1, $result[0]['Topic']['aid']);
	//	$this->assertEquals(2, $result[1]['Topic']['aid']);
	//	$result = $controller->$action('Day');
	//	$this->assertEquals(1, $result[0]['Topic']['aid']);
	//	$this->assertEquals(2, $result[1]['Topic']['aid']);
	//	$variables = array();
	//}
}
