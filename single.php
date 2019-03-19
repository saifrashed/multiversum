<?php
/**
 * Created by PhpStorm.
 * User: saifeddine
 * Date: 2019-02-18
 * Time: 16:03
 */

require "./header.php";
include "./classes/products.php";

?>


<?php

$products = new Product();

echo $products->productArchive();

?>

<?php

require "./footer.php";

?>
