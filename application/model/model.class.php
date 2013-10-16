<?php

class Model extends SQLQuery{
	protected $_model;

	function __construct(){
		$this->connect(DB_HOST, DB_USER, DB_NAME, DB_PASSWORD);
		$this->$_model = get_class($this);
		$this->$_table = $model . 's';
	}

	function __destruct(){

	}
}
