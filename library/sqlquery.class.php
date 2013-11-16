<?php

class SQLQuery{
	protected $_dbHandle;
	protected $_result;

	function connect($address, $database, $user, $password){
		$this->_dbHandle = mysqli_connect($address, $user, $password, $database);
		if(mysqli_connect_errno()){
			echo 'database connection failed';
			return 0;
		}
		return 1;
	} 

	function query($sql, $singleResult = 0){
		$this->_result = mysqli_query($this->_dbHandle, $sql);
		if((strcmp(gettype($this->_result), "boolean") != 0) && preg_match("/select/i",$sql)) {
			$result = array();
			$table = array();
			$field = array();
			$tempResults = array();
			$numOfFields = mysqli_num_fields($this->_result);
			for ($i = 0; $i < $numOfFields; ++$i) {
				$info = $this->_result->fetch_field_direct($i);
				array_push($table,$info->table);
				array_push($field,$info->name);
			}


			while ($row = mysqli_fetch_row($this->_result)) {
				for ($i = 0;$i < $numOfFields; ++$i) {
					$table[$i] = trim(ucfirst($table[$i]),"s");
					$tempResults[$table[$i]][$field[$i]] = $row[$i];
				}
				if ($singleResult == 1) {
					mysqli_free_result($this->_result);
					return $tempResults;
				}
				array_push($result,$tempResults);
			}
			mysqli_free_result($this->_result);
			return($result);
		}
	}

	function insert_id(){
		return mysqli_insert_id($this->_dbHandle);
	}


	function disconnect(){
		if(mysqli_close($this->_dbHandle))
			return 1;
		else
 			return 0;
	}

}
