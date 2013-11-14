<?php

class TopicsController extends Controller{
	private $userController;
	private $answerController;
	/*
		fetch all information about a topic given its tid, NULL will be returned if topic does not exist.
	*/
	function getTopicByID($topicid){
		$sql = "select tid, uid, title, detailes, time, scores, active from topics where tid=$topicid;"
		$result = $this->Topic->query($sql, 1);	       if(count($result) > 0){
			return $result;
		}else{
			return NULL;
		}
	}


	function show(){
		$topicid = $_POST['tid'];
		$topic = $this->getTopicByID($topicid);
		
		
	}



}
