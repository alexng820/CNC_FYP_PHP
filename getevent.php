<?php
require_once 'include/functions.php';

//Connect to database
$connection = connectDB();
//JSON response array
$response = array("error" => FALSE);

$query = mysqli_query($connection, "SELECT * FROM `event_detail` WHERE 1");
if (mysqli_num_rows($query) == 0) {
	//If userID not exist
	$response["error"] = TRUE;
	$response["error_msg"] = "User not found. Please try again!";
	echo json_encode($response);
} else { 
	$i=0;
	while($row = mysqli_fetch_assoc($query)){
		$response["error"] = FALSE;
		$response["events"][$i]["event_id"] = $row['event_id'];
		$response["events"][$i]["topic"] = $row['topic'];
		$response["events"][$i]["guest"] = $row['guest'];
		$response["events"][$i]["limit_participant"] = $row['limit_participant'];
		$response["events"][$i]["need_approved"] = $row['need_approved'];
		$response["events"][$i]["location"] = $row['location'];				
		$response["events"][$i]["postime"] = $row['postime'];		
		$response["events"][$i]["date"] = $row['date'];	
		$response["events"][$i]["count_approved"] = $row['count_approved'];
		$response["events"][$i]["count_waiting"] = $row['count_waiting'];
		$response["events"][$i]["count_deny"] = $row['count_deny'];
		$i++;
	}
}


echo json_encode($response);
?>