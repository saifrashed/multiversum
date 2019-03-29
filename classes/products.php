<?php
/**
 * Created by PhpStorm.
 * User: saifeddine
 * Date: 2019-02-20
 * Time: 13:25
 */


/**
 * Product class is used to perform various actions for products.
 *
 * This class handles database connection, product queries and displays relevant product information.
 *
 *
 * @author   Saif Rashed <saifeddinerashed@icloud.com>
 * @version  1
 * @access   public
 */
class Product {

    // property declaration
    private $servername = "localhost";
    private $username = "root";
    private $password = "Rashed112";
    private $dbname = "multiversum";

    // method declaration

    /**
     * Connection
     */
    private function createConn() {
        $conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        return $conn;
    }


    /**
     * Standard query
     */
    private function createQuery($query) {
        $conn   = $this->createConn();
        $sql    = $query;
        $result = $conn->query($sql);

        return $result;
    }


    /**
     * Get columns.
     *
     * @param $table
     * @return array
     */
    public function getColumns($table) {

        $result = $this->createQuery('SHOW COLUMNS FROM ' . $table . ';');

        $fields = array();

        while ($row = $result->fetch_assoc()) {
            $fields[] = $row['Field'];
        }
        return $fields;
    }

    /**
     * Displays rows with all data in table.
     *
     * @param $table
     * @return string
     */
    public function displayRows($table) {

        $result = $this->createQuery('SELECT * FROM ' . $table . ';');

        $html = '<table class="table">';

        while ($row = $result->fetch_assoc()) {
            $html .= '<tr>';

            foreach ($row as $value) {
                $html .= '<td>' . $value . '</td>';
            }

            $html .= '</tr>';
        }
        $html .= '</table>';

        return $html;
    }

    /**
     * determines if product exists
     *
     * @param $product_name
     * @return bool
     */
    public function productExist($product_name) {
        $result = $this->createQuery('SELECT product_name FROM products WHERE product_name="' . $product_name . '";');
        $row    = $result->num_rows;
        return (bool)$row;
    }


    /**
     * returns row of given product id.
     *
     * @param $id
     * @return array|null
     */
    public function productRow($id) {
        $result = $this->createQuery('SELECT * FROM products WHERE product_id="' . $id . '";');
        $row    = $result->fetch_assoc();
        return $row;
    }

    /**
     * Displays complete product archive.
     *
     * @return string
     */
    public function productArchive($pageNum, $productAmount, $catId) {

        $result = $this->createQuery('SELECT * FROM products WHERE product_cat=' . $catId);

        $productsAmount = $productAmount;
        $pageNum        = (int)$pageNum;
        $numRows        = $result->num_rows;
        $offset         = $productsAmount * $pageNum;
        $amountPages    = $numRows / $productsAmount;

        $result = $this->createQuery('SELECT * FROM products WHERE product_cat=' . $catId . ' LIMIT ' . $offset . ', ' . $productsAmount . '');


        $html = '';

        $html .= '<div class="product-list col-8">';

        while ($row = $result->fetch_assoc()) {
            $html .= '<li class="product-item col-4">';
            $html .= '<img src="./assets/product_images/' . $row['product_id'] . '.jpeg">';
            $html .= '<span class="product-title"><a href="single?title=winkel&id=' . $row['product_id'] . '">' . $row['product_name'] . '</a></span>';
            $html .= '<div class="product-footer"><a href="###" class="add_to_cart_btn"><i class="fas fa-cart-plus"></i></a>' . '€' . $row['product_price'] . "</div>";
            $html .= '</li>';
        }

        if ($amountPages > 1) {
            $html .= '<ul class="pagination">';

            for ($ndx = 0; $x < $amountPages; $ndx++) {
                $html .= '<li class="page-item"><a class="page-link" href="?pageNum=' . $ndx . '&cat_id=' . $catId . '">' . $ndx . '</a></li>';
            }

            $html .= '</ul>';
        }

        $html .= '</div>';

        return $html;
    }


    /**
     * Returns buttons to control categories
     *
     * @return string
     */
    public function categoryButtons() {

        $result = $this->createQuery('SELECT * FROM product_cat;');
        $html   = '';

        while ($row = $result->fetch_assoc()) {
            $html .= "<a href='?title=Winkel&cat_id=" . $row['id'] . "'>" . $row['cat_name'] . "</a>";
        }

        return $html;
    }
}
