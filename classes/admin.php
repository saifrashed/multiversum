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

            $html .= '<tr>';
            $html .= '<td>' . $row['product_id'] . '</td>';
            $html .= '<td>' . $row['product_name'] . '</td>';
            $html .= '<td>' . $row['product_price'] . '</td>';

            $html .= $this->displayActions($tableType, $row['highlighted'], $row['other_product_details'], $row['product_id']);

            $html .= '</tr>';

        }

        $html .= '</table>';

        $html .= $this->displayPagination($amountPages);

        return $html;
    }


    public function displayActions($tableType, $isHighlighted, $description, $productId) {
        $html = '';
        if (!isset($tableType) || $tableType === 'published') {
            $html .= '<td>';
            $html .= '<button class="btn btn-secondary open-description" style="width: 100%;"><i class="fas fa-file-alt"></i></button>';
            $html .= '<div class="table-product-description">';
            $html .= '<div class="description-form">
                            <form action="./includes/admin_table.php" method="POST">
                                <button type="button" class="btn btn-danger close-description">
                                    <i class="fas fa-times-circle"></i>
                                </button>     
                                <input name="product-id" value="' . $productId . '" style="display: none;">
                                <textarea  name="new-description" rows="4" cols="50">' . ltrim($description) . '</textarea>  
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-save"></i>
                                </button>
                            </form>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</div>';
            $html .= '</td>';

            if ($isHighlighted == 1) {
                $html .= '<td><form action="./includes/admin_table.php" method="POST">                                <input name="product-id" value="' . $productId . '" style="display: none;">
<button class="btn btn-primary" type="submit" name="toggle-highlighted" value="' . $isHighlighted . '" style="width: 100%;"><i class="fas fa-tags"></i></button></form></td>';
            } else {
                $html .= '<td><form action="./includes/admin_table.php" method="POST">                                <input name="product-id" value="' . $productId . '" style="display: none;">
<button class="btn btn-secondary" type="submit" name="toggle-highlighted" value="' . $isHighlighted . '" style="width: 100%;"><i class="fas fa-tags"></i></button></form></td>';
            }

            $html .= '<td><form action="./includes/admin_table.php" method="POST"><input name="product-id" value="' . $productId . '" style="display: none;"><button class="btn btn-danger" type="submit" name="toggle-disable" value="1" style="width: 100%;"><i class="fas fa-times-circle"></i></button></form></td>';
        } else {
            $html .= '<td><form action="./includes/admin_table.php" method="POST"><input name="product-id" value="' . $productId . '" style="display: none;"><button class="btn btn-primary" type="submit" name="toggle-disable" value="0" style="width: 100%;"><i class="fas fa-undo"></i></button></form></td>';
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
        return 6;
    }

    /**
     * Actions
     */

    public function alterProduct($productId, $column, $value) {
        return $this->updateData('UPDATE products SET ' . $column . ' = "' . $value . '" WHERE product_id=' . $productId . ';');
    }


}
