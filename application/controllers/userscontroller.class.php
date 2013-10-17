<?php

class UsersController extends Controller{

	function login($userid, $password){
		$sql = "select uname from users where uid='$userid';";
		$result = $this->User->query($sql);
		print	$result[0]['User']['uname'];	
	}
}
