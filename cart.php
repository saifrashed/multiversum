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

?>

<?php
echo $products->displayCart();
?>

<?php

require "./footer.php";

?>
