<?php
/**
 * User: saifeddine
 * Date: 2019-02-20
 * Time: 13:25
 */

include 'handler.php';


/**
 * The admin class handles admin control and functionality
 *
 *
 * @author   Saif Rashed <saifeddinerashed@icloud.com>
 * @version  1
 * @access   public
 */
class Admin extends Handler {

    public function productTable() {

        $tableType   = $_GET['table'];
        $tableHeader = true;
        $html        = '';

        if (!isset($tableType) || $tableType === 'published') {
            $result = $this->readsData('SELECT * FROM products WHERE disabled != 1');
        } else {
            $result = $this->readsData('SELECT * FROM products WHERE disabled = 1');
        }


        $productsAmount = 10;
        $page           = (int)$_GET['productPage'];
        $numRows        = $result->rowCount();
        $offset         = $productsAmount * $page;
        $amountPages    = $numRows / $productsAmount;

        if (!isset($tableType) || $tableType === 'published') {
            $result = $this->readsData('SELECT * FROM products WHERE disabled != 1 LIMIT ' . $offset . ', ' . $productsAmount . '');
        } else {
            $result = $this->readsData('SELECT * FROM products WHERE disabled = 1 LIMIT ' . $offset . ', ' . $productsAmount . '');
        }

        $html .= '<table class="table">';

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            if ($tableHeader) {
                $html .= '<tr>';

                foreach ($row as $key => $value) {
                    if ($key === 'product_id' || $key === 'product_name' || $key === 'product_price') {
                        $html .= '<th>' . $key . '</th>';
                    }
                }

                $html .= '<th colspan="3" style="text-align: center">Actions</th>';
                $html .= '</tr>';

                $tableHeader = !$tableHeader;
            }

            if ($row['product_discount'] > 0) {
                $discount = ($row['product_price'] * ($row['product_discount'] / 100));
                $price    = $row['product_price'] - $discount;
            } else {
                $price = $row['product_price'];
            }

            $html .= '<tr>';
            $html .= '<td>' . $row['product_id'] . '</td>';
            $html .= '<td>' . $row['product_name'] . '</td>';
            $html .= '<td class="admin-table-price">' . $price . '</td>';

            $html .= $this->displayActions($tableType, $row['highlighted'], $row['other_product_details'], $row['product_name'], $row['product_price'], $row['product_discount'], $row['product_id']);

            $html .= '</tr>';

        }

        $html .= '</table>';

        $html .= $this->displayPagination($amountPages);

        return $html;
    }


    public function displayActions($tableType, $isHighlighted, $description, $productName, $productPrice, $productDiscount, $productId) {
        $html = '';
        if (!isset($tableType) || $tableType === 'published') {
            $html .= '<td>';
            $html .= '<button class="btn btn-secondary open-description" style="width: 100%;"><i class="fas fa-file-alt"></i>Update</button>';
            $html .= '<div class="table-product-description">';
            $html .= '<div class="update-form">
                            <form action="./includes/admin_table.php" method="POST">
                                <button type="button" class="btn btn-danger close-description">
                                    <i class="fas fa-times-circle"></i>
                                </button>     
                                
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-save"></i>
                                </button>
                                <input type="hidden" class="update-input" name="product-id" value="' . $productId . '">
                                <input class="update-input" name="product-price" value="' . $productPrice . '">
                                <input class="update-input" name="product-discount" value="' . $productDiscount . '">
                                <textarea class="update-input" name="product-desc" rows="4" cols="50">' . ltrim($description) . '</textarea>  
             
                            </form>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</td>';

            if ($isHighlighted == 1) {
                $html .= '<td><form action="./includes/admin_table.php" method="POST"><input type="hidden" name="product-id" value="' . $productId . '">
                          <button class="btn btn-primary" type="submit" name="toggle-highlighted" value="' . $isHighlighted . '" style="width: 100%;"><i class="fas fa-tags"></i>featured</button></form></td>';
            } else {
                $html .= '<td><form action="./includes/admin_table.php" method="POST"><input type="hidden" name="product-id" value="' . $productId . '"s>
                          <button class="btn btn-secondary" type="submit" name="toggle-highlighted" value="' . $isHighlighted . '" style="width: 100%;"><i class="fas fa-tags"></i>featured</button></form></td>';
            }
            $html .= '<td><form action="./includes/admin_table.php" method="POST"><input name="product-id" value="' . $productId . '" style="display: none;"><button class="btn btn-danger" type="submit" name="toggle-disable" value="1" style="width: 100%;"><i class="fas fa-times-circle"></i>disable</button></form></td>';
        } else {
            $html .= '<td><form action="./includes/admin_table.php" method="POST"><input name="product-id" value="' . $productId . '" style="display: none;"><button class="btn btn-primary" type="submit" name="toggle-disable" value="0" style="width: 100%;"><i class="fas fa-undo"></i>Republish</button></form></td>';
        }

        return $html;
    }

    public function displayPagination($amountPages) {
        $html = '';
        if ($amountPages > 1) {
            $html .= '<ul class="pagination">';

            for ($ndx = 0; $ndx < $amountPages; $ndx++) {
                $html .= '<li class="page-item"><a class="page-link" href="?productPage=' . $ndx . '">' . $ndx . '</a></li>';
            }

            $html .= '</ul>';
        }

        return $html;
    }


    /**
     * Add product
     */

    public function displayCategories() {

        $result = $this->readsData('SELECT * FROM product_cat');
        $html   = '';

        $html .= '<select name="cat">';

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $html .= '<option value="' . $row['id'] . '">' . $row['cat_name'] . '</option> ';
        }

        $html .= '</select>';

        return $html;
    }

    public function createProduct($productCat, $productName, $productPrice, $supplierId, $otherProductDetails, $highlighted, $disabled) {

        $result = $this->createData('INSERT INTO products(product_cat, product_name, product_price, supplier_id, other_product_details, highlighted, disabled) 
                                          VALUES (' . $productCat . ',"' . $productName . '",' . $productPrice . ',' . $supplierId . ',"' . $otherProductDetails . '",' . $highlighted . ',' . $disabled . ');');

        return $result;
    }

    public function alterProduct($productId, $column, $value) {
        return $this->updateData('UPDATE products SET ' . $column . ' = "' . $value . '" WHERE product_id=' . $productId . ';');
    }

    /**s
     * Getters
     */

    public function getCountProducts() {
        $result = $this->readsData('SELECT * FROM products');
        return $result->rowCount();
    }

    public function getPriceAverage() {
        $result = $this->readsData('SELECT AVG(product_price) AS averagePrice FROM products');
        $row    = $result->fetch();

        return round($row['averagePrice'], 2);
    }

    public function getProductSold() {
        return 50;
    }

    public function countHighlighted() {
        $result = $this->readsData('SELECT * FROM products WHERE highlighted = 1');
        return $result->rowCount();
    }

}
