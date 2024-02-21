// Slider Button SubKategori
var swiper = new Swiper(".buttonSwiper", {
  slidesPerView: 2,
  spaceBetween: 10,
  effect: "slide", // Efek slide untuk gerakan yang halus
  speed: 600, // Kecepatan animasi (milidetik), disesuaikan untuk efek yang lebih halus
  grabCursor: true, // Mengganti kursor saat menyentuh slide
  breakpoints: {
    // Tampilan iPad (lebar >= 768px)
    1280: {
      slidesPerView: 6, // 6 card per tampilan
    },
    // Tampilan iPad (lebar >= 768px)
    768: {
      slidesPerView: 4, // 4 card per tampilan
    },
    // Tampilan Mobile (lebar < 768px)
    375: {
      slidesPerView: 2, // 2 card per tampilan
    },
    280: {
      slidesPerView: 2, // tampilan galaxo fold
    },
  },
  navigation: {
    nextEl: ".button-next",
    prevEl: ".button-prev",
  },
  grabCursor: true, // Mengganti kursor saat menyentuh slide
  mousewheel: true, // Aktifkan geser mouse
  keyboard: true, // Aktifkan navigasi keyboard
  // autoplay: {
  //   delay: 50000, // Delay antara setiap geser (milidetik)
  //   disableOnInteraction: true, // Nonaktifkan autoplay saat interaksi pengguna
  // },
  pagination: {
    el: ".swiper-pagination", // Lokasi pagination
    clickable: true, // Mengaktifkan navigasi pagination yang bisa diklik
  },
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


