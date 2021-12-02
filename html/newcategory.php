<?php
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] === false) {
        header('location: index.php?page=login');
        exit;
}
//include 'functions.php';
?>

<?php
$conn = mysqli_connect("3.234.155.244", "root", "", "shoppingcart");
//session_start();
if(isset($_POST['submit']))
{   
     $category = $_POST['Category_Name'];
     
     $sql1 = "INSERT INTO Category (Category_Name) VALUES ('$category')";
     
         if (mysqli_query($conn, $sql1)) {
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

if(isset($_POST['addmenu_page']))
{
        header('location: index.php?page=addmenu');
}

if (isset($_POST['register_employee']))
{
        header('location: index.php?page=registeremployee');
}
?>

<?=template_header('Add Menu')?>

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
                    <h2>Add New Category</h2>
                        <?php
                        echo 'Welcome, ';echo ($_SESSION['firstname']);
                        ?>
                </div>
                <p>Fill this form to add new categories to the menu.</p>
                <form action="#" method="post">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input type="text" name="Category_Name" class="form-control">
                    </div>
                    
                                       
                                        
                                        
                                        
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                                        <input type="submit" class="btn btn-primary" name="logout" value="Logout">

			<br>
			<br>
                                        <input type="submit" class="btn btn-primary" name="addmenu_page" value="Go to Add Menu Page">
                                        <input type="submit" class="btn btn-primary" name="updateitem_page" value="Go to Update Item Page">
                                        <input type="submit" class="btn btn-primary" name="register_employee" value="Go to Register Employee">
                </form>
            </div>
        </div>       
    </div>
</div>

<?=template_footer()?>
