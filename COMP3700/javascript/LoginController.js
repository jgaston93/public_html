$(document).on("click", ".login-btn", function() {
	$.ajax({
		url: "COMP3700/php/Login/Login.php",
		data: {UserName: $("#UserName").val(), Password: $("#Password").val()},
		type: "post",
		success: function(data) {LoginOutputHandler(data)},
		error: function(data) {alert(data);}
	});
});
 
$(document).on("click", ".logout-btn", function() {
	$.ajax({
		url: "COMP3700/php/Login/Logout.php",
		data: {},
		type: "post",
		success: function(data) {logoutSuccess(data);},
		error: function(data) {alert(data);}
	});
});


$(document).ready(function() {
	$.ajax({
		url: "COMP3700/php/Login/checkLogin.php",
		type: "post",
		success: function(data) {LoginOutputHandler(data)},
		error: function(data) {
			alert(data);
		}
	});
});

function LoginOutputHandler(data) {
	var results;
	try {
		var result = $.parseJSON(data);
	}catch(e) {
		alert("error: " + e + " data: " + data);
	}
	if(result.results == "success") {
		loginSuccess(result);
	}else {
		logoutSuccess();
	}
}




function loginSuccess(loginObject) {
	$("#user-name").html("Welcome, " + loginObject.firstname + " " + loginObject.lastname);
		$(".pre-login").hide();
		$(".post-login").show();
	if(loginObject.permission == 1) {
		$(".user-control").show();
		$(".admin-control").hide();
	}else if(loginObject.permission == 0) {
		$(".user-control").show();
		$(".admin-control").show();
	}
}

function logoutSuccess() {
	$(".body").html("").slideUp();
	$(".pre-login").show();
	$(".post-login").hide();
	$(".user-control").hide();
	$(".admin-control").hide();
}
