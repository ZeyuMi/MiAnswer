function init(){
	$("#post-form").validate(
	 {
  		rules: {
    			title: {
      				required: true,
				},
    			details: {
      				required: true,
    			},
    			tags: {
     				required: true,
    			},
    			scores: {
     				number: true,
   			 },
 		 },
		messages: {
			title: {
				required: '问题不能为空哦',
			},
			details: {
				required: '细节不能为空哦',
			},
			tags: {
				required: '请至少添加1个标签',
			},
			scores: {
				number: '积分只能是数字哦',
			},
		},
   		highlight: function(element) {
   			 $(element).closest(".control-group").removeClass("success").addClass("danger");
  		},
  		success: function(element) {
   			 element.text("OK!").addClass("valid").closest(".control-group").removeClass("danger").addClass("success");
  		},
 	});

	$("#register-form").validate(
	 {
  		rules: {
    			uname: {
      				minlength: 2,
      				required: true,
				},
    			uid: {
      				required: true,
      				email: true,
    			},
    			password: {
     				required: true,
    			},
    			passwordverify: {
     				required: true,
					equalTo:"#password",
   			 },
 		 },
		messages: {
			uname:{
				minlength: '请至少输入2个字符',
				required: '请告诉我们您的昵称',
			},
			uid: {
				required: '请告诉我们您的用户名',
				email:'邮箱地址不正确哦',
			},
			password:{
				required: '密码不能为空哦',
			},
			passwordverify:{
				required: '请确认密码',
				equalTo: '您两次填写的密码不一致',
			},
		},
   		highlight: function(element) {
   			 $(element).closest(".control-group").removeClass("success").addClass("danger");
  		},
  		success: function(element) {
   			 element.text("OK!").addClass("valid").closest(".control-group").removeClass("danger").addClass("success");
  		},
 	});

	$("#login-form").validate(
	{
		rules: {
			uid : {
				required: true,
				email: true,
			},
			password: {
				required: true,
			},
		},
		messages: {
			uid: {
				required: '请告诉我们您的用户名',
				email: '邮箱地址不正确哦',
			},
			password:{
				required: '密码不能为空哦',
			},
		},
		highlight: function(element) {
   			 $(element).closest(".control-group").removeClass("success").addClass("danger");
  		},
  		success: function(element) {
   			 element.text("OK!").addClass("valid").closest(".control-group").removeClass("danger").addClass("success");
  		},
	});
}

$(document).ready(init);
