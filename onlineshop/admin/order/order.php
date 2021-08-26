<?php
include 'nav.php';
include 'connect.php';

$limit = 10;

if (isset($_GET["page"])) {
    $page = $_GET['page'];
    settype($page, "int");
    $from = ($page - 1) * $limit;
    $sql = "select * FROM orders o, products p WHERE o.product_id=p.product_id LIMIT $from, $limit";
}

// $sql = "select * from products p, categories c, brands b where p.product_cat=c.cat_id and p.product_brand=b.brand_id limit 10";
$result = $conn->query($sql);

?>

<div class="content-wrapper" style="min-height: 1363.2px;">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>DataTables</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">DataTables</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">DataTable with minimal features &amp; hover style</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6"></div>
                                    <div class="col-sm-12 col-md-6"></div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dt-buttons btn-group flex-wrap"> <button class="btn btn-secondary buttons-copy buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>Copy</span></button> <button class="btn btn-secondary buttons-csv buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>CSV</span></button> <button class="btn btn-secondary buttons-excel buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>Excel</span></button> <button class="btn btn-secondary buttons-pdf buttons-html5" tabindex="0" aria-controls="example1" type="button"><span>PDF</span></button> <button class="btn btn-secondary buttons-print" tabindex="0" aria-controls="example1" type="button"><span>Print</span></button>
                                            <div class="btn-group"><button class="btn btn-secondary buttons-collection dropdown-toggle buttons-colvis" tabindex="0" aria-controls="example1" type="button" aria-haspopup="true" aria-expanded="false"><span>Column visibility</span></button></div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="example1_filter" class="dataTables_filter">
                                            <label>Tìm kiếm:
                                                <input id="myInput" type="search" class="form-control form-control-sm" placeholder="" aria-controls="example1" onkeyup="filter()">
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a href="#" class="btn btn-add" data-toggle="modal" data-target="#modal-add">
                                            <i class="fa fa-plus"></i>Thêm mới
                                        </a>
                                        <table id="table-product" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                                            <thead>
                                                <tr role="row">
                                                    <th>Mã đơn hàng</th>
                                                    <th>Sản phẩm</th>
                                                    <th>Số lượng</th>
                                                    <th>Đơn giá</th>
                                                    <th>Chức năng</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($result->num_rows > 0) {
                                                    while ($row = $result->fetch_row()) {
                                                        echo "<tr><td>";
                                                        echo $row[0]; //ma don hang
                                                        echo "</td><td>";
                                                        echo $row[9]; //san pham
                                                        echo "</td><td>";
                                                        echo $row[9]; //so luong
                                                        echo "</td><td>";
                                                        echo $row[4]; //gia
                                                        echo "</td><td>";
                                                        echo '<a class="btn btn-edit" data-toggle="modal" data-target="#modal-edit" id="' . $row[0] . '">
                                                                    <i class="far fa-edit"></i>
                                                              </a>';
                                                        echo '<a class="btn btn-remove" id="' . $row[0] . '">
                                                                 <i class="far fa-trash-alt"></i>
                                                              </a>';
                                                        echo "</td></tr>";
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                            <tfoot>
                                            </tfoot>
                                        </table>

                                        <h4 style="float: right;">Trang: <?php echo $page ?></h4>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 col-md-5">
                                        <div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div>
                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers" id="example2_paginate">
                                            <ul class="pagination">
                                                <?php
                                                include 'connect.php';
                                                $sql = "SELECT count(product_id) FROM products,categories WHERE product_cat=cat_id";
                                                $result = $conn->query($sql);
                                                if ($result->num_rows > 0) {
                                                    $row = $result->fetch_row();
                                                    $total = $row[0];
                                                    $pages = ceil($total / 10);
                                                }

                                                for ($i = 1; $i <= $pages; $i++) {
                                                    // echo "<li><a id='pageno' class='active' href='?page=$i'>$i</a></li>";
                                                    if ($i == $page) {
                                                        echo '<li class="paginate_button page-item active"><a href="?page=' . $i . '" aria-controls="table-product" data-dt-idx="2" tabindex="0" class="page-link">' . $i . '</a></li>';
                                                    } else {
                                                        echo '<li class="paginate_button page-item"><a href="?page=' . $i . '" aria-controls="table-product" data-dt-idx="2" tabindex="0" class="page-link">' . $i . '</a></li>';
                                                    }
                                                }
                                                ?>
                                                <!-- <li class="paginate_button page-item previous" id="example2_previous"><a href="#" aria-controls="table-product" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li> -->
                                                <!-- <li class="paginate_button page-item active"><a href="#" aria-controls="table-product" data-dt-idx="1" tabindex="0" class="page-link">1</a></li> -->
                                                <!-- <li class="paginate_button page-item "><a href="#" aria-controls="table-product" data-dt-idx="2" tabindex="0" class="page-link">2</a></li> -->
                                                <!-- <li class="paginate_button page-item "><a href="#" aria-controls="table-product" data-dt-idx="3" tabindex="0" class="page-link">3</a></li> -->
                                                <!-- <li class="paginate_button page-item "><a href="#" aria-controls="table-product" data-dt-idx="4" tabindex="0" class="page-link">4</a></li> -->
                                                <!-- <li class="paginate_button page-item "><a href="#" aria-controls="table-product" data-dt-idx="5" tabindex="0" class="page-link">5</a></li> -->
                                                <!-- <li class="paginate_button page-item "><a href="#" aria-controls="table-product" data-dt-idx="6" tabindex="0" class="page-link">6</a></li> -->
                                                <li class="paginate_button page-item next" id="example2_next"><a href="?page=<?php echo $page + 1 ?>" aria-controls="table-product" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<div class="modal fade" id="modal-edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thông tin sản phẩm</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="edit_form">

            </div>
            <div class="modal-footer justify-content-right">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                <!-- <button type="button" class="btn btn-primary">Lưu</button> -->
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modal-add">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Thêm sản phẩm</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="add_form">
                <p>One fine body&hellip;</p>
            </div>
            <div class="modal-footer justify-content-right">
                <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

<script>
    function filter() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("myInput");
        filter = input.value.toUpperCase();
        table = document.getElementById("table-product");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            td = tr[i].getElementsByTagName("td")[0];
            if (td) {
                txtValue = td.textContent || td.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }
    $(document).ready(function() {
        $(".btn-remove").click(function() {
            var id = $(this).attr("id");
            $.ajax({
                url: 'product_actions.php?action=remove',
                type: 'get',
                data: {
                    remove_id: id
                },
                success: function() {}
            });
            $(this).parent().parent().remove();
        });
        $(".btn-edit").click(function() {
            var id = $(this).attr("id");

            $.post("edit_product.php", {
                    edit_id: id
                },
                function(data, status) {
                    if (status == "success") {
                        $("#edit_form").html(data);
                    }
                });
        });
        $(".btn-add").click(function() {
            $.post("add_product.php", {},
                function(data, status) {
                    if (status == "success") {
                        $("#add_form").html(data);
                    }
                });
        });

        // $(".page-link").click(function() {
        //     $(this).parent().addClass('active');
        // });
    });
</script>