<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
session_start();
$return = Array();
$rows = Array();
$column_names = Array();
if(isset($_SESSION['userid'])  && isset($_SESSION['permission'])) {
	if($_SESSION['permission'] == 0) {
	$query = "Select Customers.FirstName as FirstName, Customers.LastName as LastName, Books.Title as Title, WaitReports.StartDate as StartDate, WaitReports.EndDate as EndDate, WaitReports.Active as Active, WaitReports.BookID as BookID, WaitReports.AccountID as AccountID from WaitReports inner join Accounts on WaitReports.AccountID = Accounts.AccountID inner join Books on WaitReports.BookID = Books.BookID inner join Customers on Accounts.CustomerID = Customers.CustomerID";
	}else if($_SESSION['permission'] == 1){
	$query = "Select Customers.FirstName as FirstName, Customers.LastName as LastName, Books.Title as Title, WaitReports.StartDate as StartDate, WaitReports.EndDate as EndDate, WaitReports.Active as Active, WaitReports.BookID as BookID, WaitReports.AccountID as AccountID from WaitReports inner join Accounts on WaitReports.AccountID = Accounts.AccountID inner join Books on WaitReports.BookID = Books.BookID inner join Customers on Accounts.CustomerID = Customers.CustomerID where Accounts.AccountID =" . $_SESSION['userid'];
	}else {
		echo json_encode(array('results' => 'failure2', 'error' => 'Invalid permission level: ' . $_SESSION['permission']));
	}
	$result = mysqli_query($con, $query);
	if(!$result) {
		echo json_encode(array('results' => 'failure3', 'error' => 'Query failed: ' . $query));
	}else {
		$column_names = array(
			'User Name', 'Title', 'StartDate', 'Active'
		);
		$result = mysqli_query($con, $query);
		while ($row = mysqli_fetch_assoc($result)) {
			$fields =  array(
					$row['FirstName'] . " " . $row['LastName'],
					$row['Title'],
					$row['StartDate'],
					$row['Active']
				);
			$row = array(
				'BookID' => $row['BookID'],
				'AccountID' => $row['AccountID'],
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
	}
}else {
	echo json_encode(array('results' => 'failure1', 'error' => 'User not logged in'));
}

$str = mysqli_connect_error();
$err = mysqli_connect_errno();
$str = mysqli_error($con);
$err = mysqli_errno($con);
mysqli_close($con);

?>