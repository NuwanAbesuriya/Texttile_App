$(document).ready(function () {
  $("#pw_append").on("click", function (e) {
    if ($("#pw").prop("type") == "password") {
      $("#pw").prop("type", "text");
    } else {
      $("#pw").prop("type", "password");
    }

    $("#pw_icon").toggleClass("fa-eye fa-eye-slash");
  });

  ///////////////////////// Check Email /////////////////
  $("#nemail").on("keyup", function (e) {
    let email = $(this).val();

    if (email != "") {
      $.ajax({
        url: "../controller/customer_controller.php?type=checkEmailExistence",
        type: "POST",
        cache: false,
        data: { email: email },
        success: function (res) {
          if (res == "yes") {
            $("#email_response").html("Email already has been taken");
            $("#nemail").css("border-color", "red");
            $("#registerBtn").prop("disabled", true);
          } else {
            $("#email_response").html("");
            $("#nemail").css("border-color", "");
            $("#registerBtn").prop("disabled", false);
          }
        },
        error: function () {
          console.log("Ajax Error");
        },
      });
    }
  });
});
