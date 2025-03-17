$(document).ready(function () {
  let current_fs, next_fs, prevoius_fs;
  let all_steps = $("fieldset").length;
  let curr_step = 1;

  $("fieldset").slice(1).hide();

  // Set ProgressBar Width
  function setProgressWidth(curStep) {
    let percent = parseFloat((100 / all_steps) * curStep);

    $(".progress-bar").css("width", percent + "%");
  }

  setProgressWidth(curr_step);

  $(".next").on("click", function (e) {
    let fname = $("#fname").val();
    let lname = $("#lname").val();
    let email = $("#email").val();
    let postal = $("#postalcode").val();
    let contact = $("#contact").val();
    let addr1 = $("#addr1").val();
    let addr2 = $("#addr2").val();
    let addr3 = $("#addr3").val();

    if (fname == "") {
      $("#fnamealert").html("This field is required").addClass("text-danger");
      return false;
    } else if (lname == "") {
      $("#lnamealert").html("This field is required").addClass("text-danger");
      return false;
    } else if (email == "") {
      $("#emailalert").html("This field is required").addClass("text-danger");
      return false;
    } else if (postal == "") {
      $("#postalcodealert")
        .html("This field is required")
        .addClass("text-danger");
      return false;
    } else if (contact == "") {
      $("#contactalert").html("This field is required").addClass("text-danger");
      return false;
    } else if (addr1 == "") {
      $("#addr1alert").html("This field is required").addClass("text-danger");
      return false;
    } else if (addr2 == "") {
      $("#addr2alert").html("This field is required").addClass("text-danger");
      return false;
    } else if (addr3 == "") {
      $("#addr3alert").html("This field is required").addClass("text-danger");
      return false;
    } else {
      current_fs = $(this).parent();
      next_fs = $(this).parent().next();

      current_fs.fadeOut(100);
      next_fs.fadeIn(500);

      //Add Active Class
      let next_fsIndex = $("fieldset").index(next_fs);
      $("#progressbar li").eq(next_fsIndex).addClass("active");

      setProgressWidth(++curr_step);
    }
  });

  $(".previous").on("click", function (e) {
    current_fs = $(this).parent();
    prevoius_fs = $(this).parent().prev();

    current_fs.fadeOut(100);
    prevoius_fs.fadeIn(500);

    let current_fsIndex = $("fieldset").index(current_fs);
    $("#progressbar li").eq(current_fsIndex).removeClass("active");

    setProgressWidth(--curr_step);
  });

  $("#fname").on("keyup", function (e) {
    $("#fnamealert").html("");
  });

  ///// Card Validation
  $("#paymentForm").on("submit", function (e) {
    let crdName = $("#nameOfCrd").val();
    let crdNum = $("cardNum").val();
    let month = $("#month").val();
    let year = $("#year").val();
    let cvv = $("#cvv").val();
    const cardPtt = /^[0-9]{16}$/;

    if (
      crdNum.match(cardPtt) == null ||
      crdNum != 1234123412341234 ||
      crdName == "" ||
      month == "" ||
      year == "" ||
      cvv != 999
    ) {
      Swal.fire("Error", "Card is Not Valid", "error");
      return false;
    }
  });
});
