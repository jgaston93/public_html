<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
$return = Array();
$rows = Array();
$column_names = Array();
$query = "Select Customers.FirstName,Customers.LastName,Accounts.Status,Accounts.Permission,Accounts.AccountID
			from Accounts 
			inner join Customers on Accounts.CustomerID = Customers.CustomerID";
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_field($result))
array_push($column_names , $row->name);
array_push($return, $column_names);
$result = mysqli_query($con, $query);
while ($row = mysqli_fetch_array($result)) {
	array_push($rows , $row);
}
array_push($return, $rows);
echo json_encode($return);

$str = mysqli_connect_error();
$err = mysqli_connect_errno();
$str = mysqli_error($con);
$err = mysqli_errno($con);
mysqli_close($con);

?>