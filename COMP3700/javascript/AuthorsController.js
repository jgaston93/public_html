$(document).on("click", ".create-author",  function(e) {
	e.preventDefault();
	$.ajax({
		url: "COMP3700/php/Authors/CreateAuthor.php",
		data: {FirstName: $("#FirstName").val(), LastName: $("#LastName").val(), Bio: $("#Bio").val()},
		type: "post",
		success: function(data) {CreateAuthorOutputHandler(data);},
		error: function() {alert("Coudn't Create Book");}
	});
});

$(document).on("click", ".details-author",  function(e) {
	e.preventDefault();
	var id = $(this).attr("id");
	$(".body").slideUp(function() {loadPage($(".body"),"COMP3700/html/Authors/AuthorDetails.html", function() {showAuthorDetails(id);})});
	
});

function showAuthorDetails(id) {
	$.ajax({
			url: "COMP3700/php/Authors/GetAuthorDetails.php",
			data: {AuthorID: id},
			type: "post",
			success: function(data) {GetAuthorDetailsOutputHandler(data);},
			error: function(data) {alert(data);}
	});
}

function GetAuthorDetailsOutputHandler(data){
	try {
		var result = $.parseJSON(data);
	}catch(e){
		alert("error: " + e + " data: " + data);
	}
	if(result.results == "success"){
		populateAuthorDetails(result);
	}else {
		alert("error: " + result.results + " data: " + result.error);
	}
}

function populateAuthorDetails(AuthorDetails) {
	$("#AuthorID").attr("AuthorID", AuthorDetails.AuthorID);
	$(".author-name").html(AuthorDetails.FullName);
	$(".author-bio").html(AuthorDetails.AuthorBio);
	$(".body").slideDown();
}

function showAuthors() {
	$.ajax({
		url: "COMP3700/php/Authors/ShowAuthors.php",
		type: "post",
		success: function(data) {ShowAuthorsOutputHandler(data);},
		error: function(data){alert(data);}
	});
	
}

function CreateAuthorOutputHandler(data) {
	try{
		var result = $.parseJSON(data);
	}catch(e) {
		alert("error: " + e + " data: " + data);
	}
	if(result.results == "success") {
		$(".body").slideUp();
	}else {
		alert("error: " + result.results + " data: " + result.error);
	}
}
function ShowAuthorsOutputHandler(data) {
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
		rows += "<tr id='" + value.id + "' class='details-author'>"
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

