<?php
require_once 'variables.php';

//Functions for database operations
function connectDB() {
	return mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE);
}
?>