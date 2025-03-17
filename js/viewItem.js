$(document).ready(function () {
  $("#sizeId").on("change", function (e) {
    let productId = $("#productId").val();
    let sizeId = $("#sizeId").val();

    if (sizeId != "") {
      $.ajax({
        url: "../controller/stock_controller.php?type=getStockInfo",
        type: "POST",
        cache: false,
        dataType: "JSON",
        data: { productId: productId, sizeId: sizeId },
        success: function (res) {
          if (res != "error") {
            if (res.stock_count > 0) {
              $("#setPrice").html(": " + res.stock_sell_price);
              $("#addToCart").prop("disabled", false);
              $("#productPrice").val(res.stock_sell_price);
              $("#stockId").val(res.stock_id);
            } else {
              $("#setPrice").html(": Not Enough Stock");
              $("#addToCart").prop("disabled", true);
              $("#productPrice").val("");
              $("#stockId").val("");
            }
          } else {
            $("#setPrice").html(": Price Not Found");
            $("#addToCart").prop("disabled", true);
            $("#productPrice").val("");
            $("#stockId").val("");
          }
        },
        error: function () {
          console.log("Error");
        },
      });
    }
  });

  //////////////////// Image Change ////////////////////////
  $(".change").on("click", function (e) {
    let prevImg = $(this).attr("data-full");

    $(".selected").removeClass();
    $(this).addClass("selected");

    $(".full img").hide().attr("src", prevImg).fadeIn();
  });

  ///////////////////////// Fancy Add //////////////////////
  $(".full img").on("click", function (e) {
    let MainImgUrl = $(this).attr("src");
    $.fancybox.open(MainImgUrl);
  });

  $("#addToCartForm").on("submit", function (e) {
    let sizeId = $("#sizeId").val();
    let stockId = $("#stockId").val();

    if (sizeId == "") {
      Swal.fire("Please Select Size", "", "warning");
      return false;
    } else {
      $.ajax({
        url: "../controller/cart_controller.php?type=addItem",
        type: "POST",
        cache: false,
        data: { stockId: stockId },
        success: function (res) {
          console.log(res);
        },
        error: function () {
          console.log("error");
        },
      });
    }
  });
});
