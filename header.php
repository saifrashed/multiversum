<?php
/**
 * Header
 * User: saifeddine
 * Date: 2019-02-18
 * Time: 15:32
 */

session_start();

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
    <div class="header-menu row">
        <div class="col-2">
            <a href="home.php">
                <img src="assets/logo.png"/>
            </a>
        </div>
        <nav class="col-5">
            <ul>
                <li><a href="home.php?title=Home">Home</a></li>
                <li><a href="about.php?title=Over ons">Over ons</a></li>
                <li><a href="shop.php?title=Winkel">Winkel</a></li>
                <li><a href="contact.php?title=Contact">Contact</a></li>
            </ul>
        </nav>


        <nav class="col-5" style="text-align: right;">
            <form action="search.php" method="GET"
            ">
            <input type="text" name="query" placeholder="Search products..."/>
            </form>

            <?php if ($_SESSION['admin']) { ?>

                <form action="admin.php" method="GET">
                    <li><a href="admin.php?title=Administration page">
                            <i style="padding-right:5px;" class="fas fa-users-cog"></i>Admin
                        </a>
                    </li>
                </form>

            <?php } ?>

            <form action="includes/logout.php">
                <li><a href="cart.php?title=Cart"><i
                                class="fas fa-shopping-cart"></i>(<?php //echo $products->getCartAmount(); ?>)</a></li>

                <?php if (!isset($_SESSION['fname']) && !isset($_SESSION['lname'])) { ?>
                    <li><a href="account.php?title=Account">
                            <i style="padding-right:5px;" class="fas fa-user"></i>Account
                        </a>
                    </li>
                <?php } else { ?>

                    <button type="submit"><i style="padding-right:5px;" class="fas fa-sign-out-alt"></i>Logout</button>

                <?php } ?>
            </form>
        </nav>
    </div>
</header>

<section class="slider">
    <h1 class="slider-title"><?php echo $_GET['title'] ?></h1>
</section>
