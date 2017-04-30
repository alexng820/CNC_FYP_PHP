<?php
require_once 'include/functions.php';

//Connect to database
$connection = connectDB();
//JSON response array
$response = array("success" => FALSE);
$event_id=$_GET["event_id"];
$participant_id=$_GET["participant_id"];
$status=$_GET["status"];

$query = mysqli_query($connection, "INSERT INTO `event_approval`(`event_id`, `participant_id`, `status`) VALUES ('$event_id','$participant_id','$status')");
if ($query == 1) {
	//If userID not exist
	$response["success"] = TRUE;
} else{
	$query = mysqli_query($connection, "select status from `event_approval` where `event_id`='$event_id' and `participant_id`='$participant_id'");
	if (mysqli_num_rows($query) != 0) {  
		while($row = mysqli_fetch_assoc($query)){
			$response["success"] = $row['status'];
		}
	}
}
echo json_encode($response);

?>