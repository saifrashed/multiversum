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

<div class="container-fluid admin-container">
    <div class="row left-xs">
        <div class="col-xs-12 col-md-2 col-md-offset-1">
            <button class="btn btn-primary add-product" style="display:inline-block"><i class="fas fa-plus" style="padding-right: 10px;"></i>Add
                product
            </button>
        </div>

        <div class="col-xs-12 col-md-8 table-controls">
            <form action="admin.php" method="GET">
                <button class="btn btn-secondary" type="submit" name="table" value="published">Published</button>
                <button class="btn btn-secondary" type="submit" name="table" value="disabled">Disabled</button>
            </form>
        </div>
    </div>

    <div class="row center-xs">
        <div class="admin-add col-xs-12 col-md-10">
            <div class="col-xs-12 col-md-4 col-md-offset-4">
                <form action="./includes/admin_add.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <input type="text" name="product-name" class="form-control" id="usr"
                               placeholder="Product name">
                        <input type="text" name="product-price" class="form-control" id="usr"
                               placeholder="Price (EUR)">
                        <input type="text" name="product-supplier" class="form-control" id="usr"
                               placeholder="Supplier ID">
                        <textarea name="product-description" rows="4" cols="50"></textarea>
                        <input type="file" name="product-img"><br>
                    </div>


                    <?php echo $admin->displayCategories(); ?> <br>

                    <button class="btn btn-primary" type="submit">Add</button>
                </form>
            </div>
        </div>
        <div class="admin-table col-xs-12 col-md-10">
            <?php
            echo $admin->productTable();
            ?>
        </div>
    </div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<?php

require "./footer.php";

?>
