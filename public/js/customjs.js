function checkTwoPassword(){
	var firstPassword = $("#firstPassword").val();
	var secondPassword = $("#secondPassword").val();
	if(firstPassword != secondPassword)
		alert("您输入的两个密码不一致");
}

function init(){
	$("#registerbtn").bind("click", checkTwoPassword);
}

$(document).ready(init);
