<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db"; 
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
session_start();

if(isset($_SESSION['userid']) && isset($_SESSION['permission'])) {
	$query = "select count(*) as total from WaitReports where BookID = " .$_POST['BookID'] . " && AccountID = " . $_SESSION['userid'] . " && Active = 1";
	$query1 = "select count(*) as total from Reports where BookID = " .$_POST['BookID'] . " && AccountID = " . $_SESSION['userid'] . " && Active = 1";
	$result = $con->query($query);
	$result1 = $con->query($query1);
	if(!$result){
		echo json_encode(array('results' => 'failure2', 'error' => 'Query failed: ' . $query));
	}
	$values = mysqli_fetch_assoc($result);
	$values1 = mysqli_fetch_assoc($result1);
	if($values['total'] == 0 && $values1['total'] == 0) {
		
		$query = "insert into WaitReports values (" . $_POST['BookID'] . "," . $_SESSION['userid'] . ",'" . date('Y-m-d H:i:s') ."', NULL, 1)";
		$result = $con->query($query);
		if($result) {
			echo json_encode(array('results' => 'success'));
		}else {
			echo json_encode(array('results' => 'failure4', 'error' => 'Query failed: ' . $query));
		}
	}else {
		echo json_encode(array('results' => 'failure3', 'error' => 'Already in waiting list.'));
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