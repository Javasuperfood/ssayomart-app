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
  try {
    if (navigator.clipboard) {
      navigator.clipboard
        .writeText(text)
        .then(function () {
          Swal.fire({
            icon: "success",
            title: "Copy",
            html: `${text}<br/>has been copied to the clipboard`,
            showConfirmButton: false,
            timer: 1500,
          });
        })
        .catch(function (error) {
          console.error("Error copying to clipboard:", error);
          // You can display an error message to the user here if needed.
        });
    } else {
      console.error("Clipboard API not supported in this browser");
      // You can display a message to the user that clipboard functionality is not available.
    }
  } catch (error) {
    console.error("An error occurred:", error);
    // Handle any other errors that may occur.
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
