<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM products ORDER BY date_added DESC LIMIT 4');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<?=template_header('Home')?>

<div class="featured">
    <h2>Love You A Latte</h2>
    <p>Stop by and discover the variety and joy of Ohio in a cup!</p>
</div>
<div class="recentlyadded content-wrapper">
    <h2>Recently Added Products</h2>
    <div class="products">
        <?php foreach ($recently_added_products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['id']?>" class="product">
            <img src="imgs/<?=$product['img']?>" width="200" height="200" alt="<?=$product['name']?>">
            <span class="name"><?=$product['name']?></span>
	    <span class="price">
               &dollar;<?=$product['price']?>
               <?php if ($product['rrp'] > 0.00): ?>
               <span class="rrp">&dollar;<?=$product['rrp']?></span>
               <?php endif; ?>
           </span>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<?=template_footer()?>
