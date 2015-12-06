$(document).on("click", ".create-account", function(e) {
	e.preventDefault();
	var date = (new Date()).toISOString().substring(0, 10);
	$.ajax({
		url: "COMP3700/php/Accounts/CreateAccount.php",
		data: {FirstName: $(".FirstName").val(), LastName: $(".LastName").val(), Password: $(".Password").val(), Permission: $('input[name="Permission"]:checked').val(), CreationDate: date},
		type: "post",
		success: function(data) {
			$(".body").slideUp();
			console.log(data);},
		error: function(data){
			console.log(data);}
	});
});

$(document).on("click", ".pay-form-button", function() {
	$("#PayFineModal").modal('show');
});

$(document).on("click", ".pay-fine-button", function() {
	$.ajax({
			url: "COMP3700/php/Accounts/PayFine.php",
			data: {AccountID: $("#AccountID").attr("accountid")},
			type: "post",
			success: function(data) {PayFineOutputHandler(data);},
			error: function(data) {alert(data);}
	});
});

function PayFineOutputHandler(data) {
	try {
		var result = jQuery.parseJSON(data);
	}catch(e) {
		alert("error: " + e + " data: " + data);
	}
	if(result.results != 'success') {
		alert(result.error);
	}
	$(".body").slideUp();
	$("#PayFineModal").modal("hide");
}

function showAccounts() {
	$.ajax({
		url: "COMP3700/php/Accounts/ShowAccounts.php",
		type: "post",
		success: function(data) {console.log(data);populateAccountTable(data);},
		error: function(data){alert(data);}
	});
	
}

function showMyAccountDetails() {
	$.ajax({
		url: "COMP3700/php/Accounts/ShowMyAccountDetails.php",
		type: "post",
		success: function(data) {GetAccountDetailsOutputHandler(data);},
		error: function(data){alert(data);}
	});
}

$(document).on("click", ".details-account",  function(e) {
	e.preventDefault();
	var id = $(this).attr("id");
	$(".body").slideUp(function() {loadPage($(".body"),"COMP3700/html/Accounts/AccountDetails.html", function() {showAccountDetails(id);})});
	
});

function showAccountDetails(id) {
	$.ajax({
			url: "COMP3700/php/Accounts/GetAccountDetails.php",
			data: {AccountID: id},
			type: "post",
			success: function(data) {GetAccountDetailsOutputHandler(data);},
			error: function(data) {alert(data);}
	});
}

function GetAccountDetailsOutputHandler(data) {
	try {
		var Account = jQuery.parseJSON(data);
	}catch(e) {
		alert("error: " + e + " data: " + data);
	}
	if(Account.results == 'success') {
		$("#AccountID").attr("AccountID", Account.AccountID);
		$(".account-username").html(Account.UserName);
		$(".account-status").html(Account.Status);
		$(".account-permission").html(Account.Permission);
		$(".account-fines").html(Account.Fines);
		$(".account-creationdate").html(Account.CreationDate);
		
		$(".body").slideDown();
	}else {
		alert("reults: " + result.results + " error: " + result.error);
	}
}

function populateAccountTable(d) {
		var results = jQuery.parseJSON(d);
		var rows = "";
		var columns = "";
		columns += "<tr>";
		for(var i = 0; i < 4; i++) {
			columns += "<th>" + results[0][i] + "</th>";
		}
		columns += "</tr>";
		$.each(results[1], function(k, v) {
			rows += "<tr id='" + v[4] + "' class='details-account'>";
			for(var i = 0; i < 4; i++) {
				rows += "<td>" + v[i] + "</td>";
			}
			rows += "</tr>";
		});
		$("thead").html(columns);
		$("tbody").html(rows);
		$(".body").slideDown();
	}