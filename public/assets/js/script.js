// Fungsi input numerik tambahkan elemet 
// onkeypress="return isNumber(event);" 
// pada tag input
function isNumber(e) {
    var charCode = (e.which) ? e.which : e.keyCode;
  
    // Check if the input is a number or control key
    if (
      (charCode >= 48 && charCode <= 57) ||  // Numbers 0-9
      (charCode === 8) ||                   // Backspace
      (charCode === 37) ||                  // Left Arrow (for navigation)
      (charCode === 39)                     // Right Arrow (for navigation)
    ) {
      return true;
    }
  
    return false;
}