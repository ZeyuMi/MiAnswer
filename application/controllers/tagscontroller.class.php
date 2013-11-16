<?php

class TagsController extends Controller{

	function show(){
		global $variables;
		$tagid = $_POST['tagid'];
		$sql = "select tagid, tname from tags where tagid=$tagid";
		$taginfo = $this->Tag->query($sql,1);
		$variables['taginfo'] = $taginfo;

		$sql = "select topic.tid, topic.uid, topic.title, topic.details, topic.time, topic.scores, topic.active, user.uid, user.uname from users user, topics topic  where user.uid=topic.uid and topic.tid in (select tid from topictagrelations where tagid=$tagid)";
		$topics = $this->Tag->query($sql);
		$variables['topics'] = $topics;
		return 'success';
	}


	function getHottestTagsByType(){
		global $variables;
		


	}

}
