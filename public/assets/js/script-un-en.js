// Fungsi input numerik tambahkan elemet
// onkeypress="return isNumber(event);"
// pada tag input
function isNumber(e) {
  var charCode = e.which ? e.which : e.keyCode;

  // Check if the input is a number or control key
  if (
    (charCode >= 48 && charCode <= 57) || // Numbers 0-9
    charCode === 8 || // Backspace
    charCode === 37 || // Left Arrow (for navigation)
    charCode === 39 // Right Arrow (for navigation)
  ) {
    return true;
  }

  return false;
}

function copyBtn(text) {
  if (navigator.clipboard.writeText(text)) {
    Swal.fire({
      icon: "success",
      title: "Copy",
      html: `${text}<br/>has been copied to the clipboard`,
      showConfirmButton: false,
      timer: 1500,
    });
  }
}

function searchValidate() {
  var keyword = $("#search").val();
  if (keyword == "") {
    Swal.fire({
      position: "top-center",
      icon: "error",
      text: "Field search cannot be empty",
      showConfirmButton: false,
      timer: 800,
    });
    event.preventDefault();
    return false;
  }
  if (keyword.trim().length < 3) {
    Swal.fire({
      position: "top-center",
      icon: "error",
      text: "Search keyword must be at least 3 characters",
      showConfirmButton: false,
      timer: 800,
    });
    event.preventDefault();
    return false;
  }
}
