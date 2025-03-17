$(document).ready(function () {
  $(".remove").on("click", function (e) {
    e.preventDefault();

    let stockId = $(this).parents("tr").find(".itemId").val();

    $.ajax({
      url: "../common/cartSession.php?type=removeItem",
      type: "POST",
      data: { itemId: stockId },
      success: function (res) {
        $.ajax({
          url: "../controller/cart_controller.php?type=removeItem",
          type: "POST",
          data: { itemId: stockId },
          success: function (res) {
            location.reload();
          },
          error: function () {
            console.log("Error");
          },
        });
      },
      error: function () {
        console.log("Error");
      },
    });
  });

  $(".increaseProd").on("click", function (e) {
    let stockId = $(this).parents("tr").find(".itemId").val();

    $.ajax({
      url: "../controller/stock_controller.php?type=getStockInfo_ByStockID",
      type: "POST",
      dataType: "JSON",
      data: { stockId: stockId },
      success: function (res) {
        if (res != "error") {
          if (res.stock_count > 0) {
            $.ajax({
              url: "../common/cartSession.php?type=increaseQty",
              type: "POST",
              data: { itemId: stockId },
              success: function (res) {
                $.ajax({
                  url: "../controller/cart_controller.php?type=addItem",
                  type: "POST",
                  data: { stockId: stockId },
                  success: function (res) {
                    location.reload();
                  },
                  error: function () {
                    console.log("Error");
                  },
                });
              },
              error: function () {
                console.log("Error");
              },
            });
          } else {
            Swal.fire("Sorry Can't Increase", "Not Enough Stock", "error");
          }
        }
      },
      error: function () {
        console.log("stock Error");
      },
    });
  });

  $(".decreaseProd").on("click", function (e) {
    let stockId = $(this).parents("tr").find(".itemId").val();
    let prodQty = $(this).parents("tr").find(".prodQty").val();

    prodQty = parseInt(prodQty);

    if (prodQty > 1) {
      $.ajax({
        url: "../common/cartSession.php?type=decreaseQty",
        type: "POST",
        data: { itemId: stockId },
        success: function (res) {
          $.ajax({
            url: "../controller/cart_controller.php?type=decreaseQty",
            type: "POST",
            data: { stockId: stockId },
            success: function (res) {
              location.reload();
            },
            error: function () {
              console.log("Error");
            },
          });
        },
        error: function () {
          console.log("Error");
        },
      });
    }
  });
});
