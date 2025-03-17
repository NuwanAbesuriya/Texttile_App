<?php
include_once("navbar.php");

$collId = isset($_GET["collId"]) ? $_GET["collId"] : "";

include_once("../model/product_model.php");
$product_obj = new Product($conn);

$brands = $product_obj->giveAll_BrandsByCollId($collId);
$categories = $product_obj->giveAll_CategoriesByCollId($collId);
$collTypes = $product_obj->giveAll_CollTypesByCollId($collId);
?>
<!-- content -->
<div class="container-fluid">

    <input id="collId" type="hidden" value="<?php echo $collId; ?>">

    <!--  Top  Banner-->
    <div class="row">
        <div class="col-md-12 text-center p-5 pb-5" style="background-image:url('../image/background/1-12.webp');">
            <p class="text-uppercase p-2 m-auto text-white font-weight-lighter" style=" font-family: montserrat,serif; font-size: 40px;">Men Collection</p>
            <p class="text-uppercase pt-3 pb-0 m-auto text-white font-weight-lighter "><a class="text-decoration-none" style=" font-family: montserrat,serif; color:#db9200" href="index.php">Home</a> &rarr; Men Collection</p>
        </div>
    </div>
    <!--  Top Banner End -->

    <div class="row mt-3">
        <!-- Filter Area    -->
        <div class="col-sm-12 col-md-3 text-muted">
            <div class="card">
                <div class="card-body">
                    <div class="row mt-2 pl-3">
                        <div class="col-sm-4 col-md-12">
                            <label class="control-label text-uppercase font-weight-bold">Brand</label>
                            <br>
                            <input type="radio" name="brandId" checked value="brand_brandId">
                            <label>ALL</label><br>
                            <?php while ($brandsArray = $brands->fetch_assoc()) { ?>
                                <input type="radio" name="brandId" value="<?php echo $brandsArray["brand_id"]; ?>">
                                <label class="text-uppercase"><?php echo $brandsArray["brand_name"]; ?></label><br>
                            <?php } ?>
                        </div>

                        <div class="col-sm-4 col-md-12">
                            <label class="control-label text-uppercase font-weight-bold">Type Of Collection</label>
                            <br>
                            <input type="radio" name="AllTypCol" checked value="collection_type_collectionTypeId">
                            <label for="AllTypCo">ALL</label><br>
                            <?php while ($collTypesArray = $collTypes->fetch_assoc()) { ?>
                                <input type="radio" name="AllTypCol" value="<?php echo $collTypesArray["collection_type_id"]; ?>">
                                <label class="text-uppercase"><?php echo $collTypesArray["collection_type_name"]; ?></label><br>
                            <?php } ?>
                        </div>

                        <div class="col-sm-4 col-md-12">
                            <label class="control-label text-uppercase font-weight-bold">Category</label>
                            <br>
                            <input type="radio" name="AllCat" checked value="category_categoryId">
                            <label for="AllCat">ALL</label><br>
                            <?php while ($categoriesArray = $categories->fetch_assoc()) { ?>
                                <input type="radio" name="AllCat" value="<?php echo $categoriesArray["category_id"]; ?>">
                                <label class="text-uppercase"><?php echo $categoriesArray["category_name"]; ?></label><br>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--  Filter Area End -->

        <!-- View Content -->
        <div class="col col-md-9 text-muted" style="border-left: outset;" id="content">

        </div>
        <!-- View Content End     -->
    </div>

</div>
<!-- content end -->

<script>
    document.title = "BOSARA TEXTILE | Product Filters";
</script>
<script src="../js/productFilter.js"></script>
<?php
include_once("footer.php");
?>