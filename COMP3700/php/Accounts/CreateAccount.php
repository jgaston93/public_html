<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$query1 = "INSERT INTO Customers (FirstName, LastName, CustomerID) VALUES ('" . $_POST['FirstName'] . "','" . $_POST['LastName'] . "',0)";


$result = $con->query($query1);
if(!$result) {
	echo json_encode(array('results' => 'failure1', 'error' => 'Query failed: ' . $query));
}
$id = mysqli_insert_id($con);
$query2 = "INSERT INTO Accounts (Password, CreationDate, Status, Permission, CustomerID, AccountID) VALUES ('" . $_POST['Password'] . "','" . $_POST['CreationDate'] . "',0," . $_POST['Permission'] . "," . $id . ",0)";
$result = $con->query($query2);
if($result) {
	echo json_encode(array('results' => 'success'));
}else {
	$query = "DELETE FROM Customers WHERE Customer =" . $id;
	$result = $con->query($query);
	if(!$result) {
		echo json_encode(array('results' => 'failure2', 'error' => 'Add/Delete failed. Query failed: ' . $query));
	}else {
		echo json_encode(array('results' => 'failure3', 'error' => 'Add failed Customer Deleted'));
	}
}

$str = mysqli_connect_error();
$err = mysqli_connect_errno();
$str = mysqli_error($con);
$err = mysqli_errno($con);
mysqli_close($con);

?>