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

$addToCart = $products->readProduct((int)$_GET['add_to_cart']);

?>

<div class="container-fluid">
    <div class="row center-xs">
        <div class="shop_summary col-xs-12 col-md-8">
            <h1> VR is the future! </h1>
            <p>
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut rhoncus tempus mi in rutrum. Aliquam
                placerat ex ac justo pulvinar, et sollicitudin justo volutpat. Sed convallis ut nisl quis sollicitudin.
                Integer viverra sollicitudin felis sed mattis. Integer volutpat malesuada tortor, eget scelerisque purus
                mollis in. Quisque viverra eget lectus vel eleifend. Donec in velit non nulla pharetra mollis. Nullam
                eleifend eros nec felis maximus vestibulum. Aenean tempor elit ut ante pharetra pellentesque. Proin
                aliquet, velit vel gravida ultricies, libero ante convallis diam, a facilisis ipsum velit a est. Vivamus
                luctus quam nulla, in fermentum urna interdum iaculis. In massa erat, convallis et orci sit amet,
                consectetur placerat ex. Fusce eu erat tincidunt, fermentum enim quis, placerat orci. Quisque vel
                facilisis mauris, a maximus nisl. Aliquam interdum pharetra purus, eu pulvinar enim
            </p>
        </div>
    </div>
</div>

<?php
if (isset($_GET['add_to_cart'])) {
    ?>
    <div class="container-fluid">
        <div class="row center-xs">
            <div class="message col-xs-12 col-md-8">
                <div class="added_to_cart"><?php echo '"' . $addToCart['product_name'] . '" has been added to your cart.' ?>
                    <a href="shop.php"><i class="fas fa-times-circle"></i></a></div>
            </div>
        </div>
    </div>

    <?php
}
?>

<div class="container-fluid">
    <div class="row center-xs">
        <?php
        echo $products->displayProducts(6, $_GET['category']);
        ?>
    </div>
</div>

<?php

require "./footer.php";

?>
