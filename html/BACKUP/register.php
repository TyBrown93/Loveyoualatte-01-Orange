<?php
require_once 'config.php';

$username = "";
$password = "";
$confirm_password = "";
$user_error = "";
$pass_error = "";
$confirm_error = "";

// Process data when posted
if (isset($_POST['register'])) {
	
	// Validate username
	// can use trim() function to remove accidental spaces
	if (empty($_POST['username'])) {
		$user_error = "Please enter username";
	} else if (!preg_match('/^[a-zA-Z0-9_]+$/')) {
		$user_error = "username cannot contain special characters"
	} else {
		
		// Prepare select statement
		$pdo = pdo_connect_mysql_employee();
		$stmt = $pdo->prepare('SELECT id FROM employee_table WHERE username = :username');
		$stmt->bindParam(':username', $param_username, PDO::PARAM_STR);
		
		// Set paramaeters
		$param_username = $_POST['username'];
		
		// Attempt to execute statement
		if ($stmt->execute()) {
			if ($stmt->rowCount() == 1) {
				$user_error = "username is already taken";
			} else {
				$username = $_POST['username'];
			} else {
				echo "Something went wrong!";
			}
			
			// Clear statement
			unset($stmt);
		}
	}
	
	// Validate password
	if (empty($_POST['password'])) {
		$pass_error = "Please enter a password";
	} else if (strlen($_POST['password']) < 8) {
		$pass_error = "Password must be at least 8 characters";
	} else {
		$password = $_POST['password'];
	}
	
	// Validate confirm password
	if (empty($_POST['confirm_password'])) {
		$confirm_error = "Please enter password exactly the same";
	} else {
		$confirm_password = $_POST['confirm_password'];
		if (empty($pass_error) && ($password != $confirm_password)) {
			$confirm_error = "Passwords do not match";
		}
	}
	
	// If all checks are passed, enter new employee into database
	if (empty($user_error) && empty($pass_error) && empty($confirm_error)) {
		$stmt = $pdo->prepare('INSERT INTO users (username, password) VALUES (:username, :password)');
		
		// Bind variables to prepared statement as parameters
		$stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
        $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
		
		// Set parameters & HASH password
		$param_username = $username;
		$param_password = password_hash($password, PASSWORD_DEFAULT);
		
		// Execute prepared statement
		if ($stmt->execute()) {
			// Redirect to login page
			header('location: login.php');
		} else {
			echo "Something went wrong!";
		}
		
		// Clear statement
		unset($stmt);
	}
	// Close connection
	uset($pdo);
	
}
?>
<?=template_header('Register')?>

<div class="content-wrapper">
	<h2>Register Employee</h2>
	<p>Fill out form to create new employee.</p>
	<form action="index.php?page=login" method="post">
		<div class="form-register">
			<label>Username</label>
			<input type="text" name="username" class
	
	
	
	