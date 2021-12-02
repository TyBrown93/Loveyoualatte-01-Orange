<?=template_header('Employee Login')?>

<?php
// TABLE Employee, columns: username, email, password, create_time, FirstName
// Check if user is logged in. If so redirect to welcome page
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
	header('location: index.php?page=home');
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
	if (empty($_POST['uname'])) {
		$user_error = "Please enter username";
	} else {
		$username = $_POST['uname'];
	}

	// Check if password is empty
	if (empty($_POST['pword'])) {
		$pass_error = "Please enter password";
	} else {
		$password = $_POST['pword'];
	}

	// Validate user and password
	if (empty($user_error) && empty($pass_error)) {
		// Prepare select statement
		$pdo = pdo_connect_mysql_employee();
		$stmt = $pdo->prepare('SELECT username, password FROM Employee WHERE username = :uname');

		$stmt->bindParam(":uname", $param_username, PDO::PARAM_STR);

		// Set parameters
		$param_username = $_POST['uname'];

		// Attempt to execute statement
		if ($stmt->execute()) {

			// Check for username in table
			if ($stmt->rowCount() == 1) {
				if ($row = $stmt->fetch()) {
					$EmployeeID = $row['EmployeeID'];
					$username = $row['uname'];
					$verify_password = $row['pword'];
					if (password_verify($password, $verify_password)) {

						// Password is correct so start user session
						session_start();

						// Store session variables
						$_SESSION['loggedin'] = true;
						$_SESSION['EmployeeID'] = $EmployeeID;
						$_SESSION['uname'] = $username;

						// Redirect to home page
						header('location: index.php?page=home');
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

<div class="content-wrapper">
<h4>EMPLOYEE LOGIN:</h4>
<form action="index.php?page=welcome" method="post">
<br>
<div>
<label>Username:</label>
<input type="text" name="uname" class="form-control" autofocus="" required>
</div>
<br>
<div>
<label>Password:</label>
<input type="password" name="pword" class="form-control" required>
</div>
<br>
<div class="buttons">
<input type="submit" value="Login" name="login">
</div>
</form>
</div>

<?=template_footer()?>