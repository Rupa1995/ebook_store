<?php
	include 'config/config.php';
	$servername = DB_SERVER;
	$username = DB_USERNAME;
	$password = DB_PASSWORD;
	$database = DB_DATABASE;

	$conn = new mysqli($servername, $username, $password, $database);
	if ($conn->connect_error) 
	{
    	die("Connection failed: " . $conn->connect_error);
	}
	//echo "Connected successfully";
?>