<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$query = "INSERT INTO BookDescriptions (BookDescriptionID, Description) VALUES (0,'" . $_POST['Description'] . "')";

if(!($con->query($query))) {
	echo json_encode(array('results' => 'failure1', 'error' => 'Query failed: ' . $query));
}
$id = mysqli_insert_id($con);

$query = "INSERT INTO Books (ISBN, NumPages, GenreID, BookTypeID, AuthorID, BookDescriptionID, BookID, Title, Quantity) VALUES (" . $_POST['ISBN'] . "," . $_POST['NumPages'] . "," . $_POST['GenreID'] . "," . $_POST['BookTypeID'] . "," . $_POST['AuthorID'] . "," . $id . ",0,'" . $_POST['Title'] . "'," . $_POST['Quantity'] . ")";
$result = $con->query($query);
if($result) {
	echo json_encode(array('results' => 'success'));
}else {
	$query = "DELETE FROM BookDescriptions WHERE BookDescriptionID =" . $id;
	$result = $con->query($query);
	if(!$result) {
		echo json_encode(array('results' => 'failure2', 'error' => 'Query failed: ' . $query));
	}
	echo json_encode(array('results' => 'failure3', 'error' => 'Add failed'));
}

$str = mysqli_connect_error();
$err = mysqli_connect_errno();
$str = mysqli_error($con);
$err = mysqli_errno($con);
mysqli_close($con);

?>