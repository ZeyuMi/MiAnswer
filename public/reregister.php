<div class="container">

	<form action="http://127.0.0.1/MiAnswer/index.php/users/register" id="login-form" method="post" class="form-signin">
        <h4 class="form-signin-heading">用户已存在</h4>
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
</div><!-- /.modal -->
