<?php
/**
 * Created by PhpStorm.
 * User: saifeddine
 * Date: 2019-02-18
 * Time: 16:03
 */

require "./header.php";
require "./classes/admin.php";

$admin = new Admin;
?>

<?php
$admin->getPriceAverage();
?>

<div class="container-fluid admin-statistics">
    <div class="row center-xs">
        <div class="col-xs-4 col-md-4 statistics-col">
            <div class="statistics-container">
                <h2>Amount products</h2>
                <span class="statistics-result"><?php echo $admin->getCountProducts(); ?></span>
            </div>
        </div>
        <div class="col-xs-4 col-md-4 statistics-col">
            <div class="statistics-container">
                <h2>Products sold</h2>
                <span class="statistics-result"><?php echo $admin->getProductSold(); ?></span>
            </div>
        </div>
        <div class="col-xs-4 col-md-4 statistics-col">
            <div class="statistics-container">
                <h2>Average prices</h2>
                <span class="statistics-result statistics-price"><?php echo $admin->getPriceAverage(); ?></span>
            </div>
        </div>
    </div>

    <div class="row center-xs">
        <div class="col-xs-12 col-md-4">
            <canvas id="myChart"></canvas>
        </div>
    </div>
</div>

<div class="container-fluid admin-table">
    <div class="row center-xs">
        <div class="admin-table col-xs-12 col-md-10">
            <h2>Product list</h2>

            <?php
            echo $admin->productTable();
            ?>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<?php

require "./footer.php";

?>
