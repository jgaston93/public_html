<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db"; 
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);
session_start();

$temp = $con->query("select now()");
$current_date = mysqli_fetch_row($temp);
$current_datetime = date_parse($current_date[0]);
$temp = $con->query("select now() + interval 14 day");
$due_date = mysqli_fetch_row($temp);
$query3 = "select Reports.DueDate as DueDate, Reports.BookID as BookID, Reports.AccountID as AccountID from Reports where Reports.ReportID = " . $_POST['ReportID'];

$query8 = "select Reports.BookID";



if(isset($_SESSION['userid']) && isset($_SESSION['permission'])) {
	$query2 = "update Reports set Active = 0 where Reports.ReportID = " . $_POST['ReportID'];
	$result = $con->query($query2);
	if($result) {
		$result = $con->query($query3);
		if($result) {
			$row = mysqli_fetch_assoc($result);
			$duedate_datetime = $row['DueDate'];
			$current_datetime = $current_date[0];
			$AccountID = $row['AccountID'];
			$BookID = $row['BookID'];
			$query4 = "update Accounts set Fines = Fines + 1.50, Status = 1 where Accounts.AccountID = " . $AccountID;
			$query9 = "update Books set Books.Quantity = Books.Quantity + 1 where Books.BookID  = " . $BookID;
			$query5 = "select WaitReports.AccountID from WaitReports where WaitReports.BookID = " . $BookID . "&& WaitReports.Active = 1 order by WaitReports.StartDate asc limit 1";
			$query2 = "update Reports set Late = " . $late . " where Reports.ReportID = " . $_POST['ReportID'];

			$late = 0;
			if(strtotime($duedate_datetime) < strtotime($current_datetime)) {
				$late = 1;
				$result = $con->query($query4);
				if(!$result) {
					echo json_encode(array('results' => 'failure', 'error' => 'Query failed: ' . $query4));

				}
			}
			$result = $con->query($query5);
			if($result) {
				$row = mysqli_fetch_assoc($result);
				$query6 = "insert into Reports (ReportID, AccountID, BookID, StartDate, DueDate, PickedUp, Late, Lost, Active) values (0," . $row['AccountID'] . "," . $BookID . ",'" . $current_date[0] . "','" . $due_date[0] . "',0,0,0,1)";
				$query7 = "update WaitReports set WaitReports.Active = 0, WaitReports.EndDate = '" . $current_date[0] . "' where WaitReports.BookID = " .  $BookID . " &&  WaitReports.AccountID = " . $row['AccountID'];
				if($result->num_rows > 0) {
					$result = $con->query($query6);
					if($result) {
						$result = $con->query($query7);
						if($result) {
							$result = $con->query($query2);
							echo json_encode(array('results' => 'success', 'message' => 'waitreport filled2'));
						}else {
							echo json_encode(array('results' => 'failure6', 'error' => 'Query failed: ' . $query7));
						}
					}else {
						$result = $con->query($query2);
						echo json_encode(array('results' => 'success', 'message' => 'waitreport filled1'));
					}
				}
				else {
					$result = $con->query($query2);
					$result = $con->query($query9);
					if(!$result) {
						echo json_encode(array('results' => 'failure', 'error' => 'Query failed: ' . $query9));
					}else {
					echo json_encode(array('results' => 'success', 'message' => $row->num_rows));
					}
				}
			}	
			else {
				echo json_encode(array('results' => 'failure3', 'error' => 'Query failed: ' . $query5));
			}
		}else {
			echo json_encode(array('results' => 'failure7', 'error' => 'Query failed: ' . $query3));
		}
	}
	else {
		echo json_encode(array('results' => 'failure2', 'error' => 'Query failed: ' . $query2));
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