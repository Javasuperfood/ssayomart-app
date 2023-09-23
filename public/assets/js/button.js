var swiper = new Swiper(".buttonSwiper", {
    slidesPerView: 3,
    centeredSlides: true,
    spaceBetween: 5,
    grabCursor: true,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    breakpoints: {
      // Tampilan iPad (lebar >= 768px)
      1280: {
        slidesPerView: 6, // 3 card per tampilan
      },
      // Tampilan iPad (lebar >= 768px)
      768: {
        slidesPerView: 4, // 4 card per tampilan
      },
      // Tampilan Mobile (lebar < 768px)
      375: {
        slidesPerView: 3, // 2 card per tampilan
      },
      280: {
        slidesPerView: 2, // Samsung galaxy fold
      },
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

// Gulir kembali ke atas saat tombol Scroll Up diklik
scrollUpButton.addEventListener("click", function() {
    document.body.scrollTop = 0; // Untuk browser Safari
    document.documentElement.scrollTop = 0; // Untuk browser lainnya
});


