<?php
include_once("navbar.php");
?>
<!-- image carousel-->
<div class="container-fluid">

    <?php
    $response = isset($_GET["response"]) ? $_GET["response"] : "";

    if ($response != "") {
    ?>
        <script>
            Swal.fire("Thank You !!!", "<?php echo $response; ?>", "success");
        </script>
    <?php
    }
    ?>

    <div class="row">
        <div class="col-sm-12 p-0">
            <!-- carousel code -->
            <div id="carouselExampleIndicators" class="carousel slide d-none d-md-block" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div class="carousel-inner" style="height: 100vh" role="listbox">
                    <!-- first slide -->
                    <div class="carousel-item  active">
                        <img src="../image/slider/splash_shop_3_slide_1-1.jpg" alt="Los Angeles" class="w-100 zoomOut">
                        <div class="carousel-caption d-md-block text-dark text-left p-0">
                            <h1 class="mb-md-5 animate__animated animate__bounceIn" style="font-size: 8vw;">
                                THE <strong>FASHION </strong>
                            </h1>
                            <p class="text-justify w-50 animate__animated animate__bounceInRight">
                                Fashion is something we deal with everyday. Even people who say
                                they don’t care what they wear choose clothes every morning
                                that say a lot about them and how they feel that day.
                            </p>
                            <br>
                            <a class="button btn btn-md text-white text-uppercase animate__animated animate__bounceInLeft">Shop Here</a>
                        </div>
                    </div>
                    <!-- second slide -->
                    <div class="carousel-item">
                        <img src="../image/slider/splash_shop_3_slide_2.jpg" alt="Los Angeles" class="w-100 zoomIn">
                        <div class="carousel-caption d-md-block text-right p-0">
                            <h1 class="animate__animated animate__bounceIn" style="font-size: 8vw;">
                                AWESOME <br><strong>DESIGNS </strong>
                            </h1>
                            <p class="text-justify ml-auto w-50 animate__animated animate__bounceInLeft">
                                Fashion is something we deal with everyday. Even people who say
                                they don’t care what they wear choose clothes every morning that
                                say a lot about them and how they feel that day.
                            </p><br>
                            <a class=" button btn btn-lg border-0 text-white text-uppercase animate__animated animate__zoomInRight">Shop Now</a>
                        </div>
                    </div>
                    <!-- third slide -->
                    <div class="carousel-item">
                        <img src="../image/slider/splash_shop_3_slide_1-1.jpg" alt="Los Angeles" class="w-100 zoomIn">
                        <div class="carousel-caption d-md-block text-center text-dark">
                            <h1 data-animation="animated zoomInLeft" style="font-size: 8vw;">
                                <strong>SELL</strong> ANYTHING
                            </h1>
                            <p class="text-center m-auto w-75" data-animation="animated flipInX">
                                Shopping from home is addictively satisfying and almost dangerously easy. Just a few clicks, some taps on the keyboard, and you have yourself a brand new wardrobe. You basically never need to step foot inside a real store again. Women’s clothing stores come to you instead.
                            </p><br>
                            <a href="" class=" button btn btn-lg border-0 text-white text-uppercase" data-animation="animated lightSpeedIn">Shop Now</a>
                        </div>
                    </div>
                </div>
                <!-- controls -->
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</div>
<!-- image carousel end -->

<!-- content -->
<div class="container-fluid">
    <!--    banner-->
    <div class="row">
        <div class="col-sm-12 text-center p-5" style="background-image:url('../image/background/1-12.webp');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style="font-size: 40px;">
                <strong class="font-weight-bold">Free Shipping </strong>For Order Over Rs 25000
            </p>
        </div>
    </div>
    <!--    banner end -->
    <!--    collection-->
    <div class="row" id="collection">
        <div class="col-sm-6 p-0">
            <div class="card border">
                <div class="card-body" style="background-image: url('../image/background/Men.png'); height:350px; background-position: right;background-repeat: no-repeat;background-size: contain">
                    <h5 class="card-title text-uppercase pt-5 pl-5 font-weight-lighter" style="font-size: 40px;"><strong>Men</strong> Collection</h5>
                    <p class="card-text text-uppercase pt-0 pl-5">select your favorite fashion </p>
                    <a href="productFilter.php?collId=1" class=" button btn border-0 ml-5 text-white text-uppercase">Discover</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 p-0">
            <div class="card border">
                <div class="card-body" style="background-image: url('../image/background/Women.png'); height: 350px;background-position: right;background-repeat: no-repeat;background-size: contain">
                    <h5 class="card-title text-uppercase pt-5 pl-5 font-weight-lighter" style="font-size: 40px;">
                        <strong>Women</strong> Collection
                    </h5>
                    <p class="card-text text-uppercase pt-0 pl-5">select your favorite fashion </p>
                    <a href="productFilter.php?collId=2" class=" button btn border-0 ml-5 text-white text-uppercase">Discover</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-6 p-0">
            <div class="card border">
                <div class="card-body" style="background-image: url('../image/background/kids.png'); height: 350px;background-position: right;background-repeat: no-repeat;background-size: contain">
                    <h5 class="card-title text-uppercase pt-5 pl-5 font-weight-lighter" style="font-size: 40px;">
                        <strong>Kids</strong> Collection
                    </h5>
                    <p class="card-text text-uppercase pt-0 pl-5">select your favorite fashion </p>
                    <a href="#" class="button btn border-0 ml-5 text-white text-uppercase">Discover</a>
                </div>
            </div>
        </div>
        <div class="col-sm-6 p-0">
            <div class="card border">
                <div class="card-body" style="background-image: url('../image/background/accessoires.png'); height: 350px;background-position: right;background-repeat: no-repeat;background-size: contain">
                    <h5 class="card-title text-uppercase pt-5 pl-5 font-weight-lighter" style="font-size: 40px;">
                        <strong>ACCESSOIRES</strong> Collection
                    </h5>
                    <p class="card-text text-uppercase pt-0 pl-5">select your favorite fashion </p>
                    <a href="#" class="button btn border-0 ml-5 text-white text-uppercase">Discover</a>
                </div>
            </div>
        </div>
    </div>
    <!--    collection end-->
