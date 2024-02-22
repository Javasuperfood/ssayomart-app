// Slider Button SubKategori
$(document).ready(function() {
  var selectedSlideIndex = localStorage.getItem('selectedSlideIndexkat');
  if (selectedSlideIndex !== null) {
      selectedSlideIndex = parseInt(selectedSlideIndex);
  }

  var swiper = new Swiper(".buttonSwiper", {
      slidesPerView: 2,
      spaceBetween: 10,
      effect: "slide",
      speed: 600,
      grabCursor: true,
      breakpoints: {
          1280: {
              slidesPerView: 6,
          },
          768: {
              slidesPerView: 4,
          },
          375: {
              slidesPerView: 2,
          },
          280: {
              slidesPerView: 2,
          },
      },
      pagination: {
          el: ".swiper-pagination",
          clickable: true,
      },
      on: {
          init: function () {
              // Set slide index based on selected category
              if (selectedSlideIndex !== null) {
                  this.slideTo(selectedSlideIndex);
              }
          },
          slideChange: function () {
              // Save selected slide index to local storage
              var currentIndex = this.activeIndex;
              localStorage.setItem('selectedSlideIndexkat', currentIndex);
          },
      },
  });

  $(".card-linkkat").click(function(e) {
      e.preventDefault();
      var slideIndex = $(this).closest(".swiper-slide").index();
      swiper.slideTo(slideIndex);
  });
});

// tombol Scroll Up
var scrollUpButton = document.getElementById("scrollUpButton");

// Tampilkan tombol Scroll Up ketika pengguna menggulir ke bawah
window.addEventListener("scroll", function() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        scrollUpButton.style.display = "block";
    } else {
        scrollUpButton.style.display = "none";
    }
});

// Scroll kembali ke atas saat tombol Scroll Up diklik
scrollUpButton.addEventListener("click", function() {
    document.body.scrollTop = 0; // Untuk browser Safari
    document.documentElement.scrollTop = 0; // Untuk browser lainnya
});


