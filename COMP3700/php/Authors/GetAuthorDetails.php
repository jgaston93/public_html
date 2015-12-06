<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$query = "SELECT Authors.AuthorID as AuthorID,
					Authors.FirstName as FirstName, 
					Authors.LastName as LastName,
					AuthorBios.BioText as BioText
					FROM Authors 
					INNER JOIN AuthorBios ON Authors.AuthorBioID = AuthorBios.AuthorBioID
					WHERE Authors.AuthorID = " . $_POST['AuthorID'];
					
$result = mysqli_query($con, $query);
if(!$result) {
	echo json_encode(array('results' => 'failure1', 'error' => 'Query failed: ' . $query));
}
else if(empty($result)){
	echo json_encode(array('results' => 'failure2', 'error' => 'Author not found with specified ID: ' . $_POST['AuthorID']));
}
$row = mysqli_fetch_array($result);
$Author = array(
	'AuthorID' => $row['AuthorID'],
	'FullName' => $row['FirstName'] . " " . $row['LastName'],
	'AuthorBio' => $row['BioText'],
	'results' => 'success'
);


echo json_encode($Author);


$str = mysqli_connect_error();
$err = mysqli_connect_errno();
$str = mysqli_error($con);
$err = mysqli_errno($con);
mysqli_close($con);

?>