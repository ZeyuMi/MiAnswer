<?php

class SearchController extends Controller{
	function search(){
		if(!isset($_POST['keywords']){
			return 'fail';
		}
		$keywords = explode('&', $_POST['keywords']);

	}
}
