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


	function postAnswer(){
		global $variables;
		if(!isset($_SESSION['uid']))
			return 'invalidUser';
		$userid = $_SESSION['uid'];
		$tid = $_POST['tid'];
		$details = $_POST['details'];
		$time = date('Y-m-d H:i:s');
		$sql = "insert into answers(uid, tid, details, time, accept) values('$userid', $tid, '$details', '$time', 0);";
		$this->Answer->query($sql);
		$aid = $this->Answer->insert_id();
		$variables['answerinfo'] = $this->getAnswerByID($aid);
		return 'success';
	}


	function deleteAnswer(){
		global $variables;
		if(!isset($_SESSION['uid']))
			return 'invalidUser';
		$userid = $_SESSION['uid'];
		$aid = $_POST['aid'];
		$sql = "delete from answers where aid=$aid";
		$this->Answer->query($sql);
		return 'success';
	}


	function editAnswer(){
		global $variables;
		if(!isset($_SESSION['uid']))
			return 'invalidUser';
				$userid = $_SESSION['uid'];
		$tid = $_POST['tid'];
		$title = $_POST['title'];
		$details = $_POST['details'];
		$scores = $_POST['scores'];
		$tags = explode(' ', $_POST['tags']);
		$sql = "select uid from answers where tid=$tid";
		$result = $this->Answer->query($sql,1);
		if($result['Answer']['uid'] != $userid)
			return 'invalidUser';

		$sql = "update answers set title ='$title', details = '$details', scores=$scores where tid=$tid;";
		$this->Answer->query($sql);
		$sql = "delete from answertagrelations where tid=$tid";
		$this->Answer->query($sql);
		$sql = "delete from tags t where not exists(select * from answertagrelations r where r.tagid=t.tagid)";
		$this->Answer->query($sql);
		foreach($tags as $tag){
			$sql = "select tname from tags where tname='$tag'";
			$result = $this->Answer->query($sql);
			if(count($result) == 0){
				$sql = "insert into tags(tname) values ('$tag');";
				$this->Answer->query($sql);
			}
			$sql = "select tagid from tags where tname='$tag';";
			$result = $this->Answer->query($sql,1);
			$tagid = $result['Tag']['tagid'];
			$sql = "insert into answertagrelations(tid, tagid) values($tid, $tagid);";
			$this->Answer->query($sql);
		}
		$sql = "delete from tags where not exists(select * from answertagrelations r where r.tagid=tags.tagid)";
		$this->Answer->query($sql);

		return 'success';
	}
	
	function show(){
		global $variables;
		$answerid = $_POST['tid'];
		$answerinfo = $this->getAnswerByID($answerid);
		$variables['answerinfo'] = $answerinfo;
		if(NULL == $answerinfo)
			return 'fail';
		$sql = "select user.uid, user.uname from users user, answers answer where user.uid=answer.uid and answer.tid=$answerid";
		$userinfo = $this->Answer->query($sql, 1);
		$answerid = $answerinfo['Answer']['tid'];
		$variables['userinfo'] = $userinfo;
		$sql = "select answer.aid, answer.details, answer.time, user.uid, user.uname from answers answer, users user where answer.tid=$answerid and answer.uid=user.uid";
		$answers = $this->Answer->query($sql);
		$variables['answers'] = $answers;
		$sql = "select tag.tname from tags tag , answertagrelations r where tag.tagid=r.tagid and r.tid=$answerid";
		$tags = $this->Answer->query($sql);
		$variables['tags'] = $tags;
		return 'success';
	}


	function getAnswersByUserid(){
		global $variables;
		$userid = $_POST['uid'];
		$sql = "select tid, uid, title, details, time, scores, active from answers where uid='$userid' ";
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
