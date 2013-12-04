<?php

class UsersController extends Controller{

	/**
	* check if a user exists with the password passed in
	**/
	function checkIdty(){
		$userid = $_POST['uid'];
		$password = $_POST['password'];
		$result = $this->validate($userid, $password);
		if($result)
			return 'success';
		else
			return 'fail';	
	}

	
	function login(){
		global $variables;
		$values = array();	
		$result = $this->validate($_POST['uid'], $_POST['password']);
		if($result){
			$result =$this->personalInfo($_POST['uid']);
			$variables['uname'] = $result['User']['uname'];
			$_SESSION['uid'] = $result['User']['uid'];
			$_SESSION['uname'] = $result['User']['uname'];
			$_SESSION['description'] = $result['User']['description'];
			$_SESSION['scores'] = $result['User']['scores'];
			return 'redirect';
		}else{
			$_SESSION['type'] = 'error';
			return 'fail';
		}
	}

	/**
	* return all the info related this user
	* including personal info, topics and answers
	**/
	function info(){
		global $variables;
		$userid = $_GET['uid'];
		$result = $this->personalInfo($userid);
		if(count($result) > 0){ // user exists
			$variables['userinfo'] = $result;
			//fetch topics related to this id
			$sql = "select tid, title, details, scores from topics where uid ='$userid';";
			$result = $this->User->query($sql);
			$variables['topics'] = $result;   // user has associated topics
			// next, fetch answers related to this id
			$sql = "select topic.tid, topic.title, answer.details from topics topic, answers answer where answer.tid = topic.tid and answer.uid = '$userid';";
			$result = $this->User->query($sql);
			$variables['answers'] = $result; // user has accociated answers
			return 'success';
		}else{
			$variables['errormessage'] = 'user does not exist.';
			return 'fail';
		}
	}

	/**
	* if the user has already existed, this function will fail
	**/
	function register(){
		global $variables;
		$userid = $_POST['uid'];
		$uname = $_POST['uname'];
		$password = $_POST['registerpassword'];
		$sql = "select * from users where uid='$userid';";
		$result = $this->User->query($sql);
		if(count($result) > 0)
			return 'fail';
		$sql = "insert into users(uid, uname, password) values('$userid', '$uname', '$password');";
		$this->User->query($sql);
		$_SESSION['uid'] = $userid;
		$_SESSION['uname'] = $uname;
		$_SESSION['description'] = "";
		$_SESSION['scores'] = 0;
		return 'redirect';
	}


	function logout(){
		unset($_SESSION['uid']);
		return 'redirect';
	}


	function editPersonalInfo(){
		$userNow = $_SESSION['uid'];
		$userid = $_POST['uid'];
		$uname = $_POST['uname'];
		$password = $_POST['password'];
		$description = $_POST['description'];
		$result = $this->exist($userid);
		if($result && ($userNow == $userid)){
			$sql = "update users set uname='$uname', password='$password', description='$description' where uid='$userid';";
			$this->User->query($sql);
			return 'success';
		}else{
			return 'fail';
		}
	}

	function exist($userid){
		$sql = "select uname from users where uid='$userid';";
		$result = $this->User->query($sql,1);
		if(count($result)> 0){
			return True;
		}else{
			return False;
		}
	}

	function validate($userid, $password){
		$sql = "select uname from users where uid='$userid' and password='$password';";
		$result = $this->User->query($sql,1);
		if(count($result)> 0){
			return True;
		}else{
			return False;
		}
	}
	
	function personalInfo($userid){
		$sql = "select uid, uname, description, bigimage,  password, scores, level from users where uid='$userid';";
		$result = $this->User->query($sql,1);
		return $result;
	}

}
