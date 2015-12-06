<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$column_names = array();
$rows = array();
$query = "Select Books.BookID as BookID , Books.Title as Title ,Authors.FirstName as FirstName,  Authors.LastName as LastName,Books.Quantity as Quantity from Books inner join Authors on Books.AuthorID = Authors.AuthorID";
$result = mysqli_query($con, $query);
if(!$result) {
	echo json_encode(array('results' => 'failure1', 'error' => 'Query failed: ' . $query));
}
$column_names = array("Title", "Author", "Quantity");
while ($temp = mysqli_fetch_assoc($result)) {
	$fields =  array(
		$temp["Title"],
		$temp["FirstName"] . " " . $temp["LastName"],
		$temp["Quantity"]
	);
	$row = array(
		'id' => $temp["BookID"],
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

$str = mysqli_connect_error();
$err = mysqli_connect_errno();
$str = mysqli_error($con);
$err = mysqli_errno($con);
mysqli_close($con);

?>