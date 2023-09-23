var swiper = new Swiper(".mySwiper", {
  slidesPerView: 3,
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
      slidesPerView: 6, // 3 card per tampilan

    },
    // Tampilan iPad (lebar >= 768px)
    768: {
      slidesPerView: 4, // 3 card per tampilan
    },
    // Tampilan Mobile (lebar < 768px)
    375: {
      slidesPerView: 3, // 2 card per tampilan
    },
  },

  });

  var swiper = new Swiper(".btn-sub", {
    slidesPerView: 'auto',
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
        slidesPerView: 3, // 2 card per tampilan
      },
      280: {
        slidesPerView: 2, // tampilan galaxo fold
      },
    },
    navigation: {
      nextEl: '.button-next',
      prevEl: '.button-prev',
  },
  });
 

 var slider = new Slider(".mySweety", {
    slidesPerView: 6,
    
    loop: true,
 });




 

  