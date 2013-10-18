<?php

class UsersController extends Controller{

	function login(){
		$sql = "select uname from users where uid='" . $_GET['id'] . "';";
		$result = $this->User->query($sql,1);
		$this->set('name', $result['User']['uname']);
	}

}