</div>

<!-- new arrivals -->
<div class="container-fluid" id="newIn">
    <div class="row mt-3">
        <div class="col-12">
            <h1 class="text-uppercase  font-weight-bold text-dark text-center" style="font-size: 50px; font-family: montserrat,serif"> What's new</h1>
            <h4 class="text-uppercase font-weight-lighter text-dark text-center" style="font-family: montserrat,serif"> new pieces every week</h4>
            <br>
        </div>
    </div>
    <div class="row p-4">
        <?php
        include_once("../model/product_model.php");
        $product_obj = new Product($conn);

        $getMaleProducts = $product_obj->giveNewMaleProducts();
        while ($ProductArray = $getMaleProducts->fetch_assoc()) {

            $productId = $ProductArray["product_id"];
            $getImages = $product_obj->giveImages_ByProductId($productId);
            $imageArray = $getImages->fetch_assoc();

            include_once("../model/stock_model.php");
            $stock_obj = new Stock($conn);
            $getStock = $stock_obj->giveStockInfo_ByProductId($productId);
            $stockArray = $getStock->fetch_assoc();

            include_once("../model/size_model.php");
            $size_obj = new Size($conn);
            $getSize = $size_obj->giveSize_BySizeId($stockArray["size_sizeId"]);
            $sizeArray = $getSize->fetch_assoc();
        ?>

            <div class="col-sm-6 col-lg-3">
                <a href="viewItem.php?productId=<?php echo $productId; ?>" type="button" class="text-decoration-none text-muted w-100">
                    <div class="card text-center">
                        <img style="height: 280px;" class="card-img-top zoom img-fluid" src="../image/pro_img/<?php echo $imageArray["img_name"] ?>" alt="">
                        <div class="card-body">
                            <span class="productName">
                                <?php echo $ProductArray["product_name"]; ?>
                            </span>
                            <span class="productName">
                                <?php echo $sizeArray["size_name"]; ?>
                            </span>
                            <span class="productName">
                                <?php echo $stockArray["stock_sell_price"]; ?>
                            </span>
                        </div>
                    </div>
                </a>
            </div>

        <?php
        }
        ?>
    </div>

    <div class="row p-4">

        <?php
        include_once("../model/product_model.php");
        $product_obj = new Product($conn);

        $getFemaleProducts = $product_obj->giveNewFemaleProducts();
        while ($ProductArray = $getFemaleProducts->fetch_assoc()) {

            $productId = $ProductArray["product_id"];
            $getImages = $product_obj->giveImages_ByProductId($productId);
            $imageArray = $getImages->fetch_assoc();

            include_once("../model/stock_model.php");
            $stock_obj = new Stock($conn);
            $getStock = $stock_obj->giveStockInfo_ByProductId($productId);
            $stockArray = $getStock->fetch_assoc();

            include_once("../model/size_model.php");
            $size_obj = new Size($conn);
            $getSize = $size_obj->giveSize_BySizeId($stockArray["size_sizeId"]);
            $sizeArray = $getSize->fetch_assoc();
        ?>

            <div class="col-sm-6 col-lg-3">
                <a href="viewItem.php?productId=<?php echo $productId; ?>" type="button" class="text-decoration-none text-muted w-100">
                    <div class="card text-center">
                        <img style="height: 280px;" class="card-img-top zoom img-fluid" src="../image/pro_img/<?php echo $imageArray["img_name"] ?>" alt="">
                        <div class="card-body">
                            <span class="productName">
                                <?php echo $ProductArray["product_name"]; ?>
                            </span>
                            <span class="productName">
                                <?php echo $sizeArray["size_name"]; ?>
                            </span>
                            <span class="productName">
                                <?php echo $stockArray["stock_sell_price"]; ?>
                            </span>
                        </div>
                    </div>
                </a>
            </div>

        <?php
        }
        ?>

    </div>

</div>
<!-- new arrivals end -->
<!--content end -->

<!-- brands -->
<div class="container-fluid">
    <div class="row p-3">
        <div class="col-sm-12">
            <h1 class="text-uppercase  font-weight-bold text-dark text-center" style="font-size: 50px; font-family: montserrat,serif"> Brands</h1>
            <h4 class="text-uppercase font-weight-lighter text-dark text-center" style="font-family: montserrat,serif">We offer finest brands in our store</h4>
            <br>
        </div>
        <div class="row">
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 mx-auto">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/1.png" alt="">
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/2.png" alt="">
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/3.png" alt="">
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/4.png" alt="">
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/5.png" alt="">
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/6.png" alt="">
                </div>
            </div>
        </div>


        <div class="row mt-2">
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/7.png" alt="">
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/8.png" alt="">
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/9.png" alt="">
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/10.png" alt="">
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/11.png" alt="">
                </div>
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2">
                <div class="card-body">
                    <img class="brand img-fluid" src="../image/brand_img/12.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!--brands end-->
<script>
    document.title = "BOSARA TEXTILE | Home";
</script>
<?php
include_once("footer.php");
?>