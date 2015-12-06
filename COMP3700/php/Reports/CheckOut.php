<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db"; 
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
session_start();

if(isset($_SESSION['userid']) && isset($_SESSION['permission'])) {
	$query = "select Quantity
				from Books
				where BookID = " . $_POST['BookID'];
	$temp = $con->query($query);
	if(!$temp) {
		echo json_encode(array('results' => 'failure2', 'error' => 'Query failed: ' . $query));
	}
	else if($temp->num_rows == 0) {
		echo json_encode(array('results' => 'failure3', 'error' => 'Book not found with specified ID: ' . $_POST['BookID']));
	}
	$quantity = mysqli_fetch_row($temp);
	if($quantity[0] > 0) {
		$query = "select count(*) as total from Reports where BookID = " . $_POST['BookID'] . " && AccountID = " . $_SESSION['userid'] . " && Active = 1";
		$result = $con->query($query);
		if(!$result) {
			echo json_encode(array('results' => 'failure5', 'error' => 'Query failed: ' . $query));
		}
		$values = mysqli_fetch_assoc($result);
		if($values['total'] > 0) {
			echo json_encode(array('results' => 'failure6', 'error' => 'This user already has an active report for this book'));
		}else {
			$temp = $con->query("select curdate()");
			$current_date = mysqli_fetch_row($temp);
			$temp = $con->query("select curdate() + interval 14 day");
			$due_date = mysqli_fetch_row($temp);
			$query1 = "insert into Reports (StartDate, DueDate, AccountID, BookID, ReportID, PickedUp, Late, Lost, Active)
						values ('" . $current_date[0] . "', '" . $due_date[0] . "'," . $_SESSION['userid'] . "," . $_POST['BookID'] . ", 0, 0, 0, 0, 1)";
			$query2 = "update Books
						set Quantity = Quantity - 1
						where Books.BookID = " . $_POST['BookID'];
			$results = $con->query($query1);					
			if($results) {
				$results = $con->query($query2);
				if($results) {
					echo json_encode(array('results' => 'success'));
				}
			}else {
				echo json_encode(array('results' => 'failure7', 'error' => 'Query failed: ' . $query1));
			}
		}
	}else {
		echo json_encode(array('results' => 'failure4', 'error' => 'Insufficient Quantity'));
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