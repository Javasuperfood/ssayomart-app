// Slider Button SubKategori
$(document).ready(function () {
  // Initialize Swiper with smooth touch interactions
  const swiper = new Swiper(".buttonSwiper", {
    slidesPerView: 2,
    spaceBetween: 10,
    speed: 600, // Reduced speed for a more natural swipe feel
    grabCursor: true,
    freeMode: true,
    freeModeMomentum: true,
    longSwipesMs: 300, // Reduced swipe duration for faster response
    breakpoints: {
      1280: { slidesPerView: 6 },
      768: { slidesPerView: 4 },
      375: { slidesPerView: 2 },
      280: { slidesPerView: 2 },
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    on: {
      init() {
        const index = localStorage.getItem("selectedSlideIndexkat");
        if (index) this.slideTo(parseInt(index));
      },
      slideChange() {
        localStorage.setItem("selectedSlideIndexkat", this.activeIndex);
      },
    },
  });

  // Handle card click to slide to specific card
  $(".card-linkkat").on("click", function (e) {
    e.preventDefault();
    swiper.slideTo($(this).closest(".swiper-slide").index());
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


