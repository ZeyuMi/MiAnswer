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


	function uploadImage($name){
		if(is_uploaded_file($_FILES[$name]["tmp_name"])){
			$id = $this->Topic->getNumRows('images')+1; 
			$ext = pathinfo($_FILES[$name]["name"])['extension'];
			$filename = "image$id." . $ext;
			move_uploaded_file($_FILES[$name]["tmp_name"], SERVER_ROOT . DS . 'public' . DS . 'img' . DS . $filename);
			$sql = "insert into images(imid, imagename) values($id, '$filename');";
			$this->Topic->query($sql);
			return $filename;
		}
		return NULL;
	}

	function acceptAnswer(){
		global $variables;
		if(!isset($_SESSION['uid']))
			return 'invalidUser';
		$tuserid = $_SESSION['uid'];
		$tid = $_GET['tid'];
		$aid = $_GET['aid'];
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
		$_GET['tid'] = $tid;
		return 'redirect';
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
		$filename = $this->uploadImage('image');	
		if(NULL != $filename){
			$regex = "/<img src=\".*\"\\>/";
			$replacement = "<img src=\"http://127.0.0.1/MiAnswer/public/img/$filename\"\\>";
			$details = preg_replace($regex, $replacement, $details);
		}
		$sql = "insert into topics(uid, title, details, time, scores, active) values('$userid', '$title', '$details', '$time', $scores, 1);";
		$this->Topic->query($sql);
		$tid = $this->Topic->insert_id();

		$newScores = $_SESSION['scores'] - $scores;
		$_SESSION['scores'] = $newScores;
		$sql = "update users set scores=$newScores where uid='$userid'";
		$this->Topic->query($sql);
		foreach($tags as $tag){
			$sql = "select tname from tags where tname='$tag'";
			$result = $this->Topic->query($sql);
			if(count($result) == 0){
				$sql = "insert into tags(tname) values ('$tag');";
				$this->Topic->query($sql);
			}else{
				$sql = "update tags set num = num+1 where tname='$tag';";
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
		$_GET['tid'] = $tid;
		return 'redirect';
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
		$title = $_POST['newtitle'];
		$details = $_POST['details'];
		$scores = $_POST['newscores'];
		$oldScores = $_POST['oldscores'];
		$tags = explode(' ', $_POST['newtags']);
		$sql = "select uid from topics where tid=$tid";
		$result = $this->Topic->query($sql,1);
		if($result['Topic']['uid'] != $userid)
			return 'invalidUser';
		$filename = $this->uploadImage('newimage');	
		if(NULL != $filename){
			$regex = "/<img src=\".*\"\\>/";
			$replacement = "<img src=\"http://127.0.0.1/MiAnswer/public/img/$filename\"\\>";
			$details = preg_replace($regex, $replacement, $details);
		}
		$sql = "update topics set title ='$title', details = '$details', scores=$scores where tid=$tid;";
		$this->Topic->query($sql);
		$sql = "update tags set num=num-1 where tagid in (select tagid from topictagrelations where tid=$tid)";
		$this->Topic->query($sql);
		$sql = "delete from topictagrelations where tid=$tid";
		$this->Topic->query($sql);
		foreach($tags as $tag){
			$sql = "select tname from tags where tname='$tag'";
			$result = $this->Topic->query($sql);
			if(count($result) == 0){
				$sql = "insert into tags(tname) values ('$tag');";
				$this->Topic->query($sql);
			}else{
				$sql = "update tags set num=num+1 where tname='$tag'";
				$this->Topic->query($sql);
			}
			$sql = "select tagid from tags where tname='$tag';";
			$result = $this->Topic->query($sql,1);
			$tagid = $result['Tag']['tagid'];
			$sql = "insert into topictagrelations(tid, tagid) values($tid, $tagid);";
			$this->Topic->query($sql);
		}

		$userscores = $_SESSION['scores'] + $oldScores - $scores;
		$_SESSION['scores'] = $userscores;
		$sql = "update users set scores=$userscores where uid='$userid'";
		$this->Topic->query($sql);

		$_GET['tid'] = $tid;
		return 'redirect';
	}
	
	function beforeEdit(){
		return $this->show();
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
		$sql = "select answer.aid, answer.details, answer.time, answer.accept, answer.likes, answer.dislikes, user.uid, user.uname, user.description from answers answer, users user where answer.tid=$topicid and answer.uid=user.uid order by answer.time asc";
		$answers = $this->Topic->query($sql);
		$variables['answers'] = $answers;
		$variables['answersnum'] = count($answers);
		if(isset($_SESSION['uid'])){
			$uid = $_SESSION['uid'];
			$sql = "select aid from likerelations where uid='$uid' and tid=$topicid;";
			$likes = $this->Topic->query($sql);
			$variables['likes'] = $likes;
			$sql = "select aid from dislikerelations where uid='$uid' and tid=$topicid;";
			$dislikes = $this->Topic->query($sql);
			$variables['dislikes'] = $dislikes;
		}
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

	function search(){
		global $variables;
		$keywords = explode(' ', $_GET['keywords']);

		$sql = "select tid, title, time from topics where ";
		foreach($keywords as $keyword){
			$sql = $sql . "title like '%$keyword%' or ";
		}
		foreach($keywords as $keyword){
			$sql = $sql . "details like '%$keyword%' or ";
		}
		$sql = trim($sql, 'or ');
		$topics = $this->Topic->query($sql);
		$variables['searchtopics'] = $topics;
		
		$sql = "select topic.tid, topic.title, answer.details from topics topic, answers answer where answer.tid=topic.tid and ";
		foreach($keywords as $keyword){
			$sql = $sql . "topic.title like '%$keyword%' or ";
		}
		foreach($keywords as $keyword){
			$sql = $sql . "answer.details like '%$keyword%' or ";
		}
		$sql = trim($sql, 'or ');
		$answers = $this->Topic->query($sql);
		$variables['searchanswers'] = $answers;

		$sql = "select tagid, tname, num from tags where ";
		foreach($keywords as $keyword){
			$sql = $sql . "tname like '%$keyword%' or ";
		}
		$sql = trim($sql, 'or ');
		$tags = $this->Topic->query($sql);
		$variables['searchtags'] = $tags;

		$sql = "select uid, uname, description from users where ";
		foreach($keywords as $keyword){
			$sql = $sql . "uname like '%$keyword%' or ";
		}
		foreach($keywords as $keyword){
			$sql = $sql . "description like '%$keyword%' or ";
		}
		$sql = trim($sql, 'or ');
		$users = $this->Topic->query($sql);
		$variables['searchusers'] = $users;
		return 'success';		
	}

}
