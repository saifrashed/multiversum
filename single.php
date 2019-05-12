<?php
/**
 * Created by PhpStorm.
 * User: saifeddine
 * Date: 2019-02-18
 * Time: 16:03
 */

require "./header.php";
require "./classes/products.php";

$product      = new Product;
$id           = $_GET['id'];
$productData  = $product->readProduct($id);
$productImage = '<img src="./assets/product_images/' . $productData['product_id'] . '.jpeg">';
?>


<div class="product-single">
    <div class="product-image"> <?php echo $productImage ?></div>
    <div class="product-summary">
        <h1 class="product-title"><?php echo $productData['product_name']; ?></h1>
        <p><?php echo $productData["other_product_details"] ?></p>

        <?php if ($productData['disabled'] != 1) { ?>
            <span class="product-price">€ <?php echo $productData['product_price'] ?></span>
            <button><i class="fas fa-cart-arrow-down"></i>Add to shopping cart</button>
        <?php } else { ?>
            <button style="color:darkred;border-color:darkred;"><i class="fas fa-times-circle"></i>Not Available</button>
        <?php } ?>


    </div>
</div>
<?php

require "./footer.php";

?>
