$(document).ready(function () {
  $("[data-toggle=tooltip]").tooltip();

  $("#orderTable, #feedbackTable").DataTable();

  ///////////////////////// Get Order Records /////////////////////////
  $(".viewOrderDetailsBtn").on("click", function (e) {
    let invoiceId = $(this).val();

    $.ajax({
      url: "../controller/order_controller.php?type=viewOrderDetails",
      type: "POST",
      data: { invoiceId: invoiceId },
      cache: false,
      success: function (res) {
        $("#viewOrderDetails").html(res);
      },
      error: function () {
        console.log("Error");
      },
    });
  });

  $(".viewFeedbackBtn").on("click", function (e) {
    let invoiceId = $(this).val();

    $("#feedBackModal").modal("show");
    $("#invoiceId").val(invoiceId);
  });

  $("#feedbackButton").on("click", function (e) {
    e.preventDefault();

    $.ajax({
      url: "../controller/feedback_controller.php?type=addFeedback",
      type: "POST",
      cache: false,
      data: $("#feedbackForm").serialize(),
      success: function (res) {
        if (res == "ok") {
          Swal.fire({
            title: "Thank You !",
            text: "Your Comment",
            icon: "success",
            showConfirmButton: false,
            timer: 2000,
          }).then(() => {
            location.reload();
          });
        } else {
          Swal.fire({
            title: "Oops",
            text: "Something Went Wrong",
            icon: "error",
          });
        }
      },
      error: function () {
        console.log("error");
      },
    });
  });
});
