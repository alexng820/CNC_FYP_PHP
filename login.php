<?php
require_once 'include/functions.php';

//Connect to database
$connection = connectDB();

//JSON response array
$response = array("error" => FALSE);

//Check if parameters is all filled in
if (isset($_POST['userID']) && isset($_POST['userPass'])) {
	//Parameters all filled in
	//Escapee string to prevent SQL injection attacks
	$userID = mysqli_real_escape_string($connection, $_POST['userID']);
	$userPass = mysqli_real_escape_string($connection, $_POST['userPass']);

	//Search for existing user
	$query = mysqli_query($connection, "SELECT * FROM user WHERE user_id = '$userID' LIMIT 1");
	if (mysqli_num_rows($query) == 0) {
		//If userID not exist
		$response["error"] = TRUE;
		$response["error_msg"] = "User not found. Please try again!";
		echo json_encode($response);
	} else {
		//If userID exist
		$row = mysqli_fetch_assoc($query);
		$dbPass = $row['password'];
		//Verify encrypted password
		if (password_verify($userPass, $dbPass)) {
			//Credential matches
			$query = mysqli_query($connection, "SELECT * FROM user WHERE user_id = '$userID' LIMIT 1");
			$row = mysqli_fetch_assoc($query);
			$response["error"] = FALSE;
			$response["user"]["userID"] = $row['user_id'];
			$response["user"]["userName"] = $row['name'];
			$response["user"]["userGender"] = $row['gender'];
			$response["user"]["userRole"] = $row['role'];
			$response["user"]["userStatus"] = $row['status'];
			echo json_encode($response);
		} else {
			//Credential not match
			$response["error"] = TRUE;
			$response["error_msg"] = "Wrong password. Please try again!";
			echo json_encode($response);
		}
	}
} else {
	//Required parameters is missing
	$response["error"] = TRUE;
	$response["error_msg"] = "User email or password is missing!";
	echo json_encode($response);
}
?>