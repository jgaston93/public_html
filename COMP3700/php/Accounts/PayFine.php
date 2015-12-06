<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db"; 
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
session_start();

if(isset($_SESSION['userid']) && isset($_SESSION['permission'])) {
	if($_SESSION['userid'] == $_POST['AccountID']) {
		$query = "update Accounts set Fines = 0, Status = 0 where Accounts.AccountID = " . $_POST['AccountID'];
		$result = $con->query($query);
		if($result) {
			echo json_encode(array('results' => 'success'));
		}else {
			$str = mysqli_error($con);
			$err = mysqli_errno($con);
			echo json_encode(array('results' => 'failure', 'error' => 'Query failed: ' . $str));
		}
	}else {
		echo json_encode(array('results' => 'failure', 'error' => "This isn't you're account"));
	}
}else {
	echo json_encode(array('results' => 'failure', 'error' => 'User not logged in'));
}


$str = mysqli_connect_error();
$err = mysqli_connect_errno();
$str = mysqli_error($con);
$err = mysqli_errno($con);
mysqli_close($con);

?>