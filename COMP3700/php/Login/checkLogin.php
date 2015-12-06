<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db"; 
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
session_start();
if(isset($_SESSION['userid']) && isset($_SESSION['permission'])) {
	$query = "select Accounts.AccountID as userid, Accounts.Permission as permission, Customers.FirstName as firstname, Customers.LastName as lastname
			from Accounts
			inner join Customers on Accounts.CustomerID = Customers.CustomerID
			where Accounts.AccountID = " . $_SESSION['userid'];
	$results = $con->query($query);	
	$row = mysqli_fetch_assoc($results);
	$return = array(
		'userid' => $row['userid'],
		'permission' => $row['permission'],
		'firstname' => $row['firstname'],
		'lastname' => $row['lastname'],
		'results' => 'success'
	);
	echo json_encode($return);
}else {
	echo json_encode(array('results' => 'failure'));
}

$str = mysqli_connect_error();
$err = mysqli_connect_errno();
$str = mysqli_error($con);
$err = mysqli_errno($con);
mysqli_close($con);

?>