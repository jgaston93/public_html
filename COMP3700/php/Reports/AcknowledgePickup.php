<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$query = "update Reports set Reports.PickedUp = 1 where Reports.ReportID = " . $_POST['ReportID'];
$result = $con->query($query);
if($result){
	echo json_encode(array('results' => 'success'));
}else {
	echo json_encode(array('results' => 'failure1', 'error' => 'Query failed: ' . $query));
}


$str = mysqli_connect_error();
$err = mysqli_connect_errno();
$str = mysqli_error($con);
$err = mysqli_errno($con);
mysqli_close($con);

?>