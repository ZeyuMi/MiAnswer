function init(){
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
      				minlength: 2,
     				required: true,
    			},
    			passwordverify: {
      				minlength: 2,
     				required: true,
				equalTo:"#password",
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
