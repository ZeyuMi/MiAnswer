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
				<form action="http://127.0.0.1/MiAnswer/index.php/users/login" method="post" class="form-signin">
				    <input type="text" class="form-control" name="uid" placeholder="邮箱" autofocus="" required="required">
				    <input type="password" class="form-control" name="password"placeholder="密码" required="required">
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
				<form action="http://127.0.0.1/MiAnswer/index.php/users/register" method="post" class="form-signin">
				    <input type="email" class="form-control" name="uid" placeholder="邮箱" autofocus="" required="required">
				    <input type="text" class="form-control" name="uname" placeholder="用户名" autofocus="" required="required">
				    <input type="password" id="firstPassword" class="form-control" name="password" placeholder="密码" required="required">
				    <input type="password" id="secondPassword" class="form-control" name="passwordverify" placeholder="再次输入密码" required="required">
					<button id="registerbtn" class="btn btn-primary btn-block" type="submit">注册</button>
				</form>
				</div>
			</div>
		</div>
	</div><!-- /.modal -->
	<?if(isset($_SESSION['uid'])){?>
	<div class="modal fade" id="postquestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				    <h4 class="form-signin-heading">提问</h4>
				</div>
				<div class="modal-body">
				<form action="#" method="post" class="form-inline">
				    <input type="text" class="form-control mywidth form-element" name="title" placeholder="写下你的问题" autofocus="" required="required">
					<label for="detailedInfo"> 写下详细的信息</label>
					<textarea id="detailedInfo" name="details" class="form-control mywidth form-element" style="height:200px" required="required" ></textarea>
					<label for="tags">标签</label>
				    <input type="text" name="tags" class="form-control mywidth form-element" id="tags" placeholder="用空格分开不同的标签" required="required">
					<label for="tags">积分</label>
					<input type="text" class="form-control form-element" name="scores" id="scores" placeholder="你的积分" required="required">
					<label for="inputFile">选择图片</label>
					<input type="file" class="form-element" id="inputFile">
					<button class="btn btn-primary btn-block" type="submit">发布</button>
				</form>
				</div>
			</div>
		</div>
	</div><!-- /.modal -->
	<?}?>
	<script src="http://127.0.0.1/MiAnswer/public/js/jquery-1.10.2.min.js"></script>
	<script src="http://127.0.0.1/MiAnswer/public/js/bootstrap.js"></script>
	<script src="http://127.0.0.1/MiAnswer/public/js/customjs.js"></script>
</body>
</html>
