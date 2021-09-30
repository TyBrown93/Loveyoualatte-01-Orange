<?php
		$servername = "localhost"; //server name will replace this variable 54.160.37.238 (Database Production) 3.234.155.244 (Test Production)
		$username = "root"; //username will replace this variable
		$password = ""; //password will replace this variable
		$dbname = "test";

//Create connection
		$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		echo "Connected successfully";
		echo "<br>";
		
//Insert SQL statement into database		
		$sql = "INSERT INTO buttonclick (clicktime)
		VALUES (CURRENT_TIMESTAMP)";

		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
//Close connection
		mysqli_close($conn);

?>