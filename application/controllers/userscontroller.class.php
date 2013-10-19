<?php

class UsersController extends Controller{

	function signup(){

	}

	function login(){
		global $variables;	
		$sql = "select uname from users where uid='" . $_POST['uid'] . "' and password='" . $_POST['password'] . "';";
		$result = $this->User->query($sql,1);
		if(count($result)> 0){
			$variables['uname'] = $result['User']['uname'];
			return 'success';
		}else{
			$_SESSION['type'] = 'error';
			return 'fail';
		}
	}

	function info(){
		global $variables;
		$userid = $_GET['uid'];
		$sql = "select uname, description, scores, level from users where uid='$userid';";
		$result = $this->User->query($sql, 1);
		if(count($result) > 0){ // user exists
			$variables['userinfo'] = $result;
			//fetch topics related to this id
			$sql = "select title, details, scores from topics where uid ='$userid';";
			$result = $this->User->query($sql);
			$variables['topics'] = $result;   // user has associated topics
			// next, fetch answers related to this id
			$sql = "select topic.title, answer.details from topics topic, answers answer where answer.tid = topic.tid and answer.uid = '$userid';";
			$result = $this->User->query($sql);
			$variables['answers'] = $result; // user has accociated answers
			return 'success';
		}else{
			$variables['errormessage'] = 'user does not exist.';
			return 'fail';
		}
	}

	function register(){
		global $variables;
		$userid = $_POST['uid'];
		$uname = $_POST['uname'];
		$password = $_POST['password'];
		$sql = "select * from users where uid=$userid;";
		$result = $this->User->query($sql);
		if(count($result) > 0)
			return 'fail';
		$sql = "insert into users(uid, uname, password) values('$userid', '$uname', '$password');";
		$this->User->query($sql);
		return 'success';
	}
}
