<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db"; 
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
session_start();

if(isset($_SESSION['userid']) && isset($_SESSION['permission'])) {
	
	$query = "insert into AuthorReviews (AuthorReviewID, AuthorID, AccountID, Rating, Text)
						values (0, " . $_POST['AuthorID'] . "," . $_SESSION['userid'] . ", " . $_POST['Rating'] . ", '" . $_POST['Text'] .  "')";
	
	$result = $con->query($query);
	if($result) {
		echo json_encode(array('results' => 'success'));
	}else {
		$str = mysqli_error($con);
		$err = mysqli_errno($con);
		echo json_encode(array(
			'results' => 'failure',
			'errno' =>  $err,
			'error' => $str
			));
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