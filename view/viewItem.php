<?php
include_once("navbar.php");

$productId = $_GET["productId"];

include_once("../model/product_model.php");
$product_obj = new Product($conn);

$prodResult = $product_obj->giveAllDetails_ByProductId($productId);
$prodArray = $prodResult->fetch_assoc();
?>
<!-- content -->
<div class="container-fluid">
    <!--    banner-->
    <div class="row">
        <div class="col-sm-12 text-center p-5" style="background-image:url('../image/background/1-12.webp');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 40px;"><?php echo $prodArray["product_name"]; ?></p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter "><a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="index.php">Home</a> &rarr; Product</p>
        </div>
    </div>
    <!--    banner end -->

    <div class="row mt-3 mb-3">

        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-12">&nbsp;</div>
            </div>
            <form id="addToCartForm" enctype="multipart/form-data" method="POST" action="viewItem.php?productId=<?php echo $productId; ?>">

                <input type="hidden" name="productId" id="productId" value="<?php echo $productId; ?>">

                <div class="row pl-5">

                    <div class="col-md-7 col-lg-6 text-muted h-100">
                        <div class="clearfix">
                            <div class="gallery d-flex justify-content-center">
                                <div class="previews d-none d-sm-inline-block">
                                    <?php
                                    $imgResult = $product_obj->giveImages_ByProductId($productId);
                                    while ($imgArray = $imgResult->fetch_assoc()) {
                                    ?>
                                        <a type="button" class="change d-block" data-full="../image/pro_img/<?php echo $imgArray["img_name"]; ?>">
                                            <img src="../image/pro_img/<?php echo $imgArray["img_name"]; ?>" alt="" style="width: 65px; height: 90px;">
                                        </a>
                                    <?php }
                                    ?>
                                </div>
                                <div class="full">
                                    <!-- first image is viewable to start -->
                                    <?php $imgResult2 = $product_obj->giveImages_ByProductId($productId);
                                    $imgArray2 = $imgResult2->fetch_assoc();
                                    ?>
                                    <img src="../image/pro_img/<?php echo $imgArray2["img_name"]; ?>" class="w-100" style="max-height: 100%;" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-5 col-lg-6 text-muted">
                        <div class="row">
                            <div class="col col-sm-12">
                                <label for="" class="control-label text-uppercase font-weight-bolder">
                                    <h2>
                                        <?php echo $prodArray["product_name"]; ?>
                                    </h2>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <label for="" class="control-label text-uppercase">
                                    <h5>Price </h5>
                                </label>
                            </div>
                            <div class="col-6 col-md-8">
                                <label for="" class="control-label">
                                    <h5 id="setPrice">
                                        <!-- //// Product Sell Price //// -->
                                    </h5>
                                </label>
                                <input type="hidden" name="productPrice" id="productPrice" value="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <label for="" class="control-label text-uppercase"> Brand </label>
                            </div>
                            <div class="col-6 col-md-8">
                                <label for="" class="control-label"> :
                                    <?php echo $prodArray["brand_name"]; ?>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <label for="" class="control-label text-uppercase"> Collection </label>
                            </div>
                            <div class="col-6 col-md-8">
                                <label for="" class="control-label"> :
                                    <?php echo $prodArray["collection_name"]; ?>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <label for="" class="control-label text-uppercase"> Collection Type </label>
                            </div>
                            <div class="col-6 col-md-8">
                                <label for="" class="control-label"> :
                                    <?php echo $prodArray["collection_type_name"]; ?>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <label for="" class="control-label text-uppercase"> Category </label>
                            </div>
                            <div class="col-6 col-md-8">
                                <label for="" class="control-label"> :
                                    <?php echo $prodArray["category_name"]; ?>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6 col-md-4">
                                <label for="" class="control-label text-uppercase"> Size </label>
                            </div>
                            <div class="col-6 col-md-8">
                                <select name="sizeId" id="sizeId" class="form-control w-75">
                                    <option value="">Select Size</option>
                                    <?php
                                    include_once("../model/size_model.php");
                                    $size_obj = new Size($conn);
                                    $getSizes = $size_obj->giveSizes_ByProductId($productId);

                                    while ($sizeArray = $getSizes->fetch_assoc()) {
                                    ?>
                                        <option value="<?php echo $sizeArray["size_id"]; ?>"><?php echo $sizeArray["size_name"]; ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <input type="text" id="stockId" name="stockId">
                                <button type="submit" class="btn button text-white text-uppercase w-50 addToCart" id="addToCart" name="addToCart"> Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>

    </div>

</div>
<!-- content end -->

<script>
    document.title = "BOSARA TEXTILE | View Item";
</script>
<script src="../js/viewItem.js"></script>
<?php
include_once("footer.php");
?>