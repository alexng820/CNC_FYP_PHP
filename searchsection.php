<?php
require_once 'include/functions.php';

//Connect to database
$connection = connectDB();
//JSON response array
$response = array("error" => FALSE);

//Check if parameters is all filled in
if (isset($_GET['userID'])) {
	//Parameters all filled in
	//Escapee string to prevent SQL injection attacks
	$userID = mysqli_real_escape_string($connection, $_GET['userID']);
	//$userID="s10000002";
	//Search for existing user
	
	
	$query = mysqli_query($connection, "SELECT * FROM `term` WHERE `status`='active'");
	$row = mysqli_fetch_assoc($query);
	$response["term"]["start_year"] = $row['start_year'];
	$response["term"]["start_month"] = $row['start_month'];
	$response["term"]["start_week"] = $row['start_week'];
	$response["term"]["end_year"] = $row['end_year'];
	$response["term"]["end_month"] = $row['end_month'];
	$response["term"]["end_week"] = $row['end_week'];
	
	$query = mysqli_query($connection, "Select * from section where section_code in (SELECT section_code FROM `StudentCourseMap` WHERE user_id='$userID')");
	if (mysqli_num_rows($query) == 0) {
		//If userID not exist
		$response["error"] = TRUE;
		$response["error_msg"] = "User not found. Please try again!";
		echo json_encode($response);
	} else { 
		$i=0;
		while($row = mysqli_fetch_assoc($query)){
			$response["error"] = FALSE;
			$response["section"][$i]["section_code"] = $row['section_code'];
			$response["section"][$i]["weekday"] = $row['weekday'];
			$response["section"][$i]["starttime"] = $row['starttime'];
			$response["section"][$i]["endtime"] = $row['endtime'];
			$response["section"][$i]["location"] = $row['location'];			
			$response["section"][$i]["tearcher"] = $row['tearcher'];
			$i++;
		}
	}
	
	
	echo json_encode($response);
} else {
	//Required parameters is missing
	$response["error"] = TRUE;
	$response["error_msg"] = "User ID is missing!";
	echo json_encode($response);
}
?>