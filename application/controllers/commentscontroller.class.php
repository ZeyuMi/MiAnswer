<?php

class CommentsController extends Controller{
	/*
		fetch all information about a comment given its aid, NULL will be returned if comment does not exist.
	*/
	function getCommentByID($commentid){
		$sql = "select cid, uid, aid, details,time from comments where cid=$commentid";
		$result = $this->Comment->query($sql, 1);	     
		if(count($result) > 0){
			return $result;
		}else{
			return NULL;
		}
	}


	function postComment(){
		global $variables;
		if(!isset($_SESSION['uid']))
			return 'invalidUser';
		$userid = $_SESSION['uid'];
		$aid = $_POST['aid'];
		$details = $_POST['details'];
		$time = date('Y-m-d H:i:s');
		$sql = "insert into comments(uid, aid, details, time) values('$userid', $aid, '$details', '$time');";
		$this->Comment->query($sql);
		$aid = $this->Comment->insert_id();
		$variables['commentinfo'] = $this->getCommentByID($aid);
		return 'success';
	}


	function deleteComment(){
		global $variables;
		if(!isset($_SESSION['uid']))
			return 'invalidUser';
		$userid = $_SESSION['uid'];
		$cid = $_POST['cid'];
		$sql = "select uid from comments where cid=$cid";
		$result = $this->Comment->query($sql, 1);
		if($result['Comment']['uid'] != $userid)
			return 'invalidUser';
		$sql = "delete from comments where cid=$cid";
		$this->Comment->query($sql);
		return 'success';
	}

	function getComments(){
		global $variables;
		$answerid = $_POST['aid'];
		$sql = "select comment.cid, comment.uid, comment.aid, comment.details, comment.time, user.uid, user.uname from users user, comments comment where user.uid=comment.uid and comment.aid=$answerid";
		$comments = $this->Comment->query($sql);
		if(count($comments) != 0)
			$variables['comments'] = $comments;
		return 'success';
	}


	function getHottestCommentsByType(){
		global $variables;
		


	}

}
