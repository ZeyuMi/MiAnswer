<?php

class AnswersController extends Controller{
	/*
		fetch all information about a answer given its aid, NULL will be returned if answer does not exist.
	*/
	function getAnswerByID($answerid){
		$sql = "select aid, uid, tid, details, time, accept from answers where aid=$answerid";
		$result = $this->Answer->query($sql, 1);	     
		if(count($result) > 0){
			return $result;
		}else{
			return NULL;
		}
	}

	function like(){
		$uid = $_SESSION['uid'];
		$aid = $_GET['aid'];
		$sql = "update answers set likes=likes+1 where aid=$aid";
		$this->Answer->query($sql);
		$sql = "insert into likerelations(aid, uid) values($aid, '$uid');";
		$this->Answer->query($sql);
	}

	function dislike(){
		$uid = $_SESSION['uid'];
		$aid = $_GET['aid'];
		$sql = "update answers set dislikes=dislikes+1 where aid=$aid";
		$this->Answer->query($sql);
		$sql = "insert into dislikerelations(aid, uid) values($aid, '$uid');";
		$this->Answer->query($sql);
	}

	function uploadImage($name){
		if(is_uploaded_file($_FILES[$name]["tmp_name"])){
			$id = $this->Answer->getNumRows('images')+1; 
			$ext = pathinfo($_FILES[$name]["name"])['extension'];
			$filename = "image$id." . $ext;
			move_uploaded_file($_FILES[$name]["tmp_name"], SERVER_ROOT . DS . 'public' . DS . 'img' . DS . $filename);
			$sql = "insert into images(imid, imagename) values($id, '$filename');";
			$this->Answer->query($sql);
			return $filename;
		}
		return NULL;
	}

	function postAnswer(){
		global $variables;
		if(!isset($_SESSION['uid']))
			return 'invalidUser';
		$userid = $_SESSION['uid'];
		$tid = $_POST['tid'];
		$details = $_POST['details'];
		$time = date('Y-m-d H:i:s');
		$filename = $this->uploadImage('answerimage');
		if(NULL != $filename){
			$regex = "/<img src=\".*\"\\>/";
			$replacement = "<img src=\"http://127.0.0.1/MiAnswer/public/img/$filename\"\\>";
			$details = preg_replace($regex, $replacement, $details);
		}
		$sql = "insert into answers(uid, tid, details, time, accept) values('$userid', $tid, '$details', '$time', 0);";
		$this->Answer->query($sql);
		$aid = $this->Answer->insert_id();
		$_GET['tid']=$tid;
		return 'redirect';
	}


	function deleteAnswer(){
		global $variables;
		if(!isset($_SESSION['uid']))
			return 'invalidUser';
		$userid = $_SESSION['uid'];
		$aid = $_POST['aid'];
		$sql = "select uid from answers where aid=$aid";
		$result = $this->Answer->query($sql, 1);
		if($result['Answer']['uid'] != $userid)
			return 'invalidUser';
		$sql = "delete from answers where aid=$aid";
		$this->Answer->query($sql);
		return 'success';
	}


	function editAnswer(){
		global $variables;
		if(!isset($_SESSION['uid']))
			return 'invalidUser';
		$userid = $_SESSION['uid'];
		$aid = $_POST['aid'];
		$details = $_POST['details'];
		$sql = "select uid from answers where aid=$aid";
		$result = $this->Answer->query($sql,1);
		if($result['Answer']['uid'] != $userid)
			return 'invalidUser';

		$sql = "update answers set details = '$details' where aid=$aid;";
		$this->Answer->query($sql);

		return 'success';
	}
	
	function show(){
		global $variables;
		$answerid = $_POST['aid'];
		$answerinfo = $this->getAnswerByID($answerid);
		$variables['answerinfo'] = $answerinfo;
		if(NULL == $answerinfo)
			return 'fail';
		$sql = "select user.uid, user.uname from users user, answers answer where user.uid=answer.uid and answer.aid=$answerid";
		$userinfo = $this->Answer->query($sql, 1);
		$variables['userinfo'] = $userinfo;

		$sql = "select * from comments where aid=$answerid";
		$result = $this->Answer->query($sql);
		$variables['commentnum'] = count($result);
		return 'success';
	}


	function getAnswersByUserid(){
		global $variables;
		$userid = $_POST['uid'];
		$sql = "select aid, uid, details, time, accept from answers where uid='$userid' ";
		$answers = $this->Answer->query($sql);
		if(count($answers) == 0){
			return 'fail';	
		}else{
			$variables = $answers;
			return 'success';
		}
	}


	function getHottestAnswersByType(){
		global $variables;
		


	}

}
