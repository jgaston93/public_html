<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$query = stripslashes($_POST['Query']);
$result = $con->query($query);

$rows = Array();
$column_names = Array();

if($result) {
	while ($row = mysqli_fetch_field($result))
	array_push($column_names , $row->name);
	$result = mysqli_query($con, $query);
	while ($row = mysqli_fetch_row($result))
	array_push($rows, $row);
	echo json_encode(array(
		'results' => 'success',
		'column_names' => $column_names,
		'rows' => $rows
	));
}else {
	echo json_encode(array(
		'results' => 'failure',
		'query' => $query,
		'error' => mysqli_error($con),
		'errno' => mysqli_errno($con)
	));
}
mysqli_close($con);

?>