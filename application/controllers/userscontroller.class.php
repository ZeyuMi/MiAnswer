<?php

class UsersController extends Controller{

	function login($template){
		$sql = "select uname from users where uid='" . $_GET['uid'] . "';";
		$result = $this->User->query($sql,1);
		$template->set('name', $result['User']['uname']);
	}

	function fetchPersonalInfo($template){
		$userid = $_GET['uid'];
		$sql = "select uname, description, scores, level from users where uid='$userid';";
		$template->set('userinfo', $this->User->query($sql, 1));
	}

}
