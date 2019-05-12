<?php
/**
 * User: saifeddine
 * Date: 2019-03-25
 * Time: 15:09
 */

require '../classes/admin.php';
$admin = new Admin;

// File variable
$uploadOk      = 1;
$imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

// Product variable
$productName  = trim($_POST['product-name']);
$productPrice = trim($_POST['product-price']);
$productSuppl = trim($_POST['product-supplier']);
$productDesc  = trim($_POST['product-description']);
$productCat   = trim($_POST['cat']);
$highlighted  = 0;
$disabled     = 0;

if (empty($productName) || empty($productDesc)) {
    $err = 'Some requires fields are empty';
    return header("Location: ../admin.php?err=" . $err);
} else {
    if (empty($productSuppl)) {
        $productSuppl = 0;
    }
}

if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["product-img"]["tmp_name"]);
    if ($check !== false) {
        $uploadOk = 1;
    } else {
        $err = 'Image is not actually not a image';
        return header("Location: ../admin.php?err=" . $err);
    }
};

if ($_FILES["product-img"]["type"] !== 'image/jpeg') {
    $err = 'Image is not actually not a jpeg';
    return header("Location: ../admin.php?err=" . $err);
}

if ($uploadOk == 0) {
    $err = 'Image is not uploaded';
    return header("Location: ../admin.php?err=" . $err);}

$id = $admin->createProduct((int)$productCat, $productName, (float)$productPrice, $productSuppl, $productDesc, $highlighted, $disabled);

$_FILES['product-img']['name'] = $id.'.jpeg';
$target_dir    = "../assets/product_images/";
$target_file   = $target_dir . basename($_FILES["product-img"]["name"]);


move_uploaded_file($_FILES["product-img"]["tmp_name"], $target_file);

header("Location: ../admin.php");
