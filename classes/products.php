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
class Product extends Handler {

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

        $result = $this->readsData('SELECT * FROM products WHERE product_cat=' . $category . ' AND disabled != 1;');

        $productsAmount = $productsPerPage;
        $page           = (int)$_GET['productPage'];
        $numRows        = $result->rowCount();
        $offset         = $productsAmount * $page;
        $amountPages    = $numRows / $productsAmount;

        $result = $this->readsData('SELECT * FROM products WHERE product_cat=' . $category . ' AND disabled != 1 LIMIT ' . $offset . ', ' . $productsAmount . '');


        $html = '';

        $html .= $this->displayCategories();

        $html .= '<div class="product-list col-xs-10 col-md-8">';
        while ($row = $result->fetch()) {
            $html .= '<li class="product-item col-xs-12 col-md-3">';

            if ($row['product_discount'] > 0) {
                $discount = ($row['product_price'] * ($row['product_discount'] / 100));
                $price    = $row['product_price'] - $discount;
                $html     .= '<div class="product-sale">SALE ' . $row['product_discount'] . '<i class="fas fa-percent"></i></div>';
            } else {
                $price = $row['product_price'];
            }

            $html .= '<img src="./assets/product_images/' . $row['product_id'] . '.jpeg">';
            $html .= '<span class="product-title"><a href="single?id=' . $row['product_id'] . '">' . $row['product_name'] . '</a></span>';
            $html .= '<div class="product-footer"><form action="includes/add_to_cart.php" method="GET"><input type="hidden" name="product_id" value="' . $row['product_id'] . '" ><button type="submit" class="add_to_cart_btn"><i class="fas fa-cart-plus"></i></button></form>' . '€' . round($price, 2) . "</div>";
            $html .= '</li>';
        }

        $html .= '</div>';

        if ($amountPages > 1) {
            $html .= $this->displayPagination($amountPages, $category);
        }

