$(document).on("click", ".wait-button", function() {
	$.ajax({
			url: "COMP3700/php/WaitReports/CreateWaitReport.php",
			data: {BookID: $("#BookID").attr("BookID")},
			type: "post",
			success: function(data) {CreateWaitReportOutputHandler(data);},
			error: function(data) {alert(data);}
	});
});


function CreateWaitReportOutputHandler(data) {
	try {
		var result = $.parseJSON(data);
	}catch(e){
		alert("error: " + e + " data: " + data);
	}
	if(result.results == "success"){
		$("#WaitReportModal").modal('hide');
		$(".body").slideUp();
	}else if(result.results == "failure3"){
		$("#WaitReportModal").modal("hide");
		alert(result.error);
		
	}else{
		alert("error: " + result.results + " data: " + data);
	}
}

function showWaitReports() {
	$.ajax({
		url: "COMP3700/php/WaitReports/ShowWaitReports.php",
		type: "post",
		success: function(data) {ShowWaitReportsOutputHandler(data);},
		error: function(data){alert(data);}
	});
}

function ShowWaitReportsOutputHandler(data) {
		try {
		var results = jQuery.parseJSON(data);
		}catch(e) {
			console.log("error: " + e + " data: " + data);
		}
		columns = "<tr>";
		$.each(results.Columns, function(index, value) {
			columns += "<th>" + value + "</th>";
		});
		columns += "</tr>";
		rows = "";
		$.each(results.Rows, function(index, value) {
			rows += "<tr BookID='" + value.BookID + "' AccountID='" + value.AccountID + "' class='details-waitreport'>";
			$.each(value.fields, function(index, value) {
				rows += "<td>" + value + "</td>";
			});
			for(var i = 0; i < 3; i++) {
				
			}
			rows += "</tr>";
		});
		$("thead").html(columns);
		$("tbody").html(rows);
		$(".body").slideDown();
}

