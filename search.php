<?php
/**
 * Created by PhpStorm.
 * User: saifeddine
 * Date: 2019-02-18
 * Time: 16:03
 */

require "./header.php";
require "./classes/products.php";

$products = new Product();

?>

<div class="container-fluid">
    <div class="row center-xs">
        <?php
        echo $products->searchResults($_GET['query']);
        ?>
    </div>
</div>

<?php

require "./footer.php";

?>
