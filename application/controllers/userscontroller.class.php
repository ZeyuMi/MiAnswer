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

	function beforeEdit(){
		return $this->info();
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
			$sql = "select topic.tid, topic.title, answer.details, answer.aid from topics topic, answers answer where answer.tid = topic.tid and answer.uid = '$userid';";
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

	function handleImage($uid, $name){
		if(is_uploaded_file($_FILES[$name]["tmp_name"])){
			$ext = pathinfo($_FILES[$name]["name"])['extension'];
			$bigimagelocation = SERVER_ROOT . DS . 'public' . DS . 'img' . DS . $uid . "big.jpg"; 
			$smallimagelocation = SERVER_ROOT . DS. 'public' . DS . 'img' . DS. $uid . "small.jpg";
			if(file_exists($bigimagelocation)){
				unlink($bigimagelocation);
			}
			if(file_exists($smallimagelocation)){
				unlink($smallimagelocation);
			}

			switch(strtolower($_FILES[$name]['type']))
			{
				case 'image/jpeg':
					$image = imagecreatefromjpeg($_FILES[$name]['tmp_name']);
					break;
				case 'image/png':
					$image = imagecreatefrompng($_FILES[$name]['tmp_name']);
					break;
				case 'image/gif':
					$image = imagecreatefromgif($_FILES[$name]['tmp_name']);
					break;
				default:
					exit('Unsupported type: '.$_FILES[$name]['type']);
			}
			$old_width  = imagesx($image);
			$old_height = imagesy($image);


			$big_width  = 100; 
			$big_height = 100;

			$small_width  = 75; 
			$small_height = 75;

			$big = imagecreatetruecolor($big_width, $big_height);
			$small = imagecreatetruecolor($small_width, $small_height);

			imagecopyresampled($big, $image, 0, 0, 0, 0, $big_width, $big_height, $old_width, $old_height);
			imagecopyresampled($small, $image, 0, 0, 0, 0, $small_width, $small_height, $old_width, $old_height);

			imagejpeg($big, $bigimagelocation, 90);
			imagejpeg($small, $smallimagelocation, 90);
			imagedestroy($image);
			imagedestroy($big);
			imagedestroy($small);
			return TRUE;
		}
		return FALSE;
	}

	function editPersonalInfo(){
		$userNow = $_SESSION['uid'];
		$userid = $_POST['uid'];
		$uname = $_POST['uname'];
		$description = $_POST['description'];
		$isuploadimage = $this->handleImage($userid, 'userimage');
		$result = $this->exist($userid);

		if($result && ($userNow == $userid)){
			if($isuploadimage){
				$bigimagename = $userid . 'big.jpg';
				$smallimagename = $userid . 'small.jpg';
				$sql = "update users set uname='$uname', description='$description', bigimage='$bigimagename', smallimage='$smallimagename' where uid='$userid';";
			}else{
				$sql = "update users set uname='$uname', description='$description' where uid='$userid';";
			}
			$this->User->query($sql);
			$_GET['uid'] = $userid;
			return 'redirect';
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

	function getHottestUsers(){
		global $variables;
		$sql = "select uid, uname from users order by uname limit 0, 4;";
		$users = $this->User->query($sql);
		$variables['hotusers'] = $users;
		return 'success';
	}

}
