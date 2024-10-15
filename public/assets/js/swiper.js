// Slider Banner Awal Promosi Homepage All Device
var swiper = new Swiper(".mySwiper", {
  slidesPerView: 2, // Mengatur agar selalu ada 2 slide yang terlihat
  centeredSlides: true,
  spaceBetween: 10,
  grabCursor: true,
  loop: true,
  // autoplay: {
  //   delay: 2000,
  //   disableOnInteraction: true,
  // },
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

// Initialize Swiper
var swiper = new Swiper(".btn-sub", {
  slidesPerView: 2,
  effect: "slide",
  speed: 600,
  grabCursor: true,
  freeMode: true,
  freeModeMomentum: true,
  touchRatio: 1,
  longSwipesRatio: 0.5,
  longSwipesMs: 400,
  breakpoints: {
    1280: { slidesPerView: 6 },
    768: { slidesPerView: 4 },
    375: { slidesPerView: 3 },
    280: { slidesPerView: 2 },
  },
  navigation: {
    nextEl: ".button-next",
    prevEl: ".button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  on: {
    init: function () {
      const selectedIndex = localStorage.getItem("selectedSlideIndexkat");
      if (selectedIndex) this.slideTo(selectedIndex);
    },
    slideChange: function () {
      localStorage.setItem("selectedSlideIndexkat", this.activeIndex);
    },
  },
});

// Handle card click and hover events
$(".card-linkkat").click(function (e) {
  e.preventDefault();
  updateCardSelection($(this));
  localStorage.setItem("selectedCardLinkkat", $(this).attr("href"));
  localStorage.setItem(
    "selectedCategory",
    decodeURIComponent($(this).attr("href").split("/").pop())
  );
  window.location = $(this).attr("href");
});

function updateCardSelection($cardLink) {
  $(".ss .card").removeClass("card-selectedkat").addClass("card-defaultkat");
  $cardLink
    .closest(".card")
    .addClass("card-selectedkat")
    .removeClass("card-defaultkat");
}

// On page load, restore selected category
var selectedCategory = localStorage.getItem("selectedCategory");
if (selectedCategory) {
  $(".card-linkkat").each(function () {
    if ($(this).attr("href").includes(selectedCategory)) {
      updateCardSelection($(this));
      centerSlide($(this).closest(".ss"));
    }
  });
}

// Center slide on hover
$(".card-linkkat").hover(
  function () {
    centerSlide($(this).closest(".ss"));
  },
  function () {
    const selectedIndex = localStorage.getItem("selectedSlideIndexkat");
    centerSlide($(".ss").eq(selectedIndex));
  }
);

function centerSlide($slide) {
  const slideIndex = $slide.index();
  const slideWidth = $slide.outerWidth();
  const swiperWidth = $(".contsw").outerWidth();
  const wrapperOffset = (swiperWidth - slideWidth) / 2;
  const scrollTo = slideIndex * slideWidth - wrapperOffset;
  $(".contsw").css("transform", `translateX(-${scrollTo}px)`);
}



// Slider Hsitori view Mobile
$(document).ready(function () {
  var swiper = new Swiper(".btn-his", {
    slidesPerView: 2,
    effect: "slide",
    speed: 600,
    spaceBetween: 10,
    grabCursor: true,
    touchRatio: 1, // Sensitivitas sentuhan
    longSwipesRatio: 0.5, // Mengurangi untuk swipe lebih cepat
    longSwipesMs: 300, // Durasi minimum untuk memicu swipe ke slide berikutnya/sebelumnya
    freeMode: true, // Mode bebas untuk pengalaman drag yang lebih halus
    freeModeMomentum: true, // Menambahkan momentum untuk swipe yang lebih smooth
    freeModeMomentumVelocityRatio: 0.8, // Mengurangi momentum untuk swipe yang lebih terkendali
    breakpoints: {
      1280: { slidesPerView: 6 },
      768: { slidesPerView: 4 },
      375: { slidesPerView: 3 },
      280: { slidesPerView: 2 },
    },
    navigation: {
      nextEl: ".button-next",
      prevEl: ".button-prev",
    },
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    effectOptions: {
      slideShadows: true,
      fadeEffect: {
        crossFade: true,
      },
      coverflowEffect: {
        rotate: 30,
        stretch: 10,
        depth: 60,
        modifier: 2,
        slideShadows: true,
      },
      cubeEffect: {
        shadow: true,
        slideShadows: true,
        shadowOffset: 20,
        shadowScale: 0.94,
      },
    },
    on: {
      init: function () {
        // Pindahkan slide yang dipilih ke tengah saat inisialisasi
        var selectedSlideIndex = localStorage.getItem("selectedSlideIndex");
        if (selectedSlideIndex !== null) {
          this.slideTo(selectedSlideIndex);
        }
      },
      slideChange: function () {
        // Simpan indeks slide saat berubah
        var currentIndex = this.activeIndex;
        localStorage.setItem("selectedSlideIndex", currentIndex);
      },
    },
  });

  $(".card-linkkat").click(function (e) {
    e.preventDefault();
    var categoryUrl = $(this).attr("href");
    var slideIndex = $(this).closest(".ss").index();

    // Smooth transition saat pindah slide
    swiper.slideTo(slideIndex, 1000, false);

    // Simpan indeks slide yang dipilih
    localStorage.setItem("selectedSlideIndex", slideIndex);

    // Ubah URL tanpa reload halaman
    window.history.pushState(null, null, categoryUrl);
  });
});



