<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$column_names = array();
$rows = array();
$query = "Select AuthorReviews.AuthorReviewID as id, Customers.FirstName as custFirstName, Customers.LastName as custLastName, Authors.FirstName as authFirstName, Authors.LastName as authLastName, AuthorReviews.Rating as Rating, AuthorReviews.Text as Text 
			from AuthorReviews
			inner join Accounts on AuthorReviews.AccountID = Accounts.AccountID
			inner join Customers on Accounts.CustomerID = Customers.CustomerID
			inner join Authors on AuthorReviews.AuthorID = Authors.AuthorID";
$result = mysqli_query($con, $query);
if(!$result) {
	$str = mysqli_error($con);
	echo json_encode(array('results' => 'failure1', 'error' => 'Query failed: ' . $str));
}else {

	$column_names = array(
		"Author",
		"Account",
		"Rating",
		"Review"
	);

	$result = mysqli_query($con, $query);
	while ($temp = mysqli_fetch_assoc($result)) {
		$fields =  array(
			$temp["authFirstName"] . " " . $temp["authLastName"],
			$temp["custFirstName"] . " " . $temp["custLastName"],
			$temp["Rating"] . "/5",
			$temp["Text"]
		);
		$row = array(
			'id' => $temp["id"],
			'fields' => $fields
		);

		array_push($rows , $row);
	}
	$return = array(
		'Columns' => $column_names,
		'Rows' => $rows,
		'results' => 'success'
	);
	echo json_encode($return);
}

$str = mysqli_connect_error();
$err = mysqli_connect_errno();
$str = mysqli_error($con);
$err = mysqli_errno($con);
mysqli_close($con);

?>