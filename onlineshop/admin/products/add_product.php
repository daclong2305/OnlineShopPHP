<?php
include 'connect.php';
?>

<form id="add" action="product_actions.php?action=add" method="post">
    <!-- <div class="form-group">
        <label for="name">Mã sản phẩm</label>
        <input type="text" class="form-control" name="edit_id" value="" disabled>
    </div> -->
    <div class="form-group">
        <label for="name">Tên sản phẩm</label>
        <input type="text" class="form-control" name="name" value="" required>
    </div>
    <div class="form-group">
        <label for="description">Mô tả sản phẩm</label>
        <input type="text" class="form-control" name="description" value="" required>
    </div>

    <div class="form-group">
        <label for="image">Chọn ảnh:</label>
        <input type="file" name="image" id="image" accept="image/*">
    </div>

    <div class="form-group">
        <label>Loại</label>
        <select class="form-control" name="category">
            <?php
            $sql1 = "SELECT * FROM CATEGORIES";
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
        <label>Hãng</label>
        <select class="form-control" name="brand">
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
        <input type="text" class="form-control" name="price" value="" required>
    </div>
    <div class="form-group">
        <label for="keywords">Từ khóa</label>
        <input type="text" class="form-control" name="keywords" value="" required>
    </div>
    <button type="submit" class="btn btn-primary">Thêm</button>
</form>

<script>
    $(document).ready(function() {
        // $('#add').submit(function(e) {
        //     e.preventDefault();

        //     $.ajax({
        //         url: 'product_actions.php?action=add',
        //         type: 'post',
        //         data: $("#add").serialize(),
        //         success: function() {
        //             // Whatever you want to do after the form is successfully submitted
        //             alert("Đã thêm");

        //         }
        //     });
        // });

    });
</script>