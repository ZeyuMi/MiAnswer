<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>首页</title>
	<link rel="stylesheet" type="text/css" href="http://127.0.0.1/MiAnswer/public/css/customstyle.css">
	<link rel="stylesheet" type="text/css" href="http://127.0.0.1/MiAnswer/public/css/signin.css">
</head>
<body>
<nav class="navbar-wrapper navbar-default navbar-inverse navbar-fixed-top" role="navigation">
	<div class="container">
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
				<li class="active"><a href="#"><span class="glyphicon glyphicon-question-sign"></span>问题</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-star"></span>回答</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-tags"></span>标签</a></li>
				<li><a href="#"><span class="glyphicon glyphicon-user"></span>用户</a></li>
				<!--<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> About Us<b class="caret"></b></a>
					<ul class="dropdown-menu">
						<li><a href="#">Company Details</a></li>
						<li><a href="#">Contact Us</a></li>
					</ul>
				</li>-->
			</ul>
			<button class="btn btn-primary navbar-btn"><a href="#postquestion" data-toggle="modal">提问</a></button>
			<ul class="nav navbar-nav navbar-right">
				<li><a href="#register" data-toggle="modal"><span class="glyphicon glyphicon-asterisk"></span>注册</a></li>
				<li><a href="#login" data-toggle="modal"><span class="glyphicon glyphicon-asterisk"></span>登录</a></li>
			<!--	<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-info-sign"></span> Reservation<b class="caret"></b></a>
					<ul class="dropdown-menu">
					<li><a href="#">Cancel</a></li>
						<li><a href="#">Confirm</a></li>
					</ul>
				</li>-->
			</ul>
		</div>
	</div>
</nav>
	<div class="container">		
		<div class="row">
			<div class="col-md-9">
				<?for($i = 0; $i < count($topics); $i++){ ?>
				<div class="row">
					<div class="col-md-2">
						<a href="http://127.0.0.1/MiAnswer/index.php/users/info?uid=<?echo $topics[$i]['User']['uid'];?>"><img class="pull-right img-rounded" src="http://127.0.0.1/MiAnswer/public/img/<?echo $topics[$i]['User']['smallimage']?>"></img></a>
					</div>
					<div class="col-md-10">
						<div class="row">
							<h5 class="pull-right"><?echo gettime($topics[$i]['Topic']['time']);?></h5>
							<h4><a href="http://127.0.0.1/MiAnswer/index.php/topics/show?tid=<?echo $topics[$i]['Topic']['tid'];?>"><?echo $topics[$i]['Topic']['title']; ?></a></h4>
						</div>
						<div class="row">
							<p><span class="glyphicon glyphicon-comment"></span>12个回答</p>
						</div>
					</div>
				</div>
				<?}?>
			</div>
			<div class="col-md-3">
				<div class="well sidebar-nav" data-spy="affix">
					<ul class="nav bs-sidenav">
					<li>热门标签</li>
					<li><a href="#">金融</a></li>
					<li><a href="#">数学</a></li>
					<li><a href="#">编程</a></li>
					<li><a href="#">留学</a></li>
					<li><a href="#">冷知识</a></li>
					<li>热门用户</li>
					<li><a href="#">顾扯淡</a></li>
					<li><a href="#">yolfilm</a></li>
					<li><a href="#">陈浩</a></li>
					<li><a href="#">张宇辰</a></li>
					<li><a href="#">葛巾</a></li>
					</ul>
				</div>
			</div>
		</div>
							
	</div>
	<div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				    <h4 class="form-signin-heading">请登录</h4>
				</div>
				<div class="modal-body">
				<form action="../index.php/users/login" method="post" class="form-signin">
				    <input type="text" class="form-control" name="uid" placeholder="邮箱" autofocus="">
				    <input type="password" class="form-control" name="password"placeholder="密码">
			        <label class="checkbox">
						<input type="checkbox" value="remember-me"> 记住我
					</label>
					<button class="btn btn-primary btn-block" type="submit">登录</button>
				</form>
				</div>
			</div>
		</div>
	</div><!-- /.modal -->
	<div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				    <h4 class="form-signin-heading">填写注册信息</h4>
				</div>
				<div class="modal-body">
				<form action="../index.php/users/register" method="post" class="form-signin">
				    <input type="text" class="form-control" name="uid" placeholder="邮箱" autofocus="">
				    <input type="text" class="form-control" name="uname" placeholder="用户名" autofocus="">
				    <input type="password" class="form-control" name="password" placeholder="密码">
				    <input type="password" class="form-control" name="passwordverify" placeholder="再次输入密码">
			        <label class="checkbox">
						<input type="checkbox" value="remember-me"> 记住我
					</label>
					<button class="btn btn-primary btn-block" type="submit">注册</button>
				</form>
				</div>
			</div>
		</div>
	</div><!-- /.modal -->
	<div class="modal fade" id="postquestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				    <h4 class="form-signin-heading">提问</h4>
				</div>
				<div class="modal-body">
				<form action="../index.php/users/register" method="post" class="form-inline">
				    <input type="text" class="form-control mywidth form-element" name="tname" placeholder="写下你的问题" autofocus="">
					<label for="detailedInfo"> 写下详细的信息</label>
					<textarea id="detailedInfo" class="form-control mywidth form-element" style="height:200px" ></textarea>
					<label for="tags">标签</label>
				    <input type="text" class="form-control mywidth form-element" id="tags" placeholder="用空格分开不同的标签">
			        <label class="checkbox">
						<input type="checkbox" value="remember-me"> 匿名
					</label>
					<button class="btn btn-primary btn-block" type="submit">发布</button>
				</form>
				</div>
			</div>
		</div>
	</div><!-- /.modal -->
	<script src="http://127.0.0.1/MiAnswer/public/js/jquery-1.10.2.min.js"></script>
	<script src="http://127.0.0.1/MiAnswer/public/js/bootstrap.js"></script>
</body>
</html>
