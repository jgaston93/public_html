<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$column_names = array();
$rows = array();
$query = "Select LastName,FirstName, AuthorID from Authors";
$result = mysqli_query($con, $query);
if(!$result) {
	echo json_encode(array('results' => 'failure1', 'error' => 'Query failed: ' . $query));
}
while ($row = mysqli_fetch_field($result)) {
	if($row->name != "AuthorID") {
		array_push($column_names , $row->name);
	}
}

$result = mysqli_query($con, $query);
while ($temp = mysqli_fetch_assoc($result)) {
	$fields =  array(
		$temp["FirstName"],
		$temp["LastName"]
	);
	$row = array(
		'id' => $temp["AuthorID"],
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