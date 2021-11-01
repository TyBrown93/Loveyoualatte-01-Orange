<?php
session_start(); // Start the session 

if(isset($_POST['first_name'])) // User filled out their first name 
{
    // Assign values based off the POST values
    $_SESSION['first_name'] = $_POST['first_name'];
    $_SESSION['last_name'] = $_POST['last_name'];
    $_SESSION['loggedin'] = true; // This tells whether the user logged in or not
}

$first_name = $_SESSION['first_name']; // Read the first name from session data
$last_name = $_SESSION['last_name']; // Read the last name from session data
$loggedin = $_SESSION['loggedin'];

if(!$loggedin) // If the user isn't logged in, display the login form
{
?>
<html>
<head>
<title>Employee Login</title>
</head>
<body>
<form action="test.php" method="post">
First Name: <input type="text" name="first_name" />
Last Name: <input type="text" name="last_name" />
<input type="submit" />
</form>
<?php
}
else // Otherwise, say hello!
{
    echo "Hello, " . $first_name . " " . $last_name . "Welcome";
}
?>
</body>
</html>