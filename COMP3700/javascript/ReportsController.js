$(document).on("click", ".check-out", function(e) {
	e.preventDefault();
	$.ajax({
			url: "COMP3700/php/Reports/CheckOut.php",
			data: {BookID: $("#BookID").attr("BookID")},
			type: "post",
			success: function(data) {CheckOutOutputHandler(data);},
			error: function(data) {alert(data);}
	});
});
$(document).on("click", ".check-in", function(e) {
	e.preventDefault();
	$.ajax({
			url: "COMP3700/php/Reports/CheckIn.php",
			data: {ReportID: $("#ReportID").attr("reportid")},
			type: "post",
			success: function(data) {CheckInOutputHandler(data);},
			error: function(data) {alert(data);}
	});
});

$(document).on("click", ".acknowledge-pickup", function(e) {
	e.preventDefault();
	$.ajax({
			url: "COMP3700/php/Reports/AcknowledgePickup.php",
			data: {ReportID: $("#ReportID").attr("ReportID")},
			type: "post",
			success: function(data) {AcknowledgePickupOutputHandler(data);},
			error: function(data) {alert(data);}
	});
});

$(document).on("click", ".details-report",  function(e) {
	e.preventDefault();
	var id = $(this).attr("id");
	$(".body").slideUp(function() {loadPage($(".body"),"COMP3700/html/Reports/ReportDetails.html", function() {showReportDetails(id);})});
	
});

function showReportDetails(id) {
	$.ajax({
			url: "COMP3700/php/Reports/GetReportDetails.php",
			data: {ReportID: id},
			type: "post",
			success: function(data) {GetReportDetailsOutputHandler(data);},
			error: function(data) {alert(data);}
	});
}

function showReports() {
	$.ajax({
		url: "COMP3700/php/Reports/ShowReports.php",
		type: "post",
		success: function(data) {ShowReportsOutputHandler(data);},
		error: function(data){alert(data);}
	});
	
}

function AcknowledgePickupOutputHandler(data) {
	try {
		var result = $.parseJSON(data);
	}catch(e){
		alert("error: " + e + " data: " + data);
	}
	if(result.results == "success"){
		$(".body").slideUp();
	}else {
		alert("error: " + result.error);
	}
}

function ShowReportsOutputHandler(data) {
		try {
		var result = jQuery.parseJSON(data);
		}catch(e) {
			console.log("error: " + e + " data: " + data);
		}
		if(result.results == "success") {
			columns = "<tr>";
			$.each(result.Columns, function(index, value) {
				columns += "<th>" + value + "</th>";
			});
			columns += "</tr>";
			rows = "";
			$.each(result.Rows, function(index, value) {
				rows += "<tr id='" + value.id + "' class='details-report'>";
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
		}else {
			console.log("result: " + result.results + " error: " + result.error);
		}
}

function CheckOutOutputHandler(data) {
	try {
		var result = $.parseJSON(data);
	}catch(e){
		alert("error: " + e + " data: " + data);
	}
	if(result.results == "success"){
		$(".body").slideUp();
	}else if(result.results == "failure4"){
		$("#WaitReportModal").modal("show");
	}else {
		alert("error: " + result.error);
	}
}

function CheckInOutputHandler(data) {
	try {
		var result = $.parseJSON(data);
	}catch(e){
		alert("error: " + e + " data: " + data);
	}
	if(result.results == "success"){
		$(".body").slideUp();
	}else {
		alert("error: " + result.error);
	}
}

function GetReportDetailsOutputHandler(data) {
	try {
		var Report = jQuery.parseJSON(data);
	}catch(e) {
		alert("error: " + e + " data: " + data);
	}
	if(Report.results == 'success') {
		$("#ReportID").attr("ReportID", Report.ReportID);
		$(".report-patron").html(Report.Patron);
		$(".report-book").html(Report.Book);
		$(".report-startdate").html(Report.StartDate);
		$(".report-duedate").html(Report.DueDate);
		$(".report-pickedup").html(Report.PickedUp);
		$(".report-Active").html(Report.Active);
		$(".report-late").html(Report.Late);
		$(".report-lost").html(Report.Lost);
		
		if(Report.Permission == 0) {
			$(".cancel").hide();
			$(".renew").hide();
			if(Report.Active == 1) {
				if(Report.PickedUp == 1) {
					$(".check-in").show();
					$(".acknowledge-pickup").hide();
				}else {
					$(".check-in").hide();
					$(".acknowledge-pickup").show();
				}
			}else {
				$(".check-in").hide();
				$(".acknowledge-pickup").hide();
				
			}
		}else {
			$(".check-in").hide();
			$(".acknowledge-pickup").hide();
			if(Report.Active == 1) {
				if(Report.PickedUp == 1 && Report.Late == 0 && Report.Lost == 0) {
					$(".cancel").hide();
					$(".renew").show();
				}else {
					$(".cancel").show();
					$(".renew").hide();
				}
			}
			else{
				$(".cancel").hide();
				$(".renew").hide();
			}
		
		}
		$(".body").slideDown();
	}else {
		alert("reults: " + result.results + " error: " + result.error);
	}
}