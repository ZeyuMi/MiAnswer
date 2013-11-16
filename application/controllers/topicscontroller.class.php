<?php

class TopicsController extends Controller{
	/*
		fetch all information about a topic given its tid, NULL will be returned if topic does not exist.
	*/
	function getTopicByID($topicid){
		$sql = "select tid, uid, title, details, time, scores, active from topics where tid=$topicid";
		$result = $this->Topic->query($sql, 1);	     
		if(count($result) > 0){
			return $result;
		}else{
			return NULL;
		}
	}


	function postTopic(){
		global $variables;
	    $userid = $_SESSION['uid'];
		if(NULL == $userid){
			return 'invalidUser';
		}
		$title = $_POST['title'];
		$details = $_POST['details'];
		$scores = $_POST['scores'];
		$sql = 'insert into topics(uid, title, details, time, scores, active) values('$userid', '$title', '$details', , $score, 1);'
		$tags = explode(' ', $_POST['tags']); 
		foreach($tags as $tag){
			
		}
	

	}
	
	function show(){
		global $variables;
		$topicid = $_POST['tid'];
		$topicinfo = $this->getTopicByID($topicid);
		$variables['topicinfo'] = $topicinfo;
		if(NULL == $topicinfo)
			return 'fail';
		$sql = "select user.uid, user.uname from users user, topics topic where user.uid=topic.uid and topic.tid=$topicid";
		$userinfo = $this->Topic->query($sql, 1);
		$variables['userinfo'] = $userinfo;
		$sql = "select answer.aid, answer.details, answer.time, user.uid, user.uname from answers answer, users user where answer.tid=$topicid and answer.uid=user.uid";
		$answers = $this->Topic->query($sql);
		$variables['answers'] = $answers;
		return 'success';
	}


	function getTopicsByUserid(){
		global $variables;
		$userid = $_POST['uid'];
		$sql = "select tid, uid, title, details, time, scores, active from topics where uid='$userid' ";
		$topics = $this->Topic->query($sql);
		if(count($topics) == 0){
			return 'fail';	
		}else{
			$variables = $topics;
			return 'success';
		}
	}


	function getHottestTopicsByType(){
		global $variables;
		


	}

}
