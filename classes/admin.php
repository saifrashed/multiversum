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
        $result = $this->readsData('SELECT * FROM products');

        $productsAmount = 10;
        $page           = (int)$_GET['productPage'];
        $numRows        = $result->rowCount();
        $offset         = $productsAmount * $page;
        $amountPages    = $numRows / $productsAmount;
        $tableHeader    = true;


        $result = $this->readsData('SELECT * FROM products LIMIT ' . $offset . ', ' . $productsAmount . '');

        $html = '';
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
            $html .= '<td><button class="btn btn-secondary" style="width: 100%;"><i class="fas fa-file-alt"></i></button></td>';

            if ($row['highlighted'] == 1) {
                $html .= '<td><button class="btn btn-primary" style="width: 100%;"><i class="fas fa-tags"></i></button></td>';
            } else {
                $html .= '<td><button class="btn btn-secondary" style="width: 100%;"><i class="fas fa-tags"></i></button></td>';
            }

            $html .= '<td><button class="btn btn-danger" style="width: 100%;"><i class="fas fa-times-circle"></i></button></td>';
            $html .= '</tr>';

        }

        $html .= '</table>';
        $html .= '<ul class="pagination">';

        for ($ndx = 0; $ndx < $amountPages; $ndx++) {
            $html .= '<li class="page-item"><a class="page-link" href="?productPage=' . $ndx . '&category=' . $category . '">' . $ndx . '</a></li>';
        }

        $html .= '</ul>';

        return $html;
    }

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

}
