$(document).on("click", ".create-book",  function(e) {
	e.preventDefault();
	$.ajax({
			url: "COMP3700/php/Books/CreateBook.php",
			data: {ISBN: $("#ISBN").val(), Title: $("#Title").val(), NumPages: $("#NumPages").val(), GenreID: $("#GenreID").val(), BookTypeID: $("#BookTypeID").val(), AuthorID: $("#AuthorID").val(), Quantity: $("#Quantity").val(), Description: $("#BookDescription").val()},
			type: "post",
			success: function(data) {CreateBookHandler(data);},
			error: function(data) {alert(data);}
	});
});

$(document).on("click", ".details-book",  function(e) {
	e.preventDefault();
	var id = $(this).attr("id");
	$(".body").slideUp(function() {loadPage($(".body"),"COMP3700/html/Books/BookDetails.html", function() {showBookDetails(id);})});
	
});

function showBooks() {
	$.ajax({
		url: "COMP3700/php/Books/ShowBooks.php",
		type: "post",
		success: function(data) {ShowBooksOutputHandler(data);},
		error: function(data){alert(data);}
	});
	
}

function showBookDetails(id) {
	$.ajax({
			url: "COMP3700/php/Books/GetBookDetails.php",
			data: {BookID: id},
			type: "post",
			success: function(data) {GetBookDetailsOutputHandler(data);},
			error: function(data) {alert(data);}
	});
}

function GetBookDetailsOutputHandler(data){
	try {
		var result = $.parseJSON(data);
	}catch(e){
		alert("error: " + e + " data: " + data);
	}
	if(result.results == "success"){
		populateBookDetails(result);
	}else {
		alert("error: " + result.results + " data: " + result.error);
	}
}


function CreateBookHandler(data) {
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

function ShowBooksOutputHandler(data) {
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
		rows += "<tr id='" + value.id + "' class='details-book'>"
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
function populateBookDetails(BookDetails) {
	$("#BookID").attr("BookID", BookDetails.BookID);
	$(".book-title").html(BookDetails.Title);
	$(".book-author").html(BookDetails.Author);
	$(".book-type").html(BookDetails.BookType);
	$(".book-genre").html(BookDetails.Genre);
	$(".book-numpages").html(BookDetails.NumPages);
	$(".book-description").html(BookDetails.Description);
	$(".book-quantity").html(BookDetails.Quantity);
	$(".body").slideDown();
}

 function loadPage(body, url, callback) {
	 $.ajax({
   url:url,
   type:'GET',
   cache: false,
   success: function(data){
       body.html(data);
	   callback();
   }
	 });
 }

