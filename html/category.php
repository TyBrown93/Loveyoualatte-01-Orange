<?php
$conn = mysqli_connect("3.234.155.244", "root", "", "shoppingcart");
$result = mysqli_query($conn, "SELECT * FROM Category");
?>

<?=template_header('Products')?>

<div class="content-wrapper">
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
				<h2>Select Menu Category</h2>
                </div>
				<form action="index.php?page=products" method="post">
                    <div class="form-group">
						<?php
							echo "<select name=category class='form-control'>";
							while ($row = $result->fetch_assoc()) {
								echo "<option value='$row[Cat_ID]'>$row[Category_Name]</option>";
								}
							echo "</select>";
						?>
                    </div>
                    <button type="submit" class="btn btn-primary">Go to Menu</button>
                </form>
            </div>
        </div>       
    </div>
</div>


<?=template_footer()?>