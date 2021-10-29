<?php
// TABLE Employee, columns: username, email, password, create_time, FirstName
// Initialize session
session_start();

// Check if user is logged in. If so redirect to welcome page
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
	header('location: index.php');
	exit;
}

require_once 'config.php';
$username = "";
$password = "";
$user_error = "";
$pass_error = "";
$login_error = "";

// Process data when posted
if (isset($_POST['login'])) {
	
	// Check if username is empty
	if (empty($_POST['username'])) {
		$user_error = "Please enter username";
	} else {
		$username = $_POST['username'];
	}
	
	// Check if password is empty
	if (empty($_POST['password'])) {
		$pass_error = "Please enter password";
	} else {
		$password = $_POST['password'];
	}
	
	// Validate user and password
	if (empty($user_error) && empty($pass_error)) {
		// Prepare select statement
		$pdo = pdo_connect_mysql_employee();
		$stmt = $pdo->prepare('SELECT username, password FROM Employee WHERE username = :username');
		
		$stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
		
		// Set parameters
		$param_username = $_POST['username'];
		
		// Attempt to execute statement
		if ($stmt->execute()) {
			
			// Check for username in table
			if ($stmt->rowCount() == 1) {
				if ($row = $stmt->fetch()) {
					$EmployeeID = $row['EmployeeID'];
					$username = $row['username'];
					$verify_password = $row['password'];
					if (password_verify($password, $verify_password)) {
						
						// Password is correct so start user session
						session_start();
						
						// Store session variables
						$_SESSION['loggedin'] = true;
						$_SESSION['EmployeeID'] = $EmployeeID;
						$_SESSION['username'] = $username;
						
						// Redirect to home page
						header('location: index.php');
					} else {
						// Password is incorrect
						$login_error = "Invalid username or password";
					}
				} else {
					//Username does not exist
					$login_error = "Invalid username or password";
				}
			} else {
				echo "Something went wrong";
			}
			
			// Close statement
			unset($stmt);
			
		}
		
	}
	unset($pdo);
}
?>
