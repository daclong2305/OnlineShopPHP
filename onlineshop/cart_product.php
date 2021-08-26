<?php
session_start();
include 'connect.php';

if (isset($_SESSION['cart'])) {
    foreach ($_SESSION["cart"] as $id => $quantity) {

        $sql = "SELECT * FROM products,categories WHERE product_cat=cat_id and product_id=$id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

            while ($row = $result->fetch_row()) {
                echo "
                        <div class='product-widget'>
                            <div class='product-img'>
                                <img src='product_images/$row[6]' alt=''>
                            </div>
                            <div class='product-body'>
                                <h3 class='product-name'><a href='#'>Red Ladies dress</a></h3>
                                <h4 class='product-price'><span class='qty'>$quantity</span>$row[4] đ</h4>
                            </div>
                        </div>
                        ";
            }
        }
    }
}
