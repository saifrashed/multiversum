<?php
/**
 * Created by PhpStorm.
 * User: saifeddine
 * Date: 2019-02-18
 * Time: 16:03
 */

require "./header.php";
require "./classes/products.php";

session_start();

$products = new Product;



?>

<div class="container-fluid">
    <div class="row center-xs">
        <div class="cart col-xs-12 col-md-8">
            <?php
            echo $products->displayCart($_SESSION['cart']);
            ?>
        </div>
    </div>
</div>

<?php

require "./footer.php";

?>
