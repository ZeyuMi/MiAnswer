<?php

class TagsController extends Controller{

	function show(){
		global $variables;
		$tagid = $_GET['tagid'];
		$sql = "select tagid, tname, description from tags where tagid=$tagid";
		$taginfo = $this->Tag->query($sql,1);
		$variables['taginfo'] = $taginfo;

		$sql = "select topic.tid, topic.uid, topic.title, topic.details, topic.time, topic.scores, topic.active, user.uid, user.uname, user.smallimage from users user, topics topic  where user.uid=topic.uid and topic.tid in (select tid from topictagrelations where tagid=$tagid)";
		$topics = $this->Tag->query($sql);
		$variables['topics'] = $topics;
		return 'success';
	}


	function getHottestTags(){
		global $variables;
		$sql = "select tag.tagid, tag.tname from tags tag order by tag.num desc limit 0, 4;";
		$tags = $this->Tag->query($sql);
		$variables['hottags'] = $tags;
		return 'success';
	}

	function getAllHottestTags(){
		global $variables;
		$sql = "select tag.tagid, tag.tname, tag.num from tags tag order by tag.num desc";
		$tags = $this->Tag->query($sql);
		$variables['tags'] = $tags;
		return 'success';
	}


}
