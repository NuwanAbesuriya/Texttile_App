<?php

include_once("../view/navbar.php");

$response = isset($_GET["response"]) ? $_GET["response"] : "";
$status = isset($_GET["res_status"]) ? $_GET["res_status"] : "";
$email = isset($_SESSION["otp"]) ? $_SESSION["otp"]["email"] : "";
?>
<!-- content -->
<div class="container-fluid">

    <!-- /////////////////// Top Banner ///////////////////// -->
    <div class="row">
        <div class="col-md-12 text-center p-5" style="background-image:url('../image/background/1-12.webp');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 7.5vw;">My Profile</p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter ">
                <a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="home.php">Home</a> &rarr; My Profile
            </p>
        </div>
    </div>
    <!-- ///////////////////// Banner End /////////////////////// -->



    <!-- //////////////// Response Alert //////////////////// -->
    <div class="row mt-3">
        <div class="col-sm-8 mx-auto text-center">
            <?php if ($status == "1") { ?>
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 style="color: green;"><?php echo $response; ?></h3>
                </div>
            <?php } else if ($status == "0") { ?>
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h3 style="color: red;"><?php echo $response; ?></h3>
                </div>
            <?php } ?>
        </div>
    </div>
    <!-- //////////////// Response Alert End //////////////////// -->

    <div class="row mt-3">
        <!-- login -->
        <div class="col-sm-6 text-muted p-5">

            <p class="font-weight-lighter text-uppercase" style="font-family: montserrat,serif; font-size: xx-large"><i class="fas fa-key" style="transform: scaleX(-1);"></i> LOGIN</p>

            <form id="newCustomer" enctype="multipart/form-data" method="POST" action="../controller/login_controller.php?type=login">
                <label class="control-label">Username <span class="text-danger"> *</span></label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email" value="<?php echo $email; ?>" required>
                <br>
                <label class="control-label">Password <span class="text-danger"> *</span></label>
                <div class="input-group">
                    <input type="password" id="pw" class="form-control" name="pw" placeholder="Password" required>
                    <div style="cursor: pointer;" class="input-group-append" id="pw_append">
                        <span class="input-group-text">
                            <i id="pw_icon" class="fas fa-eye"></i>
                        </span>
                    </div>
                </div>
                <button class="btn button text-white text-uppercase mt-3">Login</button>&nbsp; | &nbsp;
                <a href="passwordReset.php" class="text-uppercase text-decoration-none">Lost My Password</a>
            </form>

        </div>
        <!-- login end -->

        <!-- register -->
        <div class="col-sm-6 text-muted p-5" style="border-left: outset;">
            <p class="font-weight-lighter text-uppercase" style=" font-family: montserrat,serif; font-size: xx-large"><i class="fas fa-clipboard-user"></i> REGISTER</p>

            <form enctype="multipart/form-data" method="POST" action="../controller/login_controller.php?type=sendOTP">
                <label class="control-label">Username <span class="text-danger"> *</span></label>
                <input type="email" class="form-control" name="email" id="nemail" placeholder="Email" required>
                <h5 class="text-danger" id="email_response"></h5>
                <br>
                <p>A Temporary password will be sent to your email address.</p>
                <p class="text-justify">Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our privacy policy.</p>
                <button type="submit" class="btn button text-white text-uppercase" id="registerBtn">REGISTER</button>
            </form>

        </div>
        <!-- register end -->
    </div>
</div>
<!-- content end -->

<script>
    document.title = "BOSARA TEXTILE | Login";
</script>
<script src="../js/loginPage.js"></script>

<?php
include_once("../view/footer.php");
?>