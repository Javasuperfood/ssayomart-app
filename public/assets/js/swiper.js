// Slider Banner Awal Promosi Homepage All Device
var swiper = new Swiper(".mySwiper", {
  slidesPerView: 2, // Mengatur agar selalu ada 2 slide yang terlihat
  centeredSlides: true,
  spaceBetween: 10,
  grabCursor: true,
  loop: true,
  autoplay: {
    delay: 2000,
    disableOnInteraction: true,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    // Tampilan iPad (lebar >= 768px)
    1280: {
      slidesPerView: 2, // 3 card per tampilan

    },
    // Tampilan iPad (lebar >= 768px)
    768: {
      slidesPerView: 1, // 3 card per tampilan
    },
    // Tampilan Mobile (lebar < 768px)
    375: {
      slidesPerView: 1, // 2 card per tampilan
    },
    280: {
      slidesPerView: 1, // 2 card per tampilan
    },
  },
  navigation: {
    nextEl: '.button-next',
    prevEl: '.button-prev',
},

  });

  // Slider Banner ke 2 Promosi All Produk 
var swiper = new Swiper(".myBanner", {
  slidesPerView: 2, // Mengatur agar selalu ada 2 slide yang terlihat
  centeredSlides: false,
  spaceBetween: 10,
  grabCursor: true,
  loop: true,
  autoplay: {
    delay: 2000,
    disableOnInteraction: true,
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    // Tampilan iPad (lebar >= 768px)
    1280: {
      slidesPerView: 2, // 3 card per tampilan

    },
    // Tampilan iPad (lebar >= 768px)
    768: {
      slidesPerView: 1, // 3 card per tampilan
    },
    // Tampilan Mobile (lebar < 768px)
    375: {
      slidesPerView: 1, // 2 card per tampilan
    },
    280: {
      slidesPerView: 1, // 2 card per tampilan
    },
  },
  navigation: {
    nextEl: '.button-next',
    prevEl: '.button-prev',
},

  });

// Slider Blog  Homepage View Desktop
var swiper = new Swiper(".mySwung", {
  slidesPerView: 2,
  centeredSlides: false,
  spaceBetween: 10,
  grabCursor: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },

  breakpoints: {
    // Tampilan iPad (lebar >= 768px)
    1280: {
      slidesPerView: 2, // 3 card per tampilan
    },
    // Tampilan iPad (lebar >= 768px)
    768: {
      slidesPerView: 3, // 3 card per tampilan
    },
  },
});

// Slider card produk detail (All Device) dan slider Homepage (Desktop)
var swiper = new Swiper(".mySwing", {
  slidesPerView: 6,
  centeredSlides: false,
  spaceBetween: 10,
  grabCursor: true,
  loop: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },

  breakpoints: {
    // Tampilan iPad (lebar >= 768px)
    1280: {
      slidesPerView: 6, // 6 card per tampilan
    },
    // Tampilan iPad (lebar >= 768px)
    768: {
      slidesPerView: 6, // 4 card per tampilan
    },
    717: {
      slidesPerView: 3, // 2 card per tampilan
    },
    450: {
      slidesPerView: 3, // 3 card per tampilan
    },
    360: {
      slidesPerView: 3, // 2 card per tampilan
    },
    320: {
      slidesPerView: 2, // 2 card per tampilan
    },
    280: {
      slidesPerView: 2, // 2 card per tampilan
    },
  },
});

// Slider Blog  Homepage View Mobile
var swiper = new Swiper(".mySweety", {
  slidesPerView: 0,
  centeredSlides: false,
  spaceBetween: 10,
  grabCursor: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },

  breakpoints: {
    375: {
      slidesPerView: 2, // 2 card per tampilan
    },

    768: {
      slidesPerView: 3, // 3 card per tampilan
    },
    280: {
      slidesPerView: 2, // tampilan galaxo fold
    },
  },
  navigation: {
    nextEl: ".button-next",
    prevEl: ".button-prev",
  },
});

// Slider kategori view Mobile
var swiper = new Swiper(".btn-sub", {
  slidesPerView: "auto",
  spaceBetween: 10,
  breakpoints: {
    // Tampilan iPad (lebar >= 768px)
    1280: {
      slidesPerView: 6, // 3 card per tampilan
    },
    // Tampilan iPad (lebar >= 768px)
    768: {
      slidesPerView: 4, // 3 card per tampilan
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
});
