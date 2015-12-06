<?php

$dbhost1 = "acadmysql.duc.auburn.edu";
$dbuser1 = "jcg0031";
$dbpass1 = "78dsl50lo";
$dbname1 = "jcg0031db";
$con1 = mysqli_connect($dbhost1, $dbuser1, $dbpass1, $dbname1);



$str = mysqli_connect_error();
$err = mysqli_connect_errno();
$str = mysqli_error($con1);
$err = mysqli_errno($con1);
mysqli_close($con1);


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$rows = Array();
$query1 = "SELECT COLUMN_NAME FROM information_schema.COLUMNS WHERE TABLE_SCHEMA = 'jcg0031db' AND TABLE_NAME = '" . $_POST["TableName"] . "'";
$result1 = mysqli_query($con, $query1);
while ($row1 = mysqli_fetch_row($result1))
array_push($rows , $row1);


$query = "SELECT * FROM " . $_POST["TableName"];
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_row($result))
array_push($rows , $row);
echo json_encode($rows);

$str = mysqli_connect_error();
$err = mysqli_connect_errno();
$str = mysqli_error($con);
$err = mysqli_errno($con);
mysqli_close($con);

?>