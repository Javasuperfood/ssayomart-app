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
      touchRatio: 1, // Touch sensitivity
      longSwipesRatio: 0.3, // Ratio to trigger swipe to next/previous slide
      longSwipesMs: 300, // Minimum duration (in ms) to trigger swipe to next/previous slide
      freeMode: true, // Enables free mode for a smoother drag experience
      freeModeMomentum: true, // Enables momentum and momentum bounce in free mode
      freeModeMomentumVelocityRatio: 1, // Higher numbers increase momentum
      touchAngle: 315,// Adjusting touch angle for smoother diagonal swipe // Change this value according to your preference
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


