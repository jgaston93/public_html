<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$query = "INSERT INTO AuthorBios (AuthorBioID, BioText) VALUES (0,'" . $_POST['Bio'] . "')";
$result = $con->query($query);
if(!$result) {
	echo json_encode(array('results' => 'failure1', 'error' => 'Query failed: ' . $query));
}
$id = mysqli_insert_id($con);

$query = "INSERT INTO Authors VALUES (0,'" . $_POST['FirstName'] . "','" . $_POST['LastName'] . "'," . $id . ")";
$result = $con->query($query);
if($result) {
	echo json_encode(array('results' => 'success'));
}else {
	$query = "DELETE FROM AuthorBios WHERE AuthorBioID =" . $id;
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