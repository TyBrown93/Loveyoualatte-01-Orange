<!DOCTYPE html>
<html>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<body>


<h1>Hello World</h1>
<script>
	function insertTime () {
		var result = "<?php insertTime(); ?>"
		document.write(result);
	}
</script>

<button type="button"onclick="insertTime()">Timestamp</button>

<?php
	function insertTime() {
		$servername = "3.234.155.244"; //server name will replace this variable 184.72.195.92
		$username = "root"; //username will replace this variable
		$password = ""; //password will replace this variable
		$dbname = "test";

//Create connection
		$conn = mysqli_connect($servername, $username, $password, 			$dbname);

// Check connection
		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}
		echo "Connected successfully";
		echo "<br>";
		$sql = "INSERT INTO buttonclick (clicktime)
		VALUES (CURRENT_TIMESTAMP)";

		if (mysqli_query($conn, $sql)) {
			echo "New record created successfully";
		} else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		
//Close connection
		mysqli_close($conn);
}
?>

<?php

?> 

</body>
</html>