<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$rows = Array();
$column_names = Array();

$result = mysqli_query($con, $_POST["Query"]);
while ($row = mysqli_fetch_field($result))
array_push($column_names , $row->name);
array_push($rows, $column_names);
$result = mysqli_query($con, $_POST["Query"]);
while ($row = mysqli_fetch_array($result)) {
	$book = array(
		'Title' => $row['Title'],
		'AuthorID' => $row['AuthorID'],
		'ISBN' => $row['ISBN'],
		'NumPages' => $row['NumPages'],
		'BookTypeID' => $row['BookTypeID'],
		'GenreID' => $row['GenreID'],
		'BookID' => $row['BookID'],
	);
	array_push($rows , $book);
}

echo json_encode($rows);

$str = mysqli_connect_error();
$err = mysqli_connect_errno();
$str = mysqli_error($con);
$err = mysqli_errno($con);
mysqli_close($con);

?>