<?php
// Connect to employee database
	session_start();
	$DATABASE_HOST = '3.234.155.244'; //3.234.155.244
	$DATABASE_USER = 'root';
	$DATABASE_PASS = '';
	$DATABASE_NAME = 'shoppingcart';
	
	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	if ( mysqli_connect_errno() ) {
		exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
	
// Check to see if data from login page was submitted
	if (!isset($_POST['username'], $_POST['password'])) {
		exit('Please fill in Username and Password.');
	}

// Prepare SQL statement
	if ($stmt = $con->prepare('SELECT id, password, FirstName FROM Employee WHERE username = ?')) {
		// Bind parameters
		$stmt->bind_param('s', $_POST['username']);
		$stmt->execute();
		
		// Store result to check if user is in database
		$stmt->store_result();
		
		if ($stmt->num_rows > 0) {
			$stmt->bind_result($id, $password, $firstname);
			$stmt->fetch();
			// Account exists, now verify username and password
			// Use password_verify($_POST['password'], $password) if using hash
			if ($_POST['password'] === $password) {
				// User has logged-in
				// Create sessions, so we know the user is logged in, they basically act like cookies
				session_regenerate_id();
				$_SESSION['loggedin'] = TRUE;
				$_SESSION['name'] = $_POST['username'];
				$_SESSION['id'] = $id;
				$_SESSION['firstname'] = $firstname;
				// Use variable to check if user is an employee
				$_SESSION['employee'] = TRUE;
				header('Location: index.php?page=addmenu');
			} else {
				// Incorrect password
				$_SESSION['attempt'] += 1;
				if ($_SESSION['attempt'] == 3) {
						$_SESSION['timeout'] = time() + (900);
				}
				echo 'Incorrect username and/or password!';
				header('location: index.php?page=login');
				exit;
			}
		} else {
			// Incorrect username
			$_SESSION['attempt'] += 1;
			if ($_SESSION['attempt'] == 3) {
				$_SESSION['timeout'] = time() + (900);
			}
			echo 'Incorrect username and/or password!';
			header('location: index.php?page=login');
			exit;
		}
		
		
		
		
		$stmt->close();
	}

?>