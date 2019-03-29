<?php
/**
 * User: saifeddine
 * Date: 2019-02-20
 * Time: 13:25
 */

include 'handler.php';

/**
 * Product class is used to perform various actions for products.
 *
 *
 * @author   Saif Rashed <saifeddinerashed@icloud.com>
 * @version  1
 * @access   public
 */
class Product extends handler {


    /**
     * Displays a complete archive of products
     *
     * @param $productsPerPage
     * @param $category
     * @return string
     */
    public function displayProducts($productsPerPage, $category) {

        if (empty($category)) {
            $category = 0;
        }

        $result = $this->readsData('SELECT * FROM products WHERE product_cat=' . $category);

        $productsAmount = $productsPerPage;
        $page           = (int)$_GET['productPage'];
        $numRows        = $result->rowCount();
        $offset         = $productsAmount * $page;
        $amountPages    = $numRows / $productsAmount;

        $result = $this->readsData('SELECT * FROM products WHERE product_cat=' . $category . ' LIMIT ' . $offset . ', ' . $productsAmount . '');


        $html = '';

        $html .= $this->displayCategories();

        $html .= '<div class="product-list col-8">';

        while ($row = $result->fetch()) {
            $html .= '<li class="product-item col-4">';
            $html .= '<img src="./assets/product_images/' . $row['product_id'] . '.jpeg">';
            $html .= '<span class="product-title"><a href="single?title=winkel&id=' . $row['product_id'] . '">' . $row['product_name'] . '</a></span>';
            $html .= '<div class="product-footer"><a href="###" class="add_to_cart_btn"><i class="fas fa-cart-plus"></i></a>' . '€' . $row['product_price'] . "</div>";
            $html .= '</li>';
        }

        $html .= '</div>';

        if ($amountPages > 1) {
            $html .= $this->displayPagination($amountPages, $category);
        }

        return $html;
    }

    public function displayHighlighted() {
        $result = $this->readsData('SELECT * FROM products WHERE highlighted=1');


        $html = '<h2 style="text-align: center"> Highlighted products </h2>';


        $html .= '<div class="product-list  col-8">';

        while ($row = $result->fetch()) {
            $html .= '<li class="product-item col-4">';
            $html .= '<img src="./assets/product_images/' . $row['product_id'] . '.jpeg">';
            $html .= '<span class="product-title"><a href="single?title=winkel&id=' . $row['product_id'] . '">' . $row['product_name'] . '</a></span>';
            $html .= '<div class="product-footer"><a href="###" class="add_to_cart_btn"><i class="fas fa-cart-plus"></i></a>' . '€' . $row['product_price'] . "</div>";
            $html .= '</li>';
        }

        $html .= '</div>';

        return $html;
    }

    public function displayCategories() {
        $result = $this->readsData('SELECT * FROM product_cat;');
        $html   = '';

        $html .= '<div class="cat-bar col-8">';
        while ($row = $result->fetch()) {
            $html .= "<a href='?title=" . $row['cat_name'] . "&category=" . $row['id'] . "'>" . $row['cat_name'] . "</a>";
        }
        $html .= '</div>';

        return $html;
    }

    /**
     * displays pagination links for the products
     *
     * @param $amountPages
     * @param $category
     * @return string
     */
    public function displayPagination($amountPages, $category) {
        $html = '';

        $html .= '<ul class="pagination">';

        for ($ndx = 0; $ndx < $amountPages; $ndx++) {
            $html .= '<li class="page-item"><a class="page-link" href="?productPage=' . $ndx . '&category=' . $category . '">' . $ndx . '</a></li>';
        }

        $html .= '</ul>';

        return $html;
    }


    public function searchResults($query) {

        if (strlen($query) < 2) {
            return $html = 'Your search is to short';
        }

        $result = $this->readsData('SELECT * FROM products WHERE product_name LIKE "%' . $query . '%");');

        $html = '';

        if ($result->rowCount() > 0) {

            $html .= '<div class="product-list col-8">';

            while ($row = $result->fetch()) {
                $html .= '<li class="product-item col-4">';
                $html .= '<img src="./assets/product_images/' . $row['product_id'] . '.jpeg">';
                $html .= '<span class="product-title"><a href="single?title=winkel&id=' . $row['product_id'] . '">' . $row['product_name'] . '</a></span>';
                $html .= '<div class="product-footer"><a href="###" class="add_to_cart_btn"><i class="fas fa-cart-plus"></i></a>' . '€' . $row['product_price'] . "</div>";
                $html .= '</li>';
            }

            $html .= '</div>';
        } else {
            $html = 'No results for ' . $query . ' found';
        }
        return $html;
    }

    public function readProduct($id) {
        $result = $this->readsData('SELECT * FROM products WHERE product_id='. $id .'')->fetch();
        return $result;
    }
}