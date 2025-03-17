$(document).ready(function () {
  let brandId = $("input[name=brandId]:checked").val();
  let CollType = $("input[name=AllTypCol]:checked").val();
  let CategoryId = $("input[name=AllCat]:checked").val();
  let CollId = $("#collId").val();

  $.ajax({
    url: "../controller/product_controller.php?type=filterProducts",
    type: "POST",
    cache: false,
    data: {
      brandId: brandId,
      CollType: CollType,
      CategoryId: CategoryId,
      CollId: CollId,
    },
    success: function (res) {
      $("#content").html(res);
    },
    error: function () {
      console.log("error");
    },
  });

  $("input[name=brandId], input[name=AllTypCol], input[name=AllCat]").on(
    "change",
    function (e) {
      let brandId = $("input[name=brandId]:checked").val();
      let CollType = $("input[name=AllTypCol]:checked").val();
      let CategoryId = $("input[name=AllCat]:checked").val();
      let CollId = $("#collId").val();

      $.ajax({
        url: "../controller/product_controller.php?type=filterProducts",
        type: "POST",
        cache: false,
        data: {
          brandId: brandId,
          CollType: CollType,
          CategoryId: CategoryId,
          CollId: CollId,
        },
        success: function (res) {
          $("#content").html(res);
        },
        error: function () {
          console.log("error");
        },
      });
    }
  );
});
