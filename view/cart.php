<?php
include_once("navbar.php");
?>
<!-- content -->
<div class="container-fluid">
    <!--    banner-->
    <div class="row">
        <div class="col-md-12 text-center p-5" style="background-image:url('../image/background/1-12.webp');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 40px;">My Cart</p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter "><a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="home.php">Home</a> &rarr; My Cart</p>
        </div>
    </div>
    <!--    banner end -->

    <div class="row">

        <!-- ////////// cart Content Start //////////// -->
        <div class="col-sm-12 text-muted p-3">
            <form enctype="multipart/form-data" method="POST" action="payment.php">

                <?php
                if (!empty($_SESSION['cart'])) {
                ?>
                    <!-- // Cart Table // -->
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th class="text-left text-muted text-uppercase">Product</th>
                                <th class="text-center text-muted text-uppercase">Price</th>
                                <th class="text-center text-muted text-uppercase">Quantity</th>
                                <th class="text-center text-muted text-uppercase">SubTotal</th>
                                <th class="text-center text-danger text-uppercase  font-weight-bold ">&cross;</th>
                            </tr>
                        </thead>

                        <tbody id="invoice">
                            <?php

                            include_once("../model/product_model.php");
                            $product_obj = new Product($conn);

                            $total = 0;

                            foreach ($_SESSION["cart"] as $key => $value) {

                                $prodInfo = $product_obj->giveProduct_ByProductId($value["productId"]);
                                $infoArray = $prodInfo->fetch_assoc();

                                $prodImage = $product_obj->giveImages_ByProductId($value["productId"]);
                                $imgArray = $prodImage->fetch_assoc();

                                include_once("../model/size_model.php");
                                $size_obj = new Size($conn);

                                $sizeInfo = $size_obj->giveSize_BySizeId($value["sizeId"]);
                                $sizeArray = $sizeInfo->fetch_assoc();
                            ?>

                                <tr>
                                    <td class="text-left text-muted text-uppercase font-weight-bold">
                                        <img src="../image/pro_img/<?php echo $imgArray["img_name"]; ?>" style="width: 100px; height:130px;">
                                        <?php echo $infoArray["product_name"] . " || Size : " . $sizeArray["size_name"]; ?>
                                    </td>
                                    <td class="pt-5">
                                        <input type="text" class="text-center text-muted form-control-plaintext" value="<?php echo sprintf("%.2f", $value['productPrice']); ?>" readonly>
                                    </td>
                                    <td class="pt-5">
                                        <div class="input-group mb-3">
                                            <div class="input-group-prepend" style="cursor: pointer;">
                                                <span class="input-group-text increaseProd">
                                                    <i class="fas fa-plus"></i>
                                                </span>
                                            </div>
                                            <input type="text" class="form-control text-muted text-center prodQty" value="<?php echo $value['productQty']; ?>" readonly style="width: 60px;">
                                            <div class="input-group-append" style="cursor: pointer;">
                                                <span class="input-group-text decreaseProd">
                                                    <i class="fas fa-minus"></i>
                                                </span>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="pt-5">
                                        <input type="text" class="text-center text-muted form-control-plaintext" value="<?php echo sprintf("%.2f", $value['productSubTotal']); ?>" readonly>
                                    </td>
                                    <td class="pt-5">
                                        <span class="remove">
                                            <i class="fas fa-times text-danger"></i>
                                        </span>
                                    </td>

                                    <input type="hidden" class="itemId" value="<?php echo $value['itemId']; ?>">
                                </tr>

                            <?php
                                $total = $total + $value['productSubTotal'];
                            } ?>
                        </tbody>
                    </table>
                    <!-- // cart table end // -->

                    <!-- // cart footer // -->
                    <div class="row">

                        <div class="col-md-6">
                            <div class="row p-3">
                                <div class="col-sm-6">
                                    <input type="text" class="form-control w-100" placeholder="Coupon code">
                                </div>
                                <div class="col-sm-6">
                                    <button class="btn button text-white text-uppercase w-75" type="button">Apply coupon</button>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <table class="table table-responsive-* table-bordered">
                                <tbody>
                                    <tr>
                                        <td class="text-muted text-uppercase w-50 pt-2">total (rs)</td>
                                        <td>
                                            <input type="text" class="form-control-plaintext text-left text-muted text-uppercase w-50" name="productTotal" readonly id="total" value="<?php echo sprintf("%.2f", $total); ?>" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted text-uppercase">Delivery Fee (rs)</td>
                                        <td>
                                            <input type="text" class="form-control-plaintext text-left text-muted text-uppercase w-50" readonly id="shipping" value="200.00" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="text-muted text-uppercase">Payable amount (rs)</td>
                                        <td>
                                            <input type="text" class="form-control-plaintext a  text-left text-muted text-uppercase w-50" name="productPayableAmt" readonly id="payableAmt" value="<?php echo sprintf("%.2f", ($total + 200)); ?>" />
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 ml-auto">
                            <button class="btn button text-white text-uppercase btn-block" name="checkout">
                                <i class="far fa-check-circle"></i> &nbsp;Proceed to checkout</button>
                        </div>
                    </div>
                    <!-- // cart footer end // -->
                <?php
                } else {
                ?>
                    <div class="text-center font-weight-bold p-5" style="height: 40vh;">
                        <h1>Your Cart is Empty...........!!! <i class="fas fa-smile-beam"></i></h1>
                    </div>
                <?php
                }
                ?>
            </form>
        </div>
        <!-- ////////////// Cart Content End /////////// -->

    </div>
</div>
<!-- content end -->
<script>
    document.title = "BOSARA TEXTILE | My Cart";
</script>
<script src="../js/cartPage.js"></script>
<?php
include_once("footer.php");
?>