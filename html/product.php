<?php
// Check to make sure the id parameter is specified in the URL
if (isset($_GET['id'])) {
    // Prepare statement and execute, prevents SQL injection
    $stmt = $pdo->prepare('SELECT * FROM products WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    // Fetch the product from the database and return the result as an Array
    $product = $stmt->fetch(PDO::FETCH_ASSOC);
    // Check if the product exists (array is not empty)
    if (!$product) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        exit('Product does not exist!');
    }
} else {
    // Simple error to display if the id wasn't specified
    exit('Product does not exist!');
}
$size = '';
?>
<?=template_header('Product')?>

<div class="product content-wrapper">
    <img src="imgs/<?=$product['img']?>" width="500" height="500" alt="<?=$product['name']?>">
    <div>
        <h1 class="name"><?=$product['name']?></h1>
        <span class="price">&dollar;<?=$product['price']?>
            <?php if ($product['rrp'] > 0): ?>
            <span class="rrp">&dollar;<?=$product['rrp']?></span>
            <?php endif; ?>
        </span>
        <form action="index.php?page=cart" method="post">
	    <!-- ***********Creamer Options*********-->
		<?php if ($product['creamer_1'] == "Skim"): ?>
			 <label>Select Creamer Options</label>
			 <select name="creamer">
				<option value="" disabled selected>Choose Creamer</option>
				<option value="<?=$product['creamer_1']?>"><?=$product['creamer_1']?></option>
				<option value="<?=$product['creamer_2']?>"><?=$product['creamer_2']?></option>
				<option value="<?=$product['creamer_3']?>"><?=$product['creamer_3']?></option>
				<option value="<?=$product['creamer_4']?>"><?=$product['creamer_4']?></option>
				<option value="<?=$product['creamer_5']?>"><?=$product['creamer_5']?></option>
			</select>

		<br>

			<!-- ***********Sweetner Options*********-->
			<label>Select Sweetner Options</label>
			<select name="sweetner">
				<option value="" disabled selected>Choose Sweetener</option>
				<option value="<?=$product['sweet_1']?>"><?=$product['sweet_1']?></option>
				<option value="<?=$product['sweet_2']?>"><?=$product['sweet_2']?></option>
				<option value="<?=$product['sweet_3']?>"><?=$product['sweet_3']?></option>
				<option value="<?=$product['sweet_4']?>"><?=$product['sweet_4']?></option>
				
			</select>
			<?php endif; ?>
	    <br>
            <input type="number" name="quantity" value="1" min="1" max="<?=$product['quantity']?>" placeholder="Quantity" required>
            <input type="hidden" name="product_id" value="<?=$product['id']?>">
			<br>
            <input type="submit" value="Add To Cart">
        </form>
        <div class="description">
            <?=$product['description']?>
        </div>
    </div>
</div>

<?=template_footer()?>
