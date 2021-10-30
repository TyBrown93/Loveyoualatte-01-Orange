<?php
//Includes the connection file that contains the MYSQL database information
include('connection.php');

// Checking if the submit button has been checked.
if(isset($_POST['submit'])){
	// If the username and password fields are empty then print an error.
	if(empty($_POST['username']) || empty($_POST['password'])){
		echo "Please enter a username and password to login!";
		exit;
	}

	$user = $_POST['username'];
	$pass = md5($_POST['password']);
	if(strlen($user) > '15')
	{
		echo "Your username is more than 15 characters. It needs to be less than 15.";
		exit;
	}

	// Selects the username and password from the users database.
	$query = "SELECT username, password FROM `users` WHERE username='$user'";

	$result = mysql_query($query);

	if(!$result) {
		echo "The query failed " . mysql_error();
	} else {
		// If the row vairable does not equal the pass variable then an error occurs.
		$row = mysql_fetch_object($result);
			if($row->password != $pass) {
				if(isset($_COOKIE['login'])){
					if($_COOKIE['login'] < 3){
						$attempts = $_COOKIE['login'] + 1;
						setcookie('login', $attempts, time()+60*10); //set the cookie for 10 minutes with the number of attempts stored
						echo "Sorry,  your username and password doesn't match. Please enter the correct login details.";
					} else{
						echo 'You had 3 failed attempts at logging in. Please try again after 10 minutes!';
					}
				} else {
					setcookie('login', 1, time()+60*10); //set the cookie for 10 minutes with the initial value of 1
				}
				exit;
			}
			header('Location: logged.php');	
	}
}
?>