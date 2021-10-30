<?php
include_once 'config.php';
if(isset($_POST['submit']))
{   
     $name = $_POST['name'];
     $desc = $_POST['desc'];
     $price = $_POST['price'];
     $sql = "INSERT INTO products (name,desc,price)
     VALUES ('$name','$desc','$price')";
     if (mysqli_query($conn, $sql)) {
        echo "New record has been added successfully !";
     } else {
        echo "Error: " . $sql . ":-" . mysqli_error($conn);
     }
     mysqli_close($conn);
}
?>

<?=template_header('Insert Product')?>

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
                    <h2>Add Menu Item Form</h2>
                </div>
                <p>Please fill this form to add products to the menu.</p>
                <form action="index.php?page=insertProduct" method="post">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" name="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Product Description</label>
                        <input type="text" name="desc" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Product Price</label>
                        <input type="number" name="price" class="form-control">
                    </div>
                    <input type="submit" class="btn btn-primary" name="submit" value="Submit">
                </form>
            </div>
        </div>       
    </div>
</div>
