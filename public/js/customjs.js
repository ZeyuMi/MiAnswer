function fileUpload(input, divid) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {

			document.getElementById(divid).innerHTML += "<img src=\"" + e.target.result + "\"\\>";
		}

		reader.readAsDataURL(input.files[0]);
	}
}

function like(id1, id2){
	$.get("http://127.0.0.1/MiAnswer/index.php/answers/like", {aid : id1, tid : id2});	
}

function dislike(id1, id2){
	$.get("http://127.0.0.1/MiAnswer/index.php/answers/dislike", {aid : id1, tid : id2});	
}


function deleteAnswer(id){
	var element = document.getElementById('a'+id);
	element.parentNode.removeChild(element);
	$.post("http://127.0.0.1/MiAnswer/index.php/answers/deleteAnswer", {aid : id});
}

function deleteTopic(id){
	var element = document.getElementById('t'+id);
	element.parentNode.removeChild(element);
	$.post("http://127.0.0.1/MiAnswer/index.php/topics/deleteTopic", {tid : id});
}

function init(){
	
	$("#inputFile").change(function(){
			fileUpload(this, 'detailedinfo')});
	$("#newinputFile").change(function(){
			fileUpload(this, 'newdetailedinfo')});
	$("#answerinputFile").change(function(){
			fileUpload(this, 'answerdetail')});
	$("#answerform").validate(
	 {
		submitHandler: function(form){
			var textarea = document.createElement("textarea");
			textarea.setAttribute("name", "details");
			var value = document.getElementById("answerdetail").innerHTML;
			textarea.value = value;
			form.appendChild(textarea);
			form.submit();
		},
 	});


	$("#edit-topicform").validate(
	 {
  		rules: {
    			newtitle: {
      				required: true,
				},
    			newtags: {
     				required: true,
    			},
   		 },
		messages: {
			newtitle: {
				required: '问题不能为空哦',
			},
			newtags: {
				required: '请至少添加1个标签',
			},
		},
   		highlight: function(element) {
   			 $(element).closest(".control-group").removeClass("success").addClass("danger");
  		},
  		success: function(element) {
   			 element.text("OK!").addClass("valid").closest(".control-group").removeClass("danger").addClass("success");
  		},
		submitHandler: function(form){
			var textarea = document.createElement("textarea");
			textarea.setAttribute("name", "details");
			var value = document.getElementById("newdetailedinfo").innerHTML;
			textarea.value = value;
			form.appendChild(textarea);
			form.submit();
		},
 	});

	$("#post-form").validate(
	 {
  		rules: {
    			title: {
      				required: true,
				},
    			tags: {
     				required: true,
    			},
 		 },
		messages: {
			title: {
				required: '问题不能为空哦',
			},
			tags: {
				required: '请至少添加1个标签',
			},
		},
   		highlight: function(element) {
   			 $(element).closest(".control-group").removeClass("success").addClass("danger");
  		},
  		success: function(element) {
   			 element.text("OK!").addClass("valid").closest(".control-group").removeClass("danger").addClass("success");
  		},
		submitHandler: function(form){
			var textarea = document.createElement("textarea");
			textarea.setAttribute("name", "details");
			var value = document.getElementById("detailedinfo").innerHTML;
			textarea.value = value;
			form.appendChild(textarea);
			form.submit();
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
    		registerpassword: {
				required: true,
				minlength: 2,
			},
    		password2: {
     			required: true,
				equalTo:"#registerpassword",
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
			registerpassword: {
				required: '密码不能为空哦',
				minlength: '请至少输入2个字符',
			},
			password2: {
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
