<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db"; 
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
session_start();
$query = "select Customers.FirstName as firstname, Customers.LastName as lastname, Accounts.Permission as permission, Accounts.AccountID as userid
			from Accounts
			inner join Customers on Accounts.CustomerID = Customers.CustomerID
			where Accounts.Password = '" . $_POST['Password'] . "' &&
					Customers.FirstName = '" . $_POST['UserName'] ."'";
$results = $con->query($query);	
if(!$results) {
	echo json_encode(array('results' => 'failure1', 'error' => 'Query failed: ' . $query));
}	
if($results->num_rows == 0) {
	echo json_encode(array('results' => 'failure2', 'error' => 'Invalid credentials' . $query));
}else {	
	$row = mysqli_fetch_assoc($results);
	$return = array(
		'results' => 'success',
		'firstname' => $row['firstname'],
		'lastname' => $row['lastname'],
		'permission' => $row['permission']
	);
	$_SESSION['userid'] = $row['userid'];
	$_SESSION['permission'] = $row['permission'];
	echo json_encode($return);
}


$str = mysqli_connect_error();
$err = mysqli_connect_errno();
$str = mysqli_error($con);
$err = mysqli_errno($con);
mysqli_close($con);

?>