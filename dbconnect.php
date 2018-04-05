<?php
/*$sql = "CREATE DATABASE ebooks";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully";
	} else {
    echo "Error creating database: " . $conn->error;
}*/


		$servername = "localhost";
		$username = "root";
		$password = "tiger";
		$database = "ebooks";

		// Create connection
		$conn = new mysqli($servername, $username, $password, $database);
		// Check connection
		if ($conn->connect_error) {
		    die("Connection failed: " . $conn->connect_error);
		    
		} 
		//else echo "connected";
		// $sql = "CREATE TABLE register(uname VARCHAR(200) NOT NULL PRIMARY KEY, mobile INT(200) NOT NULL,passwrd VARCHAR(200) NOT NULL)";
		// 	if (mysqli_query($conn, $sql)) {

		// 		echo "table created";
		// 		}
		// 		else{
		// 		echo "could not create table" . mysqli_error($conn);
		// 		}
		
		if(isset($_GET)){
				$uname = $_POST['username'];
				$mobile = $_POST['mobile'];
				$password = $_POST['password'];

				$sql = "INSERT INTO register(uname,mobile,passwrd) VALUES ('$uname','$mobile','$password');";

				if(mysqli_query($conn,$sql))
				{
					//echo "inserted";
				}
				else{
					echo "not inserted";
				}
}

//header("refresh:50; url=task6.php");

$conn->close();
?>