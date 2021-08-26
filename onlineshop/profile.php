<?php
include 'header.php';
?>


<style>
    .input-borders {
        border-radius: 30px;
    }

    .container-fluid {
        width: 60%;
    }
</style>
<!-- row -->

<div class="sidebar">
  <a href="#home"><i class="fa fa-fw fa-home"></i> Home</a>
  <a href="#services"><i class="fa fa-fw fa-wrench"></i> Services</a>
  <a href="#clients"><i class="fa fa-fw fa-user"></i> Clients</a>
  <a href="#contact"><i class="fa fa-fw fa-envelope"></i> Contact</a>
</div>

<div class="container-fluid">
    <!-- /Billing Details -->

    <form id="signup_form" onsubmit="return false" class="login100-form">
            <h3 class="login100-form-title p-b-49">Thông tin</h3>
        <div class="billing-details jumbotron">
            <div class="form-group ">
                <input class="input form-control input-borders" type="text" name="f_name" id="f_name" placeholder="First Name">
            </div>
            <div class="form-group">

                <input class="input form-control input-borders" type="text" name="l_name" id="l_name" placeholder="Last Name">
            </div>
            <div class="form-group">
                <input class="input form-control input-borders" type="email" name="email" placeholder="Email">
            </div>
            <!-- <div class="form-group">
                <input class="input form-control input-borders" type="password" name="password" id="password" placeholder="password">
            </div>
            <div class="form-group">
                <input class="input form-control input-borders" type="password" name="repassword" id="repassword" placeholder="confirm password">
            </div> -->
            <div class="form-group">
                <input class="input form-control input-borders" type="text" name="mobile" id="mobile" placeholder="mobile">
            </div>
            <div class="form-group">
                <input class="input form-control input-borders" type="text" name="address1" id="address1" placeholder="Address">
            </div>
            <div class="form-group">
                <input class="input form-control input-borders" type="text" name="address2" id="address2" placeholder="City">
            </div>


            <div class="form-group">
                <input class="primary-btn btn-block" value="Sign Up" type="submit" name="signup_button">
            </div>
            <div class="text-pad">
                <a href="" data-toggle="modal" data-target="#Modal_login">Already have an Account ? then login</a>

            </div>

        </div>
    </form>
    <div class="login-marg">
        <!-- Billing Details -->
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8" id="signup_msg">


            </div>
            <!--Alert from signup form-->
        </div>
        <div class="col-md-2"></div>
    </div>
</div>
<!-- /row -->

<?php
include "newslettter.php";
include "footer.php";
?>