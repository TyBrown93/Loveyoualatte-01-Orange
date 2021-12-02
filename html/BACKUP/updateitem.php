<?php
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
	header('location: index.php?page=login');
	exit;
}
//include 'functions.php';
?>

<?php
//session_start();
$conn = mysqli_connect("3.234.155.244", "root", "", "shoppingcart");
$result = mysqli_query($conn, "SELECT name FROM products");

if(isset($_POST['submit']))
{   
	$name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
	$sku = $_POST['sku'];
	$sql = "UPDATE products SET price = '$price', description = '<p>$description</p>', sku = '$sku' WHERE name = '$name'";
     if (mysqli_query($conn, $sql)) {
        echo "<script>alert('Menu item update successful!');</script>";
     } else {
        echo "<script>alert('Product Entry is invalid!');</script>";
     }
     mysqli_close($conn);
}

if(isset($_POST['logout']))
{
	header('location: logout.php');
}

if(isset($_POST['addmenu_page']))
{
	header('location: index.php?page=addmenu');
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
				<h2>Update Menu Item</h2>
				<?php
                    echo 'Welcome, ';echo ($_SESSION['firstname']);
				?>
                </div>
                <p>Fill this form to edit a specific menu item.</p>
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
						<label>Product SKU</label>
						<input type="text" name="sku" class="form-control" placeholder="">
					</div>
					<div class="form-group">
						<label>Price</label>
						<input type="number" step="0.01" value="0.00" name="price" class="form-control" placeholder="0.00">
					</div>
                    <input type="submit" class="btn btn-primary" name="submit" value="Update">
					<input type="submit" class="btn btn-primary" name="logout" value="Logout">
					<input type="submit" class="btn btn-primary" name="addmenu_page" value="Go to Add Menu Page">
                </form>
            </div>
        </div>       
    </div>
</div>

<?=template_footer()?>