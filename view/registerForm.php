<?php
include_once("../view/navbar.php");

$email = isset($_GET["email"]) ? $_GET["email"] : "";
$response = isset($_GET["response"]) ? $_GET["response"] : "";
$status = isset($_GET["res_status"]) ? $_GET["res_status"] : "";
?>

<!-- content -->
<div class="container-fluid">
    <!--    banner-->
    <div class="row">
        <div class="col-md-12 text-center p-5" style="background-image:url('../image/background/1-12.webp');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 40px;">Register Form</p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter "><a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="index.php">Home</a> &rarr; <a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="login.php">My Profile</a> &rarr; Register Form</p>
        </div>
    </div>
    <!--    banner end -->

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

    <div class="row mt-3 mb-3">

        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <p class="text-danger">* required fields </p>
                    </div>
                    <form id="addCustomer" enctype="multipart/form-data" method="POST" action="../controller/customer_controller.php?type=addCustomer">
                        <div class="row">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Email</label>
                            </div>
                            <div class="col-sm-6 col-md-4 text-muted">
                                <input type="email" name="email" id="email" class="form-control bg-secondary text-light" value="<?php echo $email; ?>" required readonly>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">First Name <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="text" name="fname" id="fname" class="form-control" required>
                            </div>
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Last Name <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="text" name="lname" id="lname" class="form-control" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Contact Number <i class="text-danger">*</i>
                                </label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">0</span>
                                    </div>
                                    <input type="number" name="contact" id="contact" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">NIC <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted ">
                                <input type="text" name="nic" id="nic" class="form-control" required>
                                <h5 id="user_response" class="text-danger"></h5>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Gender <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadio1" name="gender" class="custom-control-input" value="M">
                                    <label class="custom-control-label" for="customRadio1">Male</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadio2" name="gender" class="custom-control-input" value="F">
                                    <label class="custom-control-label" for="customRadio2">Female</label>
                                </div>
                            </div>
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Postal Code <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="number" name="postalcode" id="postalcode" class="form-control" minlength="5" maxlength="5" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">New password <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <div class="input-group">
                                    <input type="password" name="pw" id="pw" class="form-control" required minlength="6">
                                    <div style="cursor: pointer;" class="input-group-append" id="pw_append">
                                        <span class="input-group-text">
                                            <i id="pw_icon" class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="progress" style="width: 90%;">
                                    <div id="progressBar" class="progress-bar" role="progressbar"></div>
                                </div>
                            </div>
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Confirm Password <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <div class="input-group">
                                    <input type="password" name="cpw" id="cpw" class="form-control" value="" required minlength="6">
                                    <div style="cursor: pointer;" class="input-group-append" id="cpw_append">
                                        <span class="input-group-text">
                                            <i id="cpw_icon" class="fas fa-eye"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Address <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-3 text-muted pr-0 mt-1 mt-sm-0">
                                <input type="text" name="addr1" id="addr1" class="form-control " placeholder="Street Address 01" required>
                            </div>
                            <div class="col-sm-3 text-muted pr-0 mt-1 mt-sm-0">
                                <input type="text" name="addr2" id="addr2" class="form-control " placeholder="Street Address 02" required>
                            </div>
                            <div class="col-sm-3 text-muted pr-0 mt-1 mt-sm-0">
                                <input type="text" name="addr3" id="addr3" class="form-control" placeholder="City" required>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">User Image</label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="file" name="uimg" id="uimg" class="form-control-file" onchange="readURL(this);">
                                <!-- Image Preview -->
                                <div>
                                    <img id="prev_img" alt="">
                                </div>
                                <!-- Preview End -->
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-sm-4 text-muted">
                                <button id="submit" type="submit" class="btn btn-block button text-white text-uppercase"><i class="fad fa-save"></i>&nbsp; &nbsp; Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>

</div>
<script type="text/javascript">
    document.title = "BOSARA TEXTILE | Sign Up";
</script>

<script src="../js/registraionPage.js"></script>

<?php
include_once("../view/footer.php");
?>