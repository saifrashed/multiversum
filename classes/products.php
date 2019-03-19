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
 * This class makes use of SQL queries to return data that might be used in
 * later stages of a webshop to display different kind of information to user.
 *
 *
 * @author   Saif Rashed <saif@icloud.com>
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

    public function getColumns($table) {
        $conn   = $this->createConn();
        $sql    = 'SHOW COLUMNS FROM ' . $table . ';';
        $result = $conn->query($sql);

        $fields = array();

        while ($row = $result->fetch_assoc()) {
            $fields[] = $row['Field'];
        }
        return $fields;
    }

    public function displayRows($table) {
        $conn   = $this->createConn();
        $sql    = 'SELECT * FROM ' . $table . ';';
        $result = $conn->query($sql);

        $buttons = array(
            'read more...',
        );

        $html = '';

        while ($row = $result->fetch_assoc()) {
            $html .= '<tr>';

            foreach ($row as $value) {
                $html .= '<td>' . $value . '</td>';
            }

            foreach ($buttons as $value) {
                $html .= '<td><button>' . $value . '</button></td>';
            }

            $html .= '</tr>';
        }

        return $html;
    }

    public function productExist($product_name) {

        $conn   = $this->createConn();
        $sql    = 'SELECT product_name FROM products WHERE product_name="' . $product_name . '";';
        $result = $conn->query($sql);
        $row    = $result->num_rows;


        return (bool)$row;
    }
}
