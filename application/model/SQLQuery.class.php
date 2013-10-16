<?php

class SQLQuery{
	protected $_dbHandle;
	protected $_result;

	function connect($address, $database, $user, $password){
		$_dbHandle = new mysqli($address, $user, $password, $database);
		if(mysqli_connect_errno()){
			echo 'database connection failed';
			return -1;
		}
		return 1;
	}

	function disconnect(){
		$_bdHandle->close();
	}

}
