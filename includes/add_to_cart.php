<?php
/**
 * User: saifeddine
 * Date: 2019-03-25
 * Time: 15:09
 */

session_start();

if (isset($_GET['product_id'])) {
    $productId = $_GET['product_id'];
    $product = array(
        'product_id' => $productId,
        'product_amount' => $_SESSION['cart'][$productId]['product_amount'] + 1,
    );


    $_SESSION['cart'][$productId] = $product;
    header("Location: ../shop.php?add_to_cart=".$productId);
}

if(isset($_GET['remove'])) {

    $removeProduct = $_GET['remove'];

    unset($_SESSION['cart'][$removeProduct]);

    header("Location: ../cart.php");
}
