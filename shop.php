<?php
/**
 * Created by PhpStorm.
 * User: saifeddine
 * Date: 2019-02-18
 * Time: 16:03
 */

require "./header.php";
require "./classes/products.php";

$products = new Product;

$addToCart = $products->readProduct((int)$_GET['add_to_cart']);

?>

<div class="container-fluid">
    <div class="row center-xs">
        <div class="shop_summary col-xs-12 col-md-8">
            <h1> VR is the future! </h1>
            <p>
                VR will make you feel like you are there mentally and physically. You turn your head and the world turns
                with
                you so the illusion created by whatever world you are in is never lost.
                Watch a film in the cinema and the split-second fear you might feel when a devastating earthquake
                happens on
                screen will very quickly disappear if you turn your head to see the person next to you munching away on
                their
                popcorn. Films and books take you to different fictional worlds, but they are not world's you change
                based on
                your actions.
            </p>
        </div>
    </div>
</div>

<?php
if (isset($_GET['add_to_cart'])) {
    ?>
    <div class="container-fluid">
        <div class="row center-xs">
            <div class="message col-xs-12 col-md-8">
                <div class="added_to_cart"><?php echo '"' . $addToCart['product_name'] . '" has been added to your cart.' ?>
                    <a href="shop.php"><i class="fas fa-times-circle"></i></a></div>
            </div>
        </div>
    </div>

    <?php
}
?>

<div class="container-fluid">
    <div class="row center-xs">
        <?php
        echo $products->displayProducts(6, $_GET['category']);
        ?>
    </div>
</div>

<?php

require "./footer.php";

?>
