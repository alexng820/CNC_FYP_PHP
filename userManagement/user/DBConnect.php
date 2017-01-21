<?php #DBConnect.php
$conn = new mysqli();
$host ="localhost";
$user ="root";
$password = "root";
$dbname = "cncfyp";
$conn -> connect($host, $user, $password, $dbname);



?>