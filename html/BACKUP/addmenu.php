<?php
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
	header('location: index.php?page=login');
	exit;
}
//include 'functions.php';
?>

<?php
$conn = mysqli_connect("3.234.155.244", "root", "", "shoppingcart"); //3.234.155.244
//session_start();
if(isset($_POST['submit']))
{   
     $name = $_POST['name'];
     $description = $_POST['description'];
     $price = $_POST['price'];
	 $medium = $_POST['medium'];
	 $large = $_POST['large'];
	 $sku = $_POST['sku'];
     $sql1 = "INSERT INTO products (name,description,price,img,medium,large,sku) VALUES ('$name - Small','<p>$description</p>','$price','img.png','$medium','$large','$sku')";
     $sql2 = "INSERT INTO products (name,description,price,img,medium,large,sku) VALUES ('$name - Medium','<p>$description</p>','$medium','img.png','$medium','$large','$sku')";
	 $sql3 = "INSERT INTO products (name,description,price,img,medium,large,sku) VALUES ('$name - Large','<p>$description</p>','$large','img.png','$medium','$large','$sku')";
	 if (mysqli_query($conn, $sql1)) {
		mysqli_query($conn, $sql2);
		mysqli_query($conn, $sql3);
        echo "<script>alert('New record has been added successfully!');</script>";
     } else {
        echo "<script>alert('Product Entry is invalid!');</script>";
     }
     mysqli_close($conn);
}

if(isset($_POST['logout']))
{
	header('location: logout.php');
}

if(isset($_POST['updateitem_page']))
{
	header('location: index.php?page=updateitem');
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
                <p>Fill this form to add products to the menu.</p>
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
						<label>Product SKU</label>
						<input type="text" name="sku" class="form-control" placeholder="">
					</div>
					<div class="form-group">
						<label>Base Price</label>
						<input type="number" step="0.01" value="0.00" name="price" class="form-control" placeholder="0.00">
					</div>
					<div class="form-group">
						<label>Medium Price</label>
						<input type="number" step="0.01" value="0.00" name="medium" class="form-control" placeholder="0.00">
					</div>
					<div class="form-group">
						<label>Large Price</label>
						<input type="number" step="0.01" value="0.00" name="large" class="form-control" placeholder="0.00">
					</div>
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit">
					<input type="submit" class="btn btn-primary" name="logout" value="Logout">
					<input type="submit" class="btn btn-primary" name="updateitem_page" value="Go to Update Item Page">
                </form>
            </div>
        </div>       
    </div>
</div>

<?=template_footer()?>