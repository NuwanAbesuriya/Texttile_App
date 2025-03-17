<?php

include_once("navbar.php");

include_once("../common/redirect.php");

$response = isset($_GET["response"]) ? $_GET["response"] : "";
$status = isset($_GET["res_status"]) ? $_GET["res_status"] : "";

include_once("../model/customer_model.php");
$cus_obj = new Customer($conn);

$cusId = $_SESSION["customer"]["userId"];

$result = $cus_obj->giveCustomerInfo_ByCusIdFromCustomer($cusId);
$row = $result->fetch_assoc();
?>

<div class="container-fluid">
    <!--  Top  Banner-->
    <div class="row mt-3">
        <div class="col-sm-12 text-center p-5" style="background-image:url('../image/background/1-12.webp');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 40px;">Edit Profile</p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter "><a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="home.php">Home</a> &rarr; <a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="dashboard.php">My Profile</a> &rarr; Edit Profile</p>
        </div>
    </div>
    <!--  Top  Banner end -->

    <!-- Response Alert -->
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
    <!-- Response Alert End -->

    <div class="row mt-3 mb-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div>
                        <p class="text-danger">* required fields </p>
                    </div>
                    <form id="editCustomer" enctype="multipart/form-data" method="post" action="../controller/customer_controller.php?type=editCustomer">
                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">First Name <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="text" name="fname" id="fname" class="form-control" value="<?php echo $row["customer_fname"]; ?>" required>
                            </div>
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Last Name <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="text" name="lname" id="lname" class="form-control" value="<?php echo $row["customer_lname"]; ?>" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Contact Number <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">0</span>
                                    </div>
                                    <input type="number" name="contact" id="contact" class="form-control" value="<?php echo substr($row["customer_cno"], 1, 9); ?>" required>
                                </div>
                            </div>
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">NIC <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted ">
                                <input type="text" name="nic" id="nic" class="form-control" value="<?php echo $row["customer_nic"]; ?>" readonly>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Gender <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadio1" name="gender" class="custom-control-input" <?php if ($row["customer_gender"] == "M") { ?> checked <?php } ?> value="M">
                                    <label class="custom-control-label" for="customRadio1">Male</label>
                                </div>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="customRadio2" name="gender" class="custom-control-input" <?php if ($row["customer_gender"] == "F") { ?> checked <?php } ?> value="F">
                                    <label class="custom-control-label" for="customRadio2">Female</label>
                                </div>
                            </div>
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Postal Code <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="number" name="postalcode" id="postalcode" class="form-control" minlength="5" maxlength="5" value="<?php echo $row["customer_postal_id"]; ?>" required>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Address <i class="text-danger">*</i></label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="text" name="addr1" id="addr1" class="form-control " placeholder="Street Address 01" value="<?php echo $row["customer_addr1"]; ?>" required>
                                <br>
                                <input type="text" name="addr2" id="addr2" class="form-control " placeholder="Street Address 02" value="<?php echo $row["customer_addr2"]; ?>" required>
                                <br>
                                <input type="text" name="addr3" id="addr3" class="form-control" placeholder="City" value="<?php echo $row["customer_addr3"]; ?>" required>
                            </div>
                            <div class="col-sm-2 text-muted">
                                <label for="" class="control-label">Profile Image</label>
                            </div>
                            <div class="col-sm-4 text-muted">
                                <input type="file" name="uimg" id="uimg" onchange="readURL(this);">
                                <br><br>
                                <img id="prev_img" src="../image/users/<?php echo $row["customer_img"]; ?>" width="100px" height="100px">
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-sm-4 ml-auto text-muted">
                                <button type="submit" class="btn btn-block button text-white text-uppercase"><i class="fad fa-save"></i>&nbsp; &nbsp; Save</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- content end -->
<script>
    document.title = "BOSARA TEXTILE | Edit Profile";
</script>
<script src="../js/editCustomer.js"></script>

<?php
include_once("footer.php");
?>