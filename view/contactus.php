<?php
include_once("../view/navbar.php");

$response = isset($_GET["response"]) ? $_GET["response"] : "";
$status = isset($_GET["res_status"]) ? $_GET["res_status"] : "";
?>
<!-- Top Content -->
<div class="container-fluid">
    <!-- Top Banner-->
    <div class="row">
        <div class="col-sm-12 text-center p-5" style="background-image:url('../image/background/1-12.webp');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 40px;">Contact Us</p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter ">
                <a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="home.php">Home</a> &rarr; Contact Us
            </p>
        </div>
    </div>
    <!-- Top Banner End -->

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

    <!-- Contact Info Row -->
    <div class="row mt-3">
        <div class="col-sm-6 col-md-3 text-center h-100">
            <br>
            <h3 style="color: #db9200"><i class="fad fa-map-marker-alt"></i></h3>
            <br>
            <h3>OUR ADDRESS</h3>
            <p>
                Katugastota,<br>
                Kandy.<br>
                Sri lanka
            </p>
        </div>
        <div class="col-sm-6 col-md-3 text-center" style="height: 100%">
            <br>
            <h3 style="color: #db9200"><i class="fad fa-phone-alt"></i></h3>
            <br>
            <h3>OUR PHONES</h3>
            <p>
                +94 111 111 111<br>
                +94 111 111 111
            </p>
        </div>
        <div class="col-sm-6 col-md-3 text-center" style="height: 100%">
            <br>
            <h3 style="color: #db9200"><i class="fad fa-clock"></i></i></h3>
            <br>
            <h3>WORKING HOURS</h3>
            <p>
                Monday - Friday : 9:00 - 22:00<br>
                Saturday : 11:00 - 20:00<br>
                Sunday : 11:00 - 17:00
            </p>
        </div>
        <div class="col-sm-6 col-md-3 text-center" style="height: 100%">
            <br>
            <h3 style="color: #db9200"><i class="fad fa-envelope"></i></h3>
            <br>
            <h3>EMAIL ADDRESS</h3>
            <p>
                bosaratextile@gmail.com<br>
                
            </p>
        </div>
    </div>
    <!-- Contact Info Row -->

   
</div>
<!-- Top Content End -->

<!-- Bottom Content -->
<div class="container">
    <!-- Send us Form Start -->
    <div class="row mt-3">
        <div class="col-md-6">
            <h1 class="text-uppercase text-center">SEND US AN EMAIL</h1>
            <p class="text-uppercase text-center">Get in contact with us by filling out our contact form</p>
            <div>
                <form enctype="multipart/form-data" method="POST" action="../controller/faq_controller.php?type=addFAQ">
                    <div class="row">
                        <div class="col-lg-6">
                            <input type="text" class="form-control" value="" placeholder="Name*" id="cusName" name="cusName" required>
                        </div>
                        <div class="col-lg-6 mt-2 mt-lg-0">
                            <input type="email" class="form-control" value="" placeholder="Email*" id="cusEmail" name="cusEmail" required>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <textarea class="form-control" rows="10" placeholder="Type message.." name="msg" required></textarea>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <button type="submit" class="button btn btn-block border-0 text-white text-uppercase">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-6 mt-3">
            <img src="../image/background/contact_us1.jpg" class="h-100 w-100 rounded" alt="">
        </div>
    </div>

    <div>&nbsp;</div>
</div>
<!-- Bottom Content End -->

<script>
    document.title = "BOSARA TEXTILE | Contact Us";
</script>

<?php
include_once("../view/footer.php");
?>