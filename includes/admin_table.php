<?php
/**
 * User: saifeddine
 * Date: 2019-03-25
 * Time: 15:09
 */

require '../classes/admin.php';
$admin = new Admin;

if (isset($_POST['new-description']) && isset($_POST['product-id'])) {
    $newDesc   = $_POST['new-description'];
    $productId = (int)$_POST['product-id'];

    $admin->alterProduct($productId, 'other_product_details', $newDesc);

    unset($_POST['product-id']);
    unset($_POST['new-description']);
}


if (isset($_POST['toggle-highlighted']) && isset($_POST['product-id'])) {
    $isHighlighted = $_POST['toggle-highlighted'];
    $productId     = $_POST['product-id'];

    if ($isHighlighted == 0) {
        $toggleValue = 1;
    } else {
        $toggleValue = 0;
    }

    $admin->alterProduct($productId, 'highlighted', $toggleValue);

    unset($_POST['product-id']);
    unset($_POST['toggle-highlighted']);
}

if (isset($_POST['product-id']) && isset($_POST['toggle-disable'])) {

    $productId = $_POST['product-id'];

    if ($_POST['toggle-disable'] == 1) {
        $value = 1;
    } else {
        $value = 0;
    }

    $admin->alterProduct($productId, 'disabled', $value);

    unset($_POST['product-id']);
    unset($_POST['disable']);
}


header("Location: ../admin.php");
