<?php


$dbhost = "acadmysql.duc.auburn.edu";
$dbuser = "jcg0031";
$dbpass = "78dsl50lo";
$dbname = "jcg0031db";
$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

$query = "SELECT Books.Title as Title, 
					Authors.FirstName as FirstName, 
					Authors.LastName as LastName,
					BookTypes.BookType as BookType,
					Genres.Genre as Genre,
					Books.NumPages as NumPages,
					BookDescriptions.Description as Description,
					Books.BookID as BookID,
					Books.Quantity as Quantity
					FROM Books 
					INNER JOIN Authors ON Books.AuthorID = Authors.AuthorID
					INNER JOIN BookTypes ON Books.BookTypeID = BookTypes.BookTypeID
					INNER JOIN Genres ON Books.GenreID = Genres.GenreID
					INNER JOIN BookDescriptions ON Books.BookDescriptionID = BookDescriptions.BookDescriptionID
					WHERE Books.BookID = " . $_POST['BookID'];
					
$result = mysqli_query($con, $query);
if(!$result) {
	echo json_encode(array('results' => 'failure1', 'error' => 'Query failed: ' . $query));
}
else if(empty($result)){
	echo json_encode(array('results' => 'failure2', 'error' => 'Book not found with specified ID: ' . $_POST['BookID']));
}
$row = mysqli_fetch_array($result);
$Book = array(
	'Title' => $row['Title'],
	'Author' => $row['FirstName'] . " " . $row['LastName'],
	'BookType' => $row['BookType'],
	'Genre' => $row['Genre'],
	'NumPages' => $row['NumPages'],
	'Description' => $row['Description'],
	'BookID' => $row['BookID'],
	'Quantity' => $row['Quantity'],
	'results' => 'success'
);


echo json_encode($Book);


$str = mysqli_connect_error();
$err = mysqli_connect_errno();
$str = mysqli_error($con);
$err = mysqli_errno($con);
mysqli_close($con);

?>