<?php
include 'connect.php';
if (isset($_POST["edit_id"])) {
    $edit_id = $_POST["edit_id"];
}
$sql = "select * from products p, categories c, brands b where p.product_cat=c.cat_id and p.product_brand=b.brand_id and p.product_id=$edit_id";
$result = $conn->query($sql);
// if ($result->num_rows > 0) {
//     while ($row = $result->fetch_row()) {
//     }
// }
$row = $result->fetch_row();
?>
<form id="save" action="product_actions.php?action=edit" method="post">
    <div class="form-group">
        <label for="name">Mã sản phẩm</label>
        <input type="text" class="form-control" name="edit_id" value="<?php echo $row[0]  ?>" readonly>
    </div>
    <div class="form-group">
        <label for="name">Tên sản phẩm</label>
        <input type="text" class="form-control" name="name" value="<?php echo $row[3]  ?>">
    </div>
    <div class="form-group">
        <label for="description">Mô tả sản phẩm</label>
        <input type="text" class="form-control" name="description" value="<?php echo $row[5] ?>">
    </div>
    <div class="form-group">
        <label>Ảnh sản phẩm</label>
        <br>
        <?php
        echo "<img src='../../product_images/$row[6]' alt='' style='width:180px;height:180px;'>";
        ?>
        <br>
        <input type="file" name="img" accept="image/*" id='new_img'>
    </div>


    <div class="form-group">
        <label>Loại</label>
        <select class="form-control" name="category">
            <option selected><?php echo $row[9] ?></option>
            <?php
            $sql1 = "SELECT * FROM CATEGORIES";
            $result1 = $conn->query($sql1);
            if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_row()) {
                    echo "<option value='$row[9]'>";
                    echo $row1[1];
                    echo "</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label>Hãng</label>
        <select class="form-control" name="brand">
            <option selected><?php echo $row[11] ?></option>
            <?php
            $sql1 = "SELECT * FROM BRANDS";
            $result1 = $conn->query($sql1);
            if ($result1->num_rows > 0) {
                while ($row1 = $result1->fetch_row()) {
                    echo "<option>";
                    echo $row1[1];
                    echo "</option>";
                }
            }
            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="price">Giá</label>
        <input type="text" class="form-control" name="price" value="<?php echo $row[4] ?>">
    </div>
    <div class="form-group">
        <label for="keywords">Từ khóa</label>
        <input type="text" class="form-control" name="keywords" value="<?php echo $row[7] ?>">
    </div>
    <button type="submit" class="btn btn-primary" edit_id="<?php echo $row[0] ?>">Lưu</button>
</form>

<script>
    $(document).ready(function() {
        $('#save').submit(function(e) {
            e.preventDefault();

            // if (document.getElementById("new_img").files.length == 0) {
            //     var current_img = $("#current_img").attr("src");
            //     $("#new_img").val(current_img);
            // }

            $.ajax({
                url: 'product_actions.php?action=edit',
                type: 'post',
                data: $('#save').serialize(),
                success: function() {
                    // Whatever you want to do after the form is successfully submitted
                    alert("Đã lưu");
                }
            });
        });
    });
</script>