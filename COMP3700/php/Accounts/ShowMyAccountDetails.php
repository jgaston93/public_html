<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
session_start();
$query = "SELECT Accounts.AccountID as AccountID,Customers.LastName as LastName, Customers.FirstName as FirstName,Accounts.Status as Status, Accounts.Permission as Permission, Accounts.CreationDate as CreationDate, Accounts.Fines as Fines FROM Accounts inner join Customers on Accounts.CustomerID = Customers.CustomerID WHERE Accounts.AccountID = " . $_SESSION['userid'];
					
$result = mysqli_query($con, $query);
if(!$result) {
	$str = mysqli_error($con);
	echo json_encode(array('results' => 'failure1', 'error' => 'Query failed: '. $str));
}
else if($result->num_rows == 0) {
	echo json_encode(array('results' => 'failure2', 'error' => 'Query empty: '. $query));
}else {
	$row = mysqli_fetch_assoc($result);
	$Account = array(
		'UserName' => $row['FirstName'] . " " . $row['LastName'],
		'AccountID' => $row['AccountID'],
		'CreationDate' => $row['CreationDate'],
		'Status' => $row['Status'],
		'Permission' => $row['Permission'],
		'Fines' => $row['Fines'], 
		'results' => 'success'
	);


	echo json_encode($Account);
}


$str = mysqli_connect_error();
$err = mysqli_connect_errno();
$str = mysqli_error($con);
$err = mysqli_errno($con);
mysqli_close($con);

?>