<?php

include_once("navbar.php");

include_once("../common/redirect.php");
?>

<div class="container-fluid">

    <div class="row mb-3">

        <!-- Top Banner-->
        <div class="col-sm-12 text-center p-5" style="background-image:url('../image/background/1-12.webp');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 40px;">My Profile Dashboard</p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter "><a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="home.php">Home</a> &rarr; My Profile Dashboard</p>
        </div>
        <!-- Top Banner End-->

        <div class="col-sm-12 d-flex flex-column flex-sm-row justify-content-sm-around align-items-center">
            <img id="userImg" src="../image/users/<?php echo $_SESSION["customer"]["userImage"]; ?>" alt="" class="pt-1" style="width: 220px; height:230px;">
            <h1 class="text-muted p-5">
                <?php echo $_SESSION["customer"]["userFname"] . " " . $_SESSION["customer"]["userLname"]; ?>
            </h1>
            <div>
                <a href="editCustomer.php" class="button btn border-0 text-white text-uppercase">
                    <i class="fas fa-user-edit"></i>
                    Edit Info
                </a>
                <a href="changePassword.php" class="btn button btn-warning text-white text-uppercase">
                    <i class="fas fa-key"></i>
                    Edit Password
                </a>
            </div>
        </div>

    </div>

    <div class="row mt-3">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">

                    <!-- Nav Tab Menu -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a id="OrderHistoryNav" class="nav-link text-uppercase active" data-toggle="tab" href="#OrderHistory">Order History</a>
                        </li>
                        <li class="nav-item">
                            <a id="FeedBacksNav" class="nav-link text-uppercase" data-toggle="tab" href="#FeedBacks">FeedBacks</a>
                        </li>
                    </ul>
                    <!-- Tab Menu End -->

                    <!-- Tab Content -->
                    <div class="tab-content pt-2">
                        <!-- View Order Tab -->
                        <div id="OrderHistory" class="container-fluid tab-pane active p-0" style="overflow-x: auto;">
                            <table id="orderTable" class="table table-hover" style="min-width: 900px;">
                                <thead>
                                    <tr>
                                        <th># Invoice NO</th>
                                        <th>Date</th>
                                        <th>Status</th>
                                        <th>Option</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include_once("../model/order_model.php");
                                    $order_obj = new Order($conn);

                                    $getOrders = $order_obj->giveOrders_ByCusId($_SESSION["customer"]["userId"]);

                                    while ($row = $getOrders->fetch_assoc()) {

                                        $invoiceId = $row["invoice_invoiceId"];

                                        include_once("../model/invoice_model.php");
                                        $invoice_obj = new Invoice($conn);

                                        $getInvoice = $invoice_obj->giveInvoice_ByInvoiceId($invoiceId);
                                        $invoiceArray = $getInvoice->fetch_assoc();

                                        include_once("../model/feedback_model.php");
                                        $feedback_obj = new Feedback($conn);

                                        $getFeedback = $feedback_obj->giveFeedback_ByInvoiceId($invoiceId);
                                    ?>
                                        <tr>
                                            <td><?php echo $invoiceArray["invoice_number"]; ?></td>
                                            <td><?php echo $row["order_date"]; ?></td>
                                            <td>
                                                <?php if ($row["order_status"] == 1) {
                                                    echo "<span class='text-muted'><i class='fas fa-check-square'></i> Order Placed</span>";
                                                } else if ($row["order_status"] == 2) {
                                                    echo "<span class='text-warning'><i class='fas fa-hourglass-start'></i> Processing</span>";
                                                } else if ($row["order_status"] == 3) {
                                                    echo "<span class='text-info'><i class='fas fa-dolly-flatbed-alt'></i> Order Ready To Delivery</span>";
                                                } else if ($row["order_status"] == 4) {
                                                    echo "<span class='text-secondary'><i class='fas fa-shipping-fast'></i> Order On the Way</span>";
                                                } else if ($row["order_status"] == 5) {
                                                    echo "<span class='text-success'><i class='fas fa-shield-check'></i> Order Delivered</span>";
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <span data-toggle="tooltip" title="Details">
                                                    <button type="button" class="btn btn-info viewOrderDetailsBtn" data-toggle="modal" data-target="#moreDetailsModal" value="<?php echo $row["invoice_invoiceId"]; ?>">
                                                        <i class="fas fa-info-circle"></i>
                                                    </button>
                                                </span>

                                                <?php if ($row["order_status"] == 5 && $getFeedback->num_rows < 1) { ?>
                                                    <span data-toggle="tooltip" title="Feedback">
                                                        <button type="button" class="btn btn-secondary viewFeedbackBtn" data-toggle="modal" value="<?php echo $row["invoice_invoiceId"]; ?>">
                                                            <i class="fas fa-comment-lines"></i>
                                                        </button>
                                                    </span>
                                                <?php } ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- View Order Tab End -->

                        <!-- Feedback Tab -->
                        <div id="FeedBacks" class="container-fluid tab-pane p-0" style="overflow-x: auto;">
                            <table id="feedbackTable" class="table table-hover table-bordered" style="min-width: 900px;">
                                <thead>
                                    <tr>
                                        <th># Invoice NO</th>
                                        <th>Feedback</th>
                                        <th>Rate</th>
                                        <th>Date / Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    include_once("../model/feedback_model.php");
                                    $feedback_obj = new Feedback($conn);

                                    $getFeedbacks = $feedback_obj->giveFeedback_ByCustomerId($_SESSION["customer"]["userId"]);

                                    while ($feedback_array = $getFeedbacks->fetch_assoc()) { ?>

                                        <tr>
                                            <td><?php echo $feedback_array["invoice_number"];
                                                ?></td>
                                            <td><?php echo $feedback_array["feedback_content"]; ?></td>
                                            <td style="width: 40%;">
                                                <div class="star-widget float-left pb-3">
                                                    <input type="radio" name="rate" class="inputs d-none" value="5" <?php if ($feedback_array["feedback_starcount"] == 5) { ?> checked <?php } ?>>
                                                    <label for="rate-5" class="fas fa-star p-0 pr-3"></label>
                                                    <input type="radio" name="rate" class="inputs d-none" value="4" <?php if ($feedback_array["feedback_starcount"] == 4) { ?> checked <?php } ?>>
                                                    <label for="rate-4" class="fas fa-star p-0 pr-3"></label>
                                                    <input type="radio" name="rate" class="inputs d-none" value="3" <?php if ($feedback_array["feedback_starcount"] == 3) { ?> checked <?php } ?>>
                                                    <label for="rate-3" class="fas fa-star p-0 pr-3"></label>
                                                    <input type="radio" name="rate" class="inputs d-none" value="2" <?php if ($feedback_array["feedback_starcount"] == 2) { ?> checked <?php } ?>>
                                                    <label for="rate-2" class="fas fa-star p-0 pr-3"></label>
                                                    <input type="radio" name="rate" class="inputs d-none" value="1" <?php if ($feedback_array["feedback_starcount"] == 1) { ?> checked <?php } ?>>
                                                    <label for="rate-1" class="fas fa-star p-0 pr-3"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <?php echo $feedback_array["feedback_time"]; ?>
                                            </td>
                                        </tr>

                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Feedback Tab End -->

                </div>
                <!-- Tab Content End -->
            </div>
        </div>
    </div>
</div>
<!-- content end -->

<!-- ////////////////// Modals Start //////////////////// -->

<!-- Order Details  Modal -->
<div class="modal fade" id="moreDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle1" aria-hidden="true" style="overflow-x: scroll; max-width:100vw;">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #db9200">
                <h5 class="modal-title text-light text-uppercase" id="exampleModalLongTitle1"><i class="fal fa-shipping-fast"></i> &nbsp; View Ordered Details</h5>
                <button type="button" class="close a" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-muted">
                <div id="viewOrderDetails">
                    <!-- //////////// Order Details Embed Here (Via AJAX) //////////// -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Order Details Modal End -->

<!-- Feedback Modal -->
<div class="modal fade" id="feedBackModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header" style="background-color: #db9200">
                <h5 class="modal-title text-light text-uppercase" id="exampleModalLongTitle1"><i class="fal fa-comment-lines"></i> &nbsp; feedback</h5>
                <button type="button" class="close a" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-muted">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <form id="feedbackForm">
                                    <div id="sendFeedback" class="container-fluid">
                                        <input type="hidden" id="invoiceId" name="invoiceId" value="">
                                        <div class="star-widget float-left pb-3">
                                            <input type="radio" name="rate" id="rate-5" class="inputs d-none" value="5">
                                            <label for="rate-5" class="fas fa-star p-0 pr-3"></label>
                                            <input type="radio" name="rate" id="rate-4" class="inputs d-none" value="4">
                                            <label for="rate-4" class="fas fa-star p-0 pr-3"></label>
                                            <input type="radio" name="rate" id="rate-3" class="inputs d-none" value="3">
                                            <label for="rate-3" class="fas fa-star p-0 pr-3"></label>
                                            <input type="radio" name="rate" id="rate-2" class="inputs d-none" value="2">
                                            <label for="rate-2" class="fas fa-star p-0 pr-3"></label>
                                            <input type="radio" name="rate" id="rate-1" class="inputs d-none" value="1">
                                            <label for="rate-1" class="fas fa-star p-0 pr-3"></label>
                                        </div>
                                        <textarea name="comment" id="dis" class="form-control" style="height: 8em" placeholder="Comment" required></textarea>
                                        <br>
                                        <button type="button" id="feedbackButton" class="btn button text-white text-uppercase float-right">post</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Feedback Modal End -->

<script>
    document.title = "BOSARA TEXTILE | Profile";
</script>
<script src="../js/dashboard.js"></script>
<?php
include_once("footer.php");
?>