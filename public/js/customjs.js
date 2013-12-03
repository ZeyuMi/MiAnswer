function fileUpload(input) {
	if (input.files && input.files[0]) {
		var reader = new FileReader();

		reader.onload = function (e) {

			document.getElementById('detailedinfo').innerHTML += "<img src=\"" + e.target.result + "\"></img>";
		}

		reader.readAsDataURL(input.files[0]);
	}
	//    // Create the iframe...
	//    var iframe = document.createElement("iframe");
	//	iframe.setAttribute("id", "upload_iframe");
	//	iframe.setAttribute("name", "upload_iframe");
	//	iframe.setAttribute("width", "0");
	//	iframe.setAttribute("height", "0");
	//	iframe.setAttribute("border", "0");
	//	iframe.setAttribute("style", "width: 0; height: 0; border: none;");		 
	//	// Add to document...
	//	var form = $("#post-form")[0];
	//	form.parentNode.appendChild(iframe);
	//	window.frames['upload_iframe'].name = "upload_iframe";
	// 
	//	iframeId = $("#upload_iframe");
	//										 
	//	// Add event...
	//	var eventHandler = function () {
	//												 
	//		if (iframeId.detachEvent) 
	//			iframeId.detachEvent("onload", eventHandler);
	//        else 
	//			iframeId.removeEventListener("load", eventHandler, false);
	//																		 
    //    // Message from server...
	//		if (iframeId.contentDocument) {
	//			content = iframeId.contentDocument.body.innerHTML;
	//		} else if (iframeId.contentWindow) {
	//			content = iframeId.contentWindow.document.body.innerHTML;
	//		} else if (iframeId.document) {
	//			content = iframeId.document.body.innerHTML;
	//		}

	//		document.getElementById(div_id).innerHTML = content;

	//		// Del the iframe...
	//		setTimeout('iframeId.parentNode.removeChild(iframeId)', 250);
	//	}

	//	if (iframeId.addEventListener) iframeId.addEventListener("load", eventHandler, true);
	//	if (iframeId.attachEvent) iframeId.attachEvent("onload", eventHandler);

	//	// Set properties of form...
	//	form.setAttribute("target", "upload_iframe");
	//	form.setAttribute("action", "http://127.0.0.1/MiAnswer/topics/uploadImage");
	//	form.setAttribute("method", "post");
	//	form.setAttribute("enctype", "multipart/form-data");
	//	form.setAttribute("encoding", "multipart/form-data");

	//	// Submit the form...
	//	form.submit();
}

function init(){
	$("#inputFile").change(function(){
			fileUpload(this)});
	$("#post-form").validate(
	 {
  		rules: {
    			title: {
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
    		registerpassword: {
				required: true,
				minlength: 3,
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
				minlength: '请至少输入3个字符',
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
