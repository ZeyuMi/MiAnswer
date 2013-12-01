<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<title><?echo $topicinfo['Topic']['title'];?></title>
	<link rel="stylesheet" href="http://127.0.0.1/MiAnswer/public/css/customstyle.css">
	<link rel="stylesheet" href="http://127.0.0.1/MiAnswer/public/css/signin.css">
	<link rel="stylesheet" href="http://127.0.0.1/MiAnswer/public/css/answer.css">
</head>
<body>
<nav class="navbar-wrapper navbar-default navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container" style="height:50px">
		<!-- Brand and toggle get grouped for better mobile display -->
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="#">MiAnswer</a>
		</div>
		<form class="navbar-form navbar-left" role="search">
			<div class="form-group">
				<input type="text" class="form-control" placeholder="搜索问题、答案或人...">
			</div>
			<button type="submit" class="btn btn-default">搜索</button>
		</form>

		<!-- Collect the nav links, forms, and other content for toggling -->
		<div class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li class="active"><a href="http://127.0.0.1/MiAnswer/index.php"><span class="glyphicon glyphicon-question-sign"></span>问题</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-star"></span>回答</a></li>
				<li><a href="http://127.0.0.1/MiAnswer/index.php/tags/getHottestTagsByType"><span class="glyphicon glyphicon-tags"></span>标签</a></li>
			</ul>
			 <?if(isset($_SESSION['uid'])){?>
			 <a class="btn btn-primary navbar-btn" href="#postquestion" data-toggle="modal">提问</a>
			 <?}?>
			<ul class="nav navbar-nav navbar-right">
				<?if(!isset($_SESSION['uid'])){?>
				<li><a href="#register" data-toggle="modal"><span class="glyphicon glyphicon-asterisk"></span>注册</a></li>
				<li><a href="#login" data-toggle="modal"><span class="glyphicon glyphicon-asterisk"></span>登录</a></li>
				<?}else{?>
				<li><a href="#">欢迎你,<?echo $_SESSION['uid'];?></a></li>
				<li><a href="http://127.0.0.1/MiAnswer/index.php/users/logout"><span class="glyphicon glyphicon-asterisk"></span>退出</a></li>
				<?}?>
			</ul>
		</div>
	</div>
</nav>

