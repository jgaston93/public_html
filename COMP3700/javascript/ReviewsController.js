
$(document).on("click", ".review-form-button", function() {
	$("#BookReviewModal").modal('show');
});

$(document).on("click", ".review-book-button", function() {
	$.ajax({
			url: "COMP3700/php/Reviews/CreateBookReview.php",
			data: {BookID: $("#BookID").attr("BookID"), Rating: $(".review-rating").val(), Text: $(".review-text").val()},
			type: "post",
			success: function(data) {CreateBookReviewHandler(data);},
			error: function(data) {alert(data);}
	});
});

$(document).on("click", ".review-form-button", function() {
	$("#AuthorReviewModal").modal('show');
});

$(document).on("click", ".review-author-button", function() {
	$.ajax({
			url: "COMP3700/php/Reviews/CreateAuthorReview.php",
			data: {AuthorID: $("#AuthorID").attr("AuthorID"), Rating: $(".review-rating").val(), Text: $(".review-text").val()},
			type: "post",
			success: function(data) {CreateAuthorReviewHandler(data);},
			error: function(data) {alert(data);}
	});
});




$(document).on("click", ".rating-element" ,function() {
	if($(this).attr("data-rating") != $(".review-rating").val()){
		$(".glyphicon-star").toggleClass("glyphicon-star-empty").toggleClass("glyphicon-star");
		$(this).toggleClass("glyphicon-star-empty");
		$(this).toggleClass("glyphicon-star");
		$(".review-rating").val($(this).attr("data-rating"));
	}
});


function CreateBookReviewHandler(data) {
	try {
		var result = jQuery.parseJSON(data);
	}catch(e) {
		console.log("error: " + e + " data: " + data);
	}
	if(result.results == "success"){
		$(".body").slideUp();
	}else {
		alert(result.error);
	}
	$("#BookReviewModal").modal("hide");
}

function CreateAuthorReviewHandler(data) {
	try {
		var result = jQuery.parseJSON(data);
	}catch(e) {
		console.log("error: " + e + " data: " + data);
	}
	if(result.results == "success"){
		$(".body").slideUp();
	}else {
		alert(result.error);
	}
	$("#AuthorReviewModal").modal("hide");
}

function showBookReviews() {
	$.ajax({
		url: "COMP3700/php/Reviews/ShowBookReviews.php",
		type: "post",
		success: function(data) {ShowReviewsOutputHandler(data);},
		error: function(data){alert(data);}
	});
	
}

function showAuthorReviews() {
	$.ajax({
		url: "COMP3700/php/Reviews/ShowAuthorReviews.php",
		type: "post",
		success: function(data) {ShowReviewsOutputHandler(data);},
		error: function(data){alert(data);}
	});
	
}
function ShowReviewsOutputHandler(data) {
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
		rows += "<tr id='" + value.id + "' class='details-review'>"
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
	
	function ShowBookReviewsOutputHandler(data) {
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
		rows += "<tr id='" + value.id + "' class='details-book-review'>"
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
	
