<?php
require_once 'include/functions.php';

//Connect to database
$connection = connectDB();
//JSON response array
$event_id=$_GET["event_id"];

$query = mysqli_query($connection, "SELECT * FROM `event_detail` where event_id='$event_id'");
if (mysqli_num_rows($query) != 0) {  
	while($row = mysqli_fetch_assoc($query)){
		$response= $row['count_approved'];
	}
}


echo $response;
?>