<?php
// TABLE Employee, columns: username, email, password, create_time, FirstName
// Initialize session
//session_start();

// Check if user is logged in. If so redirect to add menu page
// Note: the only way to access this page is by logging in
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
	header('location: addmenu.php');
	exit;
}

// Check if user can login or is on timeout
if (isset($_SESSION['timeout'])) {
	$now = time();
	if ($now >= $_SESSION['timeout']) {
		unset($_SESSION['attempt']);
		unset($_SESSION['timeout']);
	}
}

require_once 'config.php';
$username = "";
$password = "";
$user_error = "";
$pass_error = "";
$login_error = "";

// Process data when posted
if (isset($_POST['login'])) {
	if (!isset($_SESSION['attempt'])) {
		$_SESSION['attempt'] = 0;
	}
	
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
	// Check if login attempt is reached
	if ($_SESSION['attempt'] == 3) {
		$_SESSION['error'] = '3 Attempt Limit Reached. Please try again in 15 minutes.';
		echo $_SESSION['error'];
	} else if (empty($user_error) && empty($pass_error)) {
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
					$firstname = $row['FirstName'];
					$verify_password = $row['password'];
					if (password_verify($password, $verify_password)) {
						
						// Password is correct so start user session
						session_start();
						
						// Store session variables
						$_SESSION['loggedin'] = true;
						$_SESSION['EmployeeID'] = $EmployeeID;
						$_SESSION['username'] = $username;
						$_SESSION['firstname'] = $firstname;
						unset($_SESSION['attempt']);
						
						// Redirect to home page
						header('location: index.php');
					} else {
						// Password is incorrect
						$_SESSION['error'] = 'Password incorrect';
						$_SESSION['attempt'] += 1;
						
						// Set session timeout if 3rd attempt
						if ($_SESSION['attempt'] == 3) {
							$_SESSION['timeout'] = time() + (15*60);
						}
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
<?=template_header('Employee Login')?>

<div class="login content-wrapper">
			<h1>Employee Login</h1>
			<form action="authenticate.php" method="post">
				<label for="username">
					<i class="fas fa-user"></i>
				</label>
				<input type="text" name="username" placeholder="Username" id="username" required>
				<br>
				<label for="password">
					<i class="fas fa-lock"></i>
				</label>
				<input type="password" name="password" placeholder="Password" id="password" required>
				<br>
				<?php
				error_reporting(0);
				if ($_SESSION['attempt'] >= 3){
					echo "<br>You've been locked out due to too many attempts.";
				} else {
					print '<input type="submit" value="Login">';
				}
				?>
			</form>
		</div>
<?=template_footer()?>

