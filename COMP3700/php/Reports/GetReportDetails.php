<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
session_start();
$query = "SELECT Customers.FirstName as FirstName,Customers.LastName as LastName,Books.Title as Book, Reports.StartDate as StartDate,Reports.DueDate as DueDate,Reports.ReportID as ReportID, Reports.PickedUp as PickedUp, Reports.Active as Active, Reports.Lost as Lost, Reports.Late as Late, Accounts.Permission as Permission FROM Reports INNER JOIN Accounts ON Reports.AccountID = Accounts.AccountID INNER JOIN Customers ON Accounts.CustomerID = Customers.CustomerID INNER JOIN Books ON Reports.BookID = Books.BookID WHERE Reports.ReportID = " . $_POST['ReportID'];
					
$result = mysqli_query($con, $query);
if(!$result) {
	echo json_encode(array('results' => 'failure1', 'error' => 'Query failed: '. $result));
}
else if($result->num_rows == 0) {
	echo json_encode(array('results' => 'failure2', 'error' => 'Query empty: '. $result));
}
$row = mysqli_fetch_array($result);
$Report = array(
	'Patron' => $row['FirstName'] . " " . $row['LastName'],
	'Book' => $row['Book'],
	'StartDate' => $row['StartDate'],
	'DueDate' => $row['DueDate'],
	'ReportID' => $row['ReportID'],
	'Permission' => $_SESSION['permission'],
	'Late' => $row['Late'],
	'PickedUp' => $row['PickedUp'],
	'Lost' => $row['Lost'],
	'Active' => $row['Active'],
	'results' => 'success'
);


echo json_encode($Report);


$str = mysqli_connect_error();
$err = mysqli_connect_errno();
$str = mysqli_error($con);
$err = mysqli_errno($con);
mysqli_close($con);

?>