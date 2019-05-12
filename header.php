<?php
/**
 * Header
 * User: saifeddine
 * Date: 2019-02-18
 * Time: 15:32
 */

session_start();


switch ($_SERVER['PHP_SELF']) {
    case '/projecten/multiversum/home.php':
        $title = 'Multiversum - Home';
        break;
    case '/projecten/multiversum/about.php':
        $title = 'Multiversum - About';
        break;
    case '/projecten/multiversum/shop.php':
        $title = 'Multiversum - Shop';
        break;
    case '/projecten/multiversum/contact.php':
        $title = 'Multiversum - Contact';
        break;
    case '/projecten/multiversum/account.php':
        $title = 'Multiversum - Account';
        break;
    case '/projecten/multiversum/cart.php':
        $title = 'Multiversum - Cart';
        break;
    case '/projecten/multiversum/search.php':
        $title = 'Multiversum - Search';
        break;
    case '/projecten/multiversum/admin.php':
        $title = 'Hello ' . ucfirst($_SESSION['fname']) . ' ' . ucfirst($_SESSION['lname']);
        break;
    default:
        $title = 'Home';
}

$productCart = $_SESSION['cart'];
$cartCount   = count($productCart);
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <title>Multiversum Webshop</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="./css/grids.css">
    <link rel="stylesheet" type="text/css" href="./css/main.css">
</head>

<body>

<header class="header">

    <!-- Desktop menu -->
    <div class="header-menu row">
        <div class="col-2">
            <a href="home.php">
                <img src="assets/logo.png"/>
            </a>
        </div>
        <nav class="col-5">
            <ul>
                <li><a href="home.php">Home</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
        </nav>


        <nav class="col-5" style="text-align: right;">
            <form action="search.php" method="GET"
            ">
            <input type="text" name="query" placeholder="Search products..."/>
            </form>

            <?php if ($_SESSION['admin']) { ?>
                <li>
                    <a href="admin.php">
                        <i style="padding-right:5px;" class="fas fa-users-cog"></i>Admin
                    </a>
                </li>
            <?php } ?>

            <li><a href="cart.php"><i
                            class="fas fa-shopping-cart"></i>(<?php echo $cartCount ?>)</a></li>

            <?php if (!isset($_SESSION['fname']) && !isset($_SESSION['lname'])) { ?>
                <li><a href="account.php">
                        <i style="padding-right:5px;" class="fas fa-user"></i>Account
                    </a>
                </li>
            <?php } else { ?>
                <li>
                    <button type="submit" class="logout-btn">
                        <i style="padding-right:5px;" class="fas fa-sign-out-alt"></i>Logout
                    </button>
                </li>
            <?php } ?>

        </nav>
    </div>

    <div class="mobile-bar">

        <ul style="float: left;">
            <li><a class="open-toggle" href="#"><i class="fas fa-bars"></i></a></li>
        </ul>

        <a href="home.php"><img src="assets/logo.png" style="width: 150px;" /></a>

        <ul style="float: right;">
            <li><a href="cart.php"><i class="fas fa-shopping-cart"></i>(<?php echo $cartCount ?>)</a></li>
            <li><a href="account.php"><i style="padding-right:5px;" class="fas fa-user"></i></a></li>
        </ul>

        <div class="popup-menu close-menu col-xs-12">

            <button class="close-toggle"><i class="far fa-times-circle"></i></button>

            <nav class="col-xs-12">
                <ul>
                    <li><a href="home.php">Home</a></li>
                    <li><a href="about.php">About</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </nav>
        </div>

    </div>


</header>

<section class="slider">
    <h1 class="slider-title"><?php echo $title; ?></h1>
</section>
