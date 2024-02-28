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
      // Menyesuaikan efek transisi untuk perpindahan yang lebih halus
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
  });

  $(".card-linkkat").click(function(e) {
      e.preventDefault(); 

      var categoryUrl = $(this).attr("href"); 
      window.history.pushState(null, null, categoryUrl);
      var slideIndex = $(this).closest(".swiper-slide").index();
      
      // Menggunakan metode slideTo dengan efek easing untuk perpindahan yang lebih mulus
      swiper.slideTo(slideIndex, 1000, false); // Kecepatan transisi 1000 milidetik (1 detik), dengan efek easing false

      // Simpan indeks slide yang dipilih di local storage
      localStorage.setItem('selectedSlideIndex', slideIndex);
  });

  // Ambil indeks slide yang dipilih dari local storage setelah halaman dimuat
  var selectedSlideIndex = localStorage.getItem('selectedSlideIndex');
  if (selectedSlideIndex !== null) {
      swiper.slideTo(selectedSlideIndex, 1000, false); // Kecepatan transisi 1000 milidetik (1 detik), dengan efek easing false
  }
});








// Slider Hsitori view Mobile
// $(document).ready(function() {
//   var swiper = new Swiper(".btn-his", {
//       slidesPerView: 2,
//       effect: "slide",
//       speed: 1000,
//       grabCursor: true,
//       breakpoints: {
//           1280: { slidesPerView: 6 },
//           768: { slidesPerView: 4 },
//           375: { slidesPerView: 3 },
//           280: { slidesPerView: 2 },
//       },
//       navigation: {
//           nextEl: ".button-next",
//           prevEl: ".button-prev",
//       },
//       pagination: {
//           el: ".swiper-pagination",
//           clickable: true,
//       },
//       on: {
//           init: function () {
//               // Memindahkan slide yang dipilih ke tengah slider saat inisialisasi
//               var selectedSlideIndex = localStorage.getItem('selectedSlideIndex');
//               if (selectedSlideIndex !== null) {
//                   this.slideTo(selectedSlideIndex);
//               }
//           },
//           slideChange: function () {
//               // Menyimpan indeks slide yang dipilih ke dalam local storage
//               var currentIndex = this.activeIndex;
//               localStorage.setItem('selectedSlideIndex', currentIndex);
//           },
//       }
//   });

//   $(".card-linkkat").click(function(e) {
//       e.preventDefault(); 
//       var categoryUrl = $(this).attr("href");
//       var slideIndex = $(this).closest(".swiper-slide").index();
      
//       // Menggunakan metode slideTo dengan efek easing untuk perpindahan yang lebih mulus
//       swiper.slideTo(slideIndex, 1000, false);

//       // Simpan indeks slide yang dipilih di local storage
//       localStorage.setItem('selectedSlideIndex', slideIndex);
      
//       // Handle link redirection
//       window.history.pushState(null, null, categoryUrl);
//   });
// });



