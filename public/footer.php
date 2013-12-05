			<div class="col-md-3">
				<div class="well sidebar-nav" data-spy="affix">
					<ul class="nav bs-sidenav">
					<li>热门标签</li>
					<?for($i=0; $i < count($hottags); $i++){?>
						<li><a href="http://127.0.0.1/MiAnswer/index.php/tags/show?tagid=<?=$hottags[$i]['Tag']['tagid']?>"><?=$hottags[$i]['Tag']['tname']?></a></li>
					<?}?>
					<li>热门用户</li>
					<?for($i=0; $i < count($hotusers); $i++){?>
						<li><a href="http://127.0.0.1/MiAnswer/index.php/users/info?uid=<?=$hotusers[$i]['User']['uid']?>"><?=$hotusers[$i]['User']['uname']?></a></li>
					<?}?>
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
				<form action="http://127.0.0.1/MiAnswer/index.php/users/login" id="login-form" method="post" class="form-signin">
					<div class="control-group">
						<label class="control-label" for="uid"></label>
						<input type="text" class="form-control" id="uid" name="uid" placeholder="邮箱">
					</div>
					<div class="control-group">
						<label class="control-label" for="password"></label>
						<input type="password" class="form-control" id="password" name="password"placeholder="密码">
					</div>
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
				<form action="http://127.0.0.1/MiAnswer/index.php/users/register" id="register-form" method="post" class="form-signin">
				<div class="control-group">
					<label class="control-label" for="uid"></label> 
					<input type="text" class="form-control" id="uid" name="uid" placeholder="邮箱">
				</div>
				<div class="control-group">
					<label class="control-label" for="uname"></label>	
					<input type="text" class="form-control" id="uname" name="uname" placeholder="用户名">
				</div>
				<div class="control-group">
					<label class="control-label" for="registerpassword"></label>
					<input type="password" class="form-control" id="registerpassword" name="registerpassword" placeholder="密码">
				</div>
				<div class="control-group">
					<label class="control-label" for="password2"></label>
					<input type="password" class="form-control" id="password2" name="password2" placeholder="再次输入密码">
				</div>
				<button id="registerbtn" class="btn btn-primary btn-block" type="submit">注册</button>
				</form>
				</div>
			</div>
		</div>
	</div><!-- /.modal -->
	<?if(isset($_SESSION['uid']) && $_SESSION['scores'] > 0){?>
	<div class="modal fade" id="postquestion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				    <h4 class="form-signin-heading">提问</h4>
				</div>
				<div class="modal-body">
				<form action="http://127.0.0.1/MiAnswer/index.php/topics/postTopic" id="post-form" enctype="multipart/form-data"  method="post" class="form-inline">
					<div class="control-group">
						<input type="text" class="form-control mywidth form-element" id="title" name="title" placeholder="写下你的问题">
					</div>
					<div class="control-group">
						<label class="control-label" for="detailedInfo"> 写下详细的信息</label>
						<div id="detailedinfo" style="height:200px" contentEditable="true" class="editable-div form-control form-element">
						</div>

					</div>
					<div class="control-group">
						<label class="control-label" for="tags">标签</label>
						<input type="text" name="tags" class="form-control mywidth form-element" id="tags" placeholder="用空格分开不同的标签">
					</div>
					<div class="control-group">
						<label class="control-label" for="scores">积分</label>
						<select class="form-control" id="scores" name="scores">
							<?for($i=1; $i<=$_SESSION['scores']; $i++){?>
								<option><?=$i?></option>
							<?}?>
						</select>
					</div>
					<label for="inputFile">选择图片</label>
					<input type="file" name="image" class="form-element"  id="inputFile">
					<button class="btn btn-primary btn-block" type="submit">发布</button>
				</form>
				</div>
			</div>
		</div>
	</div><!-- /.modal -->
	<?}?>
	<script src="http://127.0.0.1/MiAnswer/public/js/jquery-1.9.0.min.js"></script>
	<script src="http://127.0.0.1/MiAnswer/public/js/bootstrap.js"></script>
	<script src="http://127.0.0.1/MiAnswer/public/js/jquery.validate.min.js"></script>
	<script src="http://127.0.0.1/MiAnswer/public/js/jquery.MultiFile.js"></script>
	<script src="http://127.0.0.1/MiAnswer/public/js/customjs.js"></script>
</body>
</html>
