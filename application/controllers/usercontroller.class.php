<?php

class UserController extends Controller{

	function login($userid, $password){
		$this->$_model->login($userid, $password);	
	}
}
