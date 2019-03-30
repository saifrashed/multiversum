<?php
/**
 * User: saifeddine
 * Date: 2019-03-25
 * Time: 15:09
 */

if(isset($_GET['product_id'])) {

    $productCart = array();
    $productId = $_GET['product_id'];

    if(isset($_COOKIE['cart'])) {
        $productCart = json_decode($_COOKIE['cart'], true);
    }

    array_push($productCart, $productId);
    setcookie('cart', json_encode($productCart), time()+3600, '/');
}

return header("Location: ../shop.php?add_to_cart=".$_GET['product_id']);
