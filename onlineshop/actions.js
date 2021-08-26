$(document).ready(function() {
    $("#filter").click(function() {
        var max = $("#price-max").val();
        var min = $("#price-min").val();

        $.ajax({
            url: "get_products.php",
            method: "POST",
            data: { min: min, max: max },
            success: function(data) {
                $("#get_product").html(data);
                if ($("body").width() < 480) {
                    $("body").scrollTop(683);
                }
            }
        });
    });

    $(".input-select").change(function() {
        var value = $(this).val();
        $.ajax({
            url: "get_products.php",
            method: "POST",
            data: { orderby: value },
            success: function(data) {
                $("#get_product").html(data);
                if ($("body").width() < 480) {
                    $("body").scrollTop(683);
                }
            }
        });
    });

    $("body").delegate(".selectBrand", "click", function(event) {
        // event.preventDefault();
        $("#get_product").html("<h3>Loading...</h3>");
        var bid = $(this).attr('bid');
        $.ajax({
            url: "get_products.php",
            method: "POST",
            data: { selectBrand: 1, brand_id: bid },
            success: function(data) {
                $("#get_product").html(data);
                if ($("body").width() < 480) {
                    $("body").scrollTop(683);
                }
            }
        });
    });

    $('#btn-login').click(function() {
        // var email = $('#email').val();
        // var password = $('#password').val();

        // $.ajax({
        //     url: "index.php",
        //     method: "POST",
        //     data: { email: email, password: password }
        // });
    });

    $("#login").on("submit", function(event) {
        // event.preventDefault();
        $(".overlay").show();
        var email = $('#email').val();
        var password = $('#password').val();
        $.ajax({
            url: "login.php",
            method: "POST",
            data: { email: email, password: password },
            success: function(data) {
                // if (data == "login_success") {
                //     window.location.href = "index.php";
                // } else if (data == "cart_login") {
                //     window.location.href = "cart.php";
                // } else {
                //     $("#e_msg").html(data);
                //     $(".overlay").hide();
                // }
                window.location.href = "index.php";
            }
        })
    })

    $(".add-to-cart-btn").click(function() {
        var pid = $(this).attr("pid");
        var sl = 1;
        $.ajax({
            url: "index.php",
            method: "GET",
            data: { pid: pid, sl: sl },
            success: function(data) {}
        });
    });

    $(".remove").click(function() {
        var id = $(this).attr("remove_id");
        $.ajax({
            url: 'cart.php?action=remove',
            type: 'get',
            data: { removeId: id },
            success: function() {
                //whatever you wanna do after the form is successfully submitted
            }
        });
        $(this).parent().parent().remove();
    });

    $(".dropdown").click(function() {
        $("#cart_product").load('./cart_product.php');
    });

    $("#product").click(function() {

        var count = $("#cart-count").text();
        var re_count = parseFloat(count) + 1;
        $("#cart-count").text(re_count);
    });

    $('#add-to-cart-form').submit(function(e) {
        e.preventDefault();
        $.ajax({
            url: 'cart.php?action=add',
            type: 'post',
            data: $('#add-to-cart-form').serialize(),
            success: function() {
                //whatever you wanna do after the form is successfully submitted

                var text = "<div class='alert alert-success'>" +
                    "<a href='#' class='close' data-dismiss='alert' aria-label='close'>×</a>" +
                    "<b>Thêm thành công!</b>" +
                    "</div>";
                $("#product-detail").prepend(text);
            }
        });
    });


});