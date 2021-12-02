<?php
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
	header('location: index.php?page=login');
	exit;
}
//include 'functions.php';
?>

<?php
session_start();
$conn = mysqli_connect("3.234.155.244", "root", "", "shoppingcart");
$result = mysqli_query($conn, "SELECT name FROM products");

if(isset($_POST['submit']))
{   
     $name = $_POST['name'];
     $description = $_POST['description'];
     $price = $_POST['price'];
	 $medium = $_POST['medium'];
	 $large = $_POST['large'];
     $sql = "INSERT INTO products (name,description,price,medium,large) VALUES ('$name','<p>$description</p>','$price','$medium','$large')";
     if (mysqli_query($conn, $sql)) {
        echo "New record has been added successfully !";
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
     }
     mysqli_close($conn);
}

if(isset($_POST['updateitem']))
{   
	$name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
	$medium = $_POST['medium'];
	$large = $_POST['large'];
	$sql = "UPDATE products SET price = '$price', medium = '$medium', large = '$large', description = '<p>$description</p>' WHERE name = '$name'";
     if (mysqli_query($conn, $sql)) {
        echo "Menu update successful!";
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
     }
     mysqli_close($conn);
}

if(isset($_POST['logout']))
{
	header('location: logout.php');
}

?>

<?=template_header('Add Menu')?>

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Add Menu Item</h2>
			<?php
			echo 'Welcome, ';echo ($_SESSION['firstname']);
			?>
                </div>
                <form action="#" method="post">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Product Description</label>
                        <input type="text" name="description" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Base Price</label>
                        <input type="number" step="0.01" value="0.00" name="price" class="form-control" placeholder="0.00">
                    </div>
					<div class="form-group">
						<label>Medium Additional Cost</label>
						<input type="number" step="0.01" value="0.00" name="medium" class="form-control" placeholder="0.00">
					</div>
					<div class="form-group">
						<label>Large Additional Cost</label>
						<input type="number" step="0.01" value="0.00" name="large" class="form-control" placeholder="0.00">
					</div>
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit">
					<input type="submit" class="btn btn-primary" name="logout" value="Logout">
                </form>
            </div>
        </div>       
    </div>
</div>

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header">
				<h2>Update Menu Item</h2>
                </div>
                <form action="#" method="post">
                    <div class="form-group">
                        <label>Product</label>
						<?php
							echo "<select name=name class='form-control'>";
							while ($row = $result->fetch_assoc()) {
								echo "<option value='$row[name]'>$row[name]</option>";
								}
							echo "</select>";
						?>
                    </div>
                    <div class="form-group">
                        <label>Product Description</label>
                        <input type="text" name="description" class="form-control">
                    </div>
					<div class="form-group">
						<label>Base Price</label>
						<input type="number" step="0.01" value="0.00" name="price" class="form-control" placeholder="0.00">
					</div>
					<div class="form-group">
						<label>Medium Additional Cost</label>
						<input type="number" step="0.01" value="0.00" name="medium" class="form-control" placeholder="0.00">
					</div>
					<div class="form-group">
						<label>Large Additional Cost</label>
						<input type="number" step="0.01" value="0.00" name="large" class="form-control" placeholder="0.00">
					</div>
                    <input type="submit" class="btn btn-primary" name="updateitem" value="Update">
					<input type="submit" class="btn btn-primary" name="logout" value="Logout">
					<div class="form-group">
					</div>
                </form>
            </div>
        </div>       
    </div>
</div>

<?=template_footer()?>