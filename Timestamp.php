<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Insert Timestamp</title>
</head>

<body>
<h1>Hello World</h1>
<fieldset>
<legend>Timestamp</legend>
<form name="frmInsert" method="post" action="Timestamp_php.php">
<?php
//Retrieve Time
	$servername = "3.234.155.244"; //3.234.155.244
	$username = "root";
	$password = "";
	$dbname = "test";

// Create connection
	$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
	if (!$conn) {
		die("Connection failed: " . mysqli_connect_error());
	}
//Select last row in database
	$sql = "SELECT clicktime FROM test.buttonclick ORDER BY clicktime DESC LIMIT 1";
	$result = mysqli_query($conn, $sql);


	if (mysqli_num_rows($result) > 0) {

// output data of each row
	while(($row = mysqli_fetch_assoc($result))) {
		echo "last time: " . $row["clicktime"]. "<br>";
	
	}
	} else {
		echo "0 results";
	}

mysqli_close($conn);
?>
<p>&nbsp;</p>
<p>
<input type="submit" name="Submit" id="Submit" value="Submit">
</p>
</form>
</fieldset>
</body>
</html>
