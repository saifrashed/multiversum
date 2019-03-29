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
        $result = $this->readsData('SELECT product_id, product_name, product_price FROM products');
        $html   = '';

        $tableHeader = true;
        $html        = '';

        $html .= '<table class="table">';

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            if ($tableHeader) {
                $html .= '<tr>';

                foreach ($row as $key => $value) {
                    $html .= '<th>' . $key . '</th>';
                }

                $html .= '<th colspan="3" style="text-align: center">Actions</th>';

                $html .= '</tr>';

                $tableHeader = !$tableHeader;
            }

            $html .= '<tr>';

            foreach ($row as $value) {
                $html .= '<td>' . $value . '</td>';
            }

            $html .= '<td><button class="btn btn-secondary" style="width: 100%;">change Desc</button></td>';
            $html .= '<td><button class="btn btn-secondary" style="width: 100%;">Highlight</button></td>';
            $html .= '<td><button class="btn btn-danger" style="width: 100%;">Remove</button></td>';


            $html .= '</tr>';

        }

        $html .= '</table>';

        return $html;
    }

    public function getCountProducts() {
        $result = $this->readsData('SELECT * FROM products');

        return $result->rowCount();
    }

    public function getPriceAverage() {
        $result = $this->readsData('SELECT AVG(product_price) AS averagePrice FROM products');

        $row = $result->fetch();

        return round($row['averagePrice'], 2);
    }

    public function getProductSold() {
        return 6;
    }

}
