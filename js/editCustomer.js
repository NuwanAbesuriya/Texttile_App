$(document).ready(function () {
  $("#editCustomer").on("submit", function (e) {
    let contact = $("#contact").val();

    const cont_patt = /^[0-9]{9}$/;

    if (contact.match(cont_patt) == null) {
      Swal.fire("Invalid Contact Number", "", "error");
      $("#contact").focus();
      return false;
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
