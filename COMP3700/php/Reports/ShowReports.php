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
	$query = "Select Reports.ReportID as ReportID, Books.Title as Title, Customers.FirstName as FirstName, Customers.LastName as LastName, Reports.DueDate as DueDate, Reports.Active as Active from Reports inner join Books on Reports.BookID = Books.BookID inner join Accounts on Reports.AccountID = Accounts.AccountID inner join Customers on Accounts.CustomerID = Customers.CustomerID";
	}else if($_SESSION['permission'] == 1){
	$query = "Select Reports.ReportID as ReportID, Books.Title as Title, Customers.FirstName as FirstName, Customers.LastName as LastName, Reports.DueDate as DueDate, Reports.Active as Active  
				from Reports 
				inner join Accounts on Reports.AccountID = Accounts.AccountID
				inner join Books on Reports.BookID = Books.BookID
				inner join Customers on Accounts.CustomerID = Customers.CustomerID
				where Accounts.AccountID =" . $_SESSION['userid'];
	}else {
		echo json_encode(array('results' => 'failure2', 'error' => 'Invalid permission level: ' . $_SESSION['permission']));
	}
	$column_names = array(
		'User Name', 'Title', 'Due Date', 'Active'
	);
	$result = mysqli_query($con, $query);
	if(!$result) {
		echo json_encode(array('results' => 'failure3', 'error' => 'Query Failed: ' . $query));
	}else {
		while ($row = mysqli_fetch_assoc($result)) {
			$fields =  array(
					$row['FirstName'] . " " . $row['LastName'],
					$row['Title'],
					$row['DueDate'],
					$row['Active']
				);
			$row = array(
				'id' => $row['ReportID'],
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