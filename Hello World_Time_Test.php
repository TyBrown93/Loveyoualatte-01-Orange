<!DOCTYPE html>
<html>
<body>

<h1>My first PHP page</h1>

<button type="button"onclick="document.getElementById('time').innerHTML = Date()">Timestamp</button>

<p id="time"></p>

<?php
echo "Hello World!";

//Connect to database once it is created
$servername = "3.86.215.12"; //server name will replace this variable 184.72.195.92
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

$sql = "INSERT INTO buttonclick (clicktime)
VALUES (CURRENT_TIMESTAMP)";

if (mysqli_query($conn, $sql)) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

//Insert query
//INSERT INTO buttonclick VALUE (CURRENT_TIMESTAMP)

//Close connection
mysqli_close($conn);


?> 

</body>
</html>