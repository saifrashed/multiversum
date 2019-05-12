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


<div class="container-fluid">

    <div class="row center-xs home-landing">
        <div class="col-xs-12 col-md-4">
            <img class="home-image" src="./assets/mvm.png">
        </div>

        <div class="col-xs-12 col-md-8">
            <div class="home-text">
                <h2>Multiversum The best of the best</h2>
                <p>
                    Imagine the future of entertainment just a few years from now. Virtual reality (VR) hardware and
                    headsets are finally comfortable and stylish enough for mainstream consumption, and the sound
                    quality is crisp and clear. And here at Multiversum we want to deliver this experience to everyone!<br>
                </p>
                <a class="home-cta" href="shop.php">Visit the shop!</a>

            </div>
        </div>
    </div>

    <div class="row center-xs">
        <?php
        echo $products->displayHighlighted();
        ?>
    </div>
</div>

<?php

require "./footer.php";

?>
