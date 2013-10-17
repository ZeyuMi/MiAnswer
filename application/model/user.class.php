<?php

class User extends Model{
	function login($userid, $password){
		$sql = 'select uid, password from ' . $this->$_table . 'where uid = ' . $userid;
		$this->$_dbHandle->query($sql);
		if($res->num_rows > 0){
			 $res->data_seek(0);
		     $row = $res->fetch_assoc();
			 echo " name = " . $row['uname'] . "\n";
		}
	}
}
