<?php
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
	header('location: index.php?page=login');
	exit;
}

if (isset($_SESSION['employee']) && $_SESSION['employee'] === false) {
	header('location: index.php');
	exit;
}
//include 'functions.php';
?>

<?php
// Connect to employee database
	$DATABASE_HOST = '3.234.155.244'; //3.234.155.244
	$DATABASE_USER = 'root';
	$DATABASE_PASS = '';
	$DATABASE_NAME = 'shoppingcart';
	
	$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);
	if ( mysqli_connect_errno() ) {
		exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}
// If logout button is pressed
if(isset($_POST['logout']))
{
	header('location: logout.php');
}
// If update button is pressed
if(isset($_POST['updateitem_page']))
{
	header('location: index.php?page=updateitem');
}
// If add button is pressed
if(isset($_POST['addmenu_page']))
{
	header('location: index.php?page=addmenu');
}

if (isset($_POST['register_employee']))
{
	header('location: index.php?page=registeremployee');
}
// If Register Employee button pressed
if (isset($_POST['add_new_employee']))
{
	// Validate username
	// can use trim() function to remove accidental spaces
	if (empty($_POST['username'])) {
		$user_error = "Please enter username";
		echo "<script>alert('$user_error');</script>";
	} else {
		// Check if username is taken
		if ($stmt = $con->prepare('SELECT id, password FROM Employee WHERE username = ?')) {
			// Bind parameters (s = string, i = int, b = blob, etc)
			$stmt->bind_param('s', $_POST['username']);
			$stmt->execute();
			$stmt->store_result();
			// Store the result so we can check if the account exists in the database.
			if ($stmt->num_rows > 0) {
				// Username already exists
				$user_error = "Username is already taken";
				echo "<script>alert('$user_error');</script>";
				
			} else {
			$username = $_POST['username'];
			}
		$stmt->close();
		}
	}
	
	// Validate password
	if (empty($_POST['password'])) {
		$pass_error = "Please enter a password";
		echo "<script>alert('$pass_error');</script>";
	} else if (strlen($_POST['password']) < 8) {
		$pass_error = "Password must be at least 8 characters";
		echo "<script>alert('$pass_error');</script>";
	} else {
		$password = $_POST['password'];
	}
	
	// Validate email
	if (empty($_POST['email'])) {
		$email_error = "Please enter an email";
		echo "<script>alert('$email_error');</script>";
	} else {
		$email = $_POST['email'];
	}
	
	// Validate firstname
	if (empty($_POST['firstname'])) {
		$firstname_error = "Please enter a Name";
		echo "<script>alert('$firstname_error');</script>";
	} else {
		$firstname = $_POST['firstname'];
	}
	
	// Validate lastname
	if (empty($_POST['lastname'])) {
		$lastname_error = "Please enter a Last Name";
		echo "<script>alert('$lastname_error');</script>";
	} else {
		$lastname = $_POST['lastname'];
	}
	
	
	// If all checks are passed, enter new employee into database
	if (empty($user_error) && empty($pass_error) && empty($email_error) && empty($firstname_error) && empty($lastname_error)) {
		$sql = "INSERT INTO Employee (FirstName, LastName, username, email, password)
			VALUES ('$firstname', '$lastname', '$username', '$email', '$password')";
     if (mysqli_query($con, $sql)) {
        echo "<script>alert('New Employee Registered Successfully!');</script>";
     } else {
        echo "<script>alert('Error!');</script>";
     }
     mysqli_close($con);
	}
}
?>


<?=template_header('Register Employee')?>

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="./bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<div class="content-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Register Employee</h2>
			<?php
			echo 'Welcome, ';echo ($_SESSION['firstname']);
			?>
                </div>
                <p>Fill this form to register a new employee.</p>
                <form action="#" method="post">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" pattern="[a-z][a-z]*" title="Usernames must be only lowercase letters with no spaces">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="text" name="password" class="form-control" placeholder="Password" pattern="(?=.*\d)(?=.*?[#?!@$%^&*-])(?=.*[a-z])(?=.*[A-Z]).{8,}"
						title="Must contain at least one  number, one special character, one uppercase and lowercase letter, and at least 8 or more characters">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" placeholder="Email">
					</div>
					<div class="form-group">
						<label>First Name</label>
						<input type="text" name="firstname" class="form-control" placeholder="First Name">
					</div>
					<div class="form-group">
						<label>Last Name</label>
						<input type="text" name="lastname" class="form-control" placeholder="Last Name">
					</div>
					
                    <input type="submit" class="btn btn-primary" name="add_new_employee" value="Register New Employee">
					<input type="submit" class="btn btn-primary" name="logout" value="Logout">

				<br>
				<br>

					<input type="submit" class="btn btn-primary" name="addmenu_page" value="Go to Add Item">
					<input type="submit" class="btn btn-primary" name="updateitem_page" value="Go to Update Item">
					
                </form>
            </div>
        </div>       
    </div>
</div>

<?=template_footer()?>