        return $html;
    }

    /**s
     * product list for highlighted products
     *
     * @return string
     */
    public function displayHighlighted() {
        $result = $this->readsData('SELECT * FROM products WHERE highlighted=1');

        $html = '';

        $html .= '<div class="product-list col-xs-10 col-md-8">';
        $html .= '<h2 class="highlighted-title">Featured products</h2>';

        while ($row = $result->fetch()) {

            $html .= '<li class="product-item col-xs-12 col-md-3">';

            // Checks for discount
            if ($row['product_discount'] > 0) {
                $discount = ($row['product_price'] * ($row['product_discount'] / 100));
                $price    = $row['product_price'] - $discount;
                $html     .= '<div class="product-sale">SALE ' . $row['product_discount'] . '<i class="fas fa-percent"></i></div>';
            } else {
                $price = $row['product_price'];
            }

            $html .= '<img src="./assets/product_images/' . $row['product_id'] . '.jpeg">';
            $html .= '<span class="product-title"><a href="single?id=' . $row['product_id'] . '">' . $row['product_name'] . '</a></span>';
            $html .= '<div class="product-footer"><form action="includes/add_to_cart.php" method="GET"><input type="hidden" name="product_id" value="' . $row['product_id'] . '"><button type="submit" class="add_to_cart_btn"><i class="fas fa-cart-plus"></i></button></form>' . '€' . round($price, 2) . "</div>";
            $html .= '</li>';
        }

        $html .= '</div>';

        return $html;
    }

    /**
     * returns category links
     *
     * @return string
     */
    public function displayCategories() {
        $result = $this->readsData('SELECT * FROM product_cat;');
        $html   = '';

        $html .= '<div class="cat-bar col-xs-12 col-md-8">';
        while ($row = $result->fetch()) {
            $html .= "<a href='?category=" . $row['id'] . "'>" . $row['cat_name'] . "</a>";
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

        $html .= '<ul class="pagination col-xs-12 col-md-8">';

        for ($ndx = 0; $ndx < $amountPages; $ndx++) {
            $html .= '<li class="page-item"><a class="page-link" href="?productPage=' . $ndx . '&category=' . $category . '">' . $ndx . '</a></li>';
        }

        $html .= '</ul>';

        return $html;
    }


    /**
     * queries user input for a search
     *
     * @param $query
     * @return string
     */
    public function searchResults($query) {

        if (strlen($query) < 2) {
            return $html = 'Your search is to short';
        }

        $result = $this->readsData('SELECT * FROM products WHERE product_name LIKE "%' . $query . '%";');

        $html = '';

        if ($result->rowCount() > 0) {

            $html .= '<div class="product-list col-xs-10 col-md-8">';

            while ($row = $result->fetch()) {
                $html .= '<li class="product-item col-xs-12 col-md-3">';

                if ($row['product_discount'] > 0) {
                    $discount = ($row['product_price'] * ($row['product_discount'] / 100));
                    $price    = $row['product_price'] - $discount;
                    $html     .= '<div class="product-sale">SALE ' . $row['product_discount'] . '<i class="fas fa-percent"></i></div>';
                } else {
                    $price = $row['product_price'];
                }

                $html .= '<img src="./assets/product_images/' . $row['product_id'] . '.jpeg">';
                $html .= '<span class="product-title"><a href="single?id=' . $row['product_id'] . '">' . $row['product_name'] . '</a></span>';
                $html .= '<div class="product-footer"><a href="###" class="add_to_cart_btn"><i class="fas fa-cart-plus"></i></a>' . '€' . $price . "</div>";
                $html .= '</li>';
            }

            $html .= '</div>';
        } else {
            $html = 'No results for "' . $query . '" found';
        }
        return $html;
    }


    /**
     * Returns cart html
     *
     * @return string
     */
    public function displayCart($array) {

        $html = '';

        $keyList = array();

        if (!empty($array)) {
            foreach ($array as $key => $value) {
                foreach ($value as $type => $value) {
                    if ($type == 'product_id') {
                        array_push($keyList, $value);
                    }
                }
            }
        } else {

            $html = 'No items in your cart, Why not take a look in the <a href="./shop.php">shop</a>?';

            return $html;
        }

        $formattedCart = implode(', ', $keyList);
        $result        = $this->readsData('SELECT * FROM products WHERE product_id IN (' . $formattedCart . ')');
        $totals        = array();
        $totalPrice    = array_sum($totals);


        $html .= '<table class="table">';

        $html .= '<tr>';
        $html .= '<th>Product name</th>';
        $html .= '<th>Price</th>';
        $html .= '<th>Quantity</th>';
        $html .= '<th>Total</th>';
        $html .= '<th>Action</th>';
        $html .= '</tr>';

        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {

            if ($row['product_discount'] > 0) {
                $discount = ($row['product_price'] * ($row['product_discount'] / 100));
                $price    = $row['product_price'] - $discount;
            } else {
                $price = $row['product_price'];
            }

            $productId    = $row['product_id'];
            $productTotal = $array[$productId]['product_amount'] * $price;

            array_push($totals, $productTotal);

            $html .= '<tr>';
            $html .= '<td>' . $row['product_name'] . '</td>';
            $html .= '<td>&euro;' . $price . '</td>';
            $html .= '<td>' . $array[$productId]['product_amount'] . '</td>';
            $html .= '<td>&euro;' . $productTotal . '</td>';
            $html .= '<td><form action="./includes/add_to_cart.php" method="GET"><input type="hidden" name="remove" value="' . $productId . '"><button class="btn btn-danger" style="width:50px;"><i class="fas fa-times-circle"></i></button></form></td>';
            $html .= '</tr>';
        }
        $html .= '</table>';

        $html .= $this->getCartFooter($productTotal, 21);

        return $html;
    }

    /**
     * Returns product amount
     *
     * @return int
     */
    public function getCartAmount() {
        $cart          = json_decode($_COOKIE['cart'], true);
        $formattedCart = implode(', ', $cart);
        $result        = $this->readsData('SELECT product_name, product_price FROM products WHERE product_id IN (' . $formattedCart . ')');

        return $result->rowCount();
    }

    public function getCartFooter($sum, $tax) {

        $exclTaxSum = $sum * 0.78;

        $html = '<table class="table col-xs-12 col-md-5" style="float:right;">';
        $html .= '<tr>';
        $html .= '<th>Type</th>';
        $html .= '<th>Amount</th>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>Subtotal Excl ' . $tax . '% Taxes</td>';
        $html .= '<td>&euro;' . $exclTaxSum . '</td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td>Total Incl ' . $tax . '% Taxes</td>';
        $html .= '<td>&euro;' . $sum . '</td>';
        $html .= '</tr>';

        $html .= '<tr>';
        $html .= '<td colspan="2"><button class="order-button">Order<i class="fas fa-chevron-right"></i></button></td>';
        $html .= '</tr>';


        $html .= '</table>';

        return $html;
    }

    public function readProduct($id) {
        $result = $this->readsData('SELECT * FROM products WHERE product_id=' . $id . '')->fetch();
        return $result;
    }
}
