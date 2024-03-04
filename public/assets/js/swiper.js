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

// Slider kategori view Mobile
$(document).ready(function() {
  const urlLink = window.location.href;

  // Function to sync hover status with selected category and slide to center
  function syncHoverAndSlideToCenter() {
      const selectedCategory = decodeURIComponent(urlLink.split("/").pop()); // Get the last part of the URL which is the category
      $(".card-linkkat").each(function() {
          if ($(this).attr("href").includes(selectedCategory)) {
              $(".card-linkkat").closest(".card").removeClass("card-selectedkat").addClass("card-defaultkat"); // Remove active class from all categories
              $(this).closest(".card").addClass("card-selectedkat").removeClass("card-defaultkat"); // Add active class to selected category

              // Slide to center
              const slideIndex = $(this).closest(".ss").index();
              const slideWidth = $(".ss").outerWidth();
              const swiperWidth = $(".contsw").outerWidth();
              const wrapperOffset = (swiperWidth - slideWidth) / 2;
              const scrollTo = slideIndex * slideWidth - wrapperOffset;
              $(".contsw").css("transform", `translateX(-${scrollTo}px)`);

              // Save selected category to local storage
              localStorage.setItem('selectedCategory', selectedCategory);
          }
      });
  }

  // Initial sync on page load
  syncHoverAndSlideToCenter();

  // Sync hover with category and slide to center on URL change (if using AJAX or similar)
  $(window).on('popstate', function() {
      syncHoverAndSlideToCenter();
  });

  // Initialize Swiper
  var swiper = new Swiper(".btn-sub", {
      slidesPerView: 2,
      effect: "slide",
      speed: 800,
      grabCursor: true,
      touchRatio: 1, // Touch sensitivity
      longSwipesRatio: 1, // Ratio to trigger swipe to next/previous slide
      longSwipesMs: 600, // Minimum duration (in ms) to trigger swipe to next/previous slide
      freeMode: true, // Enables free mode for a smoother drag experience
      freeModeMomentum: true, // Enables momentum and momentum bounce in free mode
      freeModeMomentumVelocityRatio: 0.5, // Higher numbers increase momentum      
      breakpoints: {
          1280: {
              slidesPerView: 6,
          },
          768: {
              slidesPerView: 4,
          },
          375: {
              slidesPerView: 3,
          },
          280: {
              slidesPerView: 2,
          },
      },
      navigation: {
          nextEl: ".button-next",
          prevEl: ".button-prev",
      },
      grabCursor: true,
      mousewheel: true,
      keyboard: true,
      pagination: {
          el: ".swiper-pagination",
          clickable: true,
      },
      // Adjust transition effect for smoother transition
      effectOptions: {
          slideShadows: true,
          fadeEffect: {
              crossFade: true
          },
          cubeEffect: {
              shadow: true,
              slideShadows: true,
              shadowOffset: 20,
              shadowScale: 0.94
          },
          flipEffect: {
              slideShadows: true,
              limitRotation: true
          },
          coverflowEffect: {
              rotate: 30,
              stretch: 10,
              depth: 60,
              modifier: 2,
              slideShadows: true
          },
          cubeEffect: {
              shadow: true,
              slideShadows: true,
              shadowOffset: 20,
              shadowScale: 0.94
          }
      },
      on: {
          init: function () {
              // Set slide index based on selected category
              var selectedSlideIndex = localStorage.getItem('selectedSlideIndexkat');
              if (selectedSlideIndex !== null) {
                  this.slideTo(selectedSlideIndex);
              }
          },
          slideChange: function () {
              // Save selected slide index to local storage
              var currentIndex = this.activeIndex;
              localStorage.setItem('selectedSlideIndexkat', currentIndex);
          },
      }
  });

  // Sync hover with category when a card is clicked
  $(".card-linkkat").click(function(e) {
      e.preventDefault();
      $(".ss .card").removeClass("card-selectedkat").addClass("card-defaultkat");
      $(this).closest(".card").addClass("card-selectedkat").removeClass("card-defaultkat");

      // Save selected card link to local storage
      localStorage.setItem('selectedCardLinkkat', $(this).attr("href"));

      // Save selected category to local storage
      const selectedCategory = decodeURIComponent($(this).attr("href").split("/").pop());
      localStorage.setItem('selectedCategory', selectedCategory);

      // Handle link redirection
      window.location = $(this).attr("href");
  });

  // Retrieve selected category from local storage after page load
  var selectedCategory = localStorage.getItem('selectedCategory');
  if (selectedCategory !== null) {
      $(".card-linkkat").each(function() {
          if ($(this).attr("href").includes(selectedCategory)) {
              $(".card-linkkat").closest(".card").removeClass("card-selectedkat").addClass("card-defaultkat"); // Remove active class from all categories
              $(this).closest(".card").addClass("card-selectedkat").removeClass("card-defaultkat"); // Add active class to selected category

              // Slide to center
              const slideIndex = $(this).closest(".ss").index();
              const slideWidth = $(".ss").outerWidth();
              const swiperWidth = $(".contsw").outerWidth();
              const wrapperOffset = (swiperWidth - slideWidth) / 2;
              const scrollTo = slideIndex * slideWidth - wrapperOffset;
              $(".contsw").css("transform", `translateX(-${scrollTo}px)`);
          }
      });
  }

  // Add hover effect for category to slide to center
  $(".card-linkkat").hover(function() {
      const slideIndex = $(this).closest(".ss").index();
      const slideWidth = $(".ss").outerWidth();
      const swiperWidth = $(".contsw").outerWidth();
      const wrapperOffset = (swiperWidth - slideWidth) / 2;
      const scrollTo = slideIndex * slideWidth - wrapperOffset;
      $(".contsw").css("transform", `translateX(-${scrollTo}px)`);
  }, function() {
      // On hover out, maintain the current position
      var selectedSlideIndex = localStorage.getItem('selectedSlideIndexkat');
      var slideWidth = $(".ss").outerWidth();
      var scrollTo = selectedSlideIndex * slideWidth;
      $(".contsw").css("transform", `translateX(-${scrollTo}px)`);
  });
});


// Slider Hsitori view Mobile
$(document).ready(function() {
  var swiper = new Swiper(".btn-his", {
      slidesPerView: 2,
      effect: "slide",
      speed: 1000,
      spaceBetween: 10,
      grabCursor: true,
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
              // Memindahkan slide yang dipilih ke tengah slider saat inisialisasi
              var selectedSlideIndex = localStorage.getItem('selectedSlideIndex');
              if (selectedSlideIndex !== null) {
                  this.slideTo(selectedSlideIndex);
              }
          },
          slideChange: function () {
              // Menyimpan indeks slide yang dipilih ke dalam local storage
              var currentIndex = this.activeIndex;
              localStorage.setItem('selectedSlideIndex', currentIndex);
          },
      }
  });

  $(".card-linkkat").click(function(e) {
      e.preventDefault(); 
      var categoryUrl = $(this).attr("href");
      var slideIndex = $(this).closest(".ss").index();
      
      // Menggunakan metode slideTo dengan efek easing untuk perpindahan yang lebih mulus
      swiper.slideTo(slideIndex, 1000, false);

      // Simpan indeks slide yang dipilih di local storage
      localStorage.setItem('selectedSlideIndex', slideIndex);
      
      // Handle link redirection
      window.history.pushState(null, null, categoryUrl);
  });
});



