function populateTable(d) {
		var results = jQuery.parseJSON(d);
		var rows = "";
		var columns = "";
		columns += "<tr>";
		$.each(results[0], function(k, v) {
			columns += "<th>" + v + "</th>";
		});
		columns += "</tr>";
		$.each(results[1], function(k, v) {
			rows += "<tr id='" + v[6] + "'>";
			for(var i = 0; i < 6; i++) {
				rows += "<td>" + v[i] + "</td>";
			}
			rows += "</tr>";
		});
		$("thead").html(columns);
		$("tbody").html(rows);
		$(".body").slideDown();
	}