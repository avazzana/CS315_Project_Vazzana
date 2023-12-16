<?php
// Get the 4 most recently added products
$stmt = $pdo->prepare('SELECT * FROM product');
$stmt->execute();
$recently_added_products = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?=template_header('home')?>

<div class="featured">
    <h2>Merch</h2>
    <p>Order some SAI swag for your little! (Or YOURSELF) </p>
</div>
<div class="recentlyadded content-wrapper">
    <h2>Recently Added Products</h2>
    <div class="products">
        <?php foreach ($recently_added_products as $product): ?>
        <a href="index.php?page=product&id=<?=$product['id']?>" class="product">
            <img src="pics/merch/<?=$product['img']?>" width="200" height="200" alt="<?=$product['name']?>">
            <span class="name"><?=$product['name']?></span>
            <span class="price">
                With member discount: &dollar;<?=$product['member_price']?>
                <?php if ($product['price'] > 0): ?>
                <span class="price">Non-member price: &dollar;<?=$product['price']?></span>
                <?php endif; ?>
            </span>
        </a>
        <?php endforeach; ?>
    </div>
</div>

<?=template_footer()?>