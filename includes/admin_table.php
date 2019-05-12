<?php
/**
 * User: saifeddine
 * Date: 2019-03-25
 * Time: 15:09
 */

require '../classes/admin.php';
$admin   = new Admin;
$pageNum = $_GET['productPage'];

$err = '';

if (isset($_POST['product-desc']) || isset($_POST['product-name']) || isset($_POST['product-price']) || isset($_POST['product-discount']) && isset($_POST['product-id'])) {
    $productDesc  = $_POST['product-desc'];
    $productPrice = floatval($_POST['product-price']);
    $productName  = $_POST['product-name'];
    $productDiscount  = (int)trim($_POST['product-discount']);
    $productId    = (int)$_POST['product-id'];

    $admin->alterProduct($productId, 'product_name', $productName);
    $admin->alterProduct($productId, 'product_price', $productPrice);
    $admin->alterProduct($productId, 'product_discount', $productDiscount);
    $admin->alterProduct($productId, 'other_product_details', $productDesc);

    unset($_POST['product-id']);
    unset($_POST['product-name']);
    unset($_POST['product-price']);
    unset($_POST['product-desc']);
}


/**
 * Toggle highlighted
 */

if (isset($_POST['toggle-highlighted']) && isset($_POST['product-id'])) {
    $isHighlighted = $_POST['toggle-highlighted'];
    $productId     = $_POST['product-id'];


    if($isHighlighted == 0 && $admin->countHighlighted() == 3) {
        $err = 'Maximal 3 products.';
    } else {
        if ($isHighlighted == 0) {
            $admin->alterProduct($productId, 'highlighted', 1);
        } else {
            $admin->alterProduct($productId, 'highlighted', 0);
        }
    }

    unset($_POST['product-id']);
    unset($_POST['toggle-highlighted']);

}

/**
 * Toggle disabled
 */
if (isset($_POST['product-id']) && isset($_POST['toggle-disable'])) {

    $productId = $_POST['product-id'];

    if ($_POST['toggle-disable'] == 1) {
        $value = 1;
    } else {
        $value = 0;
    }

    $admin->alterProduct($productId, 'product_discount', 0);
    $admin->alterProduct($productId, 'highlighted', 0);
    $admin->alterProduct($productId, 'disabled', $value);

    unset($_POST['product-id']);
    unset($_POST['disable']);
}

header("Location: ../admin.php?err=".$err."");
