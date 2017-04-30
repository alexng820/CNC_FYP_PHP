<?php
require_once 'include/functions.php';

//Connect to database
$connection = connectDB();
//JSON response array
$response = array("error" => FALSE);
$participant_id=$_GET["participant_id"];
$query = mysqli_query($connection, "SELECT * FROM `event_approval` WHERE participant_id='".$participant_id."'");
if (mysqli_num_rows($query) == 0) {
	//If userID not exist
	$response["error"] = TRUE;
	$response["error_msg"] = "User not found. Please try again!";
} else { 
	$i=0;
	while($row = mysqli_fetch_assoc($query)){
		$response["error"] = FALSE;
		$response["eventstatus"][$i]["event_id"] = $row['event_id'];
		$response["eventstatus"][$i]["participant_id"] = $row['participant_id'];
		$response["eventstatus"][$i]["status"] = $row['status'];
		$i++;
	}
}


echo json_encode($response);
?>