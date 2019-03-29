<?php
/**
 * Created by PhpStorm.
 * User: saifeddine
 * Date: 2019-02-18
 * Time: 16:03
 */

require "./header.php";
include './classes/products.php';

$products = new Product();

?>

<div class="shop_summary">
    <h1> VR is the future! </h1>
    <p>
        VR will make you feel like you are there mentally and physically. You turn your head and the world turns with
        you so the illusion created by whatever world you are in is never lost.
        Watch a film in the cinema and the split-second fear you might feel when a devastating earthquake happens on
        screen will very quickly disappear if you turn your head to see the person next to you munching away on their
        popcorn. Films and books take you to different fictional worlds, but they are not world's you change based on
        your actions.
    </p>
</div>

<div>
    <form action="search.php" method="GET">
        <input type="text" name="query" />
        <input type="submit" value="Search" />
    </form>
</div>

<?php
echo $products->displayProducts(6, $_GET['category']);
?>

<?php

require "./footer.php";

?>
