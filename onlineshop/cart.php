<?php
include "header.php";
include "connect.php";


if (isset($_GET['action'])) {
    switch ($_GET['action']) {
        case "add":
            if (!isset($_SESSION["cart"])) {
                $_SESSION["cart"] = array();
            }

            if (isset($_POST['quantity']) && isset($_SESSION["cart"])) {
                foreach ($_POST['quantity'] as $id => $quantiy) {
                    $_SESSION["cart"][$id] = $quantiy;
                }
            }
            // var_dump($_SESSION['cart']);
            // exit;
            break;
        case "remove":
            $removeid = $_GET["removeId"];
            if (isset($_SESSION["cart"])) {
                unset($_SESSION["cart"][$removeid]);
            }
            break;
        case "submit":
            if (isset($_POST["update"])) {
                if (isset($_POST['quantity']) && isset($_SESSION["cart"])) {
                    foreach ($_POST['quantity'] as $id => $quantiy) {
                        $_SESSION["cart"][$id] = $quantiy;
                    }
                }
            } elseif (isset($_POST["submit"])) {
                // if (isset($_SESSION["cart"])) {
                //     foreach ($_SESSION["cart"] as $id => $quantity) {
                //         $sql = "SELECT * FROM products,categories WHERE product_cat=cat_id and product_id=$id";
                //         $result = $conn->query($sql);
                //         if (!$result) {
                //             trigger_error('Invalid query: ' . $conn->error);
                //         }
                //         if ($result->num_rows > 0) {

                //             while ($row = $result->fetch_row()) {

                //             }
                //         }
                //     }
                // }
                echo $_POST['name'];
                exit;
            } elseif (isset($_POST["delete-all"])) {
                if (isset($_POST['quantity']) && isset($_SESSION["cart"])) {
                    unset($_SESSION["cart"]);
                }
            }
            break;
    }
}

?>

<section class="section">
    <div class="container-fluid">
        <div id="cart_checkout">
            <div class="table-responsive">
                <form id="cart-form" action="cart.php?action=submit" method="POST">
                    <table id="cart" class="table table-hover table-condensed">
                        <thead>
                            <tr>
                                <th style="width:40%">Sản phẩm</th>
                                <th style="width:10%">Hình ảnh</th>
                                <th style="width:10%">Giá</th>
                                <th style="width:8%">Số lượng</th>
                                <th style="width:7%" class="text-center">Tổng</th>
                                <th style="width:10%">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $tong = 0;
                            if (isset($_SESSION["cart"])) {
                                foreach ($_SESSION["cart"] as $id => $quantity) {
                                    // echo $id."=>".$quantity;
                                    $sql = "SELECT * FROM products,categories WHERE product_cat=cat_id and product_id=$id";
                                    $result = $conn->query($sql);
                                    if (!$result) {
                                        trigger_error('Invalid query: ' . $conn->error);
                                    }
                                    if ($result->num_rows > 0) {

                                        while ($row = $result->fetch_row()) {
                                            // $_POST['quantity'][row[0]] = $quantity;
                                            echo "<tr><td>";
                                            echo $row[3];
                                            echo "</td><td>";
                                            echo "<img src='product_images/$row[6]' style='max-height: 80px;' alt=''>";
                                            echo "</td><td>";
                                            echo $row[4];
                                            echo " đ</td><td>";
                                            echo '<input type="text" class="form-control qty" name="quantity[' . $row[0] . ']" value="' . $quantity . '" price=' . $row[4] . '>';
                                            echo "</td><td id='price-cell'>";
                                            echo $quantity * $row[4];
                                            $tong += $quantity * $row[4];
                                            echo " đ</td><td>";
                                            echo '<a href="#" class="btn btn-danger btn-sm remove" remove_id="' . $id . '"><i class="fa fa-trash-o"></i></a>';
                                            echo "</td></tr>";
                                        }
                                    }
                                }
                            }
                            ?>
                        </tbody>

                    </table>
                    <input style="float:right;margin-right: 16px;" type="submit" name="update" form="cart-form" class="btn btn-success" value="Cập nhật" />

                    <?php
                    if(isset($_SESSION['uid'])){
                        $uid = $_SESSION['uid'];
                        $sql = "SELECT * FROM user_info WHERE user_id=$uid";
                            $result = $conn->query($sql);
                            if (!$result) {
                                trigger_error('Invalid query: ' . $conn->error);
                            }
                            if ($result->num_rows > 0) {
    
                                while ($row = $result->fetch_row()) {
                                    $name = $row[1]." ".$row[2];
                                    $email = $row[3];
                                    $mobile = $row[5];
                                    $address = $row[6];
                                }
                            }
                    }
                    ?>

                    <div style="width: 30%;">
                        Người nhận: <input class="form-control" type="text" name="name" value="<?php echo $name?>" required><br>
                        Email: <input class="form-control" type="text" name="email" value="<?php echo $email?>" required><br>
                        Số điện thoại: <input class="form-control" type="text" name="mobile" value="<?php echo $mobile?>" required><br>
                        Địa chỉ: <input class="form-control" type="text" name="address" value="<?php echo $address?>" required><br>
                    </div>
                    <b class="net_total">Thành tiền : <?php echo $tong ?> đ</b>
                    <div>
                        <input style="margin-right: 16px;" type="submit" name="submit" form="cart-form" class="btn btn-success" value="Xác nhận" />
                        <input style="margin-right: 16px" type="submit" name="delete-all" form="cart-form" class="btn btn-danger" value="Xóa giỏ hàng" />
                    </div>
                </form>

            </div>


        </div>
    </div>

</section>

<script>
    $("#reset-cart").click(function() {});
    

    $(".qty").blur(function() {
        var price = $(this).attr("price");
        var quantity = $(this).val();
        var re_price = price * quantity;
        $(this).parent().parent().find("#price-cell").text(re_price + " đ");

        var S = 0;
        var num_of_rows = document.getElementById("cart").rows.length;
        for (var i = 1; i < num_of_rows; i++) {
            var cell = document.getElementById("cart").rows[i].cells;
            S += parseFloat(cell[4].innerHTML.replace(' đ', ''));
        }

        $(".net_total").text("Thành tiền : " + S + " đ");

        // sessionStorage.setItem("cart[]", quantity);
    });
</script>

<?php
// include "newslettter.php";
include "footer.php";
?>