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

$product = new Product();
$id      = $_GET['id'];

$productData = $product->productRow($id);

?>

<h1><?php echo $productData['product_name']; ?></h1>

<?php

?>

<?php

require "./footer.php";

?>
