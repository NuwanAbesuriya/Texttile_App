$(document).ready(function () {
  $("#addCustomer").on("submit", function (e) {
    let contact = $("#contact").val();
    let nic = $("#nic").val();
    let pw = $("#pw").val();
    let cpw = $("#cpw").val();

    const cont_patt = /^[0-9]{9}$/;
    const nic_patt_old = /^([0-9]{9})([vV])$/;
    const nic_patt_new = /^[0-9]{12}$/;

    if (contact.match(cont_patt) == null) {
      Swal.fire("Invalid Contact Number", "", "error");
      $("#contact").focus();
      return false;
    } else if (
      nic.match(nic_patt_old) == null &&
      nic.match(nic_patt_new) == null
    ) {
      Swal.fire("Invalid N.I.C Number", "", "error");
      $("#nic").focus();
      return false;
    } else if ($("input[name=gender]:checked").length < 1) {
      Swal.fire("Please Select Gender", "", "warning");
      return false;
    } else if (pw.length < 6) {
      Swal.fire("Password must have at least 6 characters", "", "warning");
      return false;
    } else if (pw != cpw) {
      Swal.fire("Password Confirmation Doesn't Match", "", "error");
      return false;
    }
  });

  ////////////////////////////// Check User Existence ////////////////////
  $("#nic").on("keyup", function (e) {
    let nic = $(this).val();

    if (nic != "") {
      $.ajax({
        url: "../controller/customer_controller.php?type=checkUserExistence",
        type: "POST",
        cache: false,
        data: { nic: nic },
        success: function (res) {
          if (res == "yes") {
            $("#user_response").html("This User already has been registered");
            $("#submit").prop("disabled", true);
            $("#nic").css("border-color", "red");
          } else {
            $("#user_response").html("");
            $("#submit").prop("disabled", false);
            $("#nic").css("border-color", "");
          }
        },
        error: function () {
          console.log("Ajax Error");
        },
      });
    }
  });

  ////////////////////////////// Password visibility Toggle /////////////////////////
  $("#pw_append").on("click", function (e) {
    if ($("#pw").prop("type") == "password") {
      $("#pw").prop("type", "text");
    } else {
      $("#pw").prop("type", "password");
    }

    $("#pw_icon").toggleClass("fa-eye fa-eye-slash");
  });

  $("#cpw_append").on("click", function (e) {
    if ($("#cpw").prop("type") == "password") {
      $("#cpw").prop("type", "text");
    } else {
      $("#cpw").prop("type", "password");
    }

    $("#cpw_icon").toggleClass("fa-eye fa-eye-slash");
  });

  ///////////////////////////////// Password Strength Meter ////////////////////////////
  $("#pw").on("keyup", function (e) {
    let pw = $(this).val();

    let corr_pw = pw.replace(/\s/g, "");
    $(this).val(corr_pw);

    const pw_weak_1 = /^[a-zA-Z]{6,}$/;
    const pw_weak_2 = /^[0-9]{6,}$/;
    const pw_medium = /(?=.*[a-zA-Z])(?=.*[0-9])(?=.{6,})(^((?![\W\_]).)*$)/;
    const pw_strong = /(?=.*[\W\_])(?=.{6,})/;

    if (corr_pw.match(pw_weak_1) != null || corr_pw.match(pw_weak_2) != null) {
      $("#progressBar").css({ width: "33.33333%", backgroundColor: "red" });
      $("#progressBar").html("Weak");
    } else if (corr_pw.match(pw_medium) != null) {
      $("#progressBar").css({ width: "66.6666%", backgroundColor: "orange" });
      $("#progressBar").html("Medium");
    } else if (corr_pw.match(pw_strong) != null) {
      $("#progressBar").css({ width: "100%", backgroundColor: "green" });
      $("#progressBar").html("Strong");
    } else {
      $("#progressBar").css("width", "0%");
    }
  });
});

function readURL(input) {
  if (input.files && input.files[0]) {
    let reader = new FileReader();
    reader.onload = function (e) {
      $("#prev_img").attr("src", e.target.result).width(80).height(70);
    };
    reader.readAsDataURL(input.files[0]);
  } else {
    $("#prev_img").attr("src", "");
  }
}
