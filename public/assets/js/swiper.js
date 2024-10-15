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
  spaceBetween: 10,
  grabCursor: true,
  loop: true,
  pagination: {
    el: ".swiper-pagination",
    clickable: true,
  },
  breakpoints: {
    1280: { slidesPerView: 6 }, // Desktop
    768: { slidesPerView: 6 }, // iPad
    717: { slidesPerView: 3 }, // Small tablets
    450: { slidesPerView: 3 }, // Mobile landscape
    360: { slidesPerView: 3 }, // Mobile portrait
    320: { slidesPerView: 2 }, // Small mobile
    280: { slidesPerView: 2 }, // Extra small mobile
  },
  touchRatio: 1.2, // Menambah sensitivitas swipe
  longSwipesRatio: 0.3, // Lebih cepat trigger swipe
  freeMode: true, // Smoother drag experience
  freeModeMomentum: true,
  freeModeMomentumVelocityRatio: 0.6, // Swipe smooth tetapi tidak terlalu melambung
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

// Initialize Swiper Kategori 
$(document).ready(function () {
  const urlLink = window.location.href;

  // Function to sync hover status with selected category and center the slide
  function syncCategorySelection() {
    const selectedCategory = decodeURIComponent(urlLink.split("/").pop());
    const $selectedCard = $(`.card-linkkat[href*="${selectedCategory}"]`);

    if ($selectedCard.length) {
      $(".card")
        .removeClass("card-selectedkat card-defaultkat")
        .addClass("card-defaultkat");
      $selectedCard
        .closest(".card")
        .addClass("card-selectedkat")
        .removeClass("card-defaultkat");
      centerSlide($selectedCard.closest(".ss"));
      localStorage.setItem("selectedCategory", selectedCategory);
    }
  }

  // Function to center the selected slide
  function centerSlide($slide) {
    const slideIndex = $slide.index();
    const slideWidth = $slide.outerWidth();
    const swiperWidth = $(".contsw").outerWidth();
    const scrollTo = slideIndex * slideWidth - (swiperWidth - slideWidth) / 2;
    $(".contsw").css("transform", `translateX(-${scrollTo}px)`);
  }

  // Function to restore the selected category and center slide on page load
  function restoreSelectedCategory() {
    const selectedCategory = localStorage.getItem("selectedCategory");
    if (selectedCategory) {
      const $selectedCard = $(`.card-linkkat[href*="${selectedCategory}"]`);
      if ($selectedCard.length) {
        $selectedCard
          .closest(".card")
          .addClass("card-selectedkat")
          .removeClass("card-defaultkat");
        centerSlide($selectedCard.closest(".ss"));
      }
    }
  }

  // Initialize Swiper with smoother settings
  const swiper = new Swiper(".btn-sub", {
    slidesPerView: 2,
    speed: 500,
    freeMode: true,
    freeModeMomentum: true,
    longSwipesMs: 300,
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
      init() {
        const selectedSlideIndex = localStorage.getItem(
          "selectedSlideIndexkat"
        );
        if (selectedSlideIndex !== null) {
          this.slideTo(selectedSlideIndex);
        }
      },
      slideChange() {
        localStorage.setItem("selectedSlideIndexkat", this.activeIndex);
      },
    },
  });

  // Handle card click event and update the selected category
  $(".card-linkkat").click(function (e) {
    e.preventDefault();
    const $clickedCard = $(this).closest(".card");

    $(".card").removeClass("card-selectedkat").addClass("card-defaultkat");
    $clickedCard.addClass("card-selectedkat").removeClass("card-defaultkat");

    const selectedCategory = decodeURIComponent(
      $(this).attr("href").split("/").pop()
    );
    localStorage.setItem("selectedCategory", selectedCategory);
    localStorage.setItem("selectedCardLinkkat", $(this).attr("href"));

    // Redirect to the clicked category
    window.location = $(this).attr("href");
  });

  // Handle hover effect to center the slide
  $(".card-linkkat").hover(
    function () {
      centerSlide($(this).closest(".ss"));
      $(this)
        .closest(".card")
        .addClass("card-hoverkat")
        .removeClass("card-defaultkat");
    },
    function () {
      restoreSelectedCategory();
    }
  );

  // Initial setup on page load
  syncCategorySelection();
  restoreSelectedCategory();
});





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



