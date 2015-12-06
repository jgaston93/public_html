$(document).on("click", ".reserve-button", function() {
	$.ajax({
			url: "COMP3700/php/Reservations/CreateReservation.php",
			data: {BookID: $("#BookID").attr("BookID")},
			type: "post",
			success: function(data) {CreateReservationOutputHandler(data);},
			error: function(data) {alert(data);}
	});
});

function CreateReservationOutputHandler(data) {
	try {
		var result = $.parseJSON(data);
	}catch(e){
		alert("error: " + e + " data: " + data);
	}
	if(result.results == "success"){
		$(".body").slideUp();
	}else if(result.results == "failure2"){
		$("#ReservationModal").modal("hide");
		alert("Reservation already created");
		
	}else{
		alert("error: " + result.results + " data: " + data);
	}
}