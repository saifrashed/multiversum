<?php
/**
 * User: saifeddine
 * Date: 2019-03-25
 * Time: 15:09
 */

if(isset($_GET['product_id'])) {

    $productCart = array();

    if(isset($_COOKIE['cart'])) {
        $productCart = json_decode($_COOKIE['cart'], true);
    }

    $productId = $_GET['product_id'];

    array_push($productCart, $productId);

    setcookie('cart', json_encode($productCart), time()+3600, '/');
}


echo "<script> location.href='../shop.php?add_to_cart=".$_GET['product_id']."'; </script>";
