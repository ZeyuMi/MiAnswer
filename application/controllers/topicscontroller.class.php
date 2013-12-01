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


	function acceptAnswer(){
		global $variables;
		if(!isset($_SESSION['uid']))
			return 'invalidUser';
		$tuserid = $_SESSION['uid'];
		$tid = $_POST['tid'];
		$aid = $_POST['aid'];
		$sql = "select uid from topics where tid=$tid";
		$result = $this->Topic->query($sql, 1);
		if($result['Topic']['uid'] != $tuserid)
			return 'invalidUser';
		$sql = "select uid, tid from answers where aid=$aid";
		$result = $this->Topic->query($sql,1);
		if(count($result) == 0 || $result['Answer']['tid'] != $tid)
			return 'invalidAnswer';
		$auserid = $result['Answer']['uid'];
		$sql = "update topics set active = 0 where tid=$tid";
		$this->Topic->query($sql);
		$sql = "update answers set accept=1 where aid=$aid";
		$this->Topic->query($sql);
		$sql = "update users set scores=scores+(select scores from topics where tid=$tid) where uid='$auserid';";
		$this->Topic->query($sql);
		return 'success';
	}


	function postTopic(){
		global $variables;
		if(!isset($_SESSION['uid']))
			return 'invalidUser';
		$userid = $_SESSION['uid'];
		$title = $_POST['title'];
		$details = $_POST['details'];
		$scores = $_POST['scores'];
		$tags = explode(' ', $_POST['tags']);
		$time = date('Y-m-d H:i:s');
		$sql = "insert into topics(uid, title, details, time, scores, active) values('$userid', '$title', '$details', '$time', $scores, 1);";
		$this->Topic->query($sql);
		$tid = $this->Topic->insert_id();
		foreach($tags as $tag){
			$sql = "select tname from tags where tname='$tag'";
			$result = $this->Topic->query($sql);
			if(count($result) == 0){
				$sql = "insert into tags(tname) values ('$tag');";
				$this->Topic->query($sql);
			}
			$sql = "select tagid from tags where tname='$tag';";
			$result = $this->Topic->query($sql,1);
			$tagid = $result['Tag']['tagid'];
			$sql = "insert into topictagrelations(tid, tagid) values($tid, $tagid);";
			$this->Topic->query($sql);
		}
		$variables['topicinfo'] = $this->getTopicByID($tid);
		$sql = "select tag.tname from tags tag , topictagrelations r where tag.tagid=r.tagid and r.tid=$tid";
		$tags = $this->Topic->query($sql);
		$variables['tags'] = $tags;
		return 'success';
	}


	function deleteTopic(){
		global $variables;
		if(!isset($_SESSION['uid']))
			return 'invalidUser';
		$userid = $_SESSION['uid'];
		$tid = $_POST['tid'];
		$sql = "select uid from topics where tid=$tid";
		$result = $this->Topic->query($sql,1);
		if($result['Topic']['uid'] != $userid)
			return 'invalidUser';

		$sql = "delete from topics where tid=$tid";
		$this->Topic->query($sql);
		return 'success';
	}


	function editTopic(){
		global $variables;
		if(!isset($_SESSION['uid']))
			return 'invalidUser';
		$userid = $_SESSION['uid'];
		$tid = $_POST['tid'];
		$title = $_POST['title'];
		$details = $_POST['details'];
		$scores = $_POST['scores'];
		$tags = explode(' ', $_POST['tags']);
		$sql = "select uid from topics where tid=$tid";
		$result = $this->Topic->query($sql,1);
		if($result['Topic']['uid'] != $userid)
			return 'invalidUser';

		$sql = "update topics set title ='$title', details = '$details', scores=$scores where tid=$tid;";
		$this->Topic->query($sql);
		$sql = "delete from topictagrelations where tid=$tid";
		$this->Topic->query($sql);
		foreach($tags as $tag){
			$sql = "select tname from tags where tname='$tag'";
			$result = $this->Topic->query($sql);
			if(count($result) == 0){
				$sql = "insert into tags(tname) values ('$tag');";
				$this->Topic->query($sql);
			}
			$sql = "select tagid from tags where tname='$tag';";
			$result = $this->Topic->query($sql,1);
			$tagid = $result['Tag']['tagid'];
			$sql = "insert into topictagrelations(tid, tagid) values($tid, $tagid);";
			$this->Topic->query($sql);
		}

		return 'success';
	}
	
	function show(){
		global $variables;
		$topicid = $_GET['tid'];
		$topicinfo = $this->getTopicByID($topicid);
		$variables['topicinfo'] = $topicinfo;
		if(NULL == $topicinfo)
			return 'fail';
		$sql = "select user.uid, user.uname from users user, topics topic where user.uid=topic.uid and topic.tid=$topicid";
		$userinfo = $this->Topic->query($sql, 1);
		$topicid = $topicinfo['Topic']['tid'];
		$variables['userinfo'] = $userinfo;
		$sql = "select answer.aid, answer.details, answer.time, answer.accept, answer.likes, answer.dislikes, user.uid, user.uname, user.description from answers answer, users user where answer.tid=$topicid and answer.uid=user.uid";
		$answers = $this->Topic->query($sql);
		$variables['answers'] = $answers;
		$variables['answersnum'] = count($answers);
		$sql = "select imagename from topicimages where tid=$topicid;";
		$images = $this->Topic->query($sql);
		$variables['images'] = $images;
		$sql = "select answerimage.imagename, answerimage.aid from answerimages answerimage, answers answer  where answer.tid=$topicid and answer.aid=answerimage.aid";
		$aimages = $this->Topic->query($sql);
		$variables['aimages'] = $aimages;
		$sql = "select tag.tname from tags tag , topictagrelations r where tag.tagid=r.tagid and r.tid=$topicid";
		$tags = $this->Topic->query($sql);
		$variables['tags'] = $tags;
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
		$sql = "select user.uid, user.smallimage, topic.tid, topic.title, topic.time, topic.scores, topic.active from users user, topics topic where topic.uid=user.uid;";
		$variables['topics'] = $this->Topic->query($sql);	
		return 'success';
	}

}
